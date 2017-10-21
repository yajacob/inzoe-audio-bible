<?php
function locateIp($ip){
	$d = file_get_contents("http://www.ipinfodb.com/ip_query.php?ip=$ip&output=xml");
 
	//Use backup server if cannot make a connection
	if (!$d){
		$backup = file_get_contents("http://backup.ipinfodb.com/ip_query.php?ip=$ip&output=xml");
		$answer = new SimpleXMLElement($backup);
		if (!$backup) return false; // Failed to open connection
	}else{
		$answer = new SimpleXMLElement($d);
	}
 
	$country_code = $answer->CountryCode;
	$country_name = $answer->CountryName;
	$region_name = $answer->RegionName;
	$city = $answer->City;
	$zippostalcode = $answer->ZipPostalCode;
	$latitude = $answer->Latitude;
	$longitude = $answer->Longitude;
	$timezone = $answer->Timezone;
	$gmtoffset = $answer->Gmtoffset;
	$dstoffset = $answer->Dstoffset;
 
	//Return the data as an array
	return array('ip' => $ip, 'country_code' => $country_code, 'country_name' => $country_name, 'region_name' => $region_name, 'city' => $city, 'zippostalcode' => $zippostalcode, 'latitude' => $latitude, 'longitude' => $longitude, 'timezone' => $timezone, 'gmtoffset' => $gmtoffset, 'dstoffset' => $dstoffset);
}
 
//Usage example
$ip = "74.125.45.100";
$ip_data = locateIp($ip);
 
echo "IP : " . $ip_data['ip'] . "\n";
echo "Country code : " . $ip_data['country_code'] . "\n";
echo "Country name : " . $ip_data['country_name'] . "\n";
echo "Region name : " . $ip_data['region_name'] . "\n";
echo "City : " . $ip_data['city'] . "\n";
echo "Zip/postal code : " . $ip_data['zippostalcode'] . "\n";
echo "Latitude : " . $ip_data['latitude'] . "\n";
echo "Longitude : " . $ip_data['longitude'] . "\n";
echo "Timezone : " . $ip_data['timezone'] . "\n";
echo "GmtOffset : " . $ip_data['gmtoffset'] . "\n";
echo "DstOffset : " . $ip_data['dstoffset'] . "\n";
?>