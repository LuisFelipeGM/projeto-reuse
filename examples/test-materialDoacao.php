<?php
require __DIR__.'/../vendor/autoload.php';

use Src\Model\Domain\MaterialDoacao;
use Src\Model\Dao\MaterialDoacaoDao;

$MaterialDoacao = new MaterialDoacao();
$MaterialDoacao->setCdMaterial("1");
$MaterialDoacao->setCdDoacao("1");
$MaterialDoacao->setQtdMaterial("30");

$MaterialDoacaoDao = new MaterialDoacaoDao();
$MaterialDoacaoDao->create($MaterialDoacao);