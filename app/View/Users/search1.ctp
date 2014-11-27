<?php

if(!empty($users)) {

    $data = array();

    foreach ($users as $user){
        $data[] = $user['User'];
    }

    echo json_encode($data);
}
else echo 'No hay resultados';

?>