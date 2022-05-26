<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel=stylesheet href="<?= url("templates/web/css/home/homestyle_default.css"); ?>">
    <link rel="shortcut icon" href="<?= url("templates/images/logo_semnome.png"); ?>" type="image/x-png" />

    <script src="<?= url("templates/web/jscript/functions.js"); ?>" type="text/javascript" language="javascript"></script>

    <link rel=stylesheet media="screen and (max-width:480px) and (orientation:portrait)" href="<?= url("templates/web/css/home/homestyle480.css"); ?>">
    <link rel=stylesheet media="screen and (min-width: 481px) and (max-width:768px)" href="<?= url("templates/web/css/home/homestyle768.css"); ?>">
    <link rel=stylesheet media="screen and (min-width: 769px) and (max-width:1024px)" href="<?= url("templates/web/css/home/homestyle1024.css"); ?>">
    <link rel=stylesheet media="screen and (min-width: 1025px)" href="<?= url("templates/web/css/home/homestyle1025.css"); ?>">

    <title>Reuse - Home</title>
</head>

<body onload="slide1()">
    <!--Inicio da página-->
    <div class="container">
        <nav>
            <ul>
                <li id="colaborador"><a href="<?= url("login/"); ?>" id="colaborador">Sou Colaborador
                        <img src="<?= url("templates/images/icone_perfil2.png"); ?>" id="colaborador"></a></li>
                <li id="doador"><a href="<?= url("login/"); ?>" id="doador">Sou Doador
                        <img src="<?= url("templates/images/icone_perfil2.png"); ?>" id="doador"></a></li>
            </ul>
        </nav>
        <a class="texto" id="texto_capa">Encontre o catador, ong e empresa que
            reutiliza materiais mais proximo de você!</a>
        <div class="botoes">
            <div class="botao-topo">
                <div class="botao1capa">
                    <a href="<?= url("login/cadastre-se"); ?>" class="botao">Cadastre-se</a>
                </div>
            </div>
        </div>
    </div>
    <main>
        <div class="botõesmeio">
            <!--Meio da pagina-->
        </div>
        <div id="slide-main">
            <!-- slideshow -->
            <img src="<?= url("templates/images/first.png"); ?>" alt="slide" id="banner">
        </div>
        <script src="<?= url("templates/web/jscript/slideshow.js"); ?>"></script>
        <div class="imagemmeio">
            <div class="textomeio">
                <h2>SALVE O PLANETA!</h2>
                <a>Seja responsavel pelo seu consumo!</a>
            </div>
        </div>
        <div id="grid">
            <div class="quadoador">
                <div class="imgcolab">
                    <figure><img src='<?= url("templates/images/colaboradormobile.png"); ?>'></figure>
                </div>
                <div class="textcolab">
                    <a>Cadastre-se como Doador!</a>
                </div>
                <div class="botoes">
                    <div class="botao-meio">
                        <div class="botao3capa">
                            <a href="<?= url("login/cadastre-se"); ?>" class="botao2">Seja um Doador</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="quadcolab">
                <div class="imgcolab">
                    <figure><img src='<?= url("templates/images/catadormobile.png"); ?>'></figure>
                </div>
                <div class="textcolab">
                    <a>Cadastre-se como colaborador!</a>
                </div>
                <div class="botoes">
                    <div class="botao-meio">
                        <div class="botao3capa">
                            <a href="<?= url("login/cadastre-se"); ?>" class="botao2">Seja um Colaborador</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <!-- Fim da página -->
        <a name="anchor" href="#anchortop"></a>
        <a href="#top" class="glyphicon glyphicon-chevron-up"></a>
        <div class="fim">
            <spam>Copyright © Reuse. Todos os direitos reservados - suportedenuncia@projetoreuse.com</spam>
        </div>
    </footer>
</body>

</html>