<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Integration extends Model
{
    use HasFactory;

    protected $table = 'integration';
    public $primaryKey = 'id';

    protected $fillable = [
        'id',
        'ativo',
        'data_inicio',
        'data_termino',
        'tempo',
        'ip'
    ];
}
