<div class="uk-width-medium-1-1" data-uk-grid-margin="">
    <h1 class="uk-heading-medium">
        <!-- <?php echo $this->Html->image('docs.png', 
                    array(
                        'height'=>'32', 
                        'width'=>'32'
                        )
                ); 
        ?>-->
        <i class="uk-icon uk-icon-upload"></i>
        Cargar Documento
    </h1>
</div>
<div class="uk-width-medium-1-1" data-uk-grid-margin="">
    <div class="uk-button-group">
        <?php echo $this->Html->link('Regresar a la lista', 
            array(
                'controller' => 'documentos', 
                'action'     => 'index', 
                $id_cat
            ),
            array('class' => 'uk-button uk-button-primary')
        ); 
        ?>
    </div>
</div>
<?php 
$opciones = array(
    'si' => 'si',
    'no' => 'no'
);
?>
<div class="uk-width-medium-1-1" data-uk-grid-margin="">
    <div class="uk-panel uk-panel-box uk-panel-box-primary">
        <?php echo $this->Form->create('Documento', 
                array(
                    'type' => 'file'
                    )
                ); 
        ?>
        <legend>Cargar Documento</legend>
        <?php
	if(!empty($propiedades)){
            foreach($propiedades as $propiedad){
                if($propiedad['tipo'] == 'boolean'){
                    echo $this->Form->input($propiedad['nombre'], 
                            array(
                                'type' => 'select',
                                'options' => $opciones,
                                'div'           => 'uk-form-row',
                                'class'         => 'uk-width-1-1',
                                'label'         => 'Nombre',
                                'placeholder'   => 'Correo eectrónico'
                            )
                    );
                } else {
                    echo $this->Form->input($propiedad['nombre'], 
                            array(
                                'type' => $propiedad['tipo'], 
                                'div'           => 'uk-form-row',
                                'class'         => 'uk-width-1-1',
                                'required'      => true,
                                'label'         => 'Nombre',
                                'placeholder'   => 'Correo eectrónico'
                            )
                    );
                }
            }
	}
        ?>
        <div class="uk-form-row file-wrapper" id='file-wrapper'>
            <div class="file_sign uk-block uk-block-default uk-block-mini" id='file_sign'>
                Arrastra un archivo o haz clic aquí
            </div>
            <input type="file" name="data[Documento][archivo]" id="DocumentoArchivo"
                   class="uk-width-1-1">
       	<?php //echo $this->Form->input('archivo', array('type' => 'file')); ?>
        </div>
        <div id="nombreArchivo" style="display:none"></div>
        <br/>
        <?php echo $this->Form->input('comentarios', 
                array(
                    'type' => 'textarea', 
                    'label' => 'Comentarios/Instrucciones',
                    'div'           => 'uk-form-row',
                    'class'         => 'uk-width-1-1',
                    'required'      => true,
                    'placeholder'   => 'Comentarios'
                )
        );   
        echo $this->Form->input('id_categoria', 
                array(
                    'type'  => 'hidden', 
                    'value' => $id_cat,
                    'div'   => 'uk-form-row',
                    'class' => 'uk-width-1-1',
                    'label' => false,
                )
        );
        //echo $this->Form->input('id', array('type' => 'hidden', 'value' => $id_cat));       
    	?>
        <br/>
        <legend><h4>Usuarios con permisos sobre este archivo</h4></legend>
        <?php foreach($usuarios as $usuario){ 
            echo $this->Form->input($usuario['username'], 
                    array(
                        'type'  => 'checkbox', 
                        'label' => utf8_encode($usuario['nombre']),
                        'div'   => 'uk-form-row',
                        'class' => 'check',
                    )
            );
        } ?>
        <div class="uk-form-row">
            <?php echo $this->Form->button('Subir Archivo', 
                array(
                    'type'  => 'submit',
                    'class' => 'uk-button uk-button-primary'
                    )
                );
            ?>
            <?php echo $this->Form->end();  ?> 
        </div>
    
    </div>
</div>