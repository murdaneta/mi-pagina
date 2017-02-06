<?php

vc_add_param ( 'vc_column', array (
		'type' => 'checkbox',
		'heading' => __ ( 'Fit in the grid.', 'cumulo_plugin' ),
		'param_name' => 'fit_in_container',
		'description' => __ ( 'Check if the content of this column should stay within the container. This works only when the parent row is set to \'Stretch row with content\' .', 'cumulo_plugin' ),
		'group' => __ ( 'Design Options', 'js_composer' ) 
) );
