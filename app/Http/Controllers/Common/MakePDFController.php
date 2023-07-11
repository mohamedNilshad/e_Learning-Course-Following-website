<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\Common\UserPaymentDetail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MakePDFController extends Controller
{
    public function MakePDFEducator()
    {
        $cutomerData = UserPaymentDetail::join('course_details', 'user_payment_details.course_id', '=', 'course_details.id')
            ->join('users', 'user_payment_details.user_id', '=', 'users.id')
            ->where('course_details.educator_id', Session::has('loginId'))
            ->orderBy('user_payment_details.created_at', 'desc')
            ->get(['user_payment_details.*', 'course_details.courseName', 'users.user_name']);


        $pdf = Pdf::loadView('Educator.pdf.educator_user_pdf', [
            'cutomerData' => $cutomerData,
        ]);

        if( $pdf){
            return $pdf->download('educator_recent_ser.pdf');

        }
            return "not Working";
    }

    public function MakePDFAdmin()
    {

        $cutomerData = UserPaymentDetail::join('course_details', 'user_payment_details.course_id', '=', 'course_details.id')
            ->join('users', 'user_payment_details.user_id', '=', 'users.id')
            ->orderBy('user_payment_details.created_at', 'desc')
            ->get(['user_payment_details.*', 'course_details.courseName', 'users.user_name']);

        $pdf = Pdf::loadView('Educator.pdf.educator_user_pdf', [
            'cutomerData' => $cutomerData,
        ]);

        return $pdf->download('admin_user_report.pdf');
    }
    public function EducatorPayment(Request $request)
    {
        if (Session::has('educatorPaymentDetails')) {
            $paymentData = $request->session()->get('educatorPaymentDetails');

            $pdf = Pdf::loadView('Educator.pdf.educator_invoice', [
                'data' => $paymentData,
            ]);

            return $pdf->download('educator_invoice.pdf');
        }
        return back();
    }
}