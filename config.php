<?php

return array(

    'database' => array(
        'user' => 'homestead',
        'pass' => 'secret',
        'host' => 'localhost',
        'name' => 'oop_class',
    ),
    
    'routes' => array(
        '' => 'Masterclass\Controller\Index:index',
        'story' => 'Masterclass\Controller\Story:index',
        'story/create' => 'Masterclass\Controller\Story:create',
        'comment/create' => 'Masterclass\Controller\Comment:create',
        'user/create' => 'Masterclass\Controller\User:create',
        'user/account' => 'Masterclass\Controller\User:account',
        'user/login' => 'Masterclass\Controller\User:login',
        'user/logout' => 'Masterclass\Controller\User:logout',
    ),
);
