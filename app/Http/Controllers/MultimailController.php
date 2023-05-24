<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\Multimail;
use App\Jobs\SendMulitimail;
use Illuminate\Support\Facades\Mail;

class MultimailController extends Controller
{
    public function index(){
        return view('Multimail');
    }
    public function send(Request $request)
    {
     $this->validate($request, [
      'email'  =>  'required',
      'message' =>  'required',
     ]);
     $admin_email = $request->email;
     $multimail = (explode(",",$admin_email));
     for($count = 0; $count < count($multimail); $count++)
     {
      $data[] = array(
            'message' =>   $request->message,
            'email'   =>  $multimail[$count] );  }
    foreach($data as $d){
    $demail = $d['email'];
    // Mail::to($demail)->send(new Multimail($d));
    SendMulitimail::dispatch($d,$demail)->delay(now()->addSeconds(10));
    }
    return redirect('multimail')->with('success', 'Mail has been sent successfully!');
}
}
