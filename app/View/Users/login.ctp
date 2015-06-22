<div class="uk-width-medium-1-1">
    <div class="uk-grid uk-grid-small">
        <div class="uk-width-medium-1-3">
            
        </div>
        <div class="uk-width-medium-1-3">
            <div class="uk-panel uk-panel-box uk-panel-box-primary">
                <?php echo $this->Form->create('User', 
                        array(
                            'inputDefaults' => array(
                                'label' => false,
                                'div'   => false,
                                'error' => array(
                                    'wrap'  => 'span',
                                    'class' => 'my-error-class'
                                )
                            ),
                            'class' => 'uk-panel uk-panel-box uk-form'
                        )
                    ); 
                ?>
                
                <legend><?php echo __('Inicio de Sesón'); ?></legend>
                
                <?php echo $this->Form->input('username',
                    array(
                        'div'           => 'uk-form-row',
                        'class'         => 'uk-width-1-1 uk-form-large',
                        'required'      => true,
                        'autofocus'     => true,
                        'placeholder'   => 'Nombre de Usuario',
                        'label'         => false
                    )
                ); ?>
                <?php echo $this->Form->input('password',
                    array(
                        'div'           => 'uk-form-row',
                        'required'      => true,
                        'class'         => 'uk-width-1-1 uk-form-large',
                        'placeholder'   => 'Contraseña',
                        'label' => false
                    )
                ); ?>
                <div class="uk-form-row">
                    <?php echo $this->Form->button('Ingresar', 
                        array(
                            'type'  => 'submit',
                            'class' => 'uk-width-1-1 uk-button uk-button-primary uk-button-large'
                            )
                        ); ?>
                </div>
                <?php echo $this->Form->end(); ?>
                <div class="uk-form-row uk-text-small">
                    <div class="uk-float-left">
                        <?php echo $this->Html->link('Registrarme', 
                            array('controller'=>'users', 'action'=>'add')); ?>
                    </div>
                    <div class="uk-float-right">
                        <button type="button"
                           onClick='<?php echo $this->Js->get("#contrasena")->effect("fadeIn"); ?>'
                           class="uk-button-link uk-button-mini">
                            Olvidé mi Contraseña
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="uk-width-medium-1-3" id="celdatest">
            <div class="uk-panel uk-panel-box uk-panel-box-primary" id="contrasena" style="display:none">
                <?php echo $this->Form->create('User', 
                        array(
                            'action' => 'restaurar',
                            'class' => 'uk-panel uk-panel-box uk-form'
                            )
                        ); 
                ?>
                
                <legend><?php echo __('Ingrese su nombre de usuario'); ?></legend>
                
                <?php echo $this->Form->input('username',
                        array(
                            'div'           => 'uk-form-row',
                            'class'         => 'uk-width-1-1 uk-form-large',
                            'required'      => true,
                            'autofocus'     => true,
                            'placeholder'   => 'Nombre de Usuario',
                            'label'         => false
                        )
                    ); 
                ?>
                <div class="uk-form-row">
                    <?php echo $this->Form->button('Restaurar', 
                        array(
                            'type'  => 'submit',
                            'class' => 'uk-width-1-1 uk-button uk-button-danger uk-button-large'
                            )
                        ); ?>
                </div>
                <?php echo $this->Form->end(); ?>
                <button type="button" 
                        onClick='<?php echo $this->Js->get("#contrasena")->effect("fadeOut"); ?>' 
                        class="uk-button-link uk-button-mini">
                    Ocultar
                </button>
            </div>
        </div>
    </div>
</div>
<?php $event = $this->Js->get('#contrasena')->effect('fadeIn');
$this->Js->get('#celdatest')->event('click', $event); ?>