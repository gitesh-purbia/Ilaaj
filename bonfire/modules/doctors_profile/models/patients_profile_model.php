<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Patients_profile_model extends BF_Model 
{
	protected $table = 'patients';
	protected $soft_deletes = TRUE;
	protected $date_format = 'datetime';
	protected $set_created = FALSE;
	protected $set_modified = FALSE;
	
	//==============================================================================
	
	public function insert($input = array())
	{
		$data = array(
			'name'	    			=> $input['name'],
			'deleted' 				=> 0,
		);

		if ($speciality = parent::insert($data))
		{
			return $speciality;
		}
		else
		{
			return FALSE;
		}
	}
	
	//==============================================================================

	public function update($id , $input = array())
	{
		$data = array(
			'name'	    			=> $input['name'],
			'deleted' 				=> 0,
			);
		
		return parent::update($id, $data);
	}
	
	//==============================================================================
}	