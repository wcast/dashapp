<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Condominium;
use CondominiumsPhotos;
use Fotos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Properties;
use Wcast\Dashapp\Models\Images;
use function session;

class CondominiumController extends Controller
{

    public function index()
    {
        $user = new Condominium();
        $query = $user->search();
        $query->orderBy('created_at', 'desc');
        $condominium = $query->paginate(50);
        return Inertia::render('condominium/index', [
            'user' => Auth::user(),
            'condominium' => $condominium
        ]);
    }

    public function add()
    {
        return Inertia::render('condominium/add', []);
    }

    public function store(Request $request)
    {
        $condominium = new Condominium();
        $latitude = false;
        $longitude = false;
        $public_place_map = str_replace(" ", "+", "{$request->public_place},{$request->number}, {$request->district}-{$request->city} {$request->state}");
        $url_latlong = "https://maps.google.com/maps/api/geocode/json?address={$public_place_map}&sensor=false&key=AIzaSyBHA5aKLxpxREErXmuLoRBMBZBOcWjKXJw";
        $res = Http::get($url_latlong);
        if (!$res->failed()) {
            $res = json_decode($res, true);
            if (isset($res['results'][0]['geometry']['location'])) {
                $latitude = $res['results'][0]['geometry']['location']['lat'];
                $longitude = $res['results'][0]['geometry']['location']['lng'];
            }
        }
        $condominium->name = $request->name;
        $condominium->code = $request->code;
        $condominium->slug = Str::slug($request->name, '-');
        $condominium->zipcode = $request->zipcode;
        $condominium->public_place = $request->public_place;
        $condominium->number = $request->number;
        $condominium->district = $request->district;
        $condominium->city = $request->city;
        $condominium->state = $request->state;
        $condominium->blocks = $request->blocks;
        $condominium->units = $request->units;
        $condominium->intro = $request->intro;
        $condominium->description = $request->description;
        $condominium->video = $request->video;
        $condominium->new = $request->new;
        if ($latitude && $longitude) {
            $condominium->latitude = $latitude;
            $condominium->longitude = $longitude;
        }
        $condominium->status = $request->status;
        if ($condominium->save()) {
            if ($request->mapa) {
                $mapa = file_get_contents($request->mapa->path());
                $disk = Storage::disk('public');
                $date = date("dmY");
                $disk->put("/uploads/maps/mapa-{$condominium->slug}-{$date}.pdf", $mapa);
            }
            return session()->flash('success', 'Registro realizado com sucesso!');
        } else {
            return session()->flash('error', 'Erro ao salvar o registro!');
        }
    }

    public function edit($id = null)
    {
        $condominium = Condominium::query()
            ->findOrFail($id);
        return Inertia::render('condominium/edit', [
            'condominium' => $condominium
        ]);
    }

    public function photos($id = null)
    {
        $condominium = Condominium::query()
            ->findOrFail($id);

        $condominium_photos = CondominiumsPhotos::query()
            ->where(['condominium_id' => $id])->get();

        return Inertia::render('condominium/photos', [
            'condominium' => $condominium,
            'condominium_photos' => ['photos' => $condominium_photos],
            'count' => count($condominium_photos)
        ]);
    }

