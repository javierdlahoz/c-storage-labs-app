<div class="uk-width-medium-1-1" data-uk-grid-margin="">
    <h1 class="uk-heading-medium">
        Modificando Categoría
    </h1>
</div>

<div class="uk-width-medium-1-1" data-uk-grid-margin="">
<?php if($cpadre == '517eb611398dacb818000004'): ?>
    <div class="uk-button-group">
    <?php 
        echo $this->Html->link('Regresar al listado', 
            array(
                'controller' => 'categorias', 
                'action'     => 'index'
            ),
            array('class'    => 'uk-button uk-button-primary')
        ); 
    ?>
    </div>
<?php else: ?>
    <div class="uk-button-group">
    <?php
        echo $this->Html->link('Regresar', 
                array(
                    'controller' => 'categorias', 
                    'action'     => 'view', 
                    $cpadre
                ),
                array('class'    => 'uk-button uk-button-danger')
        );
    ?>
    </div>
<?php endif; ?>
</div>
<div class="uk-width-medium-1-1" data-uk-grid-margin="">
    <div class="uk-panel uk-panel-box uk-panel-box-primary">
        <?php echo $this->Form->create('Categoria',
                array(
                    $id_cat,
                    'class'  => 'uk-form uk-form-stacked'
                )
            ); 
        ?>
        <?php
        foreach($categorias as $categoria){
            $nombre = $categoria['nombre'];
            $descripcion = $categoria['descripcion'];
        }
        ?>
        <?php echo $this->Form->input('nombre',
            array(
                'div' => array(
                    'class' => 'uk-form-row'
                ),
                'label' => array(
                    'text'  => 'Nombre de la Categoría',
                    'class' => 'uk-form-label'
                ),
                'between'   => '<div class="uk-form-controls">',
                'after'     => '</div>',
                'class'         => 'uk-width-1-1',
                'required'      => true,
                'autofocus'     => true,
                'placeholder'   => 'Nombre de la Categoría',
                'value'         => $nombre
            )
        ); ?>
        <?php echo $this->Form->input('nombre',
            array(
                'type'  => 'textarea',
                'div'   => array(
                    'class' => 'uk-form-row'
                ),
                'label' => array(
                    'text'  => 'Descripción de la Categoría',
                    'class' => 'uk-form-label'
                ),
                'between'   => '<div class="uk-form-controls">',
                'after'     => '</div>',
                'class'         => 'uk-width-1-1',
                'required'      => true,
                'placeholder'   => 'Descripción de la Categoría',
                'value'         => $descripcion
            )
        ); ?>
        <?php echo $this->Form->input('cpadre',
            array(
                'type'  => 'hidden',
                'value' => $cpadre
            )
        ); 
        ?>
        <br/>
        <div class="uk-form-row">
            <?php echo $this->Form->button('Modificar', 
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