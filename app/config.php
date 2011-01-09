<?php
//Set to true to use the automagic routes. Disabled by default for security.
//Think for a long time whether you really need automagic routes. If you think
//  that you do, ask yourself: "Am I just lazy?"
$config['automagic_routes'] = false;
//The default controller, function, and params.
$config['default_controller'] = "welcome";
$config['default_function'] = "index";
$config['default_params'] = null;
//The path to index.php on your server. IMPORTANT: At the moment, you need to
//  add a trailing slash.
$config['base_path'] = 'http://localhost/MVC/index.php/';
//The path to your stylesheets folder. Also needs a trailing slash.
$config['style_path'] = 'http://localhost/MVC/app/stylesheets/';