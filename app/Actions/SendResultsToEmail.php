<?php

namespace App\Actions;

use App\Http\Requests\SendResultsRequest;
use App\Mail\Results;
use App\Models\Result;
use Illuminate\Support\Facades\Mail;
use Lorisleiva\Actions\Concerns\AsAction;

class SendResultsToEmail
{
    use AsAction;

    public function handle(string $email = '', string $uuid = '', string $type = 'home'): int
    {
        $results = Result::where('uuid', $uuid)->first();
        $emails = explode(',', $email);
        Mail::to($emails)->send(new Results($results, $type));

        return 200;
    }

    public function asController(SendResultsRequest $request): int
    {
        return $this->handle($request->get('email'), $request->get('uuid'), $request->get('type'));
    }
}
