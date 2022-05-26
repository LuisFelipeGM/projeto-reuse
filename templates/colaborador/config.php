<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="<?= url("templates/colaborador/css/configcolaborador/configcolaborador_default.css"); ?>">
    <link rel="stylesheet" media="screen and (max-width:480px)" href="<?= url("templates/colaborador/css/configcolaborador/configstyle480.css"); ?>">
    <link rel="stylesheet" media="screen and (min-width:481px) and (max-width:768px)" href="<?= url("templates/colaborador/css/configcolaborador/configstyle768.css"); ?>">
    <link rel="stylesheet" media="screen and (min-width:769px) and (max-width:1024px)" href="<?= url("templates/colaborador/css/configcolaborador/configstyle1024.css"); ?>">
    <link rel="stylesheet" media="screen and (min-width:1025px)" href="<?= url("templates/colaborador/css/configcolaborador/configstyle1025.css"); ?>">

    <link rel="shortcut icon" href="<?= url("templates/images/logo_semnome.png"); ?>" type="image/x-png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurações</title>
    <script type="text/Javascript" src="<?= url("templates/colaborador/jscript/configuracao.js"); ?>"></script>
    <script type="text/Javascript" src="<?= url("templates/colaborador/jscript/functions.js"); ?>"></script>
    <script type="text/javascript" src="<?= url("templates/colaborador/jquery/jquery.js"); ?>"></script>
    <script type="text/javascript" src="<?= url("templates/colaborador/jquery/jquery.mask.js"); ?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#celular, #telefone").mask("(00) 00000-0000");
            $("#cep ").mask("00000-000");

            $("#select_colab option[value='<?= $data[0]['cd_material']; ?>']").prop('selected', true);


            // Consulta CEP
            $('#cep').blur(function() {
                var valor = $('#cep').val();
                var retorno = valor.replace('-', '').replace('.', '');
                $.ajax({
                    url: '/projeto-reuse/templates/web/consultar_cep.php', // URL que ser� chamada
                    type: 'POST', // Tipo da requisi��o
                    data: 'cep=' + retorno, // dado que ser� enviado via POST
                    dataType: 'json', // Tipo de transmiss�o
                    success: function(data) {
                        if (data.sucesso == 1) {
                            $('#rua').val(data.rua);
                            $('#bairro').val(data.bairro);
                            $('#cidade').val(data.cidade);
                            //$('#uf').val(data.estado);
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
        <a href="<?= url("colaborador/"); ?>"><img src="<?= url("templates/images/home.png"); ?>" id="home"></a>
        <figure>
            <img src="<?= url("templates/images/colaborador_mobile.png"); ?>" onclick="toggle()" id="perfil" alt="perfil">
            <figcaption onclick="toggle()">Alterar Foto</figcaption>
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
        <form action="<?= url("colaborador/configuracao/salvar3/" . $_SESSION['cd_usu']); ?>" method="post">
            <section id="dados_usuario">
                <div id="direita">
                    <label id="nome_completo">Nome Completo: </label><br>
                    <input name="nome" id="nome" onkeypress="return letras()" type="text" value="<?= $data[0]['nome_usu']; ?>"><br>

                    <label id="email_completo">E-mail: </label><br>
                    <input name="email" id="email" type="email" value="<?= $data[0]['email_usu']; ?>">
                    <p id="erro_email">E-mail Inválido</p>

                    <label id="label_selecionar_material" for="selecione_material">Selecione o material coletado:</label>
                    <select id="select_colab" name="material">
                        <option value="8">Todos os reciclaveis</option>
                        <option value="1">Papel</option>
                        <option value="2">Plástico</option>
                        <option value="3">Metal</option>
                        <option value="4">Vidro</option>
                        <option value="6">Perigosos</option>
                        <option value="7">Outros</option>
                        <option value="5">Eletrônicos</option>
                    </select>
                </div>

                <label id="label_telefone">Telefone: </label>
                <input name="telefone" id="telefone" type="text" value="<?= $data[0]['tel_fixo_usu']; ?>">

                <label>Celular: </label>
                <input name="celular" id="celular" type="text" value="<?= $data[0]['tel_cel_usu']; ?>"><br>

                <label id="label_senha">Senha: </label>
                <input name="senha" id="senha" minlength="8" type="password" value="<?= $data[0]['senha_usu']; ?>">
                <img src="<?= url("templates/images/olhosenha.gif"); ?>" alt="olho" id="olho" onclick="mostrar_senha()">

                <label>Confirmar Senha: </label><input name="conf_senha" id="conf_senha" minlength="8" type="password" value="<?= $data[0]['senha_usu']; ?>">
                <p id="erro">Por favor, insira corretamente a senha informada</p>

                <label id="label_cpf">CPF/CNPJ: </label>
                <input name="CPF" id="cpf" type="text" value="<?= $data[0]['id_doc_usu']; ?>">


                <div style="text-align: center;">
                    <button class="apagar " onclick="sumirEndereco()" class="apagar_usuario" type="reset">Apagar edição</button>
                    <div class="enviar" id="enviar_usuario" type="submit">
                        <button id="enviar_usuario" type="submit">Atualizar</button>
                    </div>
                </div>
            </section>
        </form>

        <form onclick="confirmarExclusao()" action="<?= url("colaborador/configuracao/excluir/" . $_SESSION['cd_usu']); ?>" method="post" name="formExcluirCad" id="formExcluirCad">
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


        <form action="<?= url("colaborador/configuracao/salvar4/" . $_SESSION['cd_usu']); ?>" method="post">
            <section id="dados_endereco">
                <h2>Informações de Endereço</h2><br>

                <label id="label_cep">CEP: </label>
                <input name="cep" id="cep" type="text" value="<?= $data[0]['cep_usu']; ?>">

                <label>Cidade: </label>
                <input name="cidade" id="cidade" onkeypress="return letras()" type="text" value="<?= $data[0]['cidade_end_usu']; ?>"><br>

                <label id="label_bairro">Bairro: </label>
                <input name="bairro" id="bairro" onkeypress="return letras()" type="text" value="<?= $data[0]['bairro_end_usu']; ?>">

                <label>Rua: </label>
                <input name="rua" id="rua" type="text" value="<?= $data[0]['rua_end_usu']; ?>"><br>

                <label>Numero: </label>
                <input name="numero" id="numero" type="number" value="<?= $data[0]['num_end_usu']; ?>">

                <label id="label_complemento">Complemento: </label>
                <input name="complemento" id="complemento" type="text" value="<?= $data[0]['compl_end_usu']; ?>">


                <div style="text-align: center;">
                    <button class="apagar " onclick="sumirEndereco()" class="apagar_usuario" type="reset">Apagar edição</button>
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