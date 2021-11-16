<?php

namespace App\Mail;

use App\customer;
use App\transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class checkout extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;


    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $item = transaction::where('tr_user_id', session('customer_id'))->first();
        // $customer= customer::where('customer_id', session('customer_id'))->first();
        return $this->view('user.mail.checkout',compact('item'))
        ->from('quocmanhs1998@gmail.com','Quốc Mạnh')
        ->subject('Quốc Mạnh')
        ->with($this->data);
    }
}
