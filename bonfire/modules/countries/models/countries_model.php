<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class countries_model extends BF_Model 
{

	protected $table = 'countries';

	
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
			'deleted' 				=> 0,
		);

		if ($countries = parent::insert($data))
		{
			return $countries;
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
		
		if ($countries = parent::update($id, $data))
		{
			return $countries;
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