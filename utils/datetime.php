<?php

function getDatetimeNow() {
    $tz_object = new DateTimeZone('Etc/GMT-3');
    $datetime = new DateTime();
    $datetime->setTimezone($tz_object);
    return $datetime->format('Y\-m\-d\ H:i:s');
}

?>