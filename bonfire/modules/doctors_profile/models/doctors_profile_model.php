<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Doctors_profile_model extends BF_Model 
{
	protected $table = 'doctors';
	protected $soft_deletes = TRUE;
	protected $date_format = 'datetime';
	protected $set_created = FALSE;
	protected $set_modified = FALSE;
	protected $key			= "user_id";
	
	//------------------------------------------------------------------------------
	
	public function update($input = array())
	{
		$data = array(
			'first_name'	    	=> $input['first_name'],
			'middle_name'	    	=> isset($input['middle_name'])?$input['middle_name']:NULL,
			'last_name'	    		=> $input['last_name'],
			'gender'	    		=> $input['gender'],
			'dob'	    			=> date("Y-m-d", strtotime($input['dob'])),
			'country'	    		=> $input['country'],
			'state'	    			=> $input['state'],
			'city'		    		=> $input['city'],
			'address_line1'	    	=> $input['address_line1'],
			'address_line2'	    	=> isset($input['address_line2'])?$input['address_line2']:NULL,
			'latitude'	    		=> isset($input['latitude'])?$input['latitude']:NULL,
			'longitude'	    		=> isset($input['longitude'])?$input['longitude']:NULL,
			'mobile2'	    		=> isset($input['mobile2'])?$input['mobile2']:NULL,
			'landline'	    		=> isset($input['landline'])?$input['landline']:NULL,
			'website'	    		=> isset($input['website'])?$input['website']:NULL,
			'overview'	    		=> isset($input['overview'])?$input['overview']:NULL,
			);
			
		return parent::update($input['id'], $data);
	}
	
	//------------------------------------------------------------------------------
	
	public function update_educational_info($id , $data)
	{
		$data = array(
			'education'	    	=> $data,
			);
			
		return parent::update($id, $data);
	}
	
	//------------------------------------------------------------------------------
	
	public function udpate_image($data)
	{
		$insert_data = array(
			'photo'	    	=> $data['photo'],
			);
			
		return parent::update($data['user_id'], $insert_data);
	}
	
	//------------------------------------------------------------------------------
	
}	