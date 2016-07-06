<?php
include_once 'config.php';
$name=GetField('group');
$groupinfo=SQLFetch($dbh, 'SELECT * FROM `group` WHERE name=?', array($name));
$newgroup=FALSE;
if($groupinfo==FALSE){
    $newgroup=true;
    SQLExecute($dbh, 'INSERT INTO `group` (name,ip) VALUES (?,?)', array($name,$ip));
    $groupinfo=SQLFetch($dbh, 'SELECT * FROM `group` WHERE name=?', array($name));
}
$groupinfo['isnew']=$newgroup;
echo json_encode($groupinfo);
?>
