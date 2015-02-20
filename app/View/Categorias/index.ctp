<div class="uk-width-medium-1-1" data-uk-grid-margin="">
    <h1 class="uk-heading-medium">
        Categorías
    </h1>
</div>
<div class="uk-width-medium-1-1" data-uk-grid-margin="">
    <div class="uk-button-group">
        <?php echo $this->Html->link('Crear nueva categoria', 
                array(
                    'controller' => 'categorias', 
                    'action'     => 'add'
                ),
                array('class'    => 'uk-button uk-button-primary') 
            ); 
        ?>
        <?php echo $this->Html->link('Propiedades', 
                array(
                    'controller' => 'propiedades', 
                    'action'     => 'index', '517eb611398dacb818000004'
                ),
                array('class'    => 'uk-button')
            ); 
        ?>
        <?php echo $this->Html->link('Usuarios', 
                array(
                    'controller' => 'usuarios', 
                    'action'     => 'index', '517eb611398dacb818000004'
                ),
                array('class'    => 'uk-button')
            ); 
        ?>
    </div>
</div>
<div class="uk-width-medium-1-1" data-uk-grid-margin="">
    <?php if(!empty($categorias)): ?>
    <table class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
        <caption>Categorias<caption>
        <thead>
            <tr>
                <th class="uk-width-8-10 uk-text-left">Categoria</th>
                <th class="uk-width-1-10 uk-text-center">Editar</th>
                <th class="uk-width-1-10 uk-text-center">Borrar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categorias as $categoria): ?>
            <tr>
                <td class="uk-width-8-10 uk-text-left">
                    <?php echo $this->Html->link($categoria['nombre'],
                            array(
                                'controller' => 'categorias', 
                                'action'     => 'view', $categoria['id']
                            ),
                            array('class' => 'uk-button-link')
                        );
                    ?>
                </td>
                <td class="uk-width-1-10 uk-text-center">
                    <?php
                    echo $this->Html->link('', 
                            array(
                                'controller' => 'categorias', 
                                'action'     => 'edit', $categoria['id']
                            ), 
                            array(
                                'escape' => false,
                                'class'  => 'uk-icon-button uk-icon-edit'
                            )
                        );
                    ?>
                </td>		
                <td class="uk-width-1-10 uk-text-center">
                    <?php 
                    echo $this->Html->link('', 
                            array(
                                'controller' => 'categorias', 
                                'action'     => 'delete', $categoria['id']
                            ), 
                            array(
                                'escape' => false,
                                'class'  => 'uk-icon-button uk-icon-trash'
                            ), 
                            "¿Desea continuar?"); 
                    ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
    <p>
        Aún no se han agregado ningún recurso, puede cargar uno 
        <?php echo $this->Html->link('aquí', 
                array(
                    'controller'    => 'categorias',
                    'action'        => 'add'
                ),
                array('class' => 'uk-button-link')
            ); 
        ?>.
    </p>
    <?php endif; ?>
</div>