<?php

namespace App\Services;

use App\Livewire\Accounting\Account;
use App\Models\Account as Accounts;
use App\Models\Activity;
use App\Models\GeneralLedger;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Livewire\Component;
use App\Models\Loan as Loans;
use App\Models\Loan_sub_products;
use App\Models\LoanProduct;
use App\Models\loans_schedules;
use App\Models\LoanSchedule;
use App\Models\LoansModel;
use Carbon\Carbon;

class LoanScheduleService
{

    public function calculateDate($payment_frequency, $tenure)
    {
        $dates = [];
        if ($payment_frequency == "daily") {

            $today = Carbon::now();
            $start_date = $today->copy()->addDays(1);
            $end_date = $start_date->copy()->addMonths((int)$tenure);
            $i = 1;
            while ($start_date->lessThanOrEqualTo($end_date)) {
                $dates[] =
                    [[$i] = 'date' => $start_date->toDateString()];
                $start_date->addDay();
                $i++;
            }

            return $dates;

        } elseif ($payment_frequency == "weekly") {
            $currentDate = Carbon::now()->copy()->addDays(7);
            $endDate = $currentDate->copy()->addMonths((int)$tenure);

            while ($currentDate->lt($endDate)) {
                $dates[] = [[$i] = 'date' =>  $currentDate->format('Y-m-d')];
                $currentDate->addWeek();
            }

            return $dates;
        } elseif ($payment_frequency == "monthly") {

            $currentDate = Carbon::now()->copy()->addMonths(1);
            $endDate = $currentDate->copy()->addMonths((int)$tenure);

            while ($currentDate->lt($endDate)) {
                $dates[] = [[$i] = 'date' =>  $currentDate->format('Y-m-d')];
                $currentDate->addMonth();
            }

            return $dates;
        }
    }


    public function reducingRepaymentSchedule($principal, $interest, $tenure, $loan_id,$paymentFrequency){

          // couunt number of iterations
          $count_total = count($this->calculateDate($paymentFrequency, $tenure));
          $date_list = $this->calculateDate($paymentFrequency, $tenure);
          $tenure = $count_total;
          // reducing and flat method

          $principle_payment = $principal / $tenure;


          // for flat
          $array = [];
          $total_installment = 0;
          $total_interest = 0;
          $total_principal = 0;
          $total_balance = 0;

          for ($i = 1; $i <= $count_total; $i++) {

            $interest_amount = $principal * $interest / 100;

              $installment = (float)($interest_amount + $principle_payment);
              $amount_remain = (float)($principal - $principle_payment);

              if ($amount_remain < 0) {
                  $installment = $principal + (float)($interest_amount);
                  $amount_remain = 0;
              }
              $array[] = [
                  'Payment' => $installment,
                  'balance' => $amount_remain,
                  'interest' => $interest_amount,
                  'Principle' => $principle_payment,
                  'date' => $date_list[$i - 1]['date'],
              ];

              $principal = (float)($principal - $principle_payment);

              $total_installment = (float)($installment + $total_installment);
              $total_interest = (float)($total_interest + $interest_amount);
              $total_principal = (float)($total_principal + $principle_payment);
              $total_balance = (float)($principal);
          }

          $footer[] = [
              'total_installment' => $total_installment,
              'total_interest' => $total_interest,
              'total_principal' => $total_principal,
              'total_balance' => $total_balance,
          ];



        //  $this->storeLoanSchedule((object)$array,$loan_id);


          return [
              'body'=>(object)$array,
              'footer'=>(object)$footer
          ];

    }

    public function flatRepaymentSchedule($principal, $interest, $tenure, $loan_id,$paymentFrequency)
    {

        // couunt number of iterations
        $count_total = count($this->calculateDate($paymentFrequency, $tenure));
        $date_list = $this->calculateDate($paymentFrequency, $tenure);
        $tenure = $count_total;
        // reducing and flat method
        $interest_amount = $principal * $interest / 100;
        $principle_payment = $principal / $tenure;


        // for flat
        $array = [];
        $total_installment = 0;
        $total_interest = 0;
        $total_principal = 0;
        $total_balance = 0;

        for ($i = 1; $i <= $count_total; $i++) {
            $installment = (float)($interest_amount + $principle_payment);

            $amount_remain = (float)($principal - $principle_payment);

            if ($amount_remain < 0) {
                $installment = $principal + (float)($interest_amount);
                $amount_remain = 0;
            }
            $array[] = [
                'Payment' => $installment,
                'balance' => $amount_remain,
                'interest' => $interest_amount,
                'Principle' => $principle_payment,
                'date' => $date_list[$i - 1]['date'],
            ];

            $principal = (float)($principal - $principle_payment);
            $total_installment = (float)($installment + $total_installment);
            $total_interest = (float)($total_interest + $interest_amount);
            $total_principal = (float)($total_principal + $principle_payment);
            $total_balance = (float)($principal);



        }

        $footer[] = [
            'total_installment' => $total_installment,
            'total_interest' => $total_interest,
            'total_principal' => $total_principal,
            'total_balance' => $total_balance,
        ];



      //  $this->storeLoanSchedule((object)$array,$loan_id);

        return [
            'body'=>(object)$array,
            'footer'=>(object)$footer
        ];

        // $this->tableData = (object)$array;
        // $this->tableFooter = (object)$footer;
    }



    function  generateLoanSchedule($loan_id){

        $loans=$this->loanInfo($loan_id);

        foreach($loans as $loan){



            $principal = $loan->loan_amount;
            $loan_id=$loan->id;
             $loan_product =  Loan_sub_products::where('sub_product_id',$loan->loan_sub_product)->first();

            $monthlyInterest =  $loan_product->interest_value;
            $method = $loan_product->interest_method;

            $tenureMonths=$loan_product->interest_tenure;
            $paymentFrequency='monthly';

        }



        // $principal = 10000; // tenure_type  // Principal amount
        // $monthlyInterest = 1; // Monthly interest rate (1%)
        // $tenureMonths = 12; // Loan tenure in months
        // $paymentFrequency="";
        // $method='flat';

        if($method=='flat'){

            //loan save //
            return  $this->flatRepaymentSchedule($principal, $monthlyInterest, $tenureMonths,  $loan_id,$paymentFrequency);
        }else{

            return  $this->reducingRepaymentSchedule($principal, $monthlyInterest, $tenureMonths, $loan_id,$paymentFrequency);

        }


    }


    function storeLoanSchedule($array,$loan_id){

        foreach ($array as $key => $body ){

          loans_schedules::create([

            'loan_id'=>$loan_id,
             'payment_date'=>$body['date'],
             'installment_amount'=>$body['installment'],
             'principle_amount'=>$body['principal'],
             'interest_amount'=>$body['interest'],
             'outstanding_amount'=>$body['balance'],
             'status'=>'ACTIVE'
          ]);
    }
    }

    function loanInfo($loan_id){
        return LoansModel::where('id',$loan_id)->get();
    }


}
