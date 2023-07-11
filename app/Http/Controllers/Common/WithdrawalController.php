<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\Common\CompanyAmountDetail;
use App\Models\Common\EducatorAmountDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;


class WithdrawalController extends Controller
{
    public function WithdrawEducator(Request $request)
    {

        $eduID = Session::get('loginId');
        $withdrawDetails = EducatorAmountDetail::where('educator_id', '=', $eduID)->where('withdraw', '=', 0)->get();

        if ($withdrawDetails->count() > 0) {
            $total = 0;
            foreach ($withdrawDetails as $withd) {
                $total += $withd->amount;

                EducatorAmountDetail::where('id', $withd->id)->update([
                    'withdraw' => 1
                ]);
            }

            
            // return back()->with('Withdrawed',$total );
            $paymentData = [
                'paymentAmount' => $total,
                'paymentID' => '521478' . $withd->id,
                'accountNumber' => 1452,
                'paymentDate' => date('y-m-d')
            ];
            $request->session()->put('educatorPaymentDetails', $paymentData);

         
            
            return back()->with('Withdrawed', $total);

        }
        return back()->with('fail', 'Withdraw faild ');

    }

    public function WithdrawCompany(Request $request)
    {
        $withdrawDetails = CompanyAmountDetail::where('withdraw', '=', 0)->get();

        if ($withdrawDetails->count() > 0) {
            $total = 0;
            foreach ($withdrawDetails as $withd) {
                $total += $withd->amount;

                CompanyAmountDetail::where('id', $withd->id)->update([
                    'withdraw' => 1
                ]);
            }
            return back()->with('AdminWithdrawed', 1);
        }
        return back()->with('fail', 'Withdraw faild ');
    }
}