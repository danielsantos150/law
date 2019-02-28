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
    <script src="../Util/bootstrap/assets/js/ie-emulation-modes-warning.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body style="background-image: url('../Util/background.png')">

<div class="container">
    <div class="col-md-4">&nbsp;</div>
    <div class="col-md-4">
        <div class="card" style="background-color: white; border-radius: 15px;margin-top: 100px;">

            <form class="form-signin" id="form1" name="form1" method="POST" action="#" autocomplete="off">
                <h2 class="form-signin-heading">E-LAWYER</h2>

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
                <button class="btn btn-lg btn-primary btn-block" style="background-color: #8a6d3b; border: 0px;" type="submit">ENTRAR</button>
            </form>
            <br>
        </div>
    </div>
    <div class="col-md-4">&nbsp;</div>
</div>



<script src="bootstrap/assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>
