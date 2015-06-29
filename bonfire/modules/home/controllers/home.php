<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends Authenticated_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('users/user_model');
		$this->load->model('doctors_profile/doctors_profile_model');
		$this->load->model('users/user_model');
		$this->load->model('home_model');
	}
	
	//--------------------------------------------------------------------
	
	public function index()
	{
		// Get Login user Role id and user id
		$role = $this->current_user->role_id;
		$id =  $this->current_user->id;
		$user = $this->user_model->find($id);
		if($role == DOCTORS)
		{
			$this->db->select('modified_on'); 
		    $this->db->from('doctors');   
		    $this->db->where('user_id', $id);
		    $doctor = $this->db->get()->result();
			if($doctor[0]->modified_on == null && $user->last_login == '0000-00-00 00:00:00')
			{
				redirect('doctor_profile/profile/'.$id);
			}
		}
		
		if($role == PATIENTS)
		{
			$this->db->select('modified_on'); 
		    $this->db->from('patients');   
		    $this->db->where('user_id', $id);
		    $patient = $this->db->get()->result();
			if($patient == null)
			{
				redirect('profile/patients_profile/'.$id);
			}
			$appointment_shedule = $this->home_model->get_patients_appointment($id);
			Template::set('appointment_shedule',$appointment_shedule);
			
		}
		
		Template::render();
	}

	//--------------------------------------------------------------------
	

}