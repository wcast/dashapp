<?php

namespace App\Repositories;

use App\Models\Dashapp\Integration;
use Brokers;
use Fotos;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Properties;

class VistaApiRepository
{
    public $host = '';
    public $api_entity = '';
    public $api_key = '';
    public $file = '';
    public $file_name = '';
    public $imoveis = [];
    public $start_date = '';
    public $end_date = '';
    public $last_integration = '';
    public $full_integration = false;

    public function __construct()
    {
        date_default_timezone_set('America/Sao_Paulo');
        ini_set('memory_limit', -1);
        ini_set('display_errors', 0);
        ini_set('display_startup_errors', 0);
        $this->host = Config::get('app.url');
        $this->api_entity = 'luigiant18881';
        $this->api_key = '2a966a9a278c4a553200f60358e104d3';
        $this->file = 'tmp/vista' . uniqid() . '.json';
        $this->last_integration = date("Y-m-d+00:00:00");
        Log::error("API Vista - Ultima integração em : {$this->last_integration}");
    }

    public function formatDate($dataHoraBrasil = null)
    {
        $formatoEntrada = 'd/m/Y H:i:s';
        $dataHora = \DateTime::createFromFormat($formatoEntrada, $dataHoraBrasil, new \DateTimeZone('America/Sao_Paulo'));
        if ($dataHora) {
            $dataHora->setTimezone(new \DateTimeZone('America/Sao_Paulo'));
            $formatoSaida = 'Y-m-d H:i:s'; // Formato de saída desejado
            $dataHoraFormatada = $dataHora->format($formatoSaida);
            return $dataHoraFormatada;
        } else {
            return null;
        }
    }

    public function stringToDecimal($v)
    {
        $v = str_replace("R$ ", "", $v);
        $v = str_replace(".", "", $v);
        $v = str_replace(",", ".", $v);
        return $v;
    }

    public function sanitizeString($string)
    {
        // matriz de entrada
        $what = array('ä', 'ã', 'à', 'á', 'â', 'ê', 'ë', 'è', 'é', 'ï', 'ì', 'í', 'ö', 'õ', 'ò', 'ó', 'ô', 'ü', 'ù', 'ú', 'û', 'Ã', 'À', 'Á', 'Ẽ', 'Ê', 'É', 'Í', 'Õ', 'Ó', 'Ú', 'ñ', 'Ñ', 'ç', 'Ç', '-', '(', ')', ',', ';', ':', '|', '!', '"', '#', '$', '%', '&', '/', '=', '?', '~', '^', '>', '<', 'ª', 'º');

        // matriz de saída
        $by = array('a', 'a', 'a', 'a', 'a', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'A', 'A', 'A', 'E', 'E', 'E', 'I', 'O', 'O', 'U', 'n', 'n', 'c', 'C', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ');

        // devolver a string
        return str_replace($what, $by, $string);
    }

    public function vistaFields()
    {
        $return = $this->getData("/imoveis/listarcampos?key={$this->api_key}");
        print_r(json_decode($return));
        return $return;
    }

    public function checkAmountPages()
    {
        $pagina = 1;
        $quantidade = 50;
        $jayParsedAry = [
            "order" => [],
            "fields" => [
                "Codigo"
            ],
            "filter" => [
                "ExibirNoSite" => "Sim",
                "DataHoraAtualizacao" => [
                    ">=",
                    $this->last_integration
                ]
            ],
            "paginacao" => [
                "pagina" => $pagina,
                "quantidade" => $quantidade
            ]
        ];

        if($this->full_integration){
            unset($jayParsedAry['filter']['DataHoraAtualizacao']);
        }

        if($this->full_integration){
            Log::error("Modo FULL");
        }

        $json = json_encode($jayParsedAry);
        $url = "/imoveis/listar?key={$this->api_key}&pesquisa={$json}&showtotal=1";
        $return = json_decode($this->getData($url), true);
        if (isset($return['status']) && $return['status'] != 200) {
            Log::error("Erro ao contar páginas dos imóveis {$return['message']}, tentando novamente em 60s");
            sleep(60);
            $this->make();
        }

        if (isset($return['total'])) {
            $data = [
                'total' => $return['total'],
                'paginas' => $return['paginas'],
                'pagina' => $return['pagina'],
                'quantidade' => $return['quantidade']
            ];

        } else {

            $data = false;
        }

        if(isset($return['total'])){
            Log::error("Total de registros:  {$return['total']}");
        }

        return $data;
    }

    public function getData($endpoint = '')
    {
        set_time_limit(0);

        try {
            $url = 'https://' . $this->api_entity . '-rest.vistahost.com.br' . $endpoint;
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 400);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
            $result = curl_exec($ch);
            $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            if ($statusCode != 200) {
                $error_msg = curl_error($ch);
                Log::error("ERRO {$statusCode} {$error_msg}");
                return [];
            } else {
                return $result;
            }
        } catch (\Exception $exception) {
            Log::error("ERRO {$exception->getMessage()}");
        }
    }

