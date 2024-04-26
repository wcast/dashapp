<?php

namespace App\Services;

use App\Models\Properties;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;

class VistaApi extends Component
{
    private string $filteredCodes = "";
    private string $companyName = "site Imóveis";
    private array $defaultData = [];
    private array $resultsExtraFields = [
        1 => "total",
        2 => "paginas",
        3 => "pagina",
        4 => "quantidade",
        5 => "filteredCodes"
    ];

    public function __construct()
    {
        $this->defaultData = ["Orulo","AceitaDacao", "AreaPrivativa", "AreaTotal", "BairroComercial", "BanheiroSocialQtd", "Categoria", "Cidade", "DataCadastro", "DescricaoWeb", "Dormitorios", "Empreendimento", "Exclusivo", "FotoDestaque", "ImovelEmCampanha", "Status", "Suites", "Vagas", "ValorLocacao", "ValorVenda", "ValorVendaDe"];
    }

    public function cleanResultsArray(array $array): array
    {
        foreach ($this->resultsExtraFields as $field) {
            unset($array[$field]);
        }
        return $array;
    }

    private function setSlug($data): array
    {
        $strHelper = new Str();

        if (array_key_exists("message", $data)) {
            return [];
        } else {
            foreach ($data as $item => $fields) {
                if (array_search($item, $this->resultsExtraFields)) {
                    continue;
                }
                $string = "{$fields["Status"]}
                           {$fields["Categoria"]}
                           {$fields["BairroComercial"]}
                           {$fields["Cidade"]}";
                $data[$item]["slug"] = $strHelper->of($string)->slug("-");
            }
            return $data;
        }
    }

    public function getProperty(string $code): array
    {
        $dataArray = [];
        $dataArray["fields"] = array_merge(
            $this->defaultData,
            ["Orulo","Bairro", "CEP", "Complemento", "Corretor", "Endereco", "GMapsLatitude", "GMapsLongitude", "Latitude", "Longitude", "Numero", "UF", "URLVideo", "ValorCondominio", "ValorIptu", "VideoDestaque", ["Foto" => ["Foto"]], ["Video" => ["Video"]]]
        );
        $result = Http::withHeaders(["Accept" => "application/json"])->get(
            env("VISTA_API_URL") . "/imoveis/detalhes?key=" . env("VISTA_API_KEY") . "&imovel={$code}&pesquisa=" . json_encode($dataArray) . "&showtotal=1"
        )->json();

        if (!isset($result["Status"])) {
            return ["data" => [], "broker" => [], "similarProperties" => []];
        }

        ########################
        # getSimilarProperties #

        #################
        # getRangeValue #
        $value = isset($result["Status"]) && $result["Status"] == "ALUGUEL" ? "ValorLocacao" : "ValorVenda";
        $resultValue = $result[$value];

        $minValue = $resultValue - ($resultValue * 0.2);
        $maxValue = $resultValue + ($resultValue * 0.2);

        $handledRangeValue = [$minValue, $maxValue];

        $rangeValue = isset($resultValue) ? $handledRangeValue : "";
        # end getRangeValue #
        #################

        $dataArray = [
            "fields" => $this->defaultData,
            "filter" => [
                "ExibirNoSite" => "Sim",
                "Codigo" => ["!=", $result["Codigo"]],
                "Categoria" => $result["Categoria"],
                "Bairro" => $result["Bairro"],
                "Dormitorios" => $result["Dormitorios"],
                "ImobiliariaCadastro" => $this->companyName,
                $value => $rangeValue
            ],
            "order" => ["DataCadastro" => "desc"],
            "paginacao" => ["pagina" => 1, "quantidade" => 10]
        ];
        $similarProperties = $this->setSlug(Http::withHeaders(["Accept" => "application/json"])->get(
            env("VISTA_API_URL") . "/imoveis/listar?key=" . env("VISTA_API_KEY") . "&imovel={$code}&pesquisa=" . json_encode($dataArray) . "&showtotal=1")->json()
        );
        # end getSimilarProperties #
        ############################

        #############
        # getBroker #
        $broker = $result["Corretor"];
        $brokerDataArray = [
            "fields" => ["Nome", "Celular", "Celular1", "CRECI", "Email", "Fone", "Foto", "Observacoes"],
            "filter" => ["Codigo" => $broker],
            "paginacao" => ["pagina" => 1, "quantidade" => 1]
        ];
        $brokerResult = Http::withHeaders(["Accept" => "application/json"])->get(
            env("VISTA_API_URL") . "/usuarios/listar?key=" . env("VISTA_API_KEY") . "&imovel={$code}&pesquisa=" . json_encode($brokerDataArray) . "&showtotal=1"
        )->json();
        $broker = $broker ? ($brokerResult["total"] > 0 ? $brokerResult[$broker] : []) : [];
        # end getBroker #
        #################

        #######################
        # handleCompanyBroker #
        $domain = "";
        if (count($broker)) {
            $email = strlen($broker["Email"]) > 0 ? $broker["Email"] : "corretor@site.com.br";
            $domain = explode("@", $email)[1];
        }

        $isNotCompanyDomain = ($domain != "site.com.br" && $domain != "siteimoveis.com.br");
        if ($isNotCompanyDomain) {
            $broker["Nome"] = $this->companyName;
            $broker["Celular"] = $result["Status"] == "VENDA" ? "(51) 99367-1008" : "(51) 99977-3006";
            $broker["Fone"] = $result["Status"] == "VENDA" ? "(51) 3268-1888" : "(51) 3094-9466";
            $broker["Foto"] = asset("img/logo/L.png");
        }
        # end handleCompanyBroker #
        ###########################

        $strHelper = new Str();
        $string = "{$result["Status"]}
                   {$result["Categoria"]}
                   {$result["BairroComercial"]}
                   {$result["Cidade"]}";
        $result["slug"] = $strHelper->of($string)->slug("-");

        $result["title"] = "{$result['Categoria']}";

        if ($result['Dormitorios'] > 0) {
            $result["title"] .= " com {$result['Dormitorios']} dormitório(s)";
        }

        $result["title"] .= " no bairro {$result['BairroComercial']} em {$result['Cidade']}";

        return ["data" => $result, "broker" => $broker, "similarProperties" => $similarProperties];
    }

