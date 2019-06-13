<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 06/03/2019
 * Time: 20:07
 */

class Model
{

    /**
     * @param $dados_usuario
     * @param $con
     * @return Exception|int
     */
    function cadastrar_usuario($dados_usuario, $con){

        try{

            $nome = $dados_usuario[0];
            $email = $dados_usuario[2];
            $senha = $dados_usuario[3];
            $cpf = $dados_usuario[1];
            //$telefone = $dados_usuario;
            //$celular = $dados_usuario;
            $endereco = $dados_usuario[4];
            $cidade = $dados_usuario[5];
            $estado = $dados_usuario[6];
            $cep = $dados_usuario[7];
            $sexo = $dados_usuario[8];
            $data_nascimento = $dados_usuario[9];

            $hash_senha = hash('sha256', $senha);

            $query = "INSERT INTO `law`.`usuario`
                        (`nome_completo`,`email`,
                        `senha`,`cpf`,`endereco`,
                         `cidade`,`estado`,
                        `cep`,`sexo`,`data_nascimento`)
                        VALUES
                        ('$nome','$email',
                        '$hash_senha','$cpf',
                        '$endereco','$cidade','$estado',
                        '$cep','$sexo','$data_nascimento');";

            $stmt = mysqli_query($con, $query);

            return $stmt;
        }catch (Exception $exception){
            return $exception;exit;
        }

    }

    function verifica_login($dados_usuario, $con){

        try{

            $email = $dados_usuario[0];
            $senha = hash('sha256', $dados_usuario[1]);

            $query = "SELECT `id`, `nome_completo`, `email`, `cpf` 
            FROM `law`.`usuario` 
            WHERE `email` = '$email' and senha = '$senha';";

            $stmt = mysqli_query($con, $query);

            return $stmt;
        }catch (Exception $exception){
            return $exception;exit;
        }

    }

    function busca_compromissos_agenda ($cpfcnpj, $con){

        try{

            $query = "SELECT idagenda, tarefa, data_inicio, data_fim, nivel, descricao
                      FROM law.agenda
                      WHERE cpfcnpj = '$cpfcnpj'";

            $stmt = mysqli_query($con, $query);

            return $stmt;

        }catch (Exception $exception){
            return $exception;exit;
        }
    }

    function adiciona_novos_compromissos ($cpfcnpj, $titulo, $dataInicio, $dataFim, $nivel, $descricao,  $con){

        try{

            $query = "INSERT INTO law.agenda (tarefa, data_inicio, data_fim, nivel, cpfcnpj, descricao) 
                      values ('$titulo', '$dataInicio', '$dataFim', '$nivel', $cpfcnpj ,'$descricao')";

            $stmt = mysqli_query($con, $query);

            return $stmt;

        }catch (Exception $exception){
            return $exception;exit;
        }
    }

    function exclui_tarefa_agenda ($cpfcnpj, $id, $con){

        try{

            $query = "DELETE FROM law.agenda WHERE idagenda = '$id' AND cpfcnpj = '$cpfcnpj';";

            $stmt = mysqli_query($con, $query);

            return $stmt;

        }catch (Exception $exception){
            return $exception;exit;
        }

    }

    function altera_tarefa_agenda($cpfcnpj, $id, $nova_data_inicio, $nova_data_fim, $con){

        try{

            $query = "UPDATE agenda
                        SET data_inicio = '$nova_data_inicio', data_fim = '$nova_data_fim'
                        WHERE idagenda = '$id' AND cpfcnpj = '$cpfcnpj';";

            $stmt = mysqli_query($con, $query);

            return $stmt;

        }catch (Exception $exception){
            return $exception;exit;
        }

    }

    function busca_mural_advogado($cpfcnpj, $con){

        try{

            $query = "SELECT mensagem
                        FROM mural_advogado
                        WHERE cpfcnpj = '$cpfcnpj'";

            $stmt = mysqli_query($con, $query);

            return $stmt;

        }catch (Exception $exception){
            return $exception;exit;
        }

    }

