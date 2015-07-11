<div class="uk-width-medium-1-1" data-uk-grid-margin="">
    <div class="uk-button-group">
    <?php echo $this->Html->link('Regresar', 
            array(
                'controller' => 'users', 
                'action' => 'index',
                $cpadre
            ),
            array('class' => 'uk-button uk-button-primary')
        ); 
    ?>
    </div>
</div>
<div class="uk-width-medium-1-1" data-uk-grid-margin="">
    <div class="uk-panel uk-panel-box uk-panel-box-primary">
        <?php echo $this->Form->create('Usuario',
                array(
                    'class' => 'uk-form uk-form-stacked'
                )
            ); 
        ?>
        <legend>Asignar Usuario</legend>
        <?php echo $this->Form->input('usuario', 
                array(
                    'type' => 'select', 
                    'options' => $usuarios,
                    'div'   => array(
                        'class' => 'uk-form-row'
                    ),
                    'label' => array(
                        'text'  => 'Nombre de Usuario',
                        'class' => 'uk-form-label'
                    ),
                    'between'   => '<div class="uk-form-controls">',
                    'after'     => '</div>',
                    'class'     => 'uk-width-1-1',
                )
            ); 
        ?>
        <?php echo $this->Form->input('cpadre', 
                array(
                    'type' => 'hidden', 
                    'value' => $cpadre,
                    'div' => array(
                        'class' => 'uk-form-row'
                    ),
                    'label' => array(
                        'text'  => 'Id Padre',
                        'class' => 'uk-form-label'
                    ),
                    'between'   => '<div class="uk-form-controls">',
                    'after'     => '</div>',
                    'class'     => 'uk-width-1-1',
                )
            );
        ?>
        <?php echo $this->Form->input('id', 
                array(
                    'type' => 'hidden', 
                    'value' => $cpadre . '-' . rand(),
                    'div' => array(
                        'class' => 'uk-form-row'
                    ),
                    'label' => array(
                        'text'  => 'Id Padre',
                        'class' => 'uk-form-label'
                    ),
                    'between'   => '<div class="uk-form-controls">',
                    'after'     => '</div>',
                    'class'     => 'uk-width-1-1',
                )
            );
        ?>
        <br/>
        <div class="uk-form-row">
            <?php echo $this->Form->button('Asignar', 
                array(
                    'type'  => 'submit',
                    'class' => 'uk-button uk-button-primary'
                    )
                ); 
            ?>
        </div>
        <?php echo $this->Form->end();  ?>
    </div>
</div>
