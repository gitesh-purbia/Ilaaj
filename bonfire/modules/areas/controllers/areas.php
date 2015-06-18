<?php 
Class Areas extends Authenticated_Controller
{
	//=======================================================================================
		
		public function __construct()
		{
			parent::__construct();
			$this->load->model('areas_model', null, true);	
			$this->load->model('countries/countries_model', null, true);
			$this->load->model('state/state_model', null, true);
			$this->load->model('cities/cities_model', null, true);
		}
		
	//=======================================================================================
	
		public function index()
		{
			if (has_permission('Areas.Content.View'))
			{
				$cities=$this->cities_model->find_all();
				Template::set('cities',$cities);	
				if (isset($_POST['delete']))
				{
					$checked = $this->input->post('checked');
		
					if (is_array($checked) && count($checked))
					{
						$result = FALSE;
						foreach ($checked as $pid)
						{
							$result = $this->areas_model->delete($pid);
						}
		
						if ($result)
						{
							Template::set_message(count($checked) .' '. 'record(s) successfully deleted.', 'success');
						}
						else
						{
							Template::set_message('We could not delete the record:' . $this->areas_model->error, 'error');
						}
					}
				}
	
				$this->areas_model->where('deleted',0);
				$records = $this->areas_model->find_all();
				Template::set('records',$records);
				Template::render();
			}
			else 
			{
				Template::set_message('You dont have permission to view this page!!', 'alert');
				redirect('home');
			}
		}	
	
	//=======================================================================================
	
		public function add()
		{
			if (has_permission('Areas.Content.Add'))
			{
				$this->countries_model->where('deleted',0);
				$country = $this->countries_model->find_all();
				Template::set('record_country',$country);
				
				if (!empty($_POST))
				{
					$this->form_validation->set_rules($this->get_validation_rules('add'));
					
					if ($this->form_validation->run($this))
					{
						if ($id = $this->areas_model->insert($_POST))
						{
							Template::set_message('Record Successfully Added', 'success');
							redirect('areas');
						}
						else
						{
							Template::set_message('Error adding Areas.', 'alert alert-danger alert-dismissabl');
						}
					}
					else
					{
						Template::set_message('Error adding Areas.', 'alert alert-danger alert-dismissabl');
					}
				}
				
				$this->load->library('JS_Validation');
				$this->js_validation->javascript('areas_form',$this->get_validation_rules('add'));
				Template::set('page_title','Add areas');
				Template::render();
			}
			else 
			{
				Template::set_message('You dont have permission to view this page!!', 'alert');
				redirect('home');
			}
		}	
	
	//=======================================================================================
	
		public function edit($id = false) 
	    {
	    	if (has_permission('Areas.Content.Edit'))
			{
				$states = $this->state_model->find_all();
				Template::set('state',$states);
				$cities = $this->cities_model->find_all();
				Template::set('city',$cities);
				if($id)
				{
					$areas = $this->areas_model->find($id);
					$query = 'select cc.state_id from bf_cities cc join bf_areas on bf_areas.city_id = cc.id 
								where cc.id ='.$areas->city_id;
					$selected_state = $this->db->query($query)->result();
					Template::set('selected_state',$selected_state);		
					 
					if($areas)
					{
						if($_POST)
						{
							$this->form_validation->set_rules($this->get_validation_rules('edit'));
							if ($this->form_validation->run($this)) 
							{
								if($this->state_model->update($id,$_POST))
								{
								 if($this->areas_model->update($id, $_POST))
								 {
								 	Template::set_message('Rrecord updated.','success');
									Template::redirect('areas/');
								 }
								}
								 else
								 {
									Template::set_message('Error updating Record.','error'); 	
								 }
							}			
						}
						Template::set('records',$areas);
						Template::render();
					} 
					else 
					{
						Template::set_message('Record doesn\'t exist or has been deleted.','error');
						Template::redirect('areas/');
					}
				}
			else
			{
				Template::redirect('areas/');
			}
		}
		else 
		{
			Template::set_message('You dont have permission to view this page!!', 'alert');
			redirect('home');
		}
	}
	
	//=======================================================================================
	
	public function delete($id = false) 
	{
		if (has_permission('Areas.Content.Delete'))
		{
			if ($id) 
			{
				if ($this->areas_model->find($id)) 
				{
					$this->areas_model->delete($id);
					Template::set_message('Record deleted successfully','success');
				} 
				else 
				{
					Template::set_message('Record doesn\'t exist','error');
				}
			}
			
			redirect('areas/');
		}
		else 
		{
			Template::set_message('You dont have permission to view this page!!', 'alert');
			redirect('home');
		}
	}	

	//=======================================================================================
	
		private function get_validation_rules($group)
		{
			$validationRules = array();
	
			switch ($group)
			{
				case 'add':
					$validationRules = array(
						array(
						'field' => 'name',
						'label' => 'Areas',
						'rules' => 'trim|required|unique[areas.name]|max_length[100]|xss_clean'
						),
						array(
						'field' => 'city_name',
						'label' => 'City',
						'rules' => 'trim|required|max_length[100]|xss_clean'
						),
					);
					break;
	
					case 'edit':
						$validationRules = array(
						array(
						'field' => 'name',
						'label' => 'areas',
						'rules' => 'trim|required|callback_checkname|max_length[100]|xss_clean'
						),
					);
					break;
			}
	
			return $validationRules;
		}
		
	//=======================================================================================
	public function getStates()
	{
		$country_id = $this->input->get('country_id'); 
		$this->state_model->where('deleted',0);
		$states = $this->state_model->find_all_by('country_id',$country_id);
		echo json_encode($states);
	}
		
	//=======================================================================================
	  public function getCitys()
	  {
	  	$state_id=$this->input->get('state_id');
		$this->cities_model->where('deleted',0);
		$citys=$this->cities_model->find_all_by('state_id',$state_id);
		echo json_encode($citys);
	  }
	
	//=======================================================================================
	
	public function checkname($name)
	{
		$id = $this->uri->segment(3);
		$query = "select name from bf_areas where name = '$name' and deleted = 0 and id <> $id";
		$records =  $this->db->query($query)->result();
		if($records && !empty($records))
		{
			$this->form_validation->set_message('checkname', 'The value in "areas" is already being used.');
			return false;
		}
		else
		{
			return true;
		}
	}	
	//=======================================================================================
}