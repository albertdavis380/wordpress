<?php


		 /*array (
		            'taxonomy' => 'category', //empty string(''), false, 0 don't work, and return empty array
		            'orderby' => 'name',
		            'order' => 'ASC',
		            'hide_empty' => true, //can be 1, '1' too
		            'include' => 'all', //empty string(''), false, 0 don't work, and return empty array
		            'exclude' => 'all', //empty string(''), false, 0 don't work, and return empty array
		            'exclude_tree' => 'all', //empty string(''), false, 0 don't work, and return empty array
		            'number' => false, //can be 0, '0', '' too
		            'offset' => '',
		            'fields' => 'all',
		            'name' => '',
		            'slug' => '',
		            'hierarchical' => true, //can be 1, '1' too
		            'search' => '',
		            'name__like' => '',
		            'description__like' => '',
		            'pad_counts' => false, //can be 0, '0', '' too
		            'get' => '',
		            'child_of' => false, //can be 0, '0', '' too
		            'childless' => false,
		            'cache_domain' => 'core',
		            'update_term_meta_cache' => true, //can be 1, '1' too
		            'meta_query' => '',
		            'meta_key' => array(),
		            'meta_value'=> '',
		    )*/
            
            // Get all term data for any given term:

		    $terms = get_terms( array( 
			    'taxonomy' => 'category',
			    'parent'   => 0
			) );

            
			/*Array   //OUTPUT
			(
			    [0] => WP_Term Object
			        (
			            [term_id] => 7
			            [name] => heyyyyyyyyyyyyy
			            [slug] => heyyyyyyyyyyyyy
			            [term_group] => 0
			            [term_taxonomy_id] => 7
			            [taxonomy] => category
			            [description] => 
			            [parent] => 0
			            [count] => 1
			            [filter] => raw
			        )

			    [1] => WP_Term Object
			        (
			            [term_id] => 4
			            [name] => hoi
			            [slug] => hoi
			            [term_group] => 0
			            [term_taxonomy_id] => 4
			            [taxonomy] => category
			            [description] => 
			            [parent] => 0
			            [count] => 1
			            [filter] => raw
			        )

			    [2] => WP_Term Object
			        (
			            [term_id] => 8
			            [name] => MYNEW
			            [slug] => mynew
			            [term_group] => 0
			            [term_taxonomy_id] => 8
			            [taxonomy] => category
			            [description] => 
			            [parent] => 0
			            [count] => 1
			            [filter] => raw
			        )
			)*/


            // Get all term data for any given term:

			$term = get_term( 3, "category" );

			/*WP_Term Object
			(
			    [term_id] => 3
			    [name] => test
			    [slug] => test
			    [term_group] => 0
			    [term_taxonomy_id] => 3
			    [taxonomy] => category
			    [description] => 
			    [parent] => 0
			    [count] => 1
			    [filter] => raw
			)*/

           // Adds a new term to the database:

			wp_insert_term(
			    'Apple',   // the term 
			    'category', // the taxonomy
			    array(
			        'description' => 'A yummy apple.',
			        'slug'        => 'apple',
			        'parent'      => 0
			    )
			);

            // Update term based on arguments provided.

			$update = wp_update_term( 1, 'category', array(
			    'name' => 'Non Catégorisé',
			    'slug' => 'non-categorise'
			) );
			 
			if ( ! is_wp_error( $update ) ) {
			    echo 'Success!';
			}

			// Removes a term from the database.

			wp_delete_term( 25, 'category' )


            // Retrieves a list of registered taxonomy names or objects.

			$term_slug = 'TERM-SLUG';
			$taxonomies = get_taxonomies();
			foreach ( $taxonomies as $tax_type_key => $taxonomy ) {
			    // If term object is returned, break out of loop. (Returns false if there's no object)
			    if ( $term_object = get_term_by( 'slug', $term_slug , $taxonomy ) ) {
			    	echo "term_slug found";
			        break;
			    }
			}

			//Get the taxonomy!!
			echo $term_object->taxonomy . '<br>';
			 
			// You can also retrieve other thing of the term:
			echo $term_object->name . '<br>'; //term name
			echo $term_object->term_id . '<br>'; // term id
			echo $term_object->description . '<br>'; // term description
			 
			// See all options by dumping the $term_object:
			var_dump( $term_object );


			print_r($taxonomies);

			/*Array
			(
			    [category] => category
			    [post_tag] => post_tag
			    [nav_menu] => nav_menu
			    [link_category] => link_category
			    [post_format] => post_format
			    [acf-field-group-category] => acf-field-group-category
			    [thjm_job_category] => thjm_job_category
			    [thjm_job_locations] => thjm_job_locations
			    [thjm_job_type] => thjm_job_type
			)*/

            // Retrieves the taxonomy object of $taxonomy.

			$rental_features = get_taxonomy( 'category' );

            print_r( $rental_features );

            /*WP_Taxonomy Object
			(
			    [name] => category
			    [label] => Categories
			    [labels] => stdClass Object
			        (
			            [name] => Categories
			            [singular_name] => Category
			            [search_items] => Search Categories
			            [popular_items] => 
			            [all_items] => All Categories
			            [parent_item] => Parent Category
			            [parent_item_colon] => Parent Category:
			            [edit_item] => Edit Category
			            [view_item] => View Category
			            [update_item] => Update Category
			            [add_new_item] => Add New Category
			            [new_item_name] => New Category Name
			            [separate_items_with_commas] => 
			            [add_or_remove_items] => 
			            [choose_from_most_used] => 
			            [not_found] => No categories found.
			            [no_terms] => No categories
			            [items_list_navigation] => Categories list navigation
			            [items_list] => Categories list
			            [most_used] => Most Used
			            [back_to_items] => &larr; Back to Categories
			            [menu_name] => Categories
			            [name_admin_bar] => category
			        )

			    [description] => 
			    [public] => 1
			    [publicly_queryable] => 1
			    [hierarchical] => 1
			    [show_ui] => 1
			    [show_in_menu] => 1
			    [show_in_nav_menus] => 1
			    [show_tagcloud] => 1
			    [show_in_quick_edit] => 1
			    [show_admin_column] => 1
			    [meta_box_cb] => post_categories_meta_box
			    [meta_box_sanitize_cb] => taxonomy_meta_box_sanitize_cb_checkboxes
			    [object_type] => Array
			        (
			            [0] => post
			        )

			    [cap] => stdClass Object
			        (
			            [manage_terms] => manage_categories
			            [edit_terms] => edit_categories
			            [delete_terms] => delete_categories
			            [assign_terms] => assign_categories
			        )

			    [rewrite] => Array
			        (
			            [with_front] => 1
			            [hierarchical] => 1
			            [ep_mask] => 512
			            [slug] => category
			        )

			    [query_var] => category_name
			    [update_count_callback] => 
			    [show_in_rest] => 1
			    [rest_base] => categories
			    [rest_controller_class] => WP_REST_Terms_Controller
			    [default_term] => 
			    [rest_controller] => 
			    [_builtin] => 1
			)*/


            // Creates or modifies a taxonomy object.

			function wpdocs_create_book_taxonomies() {
		    // Add new taxonomy, make it hierarchical (like categories)
		    $labels = array(
		        'name'              => _x( 'Genres', 'taxonomy general name', 'textdomain' ),
		        'singular_name'     => _x( 'Genre', 'taxonomy singular name', 'textdomain' ),
		        'search_items'      => __( 'Search Genres', 'textdomain' ),
		        'all_items'         => __( 'All Genres', 'textdomain' ),
		        'parent_item'       => __( 'Parent Genre', 'textdomain' ),
		        'parent_item_colon' => __( 'Parent Genre:', 'textdomain' ),
		        'edit_item'         => __( 'Edit Genre', 'textdomain' ),
		        'update_item'       => __( 'Update Genre', 'textdomain' ),
		        'add_new_item'      => __( 'Add New Genre', 'textdomain' ),
		        'new_item_name'     => __( 'New Genre Name', 'textdomain' ),
		        'menu_name'         => __( 'Genre', 'textdomain' ),
		    );
		 
		    $args = array(
		        'hierarchical'      => true,
		        'labels'            => $labels,
		        'show_ui'           => true,
		        'show_admin_column' => true,
		        'query_var'         => true,
		        'rewrite'           => array( 'slug' => 'genre' ),
		        'show_in_rest' => true, // add support for Gutenberg editor
		    );
		 
		    register_taxonomy( 'genre', array( 'post' ), $args );
		 
		    unset( $args );
		    unset( $labels );
		 
		    // Add new taxonomy, NOT hierarchical (like tags)
		    $labels = array(
		        'name'                       => _x( 'Writers', 'taxonomy general name', 'textdomain' ),
		        'singular_name'              => _x( 'Writer', 'taxonomy singular name', 'textdomain' ),
		        'search_items'               => __( 'Search Writers', 'textdomain' ),
		        'popular_items'              => __( 'Popular Writers', 'textdomain' ),
		        'all_items'                  => __( 'All Writers', 'textdomain' ),
		        'parent_item'                => null,
		        'parent_item_colon'          => null,
		        'edit_item'                  => __( 'Edit Writer', 'textdomain' ),
		        'update_item'                => __( 'Update Writer', 'textdomain' ),
		        'add_new_item'               => __( 'Add New Writer', 'textdomain' ),
		        'new_item_name'              => __( 'New Writer Name', 'textdomain' ),
		        'separate_items_with_commas' => __( 'Separate writers with commas', 'textdomain' ),
		        'add_or_remove_items'        => __( 'Add or remove writers', 'textdomain' ),
		        'choose_from_most_used'      => __( 'Choose from the most used writers', 'textdomain' ),
		        'not_found'                  => __( 'No writers found.', 'textdomain' ),
		        'menu_name'                  => __( 'Writers', 'textdomain' ),
		    );
		 
		    $args = array(
		        'hierarchical'          => false,
		        'labels'                => $labels,
		        'show_ui'               => true,
		        'show_admin_column'     => true,
		        'update_count_callback' => '_update_post_term_count',
		        'query_var'             => true,
		        'rewrite'               => array( 'slug' => 'writer' ),
		         'show_in_rest' => true, // add support for Gutenberg editor

		    );
		 
		    register_taxonomy( 'writer', 'post', $args );
		}
		// hook into the init action and call create_book_taxonomies when it fires
		add_action( 'init', 'wpdocs_create_book_taxonomies', 0 );



		// Example Private Taxonomy

		/**
		 * Register a private 'Genre' taxonomy for post type 'book'.
		 *
		 * @see register_post_type() for registering post types.
		 */
		function wpdocs_register_private_taxonomy() {
		    $args = array(
		        'label'        => __( 'Genre', 'textdomain' ),
		        'public'       => false,
		        'rewrite'      => false,
		        'hierarchical' => true
		    );
		     
		    register_taxonomy( 'genre', 'book', $args );
		}
		add_action( 'init', 'wpdocs_register_private_taxonomy', 0 );
        
        /**
		 * Register a 'genre' taxonomy for post type 'book'.
		 *
		 * Register custom capabilities for taxonomies.
		 *
		 * @see register_post_type for registering post types.
		 */
		function wpdocs_create_book_tax() {
		    register_taxonomy( 'genre', 'book', array(
		        'label'        => __( 'Genre', 'textdomain' ),
		        'rewrite'      => array( 'slug' => 'genre' ),
		        'hierarchical' => true,
		        'capabilities' => array(
		            // $taxonomy['slug'] = genre;
		            'manage_terms'  =>   'manage_'.$taxonomy['slug'],
		            'edit_terms'    =>   'edit_'.$taxonomy['slug'],
		            'delete_terms'  =>   'delete'.$taxonomy['slug'],
		            'assign_terms'  =>   'assign_'.$taxonomy['slug'],
		        ),
		    ) );
		}
		add_action( 'init', 'wpdocs_create_book_tax', 0 );
        

       // Taxonomy names for post type 

		$taxonomy_names = get_object_taxonomies( 'post' );
        print_r( $taxonomy_names);

        /*Array
		(
		    [0] => category
		    [1] => post_tag
		    [2] => post_format
		)*/

        // Taxonomy objects for post type  

		$taxonomy_objects = get_object_taxonomies( 'post', 'genre' );

		/*Array
		(
		    [category] => stdClass Object
		        (
		            [hierarchical] => 1
		            [update_count_callback] => 
		            [rewrite] => 
		            [query_var] => category_name
		            [public] => 1
		            [show_ui] => 1
		            [show_tagcloud] => 1
		            [_builtin] => 1
		            [labels] => stdClass Object
		                (
		                    ...
		                )
		            ...
		            [name] => category
		            [label] => Categories
		        )
		    [post_tag] => stdClass Object
		        (
		            ...
		        )
		    [post_format] => stdClass Object
		        (
		            ....
		        )
		    [writer] => stdClass Object
		        (
		            ....
		        )
		    [genre] => stdClass Object
		        (
		            ....
		        )
		)*/


        // Taxonomy terms that are applied to $post

        $taxonomies=array("genre","category")

		$product_terms = wp_get_object_terms( $post->ID, $taxonomies );


        /*Array
		(
		    [0] => WP_Term Object
		        (
		            [term_id] => 7
		            [name] => heyyyyyyyyyyyyy
		            [slug] => heyyyyyyyyyyyyy
		            [term_group] => 0
		            [term_taxonomy_id] => 7
		            [taxonomy] => category
		            [description] => 
		            [parent] => 0
		            [count] => 1
		            [filter] => raw
		        )

		    [1] => WP_Term Object
		        (
		           ......
		        )

		    [2] => WP_Term Object
		        (
		           ......
		        )

		    [3] => WP_Term Object
		        (
		            .....
		        )

		    [4] => WP_Term Object
		        (
		            ....
		        )

		    [5] => WP_Term Object
		        (
		            ....
		        )

		)*/


	    // An array of IDs of categories we want this post to have.

		$cat_ids = array( 6, 8 );
		 
		/*
		 * If this was coming from the database or another source, we would need to make sure
		 * these were integers:
		 
		$cat_ids = array_map( 'intval', $cat_ids );
		$cat_ids = array_unique( $cat_ids );
		 
		 */
		 
		$term_taxonomy_ids = wp_set_object_terms( $post->ID, $cat_ids, 'category' );
		 
		if ( is_wp_error( $term_taxonomy_ids ) ) {
		    // There was an error somewhere and the terms couldn't be set.
		} else {
		    // Success! The post's categories were set.
		}

		// Removing All Categories From a Post
        
        wp_set_object_terms(  $post->ID, null, 'category' );