<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Scrape extends CI_Controller
{
    public function index()
    {
    }

    public function scrape_between($data, $start, $end)
    {
        $data = stristr($data, $start); // Stripping all data from before $start
        $data = substr($data, strlen($start)); // Stripping $start
        $stop = stripos($data, $end); // Getting the position of the $end of the data to scrape
        $data = substr($data, 0, $stop); // Stripping all data from after and including the $end of the data to scrape
        return $data; // Returning the scraped data from the function
    }

    public function curl($url)
    {
        // Assigning cURL options to an array
        $headers = 'User-Agent:  yutut456@123jump.com';
        $options = Array(
            CURLOPT_RETURNTRANSFER => TRUE, // Setting cURL's option to return the webpage data
            CURLOPT_FOLLOWLOCATION => TRUE, // Setting cURL to follow 'location' HTTP headers
            CURLOPT_AUTOREFERER => TRUE, // Automatically set the referer where following 'location' HTTP headers
            CURLOPT_CONNECTTIMEOUT => 120, // Setting the amount of time (in seconds) before the request times out
            CURLOPT_TIMEOUT => 120, // Setting the maximum amount of time for cURL to execute queries
            CURLOPT_MAXREDIRS => 10, // Setting the maximum number of redirections to follow
            CURLOPT_USERAGENT => "Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9.1a2pre) Gecko/2008073000 Shredder/3.0a2pre ThunderBrowse/3.2.1.8", // Setting the useragent
            CURLOPT_URL => $url, // Setting cURL's URL option with the $url variable passed into the function,
            CURLINFO_HEADER_OUT => TRUE,
            CURLOPT_HTTPHEADER => $headers
        );
        //curl_setopt($curl_exect, CURLINFO_HEADER_OUT, true);
        $ch      = curl_init(); // Initialising cURL 
        curl_setopt_array($ch, $options); // Setting cURL's options using the previously assigned array data in $options
        $data = curl_exec($ch); // Executing the cURL request and assigning the returned data to the $data variable
        curl_close($ch); // Closing cURL 
        return $data; // Returning the data from the function 
    }

    function mpinfoNewsXmlLink()
    {        
        
        	$url ='https://mpinfo.org/RSSFeed/RSSFeed_News.xml';
            //$text            = $this->curl($url);
            $text            = file_get_contents($url);           
            $xml             = simplexml_load_string($text);
            $xml             = json_encode($xml);
            $newsItemes 	 = json_decode($xml, true);            
			
			if($newsItemes['channel']['item']){
				$itemes = $newsItemes['channel']['item'];				
				foreach($itemes as $item){					
					$link= $item['link'];	
                    $newsId = $this->scrape_between($link,'?newsid=','&fontname=');	
								    
					$query = "SELECT * FROM `mpinfo_xml_news` where  link ='".$link."' limit 1";	
					
					$count_data = $this->master_model->customQueryArray($query);					
					//echo $count_data = $this->master_model->customQueryRow($query);
					echo "<br>"; echo "<br>";	
					echo $count = count($count_data);
						if($count==0){						
							// get full news;
                            //echo $link,$newsId;                             
							$this->mpinfoNewsXmlLinkData($link,$newsId);
							echo "<br>";						
						}
				}					
			}
	}        
    

	function mpinfoNewsXmlLinkData($link,$newsId)
    {        
		$url ='https://www.mpinfo.org/HomePageWebservice.asmx/GetNewsByNewsID?IdNews='.$newsId.'&fontname=Mangal';
		//$data        = $this->curl($url); 
        $data            = file_get_contents($url);
		$jsonData 	 = json_decode($data, true);						
			if($jsonData){
				$newsData = array();
				$newsData['link'] 			= trim($link);
				$newsData['news_id'] 		= trim($jsonData['lblNews_ID']);
				$newsData['title'] 			= trim($jsonData['lblNewsTitle']);
				$newsData['sub_title'] 		= trim($jsonData['lblSubTitle']);
				$newsData['description'] 	= trim($jsonData['ltrlNewsDetail']);
				$newsData['publish_date'] 	= trim($jsonData['PublishDate']);
				pr($newsData);
				$this->master_model->save('mpinfo_xml_news',$newsData);  		       
			}
	}

	function SyncMpinfoData(){
			$query = "SELECT * FROM `mpinfo_xml_news` where `sync_status`=0  limit 10";      	 
			$mpinfo_xml_news_data = $this->master_model->customQueryArray($query);
			foreach($mpinfo_xml_news_data as $mpinfo_xml_news_data_item){
				$data = array();
				$heading = trim($mpinfo_xml_news_data_item['title']);
				$newsDescription = trim($mpinfo_xml_news_data_item['description']);

				$data['heading'] = $heading;
				$data['category'] = 3;
				$data['description'] = $newsDescription;
				$data['status'] = '0';

				if(!empty($heading) && !empty($newsDescription)) {	
				$data['date'] =  date('Y-m-d',strtotime($mpinfo_xml_news_data_item['publish_date'])) ;	
				$news = $this->master_model->save('news',$data);
				}
				
				$mpinfo_xml_news['id'] = $mpinfo_xml_news_data_item['id'];
				$mpinfo_xml_news['sync_status'] = 1;
				$this->master_model->save('mpinfo_xml_news',$mpinfo_xml_news);  	
			}
	}

	function getMPinfoVideo()
    {        
        
        	$url ='https://mpinfo.org/MobileWebServices/Video.asmx/GetVideoList?PageNumber=1&fromdate=01/06/2024&todate=01/01/2030&keyword=%E0%A4%AE%E0%A5%81%E0%A4%96%E0%A5%8D%E0%A4%AF%E0%A4%AE%E0%A4%82%E0%A4%A4%E0%A5%8D%E0%A4%B0%E0%A5%80';
            //$text            = $this->curl($url);
            $text            = file_get_contents($url);           
            $xml             = simplexml_load_string($text);            
			$itemes 		 =  json_decode($xml, true);
			$itemes = $itemes['Table'];
			$itemes= array_reverse($itemes);
			//pr($itemes);
			//echo "<br>"; echo "<br>";
			//die();
			if($itemes) {
				//$itemes = $newsItemes['channel']['item'];				
				foreach($itemes as $item) {					
					$heading= $item['VideoCaption'];	
					$link= $item['FileName'];	
					$VideoPoster= $item['VideoPoster'];	
					$ActiveYN= $item['ActiveYN'];	
					if($ActiveYN==1){ 
					$query = "SELECT * FROM `videos` where  link ='".$link."' limit 1";						
					$count_data = $this->master_model->customQueryArray($query);					
					//echo $count_data = $this->master_model->customQueryRow($query);
						
						$videos_data = array();
						if(count($count_data)==0) {					
							$videos_data['link'] = trim($link);
							$videos_data['heading'] = trim($heading);
							pr($videos_data);
							echo "<br>";
							$this->master_model->save('videos',$videos_data);						
						}					
				}					
			}
		}
	}  


	
		
	 
	
	function galavNational() {
		$url = "https://galavnews.com/category.php?id=116";
		$this->galavnews_link($url,1);
	} 


	function galavInterNational() {
		$url = "https://galavnews.com/category.php?id=117";
		$this->galavnews_link($url,2);
	}

	function galavSports() {
		$url = "https://galavnews.com/category.php?id=121";
		$this->galavnews_link($url,6);
	}

	function galavBusiness() {
		$url = "https://galavnews.com/category.php?id=122";
		$this->galavnews_link($url,5);
	}
	
	
	function galavnews_link($url,$section=7){
		 // $url = "https://galavnews.com/category.php?id=116";
		  $pageData = file_get_contents($url);
		  //pr($pageData);
		  $allNewsSection = $this->scrape_between($pageData, '<div class="page-body">', '<div class="paginate">'); 
		  //pr($allNewsSection);	
		  // echo "<br>"; echo "<br>"; echo "<br>"; echo "<br>";	 
		   $news = explode('<div class="ct-row">',$allNewsSection);
		   foreach($news as $newsDiv){
				$linkWithHeading = $this->scrape_between($newsDiv, '<h3>', '</h3>'); 
				echo "<br>"; echo "<br>"; 
				echo $neswlink = $this->scrape_between($linkWithHeading, '<a href="', '">');
				echo "<br>"; echo "<br>"; 
				$neswlink = trim($neswlink);
				$scrape_website = 'galavnews';
				$date = date('Y-m-d');
				$scrapeNewsLinkData                 = array();
				$scrapeNewsLinkData['link'] 		= $neswlink;
				$scrapeNewsLinkData['section']		= $section;
				$scrapeNewsLinkData['website'] 		= $scrape_website;
				$scrapeNewsLinkData['date'] 	    = $date;
				//$scrapeNewsLinkData['status'] = 0;
				
				if(!empty($neswlink)){ 
					$query = "SELECT * FROM `scrape_news_link` where  link ='".$neswlink."' limit 1";	
					$count_data = $this->master_model->customQueryArray($query);	
					if(count($count_data)==0){
						pr($scrapeNewsLinkData);	
						$this->master_model->save('scrape_news_link', $scrapeNewsLinkData);
					}	 
				}
				unset($scrapeNewsLinkData);		 
		    }			  
	} 
		  
		  
	function galavnews_link_data(){	
		  $query    = "SELECT * FROM `scrape_news_link` where status=0 order by id desc limit 3";
		  $companys = $this->master_model->customQueryArray($query);
		  foreach ($companys as $company_data) {
			  $url_id = trim($company_data['id']);
			  $url = trim($company_data['link']);
			  $section = trim($company_data['section']);
			  //$url = "https://galavnews.com/news.php?id=president-murmus-address-in-the-joint-session-of-parliament-congratulations-to-om-birla-and-election-commission-497148";		
			  $this->saveNewsByLink($url,$section);		
			  // update link status 
			  $scrape_news_link                   = array();
			  $scrape_news_link['status'] 		= '1';
			  $scrape_news_link['id']             = $url_id;
			  $this->master_model->save('scrape_news_link', $scrape_news_link);
		   }
			  
	}   

	function saveNewsByLink($url,$section=7) {
		//$url = "https://galavnews.com/news.php?id=president-murmus-address-in-the-joint-session-of-parliament-congratulations-to-om-birla-and-election-commission-497148";
		echo $url;
		echo "<br>"; echo "<br>"; 
		$pageData = file_get_contents($url);
		  $allNewsSection = $this->scrape_between($pageData, '<div class="post">', '<div class="ws-block">'); 
			  //echo $allNewsSection; 
			//   echo "<br>"; echo "<br>"; 
			//   echo "<br>"; echo "<br>"; 
			//   echo "<br>"; echo "<br>"; echo "<br>"; echo "<br>"; 
			//   echo "<br>"; echo "<br>"; echo "<br>"; echo "<br>"; 
			$heading = $this->scrape_between($allNewsSection, '<h1>', '</h1>');
			//echo "<br>"; echo "<br>";
			   
			$newsDescription = $this->scrape_between($allNewsSection, '<div class="post-content text-justify">', '<div class="post-tags">');
			//echo "<br>"; echo "<br>";
			  
			$newsImage = $this->scrape_between($newsDescription, '<img src="', 'class="post-image img-responsive " />');
			$newsImage = str_replace('"',"",$newsImage);
			
			
			$removeImageFromDescription= '<img src="'.$newsImage.'" class="post-image img-responsive ">';
			
			$newsDescription = str_replace($removeImageFromDescription,"",$newsDescription);  
			  
			$imageUrl = "https://galavnews.com/".$newsImage;
			$image = file_get_contents($imageUrl);
			$saveImageName = time().'.jpg';
			$saveImageNamePath = 'uploads/'.$saveImageName;
			file_put_contents($saveImageNamePath, $image);
			//echo "<br>"; echo "<br>";
			  
			  //  save new 
			  $newsData  = array();
			  $newsData['heading']   		= trim($heading);
			  $newsData['description']   	= trim($newsDescription);
			  $newsData['image']   		    = $saveImageName;
			  $newsData['date']   		    = date('Y-m-d');
			  $newsData['category']   		= $section; 
			   if(!empty($heading) && !empty($newsDescription)) {
					$query = "SELECT * FROM `news` where  heading ='".$heading."' limit 1";	
					$count_data = $this->master_model->customQueryArray($query);	
					if(count($count_data)==0){
						pr($newsData);
						$this->master_model->save('news', $newsData);  
					}
			}
	}
	
} 
