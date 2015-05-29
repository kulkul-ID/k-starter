<?php

if(!function_exists( 'config' ))
{
    function config($item, $index = '')
    {
        $CI = &get_instance();
        return $CI->config->item($item, $index);
    }
}