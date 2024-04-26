<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = ["role", "name", "email", "phone", "address", "number", "complement", "district", "city", "state", "cep", "curriculum", "notes", "source"];

    public static function rules()
    {
        return [
            "data.name" => "required",
            "data.email" => "required|email",
            "data.phone" => "required",
            "data.city" => "required",
            "data.state" => "required",
            "data.role" => "required",
            "data.curriculum" => "required",
            "data.source" => "required"
        ];
    }

    public static function messages()
    {
        return [
            "data.name.required" => "Obrigatório",
            "data.email.required" => "Obrigatório",
            "data.email.email" => "Informe um e-mail válido",
            "data.phone.required" => "Obrigatório",
            "data.city.required" => "Obrigatório",
            "data.state.required" => "Obrigatório",
            "data.role.required" => "Obrigatório",
            "data.curriculum.required" => "Obrigatório",
            "data.source.required" => "Obrigatório"
        ];
    }
}
