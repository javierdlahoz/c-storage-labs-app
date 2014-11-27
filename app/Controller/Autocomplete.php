<?php
class AutocompleteController extends AppController {

	public function fetch($model, $field, $field2, $field3, $query) {

		$this->loadModel($model);

		$results = $this->$model->find('all', array(
				'conditions'=>
						array('$or' =>  array(
								array($field1 => array('$regex' => new MongoRegex('/.*'.$query.'*./'))),
								array($field2 => array('$regex' => new MongoRegex('/.*'.$query.'*./'))),
								array($field3 => array('$regex' => new MongoRegex('/.*'.$query.'*./')))
						)),
						'order'=>$field1,
						'limit'=>10,
						'recursive'=>-1,
						));
						
					
		$this->set(compact('results'));

	}

}