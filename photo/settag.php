<?php
include_once 'config.php';
$gid=GroupNameToID($dbh,GetField('group'));
$fid=GetField('fileid');
$tagstr=GetField('tags');
$tags=explode('|',$tagstr);
SQLExecute($dbh, 'DELETE FROM entrytag WHERE entryid=?', array($fid));
foreach ($tags as $tag){
    $tid=SQLFetch($dbh, 'SELECT id FROM tag WHERE name=?', array($tag));
    if($tid==FALSE){
        SQLExecute($dbh, 'INSERT INTO tag (groupid,name,ip) VALUES (?,?,?)', array($gid,$tag,$ip));
        $tid=$dbh->lastInsertId();
    }else{
		$tid=$tid['id'];
	}
    SQLExecute($dbh, 'INSERT INTO entrytag (entryid,tagid) VALUES (?,?)', array($fid,$tid));
}
echo 'ok';
?>
