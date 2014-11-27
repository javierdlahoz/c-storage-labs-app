<?php $event = $this->Js->get('#contrasena')->effect('fadeIn');
$this->Js->get('#celdatest')->event('click', $event);
?>
<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Ingrese su nombre de usuario y password'); ?></legend>
    <?php
        echo $this->Form->input('username');
        echo $this->Form->input('password');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Ingresar')); ?>
<table>
	<tr><td>
	<?php echo $this->Html->link('Registrarme', array('controller'=>'users', 'action'=>'add')); ?>
	</td></tr>
	<tr>
    	<td onclick='<?php echo $this->Js->get("#contrasena")->effect("fadeIn"); ?>' style="cursor:pointer">       
        <div id="celdatest">Olvid&eacute; mi password</div></td>
    </tr>
</table>
<div id='contrasena' style="display:none">
<table>
	<tr>
    	<td bgcolor="#DDE7E8">Ingrese su nombre de usuario:   	
		<?php echo $this->Form->create('User', array('action' => 'restaurar')); ?>
		<?php echo $this->Form->input('username'); ?>
        <?php echo $this->Form->end(__('Restaurar')); ?></td>
    </tr>
    <tr>
    	<td onclick='<?php echo $this->Js->get("#contrasena")->effect("fadeOut"); ?>' style="cursor:pointer">Ocultar</td>
    </tr>
</table>
</div></div>