    public function getProperties(string $type, string $page, array $filter, string $order)
    {

        /*        if (isset($type) && $type == "redpin") {
                    $filter["Codigo"] = 'LU440141,LU437894,LU439159,LU267620,LU440605,LU440335,LU436661,LU438111,LU437419,LU438643,LU439892,LU438053,LU439607,LU439762,LU436120,LU438230,LU432629,LU439592,LU438983,LU439158,LU439199,LU439160,LU436390,LU267512,LU439592,LU439367,LU435229,LU439999,LU439261,LU438397,LU268340,LU437855,LU437863,LU436369,LU439091,LU440605,LU440464,LU432282,LU428945,LU439181,LU432887,LU440128,LU437671,LU437257,LU439132,LU434692,LU439356,LU263123,LU437872,LU440616,LU430990,LU435214,LU440653,LU434398,LU430811,LU435087,LU440385,LU440720,LU440695,LU438823,LU434616,LU439334,LU439789,LU440014,LU439783,LU440517,LU440073,LU267773,LU439974,LU440056,LU437267,LU434647,LU440511,LU440427,LU439131,LU439689,LU431228,LU439088,LU439554,LU440567,LU440590,LU437951,LU437652,LU436895,LU436987,LU440055,LU437711,LU439572,LU439360,LU440602,LU440618,LU440619,LU434332,LU434335,LU434334,LU440782,LU440888,LU440868,LU440863,LU440870,LU435110,LU440757';
                }*/

        /*        if (isset($filter["desconto"]) && !empty($filter["desconto"])) {
                    $filter["Codigo"] = 'LU435018,LU440141,LU437894,LU439159,LU267620,LU440605,LU440335,LU436661,LU438111,LU437419,LU438643,LU439892,LU438053,LU439607,LU439762,LU436120,LU438230,LU432629,LU439592,LU438983,LU439158,LU439199,LU439160,LU436390,LU267512,LU439592,LU439367,LU435229,LU439999,LU439261,LU438397,LU268340,LU437855,LU437863,LU436369,LU439091,LU440605,LU440464,LU432282,LU428945,LU439181,LU432887,LU440128,LU437671,LU437257,LU439132,LU434692,LU439356,LU263123,LU437872,LU440616,LU430990,LU435214,LU440653,LU434398,LU430811,LU435087,LU440385,LU440720,LU440695,LU438823,LU434616,LU439334,LU439789,LU440014,LU439783,LU440517,LU440073,LU267773,LU439974,LU440056,LU437267,LU434647,LU440511,LU440427,LU439131,LU439689,LU431228,LU439088,LU439554,LU440567,LU440590,LU437951,LU437652,LU436895,LU436987,LU440055,LU437711,LU439572,LU439360,LU440602,LU440618,LU440619,LU434332,LU434335,LU434334,LU440782,LU440888,LU440868,LU440863,LU440870,LU435110,LU440757';
                }*/

        if (isset($filter["Codigo"]) && !empty($filter["Codigo"])) {
            $this->filteredCodes = $filter["Codigo"];
            $finalCleanFilter = ["Codigo" => $this->handleCodes($filter["Codigo"])];
        } elseif (isset($filter["codes"]) && $filter["codes"]) {
            $this->filteredCodes = $filter["codes"];
            $finalCleanFilter = ["Codigo" => $this->handleCodes($filter["codes"])];
        } else {
            $finalFilter = array_merge(
                $this->setPropertiesDefaultFilter($filter, $type),
                $this->setPropertiesUserFilter($filter, $type)
            );

            if (!isset($filter["searchAction"])) {
              //  $finalFilter = array_merge($finalFilter, ["ImobiliariaCadastro" => $this->companyName]);
            }

            ####################
            # handleTerraville #
            if (
                (
                    strstr($type, "terraville") &&
                    isset($finalFilter["BairroComercial"]) &&
                    in_array("terra+ville", $finalFilter["BairroComercial"])
                ) || (
                    isset($finalFilter["BairroComercial"]) &&
                    in_array("Terra Ville", $finalFilter["BairroComercial"])
                )
            ) {
                unset($finalFilter["ImobiliariaCadastro"]);
            }
            $terraVilleHandledFilter = $finalFilter;
            # end handleTerraville #
            ########################

            $codeHandledFilter = $this->handleCodes($terraVilleHandledFilter);
            $finalCleanFilter = Utils::arrayClean($codeHandledFilter);
        }

        if (!array_key_exists("ExibirNoSite", $finalCleanFilter)) {
            array_push($finalCleanFilter, ["ExibirNoSite" => "Sim"]);
        }

        ##############
        # checkOrder #
        $priceType = $type == "aluguel" ? "ValorLocacao" : "ValorVenda";
        switch ($order) {
            case "menorPreco":
                $orderedResults = [$priceType => "asc"];
                break;
            case "maiorPreco":
                $orderedResults = [$priceType => "desc"];
                break;
            case "menorArea":
                $orderedResults = ["AreaPrivativa" => "asc"];
                break;
            case "maiorArea":
                $orderedResults = ["AreaPrivativa" => "desc"];
                break;
            case "atualizado":
                $orderedResults = ["DataCadastro" => "desc"];
                break;
            default:
                break;
        }
        # checkOrder #
        ##############

        $dataArray = [
            "order" => isset($orderedResults) ? $orderedResults : [],
            "fields" => $this->defaultData,
            "filter" => $finalCleanFilter,
            "paginacao" => ["pagina" => $page, "quantidade" => 12]
        ];

        unset($dataArray['filter'][0]);

        $results = $this->setSlug(
            Http::withHeaders(["Accept" => "application/json"])->get(
                env("VISTA_API_URL") . "/imoveis/listar?key=" . env("VISTA_API_KEY") . "&pesquisa=" . json_encode($dataArray) . "&showtotal=1"
            )->json()
        );

        if ($this->filteredCodes) {
            $results["filteredCodes"] = $this->filteredCodes;
        }

        $properties = Properties::query()->with('fotos');

        $results = $properties->paginate();

        return $results;
    }

