<h2><?php echo $nombre; ?></h2><p><?php 
if($canterior=='517eb611398dacb818000004'){
	echo $this->Html->link('<< Regresar', array('controller' => 'categorias', 'action' => 'index')); }
	else
	{
		echo $this->Html->link('<< Regresar', array('controller' => 'categorias', 'action' => 'view', $canterior));
		} ?>  ||  <?php echo $this->Html->link('Propiedades', array('controller' => 'propiedades', 'action' => 'index', $id)); ?> || <?php echo $this->Html->link('Usuarios', array('controller' => 'usuarios', 'action' => 'index', $id)); ?></p>
<p><?php echo $this->Html->link('Crear nueva subcategoria', array('controller' => 'categorias', 'action' => 'addc', $cpadre)); ?>
  <?php   
  if(!empty($categorias)) {?>
</p>
<br />
<table width="95%">
<tr>
        <th width="940" align="left">SubCategoria</th>
        <th align="center" width="41">Editar</th>
        <th align="center" width="45">Borrar</th>
    </tr>
    
    
    <?php foreach ($categorias as $categoria): ?>
    <tr>
    	<td><?php echo $this->Html->link($categoria['Categoria']['nombre'], 
    			array('controller' => 'categorias', 'action' => 'view', $categoria['Categoria']['id'])) ; ?></td>
    	<td width="41" align="center" style="text-align: center"><?php 
			$imagen = $this->Html->image('edit.png', array('height'=>'16', 'width'=>'16')); 
		echo $this->Html->link($imagen, 
    			array('controller' => 'categorias', 'action' => 'edit', $categoria['Categoria']['id']), array('escape'=>false)) ; ?></td>		
        <td width="45" align="center" style="text-align: center">
        	<center>
        	<?php 
        	    	echo $this->Html->link('x', array('controller' => 'categorias', 'action' => 'delete', $categoria['Categoria']['id']), array('escape' => false), "Desea continuar?" ); ?>
        </center>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php } else {?>
<p>Aun no se han agregado ningun recurso, puede cargar uno 
 <a href = 'cateogiras/add'>aquí</a></p>
<?php } ?>
