<?php
require __DIR__.'/../vendor/autoload.php';

use Src\Model\Domain\Coleta;
use Src\Model\Dao\ColetaDao;

$Coleta = new Coleta();
$Coleta->setCdUsu("1");
$Coleta->setCdMaterial("3");

$ColetaDao = new ColetaDao();
var_dump(
    $ColetaDao->create($Coleta)
);