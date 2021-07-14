<?php

return [
    'role_structure' => [
        'super' => [
            'users'      => 'c,r,u,d',
            'categories' => 'c,r,u,d',
            'products' => 'c,r,u,d',
            'owners'     => 'c,r,u,d',
            'works'      => 'c,r,u,d',
        ],
        // 'admin' => [
        //     'categories' => 'c,r,u,d',
        //     'owners' => 'c,r,u,d',
        // ],
        // 'user' => [
        //     'owners' => 'r,u'
        // ],
        'new_per' => [],
    ],
    // 'permission_structure' => [
    //     'cru_user' => [
    //         'profile' => 'c,r,u'
    //     ],
    // ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
