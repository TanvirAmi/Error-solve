<?php

//this script will add  the functionality which open a hyper link inside the comment with a new tab.

function comment_links_in_new_tab($text) {
$return = str_replace('<a', '<a target="_blank"', $text);
return $return;
}
add_filter('get_comment_author_link', 'comment_links_in_new_tab');
add_filter('comment_text', 'comment_links_in_new_tab');

?>
