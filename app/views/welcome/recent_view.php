<?php
foreach($this->all_posts as $post)
{
    foreach($post as $field => $value)
    {
        ?>
        <?php echo $field; ?>: <?php echo $value; ?><br />
        <?php
    } echo '<br/>';
}
?>