<?php

return [
    'role_structure' => [
        'super' => [
            'users'               => 'c,r,u,d',
            'roles'               => 'c,r,u,d',
            'categories'          => 'c,r,u,d',
            'brands'              => 'c,r,u,d',
            'products'            => 'c,r,u,d',
            'appsettings'         => 'c,r,u,d',
            'notifications'       => 'c,r,u,d',
            'stagnants'           => 'c,r,u,d',
        ],
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
