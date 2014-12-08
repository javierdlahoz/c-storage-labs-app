<?php
App::uses('CakeEmail', 'Network/Email');
App::uses('AuthComponent', 'Controller/Component');

class CategoriasController extends AppController {
	
	public  $components = array('RequestHandler');
	
	var $helpers = array('Html', 'Form', 'Time', 'Js' => array('Jquery'));
	
	public function view($id = null) {
		$this->set('cpadre', $id);
		$categorias = $this->Categoria->find('first',array('conditions' => array('id'=>$id)));
		foreach($categorias as $categoria){
			$nombrec = $categoria['nombre'];
			$cpadre = $categoria['cpadre'];
			$id_cat = $categoria['id'];
		}
		$this->set('nombre', $nombrec);
		$this->set('id', $id_cat);
		$this->set('canterior', $cpadre);
		$this->set('categorias', $this->Categoria->find('all',
			array('conditions' => array('cpadre'=>$id))));
	}

	public function add() { 
		if ($this->request->is('post')) {
			$this->Categoria->create();
			
			if ($this->Categoria->save($this->request->data)) {
				$this->Session->setFlash(__('La categoria ha sido creada exitosamente'));
				$this->redirect(array('action' => 'index'));
			} 
			else {
				$this->Session->setFlash(__('La categoria no ha sido creada'));
			}
		}
	}
		
	public function addc($id = null) 
	{
		$this->set('cpadre', $id);
		if ($this->request->is('post')) {
			$this->Categoria->create();
			if ($this->Categoria->save($this->request->data)) {
				$this->Session->setFlash(__('La categoria ha sido creada exitosamente'));
				$this->redirect(array('action' => 'view', $id));					
			}
			else {
				$this->Session->setFlash(__('La categoria no ha sido creada'));
			}
		}
	}
	
		
		//termino de la funciï¿½n de borrado
	
	public function beforeFilter() {
		$this->Auth->allow('index'); // Letting users register themselves
	}
		
	//FUNCIIÓN SEARCH CON EL AUTOCOMPLETE
	function index(){
		$categorias = $this->Categoria->find();
		$this->set('categorias', $categorias);
	}	

    
    function autocomplete() {
    	$terms = $this->Objeto->find('all', array('conditions'=>array('$or' =>  array( 
											array("nombre" => array('$regex' => new MongoRegex('/.*'.$this->request->data['Objeto']['nombreobjetos'].'*./'))), 
											array("descripcion" => array('$regex' => new MongoRegex('/.*'.$this->request->data['Objeto']['nombreobjetos'].'*./'))),
											array("archivo.name" => array('$regex' => new MongoRegex('/.*'.$this->request->data['Objeto']['nombreobjetos'].'*./')))
									)),
    			'order'=>'nombre',
    			'limit'=>10,
    			'recursive'=>-1,
    	));
    	
    	$terms = Set::Extract($terms,'{n}.Objeto.nombre');
    	$this->layout = 'ajax';
    	$this->set('terms', $terms);
    }
		//FIN DE AUTOCOMPLETE
		
	public function edit($id = null){
	
		$this->Categoria->id = $id;
		$this->set('categorias', $this->Categoria->find('first', array('conditions' => array('id' => $id))));
		$categorias = $this->Categoria->find('first', array('conditions' => array('id' => $id)));
		
		foreach($categorias as $categoria){
			$cpadre = $categoria['cpadre'];
		}
		$this->set('cpadre', $cpadre);
		$this->set('id_cat', $id);
			
		if (!$this->Categoria->exists()) {
			throw new NotFoundException(__('Categoria no existente'));
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Categoria->save($this->request->data)) {
				$this->Session->setFlash(__('Categoría modificada'));
				$this->redirect(array('action' => 'index', $cpadre));

			} 
			else {
				$this->Session->setFlash(__('Ha habido un problema, intentelo más tarde'));
			
			}
		} 
		
	}
	
	function validar(){

	}
	
	
	function logout(){
		$this->Session->delete('user');
		$this->Session->delete('admin');
		$this->redirect('../');			
	}
    
    function isAuthorized() {
    	$temp = $this->Session->read('user');
    	$admin = $this->Session->read('admin');
    	if((!empty($temp))&&($admin==1)){
    		return true;
    	}
    	else
    	{
    		return false;
    		
    	} 
    }

    function delete($id = null){
    	if($id != null){
    		$categoria = $this->Categoria->find('first', array('conditions' => array('id' => $id)));
    		$cpadre = $categoria['Categoria']['cpadre'];

    		$this->Categoria->delete($id);
    		$this->Session->setFlash(__(utf8_encode('Se ha eliminado la categoria')));
    	}
    	if(isset($cpadre)){
    		$this->redirect(array('action' => 'view', $cpadre));	
    	}
    	$this->redirect(array('action' => 'index'));
    }
}
