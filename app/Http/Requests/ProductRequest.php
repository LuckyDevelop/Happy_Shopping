<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Validator;

class ProductRequest extends FormRequest
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
            'product_name' => 'required',
            'category' => 'required',
            'price' => 'required',
            'purchase_price' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'product_name.required' => 'Produk perlu diisi.',
            'category.required' => 'Kategori perlu dipilih!.',
            'price.required' => 'Harga Jual perlu diisi.',
            'purchase_price.required' => 'Harga Beli perlu diisi.',
        ];
    }
}
