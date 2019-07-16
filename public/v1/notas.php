<?php

include("../db_connection.php");

$db = new DatabaseConnection();
$connection =  $db->getConn();
$result = null;
$sql = null;

if(!empty($_GET["id"]))
{
	$id = intval($_GET["id"]);
	$sql = "SELECT A.ID AS ID, A.Nome AS Nome, A.CPF AS CPF, N.Nota AS Nota, P.Codigo AS Prova, P.DataAplicacao AS DataAplicacao, T.Codigo AS Turma, T.Sala AS Sala FROM ferfia3_db.Notas N INNER JOIN ferfia3_db.Alunos A ON (A.ID = N.AlunoID) INNER JOIN Provas P ON (P.ID = N.ProvaID) INNER JOIN Turmas T ON (T.ID = P.TurmaID) WHERE A.ID = ". $id;		
}

$result = $connection->query($sql);
$enderecos = array();

if ($result != null)
{
	if ($result->num_rows > 0) 
	{
	    // output data of each row
	    while($row = $result->fetch_assoc()) 
	    {
	        $e->id = $row['ID'];
	        $e->nome_aluno = $row['Nome'];
       	        $e->cpf_aluno = $row['CPF'];
		$e->nota = $row['Nota'];
		$e->codigo_prova = $row['Prova'];			
		$e->codigo_turma = $row['Turma'];
		$e->sala = $row['Sala'];
		$e->data = $row['DataAplicacao'];	
					
		array_push($enderecos, $e);
		$e = null;
	    }
	} 
}
	
$enderecosJson = json_encode($enderecos);
header('Content-Type: application/json');
$connection->close();
echo $enderecosJson;

?>