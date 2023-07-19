<?php

		// insert post - set post status to draft
		$args = array(
			 'post_title' => 'Building Web Apps with WordPress',
			 'post_excerpt' => 'WordPress as an Application Framework',
			 'post_content' => 'WordPress is the key to successful cost effective
			 web solutions in most situations. Build almost anything on top of the
			 WordPress platform. DO IT NOW!!!!',
			 'post_status' => 'publish',
			 'post_type' => 'post',
			 'post_author' => 1,
			 'post_category' => array( 8,39 ),
			 'menu_order' => 0
		);
		$post_id = wp_insert_post( $args );
		echo 'post ID: ' . $post_id . '<br>';

		// update post - change post status to publish
		$args = array(
		 'ID' => $post_id,
		 'post_status' => 'publish'
		);
		wp_update_post( $args );


		// get post - return post data as an object
		$post = get_post( $post_id );
		echo 'Object Title: ' . $post->post_title . '<br>';

		// get post - return post data as an array
		$post = get_post( $post_id, ARRAY_A );
		echo 'Array Title: ' . $post['post_title'] . '<br>';

		// delete post - skip the trash and permanently delete it
		wp_delete_post( $post_id, true );

		// get posts - return 100 posts
		$posts = get_posts( array( 'numberposts' => '100') );

		// loop all posts and display the ID & title
		foreach ( $posts as $post ) {
		 echo $post->ID . ': ' .$post->post_title . '<br>';
		}

		/*
		The output from the above example should look something like this:
		post ID: 589
		Object Title: Building Web Apps with WordPress
		Array Title: Building Web Apps with WordPress
		"A list of post IDs and Titles from your install"
		*/

		// get posts - return the latest post
		$posts = get_posts( array( 'numberposts' => '1', 'orderby' =>
		 'post_date', 'order' => 'DESC' ) );
		foreach ( $posts as $post ) {

		 $post_id = $post->ID;

		 // update post meta - public metadata
		 $content = 'You SHOULD see this custom field when editing your latest post.';
		 update_post_meta( $post_id, 'bwawwp_displayed_field', $content );

		 // update post meta - hidden metadata
		 $content = str_replace( 'SHOULD', 'SHOULD NOT', $content );
		 update_post_meta( $post_id, '_bwawwp_hidden_field', $content );

		 // array of student logins
		 $students[] = 'dalya';
		 $students[] = 'ashleigh';
		 $students[] = 'lola';
		 $students[] = 'isaac';
		 $students[] = 'marin';
		 $students[] = 'brian';
		 $students[] = 'nina';

		 // add post meta - one key with array as value, array will be serialized
		 // automatically
		 add_post_meta( $post_id, 'bwawwp_students', $students, true );

		 // loop students and add post meta record for each student

		 foreach ( $students as $student ) {

		 add_post_meta( $post_id, 'bwawwp_student', $student );

		 }

		
		 // get post meta - get all meta keys

		 $all_meta = get_post_meta( $post_id );
		 echo '<pre>';
		 print_r( $all_meta );
		 echo '</pre>';

		 // get post meta - get 1st instance of key

		 $student = get_post_meta( $post_id, 'bwawwp_student', true );
		 echo 'oldest student: ' . $student;

		 // delete post meta

		 delete_post_meta( $post_id, 'bwawwp_student' );

		}

		/*
		The output from the above example should look something like this:
		Array
		(
		 [_bwawwp_hidden_field] => Array
			 (
			 [0] => You SHOULD NOT see this custom field when editing your latest post.
			 )
		 [bwawwp_displayed_field] => Array
			 (
			 [0] => You SHOULD see this custom field when editing your latest post.
			 )
		 [bwawwp_students] => Array
			 (
			 [0] => a:7:{i:0;s:5:"dalya";i:1;s:8:"ashleigh";i:2;s:4:"lola";i:3;s:5:
			 "isaac";i:4;s:5:"marin";i:5;s:5:"brian";i:6;s:4:"nina";}
			 )
		 [bwawwp_student] => Array
			 (
			 [0] => dalya
			 [1] => ashleigh
			 [2] => lola
			 [3] => isaac
			 [4] => marin
			 [5] => brian
			 [6] => nina
			 )
		)
		oldest student: dalya
		*/


		/**
		 * Register a custom post type called "book".
		 *
		 * @see get_post_type_labels() for label keys.
		 */
		function wpdocs_codex_book_init() {
		    $labels = array(
		        'name'                  => _x( 'Books', 'Post type general name', 'textdomain' ),
		        'singular_name'         => _x( 'Book', 'Post type singular name', 'textdomain' ),
		        'menu_name'             => _x( 'Books', 'Admin Menu text', 'textdomain' ),
		        'name_admin_bar'        => _x( 'Book', 'Add New on Toolbar', 'textdomain' ),
		        'add_new'               => __( 'Add New', 'textdomain' ),
		        'add_new_item'          => __( 'Add New Book', 'textdomain' ),
		        'new_item'              => __( 'New Book', 'textdomain' ),
		        'edit_item'             => __( 'Edit Book', 'textdomain' ),
		        'view_item'             => __( 'View Book', 'textdomain' ),
		        'all_items'             => __( 'All Books', 'textdomain' ),
		        'search_items'          => __( 'Search Books', 'textdomain' ),
		        'parent_item_colon'     => __( 'Parent Books:', 'textdomain' ),
		        'not_found'             => __( 'No books found.', 'textdomain' ),
		        'not_found_in_trash'    => __( 'No books found in Trash.', 'textdomain' ),
		        'featured_image'        => _x( 'Book Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
		        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
		        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
		        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
		        'archives'              => _x( 'Book archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
		        'insert_into_item'      => _x( 'Insert into book', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
		        'uploaded_to_this_item' => _x( 'Uploaded to this book', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
		        'filter_items_list'     => _x( 'Filter books list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
		        'items_list_navigation' => _x( 'Books list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
		        'items_list'            => _x( 'Books list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
		    );
		 
		    $args = array(
		        'labels'             => $labels,
		        'public'             => true,
		        'publicly_queryable' => true,
		        'show_ui'            => true,
		        'show_in_menu'       => true,
		        'query_var'          => true,
		        'rewrite'            => array( 'slug' => 'book' ),
		        'capability_type'    => 'post',
		        'has_archive'        => true,
		        'hierarchical'       => false,
		        'menu_icon' => 'dashicons-book',
		        'menu_position'      => 15,
		        'show_in_rest' => true, // enable blocks in your custom post type.
		        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
		    );
		 
		    register_post_type( 'book', $args );
		}
		 
		add_action( 'init', 'wpdocs_codex_book_init' );
