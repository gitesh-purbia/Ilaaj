<?php 
Class cities extends Authenticated_Controller
{

	//=======================================================================================
		
		public function __construct()
		{
			parent::__construct();
			$this->load->model('cities_model', null, true);	
			
			$this->load->model('state/state_model', null, true);		
		}
		
	//=======================================================================================
	
		public function index()
		{
			if (has_permission('Cities.Content.View'))
			{
				$states=$this->state_model->find_all();
				Template::set('states',$states);	
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
	
				$records = $this->cities_model->find_all();
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
			if (has_permission('Cities.Content.Add'))
			{
				$record = $this->state_model->find_all();
				
				Template::set('states',$record);
				if (!empty($_POST))
				{
					$this->form_validation->set_rules($this->get_validation_rules('add'));
					if ($this->form_validation->run($this))
					{
						if ($id = $this->cities_model->insert($_POST))
						{
							Template::set_message('Record Successfully Added', 'success');
							redirect('cities');
						}
						else
						{
							Template::set_message('Error adding Cities.', 'alert alert-danger alert-dismissabl');
						}
					}
					else
					{
						Template::set_message('Error adding Cities.', 'alert alert-danger alert-dismissabl');
					}
				}
				$this->load->library('JS_Validation');
				$this->js_validation->javascript('cities_form',$this->get_validation_rules('add'));
				Template::set('page_title','Add cities');
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
			if (has_permission('Cities.Content.Edit'))
			{
				if($id)
				{
					$state=$this->state_model->find_all();
					Template::set('states',$state);
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
			else 
			{
				Template::set_message('You dont have permission to view this page!!', 'alert');
				redirect('home');
			}
		}
	
	//=======================================================================================
	
	public function delete($id = false) 
	{
		if (has_permission('Cities.Content.Delete'))
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
						'label' => 'cities',
						'rules' => 'trim|required|unique[cities.name]|max_length[100]|xss_clean'
						),
						array(
						'field' => 'states',
						'label' => 'states',
						'rules' => 'trim|required|unique[cities.name]|max_length[100]|xss_clean'
						),
					);
					break;
	
					case 'edit':
						$validationRules = array(
						array(
						'field' => 'name',
						'label' => 'cities',
						'rules' => 'trim|required|callback_checkname|max_length[100]|xss_clean'
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
		$query = "select name from bf_cities where name = '$name' and deleted = 0 and id <> $id";
		$records =  $this->db->query($query)->result();
		if($records && !empty($records))
		{
			$this->form_validation->set_message('checkname', 'The value in "cities" is already being used.');
			return false;
		}
		else
		{
			return true;
		}
	}	
	
	//=======================================================================================
	
	public function get_cities_by_state($id)
	{
		$this->cities_model->where('deleted',0);
		$cities = $this->cities_model->find_all_by('state_id',$id);
		echo json_encode($cities);
	}

	//=======================================================================================
	
	public function get_cities()
	{
		$state = isset($_GET['state'])?$_GET['state']:NULL;
		$city_name = isset($_GET['city'])?$_GET['city']:NULL;
		$query = "select s.id,s.name from bf_cities s where s.deleted = 0 and s.name like '%$city_name%' and s.state_id = $state";
		$results = $this->db->query($query);
		echo json_encode($results->result());
	}
}