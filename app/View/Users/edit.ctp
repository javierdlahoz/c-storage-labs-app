<?php if($this->Session->read('Auth.User.role') == 'admin'): ?>
    <div class="uk-width-medium-1-1" data-uk-grid-margin="">
        <div class="uk-button-group">
        <?php echo $this->Html->link('Regresar', 
                array(
                    'controller' => 'users', 
                    'action' => 'index'
                ),
                array('class' => 'uk-button uk-button-primary')
            ); 
        ?>
        </div>
    </div>
<?php endif; ?>

<div class="uk-width-medium-1-1" data-uk-grid-margin="">
    <div class="uk-panel uk-panel-box uk-panel-box-primary">
        <?php echo $this->Form->create('User',
                array(
                    'action' => 'edit', 
                    'type'   => 'file',
                    'class'  => 'uk-form uk-form-stacked'
                )
            ); 
        ?>
        <legend>Modificar Usuario</legend>
        
        <?php echo $this->Form->input('nombre',
            array(
                'div'   => array(
                    'class' => 'uk-form-row'
                ),
                'label' => array(
                    'text'  => 'Nombre y apellidos completos',
                    'class' => 'uk-form-label'
                ),
                'between'   => '<div class="uk-form-controls">',
                'after'     => '</div>',
                'class'         => 'uk-width-1-1',
                'required'      => true,
                'autofocus'     => true,
                'placeholder'   => 'Nombre de Pila'
            )
        ); ?>
        <?php echo $this->Form->input('email',
            array(
                'div' => array(
                    'class' => 'uk-form-row'
                ),
                'label' => array(
                    'text' => 'Correo eectrónico',
                    'class' => 'uk-form-label'
                ),
                'between' => '<div class="uk-form-controls">',
                'after' => '</div>',
                'class'         => 'uk-width-1-1',
                'required'      => true,
            )
        ); ?>
        <?php echo $this->Form->input('organizacion',
            array(
                'div' => array(
                    'class' => 'uk-form-row'
                ),
                'label' => array(
                    'text' => 'Organización',
                    'class' => 'uk-form-label'
                ),
                'between' => '<div class="uk-form-controls">',
                'after' => '</div>',
                'class'         => 'uk-width-1-1',
                'required'      => false,
                'placeholder'   => 'Nombre de la Organización',
            )
        ); ?>
        <?php echo $this->Form->input('imagen',
            array(
                'type'          => 'file',
                'div' => array(
                    'class' => 'uk-form-row'
                ),
                'label' => array(
                    'text' => 'Imagen de Avatar',
                    'class' => 'uk-form-label'
                ),
                'between' => '<div class="uk-form-controls">',
                'after' => '</div>',
                'class'         => 'uk-width-1-1',
                'required'      => false,
                'placeholder'   => 'Imagen que lo identifique',
            )
        ); ?>
        <?php echo $this->Form->input('id',
            array(
                'type'          => 'hidden',
                'div' => array(
                    'class' => 'uk-form-row'
                ),
                'label' => false,
                'between' => '<div class="uk-form-controls">',
                'after' => '</div>',
                'class'         => 'uk-width-1-1',
            )
        ); ?>
        <hr/>
        <!-- LAS IMAGENES -->
        <?php 
        foreach($usuarios as $usuario){
            if(isset($usuario['imagen'])){
                $imagen = $usuario['imagen'];    
            }
            $nombre = $usuario['nombre'];
        }
        if(isset($usuario['imagen'])){
            echo $this->Html->image('/files/usrpic/'.$imagen, 
                    array(
                        'width' => '256', 
                        'title' =>  $nombre
                    )
                );
        }
        ?>
        <!-- END LAS IMAGENES -->
        <hr/>
        <div class="uk-form-row">
            <?php echo $this->Form->button('Modificar', 
                array(
                    'type'  => 'submit',
                    'class' => 'uk-button uk-button-primary'
                    )
                ); 
            ?>
            <?php echo $this->Html->link("Cambiar Contraseña", 
                    array(
                        'controller' => 'users', 
                        'action' => 'cambioc', 
                        $this->Session->read('Auth.User.id')
                    ),
                    array('class' => 'uk-button uk-button-danger')
                ); 
            ?>
        </div>
        <?php echo $this->Form->end();  ?>  
    </div>
</div>