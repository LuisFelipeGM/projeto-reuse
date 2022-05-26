<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= url("templates/web/css/login/loginstyle_default.css"); ?>">
    <link rel="stylesheet" media="screen and (max-width:480px)" href="<?= url("templates/web/css/login/loginstyle480.css"); ?>">
    <link rel="stylesheet" media="screen and (min-width:481px) and (max-width:768px)" href="<?= url("templates/web/css/login/loginstyle768.css"); ?>">
    <link rel="stylesheet" media="screen and (min-width:769px) and (max-width:1024px)" href="<?= url("templates/web/css/login/loginstyle1024.css"); ?>">
    <link rel="stylesheet" media="screen and (min-width:1025px)" href="<?= url("templates/web/css/login/loginstyle1025.css"); ?>">
    <link rel="shortcut icon" href="<?=url("templates/images/logo_semnome.png");?>" type="image/x-png" />
    <script type="text/Javascript" src="<?= url("templates/web/jscript/login.js"); ?>"></script>
    <title>Login</title>
</head>

<body>
    <div id="tudo">
        <form action="<?= url("authentication/logon") ?>" id="form" name="form" onsubmit="return valida()" class="formulario" method="post">

            <header class="cab-login">
                <a href="<?= url("") ?>">
                    <img id="img1" src="<?= url("templates/images/logo_semnome.png"); ?>" alt="logo">
                </a>
                <h1>Minha Conta</h1>
                <!--<a href="home.html"><img id="img2" src="../imagens/home.png" alt="home"></a>-->
            </header>

            <div class="login" id="blur">
                <input type="text" name="email" id="email" placeholder="E-mail" required />
                <span id="erroEmail">Por favor, insira um e-mail válido</span>
                <input type="password" name="senha" id="senha" placeholder="Senha" required />
                <img src="<?= url("templates/images/olhosenha.gif"); ?>" onclick=" mostrar_senha()" id="olho">
                <button id="btn1" href="" onclick="toggle()">Esqueci minha senha</button>
                <a id="btn2" href="<?= url("login/cadastre-se"); ?>">Não tenho uma conta</a>
                <button id="btn3">Entrar</button><br>
            </div>

        </form>
    </div>
    <div id="pop">
        <img src="<?= url("templates/images/sair.png"); ?>" alt="sair" id="sair" onclick="sair()">
        <h2> Esqueceu a senha?</h2>
        <p>Entre em contato com o administrador pelo email:<br></p><span>suportedenuncia@projetoreuse.com</span>
    </div>
    <div id="pop">
        <img src="<?= url("templates/images/sair.png"); ?>" alt="sair" id="sair" onclick="sair()">
        <h2 id='popErro'>Senha ou Email inválidos</h2>
        <p>Por favor, verifique e tente novamente</p>
    </div>
</body>

</html>