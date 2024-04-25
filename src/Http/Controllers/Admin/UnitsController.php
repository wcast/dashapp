<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Condominium;
use App\Models\Properties;
use App\Models\Units;
use App\Models\Zipcodes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use function session;

class UnitsController extends Controller
{

    public function index($id = null)
    {
        $unit = new Units();
        $condominium = Condominium::query()
            ->findOrFail($id);
        $query = $unit->search();
        $query->from('units as u');
        $query->select(
            'u.id as id',
            'u.code',
            'u.status',
            'prop.DescricaoWeb as descricao',
            'prop.Categoria',
            'prop.Cidade',
            'prop.Dormitorios',
            'prop.Vagas',
            'prop.Suites',
            'prop.UF',
            'prop.FotoDestaque as foto'
        );
        $query->with('condominium');
        $query->join('properties as prop', 'prop.Codigo', '=', 'u.code');
        $query->where('condominium_id', $id);
        $query->orderBy('u.created_at', 'desc');
        $units = $query->paginate(20);
        return Inertia::render('condominium/units', [
            'user' => Auth::user(),
            'condominium' => $condominium,
            'condominium_id' => $id,
            'units' => $units
        ]);
    }

    public function add()
    {
        return Inertia::render('units/add', []);
    }

    public function store(Request $request)
    {
        $unit = new Units();
        $unit->condominium_id = $request->condominium_id;
        $unit->code = $request->code;
        $unit->status = "A";
        if ($unit->save()) {
            return session()->flash('success', 'Registro realizado com sucesso!');
        } else {
            return session()->flash('error', 'Erro ao salvar o registro!');
        }
    }

    public function edit($id = null)
    {
        $unit = Units::query()
            ->findOrFail($id);
        return Inertia::render('units/edit', [
            'condominium' => $unit
        ]);
    }

    public function update(Request $request)
    {
        $unit = Units::query()->findOrFail($request->id);
        $unit->condominium_id = $request->condominium_id;
        $unit->code = $request->code;
        $unit->status = $request->status;
        if ($unit->save()) {
            return session()->flash('success', 'Registro atualizado com sucesso!');
        } else {
            return session()->flash('error', 'Registro não atualizado!');
        }
    }

    public function delete($id)
    {
        $res = Units::destroy($id);
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

    public function vincular($id = null)
    {

        $condominium = Condominium::query()
            ->where(['id' => $id])
            ->first();

        $properties = Properties::query()
            ->where(['Empreendimento' => trim($condominium->name)])
            ->get();


        foreach ($properties as $property) {

            $exist_code = Units::query()
                ->where(['code' => $property->Codigo])
                ->first();

            if (!$exist_code) {
                $unit = new Units();
                $unit->condominium_id = $condominium->id;
                $unit->code = $property->Codigo;
                $unit->status = "A";
                if ($unit->save()) {

                }
            }
        }
    }
}
