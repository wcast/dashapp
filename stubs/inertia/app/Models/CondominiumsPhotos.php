<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CondominiumsPhotos extends Model
{
    use HasFactory;

    protected $table = 'condominiums_photos';
    public $primaryKey = 'id';

    protected $fillable = [
        'id',
        'condominium_id',
        'name',
        'photo'
    ];
}
