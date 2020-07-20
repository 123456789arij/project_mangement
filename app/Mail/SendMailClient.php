<?php


namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailClient extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
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
        return $this->view('emails.sendmail')
            ->from($this->data['address_from'], $this->data['name_from'])
            ->to($this->data['address_to'], $this->data['name_to'])
            ->subject($this->data['subject'])
            ->with([
                'title' => $this->data['title'],
                'body' => $this->data['body'],
            ]);
    }
}