    function inserir_mural_advogado($cpfcnpj, $mensagem, $is_link, $con){

        try{

            $query = "INSERT INTO mural_advogado
                        (mensagem, is_link, data_publicacao, excluido, cpfcnpj)
                        VALUES
                        ('$mensagem', $is_link, now(),NULL, '$cpfcnpj')";

            $stmt = mysqli_query($con, $query);

            return $stmt;

        }catch (Exception $exception){
            return $exception;exit;
        }

    }

    function atualiza_dados_advogado($cpfcnpj, $telefone, $formacao, $cep, $con){

        try{

            $query = "UPDATE law.usuario
                        SET telefone = '$telefone', cep = '$cep', formacao = '$formacao'
                        WHERE cpf = '$cpfcnpj';";

            $stmt = mysqli_query($con, $query);

            return $stmt;

        }catch (Exception $exception){
            return $exception;exit;
        }

    }

    function busca_casos_juridicos($cpfcnpj, $con){

        try{

            $query = "SELECT id_caso, numero_caso, nome_cliente, titulo_processo, classe_judicial, ultima_alteracao, duracao_processo
                        FROM law.casos_juridicos
                        WHERE cpfcnpj_advogado = '$cpfcnpj';";

            $stmt = mysqli_query($con, $query);

            return $stmt;

        }catch (Exception $exception){
            return $exception;exit;
        }

    }

    function busca_caso_juridico_por_id($cpfcnpj, $idcaso, $con){

        try{

            $query = "SELECT titulo_processo, cpfcnpj_advogado, status, ultima_alteracao, nome_cliente, tipo_processo, autuacao, ramo_direito, relator, numero_caso, classe_judicial, orgao_julgador, polo_ativo, polo_passivo, cpfcnpj_poloAtivo, cpfcnpj_poloPassivo, position
                        FROM law.casos_juridicos
                        WHERE cpfcnpj_advogado = '$cpfcnpj' and id_caso = '$idcaso';";

            $stmt = mysqli_query($con, $query);

            return $stmt;

        }catch (Exception $exception){
            return $exception;exit;
        }

    }

    function busca_status_casos_juridicos($con){

        try{

            $query = "SELECT descricao_status
                        FROM law.status_casos";

            $stmt = mysqli_query($con, $query);

            return $stmt;

        }catch (Exception $exception){
            return $exception;exit;
        }

    }

    function busca_ocorrencias_caso($id_caso, $con){

        try{

            $query = "SELECT id_ocorrencia, descricao_ocorrencia, data_ocorrencia
                        FROM law.casos_ocorrencias
                        WHERE id_caso_ocorrencia = '$id_caso'";

            $stmt = mysqli_query($con, $query);

            return $stmt;

        }catch (Exception $exception){
            return $exception;exit;
        }

    }


    function exclui_ocorrencia_caso($id_ocorrencia, $con){

        try{

            $query = "DELETE FROM law.casos_ocorrencias
                        WHERE id_ocorrencia = '$id_ocorrencia'";

            $stmt = mysqli_query($con, $query);

            return $stmt;

        }catch (Exception $exception){
            return $exception;exit;
        }

    }

    function adiciona_nova_ocorrencia($idcaso, $ocorrencia, $con){

        try{

            $query = "INSERT INTO casos_ocorrencias (id_caso_ocorrencia, descricao_ocorrencia, data_ocorrencia)
                      VALUES ('$idcaso', '$ocorrencia', now());";

            $stmt = mysqli_query($con, $query);

            return $stmt;

        }catch (Exception $exception){
            return $exception;exit;
        }

    }

    function busca_movimentacoes_caso($idcaso, $cpfcnpj, $con){

        try{

            $query = "SELECT descricao_movimentacao, date_format(data_movimentacao, '%d/%m/%Y %H:%i:%s') as data_movimentacao, arquivado
                        FROM law.casos_movimentados
                        WHERE id_caso = '$idcaso' AND
                               cpfcnpj_advogado = '$cpfcnpj'";

            $stmt = mysqli_query($con, $query);

            return $stmt;

        }catch (Exception $exception){
            return $exception;exit;
        }

    }

