<?php
namespace Masterclass\Configuration;

use Aura\Di\Config;
use Aura\Di\Container;

class DiConfig extends Config
{
    public function define(Container $di)
    {
        $config = $di->get('config');

        $db = $config['database'];

        $dsn = 'mysql:host=' . $db['host'] .';dbname=' . $db['name'];

        $di->params['Masterclass\Dbal\AbstractDb'] = [
            'dsn' => $dsn,
            'user' => $db['user'],
            'pass' => $db['pass'],
        ];

        $di->params['Master']
    }
}