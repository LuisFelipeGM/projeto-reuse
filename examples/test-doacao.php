<?php
require __DIR__.'/../vendor/autoload.php';

use Src\Model\Domain\Doacao;
use Src\Model\Dao\DoacaoDao;

$Doacao = new Doacao();
$Doacao->setCdUsuDoa("1");
$Doacao->setCdUsuRecebe("5");
$Doacao->setDataHoraDoacao("11");
$Doacao->setCdStatusDoacao("A");

$DoacaoDao = new DoacaoDao();
$DoacaoDao->create($Doacao);
