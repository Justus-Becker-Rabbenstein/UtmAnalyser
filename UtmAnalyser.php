<?php

// override default memory limit, since log file too big
ini_set('memory_limit', '-1');

// read contents from file
$logData = file_get_contents('../updatev12-access-pseudonymized.log');
echo nl2br($logData);

?>