    public function photosStore(Request $request)
    {
        $condominium_photo = Condominium::query()->findOrFail($request->id);
        if ($condominium_photo->save()) {
            if ($photo = Images::makeFromBase64($request->photo, 'photo', '/uploads/photos/', 1728, 100)) {
                $condominium_photo->default_photo = $photo;
                $condominium_photo->save();
                return response()->json([
                    'success' => true,
                    'msg' => 'Foto incluída com sucesso'
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'msg' => 'Registro não pode ser incluído'
            ]);
        }
    }

    public function logoStore(Request $request)
    {
        $condominium_photo = Condominium::query()->findOrFail($request->id);
        if ($condominium_photo->save()) {
            if ($logomarca = Images::makeFromBase64($request->photo, 'logo', '/uploads/logomarcas/', 100, 100)) {
                $condominium_photo->logomarca = $logomarca;
                $condominium_photo->save();
                return response()->json([
                    'success' => true,
                    'msg' => 'Logo marca incluída com sucesso'
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'msg' => 'Logo marca não pode ser incluído'
            ]);
        }
    }

    public function secondPhotosStore(Request $request)
    {
        $condominium_photo = Condominium::query()->findOrFail($request->id);
        if ($condominium_photo->save()) {
            if ($photo = Images::makeFromBase64($request->photo, 'photo', '/uploads/photos/', 1728, 100)) {
                $condominium_photo->second_photo = $photo;
                $condominium_photo->save();
                return response()->json([
                    'success' => true,
                    'msg' => 'Foto incluída com sucesso'
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'msg' => 'Registro não pode ser incluído'
            ]);
        }
    }

    public function morePhotosStore(Request $request)
    {
        $condominium_photo = new CondominiumsPhotos();
        $condominium_photo->condominium_id = $request->id;
        $condominium_photo->name = $request->name;
        if ($condominium_photo->save()) {
            if ($photo = Images::makeFromBase64($request->photo, 'photo', '/uploads/photos/', 1728, 100)) {
                $condominium_photo->photo = $photo;
                $condominium_photo->save();
                return response()->json([
                    'success' => true,
                    'msg' => 'Foto incluída com sucesso'
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'msg' => 'Registro não pode ser incluído'
            ]);
        }
    }

    public function update(Request $request)
    {
        $res = null;
        $latitude = false;
        $longitude = false;
        $public_place_map = str_replace(" ", "+", "{$request->public_place},{$request->number}, {$request->district}-{$request->city} {$request->state}");
        $url_latlong = "https://maps.google.com/maps/api/geocode/json?address={$public_place_map}&sensor=false&key=AIzaSyBHA5aKLxpxREErXmuLoRBMBZBOcWjKXJw";
        $res = Http::get($url_latlong);
        $res = Http::get($url_latlong);
        if (!$res->failed()) {
            $res = json_decode($res, true);
            if (isset($res['results'][0]['geometry']['location'])) {
                $latitude = $res['results'][0]['geometry']['location']['lat'];
                $longitude = $res['results'][0]['geometry']['location']['lng'];
            }
        }
        $condominium = Condominium::query()->findOrFail($request->id);
        $condominium->name = $request->name;
        $condominium->zipcode = $request->zipcode;
        if ($latitude && $longitude) {
            $condominium->latitude = $latitude;
            $condominium->longitude = $longitude;
        }
        $condominium->code = $request->code;
        $condominium->public_place = $request->public_place;
        $condominium->number = $request->number;
        $condominium->district = $request->district;
        $condominium->city = $request->city;
        $condominium->state = $request->state;
        $condominium->blocks = $request->blocks;
        $condominium->units = $request->units;
        $condominium->intro = $request->intro;
        $condominium->slug = Str::slug($request->name);
        $condominium->description = $request->description;
        $condominium->video = $request->video;
        $condominium->status = $request->status;
        $condominium->new = $request->new;
        if ($condominium->save()) {
            if ($request->mapa) {
                $mapa = file_get_contents($request->mapa->path());
                $disk = Storage::disk('public');
                $date = date("dmY");
                $path = "/uploads/maps/mapa-{$condominium->slug}-{$date}.pdf";
                $disk->put($path, $mapa);
                $condominium->mapa = $path;
                $condominium->save();
            }
            return session()->flash('success', 'Registro atualizado com sucesso!');
        } else {
            return session()->flash('error', 'Registro não atualizado!');
        }
    }

    public function delete(Request $request)
    {
        $res = Condominium::destroy($request->id);
        if ($res) {
            return response()->json([
                'success' => true,
                'msg' => 'Registro excluído com sucesso'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'msg' => 'Registro não pode ser excluído'
            ]);
        }
    }

    public function morePhotosDelete(Request $request)
    {
        $res = CondominiumsPhotos::destroy($request->id);
        if ($res) {
            return response()->json([
                'success' => true,
                'msg' => 'Registro excluído com sucesso'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'msg' => 'Registro não pode ser excluído'
            ]);
        }
    }

    public function listar(Request $request)
    {
        $companies = Condominium::all();

        print json_encode($companies);
    }

    public function getCep($zipcode = null)
    {
        $zipcode = preg_replace("/[^0-9]/", "", $zipcode);
        $response = Http::get("https://opencep.com/v1/{$zipcode}.json");
        if ($response->failed()) {
            return response()->json(['error' => 'CEP não encontrado'], 404);
        }
        return $response->json();
    }

    public function getCondominio(Request $request)
    {
        $codigo = $request->code;

        $existe_condominium = Condominium::query()
            ->where('code', $codigo)
            ->first();

        $property = Properties::query()
            ->where('Codigo', $codigo)
            ->first();

        if (isset($property)) {
            $cep = $property['CEP'];
            $cep = preg_replace("/[^0-9]/", "", $cep);
            $response = Http::get("https://opencep.com/v1/{$cep}");
            $data = json_decode($response, true);

            if (isset($data['error'])) {
                $zipcode = $property['CEP'];
                $public_place = $property['Endereco'];
                $district = $property['BairroComercial'];
                $city = $property['Cidade'];
                $state = $property['UF'];
            } else {
                $zipcode = $property['CEP'];
                $public_place = $data['logradouro'];
                $district = $data['bairro'];
                $city = $data['localidade'];
                $state = $data['uf'];
            }

        }else {

            return session()->flash('error', 'Condomínio não encontrado!');
        }

        if (!$existe_condominium) {

            $insert = [
                'name' => $property['Empreendimento'],
                'code' => $property['Codigo'],
                'zipcode' => $zipcode,
                'public_place' => $public_place,
                'number' => $property['Numero'],
                'district' => $district,
                'slug' => Str::slug($property['Empreendimento']),
                'logomarca' => '/images/no-image.png',
                'city' => $city,
                'state' => $state,
                'description' => $property['DescricaoWeb'],
                'intro' => '',
                'latitude' => $property['Latitude'],
                'longitude' => $property['Longitude']
            ];

            Condominium::create($insert);

        } else {

            $condominium = Condominium::query()
                ->where('code', $codigo)
                ->first();

            $condominium->name = $property['Empreendimento'];
            $condominium->description = $property['DescricaoWeb'];
            $condominium->slug = Str::slug($property['Empreendimento']);
            $condominium->code = $property['Codigo'];
            $condominium->zipcode = $zipcode;
            $condominium->slug = Str::slug($property['Empreendimento']);
            $condominium->public_place = $public_place;
            $condominium->number = $property['Numero'];
            $condominium->district = $district;
            $condominium->city = $city;
            $condominium->state = $state;
            $condominium->logomarca = (isset($existe_condominium['logomarca'])) ? $existe_condominium['logomarca'] : '/images/no-image.png';
            $condominium->save();
        }

        $condominium = Condominium::query()
            ->where('code', $codigo)
            ->first();

        $fotos_delete = CondominiumsPhotos::where('condominium_id', $condominium->id)->get();

        foreach ($fotos_delete as $f){
            $f->delete();
        }

        $fotos = Fotos::query()
            ->where('properties_id', $property->id)
            ->get()->toArray();

        foreach ($fotos as $f){
            $foto = new CondominiumsPhotos();
            $foto->condominium_id = $condominium->id;
            $foto->photo = $f['Foto'];
            $foto->name = $f['Descricao'];
            $foto->save();
        }

        return session()->flash('success', 'Condomínio sincronizado!');
    }
}

