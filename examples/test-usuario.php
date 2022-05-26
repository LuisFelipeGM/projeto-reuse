<?php
require __DIR__.'/../vendor/autoload.php';

use Src\Model\Domain\Usuario;
use Src\Model\Dao\UsuarioDao;

$Usuario = new Usuario();
$Usuario->setNomeUsu("Reuse");
$Usuario->setEmailUsu("suportedenuncia@projetoreuse.com");
$Usuario->setIdDocUsu("06819422824");
$Usuario->setSenhaUsu("12345678");
$Usuario->setTelFixoUsu("1141879515");
$Usuario->setTelCelUsu("11974713215");
$Usuario->setCepUsu("06385680");
$Usuario->setCidadeEndUsu("Carapicuiba");
$Usuario->setBairroEndUsu("Jardim Ângela Maria");
$Usuario->setRuaEndUsu("Rua Ituverava");
$Usuario->setNumEndUsu("Número 01");
$Usuario->setComplEndUsu("Casa 01");
$Usuario->setCdTipoUsu("3");
$Usuario->setCdStatusUsu("A");

$UsuarioDao = new UsuarioDao();
var_dump(
    $UsuarioDao->create($Usuario)
);