<?php

namespace App\Helpers;

use App\Models\Application;
use App\Models\Feature;
use Illuminate\Support\Facades\Route;

class  BreadcrumbHelper
{
    public $active = false;
    public $menu;
    public $item;

    public function __construct()
    {

    }
    public function make()
    {
        $route = $this->getRoute();

        $array[] = [
            'title' => 'Dashboard',
            'route' => $route,
            'status' => 'A'
        ];

        return json_encode($array);
    }

    public function getRoute()
    {
        if (Route::getCurrentRoute()->getName()) {
            return Route::getCurrentRoute()->getName();
        } elseif (Route::current()->uri) {
            return Route::current()->uri;
        }
    }

}

