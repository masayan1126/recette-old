<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    // コンストラクタはクラスからインスタンスを生成するとき（オブジェクトがnewによって作成されるとき）に自動的に呼び出されるメソッド
    public function __construct($token)
    {
        // 引数でトークンを受け取る
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // 件名
        $subject = 'Reset password mail';

        // コールバックURLをルート名で取得
        // TODO: これだとホットリロードでホストがおかしくなる
        // $url = route('reset-password', ['token' => $this->token]);

        // TODO: とりあえずこれで対応
        // .envの「APP_URL」に設定したurlを取得
        $baseUrl = config('app.url');
        $token = $this->token;
        $url = "http://localhost:8000/reset-password/{$token}";
        // 送信元のアドレス
        // .envの「MAIL_FROM_ADDRESS」に設定したアドレスを取得
        $from = config('mail.from.address');

        return $this->from($from)
            ->subject($subject)
            // 送信メールのビュー
            ->view('mails.reset_password_mail')
            // ビューで使う変数を渡す
            ->with('url', $url);
    }
}