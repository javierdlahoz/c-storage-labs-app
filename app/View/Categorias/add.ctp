<div class="uk-width-medium-1-1" data-uk-grid-margin="">
    <div class="uk-button-group">
    <?php echo $this->Html->link('Regresar al listado', 
            array(
                'controller' => 'categorias', 
                'action'     => 'index'
            ),
            array('class'    => 'uk-button uk-button-primary')
        ); 
    ?>
    </div>
</div>

<div class="uk-width-medium-1-1" data-uk-grid-margin="">
    <div class="uk-panel uk-panel-box uk-panel-box-primary">
        <?php echo $this->Form->create('Categoria',
                array(
                    'class' => 'uk-panel uk-panel-box uk-form'
                )
            ); 
        ?>
        <legend>Crear Categoria</legend>
        <?php echo $this->Form->input('nombre',
            array(
                'div'           => 'uk-form-row',
                'class'         => 'uk-width-1-1 uk-form-large',
                'required'      => true,
                'autofocus'     => true,
                'placeholder'   => 'Nombre de la Categoría',
                'label'         => 'Nombre de la Categoría'
            )
        ); 
        ?>
        <?php echo $this->Form->input('descripcion',
            array(
                'type'          => 'textarea',
                'div'           => 'uk-form-row',
                'class'         => 'uk-width-1-1 uk-form-large',
                'required'      => true,
                'placeholder'   => 'Descripción de la Categoría',
                'label'         => 'Descripción de la Categoría'
            )
        );
        ?>
        <?php echo $this->Form->input('cpadre',
            array(
                'type'  => 'hidden',
                'value' => '517eb611398dacb818000004'
            )
        ); 
        ?>
        <div class="uk-form-row">
            <?php echo $this->Form->button('Crear', 
                array(
                    'type'  => 'submit',
                    'class' => 'uk-width-1-5 uk-button uk-button-primary'
                    )
                ); 
            ?>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
</div>