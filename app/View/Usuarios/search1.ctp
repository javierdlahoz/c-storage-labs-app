<?php

if(!empty($objetos)) {

    $data = array();

    foreach ($objetos as $objeto){
        $data[] = $objeto['Objeto'];
    }

    echo json_encode($data);
}
else echo 'No hay resultados';

?>