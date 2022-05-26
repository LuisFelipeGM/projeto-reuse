<?php
require __DIR__.'/../vendor/autoload.php';

use Src\Model\Domain\Material;
use Src\Model\Dao\MaterialDao;

$Material = new Material();
$Material->setNomeMaterial("Outros");
$Material->setDescMaterial("Outros");
$Material->setCdTipoMaterial("4");
$Material->setCdStatusMaterial("A");

$MaterialDao = new MaterialDao();
$MaterialDao->create($Material);