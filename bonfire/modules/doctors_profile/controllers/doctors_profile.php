<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Doctors_profile extends Authenticated_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('doctors_profile_model', null, true);
		$this->load->model('users/user_model', null, true);
		$this->load->model('degree/degree_model', null, true);
		$this->load->model('specialities/specialities_model', null, true);
		$this->load->model('doctors_specialities_model', null, true);
		Assets::add_module_css('doctors_profile', 'page.css');
	}
	
	//-----------------------------------------------------------------------
	
	public function index()
	{
		redirect('home');
	}
		
	//-----------------------------------------------------------------------
	
	public function profile()
	{
		$id = $this->current_user->id;
		$query = "SELECT bf_doctors.*, bf_users.*
				FROM (bf_doctors)
				INNER JOIN bf_users ON bf_users.id = bf_doctors.user_id
				WHERE bf_users.id = $id";
				
		$doctor_records = $this->db->query($query)->result();
		
		if (!empty($_POST))
		{
			$this->form_validation->set_rules($this->get_validation_rules('personal_info'));
			if ($this->form_validation->run($this))
			{
				if($_POST['deleted_image'])
				{
					$path = $_SERVER['DOCUMENT_ROOT'].'/Ilaaj/uploads/doctors/';
					unlink($path.$_POST['deleted_image']);
					$data = array(
						'user_id'		=> $id,
						'photo'			=> null
					);
					$this->doctors_profile_model->udpate_image($data);
					
				}
				if($_POST['profile_pic']['name'] && $_POST['profile_pic']['name'] !='')
				{
					$this->load->library('upload');
					$files = $_FILES;
					
					$date_time = date('ymd_his');
					$ext = end(explode(".", $files['profile_pic']['name']));
					$image_name = $id.$date_time.'.'.$ext;
					$image_array[] = $image_name;
					
			        $_FILES['profile_pic']['name']= $image_name;
			        $_FILES['profile_pic']['type']= $files['profile_pic']['type'];
			        $_FILES['profile_pic']['tmp_name']= $files['profile_pic']['tmp_name'];
			        $_FILES['profile_pic']['error']= $files['profile_pic']['error'];
			        $_FILES['profile_pic']['size']= $files['profile_pic']['size'];  
					
				    $this->upload->initialize($this->set_upload_options());
				    $this->upload->do_upload('profile_pic');
					
					$data = array(
						'user_id'		=> $id,
						'photo'			=> $image_name
					);
					$this->doctors_profile_model->udpate_image($data);
				}
				
				if($_POST['pics'] && $_POST['pics'] !='')
				{
					$date_time = date('ymd_his');
					$image_name = $id.$date_time.'.jpg';
					
					$pics = $_POST['pics'];
					list($type, $pics) = explode(';', $pics);
					list(, $pics)      = explode(',', $pics);
					$data = base64_decode($pics);
					file_put_contents($_SERVER['DOCUMENT_ROOT'].'/Ilaaj/uploads/doctors/'.$image_name, $data);
					$data = array(
						'user_id'		=> $id,
						'photo'			=> $image_name
					);
					$this->doctors_profile_model->udpate_image($data);
				}
			
				if ($id = $this->doctors_profile_model->update($_POST))
				{
					Template::set_message('Profile Info Successfully Updated', 'success');
					redirect('doctors_profile/educational_info/'.$_POST['id']);
				}
				else
				{
					Template::set('records',$doctor_records);
					Template::set_message('Error Updating Profile.', 'alert alert-danger alert-dismissabl');
					Template::set_view('add_personal_info');
				}
			}
			else
			{
				Template::set('records',$doctor_records);
				Template::set_message('Error Updating Profile.', 'alert alert-danger alert-dismissabl');
				Template::set_view('add_personal_info');
			}
		}

		Template::set('userid', $id);
		Template::set_view('add_personal_info');
		Template::set('records',$doctor_records);
		Template::render();
	}
	
	//-----------------------------------------------------------------------
	
	public function educational_info($id = false)
	{
		if($id)
		{
			if($this->current_user->id == $id )
			{
				$this->degree_model->where('deleted', 0);
				$degree = $this->degree_model->find_all();
				if (!empty($_POST))
				{
					$this->form_validation->set_rules($this->get_validation_rules('educational_info'));
					if ($this->form_validation->run($this))
					{
						if ($id = $this->doctors_profile_model->update_educational_info($_POST['id'],$_POST['postvalues']))
						{
							Template::set_message('Educational info updated.', 'success');
							redirect('doctors_profile/specialities/'.$_POST['id']);
						}
						else
						{
							Template::set('id' , $id);
							Template::set('degrees' , $degree);
							Template::set_message('Error updating educational info.', 'alert alert-danger alert-dismissabl');
							Template::set_view('add_educational_info');
						}
					}
					else
					{
						Template::set('degrees',$degree);
						Template::set_message('Error adding educational info.', 'alert alert-danger alert-dismissabl');
						Template::set_view('add_educational_info');
					}
				}
				
				Template::set('degrees' , $degree);
				Template::set('userid', $id);
				Template::set_view('add_educational_info');
				Template::render();
			}
		}
		else 
		{
			redirect('home');
		}
	}
	
	//-----------------------------------------------------------------------
	
	public function specialities($id = false)
	{
		if($id)
		{
			if($this->current_user->id == $id )
			{
				$this->specialities_model->where('deleted', 0);
				$specialities = $this->specialities_model->find_all();
				
				if (!empty($_POST))
				{
					$speciality_array = $_POST['specialities'];
					$id = $_POST['id'];
					$this->form_validation->set_rules($this->get_validation_rules('speciality'));
					if ($this->form_validation->run($this))
					{
						foreach($speciality_array as $speciality)
						{
							$this->doctors_specialities_model->insert($id,$speciality);
						}
						Template::set_message('Specialities added successfully.', 'success');
						redirect('clinics/add/'.$id);
					}
					else
					{
						Template::set('userid' , $id);
						Template::set('specialities' , $specialities);
						Template::set_message('Error adding specialities.', 'alert alert-danger alert-dismissabl');
						Template::set_view('add_specialities');
					}
				}
				
				Template::set('userid' , $id);
				Template::set('specialities' , $specialities);
				Template::set_view('add_specialities');
				Template::render();
			}
		}
		else 
		{
			redirect('home');
		}
		
	}
	
	//-----------------------------------------------------------------------
	
	private function get_validation_rules($group)
	{
		$validationRules = array();

		switch ($group)
		{
			case 'personal_info':
				$validationRules = array(
					array(
					'field' => 'first_name',
					'label' => 'First Name',
					'rules' => 'trim|required|max_length[100]|xss_clean'
					),
					array(
					'field' => 'middle_name',
					'label' => 'Middle Name',
					'rules' => 'trim|max_length[100]|xss_clean'
					),
					array(
					'field' => 'last_name',
					'label' => 'Last Name',
					'rules' => 'trim|required|max_length[100]|xss_clean'
					),
					array(
					'field' => 'gender',
					'label' => 'Gender',
					'rules' => 'trim|required|max_length[6]|xss_clean'
					),
					array(
					'field' => 'dob',
					'label' => 'Date of birth',
					'rules' => 'trim|required|xss_clean'
					),
					array(
					'field' => 'address_line1',
					'label' => 'Address',
					'rules' => 'trim|required|max_length[100]|xss_clean'
					),
					array(
					'field' => 'address_line2',
					'label' => 'Address Line 2',
					'rules' => 'max_length[100]|xss_clean'
					),
					array(
					'field' => 'latitude',
					'label' => 'Lattitude',
					'rules' => 'trim|max_length[100]|xss_clean'
					),
					array(
					'field' => 'longitude',
					'label' => 'Longitude',
					'rules' => 'max_length[100]|xss_clean'
					),
					array(
					'field' => 'mobile1',
					'label' => 'Mobile',
					'rules' => 'trim|required|max_length[10]|xss_clean'
					),
					array(
					'field' => 'mobile2',
					'label' => 'Other Mobile',
					'rules' => 'max_length[10]|xss_clean'
					),
					array(
					'field' => 'landline',
					'label' => 'Landline',
					'rules' => 'max_length[11]|xss_clean'
					),
					array(
					'field' => 'website',
					'label' => 'Website',
					'rules' => 'max_length[100]|xss_clean'
					),
					array(
					'field' => 'overview',
					'label' => 'Overview',
					'rules' => 'xss_clean'
					),
				);
				break;
				
		case  'educational_info' :
			$validationRules = array(
						array(
						'field' => 'degree',
						'label' => 'Degree',
						'rules' => 'trim|required|max_length[100]|xss_clean'
						),
						array(
						'field' => 'institute',
						'label' => 'Institute',
						'rules' => 'trim|required|max_length[100]|xss_clean'
						),
						array(
						'field' => 'year',
						'label' => 'Year',
						'rules' => 'trim|required|max_length[100]|xss_clean'
						),
					);
			break;	
					
		case  'speciality' :
			$validationRules = array(
						array(
						'field' => 'specialities',
						'label' => 'Speciality',
						'rules' => 'required|xss_clean'
						),
					);
			break;			
		}

		return $validationRules;
	}
		
	//-----------------------------------------------------------------------
	
	public function set_upload_options()
	{
		$path = $_SERVER['DOCUMENT_ROOT'].'/Ilaaj/uploads/doctors';
        $config = array();
		$config['upload_path'] = $path;
		$config['allowed_types'] = 'jpg|png|jpeg';
        return $config;
	}
	
	//-----------------------------------------------------------------------
}
?>		