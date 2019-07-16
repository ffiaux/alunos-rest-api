<?php

include("../db_connection.php");

$db = new DatabaseConnection();
$connection =  $db->getConn();
$result = null;
$sql = null;

if(!empty($_GET["id"]))
{
	$id = intval($_GET["id"]);
	$sql = "SELECT T.ID AS ID, T.Codigo AS Codigo, T.Sala AS Sala, D.Nome AS Nome, T.DataInicio AS DataInicio, T.DataFim AS DataFim FROM ferfia3_db.Turmas T INNER JOIN Disciplinas D ON (T.DisciplinaID = D.ID) WHERE T.ID = ". $id;		
}
else
{
	$sql = "SELECT T.ID AS ID, T.Codigo AS Codigo, T.Sala AS Sala, D.Nome AS Nome, T.DataInicio AS DataInicio, T.DataFim AS DataFim FROM ferfia3_db.Turmas T INNER JOIN Disciplinas D ON (T.DisciplinaID = D.ID)";
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
	        $t->id = $row['ID'];
		$t->codigo = $row['Codigo'];
		$t->sala = $row['Sala'];
		$t->nome_disciplina = $row['Nome'];
		$t->data_inicio = $row['DataInicio'];
		$t->data_fim = $row['DataFim'];
		
		array_push($turmas, $t);
		$t = null;
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