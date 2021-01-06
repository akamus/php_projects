<?php

require_once '../vendor/autoload.php';
include_once '../config/config.php';

use Package\Controller;

$main = new Controller();

echo "<script>console.log('start')</script>";

//alterar filtros nesta linha
//cefet-mg
//analista-da-tecnologia-da-informacao
//fcc-tecnologia
$filtros = ['fcc-sistemas', ''];

$start_time = microtime(true);

$main->processar($filtros);

//var_dump($config);

$end_time = microtime(true);

// Calculate script execution time
$execution_time = ($end_time-$start_time);

echo " Execution time of script = ".$execution_time." sec";