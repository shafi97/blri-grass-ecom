<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'        => 'required|string|max:80',
            'email'       => 'required|email|unique:users,email',
            'image'       => 'nullable|image',
            'phone'       => 'required|max:30',
            'd_o_b'       => 'nullable|date',
            'district_id' => 'required',
            'upazilla_id' => 'required',
            'union_id'    => 'required',
            'post'        => 'nullable',
            'address'     => 'required|max:191',
            'password'    => 'required|confirmed|min:6',
        ];
    }
}
