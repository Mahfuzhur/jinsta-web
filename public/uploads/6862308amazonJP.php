<?php

//////templates//////

$nextPageTmpl="{<a title=\"Next Page\"(?:\s+)?".
"id=\"pagnNextLink\"(?:\s+)?". 
"class=\"pagnNext\"(?:\s+)?".
"href=\"/s/ref=sr_pg_[0-9]+\?rh=(.*?)\&amp\;page=[0-9]+\&amp\;ie=UTF8\&amp\;qid=([0-9]+)\">(?:\s+)?".
"<span id=\"pagnNextString\">Next Page</span>}si";

$ItemsTmpl="{".
	"<li(?:\s+)?id=\"result_[0-9]+\"(?:\s+)?data\-result\-rank=\"[0-9]+\"(?:\s+)?data\-asin=\"([a-zA-Z0-9]+)\"(?:\s+)?".
	"data\-action=\"sx\-detail\-display\-trigger\" class=\"s\-result\-item s\-result\-card\-for\-container a\-declarative celwidget(?:\s+)?\"><div class=\"s\-item\-container\"(?:\s+)?".
"}siu";
////end of templates//


$src=get_page("https://www.amazon.co.jp/s/ref=sr_pg_4?rh=n%3A344845011%2Cn%3A%21344919011%2Cn%3A345914011%2Cn%3A170385011&page=4&ie=UTF8&qid=1541245699&lo=baby");

//cut only this content with results 
//begin from 
//<ul id="s-results-list-atf" c
// and end with 
//<span id="pagnNextString">次のページ</span>
$pos=strpos($src,'<span id="pagnNextString">次のページ</span>');
$src=substr_replace($src,'',$pos);

//

$countResults=0;
    if(preg_match_all($ItemsTmpl,$src,$matchesitems,PREG_SET_ORDER)){
		foreach($matchesitems as $items){
			//
			$id=$items[1];//ASIN
			$link="https://www.amazon.co.jp/dp/".$id;
			echo 
			"id(ASIN)=".$id."<br>".
			"sku=sku_".$id."<br>".
			"link:<a href=\"https://www.amazon.co.jp/dp/".$id."\" target=\"_blank\">".$id."</a><br>".
			"<br>----------------------------------- <br>".
			"<br>----------------------------------- <br>";
			$countResults++;
		}
	}else{
		die(
		"preg_ error"
		//.$src
		);
	}
echo "done. ".$countResults;


function get_page($url,$proxy="",$noCoockies=false,$coockieFile="1.dat",$usrAgent="Opera/9.80 (X11; Linux i686; U; ru) Presto/2.9.168 Version/11.52"){
     $ch = curl_init();
     $headers [] = "Accept: text/html, application/xml;q=0.9, application/xhtml+xml, image/png, image/jpeg, image/gif, image/x-xbitmap, */*;q=0.1"; 
     $headers [] = "Accept-Language: en,ru;q=0.9,ru-RU;q=0.8"; 
     $headers [] = "Connection: close"; 
     $headers [] = "Cache-Control: no-store, no-cache, must-revalidate";
     curl_setopt($ch, CURLOPT_URL,$url);
     curl_setopt($ch, CURLOPT_USERAGENT,$usrAgent);
     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
     curl_setopt($ch, CURLOPT_HEADER, 1);
     curl_setopt($ch, CURLOPT_FAILONERROR, 1);
     curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
     if(!$noCoockies){
			 curl_setopt($ch, CURLOPT_COOKIEJAR, $coockieFile);
			 curl_setopt($ch, CURLOPT_COOKIEFILE, $coockieFile);
		}
     if($proxy!=""){curl_setopt($ch, CURLOPT_PROXY, $proxy);}
     curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
     curl_setopt($ch, CURLINFO_HEADER_OUT, true);
     curl_setopt($ch, CURLOPT_TIMEOUT, 1000);
     curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 250);
     $result = curl_exec($ch);
     curl_close($ch);
     if($result)return $result;else return "false";
}
?>

