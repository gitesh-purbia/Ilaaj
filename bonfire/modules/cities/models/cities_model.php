<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class cities_model extends BF_Model 
{

	protected $table = 'cities';

	
	protected $soft_deletes = TRUE;

	protected $date_format = 'datetime';

	protected $set_created = TRUE;
	
	protected $set_modified = TRUE;
	
	protected $log_user 	= TRUE;
	
	//==============================================================================
	
	public function insert($input = array())
	{
		$data = array(
			'name'	    			=> $input['name'],
			'state_id'				=>$input['states'],
			'deleted' 				=> 0,
		);

		if ($cities = parent::insert($data))
		{
			return $cities;
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