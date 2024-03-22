<?php
include '../../conexao.php';

justLog($__EMAIL__, $__TYPE__, 2);

header('Content-Type: application/json; charset=utf-8');

$request = file_get_contents('php://input');
$json = json_decode($request);

$title  = scapeString($__CONEXAO__, $json->title);
$desc   = scapeString($__CONEXAO__, $json->desc);
$time   = scapeString($__CONEXAO__, $json->time);
$type   = scapeString($__CONEXAO__, $json->type);
$to     = scapeString($__CONEXAO__, $json->to);

if($type == 3){
    $to = "geral";
}

$title  = setNoXss($title);
$desc   = setNoXss($desc);
$time   = setNum($time);
$type   = setNum($type);
$to     = setNum($to);

checkMissing(
    array(
        $title,
        $desc,
        $time,
        $type,
        $to,
    )
);

if($type == 3){
    $to = 0;
}

$time = decrypt($time);
$type = decrypt($type);
$to = decrypt($to);

$check = mysqli_query($__CONEXAO__, "select id from recados where title='$title' and type='$type' and to='$to'");

if(mysqli_num_rows($check) > 0){
    endCode("Mensagem igual", false);
}

mysqli_query($__CONEXAO__, "insert into recados (type, from, to, title, descricao, time, created) values ('type', '$__ID__', '$to', '$title', '$desc', '$time', '$__TIME__')");

endCode("Enviado", true);