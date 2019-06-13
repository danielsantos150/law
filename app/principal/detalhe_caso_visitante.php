<?php
    include_once "casos_juridicos_list.php";

    $model = new Model;

    if(isset($_GET["cpf"])){
        $cpf_visitado = $_GET["cpf"];

        $result_caso = $model->busca_ultimo_caso_juridico_por_cpf($cpf_visitado, $con);

        while ($linha_caso = mysqli_fetch_array($result_caso)){

            $idcaso                 = $linha_caso["id_caso"];
            $titulo_processo        = $linha_caso["titulo_processo"];
            $cpfcnpj_advogado       = $linha_caso["cpfcnpj_advogado"];
            $status                 = $linha_caso["status"];
            $status                 = $status * 10;
            $ultima_alteracao       = $linha_caso["ultima_alteracao"];
            $nome_cliente           = $linha_caso["nome_cliente"];
            $tipo_processo          = $linha_caso["tipo_processo"];
            $autuacao               = $linha_caso["autuacao"];
            $ramo_direito           = $linha_caso["ramo_direito"];
            $relator                = $linha_caso["relator"];
            $numero_caso            = $linha_caso["numero_caso"];
            $classe_judicial        = $linha_caso["classe_judicial"];
            $orgao_julgador         = $linha_caso["orgao_julgador"];
            $polo_ativo             = $linha_caso["polo_ativo"];
            $polo_passivo           = $linha_caso["polo_passivo"];
            $cpfcnpj_poloAtivo      = $linha_caso["cpfcnpj_poloAtivo"];
            $cpfcnpj_poloPassivo    = $linha_caso["cpfcnpj_poloPassivo"];
            $posicao                = $linha_caso["position"];
        }

        $result_ocorrencias = $model->busca_ocorrencias_caso($idcaso, $con);

        $result_ocorrencias_modal = $result_ocorrencias;
    }


    $result_status = $model->busca_status_casos_juridicos($con);
    $apresenta = FALSE;

    $i = 1;
    $lista_arquivos = array();
    if(isset($_GET["cpf"])){
        $pasta = "../Util/files/".$numero_caso."/";
        if(is_dir($pasta)){
            $diretorio = dir($pasta);

            while(($arquivo = $diretorio->read()) != false){
                $lista_arquivos[] = $pasta.$arquivo;
            }
            $diretorio->close();
        }else{
            echo 'A pasta não existe.';
        }
    }
    /* realizado unset para eliminação das duas primeiras casas */
    unset($lista_arquivos[0]);
    unset($lista_arquivos[1]);
    $elementos_show = "";
    $tag_image = "";

    if(isset($_GET["cpf"])){
        $apresenta = TRUE;

        foreach ($lista_arquivos as $file){
            $dir = $file;
            $dir_total = "file:///".__DIR__."/".$dir;
            $dir_fish = str_replace("\\", "/", $dir_total);

            $tag_image .='<div class="col-xl-2 col-sm-2 mb-2">
                                            <div class="card text-white bg-warning o-hidden h-100">
                                              <div class="card-body">
                                              <a target="_blank" href="chrome-extension://oemmndcbldboiebfnladdacbdfmadadm/'.$dir_fish.'">                                              
                                                <div class="card-body-icon">
                                                 <i class="fas fa-fw fa-file-archive"></i>
                                                </div> 
                                                </a>                                               
                                              </div>
                                            </div>
                                          </div>';
        }
    }

    $result_movimentacoes = $model->busca_movimentacoes_caso($idcaso, "10701027681", $con);

    if(isset($_GET["mensagem"])){
        $destino = $_POST["advisitado"];
        $mensagem = $_POST["descricaomensagem"];
        $origem = "10701027681";

        $result_mensagem = $model->cadastra_nova_mensagem($origem, $mensagem, $destino, NULL, $con);

        echo "<meta HTTP-EQUIV='refresh' CONTENT='1;URL=detalhe_caso_visitante.php?cpf=".$destino."'>";
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

    <!-- Custom fonts for this template-->
    <link href="../Util/principal/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="../Util/principal/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../Util/principal/css/sb-admin.css" rel="stylesheet">

    <style>
        a { color: inherit;
        }
    </style>
</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.php">E-LAW</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <div class="group">
        <p>&nbsp;</p>
      </div>
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-bell fa-fw"></i>
          <span class="badge badge-danger">1</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
          <a class="dropdown-item" href="#">Ver notificações</a>
        </div>
      </li>
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="perfil.php">Meu Perfil</a>
          <a class="dropdown-item" href="#">Preferências</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Sair</a>
        </div>
      </li>
    </ul>

  </nav>

  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="index.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Painel de Controle</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="mensagens.php">
                <i class="fas fa-fw fa-envelope"></i>
                <span>Mensagens</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="calendario.php">
                <i class="fas fa-fw fa-calendar"></i>
                <span>Agenda</span>
            </a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="casos_juridicos.php">
                <i class="fas fa-fw fa-newspaper"></i>
                <span>Casos Jurídicos</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="advogados.php">
                <i class="fas fa-fw fa-pencil-ruler"></i>
                <span>Advogados</span>
            </a>
        </li>
      <li class="nav-item">
        <a class="nav-link" href="charts.php">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Gráficos</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="tabelas.html">
          <i class="fas fa-fw fa-table"></i>
          <span>Tabelas</span></a>
      </li>
    </ul>
        <div id="content-wrapper">
            <div class="container-fluid">
                <!-- Breadcrumbs-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.php">Painel de Controle</a>
                    </li>
                    <li class="breadcrumb-item active">Casos Jurídicos</li>
                    <li class="breadcrumb-item active">Caso nº <?php echo $numero_caso; ?></li>
                </ol>
                <button class="btn btn-success" style="float: right;" data-toggle="modal" data-target="#cadastrarComentario"><i class="fa fa-plus"></i>&nbsp;&nbsp;Adicionar comentário</button>
                <br><br>
                <div class="card" style="margin-top: 5px;">
                    <p class="card-header h6" data-toggle="collapse" href="#dadosResumido" role="button" aria-expanded="false" aria-controls="dadosResumido">
                        Dados do Processo <span style="float: right; color: #ccc;" class="fa fa-chevron-down"></span>
                    </p>

                    <div class="collapse" id="dadosResumido">
                        <div class="card card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <span style="font-weight: bold;">Número Processo</span><br>
                                    <?php echo $numero_caso; ?><br>
                                    <span style="font-weight: bold;">Nome do Cliente</span><br>
                                    <?php echo $nome_cliente; ?>
                                </div>
                                <div class="col-sm-4">
                                    <span style="font-weight: bold;">Classe Judicial</span><br>
                                    <?php echo $classe_judicial; ?><br>
                                    <span style="font-weight: bold;">Órgão Julgador</span><br>
                                    <?php echo $orgao_julgador; ?>
                                </div>
                                <div class="col-sm-4">
                                    <span style="font-weight: bold;">Assunto</span><br>
                                    <?php echo $titulo_processo; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" style="margin-top: 5px;">
                    <p class="card-header h6">Polo Ativo <?php  if($posicao == 1){ echo "[CLIENTE]"; } ?></p>
                    <div class="card card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                CPF/CNPJ: <?php echo $cpfcnpj_poloAtivo; ?>
                            </div>
                            <div class="col-sm-9">
                                <span style="font-weight: bold;">Autor</span><br>
                                <?php echo $polo_ativo; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" style="margin-top: 5px;">
                    <p class="card-header h6">Polo Passivo <?php if($posicao == 0){ echo "[CLIENTE]"; } ?></p>
                    <div class="card card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                CPF/CNPJ: <?php echo $cpfcnpj_poloAtivo; ?>
                            </div>
                            <div class="col-sm-9">
                                <span style="font-weight: bold;">Réu</span><br>
                                <?php echo $polo_passivo; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" style="margin-top: 5px;">
                    <div class="card-header h6">Ocorrências
                    </div>
                    <div class="card card-body">
                        <div class="row">
                            <?php
                                while ($lista_ocorrencias = mysqli_fetch_array($result_ocorrencias)){
                                    echo '<div class="col-xl-2 col-sm-2 mb-2" data-toggle="modal" data-target="#modalOcorrencia'.$lista_ocorrencias["id_ocorrencia"].'">
                                            <div class="card text-white bg-warning o-hidden h-100">
                                              <div class="card-body">
                                                <div class="card-body-icon">
                                                  <i class="fas fa-fw fa-pencil-alt"></i>
                                                </div>
                                                <div class="mr-6" style="text-align: center;">#'.$lista_ocorrencias["id_ocorrencia"].'</div>
                                              </div>
                                            </div>
                                          </div>';

                                    echo '<div class="modal fade" id="modalOcorrencia'.$lista_ocorrencias["id_ocorrencia"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                              <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Ocorrência nº.: '.$lista_ocorrencias["id_ocorrencia"].'</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                  </div>
                                                  <div class="modal-body">
                                                    '.$lista_ocorrencias["descricao_ocorrencia"].'
                                                  </div>
                                                  <div class="modal-footer">                                                    
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="card" style="margin-top: 5px;">
                    <div class="card-header h6">Área de Arquivos
                    </div>
                    <div class="card card-body">
                        <div class="row">
                           <?php
                                if($apresenta){
                                    echo $tag_image;
                                }
                           ?>
                        </div>
                    </div>
                </div>
                <div class="card" style="margin-top: 5px;">
                    <div class="card-header h6">Movimentações
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col" style="color: #8c8c8c;">Data</th>
                                    <th scope="col" style="color: #8c8c8c;">Movimento</th>

                                    <th scope="col" style="color: #8c8c8c;">Arquivado</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                while ($lista_movimentacoes = mysqli_fetch_array($result_movimentacoes)){
                                    echo '<tr>
                                              <th scope="row">'.$lista_movimentacoes["data_movimentacao"].'</th>
                                              <td>'.$lista_movimentacoes["descricao_movimentacao"].'</td>';

                                    if($lista_movimentacoes["arquivado"] == 1){
                                        echo '<td><button class="btn btn-success">
                                                <i class="fa fa-check-circle" aria-hidden="true"></i>
                                            </button></td>';
                                    }else{
                                        echo '<td><button class="btn btn-danger">
                                                <i class="fa fa-times-circle" aria-hidden="true"></i>
                                            </button></td>';
                                    }
                                    echo '</tr>';
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- /.content-wrapper -->
  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Model nova ocorrencia -->
  <div class="modal fade" id="cadastrarComentario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Mensagem</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form role="form" id="form-cadastro" action="?cpf=<?php echo $cpf_visitado ?>&mensagem=true" method="POST">
                      <div class="form-group">
                          <i>Gostaria de enviar uma mensagem para o Advogado deste caso? Envie no campo abaixo!</i>
                      </div>
                      <div class="form-group">
                          <textarea type="text" class="form-control" id="descricaomensagem" name="descricaomensagem"></textarea>
                          <input type="hidden" id="numerocaso" name="numerocaso" value="<?php echo $numero_caso ?>">
                          <input type="hidden" id="advisitado" name="advisitado" value="<?php echo $cpf_visitado ?>">
                      </div>
                      <div class="form-group">
                          <button type="submit" class="btn btn-success">Enviar</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../Util/principal/vendor/jquery/jquery.min.js"></script>
  <script src="../Util/principal/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../Util/principal/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../Util/principal/js/sb-admin.min.js"></script>

  <script src="../Util/js/progressbar.js"></script>

  <script>
      $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip();
      });

      var div = document.getElementsByClassName("botaoArquivo")[0];
      var input = document.getElementById("arquivo");

      div.addEventListener("click", function(){
          input.click();
      });
      input.addEventListener("change", function(){
          var nome = "Não há arquivo selecionado. Selecionar arquivo...";
          if(input.files.length > 0) nome = input.files[0].name;
          div.innerHTML = nome;
      });
  </script>

</body>

</html>