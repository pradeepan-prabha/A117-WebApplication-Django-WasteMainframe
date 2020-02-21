<?php
include("connect.php");

function parseToXML($htmlStr)
{
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&#39;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);
return $xmlStr;
}

function wasteType($value){
    if($value == 1)
        return 'Solid Plastic';
    elseif($value == 2)
        return 'Plastic cover';
    elseif($value == 3)
        return 'Plastic Bottle';
    elseif($value == 4)
        return 'Others';
}

function wasteShape($value){
    if($value == 1)
        return 'Cover';
    elseif($value == 2)
        return 'Cup';
    elseif($value == 3)
        return 'Bucket';
    elseif($value == 4)
        return 'Sheet';
    elseif($value == 5)
        return 'Rod';
    elseif($value == 6)
        return 'Tube';
    elseif($value == 7)
        return 'Film';
}

function wasteChar($value){
    if($value == 1)
        return 'Medium';
    elseif($value == 2)
        return 'High';
    elseif($value == 3)
        return 'Low';
}

function locType($value){
    if($value == 1)
        return 'Land';
    elseif($value == 2)
        return 'Water';
    elseif($value == 3)
        return 'Space';
    else
        return 'Unknown';
}

function wasteStatus($value){
    if($value == 1)
        return 'Active';
    elseif($value == 2)
        return 'Inactive';
    elseif($value == 3)
        return 'Unknown';
}

function sourceType($value){
    if($value == 1)
        return 'Image by Camera';
    elseif($value == 2)
        return 'Video by Drone';
    elseif($value == 3)
        return 'Video by CCTV';
}

function wasteFunStatus($value){
    if($value == 1)
        return 'Raw image from source';
    elseif($value == 2)
        return 'On progress';
    elseif($value == 3)
        return 'Processed Image from Tensorflow';
    elseif($value == 4)
        return 'Unknown';
}

// Set the active MySQL database
$db_selected = mysqli_select_db($connection, $database);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysqli_error());
}

// Select all the rows in the markers table
$query = "select * from waste_details w inner join waste_product_details p on w.refid = p.refid inner join waste_location_details loc on loc.refid = p.refid;";

$result = mysqli_query($connection, $query);
if (!$result) {
  die('Invalid query: ' . mysqli_error());
}

// $r = mysqli_fetch_all($result, MYSQLI_ASSOC);



header("Content-type: text/xml");

// Start XML file, echo parent node
echo "<?xml version='1.0' ?>";
echo '<markers>';
$ind=0;
// Iterate through the rows, printing XML nodes for each
while ($row = @mysqli_fetch_assoc($result)){
  // Add to XML document node
  echo '<marker ';
  echo 'refid="' . $row['refid'] . '" ';
  echo 'waste_type="' . wasteType($row['waste_type']) . '" ';
  echo 'waste_char="' . wasteChar($row['waste_char']). '" ';
  echo 'loc_type="' . locType($row['loc_type']). '" ';
  echo 'waste_shape="' . wasteShape($row['waste_shape']). '" ';
  echo 'waste_status="' . wasteStatus($row['waste_status']). '" ';
  echo 'waste_fun_status="' . wasteFunStatus($row['waste_fun_status']). '" ';
  echo 'source_type="' . sourceType($row['source_type']). '" ';
  echo 'lat="' . parseToXML($row['latitude']) . '" ';
  echo 'lng="' . parseToXML($row['longitude']) . '" ';
  echo 'country="' . $row['country'] . '" ';
  echo 'state="' . $row['state'] . '" ';
  echo 'district="' . $row['district'] . '" ';
  echo 'region="' . $row['region'] . '" ';
  echo 'city="' . $row['city'] . '" ';
  echo 'street="' . $row['street'] . '" ';
  echo 'pincode="' . $row['pincode'] . '" ';
  echo 'img_raw_url="' . $row['img_raw_url'] . '" ';
  echo 'img_processed_url="' . $row['img_processed_url'] . '" ';
  echo '/>';
  $ind = $ind + 1;
}

// End XML file
echo '</markers>';

?>
