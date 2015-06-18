<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Clinic_images extends Authenticated_Controller
{

	//=======================================================================================
		
		public function __construct()
		{
			parent::__construct();
			$this->load->model('clinic_images_model', null, true);
		}
		
	//=======================================================================================
	
		public function index()
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

			$this->clinic_time_slots_model->where('deleted',0);
			$this->clinic_time_slots_model->where('doctor_id',$this->current_user->id);
			$records = $this->clinic_time_slots_model->find_all();
			Template::set('records',$records);
			Template::set('userid',$this->current_user->id);
			Template::render();
		}	
	
	//=======================================================================================
		
		public function add($id = false)
		{
			if($id)
			{
				if (!empty($_POST))
				{
					$this->load->library('upload');
				    $files = $_FILES;
				    $cpt = count($_FILES['clinic_images']['name']);
					$image_array = array();
					
				    for($i=0; $i<$cpt; $i++)
				    {
				    	$date_time = date('ymd_his');
						$ext = end(explode(".", $files['clinic_images']['name'][$i]));
						$image_name = 'image'.$i.$date_time.'.'.$ext;
						$image_array[] = $image_name;
						
				        $_FILES['clinic_images']['name']= $image_name;
				        $_FILES['clinic_images']['type']= $files['clinic_images']['type'][$i];
				        $_FILES['clinic_images']['tmp_name']= $files['clinic_images']['tmp_name'][$i];
				        $_FILES['clinic_images']['error']= $files['clinic_images']['error'][$i];
				        $_FILES['clinic_images']['size']= $files['clinic_images']['size'][$i];  
						
					    $this->upload->initialize($this->set_upload_options());
					    $this->upload->do_upload('clinic_images');
						
						$data = array(
							'clinic_id'		=> $id,
							'image'			=> $image_name
						);
						$this->clinic_images_model->insert($data);
				    }
					Template::set_message('Record Successfully Added', 'success');
					redirect('clinic_images/add/'.$id);
				}
			}
			Template::set('clinic_id', $id);
			Template::set('page_title','Add Clinic Timeslots');
			Template::render();
		}	
		
	//=======================================================================================
	
	public function view($id = null)
	{
		if($id)
		{
			$this->clinic_images_model->where('clinic_id', $id);
			$clinic_images = $this->clinic_images_model->find_all();
			
			if($_POST && !empty($_POST))
			{
				$deleted_image = $this->input->post('deleted_image');
				$deleted_image_name = $this->input->post('deleted_image_name');
				$ids_arr = explode(",",$deleted_image);
				$name_arr = explode(",",$deleted_image_name);
				
				//===== Unlink images from upload folder ===================
				
				if(!empty($deleted_image) && !empty($deleted_image_name))
				{
					$path = $_SERVER['DOCUMENT_ROOT'].'/Ilaaj/uploads/clinics/';
					foreach($name_arr as $name)
					{
						 unlink($path.$name);
					}
					
					//================ Delete Images from database =============
					$this->db->where_in('id', $ids_arr);
					$this->db->delete('clinic_images');
					//==========================================================
				}
				
				if($this->input->post('clinic_images'))
				{
					$clinic_id = $this->input->post('clinic_id');
					$this->load->library('upload');
				    $files = $_FILES;
				    $cpt = count($_FILES['clinic_images']['name']);
				    
				    for($i=0; $i<$cpt; $i++)
				    {
				    	$date_time = date('ymd_his');
				    	$ext = end(explode(".", $files['clinic_images']['name'][$i]));
						$image_name = 'image'.$i.$date_time.'.'.$ext;
				
				        $_FILES['clinic_images']['name']= $image_name;
				        $_FILES['clinic_images']['type']= $files['clinic_images']['type'][$i];
				        $_FILES['clinic_images']['tmp_name']= $files['clinic_images']['tmp_name'][$i];
				        $_FILES['clinic_images']['error']= $files['clinic_images']['error'][$i];
				        $_FILES['clinic_images']['size']= $files['clinic_images']['size'][$i];  
						
					    $this->upload->initialize($this->set_upload_options());
					    $this->upload->do_upload('clinic_images');
						
						$data = array(
							'clinic_id'			=> $id,
							'image'				=> $image_name
						);
						$this->clinic_images_model->insert($data);
				    }

					Template::set_message('Update Images', 'success');
					redirect('clinic_images/view/'.$this->input->post('clinic_id'));
				}
					Template::set_message('Update Images', 'success');
					redirect('clinic_images/view/'.$this->input->post('clinic_id'));
			}

			Template::set('images', $clinic_images);
			Template::set('clinic_id', $id);
			Template::render();
		}
		else
		{
			Template::redirect('clinics/');
		}
		
	}

	
	//=======================================================================================
	
		public function set_upload_options()
		{
			$path = $_SERVER['DOCUMENT_ROOT'].'/Ilaaj/uploads/clinics';
	        $config = array();
			$config['upload_path'] = $path;
			$config['allowed_types'] = 'jpg|png|jpeg';
	        return $config;
		}
	
	//==================================================================================
	
}