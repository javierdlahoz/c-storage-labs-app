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
<!DOCTYPE html>
<html lang="es">
    <head>
	<?php echo $this->Html->charset(); ?>
        <title><?php echo 'Gestión documental' ?> | <?php echo $title_for_layout; ?></title>
	<?php
        echo $this->Html->meta('icon');
        echo $this->Html->css('uikit.gradient.min.css');
        //echo $this->Html->css('https://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css');

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
	?>
    </head>
    <body>
        <div class="uk-container uk-container-center uk-margin-top uk-margin-large-bottom">
            <?php 
            $temp = $this->Session->read('user');
            if($temp !== null):
            ?>
            <nav class="uk-navbar uk-margin-large-bottom">
                <a class="uk-navbar-brand uk-hidden-small">Laboratorios UIS</a>
                <ul class="uk-navbar-nav uk-hidden-small">
                    <li>
                    <?php 
                        echo $this->Html->link('CATEGORÍAS', 
                            array(
                                'controller' => 'categorias', 
                                'action'     => 'index'
                            )
                        ); 
                    ?>
                    </li>
                    <li>
                        <?php 
                        echo $this->Html->link('DOCUMENTOS', 
                            array(
                                'controller' => 'documentos', 
                                'action' => 'index'
                            )
                        ); 
                        ?>
                    </li>
                    <li data-uk-dropdown="" class="uk-parent">
                        <a href=""><i class="uk-icon-user"></i>
                            <?php echo $this->Session->read('Auth.User.nombre'); ?>
                            <i class="uk-icon-caret-down"></i>
                        </a>
                        <div class="uk-dropdown uk-dropdown-navbar" style="">
                            <ul class="uk-nav uk-nav-navbar">
                                <li>
                                <?php echo $this->Html->link('Editar perfil', 
                                    array(
                                        'controller' => 'users', 
                                        'action' =>'edit'
                                    )
                                );
                                ?>
                                </li>
                                <li>
                                <?php echo $this->Html->link('Configuración de correo', 
                                    array(
                                        'controller' => 'configuraciones', 
                                        'action'     => 'mail'
                                    )
                                ); 
                                ?>
                                </li>
                                <li class="uk-nav-divider"></li>
                                <li>
                                <?php echo $this->Html->link('Cerrar sesión', 
                                    array(
                                        'controller' => 'users', 
                                        'action'     => 'logout'
                                    )
                                );
                                ?>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
                <a class="uk-navbar-toggle uk-visible-small" data-uk-offcanvas="" href="#offcanvas"></a>
                <div class="uk-navbar-brand uk-navbar-center uk-visible-small">Labs</div>
            </nav>
            <?php endif; ?>
            <?php $errorMessage = $this->Session->flash(); ?>
            <?php if ($errorMessage): ?>
            <div class="uk-width-medium-1-1" data-uk-grid-margin="">
                <div class="uk-alert uk-alert-danger">
                    <h3>
                    <?php 
                        echo $errorMessage; 
                    ?>
                    </h3>
                </div>
            </div>
            <?php endif; ?>
            <div class="uk-grid uk-grid-small" data-uk-grid-margin="">
                <?php echo $this->fetch('content'); ?>
            </div>
        </div>
        <hr class="uk-grid-divider">
        <div data-uk-grid-margin="" class="uk-grid">
            <div class="uk-width-medium-1-1">
                <div class="uk-panel uk-panel-box uk-text-center">
                    <p><?php echo $this->Html->link('Hecho en la UIS', 'http://uis.edu.co', 
                            array(
                                'class' => 'uk-button uk-button-primary uk-margin-left', 
                                'target' => '_new'
                                )
                            ); ?></p>
                </div>
            </div>
        </div>
        <div class="uk-offcanvas" id="offcanvas">
            <div class="uk-offcanvas-bar">
                <ul class="uk-nav uk-nav-offcanvas">
                    <li class="uk-active">
                        <a href="/">Inicio</a>
                    </li>
                    <li>
                    <?php 
                        echo $this->Html->link('CATEGORÍAS', 
                            array(
                                'controller' => 'categorias', 
                                'action'     => 'index'
                            )
                        ); 
                    ?>
                    </li>
                    <li>
                        <?php 
                        echo $this->Html->link('DOCUMENTOS', 
                            array(
                                'controller' => 'documentos', 
                                'action' => 'index'
                            )
                        ); 
                        ?>
                    </li>
                    <?php 
                    $temp = $this->Session->read('user');
                    if( !empty($temp) ):
                    ?>
                    <li>
                    <?php 
                    echo $this->Html->link('Editar perfil', 
                        array(
                            'controller' => 'users', 
                            'action' =>'edit'
                        )
                    );
                    ?>
                    </li>
                    <li>
                    <?php 
                    echo $this->Html->link('Configuración de correo', 
                        array(
                            'controller' => 'configuraciones', 
                            'action' =>'mail'
                        )
                    ); 
                    ?>
                    </li>
                    <li class="uk-nav-divider"></li>
                    <li>
                    <?php 
                    echo $this->Html->link('Cerrar sesión', 
                        array(
                            'controller' => 'categorias', 
                            'action' =>'logout'
                        )
                    );
                    ?>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <?php echo $this->Html->script('jquery-1.11.2.min'); ?>
	<?php //echo $this->Html->script('https://code.jquery.com/ui/1.11.2/jquery-ui.min.js');?>
        <?php echo $this->Html->script('uikit.min'); ?>
    </body>
</html>