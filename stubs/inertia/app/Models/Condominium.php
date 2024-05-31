<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Request;
use Laravel\Sanctum\HasApiTokens;

class Condominium extends Model
{
    use HasApiTokens, HasFactory, Notifiable, WithFaker;

    /**
     * The database connection that should be used by the model.
     *
     * @var string
     */
    protected $connection = 'mysql';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'condominiums';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'id',
        'name',
        'code',
        'zipcode',
        'slug',
        'logomarca',
        'public_place',
        'number',
        'district',
        'city',
        'state',
        'description',
        'blocks',
        'units',
        'description',
        'new',
        'mapa',
        'latitude',
        'longitude'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [];


    public function search()
    {
        $request = Request::query('search');

        $query = self::query();

        if(isset($request['_value'])){

            $value = $request['_value'];

            foreach ($this->getFillable() as $field) {

                $query->orWhere($field, 'like', '%' . trim($value) . '%');
            }
        }

        return $query;
    }

    public function state()
    {
        return $this->hasOne(State::class, 'id', 'state_id');
    }

    public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }

    public function zipcode()
    {
        return $this->hasOne(Zipcodes::class, 'id', 'zipcode_id');
    }
    public function photos()
    {
        return $this->hasMany(CondominiumsPhotos::class, 'condominium_id', 'id');
    }
    public function unidades()
    {
        return $this->hasMany(Units::class, 'condominium_id', 'id');
    }
    public function atlantida()
    {
        return $this->hasOne(Atlantida::class, 'id', 'atlantida_id');
    }

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
