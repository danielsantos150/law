<?php

    include_once "../connections/conections.php";
    include_once "../connections/model.php";

    $meu_cpf = "10701027681";
    $model = new Model();

    $result_casos_advogado = $model->busca_casos_juridicos($meu_cpf, $con);

    $colunas = '';

    while ($linha_processo = mysqli_fetch_array($result_casos_advogado)) {
        $i = 1;
        while($i <= intval($linha_processo["duracao_processo"])){

            if($i == $linha_processo["duracao_processo"]){
                $colunas  = $colunas.''.$i.'º Mês';
            }else{
                $colunas = $colunas.''.$i.'º Mês"';
                $colunas .= ',"';
            }
            $i = $i+1;
        }
    }

    $idcaso = 2;
    $advogado_origem = $meu_cpf;

    $result_dados_feedback = $model->busca_feedback_caso($idcaso, $con, $advogado_origem);

    $result_qtd_feedback = $model->busca_qtd_feedback_caso($idcaso, $con, $advogado_origem);

    //$aFeedbacks = mysqli_fetch_array($result_qtd_feedback);
    $aFeedbacks = array();

    while ($linha_qtd = mysqli_fetch_array($result_qtd_feedback)) {
        $aFeedbacks[$linha_qtd['mes_vigencia']] = $linha_qtd['qtd'];
    }

    $valores = "";

    foreach ($aFeedbacks as $p){
        $valores .= intval($p).',';
    }
    $valores = rtrim($valores, ',');

    $aCasosAbertoSolucionado = array();

    $result_qtd_casos = $model->verifica_qtd_solucionados_abertos($meu_cpf, $con);

    while ($linha_qtd_casos = mysqli_fetch_array($result_qtd_casos)) {
        $aCasosAbertoSolucionado[$linha_qtd_casos['status']] = $linha_qtd_casos['qtd'];
    }

    #$aCasosAbertoSolucionado = { REPRESENTA UM ARRAY COM A QUANTIDADE DE CASOS ABERTOS E SOLUCIONADOS NESSA ORDEM }

    $aRamosDireito = array();
    $aRamosDireito["Trabalhista"] = 0;
    $aRamosDireito["Tributária"] = 0;
    $aRamosDireito["Direito Civil"] = 0;
    $aRamosDireito["Compliance e ética"] = 0;
    $aRamosDireito["Biodireito"] = 0;
    $aRamosDireito["Direito Digital"] = 0;
    $aRamosDireito["Ambiental"] = 0;
    $aRamosDireito["Contencioso Civil"] = 0;
    $aRamosDireito["Advogado Eleitoral"] = 0;
    $aRamosDireito["Jurídico"] = 0;
    $aRamosDireito["Relações Institucionais"] = 0;
    $aRamosDireito["Direito Médico"] = 0;
    $aRamosDireito["Outros"] = 0;

    $result_qtd_ramos_direito = $model->verifica_qtd_casos_ramo_direito($meu_cpf, $con);

    $aQuantidadeRamosDireito = array();

    while ($linha_ramo_direito = mysqli_fetch_array($result_qtd_ramos_direito)) {
        $aQuantidadeRamosDireito[$linha_ramo_direito['ramo_direito']] = $linha_ramo_direito['qtd'];
    }

    $aRamosPreenchidos = array_merge($aRamosDireito, $aQuantidadeRamosDireito);
    //var_dump($aRamosPreenchidos);exit;

    $ramos = "";

    foreach ($aRamosPreenchidos as $e){
        $ramos .= intval($e).',';
    }
    $ramos = rtrim($ramos, ',');

    //var_dump($ramos);exit;

    /*
     * JUIZADOS DA INFÂNCIA E DA JUVENTUDE
     * PROCEDIMENTOS ADMINISTRATIVOS
     * PROCESSO CÍVEL E DO TRABALHO
     * PROCESSO CRIMINAL
     * PROCESSO ELEITORAL
     * PROCESSO MILITAR
     * SUPERIOR TRIBUNAL DE JUSTIÇA
     * SUPREMO TRIBUNAL FEDERAL
     *
     */

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
          <a class="dropdown-item" href="perfil">Meu Perfil</a>
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
      <li class="nav-item active">
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
      <li class="nav-item">
        <a class="nav-link" href="casos_juridicos.php">
          <i class="fas fa-fw fa-th-list"></i>
          <span>Casos Jurídicos</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="advogados.php">
          <i class="fas fa-fw fa-pencil-alt"></i>
          <span>Advogadosç</span>
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
            <a href="#">Painel de Controle</a>
          </li>
          <li class="breadcrumb-item active">Gráficos</li>
        </ol>

        <!-- Area Chart Example-->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Feedbacks ao Cliente</div>
          <div class="card-body">
              <?php
                $visitou = false;
                    foreach ($aFeedbacks as $elem){
                        while($visitou == FALSE){
                            if($elem <= 4){
                                echo '<div class="alert alert-warning">
                                      Não deixe seu cliente esperando! Dê mais feedbacks!
                                  </div>';
                                $visitou = TRUE;
                            }else if ($elem >= 5 && $elem <= 8){
                                echo '<div class="alert alert-info">
                                      Continue assim! Você está melhorando sua comunicação com o cliente!
                                  </div>';
                                $visitou = TRUE;
                            }else{
                                echo '<div class="alert alert-success">
                                      Excelente! Você está mantendo um bom ritmo de feedbacks ao cliente!
                                  </div>';
                                $visitou = TRUE;
                            }
                        }
                    }
              ?>
            <canvas id="myAreaChart" width="100%" height="30"></canvas>
          </div>
        </div>

          <div class="row">
              <div class="col-lg-4">
                  <div class="card mb-3">
                      <div class="card-header">
                          <i class="fas fa-chart-pie"></i>
                          Meus Casos Jurídicos</div>
                      <div class="card-body">
                          <canvas id="myPieChart" width="100%" height="100"></canvas>
                      </div>
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="card mb-4" style="margin-left: 15px; margin-right: 15px;">
                  <div class="card-header alert-info">
                      <i class="fas fa-info-circle"></i>&nbsp;
                      Verifique abaixo informações referentes a todos os casos jurídicos existentes na nossa plataforma!
                      Descubra quais casos jurídicos são os mais comuns também!
                  </div>
              </div>
              <div class="col-lg-12">
                  <div class="card mb-3">
                      <div class="card-header">
                          <i class="fas fa-chart-bar"></i>
                          Casos Jurídicos por Ramo Direito</div>
                      <div class="card-body">
                          <canvas id="myBarChart" width="100%" height="50"></canvas>
                      </div>
                  </div>
              </div>
              <div class="col-lg-4">
                  <div class="card mb-3">
                      <div class="card-header">
                          <i class="fas fa-chart-pie"></i>
                          Casos Jurídicos por Classe Judicial
                          </div>
                      <div class="card-body">
                          <canvas id="myPieChart2" width="100%" height="100"></canvas>
                      </div>
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

  <!-- Bootstrap core JavaScript-->
  <script src="../Util/principal/vendor/jquery/jquery.min.js"></script>
  <script src="../Util/principal/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../Util/principal/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="../Util/principal/vendor/chart.js/Chart.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../Util/principal/js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script>
        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#292b2c';

        // Area Chart Example
        var ctx = document.getElementById("myAreaChart");
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["<?php echo $colunas; ?>"],
                datasets: [{
                    label: "Interações",
                    lineTension: 0.3,
                    backgroundColor: "rgba(150,75,0,0.2)",
                    borderColor: "rgba(150,75,0,1)",
                    pointRadius: 5,
                    pointBackgroundColor: "rgba(150,75,0,1)",
                    pointBorderColor: "rgba(150,75,0,0.8)",
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(150,75,0,1)",
                    pointHitRadius: 50,
                    pointBorderWidth: 2,
                    data: [<?php echo $valores; ?>],
                }],
            },
            options: {
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'number'
                        },
                        gridLines: {
                            display: true
                        },
                        ticks: {
                            maxTicksLimit: 7
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max: 20,
                            maxTicksLimit: 5
                        },
                        gridLines: {
                            color: "rgba(0, 0, 0, .125)",
                        }
                    }],
                },
                legend: {
                    display: false
                }
            }
        });
    </script>
    <script>
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#292b2c';

        // Pie Chart Example
        var ctx = document.getElementById("myPieChart");
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ["Em Andamento", "Solucionado"],
                datasets: [{
                    data: [<?php echo $aCasosAbertoSolucionado[1]; ?>, <?php echo $aCasosAbertoSolucionado[0]; ?>],
                    backgroundColor: ['#eadbcc', '#964b00'],
                }],
            },
        });
    </script>

    <script>
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#292b2c';

        // Bar Chart Example
        var ctx = document.getElementById("myBarChart");
        var myLineChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Trabalhista", "Tributária", "Direito Civil", "Compliance e ética", "Biodireito", "Direito Digital", 'Ambiental', 'Contencioso Civil', 'Advogado Eleitoral', 'Jurídico', 'Relações Institucionais', 'Direito Médico', 'Outros'],
                datasets: [{
                    label: "Quantidade",
                    backgroundColor: "rgba(150,75,0,1)",
                    borderColor: "rgba(150,75,0,0.8)",
                    data: [<?php echo $ramos; ?>],
                }],
            },
            options: {
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'number'
                        },
                        gridLines: {
                            display: true
                        },
                        ticks: {
                            maxTicksLimit: 10
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max: 10,
                            maxTicksLimit: 6
                        },
                        gridLines: {
                            display: true
                        }
                    }],
                },
                legend: {
                    display: false
                }
            }
        });
    </script>

    <script>
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#292b2c';

        // Pie Chart Example
        var ctx = document.getElementById("myPieChart2");
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ["Em Andamento", "Solucionado"],
                datasets: [{
                    data: [<?php echo $aCasosAbertoSolucionado[1]; ?>, <?php echo $aCasosAbertoSolucionado[0]; ?>],
                    backgroundColor: ['#eadbcc', '#964b00'],
                }],
            },
        });
    </script>

</body>

</html>
