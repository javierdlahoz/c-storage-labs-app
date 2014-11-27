<div class="users form">
<h2>Cambio de Password: <?php echo $this->Session->read('Auth.User.nombre'); ?></h2>
<p><?php if($this->Session->read('Auth.User.role')=='admin')
	echo $this->Html->link('<<Regresar', array('controller' => 'users', 'action' => 'index')); ?></p><br>
<?php
    echo $this->Form->create('User'); ?>
    <fieldset><?php 
    echo $this->Form->input('password');
    echo $this->Form->input('confirmar_password', array('type' => 'password'));
    echo $this->Form->input('id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id')));?></fieldset>
   <?php echo $this->Form->end('Modificar');?>
   </div>