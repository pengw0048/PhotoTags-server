<?php
include_once 'config.php';
$gid=GroupNameToID($dbh,GetField('group'));
$pid=GetField('folderid');
$entries=SQLFetchAll($dbh, 'SELECT id,name,isfolder,size,createtime FROM entry WHERE groupid=? AND parentid=?', array($gid,$pid));
foreach ($entries as &$entry){
    $tid=$entry['id'];
    $tags=SQLFetchAll($dbh, 'SELECT tagid as id,tag.name as name FROM tag,entrytag WHERE tag.id=entrytag.tagid AND entrytag.entryid=?', array($tid));
    if($tags!=FALSE)$entry['tags']=$tags;
	else $entry['tags']=array();
}
echo json_encode($entries);
?>
