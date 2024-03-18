<?php
class CheckDataConsistency
{

    function checkIp($logData) {
        if (filter_var($logData, FILTER_VALIDATE_IP)) {
            return true;
        } else {
            return false;
        }
    }
    function checkUpdServName($logData) {
    }
    function checkAccessTime($logData) {
    }
    function checkHttpMethod($logData) {
    }
    function checkApiUrl($logData) {
    }
    function checkHttpVersion($logData) {
    }
    function checkHttpResponseCode($logData) {
    }
    function checkResponseSizeInBytes($logData) {
    }
    function checkProxyName($logData) {
    }
    function checkRequestTimeInSeconds($logData) {
    }
    function checkSerialNumber($logData) {
    }
    function checkFirmwareVersion($logData) {
    }
    function checkSpecs($logData) {
    }
    function checkNotAfter($logData) {
    }
    function checkRemainingDays($logData) {
    }

}

?>