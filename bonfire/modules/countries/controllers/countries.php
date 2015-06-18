<?php 
Class countries extends Authenticated_Controller
{

	//=======================================================================================
		
		public function __construct()
		{
			parent::__construct();
			$this->load->model('countries_model', null, true);		
		}
		
	//=======================================================================================
	
		public function index()
		{
			if (has_permission('Countries.Content.View'))
			{
				if (isset($_POST['delete']))
				{
					$checked = $this->input->post('checked');
		
					if (is_array($checked) && count($checked))
					{
						$result = FALSE;
						foreach ($checked as $pid)
						{
							$result = $this->countries_model->delete($pid);
						}
		
						if ($result)
						{
							Template::set_message(count($checked) .' '. 'record(s) successfully deleted.', 'success');
						}
						else
						{
							Template::set_message('We could not delete the record:' . $this->countries_model->error, 'error');
						}
					}
				}
	
				$this->countries_model->where('deleted',0);
				$records = $this->countries_model->find_all();
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
			if (has_permission('Countries.Content.Add'))
			{
				if (!empty($_POST))
				{
					$this->form_validation->set_rules($this->get_validation_rules('add'));
					if ($this->form_validation->run($this))
					{
						if ($id = $this->countries_model->insert($_POST))
						{
							Template::set_message('Record Successfully Added', 'success');
							redirect('countries');
						}
						else
						{
							Template::set_message('Error adding Country.', 'alert alert-danger alert-dismissabl');
						}
					}
					else
					{
						Template::set_message('Error adding Country.', 'alert alert-danger alert-dismissabl');
					}
				}
			
				$this->load->library('JS_Validation');
				$this->js_validation->javascript('countries_form',$this->get_validation_rules('add'));
				Template::set('page_title','Add countries');
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
			if (has_permission('Countries.Content.Edit'))
			{
				if($id)
				{
					$countries = $this->countries_model->find($id);
					if($countries)
					{
						if($_POST)
						{
							$this->form_validation->set_rules($this->get_validation_rules('edit'));
							if ($this->form_validation->run($this)) 
							{
								 if($this->countries_model->update($id, $_POST))
								 {
								 	Template::set_message('Rrecord updated.','success');
									Template::redirect('countries/');
								 }
								 else
								 {
									Template::set_message('Error updating Record.','error'); 	
								 }
							}			
						}
						Template::set('countries',$countries);
						Template::render();
					} 
					else 
					{
						Template::set_message('Record doesn\'t exist or has been deleted.','error');
						Template::redirect('countries/');
					}
				}
				else
				{
					Template::redirect('countries/');
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
		if (has_permission('Countries.Content.Delete'))
		{
			if ($id) 
			{
				if ($this->countries_model->find($id)) 
				{
					$this->countries_model->delete($id);
					Template::set_message('Record deleted successfully','success');
				} 
				else 
				{
					Template::set_message('Record doesn\'t exist','error');
				}
			}
			redirect('countries/');
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
						'label' => 'Country',
						'rules' => 'trim|required|unique[countries.name]|max_length[100]|xss_clean'
						),
					);
					break;
	
					case 'edit':
						$validationRules = array(
						array(
						'field' => 'name',
						'label' => 'Country',
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
		$query = "select name from bf_countries where name = '$name' and deleted = 0 and id <> $id";
		$records =  $this->db->query($query)->result();
		if($records && !empty($records))
		{
			$this->form_validation->set_message('checkname', 'The value in "countries" is already being used.');
			return false;
		}
		else
		{
			return true;
		}
	}	
	
	//=======================================================================================
	
	public function get_countries()
	{
		$country_term = isset($_GET['countries'])?$_GET['countries']:NULL;
		$query = "select c.id,c.name from bf_countries c where c.deleted = 0 and c.name like '%$country_term%'";
		$results = $this->db->query($query);
		echo json_encode($results->result());
	}
	
	//=======================================================================================
}