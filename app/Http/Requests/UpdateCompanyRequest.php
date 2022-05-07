<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
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
        $id = $this->company;

        return [
            'category_id' => ['sometimes', 'exists:categories,id'],
            'name' => ['sometimes', "unique:companies,name,{$id},id"],
            'whatsapp' => ['sometimes', "unique:companies,whatsapp,{$id},id"],
            'email' => ['sometimes', 'email', "unique:companies,email,{$id},id"],
            'phone' => ['nullable', "unique:companies,phone,{$id},id"],
            'facebook' => ['nullable', "unique:companies,facebook,{$id},id"],
            'instagram' => ['nullable', "unique:companies,instagram,{$id},id"],
            'youtube' => ['nullable', "unique:companies,youtube,{$id},id"],
        ];
    }
}
