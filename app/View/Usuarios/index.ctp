<div class="uk-width-medium-1-1" data-uk-grid-margin="">
    <h1 class="uk-heading-medium">
        Usuarios asignados a <b><?php echo $ncategoria; ?></b>
    </h1>
</div>
<?php 
    foreach($categorias  as $categoria){
        if(!empty($categoria['usuarios'])){
            $usuarios = $categoria['usuarios'];
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
                    array('class' => 'uk-button uk-button-primary')
                );
        } else {
            echo $this->Html->link('Regresar', 
                    array(
                        'controller' => 'categorias', 
                        'action'     => 'view', 
                        $id
                    ),
                    array('class' => 'uk-button uk-button-danger')
                );
        }
        echo $this->Html->link('Asignar un usuario', 
                array(
                    'controller' => 'usuarios', 
                    'action'     => 'add', 
                    $id
                ),
                array('class' => 'uk-button uk-button-default')
            ); 
    ?> 
    </div>
</div>
<div class="uk-width-medium-1-1" data-uk-grid-margin="">
    <?php if(!empty($usuarios)):
        $procont = count($usuarios);
    ?>
    <div class="uk-overflow-container">
        <table class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
            <caption>Subcategorías</caption>
            <thead>
                <tr>
                    <th class="uk-width-8-10 uk-text-left">Subcategoria</th>
                    <th class="uk-width-2-10 uk-text-center">Borrar</th>
                </tr>
            </thead>
            <tbody>
            <?php for($i=0; $i<=$procont-1; $i++): ?>
                <tr>
                    <td>
                        <?php echo $usuarios[$i]['username']; ?>
                    </td>
                    <td class="uk-text-center">
                        <?php echo $this->Html->link('<i class="uk-icon uk-icon-medium uk-icon-trash uk-hover"></i>', 
                                array(
                                    'controller' => 'usuarios', 
                                    'action'     => 'delete', 
                                    $usuarios[$i]['id']
                                ),
                                array('escape' => false)
                            ); 
                        ?>
                    </td>
                </tr>
            <?php endfor; ?>
            </tbody>
        </table>
    <?php else: ?> 
        <p>
            Aún no se han asignado usuarios, puede asignar uno 
            <?php echo $this->Html->link('aquí', 
                array(
                    'controller' => 'usuarios', 
                    'action'     => 'add'
                )
            ); ?>
        </p>
    <?php endif; ?>
</div>

