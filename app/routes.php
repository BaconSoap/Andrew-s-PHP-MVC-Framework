<?php
$this->route("welcome/index", "welcome", "index");
$this->route("welcome/view", "welcome", "view");
$this->route("welcome/model_test", "welcome", "model_test");
$this->route("welcome/recent", "welcome", "recent");
//Routing, at the moment, takes the form
//  $this->route("URI", "controller", "function");
//  Ex: $this->route('posts', 'posts', 'index');