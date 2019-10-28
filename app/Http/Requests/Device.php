<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Device extends ApiRequest
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
            'Device' => 'required|string',
            'Name' => 'required|string',
            'Lat' => 'required',
            'Lon' => 'required',
            'token' => 'required|string',
        ];
    }
}
