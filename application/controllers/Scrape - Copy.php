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
						
						if(count($count_data)==0){						
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
				$data['heading'] = $mpinfo_xml_news_data_item['title'];
				$data['category'] = 3;
				$data['description'] = $mpinfo_xml_news_data_item['description'];
				$data['status'] = '1';		
				$data['date'] =  date('Y-m-d',strtotime($mpinfo_xml_news_data_item['publish_date'])) ;	
				$news = $this->master_model->save('news',$data);
				
				$mpinfo_xml_news['id'] = $mpinfo_xml_news_data_item['id'];
				$mpinfo_xml_news['sync_status'] = 1;
				$this->master_model->save('mpinfo_xml_news',$mpinfo_xml_news);  	
			}
	}
	
} 
