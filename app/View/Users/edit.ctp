<div class="users form">
<h2>Modificando usuario</h2>
<p><?php if($this->Session->read('Auth.User.role')=='admin')
	echo $this->Html->link('<<Regresar', array('controller' => 'users', 'action' => 'index')); ?></p><br>
<?php
    echo $this->Form->create('User', array('action' => 'edit', 'type' => 'file')); ?>
    <fieldset><?php 
    echo $this->Form->input('nombre');
    echo $this->Form->input('email');
    echo $this->Form->input('organizacion', array('label' => 'Organización'));
    echo $this->Form->input('imagen', array('type' => 'file'));
    echo $this->Form->input('id', array('type' => 'hidden')); ?>
    <center>
    <?php 
    foreach($usuarios as $usuario){
    	if(isset($usuario['imagen'])){
            $imagen = $usuario['imagen'];    
        }
    	$nombre = $usuario['nombre'];
	}
    if(isset($usuario['imagen'])){
        echo $this->Html->image('/files/usrpic/'.$imagen, array( 'width' => '256', 'title' =>  $nombre));
    }
    ?></center></fieldset>
   <?php echo $this->Form->end('Modificar');?>
   <?php echo $this->Html->link("Cambiar Password", array('controller' => 'users', 'action' => 'cambioc', $this->Session->read('Auth.User.id'))); ?></div>
