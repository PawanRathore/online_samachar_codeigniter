<?php





function newsDateFormate($date){

    return $showDate =  date("d F Y", strtotime($date));

}



function getStatusString(){

    return $statusString = array('0'=>'Disable','1'=>'Active'); 

}



function getCategeries(){

    return $categeries = array('1'=>'National','2'=>'International','3'=>'Madhya-Pradesh','4'=>'Ujjain','5'=>'Business','6'=>'Sports','7'=>'Other','8'=>'MP Live Marquee','9'=>'Interesting');

}



function getCategeriesHindiName(){

    return $categeriesHindiName = array('1'=>'राष्ट्रीय','2'=>'अंतर्राष्ट्रीय','3'=>'मध्य प्रदेश','4'=>'उज्जैन','5'=>'कारोबार','6'=>'खेल','7'=>'अन्य','8'=>'MP Live Marquee',/*'9'=>'जरा हटके',*/ '9'=>'लाइफस्टाइल');

}

function URLWithoutIndex($url){
return $url = str_replace('/index.php','',$url);
}

function getNewsFullPageLink($newsData){
        $categeries = getCategeries();
        $newsId = $newsData['id'];
        $heading = strip_tags($newsData['heading']);

        $heading_link = str_replace(' ','-',$newsData['heading']);
		$heading_link = str_replace(',','-',$heading_link);
		$heading_link = str_replace('?','-',$heading_link);
		$heading_link = str_replace(':','-',$heading_link);
		$heading_link = str_replace("'",'-',$heading_link);
		$heading_link = str_replace('"','-',$heading_link);

        $category = $newsData['category'];

        $description = strip_tags($newsData['description']);

        $image = $newsData['image'];

        $date = $newsData['date']; 

        $section = $categeries[$newsData['category']]; 

        return $link = base_url().$section.'/'.$heading_link.'?id='.$newsId; 

}



function getNewsListingPage($newsData){

    $categeries = getCategeries();    

    $section = $categeries[$newsData['category']]; 

    return $link = base_url().$section; 

}









function encrypt($string)

{

    if (empty($string)) {

        return $string;

    } else {

        $output         = false;

        $encrypt_method = "AES-256-CBC";

        $secret_key     = 'key';

        $secret_iv      = 'iv';

        // hash

        $key            = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning

        $iv             = substr(hash('sha256', $secret_iv), 0, 16);

        $output         = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);

        $output         = base64_encode($output);

        return $output;

    }

}



function decrypt($string)

{

    $output         = false;

    $encrypt_method = "AES-256-CBC";

    $secret_key     = 'key';

    $secret_iv      = 'iv';

    // hash

    $key            = hash('sha256', $secret_key);

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning

    $iv             = substr(hash('sha256', $secret_iv), 0, 16);

    $output         = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);

    return $output;

}



function pr($data)

{

    echo "<pre>";

    print_r($data);

    echo "</pre>";

}



function prd($data)

{

    echo "<pre>";

    print_r($data);

    echo "</pre>";

    die;

}



function escape_spcl($string)

{

    $string = trim($string);

    $string = preg_replace('/[^a-zA-Z0-9&\-]/', ' ', $string);

    $string = preg_replace('/^[\-]+/', '', $string);

    $string = preg_replace('/[\-]+$/', '', $string);

    $string = preg_replace('/[\-]{2,}/', ' ', $string);

    $string = str_replace(" ", "-", $string);

    return $string;

}



function number_format_short($n, $precision = 1)

{

    if ($n < 900) {

        // 0 - 900

        $n_format = number_format($n, $precision);

        $suffix   = '';

    } else if ($n < 900000) {

        // 0.9k-850k

        $n_format = number_format($n / 1000, $precision);

        $suffix   = 'K';

    } else if ($n < 900000000) {

        // 0.9m-850m

        $n_format = number_format($n / 1000000, $precision);

        $suffix   = 'M';

    } else if ($n < 900000000000) {

        // 0.9b-850b

        $n_format = number_format($n / 1000000000, $precision);

        $suffix   = 'B';

    } else {

        // 0.9t+

        $n_format = number_format($n / 1000000000000, $precision);

        $suffix   = 'T';

    }

    // Remove unecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1"

    // Intentionally does not affect partials, eg "1.50" -> "1.50"

    if ($precision > 0) {

        $dotzero  = '.' . str_repeat('0', $precision);

        $n_format = str_replace($dotzero, '', $n_format);

    }

    return $n_format . $suffix;

}



function preventToAccessPageWithoutLogin()

