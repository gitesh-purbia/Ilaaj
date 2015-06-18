<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class user_profile_model extends BF_Model 
{

	protected $table = 'users';
	
	protected $soft_deletes = TRUE;

	protected $date_format = 'datetime';

	protected $set_created = TRUE;
	
	protected $set_modified = TRUE;
	
	protected $log_user 	= TRUE;
	
	//==============================================================================
	
	public function update($id , $input = array())
	{
		$data = array(
			'email'	    			=> $input['email'],
			'username'	    		=> $input['username'],
			'display_name'	    	=> $input['display_name'],
			'password'	   			=> $input['password'],
		);
		if ($users = $this->user_model->update($id, $data))
		{
			return $users;
		}
		else
		{
			return FALSE;
		}
	}
	//==============================================================================
}	