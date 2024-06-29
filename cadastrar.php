<?php
require_once('./conectorMySQL.php');

$errors = [];
$data = [];

$txtNome = $_POST['txtNome'];
if (empty($txtNome)) {
    $errors['txtNome'] = 'Digite alguma coisa no campo txtNome para continuar.';
}

if (!empty($errors)) { // se a variável $errors não estiver vazia, ou seja, se conter algum erro
    $data['success'] = false;
    $data['errors'] = $errors;
} else { // se variável $errors estiver vazia, ou seja, se náo tiver qualquer erro
    try {
        $str_sql_cadastrar = "insert into `tbl_cadastro` (`nome`) values ('$txtNome')
        if ($conexao->query($str_sql_cadastrar) === TRUE) {
            $last_id = $conexao->insert_id;
            $msg = "O cadastro de $txtNome [ID $last_id] cadastrado com sucesso!";
            $data['success'] = true;
            $data['message'] = $msg;
        } else {
            $data['success'] = false;
            $data['errors'] = $errors;
        }
    } catch (\Exception $e) {
        $msg = "Ocorreu o erro: ." . str_replace(array("\r", "\n"), '', $e);
    }
}

echo json_encode($data);