{

    $CI =& get_instance();

    $cookieData                 = array();

    $pageaccessWithLoginCounter = 0;

    $counterLimit               = 0;

    $limit                      = 15;

    $pageaccessWithLoginCounter = get_cookie('pageaccessWithLoginCounter');

    

    if ($CI->session->userdata("user_id")) {

        $pageaccessWithLoginCounter = 0;

    }

    

    

    if ($pageaccessWithLoginCounter > $limit) {

        $currnetUrl = current_url();

        $baseurl    = base_url();

        if ($currnetUrl != $baseurl . "index.php/User" && $currnetUrl != $baseurl . "User" && $currnetUrl != $baseurl && $currnetUrl != $baseurl . "index.php") {

            //echo "<br>"; echo "<br>";

            //echo "redir";

            redirect($baseurl . 'User');

        }

    }

    

    $urlconter      = 'pageaccessWithLoginCounter';

    $urlconterValue = $pageaccessWithLoginCounter + 1;

    $expire         = time() + 9000;

    $path           = '/';

    $secure         = TRUE;

    setcookie($urlconter, $urlconterValue, $expire, $path);

}





function get_client_ip()

{

    $ipaddress = '';

    if (isset($_SERVER['HTTP_CLIENT_IP']))

        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];

    else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))

        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];

    else if (isset($_SERVER['HTTP_X_FORWARDED']))

        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];

    else if (isset($_SERVER['HTTP_FORWARDED_FOR']))

        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];

    else if (isset($_SERVER['HTTP_FORWARDED']))

        $ipaddress = $_SERVER['HTTP_FORWARDED'];

    else if (isset($_SERVER['REMOTE_ADDR']))

        $ipaddress = $_SERVER['REMOTE_ADDR'];

    else

        $ipaddress = 'UNKNOWN';

    return $ipaddress;

}



function checkUserAgent()

{

    $agent = "";

    $CI =& get_instance();

    

    if ($CI->agent->is_browser()) {

        $agent = $CI->agent->browser() . ' ' . $CI->agent->version();

    } elseif ($CI->agent->is_robot()) {

        $agent = $CI->agent->robot();

        die();

    } elseif ($CI->agent->is_mobile()) {

        $agent = $CI->agent->mobile();

    } else {

        $agent = 'Unidentified User Agent';

        die();

    }

    return $agent;

}

 



function savelog1()

{

    checkUserAgent();

    $CI =& get_instance();

    $ipaddress = get_client_ip();

    $CI->load->helper('file');

    

    $ipaddress    = trim($ipaddress);

    $explodeArray = explode('.', $ipaddress);

    

    $first  = $explodeArray[0];

    $second = $explodeArray[1];

    $third  = $explodeArray[2];

    

    if ($first == "144" && $second == "76" && $third == "23") {

        echo "bye-bye";

        die();

    }

    

    if ($first == "51" && $second == "222" && $third == "253") {

        echo "bye-bye";

        die();

    }

    

    if ($first == "185" && $second == "191" && $third == "171") {

        echo "bye-bye";

        die();

    }

    

    if (!$CI->session->userdata("user_id")) {

        $ipsData  = file_get_contents("ip.txt");

        $ipsArray = explode(',', $ipsData);

        foreach ($ipsArray as $banIP) {

            if ($banIP == $ipaddress) {

                //echo "your ip is ban";

                redirect($baseurl . 'User');

                //die(); 

            }

        }

    }

    

    

    $current_date = date("Y-m-d H:i:s");

    

    $current_prev = date('Y-m-d H:i:s', strtotime('-10 minute', strtotime($current_date)));

    $baseurl      = base_url();

    $likeString   = '%' . $baseurl . '%';

    

    if (!$CI->session->userdata("user_id")) {

        $sql   = "select * from `logs` where page_url like '" . $likeString . "'  and  `insert_at`>='" . $current_prev . "'";

        $data  = $CI->master_model->customQueryArray($sql);

        $count = count($data);

        if ($count >= 50) {

            $ipaddressString = $ipaddress . ',';

            write_file('./ip.txt', $ipaddressString, 'a');

        }

    }

    

    

    $currnetUrl          = current_url();

    $logData['data']     = '';

    $logData['page_url'] = $currnetUrl;

    $logData['ip']       = $ipaddress;

    if ($ipaddress != "117.223.48.135" && $ipaddress != "76.229.162.33") {

        $CI->master_model->save('logs', $logData);

    }

    unset($logData);

}





function linebreak($limit = 1)

{

    $i      = 1;

    $string = "";

    for ($i; $i <= $limit; $i++) {

        $string .= "<br>";

    }

    echo $string;

}





function savelog()