    public function getPage($pagina)
    {
        $quantidade = 50;
        $jayParsedAry = [
            "order" => [],
            "fields" => [
                "Codigo"
            ],
            "filter" => [
                "ExibirNoSite" => "Sim",
                "DataHoraAtualizacao" => [
                    ">=",
                    $this->last_integration
                ]
            ],
            "paginacao" => [
                "pagina" => $pagina,
                "quantidade" => $quantidade
            ]
        ];

        if($this->full_integration){
            unset($jayParsedAry['filter']['DataHoraAtualizacao']);
        }

        $json = json_encode($jayParsedAry);
        $url = "/imoveis/listar?key={$this->api_key}&pesquisa={$json}";
        $return = json_decode($this->getData($url), true);
        unset($return['pagina']);
        unset($return['total']);
        unset($return['paginas']);
        unset($return['quantidade']);
        return $return;
    }

    public function getCorretor($Codigo = '')
    {
        $array = [
            "fields" => ["Nome", "Celular", "Celular1", "CRECI", "Email", "Fone", "Foto", "Observacoes"],
            "filter" => ["Codigo" => $Codigo],
            "paginacao" => ["pagina" => 1, "quantidade" => 1]
        ];
        $json = json_encode($array);
        $url = "/usuarios/listar?key={$this->api_key}&pesquisa={$json}";
        $return = json_decode($this->getData($url), true);
        unset($return['pagina']);
        unset($return['total']);
        unset($return['paginas']);
        unset($return['quantidade']);
        return $return;
    }

    public function getDetails($codigo = '')
    {
        $array = [
            'fields' =>
                array_merge([
                        'Codigo',
                        'Status',
                        'Orulo',
                        'AceitaDacao',
                        'Corretor',
                        'Finalidade',
                        'DataHoraAtualizacao',
                        'Situacao',
                        'FotoDestaque',
                        'DescricaoWeb',
                        'CodigoCorretor',
                        'Categoria',
                        'AnoConstrucao',
                        'AptosAndar',
                        'AptosEdificio',
                        'DataCadastro',
                        'EEmpreendimento',
                        'ImovelEmCampanha',
                        'CodigoEmpreendimento',
                        'Empreendimento',
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
                        'BairroComercial',
                        'CEP',
                        'Zona',
                        'GaragemTipo',
                        'UF',
                        'ValorVenda',
                        'ValorLocacao',
                        'ValorCondominio',
                        'ValorIptu',
                        'ValorSeguroIncendio',
                        'ValorPermutaImovel',
                        'ValorTotalAluguel',
                        'QTDGalpoes',
                        'QtdVarandas',
                        'Dormitorios',
                        'Suites',
                        'Vagas',
                        'AreaTotal',
                        'AreaPrivativa',
                        'BanheiroSocialQtd',
                        'Bloco',
                        'URLVideo',
                        'Latitude',
                        'Longitude',
                        'GMapsLatitude',
                        'GMapsLongitude',
                        // 'Caracteristicas',
                        // 'InfraEstrutura',
                        'ImobiliariaCadastro',
                        ['Foto' => ["Ordem", "Codigo", "ImagemCodigo", "Data", "Descricao", "Destaque", "ExibirNoSite", "ExibirSite", "Foto", "Tipo"]],
                        ['Video' => ['Codigo', 'Destaque', 'VideoCodigo', 'Descricao', 'Video']]
                    ]
                ),
            'filter' => array_merge(
                [
                    'Status' => ['Venda', 'Venda e Aluguel', 'Aluguel'],
                ]
            ),
        ];
        $query = htmlentities(urlencode(json_encode($array)));
        $endpoint = "/imoveis/detalhes?key={$this->api_key}&imovel={$codigo}&pesquisa={$query}";
        $array = json_decode($this->getData($endpoint), true);
        unset($array['pagina']);
        unset($array['total']);
        unset($array['paginas']);
        unset($array['quantidade']);
        return $array;
    }

