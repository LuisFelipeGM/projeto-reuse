<?php
require __DIR__.'/../vendor/autoload.php';

use Src\Model\Domain\TipoUsuario;
use Src\Model\Dao\TipoUsuarioDao;

$TipoUsuario = new TipoUsuario();
$TipoUsuario->setDescTipoUsu("ADM");
$TipoUsuario->setStatusTipoUsu("A");

$TipoUsuarioDao = new TipoUsuarioDao();
$TipoUsuarioDao->create($TipoUsuario);

