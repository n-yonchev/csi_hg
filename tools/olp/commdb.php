<?php

$dbname= "exof";

function getdbconst(){
    $htho= $_SERVER["HTTP_HOST"];
    $dbconst= 'mysql://softhouse:MFPY6t4B5vDm3GYj@localhost/'.$GLOBALS["dbname"];
    return $dbconst;
}
