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
                    'class'  => 'uk-panel uk-panel-box uk-form'
                )
            ); 
        ?>
        <legend>Modificar Usuario</legend>
        
        <?php echo $this->Form->input('nombre',
            array(
                'div'           => 'uk-form-row',
                'class'         => 'uk-width-1-1 uk-form-large',
                'required'      => true,
                'autofocus'     => true,
                'placeholder'   => 'Nombre de Pila',
                'label'         => 'Nombre completo y apellidos'
            )
        ); ?>
        <?php echo $this->Form->input('email',
            array(
                'div'           => 'uk-form-row',
                'class'         => 'uk-width-1-1 uk-form-large',
                'required'      => true,
                'label'         => 'Email',
                'placeholder'   => 'Correo eectrónico',
            )
        ); ?>
        <?php echo $this->Form->input('organizacion',
            array(
                'div'           => 'uk-form-row',
                'class'         => 'uk-width-1-1 uk-form-large',
                'required'      => false,
                'label'         => 'Organización',
                'placeholder'   => 'Nombre de la Organización',
            )
        ); ?>
        <?php echo $this->Form->input('imagen',
            array(
                'type'          => 'file',
                'div'           => 'uk-form-row',
                'class'         => 'uk-width-1-1 uk-form-large',
                'required'      => false,
                'label'         => 'Imagen de Avatar',
                'placeholder'   => 'Imagen que lo identifique',
            )
        ); ?>
        <?php echo $this->Form->input('id',
            array(
                'type'          => 'hidden',
                'div'           => 'uk-form-row',
                'class'         => 'uk-width-1-1 uk-form-large'
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
                    'class' => 'uk-width-1-5 uk-button uk-button-primary'
                    )
                ); 
            ?>
        </div>
        <div class="uk-form-row">
            <?php echo $this->Html->link("Cambiar Contraseña", 
                    array(
                        'controller' => 'users', 
                        'action' => 'cambioc', 
                        $this->Session->read('Auth.User.id')
                    ),
                    array('class' => 'uk-button uk-button-link')
                ); 
            ?>
        </div>
        <?php echo $this->Form->end();  ?>  
    </div>
</div>