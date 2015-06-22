<?php
App::uses('CakeEmail', 'Network/Email');

class DocumentosController extends AppController {

	public  $components = array('RequestHandler');
	var $uses = array('Categoria', 'Configuracion');

	var $helpers = array('Html', 'Form', 'Time', 'Js' => array('Jquery'));

	public function view($id_cat = null)
	{
		$this->Session->write('id', $id_cat);
		$this->set('id_doc', $id_cat);
		$id_doc = $id_cat;
		$temp = explode('-', $id_cat);
		$id_cat = $temp[0];
		$this->set('id_cat', $id_cat);
		$i=0;

		$tempuser = false;
		$user = $this->Session->read('user');
		$categorias = $this->Categoria->find('first', array('conditions'=>array('id'=>$id_cat)));

		$this->set('documentos', $categorias);

		foreach($categorias as $categoria){
			$nombre_cat = $categoria['nombre'];
			$documentos = $categoria['documentos'];
			foreach($documentos	as $documento){
				if($documento['id']==$id_doc){
					if(!empty($documento['usuarios'])){
						$usuarios = $documento['usuarios'];
						foreach($usuarios as $usuario){
							if(!empty($usuario['username'])){
								if($usuario['username']==$user){
									$tempuser = true;
								}
							}
						}
					}
				}
			}
		}
		$admin = $this->Session->read('admin');
		if($admin == 1){
			$tempuser = true;
		}

		if($tempuser){


			while(!empty($categorias)){
				foreach($categorias as $categoria){
						
					if(!empty($categorias['Categoria']['cpadre']))
						$id=$categorias['Categoria']['cpadre'];

					if(!empty($categorias['Categoria']['propiedades'])){
						$propiedades1 = $categorias['Categoria']['propiedades'];
						foreach($propiedades1 as $propiedades2){
							$propiedades[$i] = $propiedades2;
							$i++;
						}
					}
				}
				if(!empty($id))
				{
					$categorias = $this->Categoria->find('first', array('conditions'=>array('id'=>$id)));
					if($id=='517eb611398dacb818000004')
						$id=null;
				}
				else
					$categorias = null;
			}
			$this->set('propiedades', $propiedades);
		}
		else {
			$this->Session->setFlash(__(utf8_encode('El usuario no est� registrado o no tiene permisos para ingresar a esta secci�n')));
			$this->redirect(array('controller' => 'categorias', 'action' => 'validar'));
		}

	}

