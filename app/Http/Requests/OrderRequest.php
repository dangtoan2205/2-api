<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'customer_name' => 'required|string',
            'customer_phone' => 'required',
            'customer_address' => 'required',
            'customer_email' => 'required|email',
        ];
    }
    public function messages()
    {
        return [
            'customer_name.required' => 'Quý khách vui lòng nhập tên',
            'customer_phone.required' => 'Quý khách vui lòng nhập số điện thoại',
            'customer_address.required' => 'Quý khách vui lòng nhập địa chỉ',
            'customer_email.required' => 'Quý khách vui lòng nhập email'
        ];
    }

}
