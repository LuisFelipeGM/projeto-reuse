<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel ="stylesheet" type="text/css" href="<?= url("templates/admin/css/usuario/admstyle_default.css");?>">
    <link rel="stylesheet" media="screen and (max-width:480px)" href="<?= url("templates/admin/css/usuario/admstyle480.css");?>">
    <link rel="stylesheet" media="screen and (min-width:481px) and (max-width:768px)" href="<?= url("templates/admin/css/usuario/admstyle768.css");?>">
    <link rel="stylesheet" media="screen and (min-width:769px) and (max-width:1024px)" href="<?= url("templates/admin/css/usuario/admstyle1024.css");?>">
    <link rel=stylesheet media="screen and (min-width: 1025px)" href="<?= url("templates/admin/css/usuario/admstyle1025.css");?>">
    <link rel="shortcut icon" href="<?=url("templates/images/logo_semnome.png");?>" type="image/x-png"/>
    <title>ADM</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
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
    <div>
        <nav>
            <img id="logo" src="<?= url("templates/images/logo_semnome.png"); ?>">
                 <a class="texto" id="texto_capa" style="color:white!important;">Seja Bem vindo, <?= $_SESSION['nome_usu']?></a>
                 <ul>
                     <li id="logoff"><a href="<?= url("authentication/logoff");?>" id="botaosair">Sair</a></li>
                 </ul>
                 <ul>
                    <li id="home"><a href="<?= url("admin/"); ?>" id="home">Home</a></li>
                </ul>
        </nav>
    </div>
 <div class="container">
    <div class="row">
        <div class="col-md-12">  
   <div>
    <form action="<?= url("admin/usuario/salvar/").$data[0]['cd_usu']?>" method="post">
        <div style="border-radius: 5px;
                    border-style: solid;
                    border-color: #00cc00;
                    border-width: 1px;
                    padding: 10px;
                    margin-top: 10px;
                    margin-bottom: 10px";>
                    <?php if($data[0]['cd_status_usu'] == 'A'): ?>
                        <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="ativo" value="A" checked>
                <label class="form-check-label" for="ativo">Ativo</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="inativo" value="I">
                <label class="form-check-label" for="inativo">Inativo</label>
            </div>
                    <?php else: ?>
                        <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="ativo" value="A">
                <label class="form-check-label" for="ativo">Ativo</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="inativo" value="I" checked>
                <label class="form-check-label" for="inativo">Inativo</label>
            </div>
                    <?php endif; ?>
           
        </div>
        <div class="form-group">
            <label for="inputAddress">Nome Completo</label>
            <input type="text" class="form-control" id="nomeCompleto" name="nomeCompleto" value="<?= $data[0]['nome_usu']; ?>" placeholder="" disabled>
        </div>

        <div class="form-group">
            <label for="inputAddress">Email</label>
            <input type="text" class="form-control" id="email" name="email" value="<?= $data[0]['email_usu']; ?>" placeholder="" disabled>
        </div>

        <div class="form-group">
            <label for="inputAddress">Senha</label>
            <input class="form-control" type="password" minlength="8" id="senha" name="senha" value="<?= $data[0]['senha_usu']; ?>" placeholder="">
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputCpf">CPF/CNPJ</label>
                <input type="text" class="form-control" id="cpf" name="cpf" value="<?= $data[0]['id_doc_usu']; ?>" disabled>
            </div>
            <div class="form-group col-md-4">
                <label for="inputTel">Telefone</label>
                <input type="text" class="form-control" id="telefone" name="telefone" value="<?= $data[0]['tel_fixo_usu']; ?>" placeholder="" disabled>
            </div>
            <div class="form-group col-md-4">
                <label for="inputCell">Celular</label>
                <input type="text" class="form-control" id="celular" name="celular" value="" placeholder="<?= $data[0]['tel_cel_usu']; ?>" disabled>
            </div>
            <div class="form-group col-md-4">
                <label for="inputMat">Material Coletado</label>
                <input type="text" class="form-control" id="material" name="material" value="<?= $data[0]['cd_material']; ?>" placeholder="" readonly>
            </div>
            <div class="form-group col-md-4">
                <label for="inputZip">Cep</label>
                <input type="text" class="form-control" id="cep" name="cep" value="<?= $data[0]['cep_usu']; ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="inputCity">Cidade</label>
                <input type="text" class="form-control" id="cidade" name="cidade" value="<?= $data[0]['cidade_end_usu']; ?>" readonly>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-8">
                <label for="inputAddress2">Rua</label>
                <input type="text" class="form-control" id="rua" name="rua" value="<?= $data[0]['rua_end_usu']; ?>" placeholder="" readonly>
            </div>
            <div class="form-group col-md-4">
                <label for="inputAddress2">Número</label>
                <input type="text" class="form-control" id="numero" name="numero" value="<?= $data[0]['num_end_usu']; ?>" placeholder="">
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddress2">Complemento</label>
            <input type="text" class="form-control" id="complemento" name="complemento" value="<?= $data[0]['compl_end_usu']; ?>" placeholder="">
        </div>
        <div class="form-group">
            <label for="inputAddress2">Bairro</label>
            <input type="text" class="form-control" id="bairro" name="bairro" value="<?= $data[0]['bairro_end_usu']; ?>" placeholder="" readonly>
        </div>

        <div class="form-group">
            <div id="mensagem">

            </div>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>

        </div>
    </div>
</div>



<script src=""></script>
<!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src=""></script>
<script src=""></script>
</body>
</html>