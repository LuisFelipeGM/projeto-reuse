<?php

namespace Src\App;

use Src\Model\Dao\UsuarioDao;
use Src\Model\Domain\Usuario;
use Src\Views\ToView;

class AdminController
{
  public function __construct()
  {
    $link = url();
    if(!$_SESSION){
      session_destroy();
      echo "<script>";
      echo "location.href='{$link}'";
      echo "</script>";
    }
    if($_SESSION['cd_tipo_usu'] != '3'){
      session_destroy();
      echo "<script>";
      echo "location.href='{$link}'";
      echo "</script>";
    }
  }



    public function home(): void{
        try {

          $usuarioDao = new UsuarioDao();
          $data = $usuarioDao->read();
          $toView = new ToView(URL_VIEW_ADMIN);
          $toView->viewStandard('home', $data);

        } catch (\Exception $exception) {
          
        }
    }

    public function user($data): void{
      try {
        $usuario = new Usuario();
        $usuario->setCdUsu($data['cd_usu']);
        //
        $usuarioDao = new UsuarioDao();
        $data = $usuarioDao->readUserId($usuario);
        $toView = new ToView(URL_VIEW_ADMIN);
        $toView->viewStandard('usuario', $data);

      } catch (\Exception $exception) {
        
      }
  }

  public function SaveUser($data): void
  {
    try {
      $array_remover_caracter = array("-", " ");
      $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
      $data['cep'] = str_replace($array_remover_caracter, "", $data['cep']);
      $usuario = new Usuario();
      $usuario->setCdUsu($data['cd_usu']);
      $usuario->setCdStatusUsu($data['status']);
      $usuario->setSenhaUsu($data['senha']);
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
      $usuarioDao->uptadeUserAdm($usuario);
      $data = $usuarioDao->readUserId($usuario);
      $toView = new ToView(URL_VIEW_ADMIN);
      $toView->viewStandard('usuario', $data);
      //var_dump($data);exit;
    } catch (\Exception $exception) {
    }
  }

  


}