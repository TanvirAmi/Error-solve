<?php
//have to put this code in functions.php file
function modified_seo_date(){
    $u_time = get_the_time('U');
    $u_modified_time = get_the_modified_time('U');
if ($u_modified_time > $u_time) {
    echo "Last updated: <time datetime=";
    the_modified_time('c');
    echo " itemprop='dateModified' class='entry-time'>";
    the_modified_time('F jS, Y');
    echo "</time>"; }
else {
    echo "Published on: <time datetime=";
    the_time('c');
    echo " itemprop='datePublished' class='entry-time'>";
    the_time('F jS, Y');
    echo "</time>"; 
    }
}
?>
