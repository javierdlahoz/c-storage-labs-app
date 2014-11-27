<?php 
	$mongo = new Mongo("localhost:27020");
	$db = $mongo->selectDB("observatorio");
	$gridFS = $db->getGridFS();
	$archivos = $gridFS->findOne(array('id_observatorio'=>$id_ob));
	echo $archivos->getBytes();
?>


