<div class="uk-width-medium-1-1" data-uk-grid-margin="">
    <h1 class="uk-heading-medium">
        Usuarios del Sistema
    </h1>
</div>
<div class="uk-width-medium-1-1" data-uk-grid-margin="">
    <div class="uk-grid uk-grid-small" data-uk-grid-margin="">
        <div class="uk-width-medium-1-1" data-uk-grid-margin="">
            <?php echo $this->Html->css('autocomplete'); ?>
            <div class="uk-panel uk-panel-box uk-panel-box-primary">
                <?php echo $this->Form->create('User',
                        array(
                            'action'=> 'index',
                            'class' => 'uk-form uk-form-stacked'
                        )
                    ); 
                ?>
                <?php echo $this->Form->input('username',
                    array(
                        'type'          => 'text',
                        'id'            => 'username',
                        'div' => array(
                            'class' => 'uk-form-row'
                        ),
                        'label' => array(
                            'text' => 'Buscar por Nombre',
                            'class' => 'uk-form-label'
                        ),
                        'between' => '<div class="uk-form-controls">',
                        'after' => '</div>',
                        'class'         => 'uk-width-1-1',
                        'required'      => true,
                        'autofocus'     => true,
                        'placeholder'   => 'Buscar por Nombre de Usuario o Login'
                    )
                ); ?>
                <div class="uk-form-row">
                    <?php echo $this->Html->link('Mostrar todos',
                            array(
                                'controller' => 'users', 
                                'action'     => 'index'
                            ),
                            array('class' => 'uk-button uk-button-danger')
                        );
                    ?>
                    <?php echo $this->Form->button('Ir',
                        array(
                            'type'  => 'submit',
                            'class' => 'uk-button uk-button-primary'
                            )
                        ); 
                    ?>
                    <?php echo $this->Html->link('Crear un nuevo usuario', 
                            array(
                                'controller' => 'users', 
                                'action' => 'add'),
                            array('class' => 'uk-button uk-button-primary')
                        ); 
                    ?>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
    <?php if(!empty($users)): ?>
    <div class="uk-overflow-container">
        <table class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
            <caption>Usuarios</caption>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Nombre de Usuario</th>
                    <th>Organización</th>
                    <th>Correo Electrónico</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <?php if(!empty($user['User']['nombre'])): ?>
                        <tr>
                            <td>
                                <?php echo $this->Html->link($user['User']['nombre'],
                                        array(
                                            'controller' => 'users', 
                                            'action' => 'edit', 
                                            $user['User']['id']
                                        )
                                    ); 
                                ?>
                            </td>
                            <td>
                                <?php echo $this->Html->link($user['User']['username'], 
                                        array(
                                            'controller' => 'users', 
                                            'action' => 'edit', 
                                            $user['User']['id']
                                        )
                                    ); 
                                ?>
                            </td>
                            <td>
                                <?php echo $this->Html->link($user['User']['organizacion'], 
                                        array(
                                            'controller' => 'users', 
                                            'action' => 'edit', 
                                            $user['User']['id']
                                        )
                                    ); 
                                ?>
                            </td>
                            <td>
                                <?php echo $this->Html->link($user['User']['email'], 
                                        array(
                                            'controller' => 'users', 
                                            'action' => 'edit', 
                                            $user['User']['id']
                                        )
                                    );
                                ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php else: ?>
    <p>
        Aún no se han agregado usuarios, para agregar uno, haga clic 
        <?php echo $this->Html->link('aquí', 
                array(
                    'controller'    => 'users',
                    'action'        => 'add'
                ),
                array('class' => 'uk-button-link')
            ); 
        ?>
    </p>
    <?php endif; ?>
</div>