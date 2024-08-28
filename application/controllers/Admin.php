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


	public function videoList(){
		$this->load->view('admin/videolist.php'); 
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

	public function deleteVideo(){		
		echo $id = $this->input->get('id');
		$table = "videos";
		if($id && $table){
		$news = $this->master_model->delete($id, $table);
		}
		redirect(base_url().'admin/videoList');
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
	
	public function deleteCookieFast(){
		$this->load->view('admin/deleteCookieFast.php'); 
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
	
	
	
	
public function daydiffence()
{
    //$startDate      = '2024-01-01';
    //$endDate        = '2024-01-31';  
	
	$startDate      = $_GET['s_date'];
	$endDate        = $_GET['e_date'];
	
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
  

 
public function daydiffence_2(){
 $date1 = '2025-01-27';
 $date2 = '2024-01-27';    
 $d1=new DateTime($date2);  
 $d2=new DateTime($date1);                                  
 $Months = $d2->diff($d1);  
 echo $howeverManyMonths = (($Months->y) * 12) + ($Months->m);
 echo "<br>";
 echo  $dd= $Months->d;

echo "<br>";echo "<br>";

die(); 

// https://www.w3resource.com/php-exercises/php-date-exercise-4.php#:~:text=php%20%24sdate%20%3D%20%221981%2D,24))%3B%20printf(%22%25d
$sdate = "2024-01-28";
$edate = "2024-08-26";   

$sdateArray = explode('-',$sdate);
$edateArray = explode('-',$edate);

echo "s day ".$sdayp = 30- $sdateArray[2];
echo "<br>";
echo "e day".$sdayp = $edateArray[2]; 
echo "<br>";
echo $yearp = $edateArray[0] - $sdateArray[0];
echo "<br>";
echo $monthp = $edateArray[1] - $sdateArray[1];
echo "<br>";
echo $dayp = $edateArray[2] - $sdateArray[2];
echo "<br>";


$date_diff = abs(strtotime($edate) - strtotime($sdate));

$years = floor($date_diff / (365*60*60*24));
$months = floor(($date_diff - $years * 365*60*60*24) / (30*60*60*24));
//$days = floor(($date_diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
$days = floor(($date_diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

printf("%d years, %d months, %d days", $years, $months, $days);
printf("\n");

 } 


}
