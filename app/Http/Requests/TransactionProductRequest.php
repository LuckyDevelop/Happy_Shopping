<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Validator;

class TransactionProductRequest extends FormRequest
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
            'product' => 'required',
            'price' => 'required',
            'qty' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'product.required' => 'Nama Produk perlu dipilih.',
            'qty.required' => 'Jumlah Produk perlu diisi.',
            'qty.numeric' => 'Jumlah Produk harus berupa angka.',
            'price.required' => 'Pilih Produk Terlebih Dahulu.',
        ];
    }
}
