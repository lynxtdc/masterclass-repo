<?php

namespace Masterclass\Configuration;

use Aura\Di\Config;
use Aura\Di\Container;

class View extends Config
{
    public function define(Container $di)
    {
        $config = $di->get('config');

        $di->params['Aura\View\View'] = array(
            'view-registry' => $di->lazyNew('Aura\View\TemplateRegistry', ['map' => $config['views']]),
            'layout-registry' => $di->lazyNew('Aura\View\TemplateRegistry', ['map' => $config['layouts']]),
            'helpers' => $di->lazyNew('Aura\View\HelperRegistry'),
        );
    }
}