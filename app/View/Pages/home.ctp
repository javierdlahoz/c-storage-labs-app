<?php
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
 * @package       Cake.View.Pages
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
if (Configure::read('debug') == 0):
	throw new NotFoundException();
endif;
App::uses('Debugger', 'Utility');
//echo $this->Html->charset('UTF-8');
?>
<h2>Bienvenid@ <?php if(!empty($usuario)) echo $usuario; ?></h2>
<p><?php echo utf8_encode("Aquí puedes manejar los documentos referentes a la gestión de calidad en tu organización"); ?></p>
<?php if(empty($usuario)) {?>
<form id="form1" name="form1" method="post" action="categorias/validar">
  <table width="500" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="73">Usuario:</td>
      <td width="427"><label for="user"></label>
      <input type="text" name="user" id="user" /></td>
    </tr>
    <tr>
      <td>Contrase&ntilde;a:</td>
      <td><input type="password" name="password" id="password" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="button" id="button" value="Ingresar" /></td>
    </tr>
  </table>
</form>
<?php } ?>
<p></p>