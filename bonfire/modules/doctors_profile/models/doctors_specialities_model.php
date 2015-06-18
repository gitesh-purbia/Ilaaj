<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Doctors_specialities_model extends BF_Model 
{
	protected $table = 'doctors_specialities';
	protected $soft_deletes = TRUE;
	protected $date_format = 'datetime';
	protected $set_created = FALSE;
	protected $set_modified = FALSE;
	
	//==============================================================================
	
	public function insert($doctor_id , $input)
	{
		$data = array(
			'doctor_id'	    		=> $doctor_id,
			'speciality_id' 		=> $input,
			'deleted'	    		=> 0,
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