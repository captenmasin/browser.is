<?php

namespace App\Mail;

use App\Models\Result;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Results extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Result $results, public string $type = 'home')
    {

    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Results',
        );
    }

    public function content(): Content
    {
        $data = $this->results->data;
        if($this->type !== 'home'){
            $data = [
                $this->type => $data[$this->type]
            ];
        }

        return new Content(
            markdown: 'emails.results',
            with: [
                'data' => $data,
                'url' => route('home', ['uuid' => $this->results->uuid])
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
