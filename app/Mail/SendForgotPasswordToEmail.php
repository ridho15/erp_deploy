<?php

namespace App\Mail;

use App\Http\Controllers\CryptController;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendForgotPasswordToEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user;
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $crypt = new CryptController;
        $carbon = Carbon::now()->addMinutes(30);
        $data['user'] = $this->user;
        $dataToken = json_encode([
            'id' => $this->user->id,
            'email' => $this->user->email,
            'expired_at' => $carbon->format('Y-m-d H:i:s')
        ]);
        $token = $crypt->crypt($dataToken);
        $data['token'] = $token;
        $data['url'] = url('/reset-ulang-password/' . $token);
        return $this->from('noreply@coba.medialatihan.com')->view('mail.send-forgot-password', $data);
    }
}
