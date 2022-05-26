<?php

namespace Src\App;

use Src\Model\Dao\UsuarioDao;
use Src\Model\Domain\Usuario;
use Src\Views\ToView;

class DoadorController
{
  public function __construct()
  {
    $link = url();
    if (!$_SESSION) {
      session_destroy();
      echo "<script>";
      echo "location.href='{$link}'";
      echo "</script>";
    }
    if ($_SESSION['cd_tipo_usu'] != '1') {
      session_destroy();
      echo "<script>";
      echo "location.href='{$link}'";
      echo "</script>";
    }
  }

  public function home(): void
  {
    try {
      $toView = new ToView(URL_VIEW_DOADOR);
      $toView->viewStandard('home');
    } catch (\Exception $exception) {
    }
  }

  public function config($data): void
  {
    try {
      $usuario = new Usuario();
      $usuario->setCdUsu($data['cd_usu']);
      //
      $usuarioDao = new UsuarioDao();
      $data = $usuarioDao->readUserId($usuario);
      $toView = new ToView(URL_VIEW_DOADOR);
      $toView->viewStandard('config', $data);
      //var_dump($data);
    } catch (\Exception $exception) {
    }
  }


  // SALVAR ID DO DOADOR
  public function configSalvar1($data): void
  {
    try {
      $array_remover_caracter = array("-", " ");
      $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
      $usuario = new Usuario();
      $usuario->setCdUsu($data['cd_usu']);
      $usuario->setNomeUsu($data['nome']);
      $usuario->setEmailUsu($data['email']);
      $usuario->setIdDocUsu($data['CPF']);
      $usuario->setSenhaUsu($data['senha']);
      $usuario->setTelFixoUsu($data['telefone']);
      $usuario->setTelCelUsu($data['celular']);
      //
      $usuarioDao = new UsuarioDao();
      $usuarioDao->uptadeUserIdDoad($usuario);
      $data = $usuarioDao->readUserId($usuario);
      $toView = new ToView(URL_VIEW_DOADOR);
      $toView->viewStandard('config', $data);
      //var_dump($data);*/
    } catch (\Exception $exception) {
    }
  }

  // SALVAR ENDERECO DO DOADOR
  public function configSalvar2($data): void
  {
    try {
      $array_remover_caracter = array("-", " ");
      $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
      $usuario = new Usuario();
      $usuario->setCdUsu($data['cd_usu']);
      $usuario->setCepUsu(str_replace($array_remover_caracter,"",$data['cep']));
      $usuario->setRuaEndUsu(UsuarioDao::maiusculo($data['rua']));
      $usuario->setCidadeEndUsu(UsuarioDao::maiusculo($data['cidade']));
      $usuario->setBairroEndUsu(UsuarioDao::maiusculo($data['bairro']));
      $usuario->setNumEndUsu($data['numero']);
      $usuario->setComplEndUsu(UsuarioDao::maiusculo($data['complemento']));
      //
      $usuarioDao = new UsuarioDao();
      $usuarioDao->uptadeUserEndDoad($usuario);
      $data = $usuarioDao->readUserId($usuario);
      $toView = new ToView(URL_VIEW_DOADOR);
      $toView->viewStandard('config', $data);
      //var_dump($data);*/
    } catch (\Exception $exception) {
    }
  }

  public function maps_dashboard(): void
  {
    try {
      $toView = new ToView(URL_VIEW_DOADOR);
      $toView->viewStandard('maps_dashboard');
    } catch (\Exception $exception) {
    }
  }

  public function excluir($data): void
  {
    try {
      $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
      //
      $usuario = new Usuario();
      $usuario->setCdUsu($data['cd_usu']);
      //
      $usuarioDao = new UsuarioDao();
      $usuarioDao->delete($usuario);
      session_destroy();
      echo "<script>";
      echo "location.href='" . url() . "'";
      echo "</script>";
      //var_dump($data);*/
    } catch (\Exception $exception) {
    }
  }
  
}
