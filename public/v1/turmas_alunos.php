<?php

include("../db_connection.php");

$db = new DatabaseConnection();
$connection =  $db->getConn();
$result = null;
$sql = null;

if(!empty($_GET["id"]))
{
	$id = intval($_GET["id"]);
	$sql = "SELECT T.ID AS ID, T.Codigo AS Codigo, A.Nome AS Nome, A.CPF AS CPF, A.Email AS Email FROM ferfia3_db.Turmas T INNER JOIN TurmasAlunos TA ON (T.ID = TA.TurmaID) INNER JOIN Alunos A ON (A.ID = TA.AlunoID) WHERE T.ID = ". $id;		
}

$result = $connection->query($sql);
$turmas = array();

if ($result != null)
{
	if ($result->num_rows > 0) 
	{
	    // output data of each row
	    while($row = $result->fetch_assoc()) 
	    {
	        $ta->id = $row['ID'];
		$ta->codigo = $row['Codigo'];
		$ta->nome_aluno = $row['Nome'];
		$ta->cpf_aluno = $row['CPF'];
		$ta->email_aluno = $row['Email'];				
		
		array_push($turmas, $ta);
		$ta = null;
	    }
	} 
	else 
	{
	    echo "0 results";
	}
}
	
$turmasJson = json_encode($turmas);
header('Content-Type: application/json');
$connection->close();
echo $turmasJson;

?>