<?php

class PropiedadesController extends AppController {
	
	public  $components = array('RequestHandler');
	var $uses = array('Categoria');
		
	var $helpers = array('Html', 'Form', 'Time', 'Js' => array('Jquery'));
	
	
		public function add($id = null) {
			$this->set('cpadre', $id);
			
			if ($this->request->is('post')) {
				
				$id = $this->request->data['Propiedade']['cpadre'];
				$this->Categoria->save(array('id' => $id,'$push' => array('propiedades' =>
						array('id' => $this->request->data['Propiedade']['id'],
								'nombre' => $this->request->data['Propiedade']['nombre'],
								'descripcion' => $this->request->data['Propiedade']['descripcion'],
								'tipo' => $this->request->data['Propiedade']['tipo']
						))));
				$this->redirect(array('controller'=>'propiedades', 'action' => 'index', $id));
						
			}
		}
	
		
		//termino de la funciï¿½n de borrado
		
		public function beforeFilter() {
			parent::beforeFilter();
			//$this->Auth->allow('add', 'restaurar', 'login', 'logout'); // Letting users register themselves
		}
		
	//FUNCIIÓN SEARCH CON EL AUTOCOMPLETE
			
			
		
			function index($id=null){
				if($id==null){
					$id = '517eb611398dacb818000004';
				}
				
				$categorias = $this->Categoria->find('first', array('conditions'=>array('id'=>$id)));
				foreach($categorias as $categoria){
					$nombre = $categoria['nombre'];
				}
				$this->set('id', $id);
				$this->set('ncategoria', $nombre);
				$this->set('categorias', $categorias);
				//$this->set('propiedades', $this->Propiedade->find('all', array('conditions' => array('cpadre'=>$id))));
			}	

    public function delete($id = null){
    	$temp =  explode("-", $id);
    	$id_categoria = $temp[0];
    	
    	$this->Categoria->save(array('id' => $id_categoria, 
    			'$pull' => array("propiedades" => array('id' => $id))));
    	$this->redirect(array('controller'=>'propiedades', 'action' => 'index', $id_categoria));
    	
    }

		//FIN DE AUTOCOMPLETE
		
	public function edit($id = null){
		$this->set('cpadre', $id);
		$idprop = $id;
		$temp = explode('-', $id);
		$cpadre = $temp[0];
	
		$this->set('categorias', $this->Categoria->find('first', array('conditions' => array('id'=>$cpadre))));
			
			if ($this->request->is('post')) {
				$cont = $this->request->data['Propiedade']['cont'];
				$id = $this->request->data['Propiedade']['cpadre'];
				//$idprop = $this->request->data['Propiedade']['idprop'];
				
				$this->Categoria->save(array('id'=>$id,
									'propiedades.'.$cont.'.nombre' => $this->request->data['Propiedade']['nombre'],
								'propiedades.'.$cont.'.descripcion' => $this->request->data['Propiedade']['descripcion'],
								'propiedades.'.$cont.'.tipo' => $this->request->data['Propiedade']['tipo']
						));
				$this->Session->setFlash("Se ha modificado la propiedad");
				$this->redirect(array('controller'=>'propiedades', 'action' => 'edit', $idprop));
				
			}
		}
		
	  ///FIN DE LA FUNCIï¿½N DE CAMBIO DE CLAVE
    
    function isAuthorized() {
    	/*if ((($this->action == 'delete'))&&($this->Auth->user('role') != 'admin')) {
    		$this->Session->setFlash(__('Usted no posee los privilegios para ingresar en esta página'));
    		return false;
    		
    	} 
    	else*/
    		return true;
    
    }
}
