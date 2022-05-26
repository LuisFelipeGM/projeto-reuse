<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="<?= url("templates/web/css/cadastro/cadastrostyle_default.css"); ?>">
    <link rel="stylesheet" media="screen and (max-width:480px)" href="<?= url("templates/web/css/cadastro/cadastrostyle480.css"); ?>">
    <link rel="stylesheet" media="screen and (min-width:481px) and (max-width:768px)" href="<?= url("templates/web/css/cadastro/cadastrostyle768.css"); ?>">
    <link rel="stylesheet" media="screen and (min-width:769px) and (max-width:1024px)" href="<?= url("templates/web/css/cadastro/cadastrostyle1024.css"); ?>">
    <link rel=stylesheet media="screen and (min-width: 1025px)" href="<?= url("templates/web/css/cadastro/cadastrostyle1025.css"); ?>">
    <link rel="shortcut icon" href="<?= url("templates/images/logo_semnome.png"); ?>" type="image/x-png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <script type="text/Javascript" src="<?= url("templates/web/jscript/functions.js"); ?>"></script>
    <!--JavaScript ------------------>
    <script type="text/Javascript" src="<?= url("templates/web/jscript/telasMaiores.js"); ?>"></script>
    <script type="text/Javascript" src="<?= url("templates/web/jscript/colaborador.js"); ?>"></script>
    <script type="text/javascript" src="<?= url("templates/web/jquery/jquery.js"); ?>"></script>
    <!--Jquery ------------------>
    <script type="text/javascript" src="<?= url("templates/web/jquery/jquery.mask.js"); ?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#entidade, #entidade_colab").change(function() {
                if ($(this).val() === "pessoa") {
                    $("#cpf , #cpf_colab").mask("000.000.000-00");
                    $('#cpf , #cpf_colab').attr("placeholder", "CPF");
                }
                if ($(this).val() === "empresa") {
                    $("#cpf , #cpf_colab").mask("00.000.000/0000-00");
                    $('#cpf , #cpf_colab').attr("placeholder", "CNPJ");
                }
            });
            $("#celular , #celular_colab, #telefone, #telefone_colab").mask("(00) 00000-0000");
            $("#cep , #cep_colab").mask("00000-000");
            // Bloquear enter
            $(document).on('keyup keypress', 'form input', function(e) {
                if (e.which == 13) {
                    e.preventDefault();
                    return false;
                }
            });
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
                        }
                    }
                });
                return false;
            });
            $('#cep_colab').blur(function() {
                var valor = $('#cep_colab').val();
                var retorno = valor.replace('-', '').replace('.', '');
                $.ajax({
                    url: '/projeto-reuse/templates/web/consultar_cep.php', // URL que ser� chamada
                    type: 'POST', // Tipo da requisi��o
                    data: 'cep=' + retorno, // dado que ser� enviado via POST
                    dataType: 'json', // Tipo de transmiss�o
                    success: function(data) {
                        if (data.sucesso == 1) {
                            $('#rua_colab').val(data.rua);
                            $('#bairro_colab').val(data.bairro);
                            $('#cidade_colab').val(data.cidade);
                            //$('#uf').val(data.estado);
                        }
                    }
                });
                return false;
            });

        });
    </script>
</head>

