<?php

namespace App\Actions;

use Cookie;
use App\Models\Result;
use App\Services\Helpers;
use Lorisleiva\Actions\Concerns\AsAction;
use App\Http\Requests\StoreResultsRequest;

class SaveResults
{
    use AsAction;

    public function handle($resultType = '', $data = [])
    {
        $uuid = Cookie::get(config('site.cookie_name'));
        $model = Helpers::findResult($uuid);
        if ($model !== null) {
            $currentData = $model->data;
            $currentData[$resultType] = encrypt($data);

            $model->update([
                'data' => $currentData,
            ]);
        } else {
            Result::create([
                'uuid' => Helpers::generateId(),
                'data' => [
                    $resultType => encrypt($data),
                ],
            ]);
        }

        return $data;
    }

    public function asController(StoreResultsRequest $request)
    {
        return $this->handle($request->get('type'), $request->get('data'));
    }
}
