Models and view now work!
<?php echo $this->data; ?> <br />
<?php $this->link_to("Welcome", "welcome_index_path"); ?><br/>
<?php $this->link_to("View", "welcome_view_path"); ?><br/>
<?php $this->link_to("Named Scopes", "welcome_recent_path"); ?><br/>
<?php $this->link_to("Model Test", "welcome_model_test_path"); ?>