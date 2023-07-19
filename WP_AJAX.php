<?php

                $user_ID = get_current_user_id();
                $all_meta_for_user = get_user_meta( 5 ); // GET ALL META 
                $meta_for_user = get_user_meta( 5 ,'nickname' ); // GET SPECIFIC META 

<!--  create an user  -->


		    $userdata = array(
		    'ID'                    => 0,    //(int) User ID. If supplied, the user will be updated.
		    'user_pass'             => '',   //(string) The plain-text user password.
		    'user_login'            => '',   //(string) The user's login username.
		    'user_nicename'         => '',   //(string) The URL-friendly user name.
		    'user_url'              => '',   //(string) The user URL.
		    'user_email'            => '',   //(string) The user email address.
		    'display_name'          => '',   //(string) The user's display name. Default is the user's username.
		    'nickname'              => '',   //(string) The user's nickname. Default is the user's username.
		    'first_name'            => '',   //(string) The user's first name. For new users, will be used to build the first part of the user's display name if $display_name is not specified.
		    'last_name'             => '',   //(string) The user's last name. For new users, will be used to build the second part of the user's display name if $display_name is not specified.
		    'description'           => '',   //(string) The user's biographical description.
		    'rich_editing'          => '',   //(string|bool) Whether to enable the rich-editor for the user. False if not empty.
		    'syntax_highlighting'   => '',   //(string|bool) Whether to enable the rich code editor for the user. False if not empty.
		    'comment_shortcuts'     => '',   //(string|bool) Whether to enable comment moderation keyboard shortcuts for the user. Default false.
		    'admin_color'           => '',   //(string) Admin color scheme for the user. Default 'fresh'.
		    'use_ssl'               => '',   //(bool) Whether the user should always access the admin over https. Default false.
		    'user_registered'       => '',   //(string) Date the user registered. Format is 'Y-m-d H:i:s'.
		    'show_admin_bar_front'  => '',   //(string|bool) Whether to display the Admin Bar for the user on the site's front end. Default true.
		    'role'                  => '',   //(string) User's role.
		    'locale'                => '',   //(string) User's locale. Default empty.
		 
		     );

				 $userdata = array(
				               'user_login'       =>  'myname',
				               'user_pass'        =>  'mypass',
				               'user_email'       =>  'myemail@me.you',
				               'user_registered'  =>  date_i18n( 'Y-m-d H:i:s', time() ),
				               'role'             =>  'editor'
				               );
 
				 $user_id = wp_insert_user( $userdata ) ;
				 
				// On success.
				if ( ! is_wp_error( $user_id ) ) {
				    echo "User created : ". $user_id;
				}

<!--  create an user  -->

				$user_id = username_exists( "albert" );
				 
				if ( ! $user_id && false == email_exists( $user_email ) ) {
				    $random_password = wp_generate_password( $length = 12, $include_standard_special_chars = false );
				    $user_id = wp_create_user( $user_name, $random_password, $user_email );
				} else {
				    $random_password = __( 'User already exists.  Password inherited.', 'textdomain' );
				}
<!--  get an user  -->

				$user = get_user_by( 'email', 'albertdavis40@gmail.com' );

								WP_User Object
				(
				    [data] => stdClass Object
				        (
				            [ID] => 1
				            [user_login] => play
				            [user_pass] => $P$BAW6SdEFpF4r9oglUGDQFX5oP.raDq/
				            [user_nicename] => play
				            [user_email] => albertdavis40@gmail.com
				            [user_url] => http://localhost/play
				            [user_registered] => 2020-10-16 03:18:38
				            [user_activation_key] => 
				            [user_status] => 0
				            [display_name] => play
				        )

				    [ID] => 1
				    [caps] => Array
				        (
				            [administrator] => 1
				        )

				    [cap_key] => wp_capabilities
				    [roles] => Array
				        (
				            [0] => administrator
				        )

				    [allcaps] => Array
				        (
				            [switch_themes] => 1
				            [edit_themes] => 1
				            [activate_plugins] => 1
				            [edit_plugins] => 1
				            [edit_users] => 1
				            [edit_files] => 1
				            [manage_options] => 1
				            [moderate_comments] => 1
				            [manage_categories] => 1
				            [manage_links] => 1
				            [upload_files] => 1
				            [import] => 1
				            [unfiltered_html] => 1
				            [edit_posts] => 1
				            [edit_others_posts] => 1
				            [edit_published_posts] => 1
				            [publish_posts] => 1
				            [edit_pages] => 1
				            [read] => 1
				            [level_10] => 1
				            [level_9] => 1
				            [level_8] => 1
				            [level_7] => 1
				            [level_6] => 1
				            [level_5] => 1
				            [level_4] => 1
				            [level_3] => 1
				            [level_2] => 1
				            [level_1] => 1
				            [level_0] => 1
				            [edit_others_pages] => 1
				            [edit_published_pages] => 1
				            [publish_pages] => 1
				            [delete_pages] => 1
				            [delete_others_pages] => 1
				            [delete_published_pages] => 1
				            [delete_posts] => 1
				            [delete_others_posts] => 1
				            [delete_published_posts] => 1
				            [delete_private_posts] => 1
				            [edit_private_posts] => 1
				            [read_private_posts] => 1
				            [delete_private_pages] => 1
				            [edit_private_pages] => 1
				            [read_private_pages] => 1
				            [delete_users] => 1
				            [create_users] => 1
				            [unfiltered_upload] => 1
				            [edit_dashboard] => 1
				            [update_plugins] => 1
				            [delete_plugins] => 1
				            [install_plugins] => 1
				            [update_themes] => 1
				            [install_themes] => 1
				            [update_core] => 1
				            [list_users] => 1
				            [remove_users] => 1
				            [promote_users] => 1
				            [edit_theme_options] => 1
				            [delete_themes] => 1
				            [export] => 1
				            [administrator] => 1
				        )

				    [filter] => 
				    [site_id:WP_User:private] => 1
				)


<!--  Update an user  -->		

				$user_id = 6;
				$website = 'http://example.com';
				 
				$user_data = wp_update_user( array( 'ID' => $user_id, 'user_url' => $website ) );
				 
				if ( is_wp_error( $user_data ) ) {
				    // There was an error; possibly this user doesn't exist.
				    echo 'Error.';
				} else {
				    // Success!
				    echo 'User profile updated.';
				}	

<!--  Update an user  -->
					get_user_meta( $user_id, $key = '', $single = false )

					update_user_meta( $user_id, $meta_key, $meta_value, $prev_value = '' )

					add_user_meta($user_id, $meta_key, $meta_value, $unique = false)
					
					delete_user_meta($user_id, $meta_key, $meta_value = '')

