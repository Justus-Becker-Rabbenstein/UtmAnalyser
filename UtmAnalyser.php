<?php
// import checking library for analysis of logfile data consistency
require('CheckDataConsistency.php');

// override default memory limit, since log file too big
ini_set('memory_limit', '-1');

// print Logo
print_r("  _    _ _______ __  __                        _                     
 | |  | |__   __|  \/  |     /\               | |                    
 | |  | |  | |  | \  / |    /  \   _ __   __ _| |_   _ ___  ___ _ __ 
 | |  | |  | |  | |\/| |   / /\ \ | '_ \ / _` | | | | / __|/ _ \ '__|
 | |__| |  | |  | |  | |  / ____ \| | | | (_| | | |_| \__ \  __/ |   
  \____/   |_|  |_|  |_| /_/    \_\_| |_|\__,_|_|\__, |___/\___|_|   
                                                  __/ |              
                                                 |___/               ");

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

    print_r($temporaryArray);
    // create CheckDataConsistency object
    $checkCurrentIp = new CheckDataConsistency();
    // use method checkIp on index 0 (is IP)
    // if returns false - clear array, since first index isn't an IP
    if (!$checkCurrentIp->checkIp($temporaryArray[0])) {
        $temporaryArray = array_diff($temporaryArray, $temporaryArray);
    }

    if (count($temporaryArray) == 15) {
        $associativeArray = array_combine($keys, $temporaryArray);
        $finishedArray[] = $associativeArray;
        $temporaryArray = array_diff($temporaryArray, $temporaryArray);
    }
}

// First task
// filter the key-value array for serial numbers
$serialNumbers = array_column($finishedArray, 'SerialNumber');
// count found serial numbers
$countSerialNumbers = array_count_values($serialNumbers);
// sort ascending with keeping key-value pairs
$sortHighestTen = arsort($countSerialNumbers, SORT_NUMERIC );

// First task answer
print_r('
What are the 10 license serial numbers that try to access the server the most? How many
times are they trying to access the server?
');
// cut at 10th entry
print_r(array_slice($countSerialNumbers, 0, 10, true));

?>