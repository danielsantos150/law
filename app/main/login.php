<?php

    include_once "../connections/conections.php";
    include_once "../connections/model.php";

    date_default_timezone_set('America/Sao_Paulo');

    $model = new Model();
    $notice_falha_login = false;

    if(isset($_POST["inputCPF"])){

        $dados_usuario = array($_POST["inputName"],$_POST["inputCPF"], $_POST["inputEmail4"],
            $_POST["inputPassword4"], $_POST["inputAddress"], $_POST["inputCity"],
        $_POST["inputState"],$_POST["cep"],$_POST["inputSex"],$_POST["inputDate"]);

        $cadastro = $model->cadastrar_usuario($dados_usuario, $con);

        //var_dump($cadastro);exit;
    }

    if(isset($_GET["valida"]) && $_GET["valida"] == true){

        $dados_usuario = array($_POST["inputEmail"], $_POST["inputPassword"]);

        $dominio_emails_permitidos = array("altavista.com", "aol.com",
            "bol.com.br", "brturbo.com.br", "globo.com",
            "globomail.com", "gmail.com", "hotmail.com",
            "ibest.com.br", "ig.com.br", "itelefonica.com.br",
            "live.com", "msn.com", "outlook.com", "pop.com.br",
            "superig.com.br", "terra.com.br", "uol.com.br",
            "yahoo.com.br", "zipmail.com.br");

        $domonio_email = explode("@",$_POST["inputEmail"]);
        $domonio_do_usuario = $domonio_email[1];

        if (in_array($domonio_do_usuario, $dominio_emails_permitidos)){
            $verificaUsuario = $model->verifica_login($dados_usuario, $con);

            if ($verificaUsuario){

                var_dump("USUARIO CADASTRADO NO SISTEMA!!");exit;

            }else{
                $notice_falha_login = "T";
            }

        }else{
           $notice_falha_login = "falha_dominio";
        }
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../Util/bootstrap/icon1.png">
    <title><?php include '../Util/titulo.php'; ?></title>
    <link href="../Util/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../Util/bootstrap/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="../Util/bootstrap/signin.css" rel="stylesheet">
    <link href="../Util/font_principal.css" rel="stylesheet">
    <script src="../Util/bootstrap/assets/js/ie-emulation-modes-warning.js"></script>


</head>
<body style="background-image: url('../Util/background.png')">

<div class="container">
    <div class="col-md-4">&nbsp;</div>
    <div class="col-md-4">
        <div class="card" style="background-color: white; border-radius: 15px;margin-top: 100px;">

            <form class="form-signin" id="form1" name="form1" method="POST" action="login.php?valida=true" autocomplete="off">
                <h2 class="form-signin-heading">E-LAWYER</h2>

                <?php
                    if($notice_falha_login == "T"){
                    ?>
                        <div class="alert alert-danger" role="alert">
                            Usuário e/ou senha inválida!
                        </div>
                    <?php
                    }else if ($notice_falha_login == "falha_dominio"){
                        ?>
                        <div class="alert alert-danger" role="alert">
                            Domínio de e-mail não permitido.
                        </div>
                        <?php
                    }
                ?>
                <label for="inputEmail" class="sr-only">Email</label>
                <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="E-mail" required
                       autofocus>
                <label for="inputPassword" class="sr-only">Senha</label>
                <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Senha"
                       required>
                <button type="button" class="btn btn-sm btn-link" onclick="window.location.href = 'esqueci_senha.php'">Esqueci minha senha
                </button>
                <button type="button" class="btn btn-sm btn-link" onclick="window.location.href = 'cadastrar.php'">Não possui cadastro?
                    Cadastre-se agora!
                </button>
                <br><br>
                <button class="btn btn-lg btn-primary btn-block" style="background-color: #8a6d3b; border: 0px;" type="submit" id="alert-target">ENTRAR</button>
            </form>
            <br>
        </div>
    </div>
    <div class="col-md-4">&nbsp;</div>
</div>



<script src="bootstrap/assets/js/ie10-viewport-bug-workaround.js"></script>
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
</body>
</html>
