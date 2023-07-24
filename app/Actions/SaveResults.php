<?php

namespace App\Actions;

use Cookie;
use App\Models\Result;
use Lorisleiva\Actions\Concerns\AsAction;
use App\Http\Requests\StoreResultsRequest;

class SaveResults
{
    use AsAction;

    public function handle($resultType = '', $data = [])
    {
        $uuid = Cookie::get(config('site.cookie_name'));
        $model = Result::where(['uuid' => $uuid]);
        if ($model->exists()) {
            $currentData = $model->first()->data;
            $currentData[$resultType] = encrypt($data);

            $model->update([
                'data' => $currentData,
            ]);
        } else {
            Result::create([
                'uuid' => Cookie::get(config('site.cookie_name')),
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
