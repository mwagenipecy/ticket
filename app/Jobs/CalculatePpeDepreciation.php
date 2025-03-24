<?php

namespace App\Jobs;

use App\Models\AccountsModel;
use App\Models\general_ledger;
use App\Models\PPE;
use App\Services\TransactionPostingService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CalculatePpeDepreciation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $narration;

    public function __construct()
    {
        // Initialization log
        Log::info('CalculatePpeDepreciation job initialized.');
    }

    public function handle()
    {
        // Step 1: Fetch all PPE records
        Log::info('Fetching all PPE records.');
        $ppes = PPE::all();

        foreach ($ppes as $ppe) {
            // Step 2: Calculate months in use
            Log::info('Calculating months in use for PPE', ['ppe_id' => $ppe->id]);
            $purchase_date = Carbon::parse($ppe->purchase_date);
            $current_date = Carbon::now();
            $months_in_use = $current_date->diffInMonths($purchase_date);
            $months_in_use = max($months_in_use, 0);  // Ensure non-negative value

            // Step 3: Calculate initial value
            Log::info('Calculating initial value for PPE', ['ppe_id' => $ppe->id]);
            $initial_value = $ppe->purchase_price * $ppe->quantity;

            // Step 4: Calculate depreciation rate and monthly depreciation
            if ($ppe->useful_life > 0 && $ppe->salvage_value >= 0) {
                $depreciation_per_year = ($ppe->purchase_price - $ppe->salvage_value) / $ppe->useful_life;
                $depreciation_per_month = $depreciation_per_year / 12;
                Log::info('Depreciation rate calculated', ['ppe_id' => $ppe->id, 'depreciation_per_month' => $depreciation_per_month]);
            } else {
                $depreciation_per_year = 0;
                $depreciation_per_month = 0;
                Log::warning('Invalid useful life or salvage value for PPE', ['ppe_id' => $ppe->id]);
            }

            // Step 5: Calculate accumulated depreciation
            $accumulated_depreciation = $depreciation_per_month * $months_in_use;
            Log::info('Accumulated depreciation calculated', ['ppe_id' => $ppe->id, 'accumulated_depreciation' => $accumulated_depreciation]);

            // Step 6: Calculate depreciation for the current year
            $depreciation_for_year = $ppe->useful_life > 0 ? $depreciation_per_year : 0;
            Log::info('Depreciation for the current year calculated', ['ppe_id' => $ppe->id, 'depreciation_for_year' => $depreciation_for_year]);

            // Step 7: Calculate closing value
            $closing_value = $initial_value - $accumulated_depreciation;
            Log::info('Closing value calculated', ['ppe_id' => $ppe->id, 'closing_value' => $closing_value]);

            // Step 8: Update PPE record
            Log::info('Updating PPE record with new depreciation values', ['ppe_id' => $ppe->id]);
            $ppe->update([
                'accumulated_depreciation' => $accumulated_depreciation,
                'depreciation_for_year' => $depreciation_for_year,
                'depreciation_for_month' => $depreciation_per_month,
                'closing_value' => $closing_value,
            ]);

            // Step 9: Calculate total PPE value for the transaction
            $ppe_total_value = $depreciation_per_month;

            // Step 10: Fetch account details for depreciation expense and accumulated depreciation
            Log::info('Fetching accounts for depreciation transactions.');
            $depreciation_expense_code = DB::table('setup_accounts')->where('item','depreciation_expense')->value('sub_category_code');
            $accumulated_depreciation_code = DB::table('setup_accounts')->where('item','accumulated_depreciation')->value('sub_category_code');
            $debit_account_details = AccountsModel::where('sub_category_code', $depreciation_expense_code)->first();
            $credit_cash_account = AccountsModel::where("sub_category_code", $accumulated_depreciation_code)->first();

            $reference_number = time();
            $this->narration = 'Depreciation Expense - Category : '.$ppe->category.' : Name - '.$ppe->name;
            $data = [

                'first_account' => $debit_account_details,
                'second_account' => $credit_cash_account,
                'amount' => $ppe_total_value,
                'narration' =>  $this->narration,

            ];

            $transactionServicex = new TransactionPostingService();
            $response = $transactionServicex->postTransaction($data);

            //Log::info('Results - '.$response);
        }

        Log::info('PPE depreciation calculation completed successfully.');
    }

    private function debit($reference_number, $debited_account, $credited_account, $amount, $new_amount)
    {
        Log::info('Debit entry', [
            'debited_account' => $debited_account->account_number,
            'amount' => $amount,
            'new_balance' => $new_amount
        ]);

        general_ledger::create([
            'record_on_account_number' => $debited_account->account_number,
            'record_on_account_number_balance' => $new_amount,
            'major_category_code' => $debited_account->major_category_code,
            'category_code' => $debited_account->category_code,
            'sub_category_code' => $debited_account->sub_category_code,
            'sender_name' => $debited_account->account_name,
            'beneficiary_name' => $credited_account->account_name,
            'sender_account_number' => $debited_account->account_number,
            'beneficiary_account_number' => $credited_account->account_number,
            'narration' => $this->narration,
            'credit' => 0,
            'debit' => $amount,
            'reference_number' => $reference_number,
            'trans_status' => 'Pending Approval',
            'trans_status_description' => 'Awaiting Approval',
            'payment_status' => 'Pending',
            'recon_status' => 'Pending',
        ]);
    }

    private function credit($reference_number, $debited_account, $credited_account, $amount, $new_amount)
    {
        Log::info('Credit entry', [
            'credited_account' => $credited_account->account_number,
            'amount' => $amount,
            'new_balance' => $new_amount
        ]);

        general_ledger::create([
            'record_on_account_number' => $credited_account->account_number,
            'record_on_account_number_balance' => $new_amount,
            'major_category_code' => $credited_account->major_category_code,
            'category_code' => $credited_account->category_code,
            'sub_category_code' => $credited_account->sub_category_code,
            'sender_name' => $debited_account->account_name,
            'beneficiary_name' => $credited_account->account_name,
            'sender_account_number' => $debited_account->account_number,
            'beneficiary_account_number' => $credited_account->account_number,
            'narration' => $this->narration,
            'credit' => $amount,
            'debit' => 0,
            'reference_number' => $reference_number,
            'trans_status' => 'Pending Approval',
            'trans_status_description' => 'Awaiting Approval',
            'payment_status' => 'Pending',
            'recon_status' => 'Pending',
        ]);
    }
}
