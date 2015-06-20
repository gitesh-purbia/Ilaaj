<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Doctors_clinic_model extends BF_Model 
{

	protected $table = 'doctors_clinic';

	protected $soft_deletes = TRUE;

	protected $date_format = 'datetime';

	protected $set_created = FALSE;
	
	protected $set_modified = FALSE;
	
	//==============================================================================
	
	public function insert($input = array())
	{
		$data = array(
				'doctor_id'		=> $input['doctor_id'],
				'clinic_id'		=> $input['clinic_id'],
				'deleted'		=> 0
			);
		
		$doctor_clinic = parent::insert($data);
	}
	
	//==============================================================================

}	