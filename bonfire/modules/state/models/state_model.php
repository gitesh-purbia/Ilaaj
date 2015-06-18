<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class State_model extends BF_Model 
{

	protected $table = 'state';

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
			'country_id'	    	=> $input['country_name'],
			'deleted' 				=> 0,
		);

		if ($state = parent::insert($data))
		{
			return $state;
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
			'country_id'	    	=> $input['country_name'],
			'deleted' 				=> 0,
			);
		
		return parent::update($id, $data);
	}
	
	//==============================================================================
	
	public function find_all()
	{
		parent::where('deleted',0);
	    return parent::find_all();
	}
}	