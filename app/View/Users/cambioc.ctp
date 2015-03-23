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
                    //'action' => 'cambioc',
                    'class'  => 'uk-panel uk-panel-box uk-form'
                )
            ); 
        ?>
        <legend>
            Cambio de Contrase&ntilde;a
            <blockquote>
                <b>
                    <?php echo $this->Session->read('Auth.User.nombre'); ?></b>
                    [ <?php echo $this->Session->read('Auth.User.username'); ?> ]
                
            </blockquote>
        </legend>
        
        <?php echo $this->Form->input('password',
            array(
                'div'           => 'uk-form-row',
                'class'         => 'uk-width-1-1 uk-form-large',
                'required'      => true,
                'autofocus'     => true,
                'label'         => 'Contraseña',
                'placeholder'   => 'Escriba su nueva Contraseña',
                
            )
        ); ?>
        
        <?php echo $this->Form->input('confirmar_password',
            array(
                'type'          => 'password',
                'div'           => 'uk-form-row',
                'class'         => 'uk-width-1-1 uk-form-large',
                'required'      => true,
                'label'         => 'Repetir Contraseña',
                'placeholder'   => 'Escribe la Contraseña, otra vez.',
            )
        ); ?>
        
        <?php echo $this->Form->input('id',
            array(
                'type'  => 'hidden',
                'div'   => 'uk-form-row',
                'value' => $this->Session->read('Auth.User.id'),
                'class' => 'uk-width-1-1 uk-form-large'
            )
        ); ?>
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
    </div>
</div>