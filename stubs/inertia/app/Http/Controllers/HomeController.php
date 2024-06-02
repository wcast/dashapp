<?php

namespace App\Http\Controllers;

use App\Services\Utils;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'title' => '',
            'meta' => [
                'description' => '',
                'photo' => '/img/logo/L.png',
            ],
            'page' => 'home'
        ]);
    }

    public function politica(Request $request)
    {
        return view("politica-privacidade", [
            'title' => 'Política de Privacidade',
            'meta' => [
                'description' => 'Política de Privacidade',
                'photo' => '/img/logo/L.png',
            ],
            'page' => 'politica'
        ]);
    }

    public function termos(Request $request)
    {
        return view("termo", [
            'title' => 'Termos e condições',
            'meta' => [
                'description' => 'Termos e condições',
                'photo' => '/img/logo/L.png',
            ],
            'page' => 'termos'
        ]);
    }

}