    function cadastra_movimentacoes($descricao, $idcaso, $cpfcnpj, $num_caso, $arquivado, $con){

        try{

            $query = "INSERT INTO casos_movimentados (descricao_movimentacao, id_caso, data_movimentacao, cpfcnpj_advogado, numero_caso, arquivado)
                      VALUES ('$descricao', '$idcaso', now(), '$cpfcnpj', '$num_caso', $arquivado);";

            $stmt = mysqli_query($con, $query);

            return $stmt;

        }catch (Exception $exception){
            return $exception;exit;
        }
    }

    function verificado_caso_esta_arquivado($idcaso, $cpfcnpj, $con){

        try{

            $query = "SELECT id_caso, date_format(data_movimentacao, '%d/%m/%Y %H:%i:%s') as data_movimentacao, arquivado
                        FROM law.casos_movimentados
                        WHERE id_caso = '$idcaso'
                              AND cpfcnpj_advogado = '$cpfcnpj'
                              AND arquivado = 1";

            $stmt = mysqli_query($con, $query);

            return $stmt;

        }catch (Exception $exception){
            return $exception;exit;
        }

    }

    function busca_advogados_cadastrados($con){

        try{

            $query = "SELECT cpf, nome_completo, email, telefone, celular, cidade, estado, cep, sexo
                        FROM law.usuario";

            $stmt = mysqli_query($con, $query);

            return $stmt;

        }catch (Exception $exception){
            return $exception;exit;
        }

    }

    function cadastra_nova_mensagem($origem, $mensagem, $destino, $con){

        try{

            $query = "INSERT INTO law.mensagem (cpf_advogado, data, mensagem, advogado_destino)
                      VALUES ('$origem', now(), '$mensagem', '$destino' );";

            $stmt = mysqli_query($con, $query);

            return $stmt;

        }catch (Exception $exception){
            return $exception;exit;
        }

    }

    function busca_mensagens($origem, $con){

        try{

            $query = "SELECT DATE_FORMAT(m.data, '%d/%m/%Y %H:%i:%s') as data, m.mensagem, m.advogado_destino, u.nome_completo
                        FROM law.mensagem m
                        inner join usuario u on u.cpf = m.advogado_destino
                        where m.cpf_advogado = '$origem'";

            $stmt = mysqli_query($con, $query);

            return $stmt;

        }catch (Exception $exception){
            return $exception;exit;
        }

    }

    function busca_ultimo_caso_juridico_por_cpf($cpfcnpj, $con){

        try{

            $query = "SELECT id_caso, titulo_processo, cpfcnpj_advogado, status, ultima_alteracao, nome_cliente, tipo_processo, autuacao, ramo_direito, relator, numero_caso, classe_judicial, orgao_julgador, polo_ativo, polo_passivo, cpfcnpj_poloAtivo, cpfcnpj_poloPassivo, position
                        FROM law.casos_juridicos
                        WHERE cpfcnpj_advogado = '$cpfcnpj'
                        ORDER BY id_caso DESC;";

            $stmt = mysqli_query($con, $query);

            return $stmt;

        }catch (Exception $exception){
            return $exception;exit;
        }

    }

    function busca_Advogado_porEmail($email, $con){

        try{

            $query = "SELECT cpf, nome_completo, email
                        FROM law.usuario
                        WHERE email = '$email'";

            $stmt = mysqli_query($con, $query);

            return $stmt;

        }catch (Exception $exception){
            return $exception;exit;
        }
    }

    function busca_feedback_caso($idcaso, $con, $advogado_origem){

        try{

            $query = "SELECT cpf_advogado_origem, email_cliente, data_contato, caso_juridico, mes_vigencia
                    FROM feedback_cliente
                    WHERE caso_juridico = '$idcaso'
                    AND cpf_advogado_origem = '$advogado_origem';";

            $stmt = mysqli_query($con, $query);

            return $stmt;

        }catch (Exception $exception){
            return $exception;exit;
        }

    }

    function busca_qtd_feedback_caso($idcaso, $con, $advogado_origem){

        try{

            $query = "SELECT mes_vigencia, count(id_feedback) as 'qtd'
                    FROM feedback_cliente
                    WHERE caso_juridico = '$idcaso'
                    AND cpf_advogado_origem = '$advogado_origem'
                    GROUP BY mes_vigencia;";

            $stmt = mysqli_query($con, $query);

            return $stmt;

        }catch (Exception $exception){
            return $exception;exit;
        }

    }
}