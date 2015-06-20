<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Doctors_model extends BF_Model 
{

	protected $table = 'doctors';

	protected $soft_deletes = TRUE;

	protected $date_format = 'datetime';

	protected $set_created = FALSE;
	
	protected $set_modified = FALSE;
	
	protected $log_user 	= FALSE;
	
	//==============================================================================
	
}	