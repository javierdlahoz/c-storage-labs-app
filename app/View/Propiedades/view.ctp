<h2><?php echo $nombre; ?></h2><p><?php 
if($canterior=='517eb611398dacb818000004'){
	echo $this->Html->link('<< Regresar', array('controller' => 'categorias', 'action' => 'index')); }
	else
	{
		echo $this->Html->link('<< Regresar', array('controller' => 'categorias', 'action' => 'view', $canterior));
		} ?></p>
<p><?php echo $this->Html->link('Crear nueva subcategoria', array('controller' => 'categorias', 'action' => 'addc', $cpadre)); ?>
  <?php   
  if(!empty($categorias)) {?>
</p>
<br />
<table width="95%">
<tr>
        <th width="807" align="left">SubCategoria</th>
        <th align="center" width="174">Editar</th>
        <th align="center" width="45">Borrar</th>
    </tr>
    
    
    <?php foreach ($categorias as $categoria): ?>
    <tr>
    	<td><?php echo $this->Html->link($categoria['Categoria']['nombre'], 
    			array('controller' => 'categorias', 'action' => 'view', $categoria['Categoria']['id'])) ; ?></td>
    	<td align="center" width="174"><?php echo $this->Html->link('Clic para editar', 
    			array('controller' => 'categorias', 'action' => 'edit', $categoria['Categoria']['id'])) ; ?></td>		
        <td align="center" width="45">
        	<center>
        	<?php 
        	    	echo $this->Html->link('X', array('controller' => 'categorias', 'action' => 'delete', $categoria['Categoria']['id'])); ?>
        </center>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php } else {?>
<p>Aun no se han agregado ningun recurso, puede cargar uno 
 <a href = 'cateogiras/add'>aquí</a></p>
<?php } ?>
