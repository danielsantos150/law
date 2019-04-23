<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 20/04/2019
 * Time: 20:24
 */
    include_once "../connections/conections.php";
    include_once "../connections/model.php";
    $model = new Model();

    $result_mural = $model->busca_mural_advogado("10701027681", $con);

    $dados_mural = "";



    while ($linha_mural = mysqli_fetch_array($result_mural)){
        $dados_mural .= "<textarea type=\"text\" class=\"form-control\" id=\"mural\" name=\"mural\" disabled style='width: 455px'>".$linha_mural['mensagem']."</textarea><br>";
    }

