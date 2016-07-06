<?php
include_once 'config.php';
$gid=GroupNameToID($dbh,GetField('group'));
$tags=SQLFetchAll($dbh, 'SELECT id,name FROM tag WHERE groupid=?', array($gid));
foreach ($tags as &$tag){
    $tid=$tag['id'];
    $res=SQLFetch($dbh, 'SELECT COUNT(*) as tcount FROM entrytag WHERE tagid=?', array($tid));
    if($tags!=FALSE)$tag['count']=$res['tcount'];
}
echo json_encode($tags);
?>
