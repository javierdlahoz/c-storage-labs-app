<h2>Usuarios asignados a <?php echo $ncategoria; 
	foreach($categorias  as $categoria){
			if(!empty($categoria['usuarios']))
				$usuarios = $categoria['usuarios'];
		}
?></h2><p>

<?php 
if($id=='517eb611398dacb818000004')
	echo $this->Html->link('<< Regresar', array('controller' => 'categorias', 'action' => 'index'));
else	
	echo $this->Html->link('<< Regresar', array('controller' => 'categorias', 'action' => 'view', $id)); ?> || 
<?php echo $this->Html->link('Asignar un usuario', array('controller' => 'usuarios', 'action' => 'add', $id)); ?> 
  <?php   
  if(!empty($usuarios)) {
	  $procont = count($usuarios);
	  ?></p><br />
<table width="95%">
<tr>
        <th width="330" align="left">Usuario</th>
        <th align="center" width="47">Borrar</th>
    </tr>
    
    
    <?php 
	
		for($i=0; $i<=$procont-1; $i++) { ?>
    <tr>
    	<td><?php echo $usuarios[$i]['username']; ?></td>
		<td align="center" width="47">
        	<center>
        	<?php 
        	    	echo $this->Html->link('X', array('controller' => 'usuarios', 'action' => 'delete', $usuarios[$i]['id'])); ?>
        </center>
        </td>
    </tr>
    <?php }  ?>
</table>
<?php } else {?>
<p>Aun no se han asignado usuarios, puede asignar uno 
 <a href = 'usuarios/add'>aquí</a></p>
<?php } ?>