	public function add($id_cat = null)
	{
	    if($id_cat === null){
	        $this->Session->setFlash("No puedes subir documentos a la carpeta Raíz");
	        $this->redirect("/documentos");
	    }
	    
		$this->Session->write('id', $id_cat);
		
		$this->set('id_cat', $id_cat);
		$idarchivo = String::uuid();
		$i=0;
		$usuarios = $this->usuarios();
		$this->set('usuarios', $usuarios);

		$categorias = $this->Categoria->find('first', array('conditions'=>array('id'=>$id_cat)));
		$propiedades = null;

		if(!empty($categorias)){
			foreach($categorias as $categoria){
				$nombre_cat = $categoria['nombre'];
			}
		}

		while(!empty($categorias)){
			foreach($categorias as $categoria){

				if(!empty($categorias['Categoria']['cpadre']))
					$id=$categorias['Categoria']['cpadre'];

				if(!empty($categorias['Categoria']['propiedades'])){
					$propiedades1 = $categorias['Categoria']['propiedades'];
					foreach($propiedades1 as $propiedades2){
						$propiedades[$i] = $propiedades2;
						$i++;
					}
				}
			}
			if(!empty($id))
			{
				$categorias = $this->Categoria->find('first', array('conditions'=>array('id'=>$id)));
				if($id=='517eb611398dacb818000004')
					$id=null;
			}
			else
				$categorias = null;
		}
		$this->set('propiedades', $propiedades);

		if ($this->request->is('post')) 
		{
			$nombre_doc = $this->data['Documento']['archivo']['name'];
			$id_doc = $this->request->data['Documento']['id_categoria'].'-'.rand();
			$path = empty($path) ? WWW_ROOT.'files/'.$id_doc.'-'.$this->data['Documento']['archivo']['name'] : $path;
			$path2 = $path;
			$path = "/files/".$id_doc.'-'.$this->data['Documento']['archivo']['name'];
			move_uploaded_file($this->data['Documento']['archivo']['tmp_name'], $path2);
			$id_categoria = $this->request->data['Documento']['id_categoria'];
			$array_campos = array('id' => $id_doc);

			for($j=0; $j<=$i-1; $j++){
				$nombre_input = $propiedades[$j]['nombre'];
				$array_campos[$propiedades[$j]['nombre']] = $this->request->data['Documento'][$nombre_input];
			}
				
			//inclusion de usuarios//
			$array_usuarios = array();
			$u=0;
				
			foreach($usuarios as $usuario){
				if($this->request->data['Documento'][$usuario['username']]==1)
				{
					$array_usuarios[$u]['username']=$usuario['username'];
					$u++;
				}
			}
				
			$this->request->data['Documento']['archivo']['url'] = $path;
			$array_campos['usuarios']=$array_usuarios;
			$array_campos['archivo'] = $this->request->data['Documento']['archivo'];
			$array_campos['comentarios'] = $this->request->data['Documento']['comentarios'];


			if($this->Categoria->save(array('id' => $id_categoria,'$push' => array('documentos' =>
					$array_campos)))){
				//$this->redirect(array('controller'=>'documentos', 'action' => 'index', $id));


				/*$configs = $this->Configuracion->find('first', array('conditions'=>array('id'=>'001')));
				 foreach($configs as $config){
				$mail_calidad = $config['correo_calidad'];
				}
				$email = new CakeEmail();
				$email->config('smtp');
				$email->from(array('ceiam@uis.edu.co' => 'CEIAM - Documental'));
				$email->to($mail_calidad);
				$email->subject("Manejo de archivos");
				$texto = 'Se ha a�adido un nuevo archivo a la carpeta '.$nombre_cat.', el cual tiene por nombre
				de archivo '.$nombre_doc.'<br><br>Este archivo ha sido a�adido por <strong>'.
				$this->Session->read('user').'</strong>';

				$email->sendAs = 'html';
				$email->emailFormat('html');
				$email->send($texto); */
				$this->Session->setFlash(__('El documento ha sido cargado exitosamente'));
				$this->redirect(array('controller'=>'documentos',  'action'=>'index', $id_cat));
			}

			else {
				$this->Session->setFlash(__('El documento no ha podido cargarse'));
			}
		}
	}


	//termino de la funci�n de borrado

	public function beforeFilter() {
		//	parent::beforeFilter();
		$this->Auth->allow('index');
	}

