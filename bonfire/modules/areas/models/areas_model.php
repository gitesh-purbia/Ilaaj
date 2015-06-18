<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Areas_model extends BF_Model 
{

	protected $table = 'areas';

	
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
			'city_id'				=>$input['city_name'],
			'deleted' 				=> 0,
		);

		if ($areas = parent::insert($data))
		{
			return $areas;
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
			'city_id'				=>$input['city_name'],
			
			'deleted' 				=> 0,
			);
		
		if ($areas = parent::update($id, $data))
		{
			return $areas;
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