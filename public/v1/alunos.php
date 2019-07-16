<?php

include("../db_connection.php");

$db = new DatabaseConnection();
$connection =  $db->getConn();
$result = null;
$sql = null;

if(!empty($_GET["id"]))
{
	$id = intval($_GET["id"]);
	$sql = "SELECT * FROM ferfia3_db.Alunos WHERE ID = ". $id;		
}
else
{
	$sql = "SELECT * FROM ferfia3_db.Alunos";
}

$result = $connection->query($sql);
$alunos = array();

if ($result != null)
{
	if ($result->num_rows > 0) 
	{
	    // output data of each row
	    while($row = $result->fetch_assoc()) 
	    {
	        $a->id = $row['ID'];
		$a->nome = $row['Nome'];
		$a->matricula = $row['Matricula'];
		$a->identidade = $row['Identidade'];
		$a->cpf = $row['CPF'];
		$a->data_nascimento = $row['DataNascimento'];
		$a->email = $row['Email'];
		
		array_push($alunos, $a);
		$a = null;
	    }
	} 
	else 
	{
	    echo "0 results";
	}
}
	
$alunosJson = json_encode($alunos);
header('Content-Type: application/json');
$connection->close();
echo $alunosJson;

?>