<body>
    <div id="tudo">
        <header>
            <div id="cabecalho"></div>
            <a href="<?= url("") ?>">
                <img src="<?= url("templates/images/logo_semnome.png"); ?>" alt="logo" id="logo">
            </a>
            <h1>Área de Cadastro</h1>
            <div id="fundodoad">
                <figure><img src="<?= url("templates/images/Doad.png"); ?>" alt="doador" id="imgdoador"></figure>
            </div>
            <div id="fundocolab">
                <figure><img src="<?= url("templates/images/Colab.png"); ?>" alt="colaborador" id="imgcolaborador"></figure>
            </div>
            <div class="botao">
                <button id="cola" type="submit" onclick="botao(0),telasMaiores(2), animacaoTelasMaiores(4)">Quero ser Doador</button>
                <button id="doa" type="submit" onclick="botao(1),telasMaiores(3),animacaoTelasMaiores(5)">Quero ser Colaborador</button>
            </div>
        </header>
        <main>
            <section id="form_doador">
                <form name="form" action="<?= url("authentication/register"); ?>" method="post">
                    <div class="linhavertical"></div>
                    <h2>Cadastro Doador</h2>
                    <ul id="progresso">
                        <li class="bolinhas">1</li>
                        <li>2</li>
                        <li>3</li>
                    </ul>
                    <section id="parte1">
                        <!--Cadastro Parte 1-->
                        <select required name="select" id="entidade">
                            <option value="" disabled selected>Selecione uma opção</option>
                            <option value="pessoa">Pessoa</option>
                            <option value="empresa">Empresa</option>
                        </select>
                        <input type=hidden name=tipodoador value="doador">
                        <input type="text" onkeypress="return letras()" name="nome" id="nome" placeholder="Nome Completo">
                        <input type="email" name="email" id="email" placeholder="E-mail">
                        <p id="erro_email"> Por favor, preencha um endereço de E-mail válido</p>
                        <input type="text" name="cpf" id="cpf" placeholder="CPF/CNPJ">
                        <input type="text" name="celular" id="celular" placeholder="Celular">
                        <input type="text" name="telefone" id="telefone" placeholder="Telefone">
                        <input type="password" minlength="8" name="senha" id="senha" placeholder="Senha de no mínimo 8 caracteres">
                        <img type="submit" src="<?= url("templates/images/olhosenha.gif"); ?>" alt="olho" id="olho" onclick="mostrar_senha()">
                        <input type="password" name="conf_senha" id="conf_senha" placeholder="Confirme sua senha"><br>
                        <p id="senha_erro">Por favor, insira corretamente a senha informada</p>
                        <div id="prox_botao" onclick="return validarPrimeiraParte()" type="submit">
                            <a id="proximo" onclick="return validarPrimeiraParte()" type="submit">Próximo</a>
                        </div>
                    </section>
                    <section id="parte2">
                        <!--Cadastro Parte 2-->
                        <input type="text" name="cep" id="cep" placeholder="CEP">
                        <input type="text" onkeypress="return letras()" name="cidade" id="cidade" placeholder="Cidade">
                        <input type="text" onkeypress="return letras()" name="bairro" id="bairro" placeholder="Bairro">
                        <input type="text" onkeypress="return letras()" name="rua" id="rua" placeholder="Rua">
                        <input type="number" name="numero" id="numero" placeholder="Numero">
                        <input type="text" name="complemento" id="complemento" placeholder="Complemento"><br>
                        <br>
                        <input type="checkbox" name="termo" id="termo" value="termo" style="width:auto!important;margin:0px!important;opacity:1!important;position:static!important;" />
                        <a href="<?= url("login/termosdeuso") ?>" target="_blank" style="text-decoration:none;font-size:12px;">Eu concordo com os <u>termos de uso</u></a>
                        <!-- -->
                        <br>
                        <div class="voltar" onclick="voltarPrimeiroRegistro()">
                            <a id="voltar1" onclick="voltarPrimeiroRegistro()" type="submit" name="voltar" value="voltar">Voltar</a>
                        </div>
                        <div class="p_proximo2" onclick="return validarSegundaParte()">
                            <a id="proximo2" onclick="return  validarSegundaParte()" type="submit" name="proximo" value="proximo">Próximo</a>
                        </div>
                    </section>
                    <section id="parte3">
                        <!--Cadastro Parte 3-->
                        <figure>
                            <img src="<?= url("templates/images/cadastro_realizado.png"); ?>" alt="castro_concluido" id="cadastro_realizado">
                            <figcaption id="cadastro_concluido">Cadastro Pré Finalizado,<br>para concluir de próximo!</figcaption>
                        </figure>
                        <div class="voltar" onclick="voltarSegundoRegistro()">
                            <a id="voltar2" onclick="voltarSegundoRegistro()" type="submit" name="voltar" value="voltar">Voltar</a>
                        </div>
                        <div class="p_proximo2">
                            <button id="proximo3" type="submit" name="proximo" value="proximo">Próximo</button>
                        </div>
                    </section>
                </form>
            </section>
            <section id="form_colab">
                <!--Cadastro Colaborador-->
                <form name="form_colab" action="<?= url("authentication/register"); ?>" method="post">
                    <div class="linhavertical"></div>
                    <h2 id="cadastro">Cadastro Colaborador</h2>
                    <ul id="progresso">
                        <li class="bolinhas">1</li>
                        <li>2</li>
                        <li>3</li>
                    </ul>
                    <section id="parte1_colab">
                        <!--parte1-->
                        <select required id="entidade_colab">
                            <option value="" disabled selected>Selecione uma opção</option>
                            <option value="pessoa">Pessoa</option>
                            <option value="empresa">Empresa</option>
                        </select>
                        <input type=hidden name=tipocolaborador value="colaborador">
                        <input type="text" onkeypress="return letras()" name="nome" id="nome_colab" placeholder="Nome Completo">
                        <input type="email" name="email" id="email_colab" placeholder="E-mail">
                        <p id="erro_email_colab"> Por favor, preencha um endereço de E-mail válido</p>
                        <input type="text" name="cpf" id="cpf_colab" placeholder="CPF/CNPJ">
                        <input type="text" name="celular" id="celular_colab" placeholder="Celular">
                        <input type="text" name="telefone" id="telefone_colab" placeholder="Telefone">
                        <input type="password" name="senha" id="senha_colab" minlength="8" placeholder="Senha de no mínimo 8 caracteres">
                        <img type="submit" src="<?= url("templates/images/olhosenha.gif"); ?>" alt="olho_colab" id="olho_colab" onclick="mostrar_senha_colab()">
                        <input type="password" name="conf_senha" id="conf_senha_colab" placeholder="Confirme sua senha"><br>
                        <p id="senha_erro_colab">Por favor, insira corretamente a senha informada</p>
                        <div id="prox_botao_colab" onclick="validarPrimeiraParte_colab()">
                            <a id="proximo_colab" onclick="validarPrimeiraParte_colab()" type="submit">Próximo</a>
                        </div>
                    </section>
                    <section id="parte2_colab">
                        <!--parte2-->
                        <select required id="selecionaMaterial" name="material">
                            <option value="" disabled selected>Selecione o material coletado</option>
                            <option value="8">Todos os reciclaveis</option>
                            <option value="1">Papel</option>
                            <option value="2">Plástico</option>
                            <option value="3">Metal</option>
                            <option value="4">Vidro</option>
                            <option value="6">Perigosos</option>
                            <option value="7">Outros</option>
                            <option value="5">Eletrônicos</option>
                        </select>
                        <input type="text" name="cep" id="cep_colab" placeholder="CEP">
                        <input type="text" onkeypress="return letras()" name="cidade" id="cidade_colab" placeholder="Cidade">
                        <input type="text" onkeypress="return letras()" name="bairro" id="bairro_colab" placeholder="Bairro">
                        <input type="text" name="rua" id="rua_colab" placeholder="Rua">
                        <input type="number" name="numero" id="numero_colab" placeholder="Numero">
                        <input type="text" name="complemento" id="complemento_colab" placeholder="Complemento"><br>
                        <br>
                        <input type="checkbox" name="termo_colab" id="termo_colab" value="termo" style="width:auto!important;margin:0px!important;opacity:1!important;position:static!important;" />
                        <a href="<?= url("login/termosdeuso") ?>" target="_blank" style="text-decoration:none;font-size:12px;">Eu concordo com os <u>termos de uso</u></a>
                        <!-- -->
                        <br>
                        <div class="voltar_colab" onclick="voltarPrimeiroRegistro_colab()">
                            <a id="voltar1_colab" onclick="voltarPrimeiroRegistro_colab()" type="submit" name="voltar" value="voltar">Voltar</a>
                        </div>
                        <div class="p_proximo2_colab" onclick="validarSegundaParte_colab()">
                            <a id="proximo2_colab" onclick="validarSegundaParte_colab()" type="submit" name="proximo" value="proximo">Próximo</a>
                        </div>
                    </section>
                    <section id="parte3_colab">
                        <!--parte3-->
                        <figure>
                            <img src="<?= url("templates/images/cadastro_realizado.png"); ?>" alt="castro_concluido" id="cadastro_realizado">
                            <figcaption id="cadastro_concluido">Cadastro Pré Finalizado,<br>para concluir de próximo!</figcaption>
                        </figure>
                        <div class="voltar_colab">
                            <a id="voltar2_colab" onclick=" voltarSegundoRegistro_colab()" type="submit" name="voltar" value="voltar">Voltar</a>
                        </div>
                        <div class="p_proximo2_colab">
                            <button id="proximo2_colab" class="proximo3_colab" type="submit" name="proximo" value="proximo">Próximo</button>
                        </div>
                    </section>
                </form>
            </section>
        </main>
    </div>
    <img src="<?= url("templates/images/ilustracao.png"); ?>" id="ilustracao">
    <a href="<?= url("login/") ?>">
        <p id="login">Eu ja tenho uma conta</p>
    </a>
    <footer>
        <div class="final">
            <p>&copy;Reuse.Todos os direitos reservados</p>
        </div>
    </footer>
</body>

</html>