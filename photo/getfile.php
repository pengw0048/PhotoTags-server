<?php
include_once 'config.php';
include_once 'resize.php';
$gid=GroupNameToID($dbh,GetField('group'));
$fid=GetField('fileid');
$entry=SQLFetch($dbh, 'SELECT * FROM entry WHERE id=?', array($fid));
if($entry==FALSE)ExitCode(404);
$name='storage/'.$fid;
if(isset($_REQUEST['width'])&&isset($_REQUEST['height'])){
    $width=GetField('width');
    $height=GetField('height');
    if($width!=null&&$height!=null&&$width!=""&&$height!=""){
        $newname='storage/'.$fid.'_'.$width.'_'.$height;
        if(!file_exists($newname)){
            $resp=smart_resize_image($name,null,intval($width),intval($height),true,$newname,false,false,75);
            if(!$resp)ExitCode(500);
        }
        $name=$newname;
    }
}
$fp=fopen($name,'rb');
header("Content-Length: ".filesize($name));
header("Content-Disposition: attachment;filename=".$entry["name"]);
fpassthru($fp);
fclose($fp);
exit;
?>
