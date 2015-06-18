<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class State extends Authenticated_Controller
{
	//=======================================================================================
		
		public function __construct()
		{
			parent::__construct();
			$this->load->model('state_model', null, true);
			$this->load->model('countries/countries_model',null,TRUE);
		}
		
	//=======================================================================================
	
		public function index()
		{
			if (has_permission('State.Content.View'))
			{
				if (isset($_POST['delete']))
				{
					$checked = $this->input->post('checked');
		
					if (is_array($checked) && count($checked))
					{
						$result = FALSE;
						foreach ($checked as $pid)
						{
							$result = $this->state_model->delete($pid);
						}
		
						if ($result)
						{
							Template::set_message(count($checked) .' '. 'record(s) successfully deleted.', 'success');
						}
						else
						{
							Template::set_message('We could not delete the record:' . $this->state_model->error, 'error');
						}
					}
				}
	
				$country_record = $this->countries_model->find_all();
				Template::set('country_record',$country_record);
				$this->state_model->where('deleted',0);
				$records = $this->state_model->find_all();
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
			if (has_permission('State.Content.Add'))
			{
				if (!empty($_POST))
				{
					$this->form_validation->set_rules($this->get_validation_rules('add'));
					if ($this->form_validation->run($this))
					{
						if ($id = $this->state_model->insert($_POST))
						{
							Template::set_message('Record Successfully Added', 'success');
							redirect('state');
						}
						else
						{
							Template::set_message('Error adding state.', 'alert alert-danger alert-dismissabl');
						}
					}
					else
					{
						Template::set_message('Error adding state.', 'alert alert-danger alert-dismissabl');
					}
				}
	            $this->countries_model->where('deleted',0);
				$country_record = $this->countries_model->find_all();
				Template::set('country_record',$country_record);
			
				$this->load->library('JS_Validation');
				$this->js_validation->javascript('state_form',$this->get_validation_rules('add'));
				Template::set('page_title','Add state');
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
		if (has_permission('State.Content.Edit'))
		{
			$this->countries_model->where('deleted',0);
			$country_record = $this->countries_model->find_all();
			Template::set('country_record',$country_record);
			if($id)
			{
				$state = $this->state_model->find($id);
				if($state)
				{
					if($_POST)
					{
						$this->form_validation->set_rules($this->get_validation_rules('edit'));
						if ($this->form_validation->run($this)) 
						{
							 if($this->state_model->update($id, $_POST))
							 {
							 	Template::set_message('Rrecord updated.','success');
								Template::redirect('state/');
							 }
							 else
							 {
								Template::set_message('Error updating Record.','error'); 	
							 }
						}			
					}
					Template::set('state',$state);
					Template::render();
				} 
				else 
				{
					Template::set_message('Record doesn\'t exist or has been deleted.','error');
					Template::redirect('state/');
				}
			}
			else
			{
				Template::redirect('state/');
			}
		}
		else 
		{
			Template::set_message('You dont have permission to view this page!!', 'alert');
			redirect('home');
		}
	}
	

	//==================================================================================
	
		public function delete($id = false) 
		{
			if (has_permission('State.Content.Edit'))
			{
				if ($id) 
				{
					if ($this->state_model->find($id)) 
					{
						$this->state_model->delete($id);
						Template::set_message('Record deleted successfully','success');
					} 
					else 
					{
						Template::set_message('Record doesn\'t exist','error');
					}
				}
				else 
				{
					redirect('state/');
				}
			}
			else 
			{
				Template::set_message('You dont have permission to view this page!!', 'alert');
				redirect('home');
			}
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
						'field' => 'name',
						'label' => 'state',
						'rules' => 'trim|required|unique[state.name]|max_length[100]|xss_clean'
						),
						array(
						'field' => 'country_name',
						'label' => 'country',
						'rules' => 'trim|required|max_length[100]|xss_clean'
						),
					);
					break;
	
					case 'edit':
						$validationRules = array(
						array(
						'field' => 'name',
						'label' => 'state',
						'rules' => 'trim|required|callback_checkname|max_length[100]|xss_clean'
						),
						array(
						'field' => 'country_name',
						'label' => 'country',
						'rules' => 'trim|required|max_length[100]|xss_clean'
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
		$query = "select name from bf_state where name = '$name' and deleted = 0 and id <> $id";
		$records =  $this->db->query($query)->result();
		if($records && !empty($records))
		{
			$this->form_validation->set_message('checkname', 'The value in "state" is already being used.');
			return false;
		}
		else
		{
			return true;
		}
	}

	//=======================================================================================	
	
	public function get_state_by_country($id)
	{
		$this->state_model->where('deleted',0);
		$states = $this->state_model->find_all_by('country_id',$id);
		echo json_encode($states);
	}

	//=======================================================================================	
	
	public function get_states()
	{
		$country = isset($_GET['country'])?$_GET['country']:NULL;
		$state_name = isset($_GET['state'])?$_GET['state']:NULL;
		$query = "select s.id,s.name from bf_state s where s.deleted = 0 and s.name like '%$state_name%' and s.country_id = $country";
		$results = $this->db->query($query);
		echo json_encode($results->result());
	}
}