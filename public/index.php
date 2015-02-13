<?php

session_start();

require '../vendor/autoload.php';

$config = require_once('../config.php');
require '../services.php';

$framework = $di->newInstance('Masterclass\MasterController');
echo $framework->execute();