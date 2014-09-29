//Have to remove this code from index.php
<?php get_header(); ?>

//Have to add this code for fix the error
<?php ini_set('display_errors', 0); ?>
<?php
if (function_exists('get_header')) {
    get_header();
}else{
    /* Redirect browser */
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "");
    /* Make sure that code below does not get executed when we redirect. */
    exit;
}; ?>
