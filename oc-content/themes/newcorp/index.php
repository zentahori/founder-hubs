<?php

/*
Theme Name: NewCorp
Theme URI: http://osclass.org
Description: This is the Osclass theme for a job board.
Version:  2.4.0
Author: Osclass Team
Author URI: http://osclass.org
Widgets: header,categories
Theme update URI: newcorp
*/

    function newcorp_theme_info() {
        $theme = array(
            'name'         => 'NewCorp'
            ,'version'     => '2.4.0'
            ,'description' => 'This is the Osclass theme for a job board.'
            ,'author_name' => 'Osclass Team'
            ,'author_url'  => 'http://osclass.org'
            ,'locations'   => array('header', 'categories')
        );

        return $theme;
    }

?>