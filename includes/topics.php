<?php

add_filter ('bbp_before_has_topics_parse_args', 'pg_has_topics') ;

function pg_has_topics( $args = '' ) {
	
	$default_post_parent   = bbp_is_single_forum() ? bbp_get_forum_id() : 'any';
	
	if ($default_post_parent == 'any') {
	global $wpdb;
	
	$post_ids=$wpdb->get_col("select ID from $wpdb->posts where post_type = 'topic'") ;
//check this list against those the user is allowed to see, and create a list of valid ones for the wp_query in bbp_has_topics
$allowed_posts = check_private_groups_topic_ids($post_ids) ;
	
    $args['post__in'] = $allowed_posts;	
	}
return $args;
}


//the function to check the above !
function check_private_groups_topic_ids($post_ids) {
    
    //Init the Array which will hold our list of allowed posts
    $allowed_posts = array();
    

    //Loop through all the posts
	foreach ( $post_ids as $post_id ) {
		//Get the Forum ID based on Post Type Topic
        $forum_id = private_groups_get_forum_id_from_post_id($post_id, 'topic');
		//Check if User has permissions to view this Post ID
		//by calling the function that checks if the user can view this forum, and hence this post
        if (private_groups_can_user_view_post_id($forum_id)) {
		
            //User can view this post - add it to the allowed array
            array_push($allowed_posts, $post_id);
        }
}
   
    //Return the list		
    return $allowed_posts;
}

