<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
Class User_profile extends Authenticated_Controller
{
	//=======================================================================================
		public function __construct()
		{
			parent::__construct();
			$this->load->model('user_profile_model', null, true);	
			$this->load->model('users/user_model', null, true);	
		}
	//=======================================================================================
	
      public function update() 
      {
		$id = $this->current_user->id;	
		if($id)
		{
			$user = $this->user_profile_model->find($id);
			if($user)
			{
				if($_POST)
				{
					$this->form_validation->set_rules($this->get_validation_rules('edit'));
					if ($this->form_validation->run($this)) 
					{
						 if($this->user_profile_model->update($id, $_POST))
						 {
						 	Template::set_message('Profile updated.','success');
							Template::redirect('user_profile/update');
						 }
						 else
						 {
							Template::set_message('Error updating Record.','error'); 	
						 }
					}			
				}
				Template::set('userid',$id);
				Template::set('users',$user);
				Template::render();
			} 
			else 
			{
				Template::set_message('Record doesn\'t exist or has been deleted.','error');
				Template::redirect('home/');
			}
		}
		else
		{
			Template::redirect('home/');
		}
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
					'field' => 'id',
					'label' => 'id',
					'rules' => 'xss_clean'
					),
					array(
					'field' => 'username',
					'label' => 'Username',
					'rules' => 'required|trim|strip_tags|max_length[30]|unique[users.username,users.id]|xss_clean'
					),
					array(
					'field' => 'display_name',
					'label' => 'Display Name',
					'rules' => 'trim|strip_tags|max_length[255]|xss_clean'
					),
					array(
					'field' => 'email',
					'label' => 'Email',
					'rules' => 'required|trim|unique[users.email,users.id]|valid_email|max_length[120]|xss_clean'
					),
					array(
					'field' => 'password',
					'label' => 'Passwrod',
					'rules' => 'trim|strip_tags|min_length[8]|max_length[120]|valid_password|matches[pass_confirm]|xss_clean'
					),
					array(
					'field' => 'pass_confirm',
					'label' => 'Passwrod Confirm',
					'rules' => 'trim|strip_tags|xss_clean'
					),
				);
				break;
			}
	
			return $validationRules;
		}
		
}