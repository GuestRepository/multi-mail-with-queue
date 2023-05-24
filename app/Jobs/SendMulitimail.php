<?php

namespace App\Jobs;

use App\Mail\Multimail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Log;

class SendMulitimail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $d;
    public $demail;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($d,$demail)
    {
        $this->d = $d;
        $this->demail = $demail;
        // Log::info('we are getting values in jobs'.print_r($d,true));
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->demail)->send(new Multimail($this->d));
        
    }
}
