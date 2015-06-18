<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Specialities_model extends BF_Model 
{

	protected $table = 'specialities';

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
	
	public function find_all()
	{
		parent::where('deleted',0);
	    return parent::find_all();
	}
}	