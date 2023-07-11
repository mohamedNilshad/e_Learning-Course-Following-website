<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\Common\CardDetail;
use App\Models\Common\CompanyAmountDetail;
use App\Models\Common\EducatorAmountDetail;
use App\Models\Common\UserPaymentDetail;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function sendResponse($token, $code = 200)
    {
        $response = [
            'success' => true,
            'token' => $token,
        ];
        return response($response, $code);
    }
       //if Response Faild
       public function sendError($error, $errorMessage = "Request failed!", $code = 401)
       {
           $response = [
               'success' => false,
               'data' => $error,
               'message' => $errorMessage,
           ];
   
           return response($response, $code);
       }
   
    public function newPayment(Request $request)
    {
        $request->validate([
            'holderName' => 'required',
            'cardNumber' => 'required|numeric|digits:14',
            'expDate' => 'required|regex:/^\d{2}\/\d{2}$/',
            'cvvNumber' => 'required|numeric|digits:3'
        ]);

        $userID = $request->user_id; //1;
        $courseID = $request->course_id; //5;
        $educatorID = $request->educator_id; //2;

        $holderName = $request->holderName;
        $cardNum = ($request->cardNumber);
        $cardExp = md5($request->expDate);
        $cardCvv = md5($request->cvvNumber);

        $amount = $request->amount;

        $isAddCard = CardDetail::where('cardNumber', '=', $cardNum)->where('blockCard', '=', 0)->first();

        if (!$isAddCard) {
            $isAddCard = CardDetail::create([
                'user_id' => $userID,
                'holderName' => $holderName,
                'cardNumber' => $cardNum,
                'expDate' => $cardExp,
                'cvv' => $cardCvv,
                'blockCard' => 0
            ]);
        }

        if (($isAddCard->user_id == $userID) && ($isAddCard->cardNumber == $cardNum) && ($isAddCard->expDate == $cardExp) && ($isAddCard->cvv == $cardCvv)) {

            UserPaymentDetail::create([
                'user_id' => $userID,
                'course_id' => $courseID,
                'amount' => $amount
            ]);

            $amountEdu = ($amount / 100) * 80;
            EducatorAmountDetail::create([
                'user_id' => $userID,
                'educator_id' => $educatorID,
                'course_id' => $courseID,
                'amount' => $amountEdu,
                'withdraw' => 0
            ]);

            $amountComp = $amount - $amountEdu;
            CompanyAmountDetail::create([
                'user_id' => $userID,
                'educator_id' => $educatorID,
                'course_id' => $courseID,
                'amount' => $amountComp,
                'withdraw' => 0
            ]);
            return $this->sendResponse(null);

        }

        return $this->sendError('payment not success Card informations may be wrong');

    }
}