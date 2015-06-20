<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Clinics extends Authenticated_Controller
{

	//=======================================================================================
		
		public function __construct()
		{
			parent::__construct();
			$this->load->model('clinics_model', null, true);
			$this->load->model('doctors_clinic_model', null, true);
			$this->load->model('countries/countries_model', null, true);
			$this->load->model('state/state_model', null, true);
			$this->load->model('cities/cities_model', null, true);
		}
		
	//=======================================================================================
	
		public function index()
		{
			if (isset($_POST['delete']))
			{
				$checked = $this->input->post('checked');
	
				if (is_array($checked) && count($checked))
				{
					$result = FALSE;
					foreach ($checked as $pid)
					{
						$result = $this->clinics_model->delete($pid);
					}
	
					if ($result)
					{
						Template::set_message(count($checked) .' '. 'record(s) successfully deleted.', 'success');
					}
					else
					{
						Template::set_message('We could not delete the record:' . $this->clinics_model->error, 'error');
					}
				}
			}

			$this->db->select('clinics.*');
			$this->clinics_model->where('clinics.deleted',0);
			$this->db->join('doctors_clinic','clinics.id = doctors_clinic.clinic_id');
			$this->clinics_model->where('doctors_clinic.doctor_id',$this->current_user->id);
			$records = $this->clinics_model->find_all();
			Template::set('records',$records);
			Template::set('userid',$this->current_user->id);
			Template::render();
		}	
	
	//=======================================================================================
		
		public function add()
		{
			$id = $this->current_user->id;
			if (!empty($_POST))
			{
				$this->form_validation->set_rules($this->get_validation_rules('add'));
				if($this->form_validation->run($this))
				{
					if ($clinic_id = $this->clinics_model->insert($_POST))
					{
						Template::set_message('Clinic added successfully', 'success');
						redirect('clinics/');
					}
					else
					{
						Template::set('userid', $id);
						Template::set_message('Error adding clinic.', 'alert alert-danger alert-dismissabl');
					}
				}
				else
				{
					$country_array = array();
					$state_array = array();
					$city_array = array();
					
					$this->countries_model->where('deleted',0);
					$countries = $this->countries_model->find_all();
					foreach($countries as $country)
					{
						$country_array[$country->id] = $country;
					}
					Template::set('countries',$country_array);
					
					$this->state_model->where('deleted',0);
					$states = $this->state_model->find_all();
					foreach($states as $state)
					{
						$state_array[$state->id] = $state;
					}
					Template::set('states',$state_array);
					
					$this->cities_model->where('deleted',0);
					$cities = $this->cities_model->find_all();
					foreach($cities as $city)
					{
						$city_array[$city->id] = $city;
					}
					Template::set('cities',$city_array);
				
					Template::set('userid', $id);
					Template::set_message('Error adding clinic.', 'alert alert-danger alert-dismissabl');
				}
			}
			
			Template::set('userid', $id);
			Template::set('page_title','Add Clinics');
			Template::render();
		}	
		
	//=======================================================================================
	
	public function edit($id = false) 
	{
		if($id)
		{
			$this->clinics_model->where('deleted', 0);
			$clinics = $this->clinics_model->find($id);
			if($clinics)
			{
				if($_POST)
				{
					$this->form_validation->set_rules($this->get_validation_rules('edit'));
					if ($this->form_validation->run($this)) 
					{
						 $_POST['doctor_id'] = $this->current_user->id;
						 if($this->clinics_model->update($id, $_POST))
						 {
						 	Template::set_message('Rrecord updated.','success');
							Template::redirect('clinics/');
						 }
						 else
						 {
							Template::set_message('Error updating Record.','error'); 	
						 }
					}			
				}
				
				// Get Select Country, State and City for selected these on UI.
				$country_array = array();
				$state_array = array();
				$city_array = array();
				
				$this->countries_model->where('deleted',0);
				$countries = $this->countries_model->find_all();
				foreach($countries as $country)
				{
					$country_array[$country->id] = $country;
				}
				Template::set('countries',$country_array);
				
				$this->state_model->where('deleted',0);
				$states = $this->state_model->find_all();
				foreach($states as $state)
				{
					$state_array[$state->id] = $state;
				}
				Template::set('states',$state_array);
				
				$this->cities_model->where('deleted',0);
				$cities = $this->cities_model->find_all();
				foreach($cities as $city)
				{
					$city_array[$city->id] = $city;
				}
				Template::set('cities',$city_array);
				
				//==============================================================
				
				Template::set('clinic_id',$id);
				Template::set('clinics',$clinics);
				Template::render();
			} 
			else 
			{
				Template::set_message('Record doesn\'t exist or has been deleted.','error');
				Template::redirect('clinics/');
			}
		}
		else
		{
			Template::redirect('clinics/');
		}
	}
	

	//==================================================================================
	
		public function delete($id = false) 
		{
			if ($id) 
			{
				if ($this->clinics_model->find($id)) 
				{
					$this->clinics_model->delete($id);
					Template::set_message('Clinic deleted successfully','success');
				} 
				else 
				{
					Template::set_message('Record doesn\'t exist','error');
				}
			}
			
			redirect('clinics/');
		}
	
	//==================================================================================
	
		private function get_validation_rules($group)
		{
			$validationRules = array();
	
			switch ($group)
			{
				case 'add':
					$validationRules = array(
						array(
						'field' => 'clinic_name',
						'label' => 'Clinic name',
						'rules' => 'trim|required|max_length[100]|xss_clean',
						),
						array(
						'field' => 'address_line1',
						'label' => 'Address',
						'rules' => 'trim|required|max_length[100]|xss_clean'
						),
						array(
						'field' => 'address_line2',
						'label' => 'Speciality',
						'rules' => 'trim|max_length[100]|xss_clean'
						),
						array(
						'field' => 'latitude',
						'label' => 'Latitude',
						'rules' => 'trim|max_length[100]|xss_clean'
						),
						array(
						'field' => 'longitude',
						'label' => 'Longitude',
						'rules' => 'trim|max_length[100]|xss_clean'
						),
						array(
						'field' => 'fees',
						'label' => 'Fees',
						'rules' => 'trim|xss_clean'
						),
						array(
						'field' => 'country',
						'label' => 'Country',
						'rules' => 'trim|required|xss_clean'
						),
						array(
						'field' => 'state',
						'label' => 'State',
						'rules' => 'trim|required|xss_clean'
						),
						array(
						'field' => 'city',
						'label' => 'City',
						'rules' => 'trim|required|xss_clean'
						),
					);
					break;
	
					case 'edit':
						$validationRules = array(
						array(
						'field' => 'clinic_name',
						'label' => 'Clinic name',
						'rules' => 'trim|required|max_length[100]|xss_clean',
						),
						array(
						'field' => 'address_line1',
						'label' => 'Address',
						'rules' => 'trim|required|max_length[100]|xss_clean'
						),
						array(
						'field' => 'address_line2',
						'label' => 'Speciality',
						'rules' => 'trim|max_length[100]|xss_clean'
						),
						array(
						'field' => 'latitude',
						'label' => 'Latitude',
						'rules' => 'trim|max_length[100]|xss_clean'
						),
						array(
						'field' => 'longitude',
						'label' => 'Longitude',
						'rules' => 'trim|max_length[100]|xss_clean'
						),
						array(
						'field' => 'fees',
						'label' => 'Fees',
						'rules' => 'trim|xss_clean'
						),
						array(
						'field' => 'country',
						'label' => 'Country',
						'rules' => 'trim|required|xss_clean'
						),
						array(
						'field' => 'state',
						'label' => 'State',
						'rules' => 'trim|required|xss_clean'
						),
						array(
						'field' => 'city',
						'label' => 'City',
						'rules' => 'trim|required|xss_clean'
						),
					);
					break;
			}
			
			return $validationRules;
		}
		
	//=======================================================================================	
	
	public function checkname($name)
	{
		$id = $this->uri->segment(3);
		$query = "select name from bf_doctors_clinic where name = '$name' and deleted = 0 and id <> $id";
		$records =  $this->db->query($query)->result();
		if($records && !empty($records))
		{
			$this->form_validation->set_message('checkname', 'This clinic name is already used.Try with other name.');
			return false;
		}
		else
		{
			return true;
		}
	}
}