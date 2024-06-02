<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        //$total_imoveis = Properties::query()->count();
        //$total_imoveis_venda = Properties::query()->where('Status', 'VENDA')->count();
        //$total_imoveis_aluguel = Properties::query()->where('Status', 'ALUGUEL')->count();
        //$integracao = DB::table('integration')->first();

        $total_imoveis = 0;
        $total_imoveis_venda = 0;
        $total_imoveis_aluguel = 0;
        $integracao = DB::table('integration')->first();

        return Inertia::render('dashboard', [
            'integracao' => $integracao,
            'total_imoveis' => $total_imoveis,
            'total_imoveis_venda' => $total_imoveis_venda,
            'total_imoveis_aluguel' => $total_imoveis_aluguel
        ]);
    }
}
