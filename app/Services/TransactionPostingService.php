<?php

namespace App\Services;

use App\Models\AccountsModel;
use App\Models\general_ledger;
use App\Models\SubAccounts;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Exception;
use Illuminate\Support\Facades\Log;


class TransactionPostingService
{
    public $credit_account_level, $debit_account_level;
    public $action;

    /**
     * Post a transaction with automatic debit/credit determination.
     *
     * @param array $data
     * @return array
     * @throws Exception
     */
    public function postTransaction(array $data)
    {
        Log::info('Starting transaction posting', ['data' => $data]);

        $this->validateData($data);
        $referenceNumber = time();

        DB::beginTransaction();
        try {
            $firstAccountDetails = $data['first_account'];
            $secondAccountDetails = $data['second_account'];
            $amount = $data['amount'];
            $narration = $data['narration'];
            $this->action = $data['action'] ?? 'none';
            //Log::error('WHAT ACTION', $this->action);


            if (!$firstAccountDetails || !$secondAccountDetails) {
                throw new Exception('Invalid account details.');
            }

            // Determine which account to debit and credit
            $debitAccountDetails = $this->determineDebitAccount($firstAccountDetails, $secondAccountDetails) === 'first' ? $firstAccountDetails : $secondAccountDetails;
            $creditAccountDetails = $debitAccountDetails === $firstAccountDetails ? $secondAccountDetails : $firstAccountDetails;

//            if (!$this->hasSufficientBalance($debitAccountDetails, $amount)) {
//                return [
//                    'status' => 'failed',
//                    'message' => 'Insufficient balance in account: ' . $debitAccountDetails->account_number,
//                    'current_balance' => $debitAccountDetails->balance
//                ];
//            }

            // Process the transaction
            $this->processTransaction($referenceNumber, $debitAccountDetails, $creditAccountDetails, $amount, $narration);

            DB::commit();
            //$this->logAudit('Transaction Posted', $referenceNumber);

            return ['status' => 'success', 'reference_number' => $referenceNumber];
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Transaction posting failed', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    private function validateData($data)
    {
        if (!isset($data['first_account'], $data['second_account'], $data['amount'], $data['narration'])) {
            throw new Exception('Incomplete transaction data.');
        }
    }

    private function determineDebitAccount($firstAccount, $secondAccount)
    {
        if (in_array($firstAccount->type, ['asset_accounts', 'expense_accounts'])) {
            return 'first';
        }
        return 'second';
    }

    private function hasSufficientBalance($account, $amount)
    {
        return $account->balance >= $amount;
    }

    /**
     * @throws Exception
     */
    private function processTransaction($referenceNumber, $debitAccountDetails, $creditAccountDetails, $amount, $narration)
    {
        $this->credit_account_level = 2;
        $this->debit_account_level = 2;

        // Adjust balances
        $balances = $this->updateBalances($debitAccountDetails, $creditAccountDetails, $amount,$referenceNumber,$narration);
        $debitNewBalance = $balances['debitNewBalance'];
        $creditNewBalance = $balances['creditNewBalance'];

        //dd($debitAccountDetails, $creditAccountDetails, $amount,$balances);

//        // Record transaction entries
//        $this->recordTransaction($referenceNumber, $debitAccountDetails, $creditAccountDetails, $debitNewBalance, 'credit', $amount, $narration);
//        $this->recordTransaction($referenceNumber, $creditAccountDetails, $debitAccountDetails, $creditNewBalance, 'debit', $amount, $narration);
//
//        // Update balances for debit and credit accounts, including parent accounts
//        $this->updateAccountBalance($debitAccountDetails, $debitNewBalance, $amount, 'credit');
//        $this->updateAccountBalance($creditAccountDetails, $creditNewBalance, $amount, 'debit');
    }


    /**
     * @throws Exception
     */
    function updateBalances($debitAccountDetails, $creditAccountDetails, $amount, $referenceNumber, $narration)
    {
        Log::info("Transaction Details: Debit Account ID: {$debitAccountDetails->id}, Type: {$debitAccountDetails->type}, Credit Account ID: {$creditAccountDetails->id}, Type: {$creditAccountDetails->type}, Amount: $amount");

        $debitNewBalance = 0;
        $creditNewBalance = 0;

        // Asset-to-Asset Transfer (e.g., Cash to Inventory)
        if ($debitAccountDetails->type === 'asset_accounts' && $creditAccountDetails->type === 'asset_accounts') {
            $debitNewBalance = $debitAccountDetails->balance - $amount;
            $creditNewBalance = $creditAccountDetails->balance + $amount;

            // Record transaction entries
            $this->recordTransaction($referenceNumber, $debitAccountDetails, $creditAccountDetails, $debitNewBalance, 'debit', $amount, $narration);
            $this->recordTransaction($referenceNumber, $creditAccountDetails, $debitAccountDetails, $creditNewBalance, 'credit', $amount, $narration);

            // Update balances for debit and credit accounts, including parent accounts
            $this->updateAccountBalance($debitAccountDetails, $debitNewBalance, $amount, 'debit');
            $this->updateAccountBalance($creditAccountDetails, $creditNewBalance, $amount, 'credit');


            Log::info("Asset-to-Asset Transfer");
        }
        // Asset-to-Liability (e.g., Cash to Accounts Payable)
        elseif ($debitAccountDetails->type === 'asset_accounts' && $creditAccountDetails->type === 'liability_accounts') {

            if($this->action == 'withdraw'){
                $debitNewBalance = $debitAccountDetails->balance - $amount;
                $creditNewBalance = $creditAccountDetails->balance - $amount;
            }else{
                $debitNewBalance = $debitAccountDetails->balance + $amount;
                $creditNewBalance = $creditAccountDetails->balance + $amount;
            }


            // Record transaction entries
            $this->recordTransaction($referenceNumber, $debitAccountDetails, $creditAccountDetails, $debitNewBalance, 'debit', $amount, $narration);
            $this->recordTransaction($referenceNumber, $creditAccountDetails, $debitAccountDetails, $creditNewBalance, 'credit', $amount, $narration);

            // Update balances for debit and credit accounts, including parent accounts
            $this->updateAccountBalance($debitAccountDetails, $debitNewBalance, $amount, 'debit');
            $this->updateAccountBalance($creditAccountDetails, $creditNewBalance, $amount, 'credit');


            Log::info("Asset-to-Liability Transfer");
        }
        // Asset-to-Capital (e.g., Cash to Retained Earnings)
        elseif ($debitAccountDetails->type === 'asset_accounts' && $creditAccountDetails->type === 'capital_accounts') {
            $debitNewBalance = $debitAccountDetails->balance + $amount;
            $creditNewBalance = $creditAccountDetails->balance + $amount;

            // Record transaction entries
            $this->recordTransaction($referenceNumber, $debitAccountDetails, $creditAccountDetails, $debitNewBalance, 'debit', $amount, $narration);
            $this->recordTransaction($referenceNumber, $creditAccountDetails, $debitAccountDetails, $creditNewBalance, 'credit', $amount, $narration);

            // Update balances for debit and credit accounts, including parent accounts
            $this->updateAccountBalance($debitAccountDetails, $debitNewBalance, $amount, 'debit');
            $this->updateAccountBalance($creditAccountDetails, $creditNewBalance, $amount, 'credit');


            Log::info("Asset-to-Capital Transfer");
        }
        // Asset-to-Income (e.g., Cash to Sales Revenue)
        elseif ($debitAccountDetails->type === 'asset_accounts' && $creditAccountDetails->type === 'income_accounts') {
            $debitNewBalance = $debitAccountDetails->balance + $amount;
            $creditNewBalance = $creditAccountDetails->balance + $amount;

            // Record transaction entries
            $this->recordTransaction($referenceNumber, $debitAccountDetails, $creditAccountDetails, $debitNewBalance, 'debit', $amount, $narration);
            $this->recordTransaction($referenceNumber, $creditAccountDetails, $debitAccountDetails, $creditNewBalance, 'credit', $amount, $narration);

            // Update balances for debit and credit accounts, including parent accounts
            $this->updateAccountBalance($debitAccountDetails, $debitNewBalance, $amount, 'debit');
            $this->updateAccountBalance($creditAccountDetails, $creditNewBalance, $amount, 'credit');


            Log::info("Asset-to-Income Transfer");
        }
        // Asset-to-Expense (e.g., Cash to Rent Expense)
        elseif ($debitAccountDetails->type === 'asset_accounts' && $creditAccountDetails->type === 'expense_accounts') {
            $debitNewBalance = $debitAccountDetails->balance - $amount;
            $creditNewBalance = $creditAccountDetails->balance + $amount;
            Log::info("Asset-to-Expense Transfer");
        }
        // Liability-to-Asset (e.g., Loan Payable to Cash)
        elseif ($debitAccountDetails->type === 'liability_accounts' && $creditAccountDetails->type === 'asset_accounts') {
            $debitNewBalance = $debitAccountDetails->balance - $amount;
            $creditNewBalance = $creditAccountDetails->balance + $amount;
            Log::info("Liability-to-Asset Transfer");
        }
        // Liability-to-Liability (e.g., Accounts Payable to Long-Term Loan)
        elseif ($debitAccountDetails->type === 'liability_accounts' && $creditAccountDetails->type === 'liability_accounts') {

            $debitNewBalance = $debitAccountDetails->balance - $amount;
            $creditNewBalance = $creditAccountDetails->balance + $amount;

            // Record transaction entries
            $this->recordTransaction($referenceNumber, $debitAccountDetails, $creditAccountDetails, $debitNewBalance, 'debit', $amount, $narration);
            $this->recordTransaction($referenceNumber, $creditAccountDetails, $debitAccountDetails, $creditNewBalance, 'credit', $amount, $narration);

            // Update balances for debit and credit accounts, including parent accounts
            $this->updateAccountBalance($debitAccountDetails, $debitNewBalance, $amount, 'debit');
            $this->updateAccountBalance($creditAccountDetails, $creditNewBalance, $amount, 'credit');

            Log::info("Liability-to-Liability Transfer");
        }
        // Liability-to-Capital (e.g., Accounts Payable to Retained Earnings)
        elseif ($debitAccountDetails->type === 'liability_accounts' && $creditAccountDetails->type === 'capital_accounts') {
            $debitNewBalance = $debitAccountDetails->balance - $amount;
            $creditNewBalance = $creditAccountDetails->balance + $amount;


            // Record transaction entries
            $this->recordTransaction($referenceNumber, $debitAccountDetails, $creditAccountDetails, $debitNewBalance, 'debit', $amount, $narration);
            $this->recordTransaction($referenceNumber, $creditAccountDetails, $debitAccountDetails, $creditNewBalance, 'credit', $amount, $narration);

            // Update balances for debit and credit accounts, including parent accounts
            $this->updateAccountBalance($debitAccountDetails, $debitNewBalance, $amount, 'debit');

            $this->updateAccountBalance($creditAccountDetails, $creditNewBalance, $amount, 'credit');



            Log::info("Liability-to-Capital Transfer");
        }
        // Liability-to-Expense (e.g., Interest Payable to Interest Expense)
        elseif ($debitAccountDetails->type === 'liability_accounts' && $creditAccountDetails->type === 'expense_accounts') {
            $debitNewBalance = $debitAccountDetails->balance - $amount;
            $creditNewBalance = $creditAccountDetails->balance + $amount;
            Log::info("Liability-to-Expense Transfer");
        }
        // Capital-to-Asset (e.g., Owner's Equity to Cash)
        elseif ($debitAccountDetails->type === 'capital_accounts' && $creditAccountDetails->type === 'asset_accounts') {
            $debitNewBalance = $debitAccountDetails->balance - $amount;
            $creditNewBalance = $creditAccountDetails->balance + $amount;
            Log::info("Capital-to-Asset Transfer");
        }
        // Capital-to-Liability (e.g., Owner's Equity to Loan Payable)
        elseif ($debitAccountDetails->type === 'capital_accounts' && $creditAccountDetails->type === 'liability_accounts') {
            $debitNewBalance = $debitAccountDetails->balance - $amount;
            $creditNewBalance = $creditAccountDetails->balance + $amount;

            // Record transaction entries
            $this->recordTransaction($referenceNumber, $debitAccountDetails, $creditAccountDetails, $debitNewBalance, 'debit', $amount, $narration);
            $this->recordTransaction($referenceNumber, $creditAccountDetails, $debitAccountDetails, $creditNewBalance, 'credit', $amount, $narration);

            // Update balances for debit and credit accounts, including parent accounts
            $this->updateAccountBalance($debitAccountDetails, $debitNewBalance, $amount, 'debit');
            $this->updateAccountBalance($creditAccountDetails, $creditNewBalance, $amount, 'credit');



            Log::info("Capital-to-Liability Transfer");
        }
        // Capital-to-Capital (e.g., Retained Earnings to Owner's Equity)
        elseif ($debitAccountDetails->type === 'capital_accounts' && $creditAccountDetails->type === 'capital_accounts') {
            $debitNewBalance = $debitAccountDetails->balance - $amount;
            $creditNewBalance = $creditAccountDetails->balance + $amount;

              // Record transaction entries
              $this->recordTransaction($referenceNumber, $debitAccountDetails, $creditAccountDetails, $debitNewBalance, 'debit', $amount, $narration);
              $this->recordTransaction($referenceNumber, $creditAccountDetails, $debitAccountDetails, $creditNewBalance, 'credit', $amount, $narration);

              // Update balances for debit and credit accounts, including parent accounts
              $this->updateAccountBalance($debitAccountDetails, $debitNewBalance, $amount, 'debit');
              $this->updateAccountBalance($creditAccountDetails, $creditNewBalance, $amount, 'credit');


            Log::info("Capital-to-Capital Transfer");
        }
        // Capital-to-Expense (e.g., Owner's Equity to Salary Expense)
        elseif ($debitAccountDetails->type === 'capital_accounts' && $creditAccountDetails->type === 'expense_accounts') {
            $debitNewBalance = $debitAccountDetails->balance - $amount;
            $creditNewBalance = $creditAccountDetails->balance + $amount;
            Log::info("Capital-to-Expense Transfer");
        }
        // Expense-to-Asset (e.g., Office Expense to Cash Refund)
        elseif ($debitAccountDetails->type === 'expense_accounts' && $creditAccountDetails->type === 'asset_accounts') {
            $debitNewBalance = $debitAccountDetails->balance + $amount;
            $creditNewBalance = $creditAccountDetails->balance - $amount;
            Log::info("Expense-to-Asset Transfer");
        }
        // Expense-to-Liability (e.g., Expense for Accounts Payable)
        elseif ($debitAccountDetails->type === 'expense_accounts' && $creditAccountDetails->type === 'liability_accounts') {
            $debitNewBalance = $debitAccountDetails->balance + $amount;
            $creditNewBalance = $creditAccountDetails->balance - $amount;
            Log::info("Expense-to-Liability Transfer");
        }
        // Expense-to-Capital (e.g., Expense to Retained Earnings)
        elseif ($debitAccountDetails->type === 'expense_accounts' && $creditAccountDetails->type === 'capital_accounts') {
            $debitNewBalance = $debitAccountDetails->balance + $amount;
            $creditNewBalance = $creditAccountDetails->balance - $amount;
            Log::info("Expense-to-Capital Transfer");
        }
        // Expense-to-Income (e.g., Expense Reimbursement)
        elseif ($debitAccountDetails->type === 'expense_accounts' && $creditAccountDetails->type === 'income_accounts') {
            $debitNewBalance = $debitAccountDetails->balance + $amount;
            $creditNewBalance = $creditAccountDetails->balance - $amount;
            Log::info("Expense-to-Income Transfer");
        }
        // Income-to-Asset (e.g., Recording income received as cash)
        elseif ($debitAccountDetails->type === 'income_accounts' && $creditAccountDetails->type === 'asset_accounts') {
            $debitNewBalance = $debitAccountDetails->balance + $amount;
            $creditNewBalance = $creditAccountDetails->balance - $amount;
            Log::info("Income-to-Asset Transfer");
        }
        // Income-to-Liability (e.g., Transferring income to settle liabilities)
        elseif ($debitAccountDetails->type === 'income_accounts' && $creditAccountDetails->type === 'liability_accounts') {
            $debitNewBalance = $debitAccountDetails->balance + $amount;
            $creditNewBalance = $creditAccountDetails->balance - $amount;
            Log::info("Income-to-Liability Transfer");
        }
        // Income-to-Capital (e.g., Contributing earned income to equity)
        elseif ($debitAccountDetails->type === 'income_accounts' && $creditAccountDetails->type === 'capital_accounts') {
            $debitNewBalance = $debitAccountDetails->balance + $amount;
            $creditNewBalance = $creditAccountDetails->balance - $amount;
            Log::info("Income-to-Capital Transfer");
        }
        // Income-to-Expense (e.g., Offsetting income with expenses)
        elseif ($debitAccountDetails->type === 'income_accounts' && $creditAccountDetails->type === 'expense_accounts') {
            $debitNewBalance = $debitAccountDetails->balance + $amount;
            $creditNewBalance = $creditAccountDetails->balance - $amount;
            Log::info("Income-to-Expense Transfer");
        }
        // Income-to-Income (e.g., Adjustments within income accounts)
        elseif ($debitAccountDetails->type === 'income_accounts' && $creditAccountDetails->type === 'income_accounts') {
            $debitNewBalance = $debitAccountDetails->balance + $amount;
            $creditNewBalance = $creditAccountDetails->balance - $amount;
            Log::info("Income-to-Income Adjustment");
        }
        else {
            Log::error("Unsupported transaction type");

        }
        // Log the new balances
        Log::info("Updated Balances: Debit Account New Balance: $debitNewBalance, Credit Account New Balance: $creditNewBalance");

        // Return the new balances for further use
        return [
            'debitNewBalance' => $debitNewBalance,
            'creditNewBalance' => $creditNewBalance,
        ];
    }




    /**
     * @throws Exception
     */
    private function updateAccountBalance($accountDetails, $newBalance, $amount, $action)
    {
        $logData = [
            'account_number' => $accountDetails->account_number,
            'previous_balance' => $accountDetails->balance,
            'new_balance' => $newBalance,
            'amount' => $amount,
            'action' => $action
        ];

        //Log::info($accountDetails, $newBalance, $amount, $action);

        if ($accountDetails->account_level == 3) {
            Log::info('Updating SubAccount', $logData);
            SubAccounts::where('account_number', $accountDetails->account_number)
                ->update([
                    'balance' => $newBalance,
                    $action => $accountDetails->{$action} + $amount
                ]);
            $this->parentAccountUpdate($accountDetails->parent_account_number, $amount, $action);
        } else {
            Log::info('Updating Main Account', $logData);
            AccountsModel::where('account_number', $accountDetails->account_number)
                ->update([
                    'balance' => $newBalance,
                    $action => $accountDetails->{$action} + $amount
                ]);
        }
    }

    private function parentAccountUpdate($account_number, $amount, $action)
    {
        DB::beginTransaction();
        try {
            $parentAccount = AccountsModel::where('account_number', $account_number)->first();
            AccountsModel::where('account_number', $account_number)
                ->update([
                    'balance' => $parentAccount->balance + ($action === 'credit' ? $amount : -$amount),
                    'credit' => $action === 'credit' ? $parentAccount->credit + $amount : $parentAccount->credit,
                    'debit' => $action === 'debit' ? $parentAccount->debit + $amount : $parentAccount->debit,
                ]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Parent account update failed', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    private function recordTransaction($referenceNumber, $account, $counterparty, $newBalance, $transactionType, $amount, $narration)
    {
        general_ledger::create([
            'record_on_account_number' => $account->account_number,
            'record_on_account_number_balance' => $newBalance,
            'major_category_code' => $account->major_category_code,
            'category_code' => $account->category_code,
            'sub_category_code' => $account->sub_category_code,
            'sender_name' => $transactionType === 'debit' ? $account->account_name : $counterparty->account_name,
            'beneficiary_name' => $transactionType === 'debit' ? $counterparty->account_name : $account->account_name,
            'sender_account_number' => $transactionType === 'debit' ? $account->account_number : $counterparty->account_number,
            'beneficiary_account_number' => $transactionType === 'debit' ? $counterparty->account_number : $account->account_number,
            'narration' => 'MANUAL POSTING: ' . $narration,
            'credit' => $transactionType === 'credit' ? $amount : 0,
            'debit' => $transactionType === 'debit' ? $amount : 0,
            'reference_number' => $referenceNumber,
            'trans_status' => 'Pending Approval',
            'trans_status_description' => 'Awaiting Approval',
            'payment_status' => 'Pending',
            'recon_status' => 'Pending',
            'account_level' => $transactionType === 'debit' ? $this->debit_account_level : $this->credit_account_level,
        ]);
    }
}