    public function getPropertyDetalhes(string $code): array
    {
        $dataArray = [];
        $dataArray["fields"] = array_merge(
            $this->defaultData,
            ["Bairro", "CEP", "Complemento", "Corretor", "Endereco", "GMapsLatitude", "GMapsLongitude", "Latitude", "Longitude", "Numero", "UF", "URLVideo", "ValorCondominio", "ValorIptu", "VideoDestaque", ["Foto" => ["Foto"]], ["Video" => ["Video"]]]
        );
        return Http::withHeaders(["Accept" => "application/json"])->get(
            env("VISTA_API_URL") . "/imoveis/detalhes?key=" . env("VISTA_API_KEY") . "&imovel={$code}&pesquisa=" . json_encode($dataArray) . "&showtotal=1"
        )->json();
    }

    private function handleCodes($data): array
    {
        if (is_array($data)) {
            if (isset($data["Codigo"])) {
                $data["Codigo"] = explode(",", str_replace(" ", "", $data["Codigo"]));
            }
        } else {
            $data = explode(",", str_replace(" ", "", $data));
        }
        return $data;
    }

    public function getHomeProperties(): array
    {
        return ["sale" => $this->getExclusivities("sale"), "rental" => $this->getExclusivities("rental")];
    }

    public function getExclusivities(string $type): array
    {
        $filter = ["ExibirNoSite" => "Sim", "Exclusivo" => "Sim", "ImobiliariaCadastro" => $this->companyName];
        $filter = $type == "sale"
            ? array_merge($filter, ["Status" => "VENDA"], ["ValorVenda" => [">=", 300000]])
            : array_merge($filter, ["Status" => "ALUGUEL"], ["ValorLocacao" => [">=", 2500]], ["Zona" => "Zona Sul"]
            );

        $dataArray = [
            "filter" => $filter,
            "fields" => $this->defaultData,
            "order" => ["DataCadastro" => "desc"],
            "paginacao" => ["pagina" => 1, "quantidade" => 25]
        ];

        return $this->setSlug(
            Http::withHeaders(["Accept" => "application/json"])->get(
                env("VISTA_API_URL") . "/imoveis/listar?key=" . env("VISTA_API_KEY") . "&pesquisa=" . json_encode($dataArray) . "&showtotal=1"
            )->json()
        );
    }

