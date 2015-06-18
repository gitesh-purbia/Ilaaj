<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Clinic_time_slots_model extends BF_Model 
{

	protected $table = 'clinic_time_slots';

	protected $soft_deletes = TRUE;

	protected $date_format = 'datetime';

	protected $set_created = TRUE;
	
	protected $set_modified = TRUE;
	
	//==============================================================================
	
	public function insert($id ,$day, $opening_time , $closing_time)
	{
		$data = array(
			'clinic_id'				=> $id,
			'day'					=> $day,
			'time_from'	    		=> $opening_time,
			'time_to'	    		=> $closing_time,
			'active'		    	=> 1,
			'deleted' 				=> 0,
		);
		
		if ($clinic_time_slots = parent::insert($data))
		{
			 return true;
		}
		else
		{
			return  FALSE;
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