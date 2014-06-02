<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

$myquestion = new Question($myconnection);
$myquestion->connection = $myconnection;

if(isset($_POST['upload'])){
if(isset($_FILES["option_image"]["size"]) && $_FILES["option_image"]["size"] > 0) { 
 		
		$option_image_temp_name=$_FILES["option_image"]["tmp_name"];
		$option_image_file_name=$_FILES["option_image"]["name"];
		
	
 $myquestion->id=$_POST["id"];

$mainfolder=ROOT_PATH.'images/questions/';
if(is_dir($mainfolder)){
 $option_position=$_POST["option_position"];
$myquestion->get_detail();
$myquestion->answers;
$images=explode(DEFAULT_OPTION_DELIMITER, $myquestion->option_images);

if($_POST["image"]!=gINVALID){
$image=$_POST["image"];
$images[$option_position]=$option_image_file_name;
}else{
//echo count($images);echo $option_position;
if(count($images)<=$option_position){
for($k=0;$k<=$option_position;$k++){
if($k>=count($images)){
if($k!=$option_position){
$images[$k]='';
}else{
$images[$k]=$option_image_file_name;
}
}
}
}
}
$dstfolder=ROOT_PATH.'images/questions/'.$myquestion->id;
if(!is_dir($dstfolder)){
mkdir($dstfolder, 0777);	
}
if (file_exists($option_image_temp_name)) {
move_uploaded_file($option_image_temp_name, $dstfolder.'/'.$option_image_file_name);
if($_POST["image"]!='' && $_POST["image"]!=gINVALID && $_POST["image"]!=$option_image_file_name){
$oldfile=ROOT_PATH.'images/questions/'.$myquestion->id.'/'.$image;
unlink($oldfile);
}
}
$option_images="";
	for ($option_image_index = 0; $option_image_index < count($images); $option_image_index++)
	{	if($images[$option_image_index]!=''){
		$option_images.=$images[$option_image_index];
		}
		if($option_image_index < count($images)-1){
		$option_images.=DEFAULT_OPTION_DELIMITER;
		}
		
	}
$myquestion->option_images=$option_images;
$chk=$myquestion->update();
if($chk==true){
echo 'image updated please<a href="javascript:window.close();">CLOSE WINDOW</a>';
}else{

}
}else{
	echo "Please create questions folder to upload files.";
}
}else{
echo "Please choose atleast one image file.";
}
}
?>
