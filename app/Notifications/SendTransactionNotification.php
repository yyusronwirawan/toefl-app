<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramMessage;

class SendTransactionNotification extends Notification
{
    use Queueable;

    protected $transaction;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // return ['mail'];
        return ['telegram'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    public function toTelegram($notifiable)
    {
        $content = 'Transaksi Terbaru'.PHP_EOL;
        $content .= 'No Invoice: '.$this->transaction->code.PHP_EOL;
        $content .= 'Tanggal Invoice : '.$this->transaction->created_at.PHP_EOL;
        $content .= 'Nama Peserta: '.$this->transaction->user->name.PHP_EOL;
        $content .= 'Email User: '.$this->transaction->user->email.PHP_EOL;
        $content .= 'Judul Ujian: '.$this->transaction->exam->title.PHP_EOL;
        $content .= 'Total Pembayaran: '.number_format($this->transaction->total_purchases).PHP_EOL;

        return TelegramMessage::create()
        ->to(env('TELEGRAM_BOT_GROUPID', '-877834897'))
            ->content($content);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
