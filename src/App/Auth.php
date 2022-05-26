<?php

namespace Src\App;

use Src\Model\Domain\Usuario;
use Src\Model\Dao\UsuarioDao;


class Auth
{
    public function logon($data): void
    {
        try {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $usuario = new Usuario();
            $usuario->setEmailUsu($data['email']);
            $usuario->setSenhaUsu($data['senha']);
            $usuarioDao = new UsuarioDao();
            $result = $usuarioDao->login($usuario);

            if (count($result) > 0) {
                if ($result[0]['cd_status_usu'] == 'A') {
                    $_SESSION['cd_usu'] = $result[0]['cd_usu'];
                    $_SESSION['cd_tipo_usu'] = $result[0]['cd_tipo_usu'];
                    $_SESSION['nome_usu'] = $result[0]['nome_usu'];
                    $_SESSION['cd_tipo_usu'] = $result[0]['cd_tipo_usu'];
                    /*
                    $_SESSION['email_usu'] = $result[0]['email_usu'];
                    $_SESSION['id_doc_usu'] = $result[0]['id_doc_usu'];
                    $_SESSION['senha_usu'] = $result[0]['senha_usu'];
                    $_SESSION['tel_fixo_usu'] = $result[0]['tel_fixo_usu'];
                    $_SESSION['tel_cel_usu'] = $result[0]['tel_cel_usu'];
                    $_SESSION['cep_usu'] = $result[0]['cep_usu'];
                    $_SESSION['cidade_end_usu'] = $result[0]['cidade_end_usu'];
                    $_SESSION['bairro_end_usu'] = $result[0]['bairro_end_usu'];
                    $_SESSION['rua_end_usu'] = $result[0]['rua_end_usu'];
                    $_SESSION['num_end_usu'] = $result[0]['num_end_usu'];
                    $_SESSION['compl_end_usu'] = $result[0]['compl_end_usu'];
                    $_SESSION['cd_tipo_usu'] = $result[0]['cd_tipo_usu'];
                    $_SESSION['cd_status_usu'] = $result[0]['cd_status_usu'];
                    */
                    switch ($result[0]['cd_tipo_usu']) {
                        case '3':
                            $uri = 'admin';
                            break;
                        case '1':
                            $uri = 'doador';
                            break;
                        case '2';
                            $uri = 'colaborador';
                            break;

                        default:
                            $uri = 'authentication/logoff';
                            break;
                    }

                    echo "<script>";
                    echo "location.href='" . url($uri) . "'";
                    echo "</script>";
                } else {
                    echo "<script>";
                    echo "location.href='" . url('erro/usuarioinativo') . "'";
                    echo "</script>";
                }
            } else {
                echo "<script>";
                echo "location.href='" . url('erro/errosenha') . "'";
                echo "</script>";
            }
        } catch (\Exception $execption) {
        }
    }
    public function logoff($data): void
    {
        try {
            session_destroy();
            echo "<script>";
            echo "location.href='" . url() . "'";
            echo "</script>";
        } catch (\Exception $exception) {
        }
    }


    public function register($data): void
    {
        $array_remover_caracter = array("-", " ");
        try {
            if (isset($data['tipodoador'])) {
                $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
                $usuario = new Usuario();
                $usuario->setNomeUsu($data['nome']);
                $usuario->setEmailUsu($data['email']);
                $usuario->setIdDocUsu($data['cpf']);
                $usuario->setTelFixoUsu($data['telefone']);
                $usuario->setTelCelUsu($data['celular']);
                $usuario->setSenhaUsu($data['senha']);
                $data['cep'] = str_replace($array_remover_caracter, "", $data['cep']);
                $usuario->setCepUsu($data['cep']);
                $usuario->setCidadeEndUsu($data['cidade']);
                $usuario->setBairroEndUsu($data['bairro']);
                $usuario->setRuaEndUsu($data['rua']);
                $usuario->setNumEndUsu($data['numero']);
                $usuario->setComplEndUsu($data['complemento']);
                $usuario->setCdTipoUsu('1');
                $usuario->setCdStatusUsu('A');
            } elseif (isset($data['tipocolaborador'])) {
                $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
                $usuario = new Usuario();
                $usuario->setNomeUsu($data['nome']);
                $usuario->setEmailUsu($data['email']);
                $usuario->setIdDocUsu($data['cpf']);
                $usuario->setTelFixoUsu($data['telefone']);
                $usuario->setTelCelUsu($data['celular']);
                $usuario->setSenhaUsu($data['senha']);
                $usuario->setCdMaterial($data['material']);
                $data['cep'] = str_replace($array_remover_caracter, "", $data['cep']);
                $usuario->setCepUsu($data['cep']);
                $usuario->setCidadeEndUsu($data['cidade']);
                $usuario->setBairroEndUsu($data['bairro']);
                $usuario->setRuaEndUsu($data['rua']);
                $usuario->setNumEndUsu($data['numero']);
                $usuario->setComplEndUsu($data['complemento']);
                $usuario->setCdTipoUsu('2');
                $usuario->setCdStatusUsu('A');
                // Gera coordenadas do endereco
                $ENDERECO = str_replace("\n", "", str_replace("\r", "", trim($data['rua'])));
                $NUM = $data['numero'];
                $BAIRRO = $data['bairro'];
                $CIDADE = $data['cidade'];
                $CEP = $data['cep'];
                $CEP_FINAL = substr($CEP, 0, -3) . "-" . substr($CEP, -3); // Formata
                $ENDERECO_FINAL = UsuarioDao::maiusculo("$ENDERECO, $NUM - $BAIRRO, $CIDADE, $CEP_FINAL"); // Gera endereco a ser buscado no Google
                $obj = UsuarioDao::gerarCoordenadas($ENDERECO_FINAL);
                if (!$obj->results[0]->geometry->location->lat) {
                    $LATITUDE = 0;
                    $LONGITUDE = 0;
                } else {
                    $LATITUDE = $obj->results[0]->geometry->location->lat;
                    $LONGITUDE = $obj->results[0]->geometry->location->lng;
                }
                // Atribui
                $usuario->setEndLatitude($LATITUDE);
                $usuario->setEndLongitude($LONGITUDE);
            }

            $usuarioDao = new UsuarioDao();
            if ($data['senha'] == $data['conf_senha']) {
                if ($usuarioDao->create($usuario)) {
                    // direcionando para fazer o login
                    echo "<script>";
                    echo "location.href='" . url("login") . "'";
                    echo "</script>";
                } else {
                    echo "<script>";
                    echo "location.href='" . url('erro/errocadastro') . "'";
                    echo "</script>";
                }
            }
        } catch (\Exception $exception) {
        }
    }
}
