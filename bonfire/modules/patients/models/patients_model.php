<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class patients_model extends BF_Model 
{

	protected $table = 'patients';

	
	protected $soft_deletes = TRUE;

	protected $date_format = 'datetime';

	protected $set_created = TRUE;
	
	protected $set_modified = TRUE;
	
	protected $log_user 	= TRUE;
	
	//==============================================================================
	
	public function update($id,$input = array())
	{
		
		if ($patients = parent::update($id,$input))
		{
			return $patients;
			
		}
		else
		{
			return FALSE;
		}
	}
	
	//==============================================================================

	public function update_demo($id , $input = array())
	{
		$data = array(
			
			'name'	    			=> $input['name'],
			'state_id'				=>$input['states'],
			
			'deleted' 				=> 0,
			);
		
		if ($cities = parent::update($id, $data))
		{
			return $cities;
		}
		else
		{
			return FALSE;
		}
	}
	//==============================================================================
	
	public function find_all()
	{
		parent::where('deleted',0);
	    return parent::find_all();
	}
}	