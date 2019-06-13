<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 17/04/2019
 * Time: 20:00
 */

    include_once "../connections/conections.php";
    include_once "../connections/model.php";

    $model = new Model();

    $result_casos_advogado = $model->busca_casos_juridicos("10701027681", $con);

    $listagem_casos = '<div class="card-body">
                          <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                              <thead>
                              <tr>
                                <th>N º.</th>
                                <th>Nome Cliente</th>
                                <th>Assunto</th>
                                <th>Classe Judicial</th>
                                <th>Mais Informações</th>
                                
                              </tr>
                              </thead> ';

    while ($linha_caso = mysqli_fetch_array($result_casos_advogado)){

        $listagem_casos.='    <tbody>
                              <tr>
                                <td>'.$linha_caso["numero_caso"].'</td>
                                <td>'.$linha_caso["nome_cliente"].'</td>
                                <td>'.$linha_caso["titulo_processo"].'</td>
                                <td>'.$linha_caso["classe_judicial"].'</td>
                                <td><button type="button" class="btn btn-outline-success" data-toggle="tooltip" data-placement="top" title="Entrar!" onclick="window.location.href=\'detalhe_caso.php?caso='.$linha_caso["id_caso"].'\'"><i class="fas fa-door-open"></i></button></td>
                                
                              </tr>
                              </tbody>
                            ';
    }

    $listagem_casos.= '</table>
                    </div>
                </div>';

    $result_num_casos = $model->busca_casos_juridicos("10701027681", $con);
    $select_casos_existentes = '<div class="form-group">
                                    <select name="casojur" class="form-control" id="numeroCasoJuridicos">';

    while ($linha_n_casos = mysqli_fetch_array($result_num_casos)){
       $select_casos_existentes.='<option value='.$linha_n_casos["id_caso"].'>'.$linha_n_casos["numero_caso"].'</option>';
    }

    $select_casos_existentes.='</select></div>';