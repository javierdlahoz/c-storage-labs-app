<h2>Propiedades de <?php echo $ncategoria; 
	foreach($categorias  as $categoria){
			if(!empty($categoria['propiedades']))
				$propiedades = $categoria['propiedades'];
		}
?></h2><p>

<?php 
if($id=='517eb611398dacb818000004')
	echo $this->Html->link('<< Regresar', array('controller' => 'categorias', 'action' => 'index'));
else	
	echo $this->Html->link('<< Regresar', array('controller' => 'categorias', 'action' => 'view', $id)); ?> || 
<?php echo $this->Html->link('Crear nueva propiedad', array('controller' => 'propiedades', 'action' => 'add', $id)); ?> 
  <?php   
  if(!empty($propiedades)) {
	  $procont = count($propiedades);
	  ?></p><br />
<table width="95%">
<tr>
        <th width="330" align="left">Propiedad</th>
        <th width="577" align="left">Descripcion</th>
        <th width="68" align="left">Tipo</th>
        <th align="center" width="47">Borrar</th>
    </tr>
    
    
    <?php 
	
		for($i=0; $i<=$procont-1; $i++) { ?>
    <tr>
    	<td><?php echo $this->Html->link($propiedades[$i]['nombre'], 
    			array('controller' => 'propiedades', 'action' => 'edit', $propiedades[$i]['id'])) ; ?></td>
		<td><?php echo $this->Html->link($propiedades[$i]['descripcion'], 
    			array('controller' => 'propiedades', 'action' => 'edit', $propiedades[$i]['id'])) ; ?></td>		
		<td><?php echo $this->Html->link($propiedades[$i]['tipo'], 
    			array('controller' => 'propiedades', 'action' => 'edit', $propiedades[$i]['id'])) ; ?></td>		                		
        <td align="center" width="47">
        	<center>
        	<?php 
        	    	echo $this->Html->link('x', array('controller' => 'propiedades', 'action' => 'delete', $propiedades[$i]['id'])); ?>
        </center>
        </td>
    </tr>
    <?php }  ?>
</table>
<?php } else {?>
<p>Aun no se han agregado ningun recurso, puede cargar uno 
 <a href = 'propiedades/add'>aquí</a></p>
<?php } ?>
