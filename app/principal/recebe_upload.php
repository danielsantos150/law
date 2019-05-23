<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 15/05/2019
 * Time: 19:33
 */

    $numcaso = $_POST['numcaso'];
    $idcaso = $_POST['idcaso'];

    if(!is_dir('../Util/files/'.$numcaso.'/')) {
        mkdir('../Util/files/'.$numcaso.'/', 0777, true);
    }

    // Pasta onde o arquivo vai ser salvo
    $_UP['pasta'] = '../Util/files/'.$numcaso.'/';
    // Tamanho máximo do arquivo (em Bytes)
    $_UP['tamanho'] = 1024 * 1024 * 1024 *  1024 *2;
    // Array com as extensões permitidas
    $_UP['extensoes'] = array('pdf');
    // Array com os tipos de erros de upload do PHP
    $_UP['erros'][0] = 'Não houve erro';
    $_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
    $_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
    $_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
    $_UP['erros'][4] = 'Não foi feito o upload do arquivo';
    // Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
    if ($_FILES['arquivo']['error'] != 0) {
        die("Não foi possível fazer o upload, erro:" . $_UP['erros'][$_FILES['arquivo']['error']]);
        exit; // Para a execução do script
    }
    // Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar

    // Mantém o nome original do arquivo
    $nome_final = $_FILES['arquivo']['name'];

    // Depois verifica se é possível mover o arquivo para a pasta escolhida
    if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'] . $nome_final)) {
        // Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
        echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=detalhe_caso.php?caso=".$idcaso."&upload=success'>";
    } else {
        // Não foi possível fazer o upload, provavelmente a pasta está incorreta
        echo "Não foi possível enviar o arquivo, tente novamente";
    }
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>E-LAW - Seu caso no seu controle</title>

    <style>
        @-webkit-keyframes spinning {
            from {transform: rotate(0deg);}
            to   {transform: rotate(180deg);}
        }
        @keyframes spinning {
            from {transform: rotate(0deg);}
            to   {transform: rotate(180deg);}
        }
        .square {
            position:absolute;
            top:45%;
            left:45%;
            width: 150px;
            height: 150px;
            border-width: 5px;
            border-style: solid;
            border-color: #999 #ccc;
            border-radius: 50px;
            -webkit-animation: spinning 0.75s infinite linear;
            animation: spinning 1.0s infinite linear;
        }
    </style>
</head>

<body style="background-color: white;">
    <div class="square"></div>
</body>

</html>