    public function makeFull()
    {
        $this->full_integration = true;
        $this->make();
    }

    public function make()
    {
        $this->start_date = date("Y-m-d H:i:s");

         DB::table('integration')
            ->where('id', 1)
            ->update([
                'ativo' => 1,
                'data_inicio' => $this->start_date,
                'tempo' => 0
            ]);

        Log::info('API Vista Início: ' . date("d/m/Y H:i:s", strtotime($this->start_date)));

        $count_imoveis = 0;
        $amount = $this->checkAmountPages();

        if ($amount) {
            $erro_data = [];
            $pagina = 0;

            //$amount['paginas'] = 1;

            for ($i = 1; $i <= $amount['paginas']; $i++) {
                $pages = $this->getPage($i);
                foreach ($pages as $key => $page) {
                    if ($pagina != $i) {
                        Log::info("Consultado Página: {$i}");
                    }
                    $pagina = $i;
                    $imovel = $this->getDetails($key);
                    if (isset($imovel['Codigo'])) {
                        $url = Config::get('app.url');
                        $slug = $this->setSlug($imovel);
                        $imovel['slug'] = $slug;
                        $imovel['url'] = "{$url}/{$slug}/{$imovel['Codigo']}";
                        $imovel['integrated'] = 1;
                        $imovel['Foto'] = json_encode($imovel['Foto']);
                        $imovel['Video'] = json_encode($imovel['Video']);
                        $imovel['Corretor'] = intval($imovel['Corretor']);
                        $imovel['CorretorInfo'] = json_encode(array_values($this->getCorretor($imovel['Corretor'])));
                        $imovel['ValorIptu'] = floatval($imovel['ValorIptu']);
                        $imovel['ValorCondominio'] = floatval($imovel['ValorCondominio']);
                        $imovel['ValorVenda'] = floatval($imovel['ValorVenda']);
                        $imovel['ValorLocacao'] = floatval($imovel['ValorLocacao']);
                        $imovel['ValorSeguroIncendio'] = floatval($imovel['ValorSeguroIncendio']);
                        $imovel['ValorTotalAluguel'] = floatval($imovel['ValorTotalAluguel']);
                        $imovel['AreaPrivativa'] = floatval($imovel['AreaPrivativa']);
                        $imovel['AreaTotal'] = floatval($imovel['AreaTotal']);
                        $imovel['AptosAndar'] = intval($imovel['AptosAndar']);
                        $imovel['Dormitorios'] = intval($imovel['Dormitorios']);
                        $imovel['QTDGalpoes'] = intval($imovel['QTDGalpoes']);
                        $imovel['QtdVarandas'] = intval($imovel['QtdVarandas']);
                        $imovel['BanheiroSocialQtd'] = intval($imovel['BanheiroSocialQtd']);
                        $imovel['Suites'] = intval($imovel['Suites']);
                        $imovel['Vagas'] = intval($imovel['Vagas']);
                        $imovel['hash'] = md5(json_encode($imovel));
                        $this->imoveis[] = $imovel;
                        $count_imoveis++;
                    } else {
                        $erro_data[] = $key;
                    }
                }

                if (count($erro_data) > 0) {
                    sleep(10);
                    foreach ($erro_data as $key) {
                        $imovel = $this->getDetails($key);
                        Log::info("Reavendo imovel não indexado: {$key}");
                        if (isset($imovel['Codigo'])) {
                            $url = Config::get('app.url');
                            $slug = $this->setSlug($imovel);
                            $imovel['slug'] = $slug;
                            $imovel['url'] = "{$url}/{$slug}/{$imovel['Codigo']}";
                            $imovel['integrated'] = 1;
                            $imovel['Foto'] = json_encode($imovel['Foto']);
                            $imovel['Video'] = json_encode($imovel['Video']);
                            $imovel['Corretor'] = intval($imovel['Corretor']);
                            $imovel['CorretorInfo'] = json_encode(array_values($this->getCorretor($imovel['Corretor'])));
                            $imovel['ValorIptu'] = floatval($imovel['ValorIptu']);
                            $imovel['ValorCondominio'] = floatval($imovel['ValorCondominio']);
                            $imovel['ValorVenda'] = floatval($imovel['ValorVenda']);
                            $imovel['ValorLocacao'] = floatval($imovel['ValorLocacao']);
                            $imovel['ValorSeguroIncendio'] = floatval($imovel['ValorSeguroIncendio']);
                            $imovel['ValorTotalAluguel'] = floatval($imovel['ValorTotalAluguel']);
                            $imovel['AreaPrivativa'] = floatval($imovel['AreaPrivativa']);
                            $imovel['AreaTotal'] = floatval($imovel['AreaTotal']);
                            $imovel['AptosAndar'] = intval($imovel['AptosAndar']);
                            $imovel['Dormitorios'] = intval($imovel['Dormitorios']);
                            $imovel['QTDGalpoes'] = intval($imovel['QTDGalpoes']);
                            $imovel['QtdVarandas'] = intval($imovel['QtdVarandas']);
                            $imovel['BanheiroSocialQtd'] = intval($imovel['BanheiroSocialQtd']);
                            $imovel['Suites'] = intval($imovel['Suites']);
                            $imovel['Vagas'] = intval($imovel['Vagas']);
                            $imovel['hash'] = md5(json_encode($imovel));
                            $this->imoveis[] = $imovel;
                            $count_imoveis++;
                        }
                    }
                    $erro_data = [];
                }
            }

            Log::info("Data Vista com {$count_imoveis} imóveis.");

        } else {
            DB::table('integration')
                ->where('id', 1)
                ->update(['ativo' => 0, 'data_inicio' => $this->start_date]);
            Log::info("Data Vista sem imóveis para autalizar.");
        }
    }

