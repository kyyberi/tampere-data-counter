<?php
error_reporting(0);
    ini_set('display_errors', 0);

$retrieve_url = "http://palvelut2.tampere.fi/tietovaranto/tietovarantolista.php";
$currentcountfilename = "lkm.txt";
$jsonfile = "tampere.json";

$now = mktime();


// kirjoita lukumaara txt tiedostoon. 
function outputFile($ocontent, $filename, $timenow) {
	$myFile = $filename;
	$fh = fopen($myFile, 'w') or die("can't open file");
	$stringData = $ocontent.'|'.$timenow;
	fwrite($fh, $stringData);
	fclose($fh);
}

// lisää uusi JSON objekti, jossa datasettien lkm ja aikaleima
function appendJSON($newcount, $newdate, $filehd) {

// {
//    "Tampere avoimen datan katalogin listaus historia": [
//        {
//            "osoite": "http://data.tampere.fi"
//        }
//    ],
//    "0": {
//        "lkm": 6,
//        "timestamp": 1366799266
//    },
//    "1": {
//        "lkm": 6,
//        "timestamp": 1366799282
//    }
// }

	// muodosta JSON objekti
	$new['lkm'] = $newcount;
	$new['timestamp'] = $newdate;

	// lue JSON sisään
	$inp = file_get_contents($filehd);
	// decode JSON arrayksi
	$tempArray = json_decode($inp, true);
	// lisää uusi JSON objekti arrayna	
	array_push($tempArray, $new);
	// encode arry JSON muotoon 
	$jsonData = json_encode($tempArray);
	// kirjoita ulos
	file_put_contents($filehd, $jsonData);


}



  // new dom object
  $dom = new DOMDocument();
  
  $content = file_get_contents($retrieve_url);
  //load the html
  $html = $dom->loadHTML($content);

  //discard white space 
  $dom->preserveWhiteSpace = false; 

  //the table by its tag name
  $items = $dom->getElementsByTagName('p'); 

  // laskuri 
  $i = 0;
  // loop over the items
  foreach ($items as $item) 
  { 
     $i++;
	//echo $item->textContent;
	
    } 
   
  // Kirjoita text filuun 

   outputFile($i, $currentcountfilename, $now);

  // lisää JSON objekti
  appendJSON($i, $now, $jsonfile);
?>


