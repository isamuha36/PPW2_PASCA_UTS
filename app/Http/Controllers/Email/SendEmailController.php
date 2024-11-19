<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\Controller;
use App\Jobs\SendMailJob;
use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;

class SendEmailController extends Controller
{
    public function index()
    {
        return view('email.sendemail');
    }

    // public function store(Request $request)
    // {
    //     $data = $request->all();
    //     dispatch(new SendMailJob($data));
    //     return redirect()->route('email.kirim-email')->with('success', 'Email berhasil dikirim');
    // }

    // public function store(Request $request){
    //     $data = $request->all();
    //     $email = new SendMail($data);
    //     Mail::to($data['email'])->send($email);
    //     return redirect()->route('email.kirim-email')->with('status', 'Email berhasil dikirim');
    // }
    
    public function store(Request $request)
    {
        $data = $request->all();
        // Menggunakan queue untuk mengirim email
        SendMailJob::dispatch($data);
        return redirect()->route('email.kirim-email')->with('status', 'Email sedang diproses dan akan segera dikirim');
    }



}
