<?php
function move_passage_images_to_main_folder($passage_image_array,$import_id){
$k=0;

foreach ($passage_image_array as $key => $value) {
 $dstfolder=ROOT_PATH.'images/passages/'.$key;
if(!is_dir($dstfolder)){
mkdir($dstfolder, 0755); 
}  
$srcfile=ROOT_PATH.'images/temp_passages/'.$import_id.'/'.$value;
if (file_exists($srcfile)) {
copy($srcfile, $dstfolder.'/'.$value);
unlink($srcfile);
}else{
$error[$k]='Passage Number '.$key.' image missing : '.$value.'\n\r';
$k++;
}
}
return $error;

}


?>
