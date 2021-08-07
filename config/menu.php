<?php

return [
    // Navbar items:
    [
        'type'         => 'fullscreen-widget',
        'topnav_right' => true,
    ],

    // Sidebar items:
    [
        'text'        => 'menu.home._title',
        'url'         => '/',
        'icon'        => 'fas fa-fw fa-home',
    ],
    ['header' => 'menu.administration._title'],
    [
        'text'    => 'menu.administration.configuration._title',
        'icon'    => 'fas fa-fw fa-cogs',
        'submenu' => [
            [
                'icon'    => 'fas fa-fw fa-database',
                'text' => 'menu.administration.configuration.database._title',
                'url'  => '#',
            ],
            [
                'icon'    => 'fas fa-fw fa-video',
                'text' => 'menu.administration.configuration.letterboxd._title',
                'url'  => '#',
            ],
        ],
    ],
];
