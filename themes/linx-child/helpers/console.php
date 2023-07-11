<?php
/**
 * Console log
 */
function console($log) {

    if( is_array($log) ) {

        $log = json_encode($log);
        $log = str_replace('"', '', $log);

        echo '<script>console.log("array:'.$log.'");</script>';

    } else if( is_object($log) ) {

        $log = json_encode($log);
        $log = str_replace('"', '', $log);

        echo '<script>console.log("object:'.$log.'");</script>';

    } else {

        $log = str_replace('"', '', $log);
        
        echo '<script>console.log("'.$log.'");</script>';
    }
}

function consoleret($log) {

    if( is_array($log) ) {

        $log = json_encode($log);
        $log = str_replace('"', '', $log);

        return '<script>console.log("array:'.$log.'");</script>';

    } else if( is_object($log) ) {

        $log = json_encode($log);
        $log = str_replace('"', '', $log);

        return '<script>console.log("object:'.$log.'");</script>';

    } else {

        $log = str_replace('"', '', $log);
        
        return '<script>console.log("'.$log.'");</script>';
    }
}

?>