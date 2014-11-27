<h2>Categor&iacute;as</h2><p>

<?php echo $this->Html->link('Crear nueva categoria', array('controller' => 'categorias', 'action' => 'add')); ?>  || <?php echo $this->Html->link('Propiedades', array('controller' => 'propiedades', 'action' => 'index', '517eb611398dacb818000004')); ?>
  <?php   
  if(!empty($categorias)) {?></p><br />
<table width="95%">
<tr>
        <th width="940" align="left">Categoria</th>
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
