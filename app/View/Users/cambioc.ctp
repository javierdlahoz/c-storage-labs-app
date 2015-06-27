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
                    'class'  => 'uk-form uk-form-stocked'
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
                'div' => array(
                    'class' => 'uk-form-row'
                ),
                'label' => array(
                    'text'  => 'Contraseña',
                    'class' => 'uk-form-label'
                ),
                'between'       => '<div class="uk-form-controls">',
                'after'         => '</div>',
                'class'         => 'uk-width-1-1',
                'required'      => true,
                'autofocus'     => true,
                'placeholder'   => 'Escriba su nueva Contraseña',
                
            )
        ); ?>
        
        <?php echo $this->Form->input('confirmar_password',
            array(
                'type'          => 'password',
                'div' => array(
                    'class' => 'uk-form-row'
                ),
                'label' => array(
                    'text'  => 'Repetir Contraseña',
                    'class' => 'uk-form-label'
                ),
                'between'       => '<div class="uk-form-controls">',
                'after'         => '</div>',
                'class'         => 'uk-width-1-1',
                'required'      => true,
                'placeholder'   => 'Escribe la Contraseña, otra vez.',
            )
        ); ?>
        
        <?php echo $this->Form->input('id',
            array(
                'type'  => 'hidden',
                'div'   => 'uk-form-row',
                'value' => $this->Session->read('Auth.User.id'),
                'class' => 'uk-width-1-1'
            )
        ); ?>
        <hr/>
        <div class="uk-form-row">
            <?php echo $this->Form->button('Modificar', 
                array(
                    'type'  => 'submit',
                    'class' => 'uk-button uk-button-primary'
                    )
                ); 
            ?>
        </div>
    </div>
</div>