<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Clinics_model extends BF_Model 
{

	protected $table = 'clinics';

	protected $soft_deletes = TRUE;

	protected $date_format = 'datetime';

	protected $set_created = TRUE;
	
	protected $set_modified = TRUE;
	
	//==============================================================================
	
	public function insert($input = array())
	{
		$data = array(
			'name'	    			=> $input['clinic_name'],
			'address_line1'	    	=> $input['address_line1'],
			'country'		    	=> $input['country'],
			'state'	    			=> $input['state'],
			'city'			    	=> $input['city'],
			'address_line2'	    	=> !empty($input['address_line2'])?$input['address_line2']:null,
			'latitude'	    		=> !empty($input['latitude'])?$input['latitude']:null,
			'longitude'	    		=> !empty($input['longitude'])?$input['longitude']:null,
			'fees'	    			=> !empty($input['fees'])?$input['fees']:null,
			'deleted' 				=> 0,
		);
		
		if ($clinic = parent::insert($data))
		{
			$data_n = array(
				'doctor_id'		=> $input['doctor_id'],
				'clinic_id'		=> $clinic,
			);
			$this->doctors_clinic_model->insert($data_n);
			return $clinic;
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
			'name'	    			=> $input['clinic_name'],
			'address_line1'	    	=> $input['address_line1'],
			'country'		    	=> $input['country'],
			'state'	    			=> $input['state'],
			'city'			    	=> $input['city'],
			'address_line2'	    	=> !empty($input['address_line2'])?$input['address_line2']:null,
			'latitude'	    		=> !empty($input['latitude'])?$input['latitude']:null,
			'longitude'	    		=> !empty($input['longitude'])?$input['longitude']:null,
			'fees'	    			=> !empty($input['fees'])?$input['fees']:null,
			'deleted' 				=> 0,
		);
		return parent::update($id, $data);
	}
	
	//==============================================================================
}	