<div class="uk-width-medium-1-1" data-uk-grid-margin="">
    <h1 class="uk-heading-medium">
        Propiedades de <b><?php echo $ncategoria; ?></b>
    </h1>
</div>
<?php 
    foreach($categorias  as $categoria){
        if( !empty($categoria['propiedades']) ){
            $propiedades = $categoria['propiedades'];
        }
    }
?>
<div class="uk-width-medium-1-1" data-uk-grid-margin="">
    <div class="uk-button-group">
    <?php
    if($id == '517eb611398dacb818000004'){
        echo $this->Html->link('Regresar', 
                array(
                    'controller' => 'categorias', 
                    'action'     => 'index'
                ),
                array('class' => 'uk-button uk-button-default')
            );
    } else {
        echo $this->Html->link('Regresar', 
                array(
                    'controller' => 'categorias', 
                    'action' => 'view', 
                    $id
                ),
                array('class' => 'uk-button uk-button-danger')
            );
    }
    echo $this->Html->link('Crear nueva propiedad', 
            array(
                'controller' => 'propiedades', 
                'action' => 'add', 
                $id
            ),
            array('class' => 'uk-button uk-button-default')
        );
    ?>
    </div>
</div>
<div class="uk-width-medium-1-1" data-uk-grid-margin="">
<?php if(!empty($propiedades)):
        $procont = count($propiedades);
?>
    <table class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
        <caption>Propiedades</caption>
        <thead>
            <tr>
                <th class="uk-width-4-10 uk-text-left">Propiedad</th>
                <th class="uk-width-4-10 uk-text-center">Descripcion</th>
                <th class="uk-width-1-10 uk-text-center">Tipo</th>
                <th class="uk-width-1-10 uk-text-center">Borrar</th>
            </tr>
        </thead>
        <tbody>
        <?php for($i=0; $i<=$procont-1; $i++): ?>
            <tr>
                <td>
                    <?php echo $this->Html->link($propiedades[$i]['nombre'],
                            array(
                                'controller' => 'propiedades', 
                                'action'     => 'edit', 
                                $propiedades[$i]['id']
                            ),
                            array('class' => 'uk-button uk-button-link')
                        );
                    ?>
                </td>
                <td>
                    <?php echo $this->Html->link($propiedades[$i]['descripcion'],
                            array(
                                'controller' => 'propiedades', 
                                'action'     => 'edit', 
                                $propiedades[$i]['id']
                            ),
                            array('class' => 'uk-button uk-button-link')
                        );
                    ?>
                </td>		
                <td>
                    <?php echo $this->Html->link($propiedades[$i]['tipo'], 
                            array(
                                'controller' => 'propiedades', 
                                'action' => 'edit', 
                                $propiedades[$i]['id']
                            )
                        ); 
                    ?>
                </td>		                		
                <td class="uk-text-center">
                    <?php echo $this->Html->link('<i class="uk-icon uk-icon-trash uk-icon-medium uk-icon-hover"></i>', 
                            array(
                                'controller' => 'propiedades', 
                                'action' => 'delete', 
                                $propiedades[$i]['id']
                            ),
                            array('escape' => false),
                            "¿Está seguro de eliminar el registro?"
                        );
                    ?>
                </td>
            </tr>
        <?php endfor; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Aún no se han agregado ningun recurso, puede cargar uno 
    <?php echo $this->Html->link('AQUÍ', 
            array(
                'controller' => 'propiedades', 
                'action' => 'add'
            )
        );
    ?>
    </p>
<?php endif; ?>
</div>
