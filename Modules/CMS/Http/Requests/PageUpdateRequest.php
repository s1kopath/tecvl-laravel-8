<?php

namespace Modules\CMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CheckValidFile;

class PageUpdateRequest extends FormRequest
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
        return
            [
                'name' => 'required|min:3|max:256',
                'slug' => ['required', 'max:191', 'unique:pages,slug,' . $this->id],
                'status' => 'required|in:Active,Inactive',
                'default' => 'nullable|in:1,0'
            ];
    }
}
