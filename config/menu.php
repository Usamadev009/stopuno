<?php

return [

    'admin' => [
        ['title' => 'Dashboard', 'icon' => "fas fa-tachometer-alt", 'route' => "admin.dashboard"],
        [
            'title' => 'Platforms', 'icon' => "fas fa-layer-group", 'route' => "admin.platforms", 'module' => 'service'
            // 'submenu' => [
            //     ['title' => 'Platforms', 'route' => "admin.services"],
            //     ['title' => 'Categories', 'route' => "admin.category"],
            // ]
        ],
        // [
        //     'title' => 'Services', 'icon' => "fas fa-layer-group", 'route' => "",
        //     'submenu' => [
        //         ['title' => 'Services', 'route' => "admin.services"],
        //         ['title' => 'Questions', 'route' => "admin.services.question"],
        //     ]
        // ],
        // ['title' => 'Category', 'icon' => "fas fa-bars", 'route' => "admin.category"],
        ['title' => 'Roles', 'icon' => "fas fa-users-cog", 'route' => "admin.role", 'module' => 'role'],
        ['title' => 'Business', 'icon' => "fas fa-store-alt", 'route' => "admin.seller-service", 'module' => 'seller_service'],
        ['title' => 'Delivery', 'icon' => "fas fa-shipping-fast", 'route' => "admin.delivery", 'module' => 'delivery'],
        // ['title' => 'Driver Pay', 'icon' => "fas fa-truck", 'route' => "admin.driver"],

        // ['title' => 'Coupon', 'icon' => "fas fa-ticket-alt", 'route' => "admin.coupon"],
        [
            'title' => 'Coupons', 'icon' => "fas fa-ticket-alt", 'route' => "", 'module' => 'coupon',
            'submenu' => [
                ['title' => 'List', 'route' => "admin.coupon"],
                ['title' => 'Codes', 'route' => 'admin.coupon.code'],
                // ['title' => 'Submenu 2', 'route' => ""],
            ]
        ],
        ['title' => 'Deals', 'icon' => "fas fa-tag", 'route' => "admin.deal", 'module' => 'deal'],
        ['title' => 'Subscription', 'icon' => "fas fa-money-bill", 'route' => "admin.subscription", 'module' => 'subscription'],
        ['title' => 'Orders', 'icon' => "fas fa-box", 'route' => "admin.order", 'module' => 'order'],
        [
            'title' => 'User', 'icon' => "fas fa-users", 'route' => "", 'module' => 'user',
            'submenu' => [
                ['title' => 'StopUno Official', 'route' => "admin.user.official"],
                ['title' => 'Sellers', 'route' => 'admin.user.seller'],
                ['title' => 'Users', 'route' => 'admin.user'],
                // ['title' => 'Submenu 2', 'route' => ""],
            ]
        ],
    ]

];
