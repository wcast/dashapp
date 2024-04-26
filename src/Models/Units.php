<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Request;
use Laravel\Sanctum\HasApiTokens;

class Units extends Authenticatable
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */

    public $timestamps = true;
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

    protected $table = 'units';
    /**
     * The primary key associated with the table.
     *
     * @var string
     */

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'id',
        'condominium_id',
        'code',
        'status'
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

    private $atributes = [];

    public function search()
    {
        $request = Request::query('search');

        $query = self::query();

        if(isset($request['_value'])){

            $value = $request['_value'];

            foreach ($this->getFillable() as $field) {

                $query->orWhere("u.".$field, 'like', '%' . trim($value) . '%');
            }
        }

        return $query;
    }

    public function condominium()
    {
        return $this->hasOne(Condominium::class, 'id', 'condominium_id');
    }
}