    public function getTerravilleProperties(string $status): array
    {
        $dataArray = [
            "fields" => $this->defaultData,
            "filter" => ["ExibirNoSite" => "Sim", "Status" => $status, "BairroComercial" => "terra+ville"],
            "order" => ["DataCadastro" => "desc"],
            "paginacao" => ["pagina" => 1, "quantidade" => 25]
        ];
        return $this->setSlug(
            Http::withHeaders(["Accept" => "application/json"])->get(
                env("VISTA_API_URL") . "/imoveis/listar?key=" . env("VISTA_API_KEY") . "&pesquisa=" . json_encode($dataArray) . "&showtotal=1"
            )->json()
        );
    }

    public function getBrokerProperties(string $brokerCode): array
    {
        $dataArray = [
            "fields" => $this->defaultData,
            "filter" => [
                "ExibirNoSite" => "Sim",
                "CodigoCorretor" => [$brokerCode],
            ],
            "order" => ["DataCadastro" => "desc"],
            "paginacao" => ["pagina" => 1, "quantidade" => 12]
        ];

        $curl = curl_init(env("VISTA_API_URL") . "/imoveis/listar?key=" . env("VISTA_API_KEY") . "&pesquisa=" . json_encode($dataArray) . "&showtotal=1");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, True);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
        $result = curl_exec($curl);
        curl_close($curl);
        return json_decode($result, true);
    }

    public function getBravoExclusivityProperties(): array
    {
        $dataArray = [
            "fields" => $this->defaultData,
            "filter" => [
                "ExibirNoSite" => "Sim",
                "Status" => "VENDA",
                "ValorVenda" => [">=", 1000000],
                "ImobiliariaCadastro" => $this->companyName
            ],
            "order" => ["DataCadastro" => "desc"],
            "paginacao" => ["pagina" => 1, "quantidade" => 25]
        ];
        return $this->setSlug(
            Http::withHeaders(["Accept" => "application/json"])->get(
                env("VISTA_API_URL") . "/imoveis/listar?key=" . env("VISTA_API_KEY") . "&pesquisa=" . json_encode($dataArray) . "&showtotal=1"
            )->json()
        );
    }

    private function setPropertiesDefaultFilter(array $filter, string $type): array
    {
        $result = ["ExibirNoSite" => "Sim"];

        switch ($type) {
            // Se filtra por código, busca sem tipo
            case "releases":
                $result = array_merge(
                    $result,
                    ["Situacao" => ["novo"], "Cidade" => ["porto+alegre"]],
                    (isset($filter["codes"]) ? [] : ["Status" => isset($filter["codes"]) ? "" : "venda", "ValorVenda" => [">", 0]])
                );
                break;
            // Se filtra por código, busca sem tipo
            case "aluguel":
                $result = array_merge(
                    $result,
                    (isset($filter["codes"]) ? [] : ["Status" => "aluguel", "ValorLocacao" => [">", 0]]));
                break;
            // Se filtra por código, busca sem tipo
            case "venda":
                $result = array_merge(
                    $result,
                    (isset($filter["codes"]) ? [] : ["Status" => "venda", "ValorVenda" => [">", 0]]));
                break;
            case "terraville-rental":
                $result = array_merge(
                    $result,
                    ["BairroComercial" => [42 => "terra+ville"], "Status" => "aluguel", "ValorLocacao" => [">", 0]]);
                break;

            // Mais procurados Porto+Alegre

            case "terreno-compra-porto-alegre":
                $result = array_merge(
                    $result,
                    [
                        "Cidade" => ["Porto+Alegre"],
                        "Categoria" => "Terreno",
                        "Status" => "venda",
                        "ValorVenda" => [">", 0]
                    ]);
                break;
            case "casa-sobrado-venda-porto-alegre":
                $result = array_merge(
                    $result,
                    [
                        "Cidade" => ["Porto+Alegre"],
                        "Categoria" => ["Casa","Sobrado"],
                        "Status" => "venda",
                        "ValorVenda" => [">", 0]
                    ]);
                break;
            case "casa-venda-condominio-porto-alegre":
                $result = array_merge(
                    $result,
                    [
                        "Cidade" => ["Porto+Alegre"],
                        "Categoria" => "Casa Condomínio",
                        "Status" => "venda",
                        "ValorVenda" => [">", 0]
                    ]);
                break;
            case "casa-aluguel-condominio-porto-alegre":
                $result = array_merge(
                    $result,
                    [
                        "Cidade" => ["Porto+Alegre"],
                        "Categoria" => "Casa Condomínio",
                        "Status" => "aluguel",
                        "ValorLocacao" => [">", 0]
                    ]);
                break;
            case "casa-aluguel-porto-alegre":
                $result = array_merge(
                    $result,
                    [
                        "Cidade" => ["Porto+Alegre"],
                        "Categoria" => "Casa",
                        "Status" => "aluguel",
                        "ValorLocacao" => [">", 0]
                    ]);
                break;
            case "sala-aluguel-porto-alegre-ate-1500":
                $result = array_merge(
                    $result,
                    [
                        "Cidade" => ["Porto+Alegre"],
                        "Categoria" => "Conjunto/Sala",
                        "Status" => "aluguel",
                        "ValorLocacao" => ["<", 1500]
                    ]);
                break;
            case "apartamento-2-dorm-porto-alegre":
                $result = array_merge(
                    $result,
                    [
                        "Cidade" => ["Porto+Alegre"],
                        "Categoria" => "Apartamento",
                        "Dormitorios" => 2,
                        "ValorVenda" => [">", 0]
                    ]);
                break;
            case "loja-aluguel-centro-porto-alegre":
                $result = array_merge(
                    $result,
                    [
                        "Cidade" => ["Porto+Alegre"],
                        "Categoria" => "Loja",
                        "Status" => "aluguel",
                        "Bairro" => "Centro",
                        "ValorLocacao" => [">", 0]
                    ]);
                break;
            case "pavilhao-aluguel-porto-alegre":
                $result = array_merge(
                    $result,
                    [
                        "Cidade" => ["Porto+Alegre"],
                        "Categoria" => "Pavilhão",
                        "Status" => "aluguel",
                        "ValorLocacao" => [">", 0]
                    ]);
                break;
            case "aluguel-comercial-porto-alegre":
                $result = array_merge(
                    $result,
                    [
                        "Cidade" => ["Porto+Alegre"],
                        "Categoria" => ["Casa comercial", "Prédio Comercial"],
                        "Status" => "aluguel",
                        "ValorLocacao" => [">", 0]
                    ]);
                break;
            case "aluguel-salas-centro-porto-alegre":
                $result = array_merge(
                    $result,
                    [
                        "Cidade" => ["Porto+Alegre"],
                        "Categoria" => ["Casa comercial", "Prédio Comercial"],
                        "Status" => "aluguel",
                        "Bairro" => "Centro",
                        "ValorLocacao" => [">", 0]
                    ]);
                break;

            // Fim mais procurados Porto Alegre

            // Início mais procurados Atlantida

            case "terreno-compra-atlantida":
                $result = array_merge(
                    $result,
                    [
                        "Cidade" => ["Atlântida"],
                        "Categoria" => "Terreno",
                        "Status" => "venda",
                        "ValorVenda" => [">", 0]
                    ]);
                break;
            case "casa-sobrado-venda-atlantida":
                $result = array_merge(
                    $result,
                    [
                        "Cidade" => ["Atlântida"],
                        "Categoria" => ["Casa","Sobrado"],
                        "Status" => "venda"
                    ]);
                break;
            case "casa-venda-condominio-atlantida":
                $result = array_merge(
                    $result,
                    [
                        "Cidade" => ["Atlântida"],
                        "Categoria" => "Casa Condomínio",
                        "Status" => "venda",
                        "ValorVenda" => [">", 0]
                    ]);
                break;
            case "casa-aluguel-condominio-atlantida":
                $result = array_merge(
                    $result,
                    [
                        "Cidade" => ["Atlântida"],
                        "Categoria" => "Casa Condomínio",
                        "Status" => "aluguel",
                        "ValorLocacao" => [">", 0]
                    ]);
                break;
            case "casa-aluguel-atlantida":
                $result = array_merge(
                    $result,
                    [
                        "Cidade" => ["Atlântida"],
                        "Categoria" => "Casa",
                        "Status" => "aluguel",
                        "ValorLocacao" => [">", 0]
                    ]);
                break;
            case "sala-aluguel-atlantida-ate-1500":
                $result = array_merge(
                    $result,
                    [
                        "Cidade" => ["Atlântida"],
                        "Categoria" => "Conjunto/Sala",
                        "Status" => "aluguel",
                        "ValorLocacao" => ["<", 1500]
                    ]);
                break;
            case "apartamento-2-dorm-atlantida":
                $result = array_merge(
                    $result,
                    [
                        "Cidade" => ["Atlântida"],
                        "Categoria" => "Apartamento",
                        "Dormitorios" => 2,
                        "ValorVenda" => [">", 0]
                    ]);
                break;
            case "loja-aluguel-centro-atlantida":
                $result = array_merge(
                    $result,
                    [
                        "Cidade" => ["Atlântida"],
                        "Categoria" => "Loja",
                        "Status" => "aluguel",
                        "Bairro" => "Centro",
                        "ValorLocacao" => [">", 0]
                    ]);
                break;
            case "pavilhao-aluguel-atlantida":
                $result = array_merge(
                    $result,
                    [
                        "Cidade" => ["Atlântida"],
                        "Categoria" => "Pavilhão",
                        "Status" => "aluguel",
                        "ValorLocacao" => [">", 0]
                    ]);
                break;
            case "aluguel-comercial-atlantida":
                $result = array_merge(
                    $result,
                    [
                        "Cidade" => ["Atlântida"],
                        "Categoria" => ["Casa comercial", "Prédio Comercial"],
                        "Status" => "aluguel",
                        "ValorLocacao" => [">", 0]
                    ]);
                break;
            case "aluguel-salas-centro-atlantida":
                $result = array_merge(
                    $result,
                    [
                        "Cidade" => ["Atlântida"],
                        "Categoria" => ["Casa comercial", "Prédio Comercial"],
                        "Status" => "aluguel",
                        "Bairro" => "Centro",
                        "ValorLocacao" => [">", 0]
                    ]);
                break;

            // Fim mais procurados Atlantida

            case "terraville-sale":
                $result = array_merge(
                    $result,
                    ["BairroComercial" => [42 => "terra+ville"], "Status" => "venda", "ValorVenda" => [">", 0]]);
                break;
            case "broker":
            case "promocional":
            default:
                $result = array_merge($result, $filter);
                break;
        }

        return $result;
    }

    private function setPropertiesUserFilter(array $filter, string $type): array
    {

        $categoryValues = array_key_exists("category", $filter) ? $filter["category"] : [];
        $bedrooms = array_key_exists("bedroom", $filter) ? $filter["bedroom"] : [];
        $parking = array_key_exists("parking", $filter) ? $filter["parking"] : [];
        $aceitaDacao = array_key_exists("dacao", $filter) ? $filter["dacao"] : [];
        $result = [
            "Situacao" => array_key_exists("situation", $filter) ? $filter["situation"] : [],
            "Categoria" => is_array($categoryValues) ? array_values($categoryValues) : [],
            "BairroComercial" => array_key_exists("district", $filter) ? $filter["district"] : [],
            "Dormitorios" => is_array($bedrooms) ? array_values($bedrooms) : [],
            "Vagas" => is_array($parking) ? array_values($parking) : [],
            "Codigo" => array_key_exists("codes", $filter) ? $filter["codes"] : [],
            "AceitaDacao" => $aceitaDacao ? ($aceitaDacao == 2 ? "Nao" : "Sim") : "",
            "Empreendimento" => array_key_exists("enterprise", $filter) ? $filter["enterprise"] : [],
            "AreaPrivativa" => $this->handleRangeFieldValue($filter, array_key_exists("minarea", $filter) ? "minarea" : "", array_key_exists("maxarea", $filter) ? "maxarea" : "")
        ];

        if ($type !== "broker") {
            $result = array_merge($result, [($type == "aluguel" ? "ValorLocacao" : "ValorVenda") => $this->handleRangeFieldValue($filter, array_key_exists("minvalue", $filter) ? "minvalue" : "", array_key_exists("maxvalue", $filter) ? "maxvalue" : "")]);
        }
        if (array_key_exists("Exclusivo", $filter) ? $filter["Exclusivo"] : []) {
            $result = array_merge($result, ["Exclusivo" => "Sim"]);
        }
        if (array_key_exists("Construtora", $filter) ? $filter["Construtora"] : []) {
            $result = array_merge($result, ["Construtora" => $filter["Construtora"]]);
        }
        if (array_key_exists("BairroComercial", $filter) ? $filter["BairroComercial"] : []) {
            $result = array_merge($result, ["BairroComercial" => $filter["BairroComercial"]]);
        }
        if (array_key_exists("city", $filter) ? $filter["city"] : []) {
            $result = array_merge($result, ["Cidade" => str_replace(" ", "+", ucwords($filter["city"]))]);
        }
        if (array_key_exists("ValorVenda", $filter) ? $filter["ValorVenda"] : []) {
            $result = array_merge($result, ["ValorVenda" => $filter["ValorVenda"]]);
        }
        if (array_key_exists("ValorLocacao", $filter) ? $filter["ValorLocacao"] : []) {
            $result = array_merge($result, ["ValorLocacao" => $filter["ValorLocacao"]]);
        }

        return Utils::arrayClean($result);
    }

    private function handleRangeFieldValue(array $filter, string $minField, string $maxField): array
    {
        if ($minField || $maxField) {
            if ($minField) {
                $filter[$minField] = Utils::stringValueToFloatValueConversion($filter[$minField]);
            }
            if ($maxField) {
                $filter[$maxField] = Utils::stringValueToFloatValueConversion($filter[$maxField]);
            }
            return [$minField ? $filter[$minField] ?? 0 : 0, $maxField ? $filter[$maxField] ?? 9999999999 : 9999999999];
        }
        return [];
    }

    public function getTeam(string $type = ""): array
    {
        $dataArray = [
            "fields" => ["Nome", "Celular", "Celular1", "CRECI", "Foto", "Observacoes"],
            "filter" => array_merge(["Exibirnosite" => "Sim", "Administrativo" => "Nao"], (strlen($type) > 0 ? [($type == "rental" ? "Atuaçãoemlocação" : "Atuaçãoemvenda") => "Sim"] : [])),
            "order" => ["Nome" => "asc"],
            "paginacao" => ["pagina" => 1, "quantidade" => 50]
        ];
        return Http::withHeaders(["Accept" => "application/json"])->get(
            env("VISTA_API_URL") . "/usuarios/listar?key=" . env("VISTA_API_KEY") . "&pesquisa=" . json_encode($dataArray) . "&showtotal=1"
        )->json();
    }

    public function getBroker(string $code, string $codeType): array
    {
        $dataArray = [
            "fields" => ["Nome", "Celular", "Celular1", "CRECI", "Email", "Fone", "Foto", "Observacoes"],
            "filter" => [$codeType => $code],
            "paginacao" => ["pagina" => 1, "quantidade" => 1]
        ];

        $curl = curl_init( env("VISTA_API_URL") . "/usuarios/listar?key=" . env("VISTA_API_KEY") . "&pesquisa=" . json_encode($dataArray) . "&showtotal=1");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, True);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
        $result = curl_exec($curl);
        curl_close($curl);
        return json_decode($result, true);
    }

    public function getCorporateLocals()
    {
        $dataArray = [
            "fields" => array_merge($this->defaultData, ["CEP", "Complemento", "Endereco", "Numero", "UF"]),
            "filter" => [
                "ExibirNoSite" => "Sim",
                "Status" => "ALUGUEL",
                "Categoria" => ["Casa+Comercial", "Conjunto/Sala", "Depósito", "Loja", "Pavilhão", "Prédio+Comercial", "Terreno"],
                "ImobiliariaCadastro" => $this->companyName
            ],
            "order" => ["DataCadastro" => "desc"], "paginacao" => ["pagina" => 1, "quantidade" => 25]
        ];
        return $this->setSlug(
            Http::withHeaders(["Accept" => "application/json"])->get(
                env("VISTA_API_URL") . "/imoveis/listar?key=" . env("VISTA_API_KEY") . "&pesquisa=" . json_encode($dataArray) . "&showtotal=1"
            )->json()
        );
    }

    public function getTotalPropertiesPages(): array
    {
        $dataArray = [
            "order" => [], "fields" => [],
            "filter" => ["ExibirNoSite" => "Sim", "ImobiliariaCadastro" => $this->companyName],
            "paginacao" => ["pagina" => 1, "quantidade" => 50]
        ];
        $result = Http::withHeaders(["Accept" => "application/json"])->get(
            env("VISTA_API_URL") . "/imoveis/listar?key=" . env("VISTA_API_KEY") . "&pesquisa=" . json_encode($dataArray) . "&showtotal=1"
        )->json();
        return ["totalProperties" => $result["total"], "totalPages" => $result["paginas"]];
    }

    public function getTotalBrokersPages(): array
    {
        $dataArray = [
            "order" => [], "fields" => [],
            "filter" => ["Exibirnosite" => "Sim", "Administrativo" => "Nao"],
            "paginacao" => ["pagina" => 1, "quantidade" => 50]
        ];
        $result = Http::withHeaders(["Accept" => "application/json"])->get(
            env("VISTA_API_URL") . "/usuarios/listar?key=" . env("VISTA_API_KEY") . "&pesquisa=" . json_encode($dataArray) . "&showtotal=1"
        )->json();
        return ["totalBrokers" => $result["total"], "totalPages" => $result["paginas"]];
    }

    public function getPropertiesOnlyCities($page)
    {
        $dataArray = [
            "order" => [], "fields" => ["Cidade"],
            "filter" => ["ExibirNoSite" => "Sim", "ImobiliariaCadastro" => $this->companyName],
            "paginacao" => ["pagina" => $page, "quantidade" => 50]
        ];
        return $this->cleanResultsArray(
            Http::withHeaders(["Accept" => "application/json"])->get(
                env("VISTA_API_URL") . "/imoveis/listar?key=" . env("VISTA_API_KEY") . "&pesquisa=" . json_encode($dataArray) . "&showtotal=1"
            )->json()
        );
    }

    public function getBairros($cidade)
    {
        $dataArray = [
            "order" => [], "fields" => ["BairroComercial"],
            "filter" => ["ExibirNoSite" => "Sim", "ImobiliariaCadastro" => $this->companyName, 'Cidade' => $cidade]
        ];
        $result = $this->cleanResultsArray(Http::withHeaders(["Accept" => "application/json"])->get(
            env("VISTA_API_URL") . "/imoveis/listarConteudo?key=" . env("VISTA_API_KEY") . "&pesquisa=" . json_encode($dataArray) . "&showtotal=1"
        )->json());

        if (!isset($result['BairroComercial'])) {
            return array();
        }
        return $result['BairroComercial'];
    }

    private function getPaginatedProperties($page)
    {
        $dataArray = [
            "order" => [],
            "fields" => ["BairroComercial", "Categoria", "Cidade", "Codigo", "Status"],
            "filter" => ["ExibirNoSite" => "Sim", "ImobiliariaCadastro" => $this->companyName],
            "paginacao" => ["pagina" => $page, "quantidade" => 50]
        ];
        return $this->cleanResultsArray(
            Http::withHeaders(["Accept" => "application/json"])->get(
                env("VISTA_API_URL") . "/imoveis/listar?key=" . env("VISTA_API_KEY") . "&pesquisa=" . json_encode($dataArray) . "&showtotal=1"
            )->json()
        );
    }

    private function getPaginatedBrokers($page)
    {
        $dataArray = [
            "order" => [],
            "fields" => ["Codigo"],
            "filter" => ["Exibirnosite" => "Sim", "Administrativo" => "Nao"],
            "paginacao" => ["pagina" => $page, "quantidade" => 50]
        ];
        return $this->cleanResultsArray(
            Http::withHeaders(["Accept" => "application/json"])->get(
                env("VISTA_API_URL") . "/usuarios/listar?key=" . env("VISTA_API_KEY") . "&pesquisa=" . json_encode($dataArray) . "&showtotal=1"
            )->json()
        );
    }

    private function getAllProperties(): array
    {
        $propertiesArray = [];
        $totalPages = $this->getTotalPropertiesPages()["totalPages"];

        for ($page = 1; $page <= $totalPages; $page++) {
            $propertiesArray = array_merge($propertiesArray, $this->getPaginatedProperties($page));
        }

        return $propertiesArray;
    }

    private function getAllBrokers(): array
    {
        $brokersArray = [];
        $totalPages = $this->getTotalBrokersPages()["totalPages"];

        for ($page = 1; $page <= $totalPages; $page++) {
            $brokersArray = array_merge($brokersArray, $this->getPaginatedBrokers($page));
        }

        return $brokersArray;
    }

    public function getSitemapData(): string
    {
        $strHelper = new Str();
        $sitemapData = "";

        foreach ($this->getAllProperties() as $property) {
            $string = "{$property["Status"]}
                        {$property["Categoria"]}
                        {$property["BairroComercial"]}
                        {$property["Cidade"]}";
            $slug = $strHelper->of($string)->slug("-");
            $sitemapData .= "<url><loc>https://site.com.br/imovel/{$slug}/{$property['Codigo']}</loc></url>";
        }

        foreach ($this->getAllBrokers() as $broker) {
            $sitemapData .= "<url><loc>https://site.com.br/corretor/{$broker['Codigo']}</loc></url>";
        }

        return $sitemapData;
    }
}
