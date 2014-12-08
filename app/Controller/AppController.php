<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    
    public $uses = array('User');

    public $components = array(
        'Session'
		,
        'Auth' => array(
            'loginAction' => array(
                'controller' => 'users',
                'action' => 'login'
            ),
            'loginRedirect'  => array('controller' => 'documentos', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'users', 'action' => 'login', 'home'),
            'authError' => 'No estás permitido para entrar aquí',
            //'authorize'      => 'Controller'
        )
    );

    public function beforeFilter() {
        $this->Auth->allow('login', 'logout');
    	// $this->Auth->authorize = array('Controller');
    }
    
    public function isAuthorized() {
    	return true;
    }

    public function usuarios(){
        //$this->User = new User();
        $usuarios = $this->User->find();
        return $usuarios;
    }
    
}
