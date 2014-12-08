<?php

class User extends AppModel {
	
	var $validateFile = array(
			'size' => 2048000,
			'type' => 'jpg,jpeg,png,gif'
	);
	
	public $validate = array(
			'username' => array(
					'required' => array(
							'rule' => array('notEmpty'),
							'message' => 'El campo es requerido'
					)
			),
			'password' => array(
					'required' => array(
							'rule' => array('notEmpty'),
							'message' => 'El campo es requerido'
					)
			),
			'Confirmar_password' => array(
					'required' => array(
							'rule' => array('notEmpty'),
							'message' => 'El campo es requerido'
					)
			),
			'role' => array(
					'valid' => array(
							'rule' => array('inList', array('admin', 'author')),
							'message' => 'Please enter a valid role',
							'allowEmpty' => false
					)
			),
			'imagen' => array(
					'rule' => array('extension', array('gif', 'jpeg', 'png', 'jpg')),
					'message' => 'Please supply a valid image.'
						)
		);
	
	public function MatchPasswords($data){
		if($data['password']==$this->data['Confirmar_password']){
			return true;
		}
		else{
			return false;
		}
	}
	
	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}
		return true;
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
	
	function handleFileUpload($fileData, $fileName)
	{
		$error = false;
	
		//Get file type
		$typeArr = explode('/', $fileData['type']);
	
		//If size is provided for validation check with that size. Else	compare the size with INI file
		if (($this->validateFile['size'] && $fileData['size'] > $this->validateFile['size']) || $fileData['error'] == UPLOAD_ERR_INI_SIZE)
		{
			$error = 'File is too large to upload';
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
	
	
}