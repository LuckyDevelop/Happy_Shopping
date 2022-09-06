<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Validator;

class VoucherRequest extends FormRequest
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
            'type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'type.required' => 'Tipe Voucher perlu dipilih!.',
            'start_date.required' => 'Masa Berlaku Voucher perlu dipilih!.',
            'end_date.required' => 'Masa Berakhir Voucher perlu dipilih!.',
        ];
    }
}
