<?php 
try{
	$db = new PDO('mysql:host=localhost;dbname=testt;charset=utf8','root','root');
}

catch(Exception $e)
{
	die('Erreur : '. $e->getMessage());
}

$statement = $db->prepare('SELECT * FROM transition');

$statement->execute();
$data = $statement->fetchAll();


foreach($data as $action){


	$testStatement = $db->prepare('SELECT * FROM data WHERE idTran = '.$action['IDTran']);

	$testStatement->execute();
	$dataTest = $testStatement->fetchAll();
	echo '===========================NEW ROW=====================================<br/>';
	echo $action['Titre'].'<br/>';
	if (sizeof($dataTest)==0) {
		$transferStatement = $db->prepare("INSERT INTO data (idTran, user, title, date, time, delay, refTran, comment) VALUES (?,?,?,?,?,?,?,?)");
		$attributes = explode(',', $action['Attribut']);

		$transferStatement->execute([$action['IDTran'],$action['Utilisateur'],$action['Titre'], $action['Date'], $action['Heure'], $action['Delai'],$action['RefTran'],$action['Commentaire']]);

		foreach($attributes as $attribute){
			echo '============New Attribute==========    <br/>attribute : '.$attribute.'<br/>';
			$split_attribute = explode('=',$attribute);
			if (count($split_attribute)==1){
				$type = $split_attribute[0];
				$value = '';
			}
			elseif (count($split_attribute)==2) {
				list($type, $value) = $split_attribute;
			}
			else{
				echo 'houston on a un probleme <br/>';
				$type = '';
				$value = '';
			}
			echo $type.'--->'.$value.'<br/><br/>';
			$attributeStatement = $db->prepare("INSERT INTO  attributes (idTran, attributeType, attributeValue) VALUES (?,?,?)");
			echo $attributeStatement->execute([$action['IDTran'],$type, $value]).'<br/>';
			echo 'Attribute Done <br/>';
		}

		//echo $action['IDTran'].'<br/>';
	}

	
}

?>