{

    $CI =& get_instance();

    $currnetUrl = current_url();

    $text       = json_encode($_SERVER);

    

    

    

    if (strstr(strtolower($_SERVER['HTTP_USER_AGENT']), "bot")) {

        if (strstr(strtolower($_SERVER['HTTP_USER_AGENT']), "google") || strstr(strtolower($_SERVER['HTTP_USER_AGENT']), "bing")) {

            

            $logData['page_url'] = $currnetUrl;

            $logData['ip']       = get_client_ip();

            $logData['bot']      = $_SERVER['HTTP_USER_AGENT'];

            $CI->master_model->save('logs', $logData);

            

        } else {

            

            $logData['page_url'] = $currnetUrl;

            $logData['ip']       = get_client_ip();

            $logData['bot']      = $_SERVER['HTTP_USER_AGENT'];

            $CI->master_model->save('logs', $logData);

            

            die;

        }

    }

    

    if (!strstr(strtolower($_SERVER['HTTP_USER_AGENT']), "googlebot") && !strstr(strtolower($_SERVER['HTTP_USER_AGENT']), "bingbot")) {

        

        if ($CI->session->userdata("user_id")) {

            $sql      = "select * from `logs` where page_url like '%123jump.com%'  and  date(`insert_at`) ='" . date("Y-m-d") . "' and is_login = 1 and ip = '" . get_client_ip() . "'";

            $num_rows = $CI->db->query($sql)->num_rows();

            if ($num_rows >= 30) {

                redirect($baseurl . 'User/logout');

            } else {

                $logData['page_url'] = 'https://123jump.com';

                $logData['ip']       = get_client_ip();

                $logData['is_login'] = 1;

                $CI->master_model->save('logs', $logData);

            }

        } else {

            

            $sql      = "select * from `logs` where page_url like '%123jump.com%'  and  date(`insert_at`) ='" . date("Y-m-d") . "' and is_login = 0 and ip = '" . get_client_ip() . "'";

            $num_rows = $CI->db->query($sql)->num_rows();

            //echo "num_rows".$num_rows;

            //die();

            

            if ($num_rows >= 8) {

                

                $urlWithOutDomainName = str_replace('https://123jump.com/index.php/', '', $currnetUrl);

                $CI->session->set_userdata('redirect_url', $urlWithOutDomainName);

                

                $redirect     = "redirect_url";

                $redirect_url = $urlWithOutDomainName;

                $cookie       = setcookie($redirect, $redirect_url, time() + (86400 * 30), "/");

                

                redirect($baseurl . 'User/logout');

            } else {

                $logData['page_url'] = 'https://123jump.com';

                $logData['ip']       = get_client_ip();

                $CI->master_model->save('logs', $logData);

            }

        }

    }

    

}



function checkGoogleIpRange()

{

    $range_ip_array = array(

        array(

            'low' => '64.233.160.0',

            'high' => '64.233.191.255'

        ),

        array(

            'low' => '66.102.0.0',

            'high' => '66.102.15.255'

        ),

        array(

            'low' => '66.249.64.0',

            'high' => '66.249.95.255'

        ),

        array(

            'low' => '72.14.192.0',

            'high' => '72.14.255.255'

        ),

        array(

            'low' => '74.125.0.0',

            'high' => '74.125.255.255'

        ),

        array(

            'low' => '209.85.128.0',

            'high' => '209.85.255.255'

        ),

        array(

            'low' => '216.239.32.0',

            'high' => '216.239.63.255'

        ),

        array(

            'low' => '64.18.0.0',

            'high' => '64.18.15.255'

        ),

        array(

            'low' => '108.177.8.0',

            'high' => '108.177.15.255'

        ),

        array(

            'low' => '172.217.0.0',

            'high' => '172.217.31.255'

        ),

        array(

            'low' => '173.194.0.0',

            'high' => '173.194.255.255'

        ),

        array(

            'low' => '207.126.144.0',

            'high' => '207.126.159.255'

        ),

        array(

            'low' => '216.58.192.0',

            'high' => '216.58.223.255'

        ),

        array(

            'low' => '216.58.192.0',

            'high' => '216.58.223.255'

        ),

        array(

            'low' => '64.68.90.1',

            'high' => '64.68.90.255'

        ),

        array(

            'low' => '64.233.173.193',

            'high' => '64.233.173.255'

        ),

        array(

            'low' => '66.249.64.1',

            'high' => '66.249.79.255'

        ),

        array(

            'low' => '216.239.33.96',

            'high' => '216.239.59.128'

        ),

        array(

            'low' => '207.46.0.0',

            'high' => '207.46.255.255'

        )

    );

    foreach ($range_ip_array as $range_ip_array_item) {

        if (ip_in_range($range_ip_array_item['low'], $range_ip_array_item['high'], get_client_ip())) {

            return true;

            break;

        }

    }

}



function ip_in_range($lower_range_ip_address, $upper_range_ip_address, $needle_ip_address)

