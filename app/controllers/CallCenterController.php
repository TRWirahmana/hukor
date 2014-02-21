<?php
class CallCenterController extends BaseController {

    protected $layout = 'layouts.admin';

    public function index(){
	$user = Auth::user();
    	$call = CallCenter::find(1);
// var_dump($call);
// exit;
    	$this->layout = View::make('layouts.master');	
	$this->layout->content = View::make('callcenter.index',
				    array(				
				    	'call' => $call,
				    	'user' => $user
					));
	}

    public function home(){
	$call = CallCenter::find(1);

	if(null != $call) {
		$this->layout->content = View::make('callcenter.form',
		    array(				
			'form_opts' => array(
				'route' => array('admin.callcenter.update', $call->id),
					'method' => 'put',
					'class' => 'form-horizontal',
					    'id' => 'callcenter-form',
						'files' => true
					),   	
			    	'call' => $call,
			));
		} else {
			$this->layout->content = View::make('callcenter.form',
			    array(				
					'form_opts' => array(
						'route' => array('admin.callcenter.update',0),
						'method' => 'put',
						'class' => 'form-horizontal',
					    'id' => 'callcenter-form',
						'files' => true
					),   	
			    	'call' => $call,
			));
		}
    }

	public function update($id)
	{
 		$call = CallCenter::find($id);
		if(null == $call){
			$call = new CallCenter();			
		}		
		$call->id = 1; // default id
 		$call->email = Input::get('email');
 		$call->fax = Input::get('fax');
		$call->alamat = Input::get('alamat');
 		$call->telp = Input::get('telp');

 		if($call->save()){
			return Redirect::to('admin/editcallcenter')->with('success', 'Data berhasil diubah.');
 		}
    }

}
