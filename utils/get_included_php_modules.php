<?php

function get_metrics ($table) {

    $new_metric = '';
    $result=conn()->query("SELECT module_name,update_time FROM $table");
    $columns = mysqli_num_fields($result); 

    while($row = $result->fetch_assoc())
    {
        $name_metric=$row["module_name"];
        $updatetime_metric=$row["update_time"];
        $new_metric="$new_metric\nphp_module_info{module=\"$name_metric\",update_time=\"$updatetime_metric\"} 1";
    }

    return $new_metric;

}

?>