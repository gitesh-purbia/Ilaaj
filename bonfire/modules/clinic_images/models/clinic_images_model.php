<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Clinic_images_model extends BF_Model 
{

	protected $table = 'clinic_images';

	protected $soft_deletes = TRUE;

	protected $date_format = 'datetime';

	protected $set_created = FALSE;
	
	protected $set_modified = FALSE;
	
	//==============================================================================
	
	public function insert($insert = array())
	{
		$data = array(
			'clinic_id'			=> $insert['clinic_id'],
			'image'	    		=> $insert['image'],
		);
		
		if ($clinic_image = parent::insert($data))
		{
			 return $clinic_image;
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