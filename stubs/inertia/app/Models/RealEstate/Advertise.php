<?php


use Illuminate\Database\Eloquent\Model;

class Advertise extends Model
{
    protected $fillable = ["type", "name", "email", "phone", "address", "number", "complement", "district", "city", "state", "cep", "category", "bedrooms", "parking", "area", "sale_price", "rent_price", "iptu", "condominium", "notes", "source"];

    public static function rules()
    {
        return [
            "data.name" => "required",
            "data.email" => "required|email",
            "data.phone" => "required",
            "data.city" => "required",
            "data.state" => "required",
            "data.source" => "required",
            "data.documents.*" => "file|max:3072",
            "data.photos.*" => "file|max:3072"
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
            "data.source.required" => "Obrigatório",
            "data.documents.*" => "Um arquivo excedeu o tamanho máximo de 8MB",
            "data.photos.*" => "Um arquivo excedeu o tamanho máximo de 8MB"
        ];
    }
}
