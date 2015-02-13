<?php

$di = new \Aura\Di\Container(new \Aura\Di\Factory());

/**
 * Start Controllers
 */

$di->params['Masterclass\MasterController'] = [
    'container' => $di,
    'config' => $config,
];

$di->params['Masterclass\Controller\Index'] = [
    'story' => $di->lazyNew('Masterclass\Model\Story'),
];

$di->params['Masterclass\Controller\Comment'] = [
    'commentModel' => $di->lazyNew('Masterclass\Model\Comment'),
];

$di->params['Masterclass\Controller\Story'] = [
    'storyModel' => $di->lazyNew('Masterclass\Model\Story'),
    'comment' => $di->lazyNew('Masterclass\Model\Comment'),
];

$di->params['Masterclass\Controller\User'] = [
    'userModel' => $di->lazyNew('Masterclass\Model\User'),
];

/**
 * Start Models
 */

$di->params['Masterclass\Model\Comment'] = [
    'pdo' => $di->lazyNew('PDO'),
];

$di->params['Masterclass\Model\Story'] = [
    'pdo' => $di->lazyNew('PDO'),
];

$di->params['Masterclass\Model\User'] = [
    'pdo' => $di->lazyNew('PDO'),
];

/**
 * Start supporting players
 */

$di->params['PDO'] = [
    'dsn' => 'mysql:host=' . $config['database']['host'] . ';dbname=' . $config['database']['name'],
    'username' => $config['database']['user'],
    'passwd' => $config['database']['pass']
];