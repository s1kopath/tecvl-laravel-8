<?php

namespace Modules\Refund\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RefundProcessRequest extends FormRequest
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
            'refund_id' => 'required|numeric|exists:refunds,id',
            'note' => 'required|string|min:3|max:1000'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'note' => __('Message'),
        ];
    }
}
