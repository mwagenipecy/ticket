<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OTP extends Mailable
{



    use Queueable, SerializesModels;
    public $link;
    public $name;
    public $otp;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($link,$name,$otp)
    {
        $this->otp=$otp;
        $this->name=$name;
        $this->link=$link;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */

    public function build()
    {
        $name=$this->name;
        $otp=$this->otp;
        $link= $this->link;

//        $name="JOHN KHAMIS";
//        $otp="1234567890";
//        $link="http://96.46.181.165/microfinance/admin/public/login";

        return $this->view('emails.otp')
            ->with(['name' => $name,'otp'=>$otp,'link'=>$link])
            ->subject('');
    }

}
