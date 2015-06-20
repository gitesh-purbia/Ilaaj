<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Doctors extends Authenticated_Controller
{

	//=======================================================================================
		
		public function __construct()
		{
			parent::__construct();
			$this->load->model('doctors_model', null, true);
		}
		
	//=======================================================================================
	
		public function index()
		{
			if (has_permission('Doctors.Content.View'))
			{
				if (isset($_POST['delete']))
				{
					$checked = $this->input->post('checked');
		
					if (is_array($checked) && count($checked))
					{
						$result = FALSE;
						foreach ($checked as $pid)
						{
							$result = $this->degree_model->delete($pid);
						}
		
						if ($result)
						{
							Template::set_message(count($checked) .' '. 'record(s) successfully deleted.', 'success');
						}
						else
						{
							Template::set_message('We could not delete the record:' . $this->degree_model->error, 'error');
						}
					}
				}
	
				$this->doctors_model->where('deleted',0);
				$this->db->join('users','users.id = doctors.user_id');
				$doctors = $this->doctors_model->find_all();
				Template::set('doctors',$doctors);
				Template::render();
			}
			else 
			{
				Template::set_message('You dont have permission to view this page!!', 'alert');
				redirect('doctors');
			}
		}	
	
	//=======================================================================================
	
	public function active($id = false)
	{
		if (has_permission('Doctors.Content.Active'))
		{
			if ($id) 
			{
				$this->load->model('users/user_model');
				if ($user_data = $this->user_model->find($id)) 
				{
					if($this->user_model->admin_activation($id))
					{
						//$this->sendActivationEmail($user_data);
						Template::set_message('Doctor activated','success');
						redirect('doctors');
					}
				} 
				else 
				{
					Template::set_message('Record doesn\'t exist','error');
					redirect('doctors');
				}
			}
			redirect('doctors');
		}
		else 
		{
			Template::set_message('You dont have permission to active users!!', 'alert');
			redirect('doctors');
		}	
	}
	
	//==================================================================================
	
	public function deactive($id = false)
	{
		if (has_permission('Doctors.Content.Deactive'))
		{
			if ($id) 
			{
				$this->load->model('users/user_model');
				if($this->user_model->find($id)) 
				{
					if($this->user_model->admin_deactivation($id))
					{
						Template::set_message('Doctor dectivated','success');
						redirect('doctors');
					}
				} 
				else 
				{
					Template::set_message('Record doesn\'t exist','error');
					redirect('doctors');
				}
			}
			redirect('doctors');
		}
		else 
		{
			Template::set_message('You dont have permission to deactive users!!', 'alert');
			redirect('doctors');
		}	
	}
		
}