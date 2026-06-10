<?php

use App\Enums\Tool;
use App\Models\Result;
use Illuminate\Support\Str;
use App\Mail\Results as ResultsMail;
use Illuminate\Support\Facades\Mail;

it('sends results to comma separated email recipients', function () {
    $this->withoutExceptionHandling();
    Mail::fake();

    $uuid = (string) Str::uuid();

    Result::create([
        'uuid' => $uuid,
        'data' => [
            Tool::Browser => encrypt(json_encode([
                'name' => [
                    'label' => 'Name',
                    'description' => '',
                    'value' => 'Safari',
                ],
            ])),
        ],
    ]);

    $token = 'test-token';

    $this->withSession(['_token' => $token])->postJson(route('api.notify'), [
        'email' => 'first@example.com, second@example.com',
        'uuid' => $uuid,
        'type' => Tool::Browser,
        '_token' => $token,
    ])->assertOk();

    Mail::assertSent(ResultsMail::class, function (ResultsMail $mail) {
        return $mail->hasTo('first@example.com')
            && $mail->hasTo('second@example.com');
    });
});

it('renders saved encrypted result data in the results email', function () {
    $result = Result::create([
        'uuid' => (string) Str::uuid(),
        'data' => [
            Tool::Browser => encrypt(json_encode([
                'name' => [
                    'label' => 'Name',
                    'description' => '',
                    'value' => 'Safari',
                ],
            ])),
        ],
    ]);

    expect((new ResultsMail($result, new Tool(Tool::Browser)))->render())
        ->toContain('Safari');
});
