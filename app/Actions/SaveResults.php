<?php

namespace App\Actions;

use App\Http\Requests\StoreResultsRequest;
use App\Models\Result;
use Cookie;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

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
                'data' => $currentData
            ]);
        } else {
            Result::create([
                'uuid' => Cookie::get(config('site.cookie_name')),
                'data' => [
                    $resultType => encrypt($data)
                ]
            ]);
        }

        return $data;
    }

    public function asController(StoreResultsRequest $request)
    {
        return $this->handle($request->get('type'), $request->get('data'));
    }
}
