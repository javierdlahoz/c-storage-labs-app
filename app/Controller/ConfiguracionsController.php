<?php

class ConfiguracionsController extends AppController {
	public  $components = array('RequestHandler');
	var $helpers = array('Html', 'Form', 'Time', 'Js' => array('Jquery'));

	function mail()
	{
		$this->set('configuraciones', $this->Configuracion->find('first', array('conditions'=>array('id'=>'001'))));
		if ($this->request->is('post')) {
			if ($this->Configuracion->save($this->request->data)) {
				$this->redirect(array('action'=>'mail'));
				$this->Session->setFlash(__('Configuración modificada'));
			}
			else {
				$this->Session->setFlash(__('Ha habido un problema, intentelo más tarde'));
			}
	}
	}
	
}
