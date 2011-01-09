<?php
$this->route("welcome/index", "welcome", "index");
$this->route("welcome/view", "welcome", "view");

//Routing, at the moment, takes the form
//  $this->route("URI", "controller", "function");
//  Ex: $this->route('posts', 'posts', 'index');