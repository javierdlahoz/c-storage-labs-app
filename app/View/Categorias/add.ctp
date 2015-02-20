<?php echo $this->Form->create('Categoria'); ?>
<fieldset>
    <legend>Crear Categoria</legend>
    <legend>
        <?php 
        	 echo $this->Html->link('<< Regresar a la lista', '/categorias/index'); ?>
        <br><br></legend>
      <?php
		echo $this->Form->input('nombre');
        echo $this->Form->input('descripcion', array('type' => 'textarea'));       
		echo $this->Form->input('cpadre', array('type' => 'hidden', 'value' => '517eb611398dacb818000004'));
		?>


</fieldset>
<?php echo $this->Form->end(__('Crear'));  ?>