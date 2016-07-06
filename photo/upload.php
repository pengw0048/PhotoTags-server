<?php
include_once 'config.php';
$gid=GroupNameToID($dbh,GetField('group'));
if ($_FILES["file"]["error"] > 0){
    echo "Error: " . $_FILES["file"]["error"] . "<br />";
}else{
    $size=$_FILES["file"]["size"];
    $tname=$_FILES["file"]["tmp_name"];
    $name=GetField('name');
    $pid=GetField('folderid');
    SQLExecute($dbh, 'INSERT INTO entry (groupid,parentid,name,isfolder,size,ip) VALUES (?,?,?,0,?,?)', array($gid,$pid,$name,$size,$ip));
    $fid=$dbh->lastInsertId();
    move_uploaded_file($tname, 'storage/'.$fid);
    $eid=$dbh->lastInsertId();
    echo $eid;
}
?>
