<?php
// Replaces the excerpt "more" text by a link
function new_excerpt_more($more) {
       global $post;
    return '<a class="moretag" href="'. get_permalink($post->ID) . '">..Your text is here</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

?>
