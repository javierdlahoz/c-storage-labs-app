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
<?php 
    $idprop = $cpadre;
    $temp = explode('-', $cpadre);
    $cpadre = $temp[0];

    $opciones = array(
        'text'      => 'Texto',
        'textarea'  => 'Área de texto',
        'date'      => 'Fecha',
        'boolean'   => 'Booleano'
    );

    foreach($categorias as $categoria){
        $propiedades = $categoria['propiedades'];	
    }

    for($i=0; $i<=count($propiedades)-1; $i++){
        if($propiedades[$i]['id'] == $idprop){
            $nombre = $propiedades[$i]['nombre'];
            $descripcion = $propiedades[$i]['descripcion'];
            $tipo = $propiedades[$i]['tipo'];
            $cont = $i;
        }	
    }	
?>
<div class="uk-width-medium-1-1" data-uk-grid-margin="">
    <div class="uk-panel uk-panel-box uk-panel-box-primary">
        <?php echo $this->Form->create('Propiedade',
                array(
                    'class' => 'uk-panel uk-panel-box uk-form'
                )
            ); 
        ?>
        <legend>Editar Propiedad</legend>
        <?php echo $this->Form->input('nombre',
            array(
                'div'           => 'uk-form-row',
                'class'         => 'uk-width-1-1 uk-form-large',
                'required'      => true,
                'autofocus'     => true,
                'placeholder'   => 'Nombre de la Propiedad',
                'label'         => 'Nombre de la Propiedad',
                'value'         => $nombre
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
                'label'         => 'Descripción de la Propiedad',
                'value'         => $descripcion
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
                    'label'     => 'Tipo de Contenido',
                    'default'   => $tipo
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
        <?php echo $this->Form->input('cont', 
                array(
                    'type' => 'hidden', 
                    'value' => $cont
                )
            );
        ?>
        <div class="uk-form-row">
            <?php echo $this->Form->button('Editar', 
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