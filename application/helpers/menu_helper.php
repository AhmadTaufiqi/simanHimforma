<?php

if (!function_exists('active_link')) {
    function active_menu($controller)
    {
        $CI = $this->uri->segment('3');
        $class = $CI->router->fetch_class();
        return ($class == $controller) ? 'active' : '';
    }
}
