<?php

// override default memory limit, since log file too big
ini_set('memory_limit', '-1');

// read contents from file
$logData = file_get_contents('../updatev12-access-pseudonymized_short.log');

// split input logfile string into seperate indexed array
$logDataIntoArray = explode(" ", $logData);

// count array size, to get number for the for loop
$arrayIndexSize = count($logDataIntoArray);
// create arrays to transfer indexed array into key-value (associative array)
$temporaryArray = array();
$associativeArray = array();
$finishedArray = array();

// keys array for array_combine to get keys for the values
$keys = array("PublicIP", "UpdServName", "AccessTime", "HTTP Method", "APIUrl",
    "HTTP-Version", "HTTPResponseCode", "ResponseSizeInBytes", "ProxyName", "RequestTimeInSeconds", "SerialNumber",
    "FirmwareVersion", "System Status Information", "NotAfter", "RemainingDays");

// for loop to loop through the data to get key-value pairs, to be able to later on filter data
for ($i = 0; $i < $arrayIndexSize; $i++) {
    $temporaryArray[] = $logDataIntoArray[$i];

    if (count($temporaryArray) == 15) {
        $associativeArray = array_combine($keys, $temporaryArray);
        $finishedArray[] = $associativeArray;
        $temporaryArray = array();
    }
}

print_r($finishedArray);

?>