<?php

namespace App\Mail;

use App\Enums\Tool;
use App\Models\Result;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Results extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Result $results, public Tool $type)
    {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Results',
        );
    }

    public function content(): Content
    {
        $data = decrypt($this->results->data);
        if($this->type->value !== Tool::All){
            $data = [
                $this->type->value => $data[$this->type->value]
            ];
        }

        foreach ($data as $key => $datum){
            $data[$key] = json_decode($datum, true);
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
