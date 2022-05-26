<?php
require __DIR__.'/../vendor/autoload.php';

use Src\Model\Domain\TipoMaterial;
use Src\Model\Dao\TipoMaterialDao;

$tipoMaterial = new TipoMaterial();
$tipoMaterial->setDescTipoMaterial("Outros");
$tipoMaterial->setCdStatusMaterial("A");

$tipoMaterialDao = new TipoMaterialDao();
$tipoMaterialDao->create($tipoMaterial);
