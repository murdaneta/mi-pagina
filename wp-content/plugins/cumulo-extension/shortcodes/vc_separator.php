<?php
//vc_add_param ( 'vc_separator', array (
vc_remove_param( 'vc_separator', 'el_width');

vc_add_param ( 'vc_separator', array (
    'type' => 'dropdown',
    'heading' => __ ( 'Custom Width', 'cumulo_plugin' ),
    'param_name' => 'el_width',
    'value' => array(
        __( '100%', 'cumulo_plugin' ) => '100',
        __( '90%', 'cumulo_plugin' ) => '90',
        __( '80%', 'cumulo_plugin' ) => '80',
        __( '70%', 'cumulo_plugin' ) => '70',
        __( '60%', 'cumulo_plugin' ) => '60',
        __( '50%', 'cumulo_plugin' ) => '50',
        __( '40%', 'cumulo_plugin' ) => '40',
        __( '30%', 'cumulo_plugin' ) => '30',
        __( '20%', 'cumulo_plugin' ) => '20',
    ),
) );
