<?php
if(empty(session_start())){
    session_start();
}

$host = $_SERVER['HTTP_HOST'] == 'localhost'? 'localhost': $_SERVER['HTTP_HOST'];
$mysql_bdname = $_SERVER['HTTP_HOST'] == 'localhost'? 'bdreuse': 'epiz_26786007_bdreuse';
$mysql_host = $_SERVER['HTTP_HOST'] == 'localhost'? 'localhost': 'sql104.epizy.com';
$mysql_user = $_SERVER['HTTP_HOST'] == 'localhost'? 'root': 'epiz_26786007';
$mysql_pass = $_SERVER['HTTP_HOST'] == 'localhost'? '': 'luis77363878';


define("ROOT", "http://".$host."/projeto-reuse");
define("URL_VIEW_ADMIN", "../../templates/admin");
define("URL_VIEW_WEB", "../../templates/web");
define("URL_VIEW_DOADOR", "../../templates/doador");
define("URL_VIEW_COLABORADOR", "../../templates/colaborador");
define("MYSQL_BDNAME", $mysql_bdname);
define("MYSQL_HOST", $mysql_host);
define("MYSQL_USER", $mysql_user);
define("MYSQL_PASS", $mysql_pass);

define("DATE_TIME_US" , "Y/m/d H:i:s");
define("DATE_TIME_BR" , "d/m/Y H:i:s");
define("DATE_US" , "Y/m/d");
define("DATE_BR" , "d/m/Y");

function url(string $uri = null): string
{
    if($uri){
        return ROOT . "/{$uri}";
    }
    return ROOT;
}