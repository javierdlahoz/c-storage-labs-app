<?php
$event = $this->Js->get('#useropt')->effect('fadeIn');
$this->Js->get('#usermod')->event('click', $event);

/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
    <title>
		<?php echo 'Gestión documental' ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
<style type="text/css">
#container #header table tr td {
	text-align: right;
}
body table tr {
	text-align: right;
}
</style>
</head>
<body>
	<table width="101%" border="0" cellpadding="0" cellspacing="0">
			  <tr>
			   <td width="17" align="left" bgcolor="#FFFFFF"><?php echo $this->Html->link('Inicio', '../'); ?>
		        <?php $temp = $this->Session->read('user');
    			if(!empty($temp)){ ?>
		         | <?php 
			 	echo $this->Html->link('Configuración de correo', array('controller' => 'configuracions', 'action' =>'mail')); ?> | <?php 
			 	echo $this->Html->link('Cerrar sesión', array('controller' => 'categorias', 'action' =>'logout')); } ?></td>
			    <?php $imagen = $this->Session->read('Auth.User.imagen'); 
                if(!empty($imagen)) { ?>
			    <?php } ?>
      </tr>
</table><hr>
		<div id="content">
		  <table width="100%" border="0" cellpadding="6" cellspacing="0" height="95%">
		    <tr>
		      <td width="112"><h3>Menú</h3>
		       <br />
               <nav id="vmenu" class="slideRight">
                	<ul><li>
		            <?php echo $this->Html->link('Categorías', array('controller' => 'categorias', 'action' => 'index')); ?></li>
                    <li>
                    <?php echo $this->Html->link('Documentos', array('controller' => 'documentos', 'action' => 'index')); ?>
                    </li>
                	</ul>
           		</nav>
	             	</td>
	            <td width="2" style="border-left:solid; border-left-color:#ddd; border-left-width:thin">&nbsp;</td>
		      <td width="948" height="90%" align="left"><?php echo $this->Session->flash(); ?> <?php echo $this->fetch('content'); ?></td>
	        </tr>
	      </table>
</div>
		<div id="footer" style="font-size:10px; font-style:normal">
        			<?php echo $this->Html->link('Hecho en la UIS', 'http://uis.edu.co', array('target' => '_new')); ?>
		</div>
	<?php echo $this->element('sql_dump'); ?>
	<?php echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');?> 
	<?php echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js');?>
	<?php echo $this->Html->script('application.js');?>
</body>
</html>