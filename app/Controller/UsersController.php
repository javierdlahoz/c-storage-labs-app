<?php
App::uses('CakeEmail', 'Network/Email');

class UsersController extends AppController {
	
	public  $components = array('RequestHandler', 'Auth');
	
	var $helpers = array('Html', 'Form', 'Time', 'Js' => array('Jquery'));

		public function view($id = null) {
			$this->User->id = $id;
			if (!$this->User->exists()) {
				throw new NotFoundException(__('Invalid user'));
			}
			$this->set('user', $this->User->read(null, $id));
		}
	
		public function add() 
		{ //adicionarle la funcionalidad de env�o de correo electr�nico
			$temp = $this->Session->read('Auth.User.id');
		if(empty($temp)||($this->Session->read('Auth.User.role')=='admin')) {
	
			if ($this->request->is('post')) {
				$resultado = $this->User->find('count', array('conditions'=> array('username' => $this->request->data['User']['username'])));
				
			if(($resultado==0)&&($this->request->data['User']['password']==$this->request->data['User']['Confirmar_password'])&&(strlen($this->request->data['User']['username'])>5))
				{
				$originalPassword = $this->request->data['User']['password'];
					$this->request->data['User']['password'] = AuthComponent::password($this->request->data['User']['password']);
				if ($this->User->save($this->request->data)) {
					
					$emailTo = $this->request->data['User']['email'];
					
					if(!empty($emailTo)){
						 
						$email = new CakeEmail();
						$email->config('smtp');
						$email->from(array('observatorio@udi.edu.co' => 'Observatorio'));
						$email->to($emailTo);
						$email->subject("Creaci�n de cuenta");
						$texto = "Esto es un mensaje generado autom�ticamente por el observatorio de aplicaciones<br><br>";
						$texto = $texto."se ha creado su cuenta de usuario de la siguiente manera, <br>
								username: '".$this->request->data['User']['username']."'<br>Password: '".$originalPassword."'
							    <br>";
						$email->sendAs = 'html';
						$email->emailFormat('html');
						$email->send($texto);
						$this->redirect('../../observatorio');
						
					}
					
					
					$this->Session->setFlash(__('El usuario ha sido creado exitosamente'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('El usuario no ha podido ser creado '.$this->request->data['User']['password']));
					}
				}
				else {
					if($this->request->data['User']['password']!=$this->request->data['User']['Confirmar_password'])
					{
						$this->Session->setFlash(__('Los passwords no coinciden'));
					}else
					{
						if((strlen($this->request->data['User']['username'])<=5))
							$this->Session->setFlash(__('El username debe tener al menos 6 caracteres'));
						else
							$this->Session->setFlash(__('El usuario ya existe'));
					}
				}
			} }
			else {
				$this->Session->setFlash(__('No puedes usar esta funcionalidad'));
				$this->redirect('../');
				
			}
		}
	
		public function edit($id = null) {
			
			if(($this->Session->read('Auth.User.role')=='admin')||($this->Session->read('Auth.User.id')==$id)){	
				
				$this->User->id = $id;
				$this->set('usuarios', $this->User->find('first', array('conditions' => array('id' => $id))));
				
				$usuarios = $this->User->find('first', array('conditions' => array('id' => $id)));
				
				foreach($usuarios as $usuario){
        			$imagen = $usuario['imagen'];
       			}
				
				
			if (!$this->User->exists()) {
				throw new NotFoundException(__('Usuario no existente'));
			}
			
			if (!empty($this->data['User']['imagen']['tmp_name'])) {
			
				$fileName = $this->generateUniqueFilename($this->data['User']['imagen']['name']);
				$error = $this->handleFileUpload($this->data['User']['imagen'], $fileName);
				
				if (!$error){
					$this->request->data['User']['imagen'] = $fileName; }
			}
			else{
				$this->request->data['User']['imagen'] = $imagen;
				}	
			
			
			if ($this->request->is('post') || $this->request->is('put')) {
				if (($this->User->save($this->request->data))&&(!$error)) {
					
					$this->Session->setFlash(__('El usuario ha sido modificado'));
					//$this->Session->setFlash(__('La imagen ha sido guardada', true));
					$this->redirect(array('action' => 'index'));
				
				} 
				else {
					$this->Session->setFlash(__('Ha habido un problema, intentelo m&aacutes tarde'));
				
				}
			} else {
				$this->request->data = $this->User->read(null, $id);
				unset($this->request->data['User']['password']);
			}
		}
		else{
			$this->Session->setFlash(__('Usted no posee los privilegios para ingresar en esta p&aacutegina'));
			$this->redirect(array('action' => 'edit', $this->Session->read('Auth.User.id')));
			
		}
		
		}
	
		//Funcion de borrado de un usuario
		
		public function delete($id) {
			/*if (!$this->request->is('post')) {
				throw new MethodNotAllowedException();
			}*/
			
			$this->User->id = $id;
			if (!$this->User->exists()) {
				throw new NotFoundException(__('Usuario incorrecto'));
			}
			if ($this->User->delete()) {
				$this->Session->setFlash(__('Usuario eliminado'));
				$this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('El usuario no ha sido eliminado'));
			$this->redirect(array('action' => 'index'));
		}
		
		//termino de la funci�n de borrado
		
		public function beforeFilter() {
			parent::beforeFilter();
			$this->Auth->allow('add', 'restaurar', 'login', 'logout'); // Letting users register themselves
		}
		
		public function login() {
			if ($this->request->is('post')) {
				if ($this->Auth->login()) {
					$this->redirect($this->Auth->redirect());
				} else {
					$this->Session->setFlash(__('Nombre de usuario y/o password incorrectos, por favor intente de nuevo'));
				}
			}
		}
		
		public function logout() {
			$this->redirect($this->Auth->logout());
		}
		
		function generateUniqueFilename($fileName, $path='')
		{
			$path = empty($path) ? WWW_ROOT.'/files/usrpic/' : $path;
			$no = 1;
			$newFileName = $fileName;
			while (file_exists("$path/".$newFileName)) {
				$no++;
				$newFileName = substr_replace($fileName, "_$no.", strrpos
						($fileName, "."), 1);
			}
			return $newFileName;
		}
		
		
		
		//FUNCIONES DE SUBIDA DE ARCHIVOS DE IMAGEN
		
		function handleFileUpload($fileData, $fileName)
		{
			$error = false;
		
			//Get file type
			$typeArr = explode('/', $fileData['type']);
		
			//If size is provided for validation check with that size. Else	compare the size with INI file
			if (($this->validateFile['size'] && $fileData['size'] > $this->validateFile['size']) || $fileData['error'] == UPLOAD_ERR_INI_SIZE)
			{
				$error = 'El archivo es demasiado grande para ser subido';
			}
			elseif ($this->validateFile['type'] && (strpos($this->validateFile['type'], strtolower($typeArr[1])) === false))
			{
				//File type is not the one we are going to accept. Error!!
				$error = 'Invalid file type';
			}
			else
			{
				//Data looks OK at this stage. Let's proceed.
				if ($fileData['error'] == UPLOAD_ERR_OK)
				{
					//Oops!! File size is zero. Error!
					if ($fileData['size'] == 0)
					{
						$error = 'Zero size file found.';
					}
					else
					{
						if (is_uploaded_file($fileData['tmp_name']))
						{
							//Finally we can upload file now. Let's do it and return without errors if success in moving.
							if (!move_uploaded_file($fileData['tmp_name'], WWW_ROOT.'/files/usrpic/'.$fileName))
							{
								$error = true;
							}
						}
						else
						{
							$error = true;
						}
					}
				}
			}
			return $error;
		}
		
		function deleteMovedFile($fileName)
		{
			if (!$fileName || !is_file($fileName))
			{
				return true;
			}
			if(unlink($fileName))
			{
				return true;
			}
			return false;
		}
		
		
		
		function add2()
		{
			if (empty($this->data))
			{
				$this->Document->create();
			}
			else
			{
				$err = false;
				if (!empty($this->data['Attachment']['filename']['tmp_name'])) {
					$fileName = $this->generateUniqueFilename($this->data['Attachment']['filename']['name']);
					echo 'The filename is:'. $fileName;
					$error = $this->handleFileUpload($this->data['Attachment']['filename'], $fileName);
					echo 'The error is: '. $error;
				}  
				else {
					print_r($this->data);
				}
				if (!$error)
				{
					$this->data['Attachment']['filename'] = $fileName;
					if ($this->Attachment->save($this->data))
					{
						$this->Session->setFlash(__('El archivo ha sido guardado', true));
						$this->redirect(array('action'=>'index'));
					} else {
						$err = true;
					}
				} else {
					$this->Attachment->set($this->data);
				}
		
				if ($error || $err)
				{
					//Something failed. Remove the image uploaded if any.
					$this->deleteMovedFile(WWW_ROOT.IMAGES_URL.$fileName);
					$this->set('error', $error);
					$this->set('data', $this->data);
					$this->validateErrors($this->Attachment);
					$this->render();
				}
			}
		}
		
		//FUNCI�N SEARCH CON EL AUTOCOMPLETE
		
			function index(){
				
				
				if ($this->RequestHandler->isAjax()) {

					Configure::write( 'debug', 0 ); 
					$this->autoRender=false;
					$users=$this->User->find('all', array('conditions' => 
						array('$or' =>  array( 
											array("username" => array('$regex' => new MongoRegex('/.*'.$_GET['term'].'*./'))), 
											array("nombre" => array('$regex' => new MongoRegex('/.*'.$_GET['term'].'*./'))),
											array("email" => array('$regex' => new MongoRegex('/.*'.$_GET['term'].'*./')))
									))));
					
			
					
					$i=0;
					$response[$i]['value']= $_GET['term'];
					$response[$i]['label']= "No se encontraron resultados";
					
					foreach($users as $user){
						
						if(!empty($user['User']['imagen']))
							$htmlImagen = "<td width='32px' valign='middle' heigth='0px'>
							<img width=\"32\" height=\"32\" src='/observatorio/files/usrpic/".$user['User']['imagen']."'/></td>";
						else
							$htmlImagen = "<td width='32px' valign='middle' heigth='0px'></td>";
						
						$response[$i]['value']=$user['User']['username'];
						$response[$i]['label']= "<table border='0' cellpadding='0' cellspacing='0'>
							<tr onclick = \"window.location='/observatorio/users/edit/".$user['User']['id']."'\">"
							.$htmlImagen."							
							<td align='left' valign='middle'>".$user['User']['nombre']."
							<p style='font-size: 11px; color: #777;'>".$user['User']['email']."</p></td></tr></table>";
						$i++;
					}
					echo json_encode($response);
				}
				else{
					if (!empty($this->data)) {
					
						$this->User->recursive = 0;
						
						if(empty($this->request->data['User']['username']))
							$this->set('users', $this->paginate());
						else
							$this->set('users', $this->User->find('all', array('conditions' =>
									array('$or' =>  array( 
											array("username" => array('$regex' => new MongoRegex('/.*'.$this->request->data['User']['username'].'*./'))), 
											array("nombre" => array('$regex' => new MongoRegex('/.*'.$this->request->data['User']['username'].'*./'))),
											array("email" => array('$regex' => new MongoRegex('/.*'.$this->request->data['User']['username'].'*./')))
									)))));
					}
					else{
						$this->set('users', $this->paginate());
					}
				}
			}	
		
    
    function autocomplete() {
    	$terms = $this->User->find('all', array('conditions'=>array('$or' =>  array( 
											array("username" => array('$regex' => new MongoRegex('/.*'.$this->request->data['User']['username'].'*./'))), 
											array("nombre" => array('$regex' => new MongoRegex('/.*'.$this->request->data['User']['username'].'*./'))),
											array("email" => array('$regex' => new MongoRegex('/.*'.$this->request->data['User']['username'].'*./')))
									)),
    			'fields'=>array('DISTINCT username'),
    			'order'=>'nombre',
    			'limit'=>10,
    			'recursive'=>-1,
    	));
    	
    	$terms = Set::Extract($terms,'{n}.User.nombre');
    	$this->layout = 'ajax';
    	$this->set('terms', $terms);
    }
    
    
		//FIN DE AUTOCOMPLETE
		
    
    function restaurar(){
    	if ($this->request->is('post')) {
    		$temporal = $this->request->data['User']['username'];
    		
    		$result = $this->User->find('first', array('conditions'=> array('User.username' => $temporal)));
    		$emailTo = $result['User']['email'];
    		$newpss = rand(100000, 999999);
    		$result['User']['password'] = $this->Auth->password($newpss);
    		$this->User->save($result, false);
    		
    		if(!empty($emailTo)){
    			
    			$email = new CakeEmail();
    			$email->config('smtp');
    			$email->from(array('observatorio@udi.edu.co' => 'Observatorio'));
    			$email->to($emailTo);
    			$email->subject("Restauraci�n de contrase�a");
    			$texto = "Esto es un mensaje generado autom�ticamente por el observatorio de aplicaciones<br><br>";
    			$texto = $texto."Su contrase�a actual es: ".$newpss;
    			$email->sendAs = 'html';
    			$email->emailFormat('html');
    			$email->send($texto);
    			//$this->redirect('../../observatorio');
    			
    			$this->Session->setFlash(__('Se ha enviado un correo a su cuenta de correo con la contrase�a', true));
    		}
    		
    	}
    	
    }
    
    public function cambioc($id = null){
    	if($this->Session->read('Auth.User.id')==$id){
    	
    		$this->User->id = $id;
    		$this->set('usuario', $this->User->find('first', array('conditions' => 'id = '.$id)));
    		$control = true;
    	
    	if(!empty($this->data['User']['password'])) 
    	{
    		if(strlen($this->data['User']['password'])<5){
    			$control = false;
    			$this->Session->setFlash(__('El password debe tener al menos 5 caracteres', true));
	    	}
    	
    	if($this->data['User']['password']!=$this->data['User']['confirmar_password']){
    		$control = false;
    		$this->Session->setFlash(__('Los passwords no coinciden', true));
    	}
    	
    	if ($control) {
    		$this->request->data['User']['password'] = AuthComponent::password($this->request->data['User']['password']);
    	}
    		
    		
    	if ($this->request->is('post')) {
    		if ($this->User->save($this->request->data)) {
    				
    			$this->Session->setFlash(__('El usuario ha sido modificado'));
    			//$this->Session->setFlash(__('La imagen ha sido guardada', true));
    			//$this->redirect(array('action' => 'cambioc'));
    	
    		}
    		else {
    			$this->Session->setFlash(__('Ha habido un problema, intentelo m&aacutes tarde'));
    	
    		}
    	} else {
    		$this->request->data = $this->User->read(null, $id);
    		unset($this->request->data['User']['password']);
    	}
    	
    	} }
    	else
    	{
    		$this->Session->setFlash(__('Usted no posee los privilegios para ingresar en esta p&aacutegina'));
    		$this->redirect(array('action' => 'cambioc', $this->Session->read('Auth.User.id')));
    	}
    }
    
    
    ///FIN DE LA FUNCI�N DE CAMBIO DE CLAVE
    
    function isAuthorized() {
    	if ((($this->action == 'delete')||($this->action == 'index'))&&($this->Auth->user('role') != 'admin')) {
    		$this->Session->setFlash(__('Usted no posee los privilegios para ingresar en esta p&aacutegina'));
    		return false;
    		
    	} 
    	else
    		return true;
    
    }
}