<?php
function move_option_images_to_main_folder($option_images_array,$import_id){
$k=0;
foreach ($option_images_array as $key => $value) {
 $dstfolder=ROOT_PATH.'images/questions/'.$key;
if(!is_dir($dstfolder)){
mkdir($dstfolder, 0755); 
}  
$images=explode(DEFAULT_OPTION_DELIMITER, $value);	
for($i=0;$i<count($images);$i++){
$srcfile=ROOT_PATH.'images/temp_question/'.$import_id.'/'.$images[$i];
if (file_exists($srcfile)) {
copy($srcfile, $dstfolder.'/'.$images[$i]);
unlink($srcfile);
}else{
$error[$k]='Question Number '.$key.' option '.$i.' image missing : '.$images[$i].'\n\r';
$k++;
}
}
}
return $error;
}


function move_question_images_to_main_folder($question_image_array,$import_id){

$k=0;
foreach ($question_image_array as $key => $value) {
 $dstfolder=ROOT_PATH.'images/questions/'.$key;
if(!is_dir($dstfolder)){
mkdir($dstfolder, 0755); 
}  
$srcfile=ROOT_PATH.'images/temp_question/'.$import_id.'/'.$value;
if (file_exists($srcfile)) {
copy($srcfile, $dstfolder.'/'.$value);
unlink($srcfile);
}else{
$error[$k]='Question Number '.$key.' image missing : '.$value.'\n\r';
$k++;
}
}
return $error;

}


?>
