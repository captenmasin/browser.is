<?php

namespace App\Actions;

use App\Enums\Tool;
use App\Mail\Results;
use App\Models\Result;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\SendResultsRequest;
use Lorisleiva\Actions\Concerns\AsAction;
use BenSampo\Enum\Exceptions\InvalidEnumMemberException;

class SendResultsToEmail
{
    use AsAction;

    public function handle(Tool $type, string $email = '', string $uuid = ''): int
    {
        $results = Result::where('uuid', $uuid)->first();
        $emails = explode(',', $email);
        Mail::to($emails)->send(new Results($results, $type));

        return 200;
    }

    /**
     * @throws InvalidEnumMemberException
     */
    public function asController(SendResultsRequest $request): int
    {
        return $this->handle(new Tool($request->get('type')), $request->get('email'), $request->get('uuid'));
    }
}
