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
        [
            'title' => 'Condomínio',
            'description' => 'Lista de condomínios',
            'manual' => '/',
            'segment' => null,
            'icon' => 'mdi mdi-office-building-marker',
            'route' => 'condominium',
            'url' => null,
            'info' => null,
            'info_text' => null,
            'display_menu' => 'S',
            'order' => 2,
            'status' => 'A',
            'sub_menus' => [
                [
                    'title' => 'Listar condomínios',
                    'description' => 'Listar condomínios',
                    'manual' => '/',
                    'segment' => null,
                    'icon' => 'mdi mdi-view-list',
                    'route' => 'condominium',
                    'url' => null,
                    'info' => null,
                    'info_text' => null,
                    'display_menu' => 'S',
                    'order' => 1,
                    'status' => 'A',
                    'sub_menus' => []
                ],
                [
                    'title' => 'Novo condomínio',
                    'description' => 'Novo condomínio',
                    'manual' => '/',
                    'segment' => null,
                    'icon' => 'mdi mdi-plus',
                    'route' => 'condominium.add',
                    'url' => null,
                    'info' => null,
                    'info_text' => null,
                    'display_menu' => 'S',
                    'order' => 1,
                    'status' => 'A',
                    'sub_menus' => []
                ]
            ]
        ]
    ]
];