    public function setSlug($fields)
    {
        $strHelper = new Str();
        $string = "{$fields["Status"]}
                           {$fields["Categoria"]}
                           {$fields["BairroComercial"]}
                           {$fields["Cidade"]}";
        return $strHelper->of($string)->slug("-");
    }

    public function saveData()
    {
        try {

            if (count($this->imoveis)) {

                $existe = false;

                foreach ($this->imoveis as $imovel) {
                    $existe = Properties::query()->where('Codigo', trim($imovel['Codigo']))->first();
                    if (is_null($existe)) {
                        try {
                            $fotos = json_decode($imovel['Foto'], true);
                            $properties = Properties::create($imovel);
                            foreach ($fotos as $foto) {
                                $foto['Data'] = ($foto['Data'] == '') ? date("Y-m-d") : $foto['Data'];
                                $foto['properties_id'] = $properties->id;
                                Fotos::create($foto);
                            }
                            Log::info("Imóvel: {$properties['Codigo']} inserido.");
                        } catch (\Exception $e) {
                            Log::error("Erro ao inserir o imóvel {$imovel['Codigo']}: .Erro {$e}");
                        }
                    }
                }

                $this->end_date = date("Y-m-d H:i:s");

                $start_date = strtotime($this->start_date);
                $end_date = strtotime($this->end_date);
                $diff = ($end_date - $start_date);
                $seconds = $diff;

                $minutes = round($diff / 60);
                $hours = round($diff / 3600);
                $tempo = '';

                if ($seconds <= 60) {
                    if ($seconds == 1) {
                        $tempo = "1 segundo";
                    } else {
                        $tempo = "$seconds segundos";
                    }
                } else if ($minutes <= 60) {
                    if ($minutes == 1) {
                        $tempo = "1 min";
                    } else {
                        $tempo = "$minutes minutos";
                    }
                } else if ($hours <= 24) {
                    if ($hours == 1) {
                        $tempo = "1 Hora";
                    } else {
                        $tempo = "$hours Horas";
                    }
                }

                DB::table('integration')
                    ->where('id', 1)
                    ->update([
                        'ativo' => 0,
                        'data_termino' => $this->end_date,
                        'tempo' => $tempo
                    ]);

                Log::info('API Vista Finalizado: ' . date("d/m/Y H:i:s", strtotime($this->end_date)) . ' Tempo de atualização: ' . $tempo);

            } else {
                Log::info("Sem imóveis para autalizar.");
                Log::info('API Vista Finalizado - Nenhuma alteração foi realizada');
            }
        } catch (\Exception $e) {
            Log::info("Erro ao persistir data: {$e->getMessage()}");
        }
    }

