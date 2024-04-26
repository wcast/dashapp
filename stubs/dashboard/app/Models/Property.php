<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    public static function rules()
    {
        return [
            "data.name" => "required",
            "data.email" => "required|email",
            "data.phone" => "required",
            "data.textMessage" => "required"
        ];
    }

    public static function messages()
    {
        return [
            "data.name.required" => "Obrigatório",
            "data.email.required" => "Obrigatório",
            "data.email.email" => "Informe um e-mail válido",
            "data.phone.required" => "Obrigatório",
            "data.textMessage.required" => "Obrigatório"
        ];
    }
}
