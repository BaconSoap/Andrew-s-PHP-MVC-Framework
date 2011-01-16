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

//The path to your javascript folder. Also needs a trailing slash.
$config['javascript_path'] = 'http://localhost/MVC/app/javascript/';

//jQuery version
$config['jquery_version'] = '1.4.4';

//Use local jQuery: false uses Google's jQuery.
$config['jquery_local'] = true;

//Database configuration
$config['db']['driver'] = 'mysql';
$config['db']['server'] = 'localhost';
$config['db']['database'] = 'test';
$config['db']['username'] = 'test';
$config['db']['password'] = 'test';

//Populate created_at and updated_at. NOTE: If this is true, then your table
//  must have a created_at and updated_at column. These should be timestamps.
$config['timestamp_records'] = true;