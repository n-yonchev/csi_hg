<?php

# име на БД 
$dbname= "exof";

function getdbconst(){
    $dbconst= 'mysql://softhouse:MFPY6t4B5vDm3GYj@localhost/'.$GLOBALS["dbname"];
    return $dbconst;
}
