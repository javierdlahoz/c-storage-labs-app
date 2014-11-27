<?php
App::uses('CakeEmail', 'Network/Email');

class CategoriasController extends AppController {
	
	public  $components = array('RequestHandler');
	
	var $helpers = array('Html', 'Form', 'Time', 'Js' => array('Jquery'));
	
		public function view($id = null) {
			$temp = $this->isAuthorized();
			if($temp){
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
		else{
			$this->Session->setFlash(__(utf8_encode('El usuario no está registrado o no es administrador')));
			$this->redirect(array('action' => 'validar'));
		}
		}
	
		public function add() { 
			$temp = $this->isAuthorized();
			
			$admin = $this->Session->read('admin');
			if($admin != 1)
				$temp = false;
			
			
			if($temp){	
			
			if ($this->request->is('post')) {
				$this->Categoria->create();
				
				if ($this->Categoria->save($this->request->data)) {
					$this->Session->setFlash(__('La categoria ha sido creada exitosamente'));
					
				} 
				else {
					$this->Session->setFlash(__('La categoria no ha sido creada'));
					}
				}}
			else {
				$this->Session->setFlash(__(utf8_encode('El usuario no está registrado o no es administrador')));
				$this->redirect(array('action' => 'validar'));
			}
		}
		
		public function addc($id = null) {
			$temp = $this->isAuthorized();
			if($temp){
			$this->set('cpadre', $id);
			if ($this->request->is('post')) {
				$this->Categoria->create();
		
				if ($this->Categoria->save($this->request->data)) {
					$this->Session->setFlash(__('La categoria ha sido creada exitosamente'));
						
				}
				else {
					$this->Session->setFlash(__('La categoria no ha sido creada'));
				}
			}
			}
			else {
				$this->Session->setFlash(__(utf8_encode('El usuario no está registrado o no es administrador')));
				$this->redirect(array('action' => 'validar'));
			}
		}
	
		
		//termino de la funciï¿½n de borrado
		
		public function beforeFilter() {
			parent::beforeFilter();
			//$this->Auth->allow('validar'); // Letting users register themselves
		}
		
	//FUNCIIÓN SEARCH CON EL AUTOCOMPLETE
			
			
		
			function index(){
				$temp = $this->isAuthorized();
				
				$admin = $this->Session->read('admin');
				if($admin != 1)
					$temp = false;
				
				if($temp){
				$this->set('categorias', $this->Categoria->find('all', array('conditions' => array('cpadre'=>'517eb611398dacb818000004'))));
				}
				else {
					$this->Session->setFlash(__(utf8_encode('El usuario no está registrado o no es administrador')));
					$this->redirect(array('action' => 'validar'));
				}
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
		$temp = $this->isAuthorized();
		
		$admin = $this->Session->read('admin');
		if($admin != 1)
			$temp = false;
		
		
		if($temp){				
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
					
					//$this->Session->setFlash(__('La imagen ha sido guardada', true));
					//$this->redirect(array('action' => 'index'));
				
				} 
				else {
					$this->Session->setFlash(__('Ha habido un problema, intentelo más tarde'));
				
				}
			} 
		}
		
		else {
			$this->Session->setFlash(__(utf8_encode('El usuario no está registrado o no es administrador')));
			$this->redirect(array('action' => 'validar'));
		}
	}
	
	function validar(){
		
		$dbhost='localhost';
		$dbusername='root';
		$dbuserpass='juliana22';
		$dbname='ceiam';
		
		
		if (!($link=mysql_connect($dbhost,$dbusername,$dbuserpass)))
		{
			echo "Error conectando a la base de datos.";
			exit();
		}
		
		else{
			$xy = mysql_select_db($dbname,$link) or die(mysql_error());
	
			if(!empty($_POST['user'])){
				
				$username = $_POST['user'];
				$password = $_POST['password'];
				$sql = "SELECT password, administrador FROM usuario WHERE username = '".$username."'";
				$resultgeneral = mysql_query($sql,$link);
				$password2 = 0; 
				$admin = 0;
				while($row = mysql_fetch_array($resultgeneral)){
					$password2 = $row[0];
					$admin = $row[1];
				}
				
			if(($password==$password2)&&(!empty($password2))){			
				$this->Session->write('user', $username);
				$this->Session->write('admin', $admin);
				$this->redirect(array('controller'=>'documentos', 'action' => 'index'));
				
			}
			else{
				$this->Session->setFlash(__('Las contraseñas no coinciden'));
				$this->redirect('../');
			}
		}
			else{
				$this->redirect('../');
			
			}
		}
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
}
