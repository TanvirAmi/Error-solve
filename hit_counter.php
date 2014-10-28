
<?php
//In functions.php
function getHits($postID){
    $hits_token = 'post_views_hits';
    $hits = get_post_meta($postID, $hits_token, true);
    if($hits==''){
        delete_post_meta($postID, $hits_token);
        add_post_meta($postID, $hits_token, '0');
        return "0 View";
    }
    return $hits.' Views';
}
function setHits($postID) {
    $hits_token = 'post_views_hits';
    $hits = get_post_meta($postID, $hits_token, true);
    if($hits==''){
        $hits = 0;
        delete_post_meta($postID, $hits_token);
        add_post_meta($postID, $hits_token, '0');
    }else{
        $hits++;
        update_post_meta($postID, $hits_token, $hits);
    }
}

//In single.php
 setHits(get_the_ID());
 
 //And the output area
 echo getHits(get_the_ID());
