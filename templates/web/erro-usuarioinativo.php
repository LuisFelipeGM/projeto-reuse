<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="<?= url("templates/web/css/usuarioinativo/usuarioinativostyle_default.css"); ?>">
    <link rel="stylesheet" media="screen and (max-width:480px)" href="<?= url("templates/web/css/usuarioinativo/usuarioinativostyle480.css"); ?>">
    <link rel="stylesheet" media="screen and (min-width:481px) and (max-width:768px)" href="<?= url("templates/web/css/usuarioinativo/usuarioinativostyle768.css"); ?>">
    <link rel="stylesheet" media="screen and (min-width:769px) and (max-width:1024px)" href="<?= url("templates/web/css/usuarioinativo/usuarioinativostyle1024.css"); ?>">
    <link rel=stylesheet media="screen and (min-width: 1025px)" href="<?= url("templates/web/css/usuarioinativo/usuarioinativostyle1025.css"); ?>">
    <link rel="shortcut icon" href="<?=url("templates/images/logo_semnome.png");?>" type="image/x-png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuário inativo</title>

</head>

<body>
    <div id="tudo">

        <img src="<?= url("templates/images/error.png"); ?>" id="ilustra" alt="erro404">
        <div id="texto">
            <img src="<?= url("templates/images/logo_semnome.png"); ?>" id="logo" alt="logo">
            <h1>Usuário inativo</h1>
            <p>
                Contate o administrador pelo email <b>suportedenuncia@projetoreuse.com</b> ou clique no botão voltar.
            </p>
            <a href="<?= url("login/") ?>">
                <button id="voltar">Voltar</button>
            </a>
        </div>
    </div>
</body>

</html>