{

    // Get the numeric reprisentation of the IP Address with IP2long

    $min    = ip2long($lower_range_ip_address);

    $max    = ip2long($upper_range_ip_address);

    $needle = ip2long($needle_ip_address);

    // Then it's as simple as checking whether the needle falls between the lower and upper ranges

    return (($needle >= $min) AND ($needle <= $max));

}

   

function rangeWeek($datestr)

{

    date_default_timezone_set(date_default_timezone_get());

    $dt = strtotime($datestr);

    return array(

        "start" => date('N', $dt) == 1 ? date('Y-m-d', $dt) : date('Y-m-d', strtotime('last monday', $dt)),

        "end" => date('N', $dt) == 7 ? date('Y-m-d', $dt) : date('Y-m-d', strtotime('next sunday', $dt))

    );

}

  

function getUrlSection()

{

    $sections   = array();

    $currentUrl = current_url();

    $baseUrl    = base_url() . 'index.php/';

    $currentUrl = str_replace($baseUrl, '', $currentUrl);

    return $sections = explode('/', $currentUrl);

}

	 

	 

function CS($string)

{

    $link =& get_instance()->db->conn_id;

    if (is_array($string)) {

        foreach ($string as $k => $v) {

            $string[$k] = mysqli_real_escape_string($link, $v);

        }

    } else {

        $string = mysqli_real_escape_string($link, $string);

        return $string;

    }

    return $string;

}       

  





function arrayToInqueryString($dataArray){

	$arrayToInQueryString = "";

	$asr = 1;

	foreach($dataArray as $aData){

		$saparater = ",";

	if($asr ==1){

		$saparater = "";

	}

		$arrayToInQueryString.=  $saparater.$aData;

		$asr++;

	}	

	return $arrayToInQueryString;

}


function daydiffence($startDate,$endDate)
{
    //$startDate      = '2024-01-01';
    //$endDate        = '2024-01-31';  
	
	//$startDate      = $_POST['startDate'];
	//$endDate        = $_POST['endDate'];
	
	// if(!$startDate){
	// echo "start date is empty";
	// die();
	// }
	
	// if(!$endDate){
	// echo "end date is empty";
	// die();
	// }
	
	//echo "Start Date : ".$startDate;
	//echo "<br>"; echo "<br>";
	//echo "End Date  : ".$endDate;
	//echo "<br>"; echo "<br>";
	
    $startDateArray = explode('-', $startDate);
    $startDateYear  = $startDateArray[0];
    $startDateMonth = $startDateArray[1];
    $startDateDay   = $startDateArray[2];
    $startDateDay   = ($startDateArray[2]==31) ? 30 : $startDateArray[2];

    $endDateArray   = explode('-', $endDate);
    $endDateYear    = $endDateArray[0];
    $endDateMonth   = $endDateArray[1];
    $endDateDay     = $endDateArray[2];
    $endDateDay   = ($endDateArray[2]==31) ? 30 : $endDateArray[2];


    
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
	
    // echo "noOfDay : " . $noOfDay;
    // echo "<br>";
    // echo "<br>";

    $totalYear = 0;
    $totalMonth = 0;
    $totalDays= 0;
		
    if($noOfDay>=360) {
		//echo  "Year : ".$totalYear = floor($noOfDay/360);
		$totalYear = floor($noOfDay/360);
		//echo "<br>";echo "<br>";
		$yearDays = $totalYear*360;		 
		$MonthDay = $noOfDay-$yearDays;
		
		$totalMonthDays  = 0;
		if($MonthDay>=30){
		//echo  "Month : ".$totalMonth = floor($MonthDay/30);  
		$totalMonth = floor($MonthDay/30);  
		//echo "<br>";echo "<br>";
		$totalMonthDays = $totalMonth*30;	
		}		
		//echo "Days :".$days = $noOfDay-($yearDays+$totalMonthDays);	
	} 
	
	if($noOfDay>=30 && $noOfDay<360){				 
		//echo  "Month : ".$totalMonth = floor($noOfDay/30);  
		$totalMonth = floor($noOfDay/30);  
		//echo "<br>";echo "<br>";
		$totalMonthDays = $totalMonth*30;	
		//echo "Days :".$days = $noOfDay-$totalMonthDays;
		$days = $noOfDay-$totalMonthDays;
	}
	
	if($noOfDay<30) {
		//echo "Days :".$days = $noOfDay;  
		$days = $noOfDay;  
		//echo "Days :".$days = $noOfDay-30;
		//echo "<br>";echo "<br>";
		//echo "the result may be different, please check manual once";		
	}  

    //die();
    
    return array('totalYear'=>$totalYear,'totalMonth'=>$totalMonth,'totalDays'=>$noOfDay);
	
}

  