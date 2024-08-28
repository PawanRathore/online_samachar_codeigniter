<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	public function index()
	{
		
		$this->load->view('home.php');
	}

	public function newsList(){
		$url_section = $this->uri->segment(1);
		$Categeries = getCategeries();

		$url_section = str_replace('-News-News','',$url_section);
		$sectionArray = explode('-News',$url_section);		
		$sectionKey = array_search($sectionArray[0], $Categeries);
       
		$count= count($sectionArray);
		$extraSetion="";
		if($count==1){
			$extraSetion="-News";
		}		
		$config["base_url"] = base_url() .$url_section.$extraSetion;

		$query = "SELECT count(id) as count_id FROM `news` where `status`=1 and category='".$sectionKey."' ORDER BY `date` desc";		
		$count_data =$this->master_model->customQueryRow($query);
		
		$config["total_rows"] = $count_data['count_id'];
		$config["per_page"] = 10;
		$config['cur_tag_open'] = '&nbsp;<a class="current">';
		$config['cur_tag_close'] = '</a>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		//$config['num_links'] = 9;
		$config['attributes'] = array('class' => 'page-link');
		//$config['anchor_class'] = array('class' => 'page-link');\
		//$config['anchor_class'] = 'number';	
		$this->pagination->initialize($config);
		// You should change your parameter according your url segment like 3 / 4
		if($this->uri->segment(2)){
		$page = $this->uri->segment(2);
		}else{ 
		$page = 0;  
		}
		$str_links = $this->pagination->create_links();
		$data["links"] = explode('&nbsp;',$str_links);		

		//$query = "select * from news where `status`=1 and category='".$sectionKey."'  ORDER BY 'date',`id` desc  limit $page,".$config["per_page"];
		$query = "select * from news where `status`=1 and category='".$sectionKey."' ORDER BY `date` desc limit $page,".$config["per_page"];
        $data['news']= $this->master_model->customQueryArray($query);
		$data['count'] =  $count_data['count_id'];
		$data['sectionKey'] = $sectionKey;
		$this->load->view('news-list',$data);
	}

	public function fullNews(){
		$this->load->view('full-news'); 
	}

	public function adminlogin()
	{
		$this->load->view('admin/login.php'); 		
	}

	public function adminLoginPost(){
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

	public function Subscribe(){		
		$email = trim($this->input->post('email'));

		if($email!='') {
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			echo "Invalid email address.";
			die();		
		}

		$data = array();		
		$query = "SELECT * FROM `subscribe` where  email ='".$email."' limit 1";		
		$count_data = $this->master_model->customQueryRow($query);
			if($count_data==0){
				$data['email'] = $email;
				$this->master_model->save('subscribe',$data); 
				echo "Thank You for Subscribing";
				die();
			}else{
				echo "Email already exists"; 
				die();
			}
		}else{
			echo "Please Enter Email Id";
		}
	}

	function chekcData(){
		$this->load->view('cookie_delete'); 
	}
	
	function calculator(){
		$this->load->view('calculator'); 
	}
	
	public function daydiffence()
{
    //$startDate      = '2024-01-01';
    //$endDate        = '2024-01-31';  
	
	$startDate      = $_POST['startDate'];
	$endDate        = $_POST['endDate'];
	
	if(!$startDate){
	echo "start date is empty";
	die();
	}
	
	if(!$endDate){
	echo "end date is empty";
	die();
	}
	
	echo "Start Date : ".$startDate;
	echo "<br>"; echo "<br>";
	echo "End Date  : ".$endDate;
	echo "<br>"; echo "<br>";
	
    $startDateArray = explode('-', $startDate);
    $startDateYear  = $startDateArray[0];
    $startDateMonth = $startDateArray[1];
    $startDateDay   = $startDateArray[2];
    $endDateArray   = explode('-', $endDate);
    $endDateYear    = $endDateArray[0];
    $endDateMonth   = $endDateArray[1];
    $endDateDay     = $endDateArray[2];
    $noOfDay        = 0;
    /*echo "startDateYear : ".$startDateYear;
    echo "<br>"; echo "<br>";
    echo "endDateYear : ".$endDateYear;
    echo "<br>"; echo "<br>"; 
    echo "<br>"; echo "<br>";*/
    for ($y = $startDateYear; $y <= $endDateYear; $y++) {
        $startDateMonthNew = ($y == $startDateYear) ? $startDateMonth : 01;
        $endDateMonthNew   = ($y == $endDateYear) ? $endDateMonth : 12;
        /*echo "startDateMonth : ".$startDateMonthNew;
        echo "<br>"; echo "<br>";
        echo "endDateMonth : ".$endDateMonthNew;
        echo "<br>"; echo "<br>";
        echo "<br>"; echo "<br>";*/
        for ($m = $startDateMonthNew; $m <= $endDateMonthNew; $m++) {
            $startDateDayNew = 01;
            if ($y == $startDateYear && $m == $startDateMonth) {
                $startDateDayNew = $startDateDay;
            }
            $endDateDayNew = 30;
            if ($y == $endDateYear && $m == $endDateMonth) {
                $endDateDayNew = $endDateDay;
            }
            /*echo "startDateDay : ".$startDateDayNew;
            echo "<br>"; echo "<br>";
            echo "endDateDay : ".$endDateDayNew;
            echo "<br>"; echo "<br>"; */
			
			//$endDateDayNew =  ($endDateDayNew=='31') ? '30' : $endDateDayNew;
            for ($d = $startDateDayNew; $d <= $endDateDayNew; $d++) {
                $noOfDay++; 
            } 
        }
    }
	
    echo "noOfDay : " . $noOfDay;
    echo "<br>";
    echo "<br>";
		
	if($noOfDay>=360){
		echo  "Year : ".$totalYear = floor($noOfDay/360);
		echo "<br>";echo "<br>";
		$yearDays = $totalYear*360;
		 
		$MonthDay = $noOfDay-$yearDays;
		
		$totalMonthDays  = 0;
		if($MonthDay>=30){
		echo  "Month : ".$totalMonth = floor($MonthDay/30);  
		echo "<br>";echo "<br>";
		$totalMonthDays = $totalMonth*30;	
		}		
		echo "Days :".$days = $noOfDay-($yearDays+$totalMonthDays);	
	} 
	
	if($noOfDay>=30 && $noOfDay<360){				 
		echo  "Month : ".$totalMonth = floor($noOfDay/30);  
		echo "<br>";echo "<br>";
		$totalMonthDays = $totalMonth*30;	
		echo "Days :".$days = $noOfDay-$totalMonthDays;
	}
	
	if($noOfDay<30){
		echo "Days :".$noOfDay;  
		//echo "Days :".$days = $noOfDay-30;
		echo "<br>";echo "<br>";
		echo "the result may be different, please check manual once";		
	}   	
	
}


	
}
