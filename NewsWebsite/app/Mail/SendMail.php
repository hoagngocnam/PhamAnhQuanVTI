<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.send')
                    ->from('anhquan.dev@gmail.com','Phạm Anh Quân')
                    ->subject('[NewsWebsite] Thư xác nhân đăng ký tài khoản thành công')
                    ->with([
                        'title' => '',
                        'content' => '',
                    ]);
    }
}
