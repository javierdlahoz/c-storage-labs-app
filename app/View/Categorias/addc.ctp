<div class="users form">
<?php 

	echo $this->Form->create('Categoria'); ?>
    
    <fieldset>
      <legend>Crear Categoria</legend>
        <legend>
        <?php 
            if(isset($cpadre)){
        	    echo $this->Html->link('<< Regresar a la lista', array('controller' => 'categorias', 'action' => 'view', $cpadre));
            }
            else{
                echo $this->Html->link('<< Regresar a la lista', array('controller' => 'categorias', 'action' => 'index'));
            } 
        ?>
        <br><br></legend>
      <?php
		echo $this->Form->input('nombre');
        echo $this->Form->input('descripcion', array('type' => 'textarea'));       
		echo $this->Form->input('cpadre', array('type' => 'hidden', 'value' => $cpadre));
		?>
    	
       
    </fieldset>
<?php echo $this->Form->end(__('Crear'));  ?>
</div>
