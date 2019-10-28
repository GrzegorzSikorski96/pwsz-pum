<?php

namespace App\Http\Requests;

class Measurement extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'PM1' => 'required|integer',
            'PM25' => 'required|integer',
            'PM10' => 'required|integer',
            'AveragePM1' => 'required|integer',
            'AveragePM25' => 'required|integer',
            'AveragePM10' => 'required|integer',
            'Temperature' => 'required|float',
            'Humidity' => 'required|integer',
            'IJPString' => 'required|string',
            'IJPDescription' => 'required|string',
        ];
    }
}
