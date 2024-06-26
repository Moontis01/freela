<?php
include '../../conexao.php';

justLog($__EMAIL__, $__TYPE__, 3);

header('Content-Type: text/csv; charset=utf-8');
header("Content-Disposition: attachment;  filename*=UTF-8''relatorio_turmas.csv");

$resultado = fopen("php://output", 'w');

$cabecalho = ['id', 'Nome', 'Categoria', 'Horário','Status', 'Alunos', 'Professores'];

fputcsv($resultado, $cabecalho, ';');

$query = mysqli_query($__CONEXAO__, "select id, nome, categoria, horario, active from turmas");

while($dados = mysqli_fetch_array($query)){
    $id         = $dados["id"];
    $nome       = decrypt($dados["nome"]);
    $categoria  = $dados["categoria"];
    $horario    = decrypt($dados["horario"]);
    $horario    = getHora($horario);
    $status     = $dados["active"];
    $status     = $status == '1' ? "active" : "inactive";

    $getCat = mysqli_query($__CONEXAO__, "select nome from categorias where id='$categoria'");
    $assoc = mysqli_fetch_assoc($getCat);
    $categoria = decrypt($assoc["nome"]);

    $emails = array();

    $getProf = mysqli_query($__CONEXAO__, "select email from users where active='1' and email in (select email from professores where turma='$id')");
    $professores = "";

    while($prof = mysqli_fetch_array($getProf)){
        $em = decrypt($prof["email"]);
        if(!in_array($em, $emails)){
            $professores .= "$em, ";
        }
        array_push($emails, $em);
    }

    $getAlunos = mysqli_query($__CONEXAO__, "select email from users where active='1' and email in (select email from alunos where turma='$id')");
    $alunos = "";

    while($alu = mysqli_fetch_array($getAlunos)){
        $em = decrypt($alu["email"]);
        if(!in_array($em, $emails)){
            $alunos .= "$em, ";
        }
        array_push($emails, $em);
    }
    
    $content = array(
        $id,
        $nome,
        $categoria,
        $horario,
        $status,
        $alunos,
        $professores
    );

    fputcsv($resultado, $content, ';');
}