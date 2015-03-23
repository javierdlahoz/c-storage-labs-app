<?php if($this->Session->read('Auth.User.role') == 'admin'): ?>
    <div class="uk-width-medium-1-1" data-uk-grid-margin="">
        <div class="uk-button-group">
        <?php echo $this->Html->link('Regresar al listado', 
                array(
                    'controller' => 'users', 
                    'action' => 'index'
                ),
                array('class'    => 'uk-button uk-button-primary')
            ); 
        ?>
        </div>
    </div>
<?php endif; ?>

<div class="uk-width-medium-1-1" data-uk-grid-margin="">
    <div class="uk-panel uk-panel-box uk-panel-box-primary">
        <?php echo $this->Form->create('User',
                array(
                    'class' => 'uk-panel uk-panel-box uk-form'
                )
            ); 
        ?>
        <legend>Crear Usuario</legend>
        
        <?php echo $this->Form->input('username',
            array(
                'div'           => 'uk-form-row',
                'class'         => 'uk-width-1-1 uk-form-large',
                'required'      => true,
                'autofocus'     => true,
                'placeholder'   => 'Nombre de Usuario o Login',
                'label'         => 'Nombre de Usuario o Login'
            )
        ); ?>
        <?php echo $this->Form->input('password',
            array(
                'div'           => 'uk-form-row',
                'class'         => 'uk-width-1-1 uk-form-large',
                'required'      => true,
                'label'         => 'Contraseña',
                'placeholder'   => 'Contraseña',
                
            )
        ); ?>
        <?php echo $this->Form->input('Confirmar_password',
            array(
                'type'          => 'password',
                'div'           => 'uk-form-row',
                'class'         => 'uk-width-1-1 uk-form-large',
                'required'      => true,
                'label'         => 'Repetir Contraseña',
                'placeholder'   => 'Escribe la Contraseña nuevamente',
            )
        ); ?>
        <?php echo $this->Form->input('nombre',
            array(
                'div'           => 'uk-form-row',
                'class'         => 'uk-width-1-1 uk-form-large',
                'required'      => true,
                'label'         => 'Nombre de Usuario',
                'placeholder'   => 'Nombre de Pila del Usuario',
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
        <?php echo $this->Form->input('role',
            array(
                'type'          => 'hidden',
                'value'         => 'author',
                'div'           => 'uk-form-row',
                'class'         => 'uk-width-1-1 uk-form-large',
                'required'      => false,
                'label'         => false,
                'placeholder'   => 'Autor',
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
        <div class="uk-form-row">
            <?php echo $this->Form->button('Crear', 
                array(
                    'type'  => 'submit',
                    'class' => 'uk-width-1-5 uk-button uk-button-primary'
                    )
                ); 
            ?>
        </div>
        <?php echo $this->Form->end();  ?>
    </div>
</div>