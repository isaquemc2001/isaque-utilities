<?php

$localhost = "localhost";
$username = "root";
$password = "";
$dbname = "chamado";

$conn = mysqli_connect($localhost, $username, $password, $dbname);

$requestData=$_REQUEST;

$columns = array(
    array( '0' => 'id'),
    array( '1' => 'titulo'),
    array( '2' => 'tipo_erro'),
    array( '3' => 'descricao'),
);

//obtendo resultado sem pesquisa
$result_user = "SELECT * FROM chamados WHERE 1=1";
$resultado_user = mysqli_query($conn, $result_user);
$qnt_linhas = mysqli_num_rows($resultado_user);

//obter resultados a ser apresentado
$result_usuarios = "SELECT * FROM chamados";

$resultado_usuarios=mysqli_query($conn, $result_usuarios);
$totalFiltered = mysqli_num_rows($resultado_usuarios);

//ordenar resultado
$result_usuarios.= "ORDER BY ". $columns[$requestData['order'][0]['column']]."    ".$requestData['order'][0]['dir']." LIMIT ".$requestData['start']." ,".$requestData['lenght']."   ";
$resultado_usuarios = mysqli_query($conn, $result_usuarios);

//ler e criar o array de dados
$dados = array();
while ($row_usuarios = mysqli_fetch_array($resultado_usuarios)){
    $dado = array();
    $dado[] = $row_usuarios['id'];
    $dado[] = $row_usuarios['titulo'];
    $dado[] = $row_usuarios['tipo_erro'];
    $dado[] = $row_usuarios['descricao'];

    $dados[] = $dado;
}

//cria o array de informações a serem retornadas para o javascript
$json_data = array(
    "draw" => intval($requestData['draw']), //para cada requisição é enviado um número como parametro
  "recordsTotal" => intval($qnt_linhas), //quantidade de registros que há no banco de dados
  "recordsFiltered" => intval($totalFiltered), //total de resgistros quando houver pesquisa
  "data" => $dados //array de dados completo dos dados retornados da tabela
);

echo json_encode($json_data); //enviar dados com formato json


?>