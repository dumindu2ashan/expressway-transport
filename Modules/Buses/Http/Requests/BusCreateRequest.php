<?php

namespace Modules\Buses\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BusCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'vehicle_no' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'price_per_km' => 'required|numeric',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
