<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class demo extends RestController{

	function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Usermodel','um');
        
    }
	public function user_get($id=0)
	{
		//if id not null then get data where id = $id

		$data=$this->um->getData('users',$id);
		if (!empty($data)) {
			
		$this->response($data,RestController::HTTP_OK);
		}
		else{
			$this->response(['status'=>false,'message'=>'no data found'],RestController::HTTP_NOT_FOUND);
		}
	}
	public function user_post()
	{
		$data=[
			'id'=>null,
			'name'=>$this->input->post('name'),
			'city'=>$this->input->post('city'),
			'spi'=>$this->input->post('spi'),
		];
		if(!empty($data['name']) && !empty($data['city']) && !empty($data['spi']))
		{
		$result=$this->um->insertData('users',$data);
		if($result)
		{
			$this->response(['status'=>true,'message'=>'user added sucessfully'],RestController::HTTP_OK);
		}
		else{
			$this->response(['status'=>false,'message'=>'something wrong '],RestController::HTTP_BAD_REQUEST);	
		}
		}
		else{
			$this->response(['status'=>false,'message'=>'all input field required '],RestController::HTTP_BAD_REQUEST);
		}	
	}

	public function user_put($id)
	{
	$data=[
			'name'=>$this->put('name'),
			'city'=>$this->put('city'),
			'spi'=>$this->put('spi'),
		];
	
	  $result=$this->um->updateData('users',$data,'id',$id);	
	 if($result)
		{
			$this->response(['status'=>true,'message'=>'user update sucessfully'],RestController::HTTP_OK);
		}
		else{
			$this->response(['status'=>false,'message'=>'something wrong'],RestController::HTTP_BAD_REQUEST);	
		}
	}
	public function user_delete($id=0)
	{
		if($id){
			$delete=$this->um->deleteData('users',$id);
			if($delete){
			$this->response(['status'=>true,'message'=>'user delete sucessfully'],RestController::HTTP_OK);	
			}
			else{
				$this->response(['status'=>false,'message'=>'something wrong '],RestController::HTTP_BAD_REQUEST);	
			}
		}
		else{
			$this->response(['status'=>false,'message'=>'user not found'],RestController::HTTP_NOT_FOUND);
		}	
	}
}
