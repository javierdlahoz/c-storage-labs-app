<?php 
	echo $this->Form->create('Configuracion'); ?>
    <fieldset>
        <h2>Configuración de envío de correos</h2>
      <?php 	
    $correo_de_envio = "test@test.com";
    if(!empty($configuraciones)):  
  		foreach($configuraciones as $configuracion){
  			$correo_de_envio = $configuracion['correo_calidad'];		
  		}
    endif;
		?>
      <?php
  	  echo $this->Form->input('correo_calidad', array('label' => 'Dirección de envío de emails', 'value'=>$correo_de_envio));
	    echo $this->Form->input('id', array('value'=>'001', 'type' =>'hidden'));
  	  //echo $this->Form->input('id', array('type' => 'hidden', 'value' => $id_cat));         
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Modificar'));  ?>