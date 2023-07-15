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
        $model = Result::where(['uuid' => Cookie::get(config('site.cookie_name'))]);
        if ($model->exists()) {
            $model->update([
                'data->' . $resultType => json_decode(json_encode($data), true)
            ]);
        } else {
            Result::create([
                'uuid' => Cookie::get(config('site.cookie_name')),
                'data' => json_decode(json_encode([$resultType => $data]), true)
            ]);
        }

        return $data;
    }

    public function asController(StoreResultsRequest $request)
    {
        return $this->handle($request->get('type'), $request->get('data'));
    }
}
