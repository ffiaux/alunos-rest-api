<?php

include("../db_connection.php");

$db = new DatabaseConnection();
$connection =  $db->getConn();
$result = null;
$sql = null;

if(!empty($_GET["id"]))
{
	$id = intval($_GET["id"]);
	$sql = "SELECT A.ID AS ID, A.Nome AS Nome, A.CPF AS CPF, E.Endereco AS Endereco, E.Bairro AS Bairro, E.Cidade AS Cidade, E.CEP AS CEP, E.UF AS UF, E.Numero AS Numero FROM ferfia3_db.Enderecos E INNER JOIN ferfia3_db.Alunos A ON (A.ID = E.AlunoID) WHERE E.ID = ". $id;		
}
else
{
	$sql = "SELECT A.ID AS ID, A.Nome AS Nome, A.CPF AS CPF, E.Endereco AS Endereco, E.Bairro AS Bairro, E.Cidade AS Cidade, E.CEP AS CEP, E.UF AS UF, E.Numero AS Numero FROM ferfia3_db.Enderecos E INNER JOIN ferfia3_db.Alunos A ON (A.ID = E.AlunoID)";
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
		$e->endereco = $row['Endereco'];
		$e->numero = $row['Numero'];			
		$e->bairro = $row['Bairro'];
		$e->cidade = $row['Cidade'];
		$e->uf = $row['UF'];			
		$e->cep = $row['CEP'];			
					
		array_push($enderecos, $e);
		$e = null;
	    }
	} 
	else 
	{
	    echo "0 results";
	}
}
	
$enderecosJson = json_encode($enderecos);
header('Content-Type: application/json');
$connection->close();
echo $enderecosJson;

?>