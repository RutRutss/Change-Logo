<?php
/*
Plugin Name: Change Logo X
Description: Allows changing WordPress logos for Login screen and Admin bar.
Version: 1.0
Author: Wisarut Yuensuk
*/

// ตรวจสอบว่าถ้าเข้าถึงได้โดยตรง จะไม่สามารถเข้าถึงได้โดยตรง
defined('ABSPATH') or die('No direct access allowed.');

function custom_logo_customize_register($wp_customize)
{

    $wp_customize->add_setting('custom_logo_setting', array(
        'default' => '',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'custom_logo_control', array(
        'label' => 'Change Logo',
        'section' => 'title_tagline', // เปลี่ยนเป็น 'title_tagline' หรือส่วนที่ใกล้เคียง
        'settings' => 'custom_logo_setting',
    )));
}

add_action('customize_register', 'custom_logo_customize_register');

function custom_login_logo()
{
    $logo_url = get_theme_mod('custom_logo_setting'); // ดึง URL ของภาพที่อัปโหลดมาใช้

    if ($logo_url) {
        echo '<style type="text/css">
                .login h1 a { background-image: url(' . $logo_url . ') !important; }
            </style>';
    }
}

add_action('login_head', 'custom_login_logo');

function custom_admin_logo()
{
    $logo_url = get_theme_mod('custom_logo_setting'); // ดึง URL ของภาพที่อัปโหลดมาใช้

    if ($logo_url) {
    }
}

add_action('admin_head', 'custom_admin_logo');
