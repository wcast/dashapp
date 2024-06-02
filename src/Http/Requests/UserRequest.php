<?php

namespace App\Http\Requests;

use App\Models\Dashapp\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:255'
            ],
            'email' => [
                'required',
                'email', 'max:255',
                Rule::unique(User::class)->ignore($this->id)
            ],
            'phone' => [
                'string'
            ],
            'mobile' => [
                'required',
                'string',
                'max:255'
            ],
            'avatar' => [
                'string'
            ],
            'perfil_id' => [
                'required',
                'integer'
            ]
        ];
    }
}