	function index($id_cat = null)
	{
		$this->Session->write('id', $id_cat);
		
		if ( $this->RequestHandler->isAjax() ) {

			Configure::write ( 'debug', 0 );
			$this->autoRender=false;
			$objetos=$this->Categoria->find('all', array('conditions' => array('$or' =>  array(
					array("documentos.Titulo" => array('$regex' => new MongoRegex('/.*'.$_GET['term'].'*./i'))),
					array("documentos.archivo.name" => array('$regex' => new MongoRegex('/.*'.$_GET['term'].'*./i')))
			))));
			$i=0;
			$response[$i]['value']= $_GET['term'];
			$response[$i]['label']= "No se encontraron resultados";

			foreach($objetos as $objeto):
				
			if(!empty($objeto['documentos']))
			{
				if(empty($documentos))
					$documentos = $objeto['documentos'];
			}
				

			$documentos = array();
			if(!empty($objeto['Categoria']['documentos'])){
				foreach ($objeto['Categoria']['documentos'] as $documento){

					if((stripos($documento['Titulo'], $_GET['term'])!==false)||(stripos($documento['archivo']['name'], $_GET['term'])!==false)){
						{
							array_push($documentos, $documento);
						}
					}
				}
			}
				
			if(!empty($documentos)) {
					
				foreach ($documentos as $documento){
					if (empty($id_cat))
						$puntos = null;
					else
						$puntos = "../../";

					$img = "<img src='".$puntos."img/file.png' height='36'>";
					if(strpos($documento['archivo']['type'], 'word')){
						$img = "<img src='".$puntos."img/docs.png' height='36'>";
					}
					if(strpos($documento['archivo']['type'], 'sheet')){
						$img = "<img src='".$puntos."img/xls.png' height='36'>";
					}
					if(strpos($documento['archivo']['type'], 'presentation')){
						$img = "<img src='".$puntos."img/ppt.png' height='36'>";
					}
					if(strpos($documento['archivo']['type'], 'pdf')){
						$img = "<img src='".$puntos."img/pdf.png' height='36'>";
					}
					if(strpos($documento['archivo']['type'], 'mage')){
						$img = "<img src='".$puntos.$documento['archivo']['url']."' height='36'>";
					}



					$response[$i]['value']=$documento['Titulo'];
					$response[$i]['label']= "<table border='0' cellpadding='0' cellspacing='0'>
							<tr onclick = \"window.location='/laboratorios/documentos/view/".$documento['id']."'\">
									<td align='center' width='36'>".$img."</td>
											<td align='left' valign='middle'>".$documento['Titulo']."
													<br><div style='font-size: 11px; color: #777;'>".$documento['archivo']['name']."<br>
															".number_format($documento['archivo']['size']/1024,2)." KB
																	</div>
																	</td></tr></table>";
					$i++;
				}

			}
			endforeach;

			echo json_encode($response);
		}

		if($id_cat==null){
			$id_cat = '517eb611398dacb818000004';
			$cpadre[0] = $this->Categoria->find('first', array('conditions' => array('id'=>$id_cat)));
			if(!empty($cpadre[0])){
				foreach($cpadre[0] as $cpadres){
					$id_catN = $cpadres['id'];
				}
			}
			$this->set('objetos', $cpadre[0]);
			$this->set('id_cat', $id_cat);
		}
		else
		{
			$i=0;
			$cpadre[0] = $this->Categoria->find('first', array('conditions' => array('id'=>$id_cat)));
			foreach($cpadre[$i] as $cpadres){
				$id_catN = $cpadres['id'];
			}
			$this->set('objetos', $cpadre[0]);
			$this->set('id_cat', $id_cat);

			while(empty($cpadre[$i]))
			{	
				if(!empty($cpadre[$i])){
					foreach($cpadre[$i] as $cpadres){
						$cpadreNext = $cpadres['cpadre'];
					}
				}

				$i++;
				$cpadre[$i] = $this->Categoria->find('first', array('conditions' => array('id'=>$cpadreNext)));
				if(!empty($cpadre[$i])){
					foreach($cpadre[$i] as $cpadres){
						$id_catN = $cpadres['id'];
					}
				}
			}
			$this->set('cpadres', $cpadre);
		}
			
		$this->set('carpetas', $this->Categoria->find('all', array('conditions' =>
				array('cpadre' => $id_cat),
				'order' => array('Categoria.nombre' => 'ASC')
		)));
			

		if (!$this->RequestHandler->isAjax()) {
			if (!empty($this->data)) {
				$this->Categoria->recursive = 0;

				if(!empty($this->request->data['Documento']['nombreDocumentos']))
					$objetos  = $this->Categoria->find('all', array('conditions' => array('$or' =>  array(
								
							array("documentos.Titulo" => array('$regex' => new MongoRegex('/.*'.$this->request->data['Documento']['nombreDocumentos'].'*./i'))),
							array("documentos.archivo.name" => array('$regex' => new MongoRegex('/.*'.$this->request->data['Documento']['nombreDocumentos'].'*./i')))
					))));
				$this->set('mensaje', "En una de las siguientes carpetas puedes encontrar el documento
						que buscas");
				$documentos = array();

				foreach($objetos as $objeto){

					if(!empty($objeto['Categoria']['documentos'])){
						foreach ($objeto['Categoria']['documentos'] as $documento){

							if((stripos($documento['Titulo'], $this->request->data['Documento']['nombreDocumentos'])!==false)
									||(stripos($documento['archivo']['name'], $this->request->data['Documento']['nombreDocumentos'])!==false)){
								{
									//array_merge($documentos, $documento);
									array_push($documentos, $documento);
								}
							}
						}
					}
				}
					
				$this->set('objetos', $objetos);
				$this->set('documentos',  $documentos);
				$this->set('carpetas', $objetos);

			}
				
		}
		
	}


	function autocomplete() {
		$terms = $this->Categoria->find('all', array('conditions' =>
				array("documentos.Titulo" => array('$regex' => new MongoRegex('/.*'.$_GET['term'].'*./i')))
				,
				'order'=>'nombre',
				'limit'=>10,
				'recursive'=>-1,
		));
			
		$terms = Set::Extract($terms,'{n}.Categoria.nombre');
		$this->layout = 'ajax';
		$this->set('terms', $terms);

	}
	//FIN DE AUTOCOMPLETE

	public function edit($id_cat = null)
	{
		$this->Session->write('id', $id_cat);
		$tempuser = $this->isAuthorized();
		$admin = $this->Session->read('admin');

		if($admin != 1)
			$tempuser = false;

		if($tempuser){
			$this->set('id_doc', $id_cat);
			$id_doc = $id_cat;
			$temp = explode('-', $id_cat);
			$usuarios = $this->usuarios();
			$this->set('usuarios', $usuarios);

			$array_usuarios_existentes = array();
			$u=0;
			foreach ($usuarios as $usuario){
				$tmp = $this->Categoria->find('first', array('conditions' => array('$and' => array(
						array('documentos.id'=>$id_doc),
						array('documentos.usuarios.username'=>$usuario['username'])))));
					
				if(!empty($tmp))
				{
					$array_usuarios_existentes[$u]=$usuario['username'];
					$u++;
				}
			}
			$this->set('existentes', $array_usuarios_existentes);

			$cats = $this->Categoria->find('first', array('conditions'=>array('nombre'=>'Obsoletos')));

			foreach($cats as $cat){
				$id_obs =  $cat["id"];
			}
			$this->set('id_obs',$id_obs);
			$id_cat = $temp[0];
			$this->set('id_cat', $id_cat);
			$i=0;
			$categorias = $this->Categoria->find('first', array('conditions'=>array('id'=>$id_cat)));

			$this->set('documentos', $categorias);

			foreach($categorias as $categoria){
				$nombre_cat = $categoria['nombre'];
				if($categoria['documentos'][$i]['id']==$id_doc){
					$documentoTemp = $categoria['documentos'][$i];
				}
				$i++;
			}
			$i=0;
			while(!empty($categorias)){
				foreach($categorias as $categoria){
						
					if(!empty($categorias['Categoria']['cpadre']))
						$id=$categorias['Categoria']['cpadre'];

					if(!empty($categorias['Categoria']['propiedades'])){
						$propiedades1 = $categorias['Categoria']['propiedades'];
						foreach($propiedades1 as $propiedades2){
							$propiedades[$i] = $propiedades2;
							$i++;
						}
					}
				}
				if(!empty($id))
				{
					$categorias = $this->Categoria->find('first', array('conditions'=>array('id'=>$id)));
					if($id=='517eb611398dacb818000004')
						$id=null;
				}
				else
					$categorias = null;
			}
			$this->set('propiedades', $propiedades);

			if ($this->request->is('post')) {
				if($this->request->data['Documento']['nueva_version']=='1'){

					$documentoTemp['id']=$id_obs.'-'.rand();
					$this->Categoria->save(array('id' => $id_obs,'$push' => array('documentos' =>$documentoTemp)));
				}
					
				$array_campos['id'] = $id_cat;
				$pos = $this->request->data['Documento']['pos'];
					
				if(!empty($this->request->data['Documento']['archivo']['tmp_name'])){
					$id_doc = $this->request->data['Documento']['id_categoria'].'-'.rand();
					$path = empty($path) ? WWW_ROOT.'files/'.$id_doc.'-'.$this->data['Documento']['archivo']['name'] : $path;
					$path2 = $path;
					$path = "/files/".$id_doc.'-'.$this->data['Documento']['archivo']['name'];
					move_uploaded_file($this->data['Documento']['archivo']['tmp_name'], $path2);
					$id_categoria = $this->request->data['Documento']['id_categoria'];

					//$array_campos['documentos.'.$pos.'.']['archivo'] = $this->request->data['Documento']['archivo'];
					$array_campos['documentos.'.$pos.'.archivo.url'] = $path;
					$array_campos['documentos.'.$pos.'.archivo.name'] = $this->request->data['Documento']['archivo']['name'];
					$array_campos['documentos.'.$pos.'.archivo.size'] = $this->request->data['Documento']['archivo']['size'];
					$array_campos['documentos.'.$pos.'.archivo.type'] = $this->request->data['Documento']['archivo']['type'];
				}
					
				for($j=0; $j<=$i-1; $j++){
					$nombre_input = $propiedades[$j]['nombre'];
					$array_campos['documentos.'.$pos.'.'.$nombre_input] = $this->request->data['Documento'][$nombre_input];
				}
				$array_campos['documentos.'.$pos.'.comentarios'] = $this->request->data['Documento']['comentarios'];
					
				//PERMISOS DE USUARIOS
				for($k=0;$k<=count($array_usuarios_existentes)-1; $k++){
					$this->Categoria->save(array('id' => $id_cat, '$unset' =>
							array('documentos.'.$pos.'.usuarios.'.$k.'.username' => $array_usuarios_existentes[$k])));
				}
				//inclusion de usuarios//
				$array_usuarios = array();
				$u=0;
				foreach($usuarios as $usuario){
					if($this->request->data['Documento'][$usuario['username']]==1)
					{
						$array_campos['documentos.'.$pos.'.usuarios.'.$u.'.username']=$usuario['username'];
						$u++;
					}
				}
				//FIN PERMISOS//
					

				if($this->Categoria->save($array_campos)){
					$this->Session->setFlash(__('El documento ha sido cargado exitosamente'));
					$this->redirect(array('controller'=>'documentos', 'action' => 'index', $id_cat));

				}

				else {
					$this->Session->setFlash(__('El documento no ha podido cargarse'));
				}
			}
		}
		else {
			$this->Session->setFlash(__(utf8_encode('El usuario no est� registrado o no tiene permisos para ingresar a esta secci�n')));
			$this->redirect(array('controller' => 'categorias', 'action' => 'validar'));
		}
	}

	public function delete($id = null){
		$this->Session->write('id', $id);
		$tempuser = $this->isAuthorized();
		
		$admin = $this->Session->read('admin');
		if($admin != 1)
			$tempuser = false;

		if($tempuser){
			$temp =  explode("-", $id);

			$id_categoria = $temp[0];
			$id_doc= $temp[1];

			$categorias = $this->Categoria->find('first', array('conditions'=>array('id'=>$id_categoria)));

			foreach($categorias as $categoria){
				$documentos = $categoria['documentos'];
				foreach($documentos as $documento){
					if($documento['id']==$id){
						$url = $documento['archivo']['url'];
					}
				}
			}
			$path = empty($path) ? WWW_ROOT.$url : $path;
			unlink($path);

			$this->Categoria->save(array('id' => $id_categoria,
					'$pull' => array("documentos" => array('id' => $id))));

			$this->Session->setFlash(__('Documento eliminado exitosamente'));
			$this->redirect(array('controller'=>'documentos', 'action' => 'index', $id_categoria));
		}
		else {
			$this->Session->setFlash(__(utf8_encode('El usuario no est� registrado o no tiene permisos para ingresar a esta secci�n')));
			$this->redirect(array('controller' => 'categorias', 'action' => 'validar'));
		}
	}

	///FIN DE LA FUNCI�N DE CAMBIO DE CLAVE

	function isAuthorized() {
		$temp = $this->Session->read('user');
		$id = $this->Session->read('id');
		$control = false;
		$categorias = $this->Categoria->find('first', array('conditions' => array('id' => $id)));
		if(!empty($categorias)){
			foreach($categorias as $categoria){
				if(!empty($categoria['usuarios']))
					$usuarios = $categoria['usuarios'];
			}
		}
		if(!empty($usuarios)){
			foreach($usuarios as $usuario){
				if($usuario['username']==$temp){
					$control = true;
				}
			}
		}
		else{
			$control = true;
		}
		if((!empty($temp))&&($control))
			return true;
		else
		{
			return false;
			$this->Session->setFlash(__('Usted no posee los privilegios para ingresar en esta p�gina'));
		}
		 
	}

}
