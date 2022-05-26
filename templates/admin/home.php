<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel ="stylesheet" type="text/css" href="<?= url("templates/admin/css/homeadmin/homeadminstyle_default.css"); ?>">
    <link rel="stylesheet" media="screen and (max-width:480px)" href="<?= url("templates/admin/css/homeadmin/homeadminstyle480.css"); ?>">
    <link rel="stylesheet" media="screen and (min-width:481px) and (max-width:768px)" href="<?= url("templates/admin/css/homeadmin/homeadminstyle768"); ?>">
    <link rel="stylesheet" media="screen and (min-width:769px) and (max-width:1024px)" href="<?= url("templates/admin/css/homeadmin/homeadminstyle1024.css"); ?>">
    <link rel=stylesheet media="screen and (min-width: 1025px)" href="<?= url("templates/admin/css/homeadmin/homeadminstyle1025.css"); ?>">
    <link rel="shortcut icon" href="<?=url("templates/images/logo_semnome.png");?>" type="image/x-png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
</head> 
<body>
    <main>
        <div>
            <nav>
                <img id="logo" src="<?= url("templates/images/logo_semnome.png"); ?>">
                     <a class="texto" id="texto_capa">Seja Bem vindo, <?= $_SESSION['nome_usu']?></a>
                     <ul>
                         <li id="logoff"><a href="<?= url("authentication/logoff"); ?>" id="botaosair">Sair</a></li>
                     </ul>
            </nav>
        </div>    
        <table cellspacing="0" rules="none">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Status</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($data as $key=>$user):?>
                <?php if($data[$key]['cd_tipo_usu'] != 3): ?>
                <tr>
                    <th><?=$data[$key]['nome_usu']?></th>
                    <td><?=$data[$key]['email_usu']?></td>
                    <td><?=$data[$key]['desc_tipo_usu']?></td>
                    <td><?=$data[$key]['cd_status_usu']?></td>
                    <td><a href="<?= url("admin/usuario/").$data[$key]['cd_usu']?>">Editar</a></td>
                    
                        
                    
                </tr>


            <?php endif; ?>
            <?php endforeach; ?>


            </tbody>
          </table>
       
    </main>
</body>
</html>
