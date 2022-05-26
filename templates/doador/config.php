<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="<?= url("templates/doador/css/configdoador/configstyle_default.css"); ?>">
    <link rel="stylesheet" media="screen and (max-width:480px)" href="<?= url("templates/doador/css/configdoador/configstyle480.css"); ?>">
    <link rel="stylesheet" media="screen and (min-width:481px) and (max-width:768px)" href="<?= url("templates/doador/css/configdoador/configstyle768.css"); ?>">
    <link rel="stylesheet" media="screen and (min-width:769px) and (max-width:1024px)" href="<?= url("templates/doador/css/configdoador/configstyle1024.css"); ?>">
    <link rel="stylesheet" media="screen and (min-width:1025px)" href="<?= url("templates/doador/css/configdoador/configstyle1025.css"); ?>">

    <link rel="shortcut icon" href="<?=url("templates/images/logo_semnome.png");?>" type="image/x-png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurações</title>
    <script type="text/Javascript" src="<?= url("templates/doador/jscript/configuracao.js"); ?>"></script>
    <script type="text/Javascript" src="<?= url("templates/doador/jscript/functions.js"); ?>"></script>
    <script type="text/javascript" src="<?= url("templates/doador/jquery/jquery.js"); ?>"></script>
    <script type="text/javascript" src="<?= url("templates/doador/jquery/jquery.mask.js"); ?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#celular, #telefone").mask("(00) 00000-0000");
            $("#cep ").mask("00000-000");

            // Consulta CEP
            $('#cep').blur(function() {
                var valor = $('#cep').val();
                var retorno = valor.replace('-', '').replace('.', '');
                $.ajax({
                    url: '/projeto-reuse/templates/web/consultar_cep.php', 
                    type: 'POST', 
                    data: 'cep=' + retorno, 
                    dataType: 'json', 
                    success: function(data) {
                        if (data.sucesso == 1) {
                            $('#rua').val(data.rua);
                            $('#bairro').val(data.bairro);
                            $('#cidade').val(data.cidade);
                            $('#complemento').val('');
                            $('#numero').focus();
                        }
                    }
                });
                return false;
            });
        });
    </script>
</head>

<body>
    <header>
        <div id="cabecalho"></div>
        <img src="<?= url("templates/images/configuracoes.png"); ?>" alt="configuracao" id="configuracao">
        <h1>Configurações</h1>
        <a href="<?= url("doador/"); ?>"><img src="<?= url("templates/images/home.png"); ?>" id="home"></a>
        <figure>
            <img onclick ="toggle()" src="<?= url("templates/images/doador_mobile.png"); ?>" id="perfil" alt="perfil">
            <figcaption onclick ="toggle()">Alterar Foto</figcaption>
        </figure>
        <div id="pop">
            <img src="<?= url("templates/images/sair.png"); ?>" alt="sair" id="sair" onclick="sair()">
            <h3>Ops!</h3>
            <p>O serviço está em manutenção.</p>
        </div>
        <div class="botao">
            <button onclick="botao_conf(0)" id="endereco" type="submit">Dados do usuário</button>
            <button onclick="botao_conf(1)" id="usuario" type="submit">Dados de endereço</button>
        </div>
    </header>
    <main>
        <form action="<?= url("doador/configuracao/salvar1/" . $_SESSION['cd_usu']); ?>" method="post">
            <section id="dados_usuario">
                <div id="direita">
                    <label>Nome Completo: </label><br>
                    <input name="nome" id="nome" onkeypress="return letras()" type="text" value="<?= $data[0]['nome_usu']; ?>"><br>

                    <label>E-mail: </label><br>
                    <input name="email" id="email" type="email" value="<?= $data[0]['email_usu']; ?>">
                    <p id="erro_email">E-mail Inválido</p>

                    <label>CPF/CNPJ: </label>
                    <input name="CPF" id="cpf" type="text" value="<?= $data[0]['id_doc_usu']; ?>">
                </div>

                <label id="label_telefone">Telefone: </label>
                <input name="telefone" id="telefone" type="text" value="<?= $data[0]['tel_fixo_usu']; ?>">

                <label>Celular: </label>
                <input name="celular" id="celular" type="text" value="<?= $data[0]['tel_cel_usu']; ?>"><br>

                <label id="label_senha">Senha: </label>
                <input name="senha" id="senha" minlength="8" type="password" value="<?= $data[0]['senha_usu']; ?>">
                <img src="<?= url("templates/images/olhosenha.gif"); ?>" alt="olho" id="olho" onclick="mostrar_senha()">

                <label>Confirmar Senha: </label>
                <input name="conf_senha" id="conf_senha" minlength="8" type="password" value="<?= $data[0]['senha_usu']; ?>">
                <p id="erro">Por favor, insira corretamente a senha informada</p>

        

                <div style="text-align: center;">
                        <button class="apagar " onclick="sumirEndereco()" id="apagar_usuario" type="reset">Apagar edição</button>
                    <div class="enviar" id="enviar_usuario" type="submit">
                        <button id="enviar_usuario" type="submit">Atualizar</button>
                    </div>
                </div>
            </section>
        </form>
        <form onclick="confirmarExclusao()" action="<?= url("doador/configuracao/excluir/" . $_SESSION['cd_usu']); ?>" method="post" name="formExcluirCad" id="formExcluirCad">
            <div id="fundo_desativar">
                <img id="desativar" src="<?= url("templates/images/x.gif"); ?>" alt="desativar">
                <label id="desativar_p">Eu quero desativar minha conta</label>
            </div>
            <script>
                function confirmarExclusao() {
                    confirmar = confirm("\nConfirmar exclusão do cadastro?\n\nApós a exclusão, os dados não poderão ser recuperados.");
                    if(confirmar) {
                        document.formExcluirCad.submit();
                    }
                }
            </script>
        </form>
        <form action="<?= url("doador/configuracao/salvar2/" . $_SESSION['cd_usu']); ?>" method="post">
            <section id="dados_endereco">
                <h2>Informações de Endereço</h2><br>

                <label id="label_cep">CEP: </label>
                <input name="cep" id="cep" type="text" value="<?= $data[0]['cep_usu']; ?>">

                <label>Cidade: </label>
                <input name="cidade" id="cidade" onkeypress="return letras()" type="text" value="<?= $data[0]['cidade_end_usu'];?>"><br>

                <label id="label_bairro">Bairro: </label>
                <input name="bairro" id="bairro" onkeypress="return letras()" type="text" value="<?= $data[0]['bairro_end_usu'];?>">

                <label>Rua: </label>
                <input name="rua" id="rua" type="text" value="<?=$data[0]['rua_end_usu'];?>">

                <label id="label_numero">Numero: </label>
                <input name="numero" id="numero" type="number" value="<?=$data[0]['num_end_usu'];?>">

                <label>Complemento: </label>
                <input name="complemento" id="complemento" type="text" value="<?=$data[0]['compl_end_usu'];?>">

                <div style="text-align: center;">
                        <button class="apagar " onclick="sumirEndereco()" id="apagar_usuario" type="reset">Apagar edição</button>
                    <div class="enviar" id="enviar_usuario" type="submit">
                        <button id="enviar_usuario" type="submit">Atualizar</button>
                    </div>
                </div>
            </section>
        </form>
        <footer>
            <div class="final">
                <p>&copy;Reuse.Todos os direitos reservados</p>
            </div>
        </footer>
    </main>
</body>

</html>