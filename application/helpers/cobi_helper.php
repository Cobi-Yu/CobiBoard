<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    function debug_var_dump($data)
    {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
    }   
    
?>