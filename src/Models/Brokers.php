<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brokers extends Model
{
    use HasFactory;

    protected $table = 'brokers';
    public $primaryKey = 'id';

    protected $fillable = [
        'id',
        'Codigo',
        'Datacadastro',
        'Nascimento',
        'Nacionalidade',
        'CNH',
        'Celular',
        'Endereco',
        'Bairro',
        'Cidade',
        'UF',
        'CEP',
        'Agenciamento',
        'Fone',
        'Fax',
        'E-mail',
        'Nome',
        'Observacoes',
        'Empresa',
        'Celular1',
        'Celular2',
        'Corretor',
        'Nomecompleto',
        'Ramal',
        'Sexo',
        'Inativo',
        'CRECI',
        'Estadocivil',
        'Diretor',
        'FonePessoal',
        'Experiencia',
        'Chat',
        'Atuaçãoemvenda',
        'Atuaçãoemlocação',
        'RamalImobiliaria',
        'FoneContatoComercial',
        'TemPerfil',
        'TemEmail',
        'Atendimento',
        'CodigoAgencia',
        'Email',
        'Foto',
        'hash',
        'integrated',
        'url'
    ];

    public function properties(): HasMany
    {
        return $this->hasMany(Properties::class);
    }
}
