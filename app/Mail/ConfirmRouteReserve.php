<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmRouteReserve extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
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
        return $this->from(env('MAIL_USERNAME'))->subject('Confirmación de ruta')
                    ->view('livewire.administrator.routes.mailConfirmRouteReserve');
    }
}
