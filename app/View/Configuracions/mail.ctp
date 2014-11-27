<?php 
	echo $this->Form->create('Configuracion'); ?>
    <fieldset>
        <h2>Configuración de envío de correos</h2>
      <?php 	
		foreach($configuraciones as $configuracion){
			$correo_calidad = $configuracion['correo_calidad'];
						
		}
		?>
      <?php
  	  echo $this->Form->input('correo_calidad', array('label' => 'Correo del director de calidad', 'value'=>$correo_calidad));
	  echo $this->Form->input('id', array('value'=>'001', 'type' =>'hidden'));
  	  //echo $this->Form->input('id', array('type' => 'hidden', 'value' => $id_cat));         
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Modificar'));  ?>