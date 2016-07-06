<?php
include_once 'config.php';
$gid=GroupNameToID($dbh,GetField('group'));
$pid=GetField('folderid');
$name=GetField('name');
SQLExecute($dbh, 'INSERT INTO entry (groupid,parentid,name,isfolder,ip) VALUES (?,?,?,1,?)', array($gid,$pid,$name,$ip));
$eid=$dbh->lastInsertId();
echo $eid;
?>