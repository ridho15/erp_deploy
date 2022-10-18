<?php

namespace App\Mail;

use App\Models\Quotation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendQuotationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $quotation;
    public function __construct($id_quotation)
    {
        $this->quotation = Quotation::find($id_quotation);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data['quotation'] = $this->quotation;
        return $this->from('coba@medialatihan.com')->view('mail.send-quotation', $data);
    }
}
