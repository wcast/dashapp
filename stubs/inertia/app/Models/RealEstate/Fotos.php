<?php


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fotos extends Model
{
    use HasFactory;

    protected $table = 'fotos';
    public $primaryKey = 'id';

    protected $fillable = [
        'id',
        'properties_id',
        'Ordem',
        'Codigo',
        'ImagemCodigo',
        'Data',
        'Descricao',
        'Destaque',
        'ExibirNoSite',
        'Foto',
        'Tipo'
    ];
}
