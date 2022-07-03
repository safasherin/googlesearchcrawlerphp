<?php
namespace Safasherinsulaiman\Searchengine;
use DOMDocument;
use DOMXPath;
use ArrayObject;
class Searchengine{

    public $region;
    public $debugmode;
    

    public function __construct() {
    $this->region = "uae";
    $this->debugmode = false;

  }

  public function setEngine($region) {
    $this->region = $region;
  }

  
  public function search($keywords){
// $query = "https://www.google.com/search?q=flower+delivery+uae&gl=us&num=50"
    $base = "https://www.google.com/search?q=";
    $searchphrase = "";
    foreach($keywords as $keyword){
        $base = $base . $keyword . "+";
        $searchphrase = $searchphrase . $keyword . " ";
    };
    $url = $base . "&gl=" . $this->region . "&hl=en&num=50";
    // echo $url;
    $dom = new DOMDocument();
    if ($this->debugmode){
        echo "debug mode";
        $file = "gg50.html";
        // $file = "dh50.html";
        @$dom->loadHTMLFile($file);
       }else{
        $useragent = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Safari/537.36";

        $ch = curl_init();

        // set user agent
        curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $content = curl_exec($ch);
        @$dom->loadHTML($content);

        // @$dom->loadHTMLFile($url);
       }

       $dom->preserveWhiteSpace = false;
      

        $xpath = new DomXPath($dom);
        $output = array();


        $index=1;
        $adblocks = $xpath->query('//div[@id="tvcap"]//div[contains(@class,"uEierd")]');
        foreach($adblocks as $ind=>$adblock){
        
            $heading = $xpath->query(".//div[@role='heading']/span",$adblock)->item(0)->nodeValue;
            $link =  $xpath->query(".//span[@role='text']",$adblock)->item(0)->nodeValue;
            $desc =  $xpath->query(".//div/div/div/div[2]",$adblock)->item(0)->nodeValue;
     
                   
            $singleSearchResult = array(
                "rank"=> $index,
                "keyword"=>$searchphrase,
                "url"=>$link,
                "title"=>$heading,
                "desc"=>$desc,
                "promoted"=>true
            );
        
            $index = $index+1;
            array_push($output,$singleSearchResult);
        
        }
        
        $mainblocks = $xpath->query("//div[@id='search']/div/div/div[contains(@class, 'g ')]");
        foreach($mainblocks as $ind=>$mainblock){

            $mainblock_link  = $xpath->query(".//div[@data-header-feature=0]/div/a",$mainblock)->item(0)->getAttribute('href');
            $main_title = $xpath->query(".//h3", $mainblock)->item(0)->nodeValue;
            $main_desc = $xpath->query("..//div[@data-content-feature=1]", $mainblock)->item(0)->nodeValue;
            
            $singleSearchResult = array(
                "rank"=> $index,
                "keyword"=>$searchphrase,
                "url"=>$mainblock_link,
                "title"=> $main_title ,
                "desc"=> $main_desc,
                "promoted"=>false
            );
        
            array_push($output,$singleSearchResult);
            $index = $index+1;
        }

        $bottom_adblocks = $xpath->query('//div[@id="bottomads"]//div[contains(@class,"uEierd")]');
        foreach($bottom_adblocks as $ind=>$bottom_adblock){
            $heading_bottomadblock = $xpath->query(".//div[@role='heading']/span",$bottom_adblock)->item(0)->nodeValue;
            $link_bottomadblock =  $xpath->query(".//span[@role='text']",$bottom_adblock)->item(0)->nodeValue;
            $desc_bottomadblock =  $xpath->query(".//div/div/div/div[2]",$bottom_adblock)->item(0)->nodeValue;
            
            $singleSearchResult = array(
                "rank"=> $index,
                "keyword"=>$searchphrase,
                "url"=>$link_bottomadblock,
                "title"=>$heading_bottomadblock,
                "desc"=>$desc_bottomadblock,
                "promoted"=>true
            );
        
            array_push($output,$singleSearchResult);
        
            $index = $index+1;
        
        }
        // echo json_encode($output);

        $output = new ArrayObject( $output );
        // echo "here";
        // echo count($output);
        if (count($output)===0){echo "No objects retrieved. Could be blocked!!!";}

        return $output;

  }

}

// $client = new searchEngine();
// $results = $client->search(["hello","world","dubai"]);
// foreach($results as $result){
//     echo json_encode($result);
//     echo "<br>";
//     echo "<br>";

// }



?>

