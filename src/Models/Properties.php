<?php

namespace App\Models;

use Brokers;
use Fotos;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Properties extends Model
{
    use HasFactory;

    protected $table = 'properties';
    public $primaryKey = 'id';

    protected $fillable = [
        'id',
        'Codigo',
        'Status',
        'Orulo',
        'AceitaDacao',
        'Finalidade',
        'DescricaoWeb',
        'DataHoraAtualizacao',
        'Situacao',
        'FotoDestaque',
        'CodigoCorretor',
        'Categoria',
        'AnoConstrucao',
        'AptosAndar',
        'AptosEdificio',
        'DataCadastro',
        'EEmpreendimento',
        'CodigoEmpreendimento',
        'Empreendimento',
        'Lancamento',
        'ImovelEmCampanha',
        'ExibirNoSite',
        'Vagas',
        'Exclusivo',
        'DescricaoEmpreendimento',
        'DimensoesTerreno',
        'Imediacoes',
        'Construtora',
        'Endereco',
        'Numero',
        'Complemento',
        'Bairro',
        'Chave',
        'Cidade',
        'CEP',
        'Zona',
        'GaragemTipo',
        'UF',
        'Latitude',
        'Longitude',
        'GMapsLatitude',
        'GMapsLongitude',
        'ValorVenda',
        'ValorLocacao',
        'ValorCondominio',
        'ValorIptu',
        'Dormitorios',
        'Suites',
        'AreaTotal',
        'AreaPrivativa',
        'BanheiroSocialQtd',
        'Caracteristicas',
        'InfraEstrutura',
        'Video',
        'BairroComercial',
        'ValorPermutaImovel',
        'ValorSeguroIncendio',
        'ValorTotalAluguel',
        'QTDGalpoes',
        'QtdVarandas',
        'Bloco',
        'Corretor',
        'CorretorInfo',
        'ImobiliariaCadastro',
        'hash',
        'integrated',
        'slug',
        'url'
    ];

    public function features(): HasMany
    {
        return $this->hasMany(Features::class);
    }

    public function infrastructures(): HasMany
    {
        return $this->hasMany(Infrastructures::class);
    }

    public function fotos()
    {
        return $this->hasMany(Fotos::class);
    }

    public function brokers(): HasMany
    {
        return $this->hasMany(Brokers::class);
    }

}
