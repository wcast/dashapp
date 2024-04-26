<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Request;
use Laravel\Sanctum\HasApiTokens;

class Atlantida extends Model
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
    protected $table = 'atlantida';

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
        'description'
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
    public function condominiums()
    {
        return $this->hasMany(Condominium::class, 'atlantida_id', 'id');
    }
}
