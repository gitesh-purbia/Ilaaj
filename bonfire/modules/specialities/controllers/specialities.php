<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Specialities extends Authenticated_Controller
{

	//=======================================================================================
		
		public function __construct()
		{
			parent::__construct();
			$this->load->model('specialities_model', null, true);
		}
		
	//=======================================================================================
	
		public function index()
		{
			if (has_permission('Specialities.Content.View'))
			{
				if (isset($_POST['delete']))
				{
					$checked = $this->input->post('checked');
		
					if (is_array($checked) && count($checked))
					{
						$result = FALSE;
						foreach ($checked as $pid)
						{
							$result = $this->specialities_model->delete($pid);
						}
		
						if ($result)
						{
							Template::set_message(count($checked) .' '. 'record(s) successfully deleted.', 'success');
						}
						else
						{
							Template::set_message('We could not delete the record:' . $this->specialities_model->error, 'error');
						}
					}
				}
	
				$this->specialities_model->where('deleted',0);
				$records = $this->specialities_model->find_all();
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
		if (has_permission('Specialities.Content.Add'))
		{
			if (!empty($_POST))
			{
				$this->form_validation->set_rules($this->get_validation_rules('add'));
				if ($this->form_validation->run($this))
				{
					if ($id = $this->specialities_model->insert($_POST))
					{
						Template::set_message('Record Successfully Added', 'success');
						redirect('specialities');
					}
					else
					{
						Template::set_message('Error adding Speciality.', 'alert alert-danger alert-dismissabl');
					}
				}
				else
				{
					Template::set_message('Error adding Speciality.', 'alert alert-danger alert-dismissabl');
				}
			}
		
			$this->load->library('JS_Validation');
			$this->js_validation->javascript('specialities_form',$this->get_validation_rules('add'));
			Template::set('page_title','Add Speciality');
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
		if (has_permission('Specialities.Content.Edit'))
		{
			if($id)
			{
				$specialities = $this->specialities_model->find($id);
				if($specialities)
				{
					if($_POST)
					{
						$this->form_validation->set_rules($this->get_validation_rules('edit'));
						if ($this->form_validation->run($this)) 
						{
							 if($this->specialities_model->update($id, $_POST))
							 {
							 	Template::set_message('Rrecord updated.','success');
								Template::redirect('specialities/');
							 }
							 else
							 {
								Template::set_message('Error updating Record.','error'); 	
							 }
						}			
					}
					Template::set('specialities',$specialities);
					Template::render();
				} 
				else 
				{
					Template::set_message('Record doesn\'t exist or has been deleted.','error');
					Template::redirect('specialities/');
				}
			}
			else
			{
				Template::redirect('specialities/');
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
		if (has_permission('Specialities.Content.Delete'))
		{
			if ($id) 
			{
				if ($this->specialities_model->find($id)) 
				{
					$this->specialities_model->delete($id);
					Template::set_message('Record deleted successfully','success');
				} 
				else 
				{
					Template::set_message('Record doesn\'t exist','error');
				}
			}
			else
			{
				redirect('specialities/');
			}
		}
		else
		{
			Template::redirect('specialities/');
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
						'label' => 'Speciality',
						'rules' => 'trim|required|unique[specialities.name]|max_length[100]|xss_clean'
						),
					);
					break;
	
					case 'edit':
						$validationRules = array(
						array(
						'field' => 'name',
						'label' => 'Speciality',
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
		$query = "select name from bf_specialities where name = '$name' and deleted = 0 and id <> $id";
		$records =  $this->db->query($query)->result();
		if($records && !empty($records))
		{
			$this->form_validation->set_message('checkname', 'The value in "Speciality" is already being used.');
			return false;
		}
		else
		{
			return true;
		}
	}
}