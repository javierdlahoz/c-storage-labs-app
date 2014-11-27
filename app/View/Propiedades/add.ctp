<div class="users form">
<?php 
	$opciones = array(
		'text' => 'Texto',
		'textarea' => 'Área de texto',
		'date' => 'Fecha',
		'boolean' => 'Booleano'
		);
		
	echo $this->Form->create('Propiedade'); ?>
    
    <fieldset>
      <legend>Crear Propiedad</legend>
        <legend>
        <?php 
        	 echo $this->Html->link('<< Regresar a la lista', array('controller' => 'propiedades', 'action' => 'index', $cpadre)); ?>
        <br><br></legend>
      <?php
		echo $this->Form->input('nombre');
        echo $this->Form->input('descripcion', array('type' => 'textarea'));
		echo $this->Form->input('tipo', array('type' => 'select', 'options' => $opciones));       
		echo $this->Form->input('cpadre', array('type' => 'hidden', 'value' => $cpadre));
		echo $this->Form->input('id', array('type' => 'hidden', 'value' => $cpadre.'-'.rand()));
		?>
    	
       
    </fieldset>
<?php echo $this->Form->end(__('Crear'));  ?>
</div>
