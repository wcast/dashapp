<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Dashapp\Perfil;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Request;
use Laravel\Sanctum\HasApiTokens;
use Ramsey\Uuid\Uuid;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, WithFaker, Uuids;

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

    protected $table = 'users';
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
        'name',
        'email',
        'mobile',
        'phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    private $atributes = [];

    protected static function booted()
    {
        static::creating(fn(Dashapp\User $user) => $user->id = (string)Uuid::uuid4());
    }

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

    public function module()
    {
        return $this->hasMany(UserModule::class, 'user_id', 'id');
    }

    public function perfil()
    {
        return $this->hasOne(Perfil::class, 'id', 'perfil_id');
    }
}
