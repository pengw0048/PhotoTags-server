<?php
$host='localhost';
$dbname='photo';
$user='root';
$pass='';
function GetIP(){
    if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
        $ip = getenv("HTTP_CLIENT_IP");
    else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
        $ip = getenv("HTTP_X_FORWARDED_FOR");
    else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
        $ip = getenv("REMOTE_ADDR");
    else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
        $ip = $_SERVER['REMOTE_ADDR'];
    else
        $ip = "unknown";
    return($ip);
}
function GetField($name){
    if(!isset($_REQUEST[$name]))ExitCode(400);
    return $_REQUEST[$name];
}
function SQLFetch($dbh,$statement,$param){
    $sql=$dbh->prepare($statement);
    $sql->execute($param);
    $ret=$sql->fetch(PDO::FETCH_ASSOC);
    $sql=null;
    return $ret;
}
function SQLFetchAll($dbh,$statement,$param){
    $sql=$dbh->prepare($statement);
    $sql->execute($param);
    $ret=$sql->fetchAll(PDO::FETCH_ASSOC);
    $sql=null;
    return $ret;
}
function SQLExecute($dbh,$statement,$param){
    $sql=$dbh->prepare($statement);
    $sql->execute($param);
    $sql=null;
}
function GroupNameToID($dbh,$name){
    $groupinfo=SQLFetch($dbh, 'SELECT * FROM `group` WHERE name=?', array($name));
    if($groupinfo==FALSE)ExitCode(400);
    return $groupinfo['id'];
}
function ExitCode($code){
    http_response_code($code);
    exit;
}
$curtime=date('Y-m-d H:i:s');
$ip=GetIP();
$dbh = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
?>
