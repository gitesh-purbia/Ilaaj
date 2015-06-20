<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Clinic_time_slots extends Authenticated_Controller
{

	//=======================================================================================
		
		public function __construct()
		{
			parent::__construct();
			$this->load->model('clinic_time_slots_model', null, true);
		}
		
	//=======================================================================================
	
		public function index($id = false)
		{
			if($id)
			{
				if (isset($_POST['delete']))
				{
					$checked = $this->input->post('checked');
		
					if (is_array($checked) && count($checked))
					{
						$result = FALSE;
						foreach ($checked as $pid)
						{
							$result = $this->clinic_time_slots_model->delete($pid);
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
				
				$query = "SELECT *, GROUP_CONCAT(time_from,'-',time_to SEPARATOR ', ') time FROM bf_clinic_time_slots where clinic_id = $id  and deleted = 0 GROUP BY day order by id asc";
				$records = $this->db->query($query);
				//ar_dump($records->result()); die();
				Template::set('records',$records->result());
				Template::set('clinic_id',$id);
				Template::render();
			}
			else{
				redirect('clinics/');
			}
		}	

		//===============================================================================================

		public function edit($id = false)
		{
			if($id)
			{
				if (!empty($_POST))
				{
					$post_array = $_POST;
					$days_array =  array(
										'monday', 
										'tuesday', 
										'wednesday', 
										'thursday', 
										'friday', 
										'saturday', 
										'sunday', 
									);
										
					$this->form_validation->set_rules($this->get_validation_rules('add'));
					if($this->form_validation->run($this))
					{
						$query = 'delete from bf_clinic_time_slots where clinic_id ='.$id;
						$this->db->query($query);
						$success = false;
						foreach ($days_array as $day) {
							if($post_array['opening_time_'.$day]){
								foreach ($post_array['opening_time_'.$day] as $key => $time) 
								{
									if($this->clinic_time_slots_model->insert($id,$day,$time,$post_array['closing_time_'.$day][$key]))
									{
										$success = true;
									}
								}
							}					
						}
						if ($success)
						{
							Template::set_message('Record Updated', 'success');
							redirect('clinic_time_slots/index/'.$id);
						}
						else
						{
							Template::set('userid', $id);
							Template::set_message('Error updating record.', 'alert alert-danger alert-dismissabl');
						}
					}
					else
					{
						Template::set('userid', $id);
						Template::set_message('Error updating record.', 'alert alert-danger alert-dismissabl');
					}
				}
				$this->clinic_time_slots_model->where('deleted', 0);
				$this->clinic_time_slots_model->where('clinic_id', $id);
				$timings = $this->clinic_time_slots_model->find_all();
				Template::set('records',$timings);
				Template::set('clinic_id',$id);
				Template::render();
			}
			else
			{
				redirect('clinics/');
			}
		}	
	
	//=======================================================================================
		
		public function add($id = false)
		{
			if (!empty($_POST))
			{
				$post_array = $_POST;
				$days_array =  array(
									'monday', 
									'tuesday', 
									'wednesday', 
									'thursday', 
									'friday', 
									'saturday', 
									'sunday', 
								);
									
				$this->form_validation->set_rules($this->get_validation_rules('add'));
				if($this->form_validation->run($this))
				{
					$success = false;
					foreach ($days_array as $day) 
					{
						if($post_array['opening_time_'.$day])
						{
							foreach($post_array['opening_time_'.$day] as $key => $time) 
							{
								if($time == null || $time == ''){
									$opening_time = 'Off';} else {
										$opening_time = $time;
									}
								if($post_array['closing_time_'.$day][$key] == null || $post_array['closing_time_'.$day][$key] ==''){
									$closing_time = 'Off'; } else {
										$closing_time = $post_array['closing_time_'.$day][$key];
									}
								if($this->clinic_time_slots_model->insert($id,$day,$opening_time,$closing_time))
								{
									$success = true;
								}
							}
						}					
					}
					if ($success)
					{
						Template::set_message('Clinic added successfully', 'success');
						redirect('clinic_time_slots/index/'.$id);
					}
					else
					{
						Template::set('userid', $id);
						Template::set_message('Error adding clinic.', 'alert alert-danger alert-dismissabl');
					}
				}
				else
				{
					Template::set('userid', $id);
					Template::set_message('Error adding clinic.', 'alert alert-danger alert-dismissabl');
				}
			}
			
			Template::set('clinic_id', $id);
			Template::set('page_title','Add Clinic Timeslots');
			Template::render();
		}	
		
	//=======================================================================================
	
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
						'field' => 'opening_time_monday[]',
						'label' => 'Opening Time for Monday',
						'rules' => 'trim|max_length[100]|xss_clean',
						),
						array(
						'field' => 'closing_time_monday[]',
						'label' => 'Closing Time for Monday',
						'rules' => 'trim|max_length[100]|xss_clean',
						),
						array(
						'field' => 'opening_time_tuesday[]',
						'label' => 'Opening Time for Tuesday',
						'rules' => 'trim|max_length[100]|xss_clean',
						),
						array(
						'field' => 'closing_time_tuesday[]',
						'label' => 'Closing Time for Tuesday',
						'rules' => 'trim|max_length[100]|xss_clean',
						),
						array(
						'field' => 'opening_time_wednesday[]',
						'label' => 'Opening Time for Wednesday',
						'rules' => 'trim|max_length[100]|xss_clean',
						),
						array(
						'field' => 'closing_time_wednesday[]',
						'label' => 'Closing Time for Wednesday',
						'rules' => 'trim|max_length[100]|xss_clean',
						),
						array(
						'field' => 'opening_time_thursday[]',
						'label' => 'Opening Time for Thursday',
						'rules' => 'trim|max_length[100]|xss_clean',
						),
						array(
						'field' => 'closing_time_thursday[]',
						'label' => 'Closing Time for Thursday',
						'rules' => 'trim|max_length[100]|xss_clean',
						),
						array(
						'field' => 'opening_time_friday[]',
						'label' => 'Opening Time for Friday',
						'rules' => 'trim|max_length[100]|xss_clean',
						),
						array(
						'field' => 'closing_time_friday[]',
						'label' => 'Closing Time for Friday',
						'rules' => 'trim|max_length[100]|xss_clean',
						),
						array(
						'field' => 'opening_time_saturday[]',
						'label' => 'Opening Time for Saturday',
						'rules' => 'trim|max_length[100]|xss_clean',
						),
						array(
						'field' => 'closing_time_saturday[]',
						'label' => 'Closing Time for Saturday',
						'rules' => 'trim|max_length[100]|xss_clean',
						),
						array(
						'field' => 'opening_time_sunday[]',
						'label' => 'Opening Time for Sunday',
						'rules' => 'trim|max_length[100]|xss_clean',
						),
						array(
						'field' => 'closing_time_sunday[]',
						'label' => 'Closing Time for Sunday',
						'rules' => 'trim|max_length[100]|xss_clean',
						),
					);
					break;
			}
			
			return $validationRules;
		}
		
	//=======================================================================================	
	
}