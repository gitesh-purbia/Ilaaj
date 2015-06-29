<?php 
Class patients extends Authenticated_Controller
{

	//=======================================================================================
		
		public function __construct()
		{
			parent::__construct();
			$this->load->model('patients_model', null, true);	
					
		}
		
	//=======================================================================================
	
		public function index()
		{
				
			$states=$this->patients_model->find_all();
			Template::set('state',$states);	
			if (isset($_POST['delete']))
			{
				$checked = $this->input->post('checked');
	
				if (is_array($checked) && count($checked))
				{
					$result = FALSE;
					foreach ($checked as $pid)
					{
						$result = $this->cities_model->delete($pid);
					}
	
					if ($result)
					{
						Template::set_message(count($checked) .' '. 'record(s) successfully deleted.', 'success');
					}
					else
					{
						Template::set_message('We could not delete the record:' . $this->cities_model->error, 'error');
					}
				}
			}

			$this->cities_model->where('deleted',0);
			$records = $this->cities_model->find_all();
			Template::set('records',$records);
			
			Template::render();
		}	
	
	//=======================================================================================
		
		
		
	//=======================================================================================
	
		public function update_personal_info()
		{
			$user_id=$this->current_user->id;
			$record=$this->patients_model->find_by('user_id',$user_id);
			$id=$record->id;
			if($id)
			{
				$shows=$this->patients_model->find($id);
				if($shows)
				{
				  Template::set('show',$shows);
						if ($_POST)
						{
							if(empty($_FILES['photo']['name']))
								{
										$data = array(
											'first_name'	    	=> $this ->input->post('first_name'),
											'middle_name'	    	=> $this -> input ->post('middle_name'),
											'last_name'	    		=> $this -> input ->post('last_name'),
											'gender'	    		=> $this -> input ->post('gender'),
											'dob'	    			=> $this -> input ->post('dob'),
											'address_line1'	    	=> $this -> input ->post('address_line1'),
											'address_line2'	    	=> $this -> input ->post('address_line2'),
											'landline'	    		=> $this -> input ->post('landline'),
											'photo'	    			=> $this -> input ->post('current_image'),
											'deleted' 				=> 0,
													);
								}

								else
								{
										$path = $_SERVER['DOCUMENT_ROOT'].'/Ilaaj/uploads/patients/';
										$ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
									    $rand = 'Patients_'.time();
									    $file = $rand.".".$ext;
									    $temp_name = $_FILES['photo']['tmp_name'];
										move_uploaded_file($temp_name,$path.$file);
								        $image = $this -> patients_model -> find($id);
										if(isset($image -> photo))
										{
											unlink($path . '\\' . $image -> photo);
										}
										
									
										$data = array(
											'first_name'	    	=> $this ->input->post('first_name'),
											'middle_name'	    	=> $this -> input -> post('middle_name'),
											'last_name'	    		=> $this -> input -> post('last_name'),
											'gender'	    		=> $this -> input -> post('gender'),
											'dob'	    			=> $this -> input -> post('dob'),
											'address_line1'	    	=> $this -> input -> post('address_line1'),
											'address_line2'	    	=> $this -> input -> post('address_line2'),
											'landline'	    		=> $this -> input -> post('landline'),
											'photo'	    			=> $file,
											'deleted' 				=> 0,
													);
								}

							
							$this->form_validation->set_rules($this->get_validation_rules('edit'));
							if ($this->form_validation->run($this))
							{
								if ($id = $this->patients_model->update($id,$data))
								{
									Template::set_message('Record Successfully updated', 'success');
									
								}
								else
								{
									Template::set_message('Error updating patient.', 'alert alert-danger alert-dismissabl');
								}
							}
							else
							{
								Template::set_message('Error updating patient.', 'alert alert-danger alert-dismissabl');
							}
						}
			
			$this->load->library('JS_Validation');
			$this->js_validation->javascript('patients_form',$this->get_validation_rules('edit'));
			Template::set('page_title','update patients');
			Template::render();			
				}
			}	
			else
				{
					redirect('patients/update_personal_info');
					
				}
			
			
			
		}
	
	//=======================================================================================
	
	

	
		public function dummy($id = false) 
	{
		if($id)
		{
			
			$state=$this->state_model->find_all();
			Template::set('state',$state);
			$cities = $this->cities_model->find($id);
			if($cities)
			{
				if($_POST)
				{
					$this->form_validation->set_rules($this->get_validation_rules('edit'));
					if ($this->form_validation->run($this)) 
					{
						 if($this->cities_model->update($id, $_POST))
						 {
						 	Template::set_message('Rrecord updated.','success');
							Template::redirect('cities/');
						 }
						 else
						 {
							Template::set_message('Error updating Record.','error'); 	
						 }
					}			
				}
				Template::set('cities',$cities);
				Template::render();
			} 
			else 
			{
				Template::set_message('Record doesn\'t exist or has been deleted.','error');
				Template::redirect('cities/');
			}
		}
		else
		{
			Template::redirect('cities/');
		}
	}
	
	//=======================================================================================
	
	
	
	public function delete($id = false) 
		{
			if ($id) 
			{
				if ($this->cities_model->find($id)) 
				{
					$this->cities_model->delete($id);
					Template::set_message('Record deleted successfully','success');
				} 
				else 
				{
					Template::set_message('Record doesn\'t exist','error');
				}
			}
			
			redirect('cities/');
		}	
	
	//=======================================================================================
	

	
		private function get_validation_rules($group)
		{
			$validationRules = array();
	
			switch ($group)
			{
				case 'edit':
					$validationRules = array(
						array(
						'field' => 'first_name',
						'label' => 'First name',
						'rules' => 'trim|required|max_length[30]|xss_clean'
						),
						array(
						'field' => 'middle_name',
						'label' => 'middle name',
						'rules' => 'trim|required|max_length[30]|xss_clean'
						),
						array(
						'field' => 'last_name',
						'label' => 'Last name',
						'rules' => 'trim|required|max_length[30]|xss_clean'
						),
						array(
						'field' => 'gender',
						'label' => 'Gender',
						'rules' => 'trim|required|max_length[30]|xss_clean'
						),
						array(
						'field' => 'dob',
						'label' => 'DOB',
						'rules' => 'trim|required|max_length[30]|xss_clean'
						),
						array(
						'field' => 'email',
						'label' => 'Email',
						'rules' => 'trim|required|max_length[50]|xss_clean'
						),
						array(
						'field' => 'address_line1',
						'label' => 'Address Line 1',
						'rules' => 'trim|required|max_length[100]|xss_clean'
						),
						array(
						'field' => 'address_line2',
						'label' => 'Address Line 2',
						'rules' => 'trim|required|max_length[100]|xss_clean'
						),
						array(
						'field' => 'mobile',
						'label' => 'Mobile nu.',
						'rules' => 'trim|required|max_length[10]|xss_clean'
						),
						array(
						'field' => 'landline',
						'label' => 'Landline',
						'rules' => 'trim|required|max_length[20]|xss_clean'
						),
					
					);
					break;
	
				
			}
	
			return $validationRules;
	}
	//=======================================================================================
}