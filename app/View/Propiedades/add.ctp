<div class="uk-width-medium-1-1" data-uk-grid-margin="">
    <div class="uk-button-group">
    <?php echo $this->Html->link('Regresar al listado', 
            array(
                'controller' => 'propiedades', 
                'action'     => 'index',
                $cpadre
            ),
            array('class'    => 'uk-button uk-button-primary')
        ); 
    ?>
    </div>
</div>
<div class="uk-width-medium-1-1" data-uk-grid-margin="">
    <div class="uk-panel uk-panel-box uk-panel-box-primary">
        <?php 
	$opciones = array(
            'text'      => 'Texto',
            'textarea'  => 'Área de texto',
            'date'      => 'Fecha',
            'boolean'   => 'Booleano'
        );
        ?>
        <?php echo $this->Form->create('Propiedade',
                array(
                    'class' => 'uk-panel uk-panel-box uk-form'
                )
            ); 
        ?>
        <legend>Crear Propiedad</legend>
        <?php echo $this->Form->input('nombre',
            array(
                'div'           => 'uk-form-row',
                'class'         => 'uk-width-1-1 uk-form-large',
                'required'      => true,
                'autofocus'     => true,
                'placeholder'   => 'Nombre de la Propiedad',
                'label'         => 'Nombre de la Propiedad'
            )
        );
        ?>
        <?php echo $this->Form->input('descripcion',
            array(
                'type'          => 'textarea',
                'div'           => 'uk-form-row',
                'class'         => 'uk-width-1-1 uk-form-large',
                'required'      => true,
                'placeholder'   => 'Descripción de la Propiedad',
                'label'         => 'Descripción de la Propiedad'
            )
        );
        ?>
        <?php echo $this->Form->input('tipo', 
                array(
                    'type'      => 'select', 
                    'options'   => $opciones,
                    'div'       => 'uk-form-row',
                    'class'     => 'uk-width-1-1 uk-form-large',
                    'required'  => true,
                    'label'     => 'Tipo de Contenido'
                )
            );
        ?>
        <?php echo $this->Form->input('cpadre', 
                array(
                    'type' => 'hidden', 
                    'value' => $cpadre
                )
            );
        ?>
        <?php echo $this->Form->input('id', 
                array(
                    'type' => 'hidden', 
                    'value' => $cpadre.'-'.rand()
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