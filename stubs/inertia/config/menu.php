<?php
return [
    'default' => [
        [
            'title' => 'Dashboard',
            'description' => 'Painel Administrativo',
            'manual' => '/',
            'segment' => null,
            'icon' => 'mdi mdi-monitor-dashboard',
            'route' => 'dashboard',
            'url' => null,
            'info' => null,
            'info_text' => null,
            'display_menu' => 'S',
            'order' => 1,
            'status' => 'A',
            'sub_menus' => []
        ],
        [
            'title' => 'Usuários',
            'description' => 'Listar usuários',
            'manual' => '/',
            'segment' => null,
            'icon' => 'mdi mdi-account-group',
            'route' => 'users',
            'url' => null,
            'info' => null,
            'info_text' => null,
            'display_menu' => 'S',
            'order' => 2,
            'status' => 'A',
            'sub_menus' => [
                [
                    'title' => 'Listar usuários',
                    'description' => 'Listar usuários',
                    'manual' => '/',
                    'segment' => null,
                    'icon' => 'mdi mdi-view-list',
                    'route' => 'users',
                    'url' => null,
                    'info' => null,
                    'info_text' => null,
                    'display_menu' => 'S',
                    'order' => 1,
                    'status' => 'A',
                    'sub_menus' => []
                ],
                [
                    'title' => 'Cadastrar usuário',
                    'description' => 'Cadastrar usuário',
                    'manual' => '/',
                    'segment' => null,
                    'icon' => 'mdi mdi-account-multiple-plus',
                    'route' => 'users.add',
                    'url' => null,
                    'info' => null,
                    'info_text' => null,
                    'display_menu' => 'S',
                    'order' => 1,
                    'status' => 'A',
                    'sub_menus' => []
                ]
            ]
        ],
    ]
];
