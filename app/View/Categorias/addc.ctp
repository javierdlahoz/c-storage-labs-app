<div class="uk-width-medium-1-1" data-uk-grid-margin="">
    <div class="uk-button-group">
    <?php 
    if(isset($cpadre)): 
        echo $this->Html->link('Regresar a la lista', 
                array(
                    'controller' => 'categorias', 
                    'action'     => 'view',
                    $cpadre
                ),
                array('class'    => 'uk-button uk-button-danger')
            );
    else:
        echo $this->Html->link('Regresar a la lista', 
                array(
                    'controller' => 'categorias', 
                    'action' => 'index'
                ),
                array('class'    => 'uk-button uk-button-primary')
            );
    endif;
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
                'value' => $cpadre
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