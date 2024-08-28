<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	
	public function __construct($config = 'rest')
	{
		ini_set('max_file_uploads', '100');	 
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		//error_reporting(0);
		parent::__construct();
		if(!$this->session->userdata('admin_id')){			
			redirect(base_url().'admin-login');	 	
		}
   
		
		
	}

	public function index()
	{
		if($this->session->userdata('admin_id')){			
			redirect(base_url().'admin/dashboard');		
		}
		$this->load->view('admin/login.php'); 		
	}

	

	public function loginPost(){
		$data['user_name'] = $this->input->post('email');
		$data['password'] = $this->input->post('password');
		$login_data = $this->master_model->getRow('admin',$data);
		if($login_data){
			$array = array("success" => true);
			$this->session->set_userdata('admin_id', $login_data['id']);
			
			$id = $login_data['id'];
			$timestamp = date('Y-m-d h:i:s');
			
			$nw_data = array(
				'id'=>$id,
				'last_session'=>$timestamp
			);
			
			$this->master_model->save('admin',$nw_data);
			
		}else{
			$array = array("success" => false);
		}
		 echo json_encode($array);
		 die;
	}
	
	public function logout(){
		$this->session->unset_userdata('admin_id');
		redirect(base_url().'admin/');
	}
	

	public function dashboard(){
		$this->load->view('admin/dashboard.php'); 
	} 

	public function getNews($category=1) {	
		$query1 = "SELECT * FROM `news` WHERE `category` = '" . $category . "' ORDER BY `id` desc ";
		$news = $this->master_model->customQueryArray($query1);
		return $news;
	}

	public function addNews(){
		$this->load->view('admin/add-news.php'); 
	}


	public function addNewsPost()
	{			
		
		if(!empty($this->input->post('heading')) && !empty($this->input->post('description')) && ($this->input->post('description')!='<p>&nbsp;</p>') ) {		
			$heading = $this->input->post('heading');
			$category = $this->input->post('category');
			$description = $this->input->post('description');
			$status = $this->input->post('status');
			$date = $this->input->post('date');			
			//$date = date('Y-m-d');			
			$data = array();
			if($_FILES['image']){				
					$target_folder = "uploads/";				
					$image = $_FILES['image']['name'];
					$tmpname 	= 	$_FILES['image']['tmp_name'];
					$filename 	= 	time().$_FILES['image']['name'];
					$des = $target_folder.$filename;
					$upload = move_uploaded_file($tmpname,$des);

					if($upload){
						$data['image'] = $filename;	
					}
			}
			
			
			$data['heading'] = $heading;
			$data['category'] = $category;
			$data['description'] = $description;
			$data['status'] = $status;		
			$data['date'] =$date;
			if($this->input->post('id')){
			$data['id'] = $this->input->post('id');
			}
			$news = $this->master_model->save('news',$data);
			redirect(base_url().'admin/dashboard');			  
		}	
		echo "invlaid data";	
				
		  
	}

	public function deleteNews(){		
		echo $id = $this->input->get('id');
		$table = "news";
		if($id && $table){
		$news = $this->master_model->delete($id, $table);
		}
		redirect(base_url().'admin/dashboard');
	}

	// google search 
	public function adminDashboardSearch(){
		$this->load->view('admin/adminDashboardSearch.php'); 
	} 



	// open news page 
	public function adminSearchNews(){
		$this->load->view('admin/adminSearchNews.php'); 
	}

	public function adminSearchListNews(){
		$this->load->view('admin/adminSearchListNews.php'); 
	}
	
	// 
	public function deleteCookie(){
		$this->load->view('admin/deleteCookie.php'); 
	}

	public function randlink(){
		$query = "SELECT * FROM `news` where status=1 ORDER BY 'date',`id`  desc limit 20";
		$nationalNews = $this->master_model->customQueryArray($query);                          
		$newsLinkes = array();
		foreach($nationalNews as $newsData) {
			//pr($newsData);
			$newsId = $newsData['id'];
			$heading = strip_tags($newsData['heading']);
			$heading_link = str_replace(' ','-',$newsData['heading']);
			$category = $newsData['category'];
			$description = strip_tags($newsData['description']);
			$image = $newsData['image'];
			$date = $newsData['date'];                               
			echo $link = getNewsFullPageLink($newsData);    
			$categoryListNewsLink = getNewsListingPage($newsData);
			//$newsLinkes[$categoryListNewsLink]=$categoryListNewsLink;
			$newsLinkes[$link];
		}
		pr($newsLinkes);
	}


}
