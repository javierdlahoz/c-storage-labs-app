<div class="uk-width-medium-1-1" data-uk-grid-margin="">
    <h1 class="uk-heading-medium">
        <?php echo $nombre; ?>
    </h1>
</div>
<div class="uk-width-medium-1-1" data-uk-grid-margin="">
    <div class="uk-button-group">
        <?php 
        if($canterior == '517eb611398dacb818000004'):
            echo $this->Html->link('Regresar', 
                    array(
                        'controller' => 'categorias', 
                        'action'     => 'index'
                    ),
                    array('class'    => 'uk-button uk-button-primary')
                );
        else:
            echo $this->Html->link('Regresar', 
                    array(
                        'controller' => 'categorias', 
                        'action' => 'view', 
                        $canterior
                    ),
                    array('class'    => 'uk-button uk-button-danger')
                );
        endif; 
        ?>
        <?php echo $this->Html->link('Propiedades', 
                array(
                    'controller' => 'propiedades', 
                    'action'     => 'index', 
                    $id
                ),
                array('class'    => 'uk-button')
            ); 
        ?>
        <?php echo $this->Html->link('Usuarios', 
                array(
                    'controller' => 'usuarios', 
                    'action'     => 'index', 
                    $id
                ),
                array('class'    => 'uk-button')
            ); 
        ?>
        <?php echo $this->Html->link('Crear nueva subcategoria', 
                array(
                    'controller' => 'categorias', 
                    'action' => 'addc', 
                    $cpadre
                ),
                array('class'    => 'uk-button uk-button-danger')
            ); 
        ?>
    </div>
</div>
<div class="uk-width-medium-1-1" data-uk-grid-margin="">
    <?php if(!empty($categorias)): ?>
    <div class="uk-overflow-container">
        <table class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
            <caption>Subcategorías</caption>
            <thead>
                <tr>
                    <th class="uk-width-8-10 uk-text-left">Subcategoria</th>
                    <th class="uk-width-1-10 uk-text-center">Editar</th>
                    <th class="uk-width-1-10 uk-text-center">Borrar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categorias as $categoria): ?>
                <tr>
                    <td>
                        <?php echo $this->Html->link($categoria['Categoria']['nombre'], 
                                array(
                                    'controller' => 'categorias', 
                                    'action'     => 'view', 
                                    $categoria['Categoria']['id']
                                ),
                                array('class'    => 'uk-button uk-button-link')
                            ); 
                        ?>
                    </td>
                    <td class="uk-text-center">
                        <?php echo $this->Html->link('', 
                                array(
                                    'controller' => 'categorias', 
                                    'action'     => 'edit', 
                                    $categoria['Categoria']['id']
                                ), 
                                array(
                                    'escape' => false,
                                    'class'  => 'uk-icon-button uk-icon-edit'
                                )
                            );
                        ?>
                    </td>		
                    <td class="uk-text-center">
                        <?php echo $this->Html->link('',
                                array(
                                    'controller' => 'categorias', 
                                    'action'     => 'delete', 
                                    $categoria['Categoria']['id']
                                ),
                                array(
                                    'escape' => false,
                                    'class'  => 'uk-icon-button uk-icon-trash'
                                ), 
                                "¿Desea continuar?"
                            ); 
                        ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php else: ?>
    <p>
        Aún no se han agregado ningun recurso, puede cargar uno 
        <?php echo $this->Html->link('aquí',
                array(
                    'controller' => 'categorias', 
                    'action'     => 'add'
                )
            ); 
        ?>
    </p>
    <?php endif; ?>
</div>