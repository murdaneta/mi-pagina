<?php

vc_add_param ( 'vc_row', array (
		'type' => 'dropdown',
		'heading' => __ ( 'Preset Background Color', 'cumulo_plugin' ),
		'param_name' => 'bg_color_preset',
		'value' => array(
				__( 'Theme default', 'cumulo_plugin' ) => '',
				__( 'Primary color', 'cumulo_plugin' ) => 'doption-primary-color-as-background',
				__( 'Secondary background color', 'cumulo_plugin' ) => 'doption-secondary-bg-color',
				__( 'Dark Background color', 'cumulo_plugin' ) => 'doption-dark-bg-color',
		),
		'description' => __ ( 'Select preset background color from theme option values. To use this option, you must clear \'Background Color\' option in this tab.', 'cumulo_plugin' ),
		'group' => __ ( 'Design Options', 'js_composer' ) 
) );

vc_add_param ( 'vc_row', array (
		'type' => 'textfield',
		'heading' => __ ( 'Background Position', 'cumulo_plugin' ),
		'param_name' => 'bg_pos',
		'value' => '',
		'description' => __ ( 'Enter Background Position, e.g. \'center center\' or \'120px 100px\'.', 'cumulo_plugin' ),
		'group' => __ ( 'Design Options', 'js_composer' ) 
) );

vc_add_param ( 'vc_row', array (
    'type' => 'dropdown',
    'heading' => __ ( 'Background Attachment', 'cumulo_plugin' ),
    'param_name' => 'bg_attachment',
    'value' => array(
        __( 'Scroll', 'cumulo_plugin' ) => 'scroll',
        __( 'Fixed', 'cumulo_plugin' ) => 'fixed'
    ),
    'description' => __ ( 'Select background attachment.', 'cumulo_plugin' ),
    'group' => __ ( 'Design Options', 'js_composer' )
) );

/*
vc_add_param ( 'vc_row', array (
    'type' => 'dropdown',
    'heading' => __ ( 'Background Repeat', 'cumulo_plugin' ),
    'param_name' => 'bg_repeat',
    'value' => array(
        __( 'Theme default', 'cumulo_plugin' ) => '',
        __( 'No Repeat', 'cumulo_plugin' ) => 'no-repeat',
        __( 'Repeat', 'cumulo_plugin' ) => 'repeat',
        __( 'Repeat X only', 'cumulo_plugin' ) => 'repeat-x',
        __( 'Repeat Y only', 'cumulo_plugin' ) => 'repeat-y',
    ),
    'description' => __ ( 'Select background repeat style.', 'cumulo_plugin' ),
    'group' => __ ( 'Design Options', 'js_composer' )
) );

*/