    public function checkProperties()
    {
        $excluidos = 0;
        $excluidos_array = [];
        Log::info("Limpa imóveis excluídos");
        $properties = DB::table('properties')->select('id','Codigo')->get();
        $count = count($properties);
        Log::info("Total de imóveis $count");
        foreach ($properties as $property) {
            $existe_imovel = $this->getDetails($property->Codigo);
            if (!isset($existe_imovel['Codigo'])) {
                DB::table('fotos')->where('properties_id', $property->id)->delete();
                DB::table('properties')->where('id', $property->id)->delete();
                Log::info("===============> Excluindo imóvel... {$property->Codigo}");
                $excluidos_array[] = $property->Codigo;
                $excluidos++;
            } else {
                Log::info("{$property->Codigo} Ok!");
            }
        }

        Log::info("{$excluidos} Imóveis excluídos: " . json_encode($excluidos_array));

        if (count($excluidos_array) > 0) {

            Log::info("Confirmando Imóveis excluídos");

            foreach ($excluidos_array as $key) {

                Log::info("Reavendo imovel não indexado: {$key}");

                $imovel = $this->getDetails($key);

                if (isset($imovel['Codigo'])) {

                    $url = Config::get('app.url');

                    $slug = $this->setSlug($imovel);

                    $imovel['slug'] = $slug;
                    $imovel['url'] = "{$url}/{$slug}/{$imovel['Codigo']}";
                    $imovel['integrated'] = 1;
                    $imovel['Caracteristicas'] = json_encode($imovel['Caracteristicas']);
                    $imovel['InfraEstrutura'] = json_encode($imovel['InfraEstrutura']);
                    $imovel['Foto'] = json_encode($imovel['Foto']);
                    $imovel['Video'] = json_encode($imovel['Video']);
                    $imovel['Corretor'] = intval($imovel['Corretor']);
                    $imovel['CorretorInfo'] = json_encode(array_values($this->getCorretor($imovel['Corretor'])));
                    $imovel['ValorIptu'] = floatval($imovel['ValorIptu']);
                    $imovel['ValorCondominio'] = floatval($imovel['ValorCondominio']);
                    $imovel['ValorVenda'] = floatval($imovel['ValorVenda']);
                    $imovel['ValorLocacao'] = floatval($imovel['ValorLocacao']);
                    $imovel['ValorSeguroIncendio'] = floatval($imovel['ValorSeguroIncendio']);
                    $imovel['ValorTotalAluguel'] = floatval($imovel['ValorTotalAluguel']);
                    $imovel['AreaPrivativa'] = floatval($imovel['AreaPrivativa']);
                    $imovel['AreaTotal'] = floatval($imovel['AreaTotal']);
                    $imovel['AptosAndar'] = intval($imovel['AptosAndar']);
                    $imovel['Dormitorios'] = intval($imovel['Dormitorios']);
                    $imovel['QTDGalpoes'] = intval($imovel['QTDGalpoes']);
                    $imovel['QtdVarandas'] = intval($imovel['QtdVarandas']);
                    $imovel['BanheiroSocialQtd'] = intval($imovel['BanheiroSocialQtd']);
                    $imovel['Suites'] = intval($imovel['Suites']);
                    $imovel['Vagas'] = intval($imovel['Vagas']);
                    $imovel['hash'] = md5(json_encode($imovel));
                    try {
                        $existe = Properties::query()->where('Codigo', trim($imovel['Codigo']))->first();
                        if (is_null($existe)) {
                            $fotos = json_decode($imovel['Foto'], true);
                            $properties = Properties::create($imovel);
                            foreach ($fotos as $foto) {
                                $foto['Data'] = ($foto['Data'] == '') ? date("Y-m-d") : $foto['Data'];
                                $foto['properties_id'] = $properties->id;
                                $ft = Fotos::create($foto);
                            }
                            Log::info("Imóvel: {$properties['Codigo']} re-inserido.");
                        }
                    } catch (\Exception $e) {

                        Log::error("Erro ao inserir o imóvel {$imovel['Codigo']}: .Erro {$e}");
                    }
                }
            }
        }
    }

