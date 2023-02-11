<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'name'            => 'required|max:255',
            'category_id'     => 'required',
            'sub_category_id' => 'nullable',
            'weight'          => 'required|string|max:32',
            'weight_unit'     => 'required|string|max:32',
            'd_o_b'           => 'nullable|date',
            'size'            => 'nullable|string|max:191',
            'color'           => 'nullable|string|max:191',
            'quantity'        => 'nullable|integer',
            'price'           => 'required',
            'discount'        => 'nullable',
            'product_code'    => 'nullable|string|max:191',
            'description'     => 'nullable|string',
        ];
    }
}
