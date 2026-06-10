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

    public function handle(Tool $type, array $emails = [], string $uuid = ''): int
    {
        $results = Result::where('uuid', $uuid)->first();
        Mail::to($emails)->send(new Results($results, $type));

        return 200;
    }

    /**
     * @throws InvalidEnumMemberException
     */
    public function asController(SendResultsRequest $request): int
    {
        $validated = $request->validated();

        return $this->handle(new Tool($validated['type']), $validated['email'], $validated['uuid']);
    }
}
