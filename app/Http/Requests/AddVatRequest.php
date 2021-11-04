<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddVatRequest extends FormRequest
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
            'seller' => 'required',
            'seller_city' => 'required',
            'seller_street' => 'required',
            'seller_postcode' => 'required',
            'client' => 'required',
            'client_city' => 'required',
            'client_street' => 'required',
            'client_postcode' => 'required',
            'name.*' => 'required',
            'price_netto.*' => 'required',
            'price_brutto.*' => 'required',
            'vat_rate.*' => 'required',
            'count.*' => 'required',
            'unit_of_measure.*' => 'required',
        ];
    }
}
