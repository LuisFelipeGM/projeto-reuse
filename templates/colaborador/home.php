<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel=stylesheet href="<?=url("templates/colaborador/css/homecolaborador/homecolaboradorstyle_default.css");?>">
    <link rel="shortcut icon" href="<?=url("templates/images/logo_semnome.png");?>" type="image/x-png"/>

    <script src="<?=url("templates/colaborador/jscript/functions.js");?>" type="text/javascript" language="javascript"></script>
    
    <link rel=stylesheet media="screen and (max-width:480px)" href="<?=url("templates/colaborador/css/homecolaborador/homecolaboradorstyle480.css");?>">
    <link rel=stylesheet media="screen and (min-width: 481px) and (max-width:768px)" href="<?=url("templates/colaborador/css/homecolaborador/homecolaboradorstyle768.css");?>">
    <link rel=stylesheet media="screen and (min-width: 769px) and (max-width:1024px)" href="<?=url("templates/colaborador/css/homecolaborador/homecolaboradorstyle1024.css");?>">
    <link rel=stylesheet media="screen and (min-width: 1025px)" href="<?=url("templates/colaborador/css/homecolaborador/homecolaboradorstyle1025.css");?>">

    <title>Reuse - Conta</title>
</head>
    <body onload="slide1()">                                                     <!--Inicio da página-->
        <div class="container">
                <nav>
               <img style="overflow:visible;" width="180" height="180" id="logo" src="<?=url("templates/images/logo_semnome.png");?>">
               </img>
                    <a class="texto" id="texto_capa">Seja Bem vindo, <?= $_SESSION['nome_usu']?></a>
                    <ul>
                        <li id="logoff"><a href="<?= url("authentication/logoff"); ?>" id="botaosair">Sair</a></li>
                    </ul>
                </nav>
                <nav class="espacamento">
                    </div>
                    <div class="container2">
                        <div class="fotoperfil">
                            <img id="fotoperfil" src="<?=url("templates/images/colaborador_mobile.png");?>"><br>
                            <a id="textoperfil"><?= $_SESSION['nome_usu']?></a>
                        </div>
                        <div class="status">
                        </div>
                            <div class="chat">
                            </div>
                        <div class="botao1capa">
                            <a href="<?= url("colaborador/mapa"); ?>" class="botao">Acessar o Mapa</a>
                        </div>
                        <div class="botao2capa">
                            <a href="<?= url("colaborador/configuracao/".$_SESSION['cd_usu']);?>" class="botao2">
                        <img style="overflow:visible;" width="400" height="400" id="config" src="<?=url("templates/images/config.png");?>">
                        </img>Configurações</a>
                        </div>
        </div>
                    </nav>
            </body>
        <div id="slide-main">                           <!-- slideshow -->
            <img src="<?=url("templates/images/first1.png");?>" alt="slide" id="banner">
        </div>
        <script src="<?=url("templates/colaborador/jscript/slideshow1.js");?>"></script>
    <footer>                                                    <!-- Fim da página -->
        <a name="anchor" href="#anchortop"></a>
        <a href="#top" class="glyphicon glyphicon-chevron-up"></a>
    <div class="fim">
        <spam>Copyright  © Reuse. Todos os direitos reservados - suportedenuncia@projetoreuse.com
        </spam>
    </div>
    </footer>
</html>