    public function makeBrokers()
    {
        $jayParsedAry = [
            "fields" => [
                "Datacadastro",
                "Nascimento",
                "Nacionalidade",
                "CNH",
                "Celular",
                "Endereco",
                "Bairro",
                "Cidade",
                "UF",
                "CEP",
                "Agenciamento",
                "Fone",
                "Fax",
                "E-mail",
                "Nome",
                "Observacoes",
                "Empresa",
                "Codigo",
                "Celular1",
                "Celular2",
                "Corretor",
                "Nomecompleto",
                "Ramal",
                "Sexo",
                "Inativo",
                "CRECI",
                "Diretor",
                "FonePessoal",
                "Experiencia",
                "Chat",
                "Atuaçãoemvenda",
                "Atuaçãoemlocação",
                "RamalImobiliaria",
                "FoneContatoComercial",
                "TemPerfil",
                "TemEmail",
                "Atendimento",
                "CodigoAgencia",
                "Email",
                "Foto"
            ],
            "filter" => [
                "Administrativo" => "Nao",
                "Atuaçãoemvenda" => "Sim",
                "Atuaçãoemlocação" => "Nao"
            ],
            "order" => [
                "Nome" => "asc"
            ],
            "paginacao" => [
                "pagina" => 1,
                "quantidade" => 1
            ]
        ];

        $curl = curl_init(env("VISTA_API_URL") . "/usuarios/listar?key=" . env("VISTA_API_KEY") . "&pesquisa=" . json_encode($jayParsedAry) . "&showtotal=1");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, True);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
        $result = curl_exec($curl);
        curl_close($curl);
        $return = json_decode($result, true);

        $paginas = $return['paginas'];

        if (isset($return['total'])) {
            for ($i = 1; $i <= $paginas; $i++) {

                $jayParsedAry = [
                    "fields" => [
                        "Datacadastro",
                        "Celular",
                        "Fone",
                        "E-mail",
                        "Nome",
                        "Observacoes",
                        "Codigo",
                        "Celular1",
                        "Corretor",
                        "Nomecompleto",
                        "Ramal",
                        "CRECI",
                        "Atuaçãoemvenda",
                        "Atuaçãoemlocação",
                        "Atendimento",
                        "CodigoAgencia",
                        "Email",
                        "Foto"
                    ],
                    "filter" => [
                        "Administrativo" => "Nao",
                        "Atuaçãoemvenda" => "Sim",
                        "Atuaçãoemlocação" => "Nao"
                    ],
                    "order" => [
                        "Nome" => "asc"
                    ],
                    "paginacao" => [
                        "pagina" => $i,
                        "quantidade" => 50
                    ]
                ];

                $curl = curl_init(env("VISTA_API_URL") . "/usuarios/listar?key=" . env("VISTA_API_KEY") . "&pesquisa=" . json_encode($jayParsedAry) . "&showtotal=1");
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, True);
                curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
                $result = curl_exec($curl);
                curl_close($curl);
                $return = json_decode($result, true);

                unset($return["total"]);
                unset($return["paginas"]);
                unset($return["pagina"]);
                unset($return["quantidade"]);

                foreach ($return as $corretor) {

                    $corretor['Email'] = $corretor['E-mail'];
                    unset($corretor['E-mail']);

                    $existe = Brokers::query()->where('Codigo', trim($corretor['Codigo']))->first();
                    $corretor['hash'] = md5(json_encode($corretor));

                    if (is_null($existe)) { // Não existe cadastra
                        $properties = Brokers::create($corretor);
                        if ($properties) {
                            Log::info("Corretor: {$corretor['Codigo']} inserido.");
                        }
                    } else { // se existe atualiza

                        if ($existe['hash'] != $corretor['hash']) { // E o hash é diferente
                            try {
                                $properties = Brokers::find($existe['id']);
                                $properties->Codigo = $corretor['Codigo'];
                                $properties->Celular = $corretor['Celular'];
                                $properties->Celular1 = $corretor['Celular1'];
                                $properties->CRECI = $corretor['CRECI'];
                                $properties->Email = $corretor['Email'];
                                $properties->Fone = $corretor['Fone'];
                                $properties->Foto = $corretor['Foto'];
                                $properties->Observacoes = $corretor['Observacoes'];
                                $properties->save();
                                Log::info("Corretor: {$corretor['Codigo']} atualizado.");

                            } catch (\Exception $exception) {

                            }
                        }else{
                            Log::info("Corretor: {$corretor['Codigo']} Ok!.");
                        }
                    }
                }
            }
        }
    }
}
