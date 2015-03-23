<?php

echo $this->Form->create('Usuario'); ?>

<fieldset>
    <legend>Asignar Usuario</legend>
    <legend>
        <?php 
        	 echo $this->Html->link('<< Regresar a la lista', array('controller' => 'usuarios', 'action' => 'index', $cpadre)); ?>
        <br><br></legend>
      <?php
		echo $this->Form->input('usuario', array('type' => 'select', 'options' => $usuarios));       
		echo $this->Form->input('cpadre', array('type' => 'hidden', 'value' => $cpadre));
		echo $this->Form->input('id', array('type' => 'hidden', 'value' => $cpadre.'-'.rand()));
		?>
</fieldset>
<?php echo $this->Form->end(__('Asignar'));  ?>