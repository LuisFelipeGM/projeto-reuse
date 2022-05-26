<?php

namespace Src\App;

use Src\Model\Dao\UsuarioDao;
use Src\Model\Domain\Usuario;
use Src\Views\ToView;

class ColaboradorController
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
    if ($_SESSION['cd_tipo_usu'] != '2') {
      session_destroy();
      echo "<script>";
      echo "location.href='{$link}'";
      echo "</script>";
    }
  }



  public function home(): void
  {
    try {
      $toView = new ToView(URL_VIEW_COLABORADOR);
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
      $toView = new ToView(URL_VIEW_COLABORADOR);
      $toView->viewStandard('config', $data);
      //var_dump($data);
    } catch (\Exception $exception) {
    }
  }


  // SALVAR ID DO COLABORADOR
  public function configSalvar3($data): void
  {
    try {
      $array_remover_caracter = array("-", " ");
      $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
      $usuario = new Usuario();
      $usuario->setCdUsu($data['cd_usu']);
      $usuario->setNomeUsu($data['nome']);
      $usuario->setEmailUsu($data['email']);
      $usuario->setCdMaterial($data['material']);
      $usuario->setIdDocUsu($data['CPF']);
      $usuario->setSenhaUsu($data['senha']);
      $usuario->setTelFixoUsu($data['telefone']);
      $usuario->setTelCelUsu($data['celular']);
      //
      $usuarioDao = new UsuarioDao();
      $usuarioDao->uptadeUserIdColab($usuario);
      $data = $usuarioDao->readUserId($usuario);
      $toView = new ToView(URL_VIEW_COLABORADOR);
      $toView->viewStandard('config', $data);
      //var_dump($data);*/
    } catch (\Exception $exception) {
    }
  }


  // SALVAR ENDERECO DO COLABORADOR
  public function configSalvar4($data): void
  {
    try {
      $array_remover_caracter = array("-", " ");
      $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
      $data['cep'] = str_replace($array_remover_caracter, "", $data['cep']);
      $usuario = new Usuario();
      $usuario->setCdUsu($data['cd_usu']);
      $usuario->setCepUsu($data['cep']);
      $usuario->setRuaEndUsu(UsuarioDao::maiusculo($data['rua']));
      $usuario->setCidadeEndUsu(UsuarioDao::maiusculo($data['cidade']));
      $usuario->setBairroEndUsu(UsuarioDao::maiusculo($data['bairro']));
      $usuario->setNumEndUsu($data['numero']);
      $usuario->setComplEndUsu(UsuarioDao::maiusculo($data['complemento']));
      // Gera coordenadas do endereco
      $ENDERECO = str_replace("\n","",str_replace("\r","",trim($data['rua'])));
      $NUM = $data['numero'];
      $BAIRRO = $data['bairro'];
      $CIDADE = $data['cidade'];
      $CEP = $data['cep'];
      $CEP_FINAL = substr($CEP, 0, -3)."-".substr($CEP, -3); // Formata
      $ENDERECO_FINAL = UsuarioDao::maiusculo("$ENDERECO, $NUM - $BAIRRO, $CIDADE, $CEP_FINAL"); // Gera endereco a ser buscado no Google
      $obj = UsuarioDao::gerarCoordenadas($ENDERECO_FINAL);
      if(!$obj->results[0]->geometry->location->lat) {
        $LATITUDE = 0;
        $LONGITUDE = 0;
      }
      else {
        $LATITUDE = $obj->results[0]->geometry->location->lat;
        $LONGITUDE = $obj->results[0]->geometry->location->lng;
      }
      // Atribui
      $usuario->setEndLatitude($LATITUDE);
      $usuario->setEndLongitude($LONGITUDE);
      //
      $usuarioDao = new UsuarioDao();
      $usuarioDao->uptadeUserEndColab($usuario);
      $data = $usuarioDao->readUserId($usuario);
      $toView = new ToView(URL_VIEW_COLABORADOR);
      $toView->viewStandard('config', $data);
      //var_dump($data);*/
    } catch (\Exception $exception) {
    }
  }

  public function maps_dashboard(): void
  {
    try {
      $toView = new ToView(URL_VIEW_COLABORADOR);
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
