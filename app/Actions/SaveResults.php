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
        $data = (gettype($data) === 'string' ? json_decode($data) : $data);
        $model = Result::where(['uuid' => Cookie::get(config('site.cookie_name'))]);
        if ($model->exists()) {
            $model->update([
                'data->' . $resultType => $data
            ]);
        } else {
            Result::create([
                'uuid' => Cookie::get(config('site.cookie_name')),
                'data' => [$resultType => $data]
            ]);
        }

        return $data;
    }

    public function asController(StoreResultsRequest $request)
    {
        return $this->handle($request->get('type'), $request->get('data'));
    }
}
