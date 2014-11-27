<div class="users form">
<?php 

	echo $this->Form->create('User'); ?>
    
    <fieldset>
        <legend>Crear Usuario</legend>
        <?php if($this->Session->read('Auth.User.role')=='admin')
        	 echo $this->Html->link('<< Regresar a la lista', '/users/index'); ?><br><br>
    <?php
        echo $this->Form->input('username');
        echo $this->Form->input('password');
        echo $this->Form->input('Confirmar_password', array('type'=>'password'));
        echo $this->Form->input('nombre');
        echo $this->Form->input('email');
        echo $this->Form->input('organizacion', array('label' => 'Organización'));
		echo $this->Form->input('role', array('value' => 'author','type'=>'hidden'));
        echo $this->Form->input('imagen', array('type' => 'file'));
      
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Crear'));  ?>
</div>
