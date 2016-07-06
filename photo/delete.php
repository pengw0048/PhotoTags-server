<?php
include_once 'config.php';
$gid=GroupNameToID($dbh,GetField('group'));
$fid=GetField('fileid');
SQLExecute($dbh, 'DELETE FROM entry WHERE id=?', array($fid));
SQLExecute($dbh, 'DELETE FROM entrytag WHERE entryid=?', array($fid));
@array_map('unlink',glob('storage/'.$fid.'_*'));
@unlink('storage/'.$fid);
echo 'ok';
?>
