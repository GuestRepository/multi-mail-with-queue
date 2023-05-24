<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Multimail extends Mailable
{
    use Queueable, SerializesModels;
    public $d;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    
     public function __construct($d) {
        $this->d = $d; }

    public function build()
    {
        return $this->from('info@testing.com')
        ->subject('New Message')
        ->view('multi_email_template')
        ->with('d', $this->d);
    }
}
