<?php

include("../db_connection.php");

$db = new DatabaseConnection();
$connection =  $db->getConn();
$result = null;
$sql = null;

if(!empty($_GET["id"]))
{
	$id = intval($_GET["id"]);
	$sql = "SELECT A.ID AS ID, A.Nome AS Nome, A.CPF AS CPF, T.DDD AS DDD, T.Telefone AS Telefone FROM ferfia3_db.Telefones T INNER JOIN ferfia3_db.Alunos A ON (A.ID = T.AlunoID) WHERE T.ID = ". $id;		
}
else
{
	$sql = "SELECT A.ID AS ID, A.Nome AS Nome, A.CPF AS CPF, T.DDD AS DDD, T.Telefone AS Telefone FROM ferfia3_db.Telefones T INNER JOIN ferfia3_db.Alunos A ON (A.ID = T.AlunoID)";
}

$result = $connection->query($sql);
$telefones = array();

if ($result != null)
{
	if ($result->num_rows > 0) 
	{
	    // output data of each row
	    while($row = $result->fetch_assoc()) 
	    {
	        $t->id = $row['ID'];
	        $t->nome_aluno = $row['Nome'];
       	        $t->cpf_aluno = $row['CPF'];
		$t->ddd = $row['DDD'];
		$t->telefone = $row['Telefone'];		
					
		array_push($telefones, $t);
		$t = null;
	    }
	} 
	else 
	{
	    echo "0 results";
	}
}
	
$telefonesJson = json_encode($telefones);
header('Content-Type: application/json');
$connection->close();
echo $telefonesJson ;

?>