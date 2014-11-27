<h2>Usuarios del Sistema</h2>
<table width="90%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E3EDF4">
<?php 
	echo $this->Html->css('autocomplete');
	echo $this->Form->create('User', array('action'=> 'index'));  ?>
  <tr>
    <td width="95%" valign="middle"><?php 
    echo $this->Form->input('username', array('type'=>'text','id'=>'username','label'=>'Buscar')); ?>
    <?php echo $this->Html->link('Mostrar todos', array('controller' => 'users', 'action' => 'index')); ?></td>
    <td width="5%" align="center" valign="middle">
		<?php echo $this->Form->end(__('Ir', true)); ?>
   </td>
  </tr>
</table>
<br /><p><?php echo $this->Html->link('Crear un nuevo usuario', array('controller' => 'users', 'action' => 'add')); ?>
  <?php if(!empty($users)) {?></p><br />
<table>
<tr>
        <th>Nombre</th>
        <th>Nombre de Usuario</th>
        <th>Organizaci�n</th>
        <th>Correo Electr�nico</th>
        <th align="center" width="25px">Borrar</th>
    </tr>
    <!-- Here is where we loop through our $posts array, printing out post info -->
    
    <?php foreach ($users as $user): ?>
    <tr>
    	<td><?php echo $this->Html->link($user['User']['nombre'], 
    			array('controller' => 'users', 'action' => 'edit', $user['User']['id'])) ; ?></td>		
        <td><?php echo $this->Html->link($user['User']['username'], array('controller' => 'users', 'action' => 'edit', $user['User']['id'])) ; ?></td>
        <td><?php echo $this->Html->link($user['User']['organizacion'], array('controller' => 'users', 'action' => 'edit', $user['User']['id'])) ; ?></td>
        <td>
            <?php echo $this->Html->link($user['User']['email'], array('controller' => 'users', 'action' => 'edit', $user['User']['id'])); ?>
        </td>
        <td align="center" width="25px">
        	<center>
        	<?php 
        	if($this->Session->read('Auth.User.id')!=$user['User']['id'])
        	echo $this->Html->link('X', array('controller' => 'users', 'action' => 'delete', $user['User']['id'])); ?>
        </center>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php } else {?>
<p>Aun no se han agregado usuarios, para agregar uno haga clic 
 <a href = 'users/add'>aqu�</a></p>
<?php } ?>
