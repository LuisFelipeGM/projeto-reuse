<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel ="stylesheet" type="text/css" href="<?= url("templates/web/css/errocadastro/errocadastrostyle_default.css"); ?>">
    <link rel="stylesheet" media="screen and (max-width:480px)" href="<?= url("templates/web/css/errocadastro/errocadastrostyle480.css"); ?>">
    <link rel="stylesheet" media="screen and (min-width:481px) and (max-width:768px)" href="<?= url("templates/web/css/errocadastro/errocadastrostyle768.css"); ?>">
    <link rel="stylesheet" media="screen and (min-width:769px) and (max-width:1024px)" href="<?= url("templates/web/css/errocadastro/errocadastrostyle1024.css"); ?>">
    <link rel=stylesheet media="screen and (min-width: 1025px)" href="<?= url("templates/web/css/errocadastro/errocadastrostyle1025.css"); ?>">
    <link rel="shortcut icon" href="<?=url("templates/images/logo_semnome.png");?>" type="image/x-png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erro Cadastro</title>
  
</head> 
<body>
    <div id="tudo">
       
        <img src="<?= url("templates/images/error.png"); ?>" id="ilustra"alt="erro404">
       <div id="texto">
        <img src="<?= url("templates/images/logo_semnome.png"); ?>" id="logo" alt="logo">
        <h1>Cadastro não realizado</h1>
        <p>Não foi possível realizar o cadastro.<br>
            Tente novamente ou contate um administrador pelo email suportedenuncia@projetoreuse.com
        </p>
        <button id="voltar">Voltar</button>
    </div>
    </div>
</body>
</html>
