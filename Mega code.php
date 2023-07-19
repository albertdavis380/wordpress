<?php


<!--  THEME BUILDING CODE FOR FUNCTION.PHP AND STYLE.CSS -->

				 /**
				     * ISYX functions and definitions
				     *
				     * @link https://demo.webandcrafts.com/ktcb/wp
				     *
				     * @package WordPress
				     * @subpackage KTBC
				     * @since 1.0.0
				  */
    
			    /**
			     * Enhance the theme by hooking into WordPress.
			     */
			    require get_template_directory() . '/includes/admin/template-hooks.php';
			    /**
			     * Enhance the theme by hooked function into WordPress.
			     */
			    require get_template_directory() . '/includes/admin/template-functions.php';




				function NAME_theme_support() {
				    
				        // Add default posts and comments RSS feed links to head.
				        add_theme_support( 'automatic-feed-links' );
				        
				        add_theme_support( 'menus' );
				        add_post_type_support( 'page', 'excerpt' );
				        add_theme_support( 'post-thumbnails' );
				        set_post_thumbnail_size( 375, 195 );
				        add_image_size( 'blog-thumb', 375, 195 ); 
				        add_image_size( 'nav-menu-img', 279, 170 ); 
				        add_image_size( 'insight-land', 674, 532 ); 
				        
				        /*
				        	 * Let WordPress manage the document title.
				        	 * By adding theme support, we declare that this theme does not use a
				        	 * hard-coded <title> tag in the document head, and expect WordPress to
				        	 * provide it for us.
				        	 */
				            add_theme_support( 'title-tag' );
				            
				        
				            /*
				        	 * Enable support for Post Formats.
				        	 *
				        	 * See: https://codex.wordpress.org/Post_Formats
				        	 */
				        	add_theme_support( 'post-formats', array(
				        		'aside',
				        		'image',
				        		'video',
				        		'quote',
				        		'link',
				        		'gallery',
				        		'audio',
				        	) );
				        	
				        	@ini_set( 'upload_max_size' , '64M' );
				            @ini_set( 'post_max_size', '64M');
				            @ini_set( 'max_execution_time', '300' );
				    
				    }

				    add_action( 'after_setup_theme', 'NAME_theme_support' );


<!--  Add Google Analytics to Your Site -->

						add_action('wp_head', 'wpb_add_googleanalytics');

						function wpb_add_googleanalytics() { 

						}


<!--  Intravel DIV adding -->

                        if($i % 4 == 1) { 
                        
                        }  
						if($i % 4 == 0 ) {
                      
        
                         }


<!--  Change the Default Login Error Message -->

						function no_wordpress_errors(){
						return 'Something went wrong!';
						}
						add_filter( 'login_errors', 'no_wordpress_errors' );
 
 <!--   Add the Estimated Reading Time for a Post -->

						function reading_time() {

						$content = get_post_field( 'post_content', $post->ID );
						$word_count = str_word_count( strip_tags( $content ) );
						$readingtime = ceil($word_count / 200);
						if ($readingtime == 1) {
						$timer = " minute";
						} else {
						$timer = " minutes";
						}
						$totalreadingtime = $readingtime . $timer;
						return $totalreadingtime;

						}

 <!--   Add Custom class to Menus A Tag -->

						function add_menuclass($ulclass) {
						   return preg_replace('/class="t_full" data-text="Career"/', 'class="t_full no-barba" data-text="Career"', $ulclass);
						}
						add_filter('wp_nav_menu','add_menuclass');


 <!--   adds an attribute to all <a> tags in the wp_nav_menu -->

						function add_menu_atts( $atts, $item, $args ) {
						    $atts['onClick'] = 'return true';
						    return $atts;
						}
						add_filter( 'nav_menu_link_attributes', 'add_menu_atts', 10, 3 );

						function add_class_to_non_top_level_menu_anchors( $atts, $item, $args, $depth ) {
						    if ( 0 !== $depth ) {
						        $atts['class'] = 'menu-item-anchor-non-top';
						    }
						 
						    return $atts;
						}
						add_filter( 'nav_menu_link_attributes', 'add_class_to_non_top_level_menu_anchors', 10, 4 );
                         

 <!--   Add Custom Menus -->

						function wpb_custom_new_menu() {
						register_nav_menu('my-custom-menu',__( 'My Customized Menu' ));
						}
						add_action( 'init', 'wpb_custom_new_menu' );


												wp_nav_menu( array(
						'theme_location' => 'my-custom-menu',
						'container_class' => 'custom-menu-class' ) );

<!--  Plugin Creation -->

						/**
						 * Plugin Name: Read Me Later
						 * Plugin URI: https://github.com/iamsayed/read-me-later
						 * Description: This plugin allow you to add blog posts in read me later lists using Ajax
						 * Version: 1.0.0
						 * Author: Sayed Rahman
						 * Author URI: https://github.com/iamsayed/
						 * License: GPL3
						 */


						/*
						 * Action hooks
						 */
						public function run() {     
						    // Enqueue plugin styles and scripts
						    add_action( ‘plugins_loaded’, array( $this, 'enqueue_rml_scripts' ) );
						    add_action( ‘plugins_loaded’, array( $this, 'enqueue_rml_styles' ) );      
						}   
						/**
						 * Register plugin styles and scripts
						 */
						public function register_rml_scripts() {
						    wp_register_script( 'rml-script', plugins_url( 'js/read-me-later.js', __FILE__ ), array('jquery'), null, true );
						    wp_register_style( 'rml-style', plugins_url( 'css/read-me-later.css' ) );
						}   
						/**
						 * Enqueues plugin-specific scripts.
						 */
						public function enqueue_rml_scripts() {        
						    wp_enqueue_script( 'rml-script' );
						}   
						/**
						 * Enqueues plugin-specific styles.
						 */
						public function enqueue_rml_styles() {         
						    wp_enqueue_style( 'rml-style' ); 
						}


<!--  ADD async AND defer FOR SCRIPT TAG -->

						if (!is_admin()) {
						    add_filter( 'script_loader_tag', function ( $tag, $handle ) {    
						        if (strpos( $tag, "popupform.js" )){
						            return str_replace( ' src', ' async src', $tag );
						        }else if(strpos( $tag, "popupform.js"){
						            return str_replace( ' src', ' defer src', $tag );
						        }
						        return $tag;
						    }, 10, 2 );
						}

<!--  INSERT FORM DATA INTO TABLE -->

						$serialized_array = serialize($_POST); 
						    $wpdb->insert('<---table-name--->', array(
						    'form_name' => '<---form-name--->',
						    'form_data' => $serialized_array
						    ));

<!--  ADD SCRIPT IN THE WP_FOOTER -->

							function themename_scripts() {

								wp_enqueue_style( 'almithaliya-style', get_stylesheet_uri());
								wp_enqueue_style( 'almithaliya-custom-style', get_template_directory_uri().'/css/style.css');
								
								wp_deregister_script('jquery'); //deregistering wordpress's jquery
							    wp_register_script('jquery', get_template_directory_uri() . '/js/jquery-3.4.1.min.js', array(), '', false, false);
							    
								wp_enqueue_script( 'your-script-name', get_template_directory_uri() . '/js/your-script-name.js', array(), '20151215', true );
								
							    
								if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
									wp_enqueue_script( 'comment-reply' );
								}
								
								if(is_front_page()){
								     wp_enqueue_script( 'popupform', get_template_directory_uri() . '/js/popupform.js', array(), '', true );
								}
								

							}

							add_action( 'wp_enqueue_scripts', 'themename_scripts' );


<!--  GET CURRENT PAGE URL -->

					 function get_url_(){
					         global $post;  
									/** Remove Active Class from Blog **/
							$page_blog = get_option('page_for_posts');	
					        $pageURL = 'http';
							
							if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
								$pageURL .= "://";
							if ($_SERVER["SERVER_PORT"] != "80" && $_SERVER["SERVER_PORT"] != "443") {
								$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
							} else {
								$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
							}
							return $pageURL;
				    }
    
<!--  REMOVE NULL <P></P> FROM THE_CONTENT -->

				    add_filter('the_content', 'remove_empty_p', 20, 1);
				    function remove_empty_p($content){
				        $content = force_balance_tags($content);
				        return preg_replace('#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content);
				    }
    

               
<!--  RETRIVE POSTS USING WP_QUERY -->

 
                      $current_page=$post->ID;  
                      $args = array(
                            'post_type'      => 'page',
                            'posts_per_page' => -1,
                            'post_parent'    =>34,
                            'order'          => 'ASC'
                        
                        );
                  
                        $parent = new WP_Query( $args );
                        
                        if ( $parent->have_posts() ) : ?>

                            <?php while ( $parent->have_posts() ) : $parent->the_post(); $id = get_the_ID();?>
                                   
                                   <!--  -->
                                    <?php the_title(); ?>
                                    <?php the_permalink(); ?>
                                    <?php the_content(); ?>
                                    <!--  -->

                            <?php endwhile; ?>

                    <?php endif; wp_reset_postdata();


<!--  Customize Your Excerpts -->


					function new_excerpt_more($more) {
					global $post;
					return '<a class="moretag" href="'. get_permalink($post->ID) . '"> Read the full article...</a>';
					}
					add_filter('excerpt_more', 'new_excerpt_more');



<!--  EXCERPT LENGTH LIMIT -->

				    function mytheme_excerpt_length() {
				        return 25;
				      }
				    add_filter('excerpt_length','mytheme_excerpt_length');
                   



<!--  EXCERPT REMOVE [...] -->

				    function new_excerpt_more( $more ) {
				    return '';
				    }
				    add_filter('excerpt_more', 'new_excerpt_more');



<!--  HAS THUMBNAIL IMAGE CONDITION -->

                   
                            // Must be inside a loop.
                            
                            if ( has_post_thumbnail() ) {
                                the_post_thumbnail('full',array('class'=>'img-fluid'));
                                // get_the_post_thumbnail_url(get_the_ID()); 
                            }
                            else {
                                echo '<img src="' . get_bloginfo( 'stylesheet_directory' ) 
                                    . '/images/thumbnail-default.jpg" />';
                            }


                    

<!--  ACF FIELD CALLING  -->

                  
                   
                   $fieldname = get_field("fieldname");  

                   foreach($fieldname as  $single){
                       foreach($single as $key => $value){
                                   foreach($value as $image){
                                   	// Repeater image
                                   }
                       }
                   }
                 


                  if( have_rows('main_field') ):
                        while ( have_rows('main_field') ) : the_row(); 
                          $button = get_sub_field('sub_field');
                        endwhile;
                  endif; 


<!-- Conact form 7 FORM   -->
            
               add_filter( 'wpcf7_validate_email*', 'custom_email_confirmation_validation_filter', 5, 2 );


				add_filter( 'wpcf7_validate_text*', 'custom_text_validation_filter', 20, 2 );

				function custom_text_validation_filter( $result, $tag ) {
				    if ( 'f_name' == $tag->name ) {
				        // matches any utf words with the first not starting with a number
				        $re = '/^[^\p{N}][\p{L}]*/i';

				        if (!preg_match($re, $_POST['f_name'], $matches)) {
				            $result->invalidate($tag, "This is not a valid name!" );
				        }
				    }

				    return $result;
				}
                  
                  document.addEventListener( 'wpcf7mailsent', function( event ) {
                  	
					}, false ); 

					    wpcf7invalid — Fires when an Ajax form submission has completed successfully, but mail hasn’t been sent because there are fields with invalid input.
						wpcf7spam — Fires when an Ajax form submission has completed successfully, but mail hasn’t been sent because a possible spam activity has been detected.
						wpcf7mailsent — Fires when an Ajax form submission has completed successfully, and mail has been sent.
						wpcf7mailfailed — Fires when an Ajax form submission has completed successfully, but it has failed in sending mail.
						wpcf7submit — Fires when an Ajax form submission has completed successfully, regardless of other incidents.

<!-- GET PAGE URL ARRAY -->

                  

                    global $post;  
							/** Remove Active Class from Blog **/
					$page_blog = get_option('page_for_posts');	
			        $pageURL = 'http';
					
					if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
						$pageURL .= "://";
					if ($_SERVER["SERVER_PORT"] != "80" && $_SERVER["SERVER_PORT"] != "443") {
						$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
					} else {
						$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
					}
					$url_array=explode('/',$pageURL);

    

<!--  Google Analytics tracking code  -->               
                    <?php
					add_action('wp_head', 'wpb_add_googleanalytics');
					function wpb_add_googleanalytics() { ?>
					 
					// Paste your Google Analytics tracking code from Step 4 here
					 
					<?php } ?>
<!--  GET REGISTERED MENUS WITH MEGA SUBMENU  -->
                

                  $menuLocations = get_nav_menu_locations();
                  $menuID = $menuLocations['primary_menu']; // Get the *primary* menu ID
                  $primaryNav = wp_get_nav_menu_items($menuID);
                  $submenu = $child = [];

                  foreach ($primaryNav as $mainNav) {

				    if($mainNav->menu_item_parent == 0) {
				      $submenu[$mainNav->ID] = [
				        "id" => $mainNav->ID,
				          "title" => $mainNav->title,
				          "url"           => $mainNav->url,
				          "description"   => $mainNav->description,
				          "branches"   => $mainNav->xfn,
				      ];
				    }
				     else {
				      $submenu[$mainNav->menu_item_parent]['submenu'][] = [
				        "id" => $mainNav->ID,
				        "title" => $mainNav->title,
				        "url"           => $mainNav->url,
				        "class"         => $mainNav->classes[0]
				      ];
				    }
				    
				}?>



				 <ul class="main-nav"> 
		
				  <?php
                  foreach($submenu as $menulists) {

                  $page_slug_ = get_post_field( 'post_name',url_to_postid($menulists['url']));

                  $active_class="";
         
		          if($pageURL===$menulists['url'] || in_array($slug_ ,$url_array)){  <!-- GET PAGE URL ARRAY NEED HERE -->
		            $active_class ="active";
		          }

				   if(empty($menulists['submenu']))} ?>
                             
                  <li><a class="nav-link <?php echo $active_class; ?>" href="<?php echo $menulists['url'] ?>"><span><?php echo $menulists['title'] ?></span></a></li>    
		
				  <?php }else{
                          if($menulists['title']=='<---PAGE TITLE---->'): ?>
                          <li class="mega-menu-dropdown"><?php echo $ptitle; ?><!--  MEGA MENU  --></li>
                          <?php endif;
				        
				   endif;
				}
                 ?> </ul> <?php
                   
<!--ADD CLASS FOR MENU A[HREF] CUSTOM -->
                   add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);
                  
                   function special_nav_class ($classes, $item) {
                       $url_array=get_url_();
                       
                       if(in_array('URL-SLUG', $url_array)){
                          

        				      if (in_array('menu-item-26', $classes) ){
        				        $classes[] = 'active ';  ?>
		        				        <script>
		        				         document.addEventListener("DOMContentLoaded", function(){ 
			        				             function classadd() {
			        				                 
			                                         $(".menu-item-26 a").addClass("active"); 
				                                          if(document.querySelector(".menu-item-26 a")!==null){
				                                             document.querySelector(".menu-item-26 a").classList.add("active");
				                                          }
			                                         
			                                        }
			                                        setTimeout(classadd, 1000);
		        				             });
		        				        </script>
        				        <?php
        				      }
				      
                       }
				      
				      return $classes;
				    } 

<!-- MENU UL FROM ID -->

                 wp_nav_menu( array( 'menu' => 4,'container'=> '','menu_class'=>'foot-links foot-item-body' ) );


<!-- ADD CLASS FOR CURRENT ACTIVE ITEM  -->

                  add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

                   function special_nav_class ($classes, $item) {
				      if (in_array('current-menu-item', $classes) ){
				        $classes[] = 'active ';
				      }
				      return $classes;
				    } 
                   

<!-- GET POST ID FROM URL -->

				   
                     url_to_postid("URL");
				   
                  

<!-- WP_Query -->

                    $args = array(
		              'p'         => url_to_postid($menulists['url']), // ID of a page, post, or custom type
		              'post_type' => 'any'
		            );

		            $my_posts = new WP_Query($args);
		            $title=$my_posts->post->post_title;
		            $content=$my_posts->post->post_content;
 
<!-- GET RECENT POSTS -->  

                   $args = array( 'numberposts' => '1' , 'post_type'=> 'post','order'=> 'ASC');

                   $recent_posts = wp_get_recent_posts( $args );

                   foreach($recent_posts as $single){  
                    echo  $single['ID'];
                    echo $single['post_title'];
                    echo $single['post_content'];
                    echo get_the_date('d/m/yy',$single['ID']);
                   }                

<!-- Limited Sentence Starts Here -->

				function limited_sentences($text,$limit){

				    $text = preg_replace('/<ul[^>]*>([\s\S]*?)<\/ul[^>]*>/', '', $text);
				    //$text = preg_replace('/<ol[^>]*>([\s\S]*?)<\/ol[^>]*>/', '', $text);
				    $text = preg_replace('/<h1[^>]*>([\s\S]*?)<\/h1[^>]*>/', '', $text);
				    $text = preg_replace('/<h2[^>]*>([\s\S]*?)<\/h2[^>]*>/', '', $text);
				    $text = preg_replace('/<h3[^>]*>([\s\S]*?)<\/h3[^>]*>/', '', $text);
				    $text = preg_replace('/<h4[^>]*>([\s\S]*?)<\/h4[^>]*>/', '', $text);
				    $text = preg_replace('/<h5[^>]*>([\s\S]*?)<\/h5[^>]*>/', '', $text);
				    $text = preg_replace('/<h6[^>]*>([\s\S]*?)<\/h6[^>]*>/', '', $text);
				    
				    $text = strip_tags($text);
				    $text1=$text;
				    $fl_stp_count = substr_count($text, '.');$qn_count = substr_count($text, '?');$excla_count = substr_count($text, '!');
				    $total_count = $fl_stp_count + $qn_count + $excla_count;
				    $limit_charcount = 0;$limited_text_last = '';
				    for($i=1;$i<=$total_count;$i++){
				    preg_match("/^([^.!?]*[\.!?]+){0,$i}/", strip_tags($text), $abstract);
				    $limited_text = $abstract[0]; $limit_charcount = strlen($limited_text);
				    if( $limit_charcount<=$limit){	$limited_text_last = $abstract[0];}
				    }
				    if($limited_text_last==''){
				    $limited_text_last = ($limit>=strlen($text) ? substr($text, 0, $limit) : substr($text, 0, strrpos(substr($text, 0, $limit), ' ')));
				    $lastcharacter = substr($limited_text_last, -1);
				    
				        if($limited_text_last!=''){
				            if($lastcharacter=='.'){$limited_text_last = $limited_text_last . '..';}else if($lastcharacter=='?' ||$lastcharacter=='!'){$limited_text_last = $limited_text_last;}else{
				                if($limit<=strlen($text)) { $limited_text_last = $limited_text_last . '...'; } }
				        }
				    }
				    $lastcharacterdr = substr($limited_text_last, -3);
				    if($lastcharacterdr=='Dr.' || $lastcharacterdr=='Mr.' )
				    {
				    $fl_stp_count = substr_count($text1, '.');$qn_count = substr_count($text1, '?');$excla_count = substr_count($text1, '!');
				    $total_count = $fl_stp_count + $qn_count + $excla_count;
				    $limit_charcount = 0;$limited_text_last = '';
				    for($i=1;$i<=$total_count+1;$i++){
				    preg_match("/^([^.!?]*[\.!?]+){0,2}/", strip_tags($text1), $abstract);
				    $limited_text = $abstract[0]; $limit_charcount = strlen($limited_text);
				    if( $limit_charcount<=$limit){	$limited_text_last = $abstract[0];}
				    }
				    if($limited_text_last==''){
				    $limited_text_last = ($limit>=strlen($text) ? substr($text, 0, $limit) : substr($text, 0, strrpos(substr($text, 0, $limit), ' ')));
				    $lastcharacter = substr($limited_text_last, -1);
				    
				        if($limited_text_last!=''){
				            if($lastcharacter=='.'){$limited_text_last = $limited_text_last . '..';}else if($lastcharacter=='?' ||$lastcharacter=='!'){$limited_text_last = $limited_text_last;}else{
				                if($limit<=strlen($text)) { $limited_text_last = $limited_text_last . '...'; } }
				        }
				    }
				    
				    }
				    
				    return $limited_text_last;
				    }

		

<!-- Word limit Starts Here -->

			    function wordLimit($string,$limitNum){
			        if (strlen($string) > $limitNum){
			        $string = substr($string, 0, strrpos(substr($string, 0, $limitNum), ' ')) . '...';
			        }
			        return $string;
			    }



<!-- Videos Starts Here -->

			        add_action('init', 'cptui_register_video');
			        function cptui_register_video() {
			        register_post_type('video', array(
			        'label' => 'Videos',
			        'description' => '',
			        // 'public' => true,
			        'show_ui' => true,
			        'show_in_menu' => true,
			        'capability_type' => 'page',
			        'map_meta_cap' => true,
			        'hierarchical' => true,
			        'menu_icon'  => 'dashicons-video-alt2',
			        // 'rewrite' => array('slug'=> 'faq/%faq_category%','with_front' => false),
			        'rewrite' => array('slug'=> 'video','with_front' => false),
			        'query_var' => true,
			        'exclude_from_search' => false,
			        'supports' => array('title', 'editor'),
			        'taxonomies' => array('video'),
			        'labels' => array (
			         'name' => 'Videos',  
			         'singular_name' => 'Videos',  
			         'menu_name' => 'Videos',
			         'all_items' => 'All Videos',
			         'add_new' => 'Add New Videos',
			         'add_new_item' => 'Add New Video',
			         'edit' => 'Edit',
			         'edit_item' => 'Edit Videos',
			         'new_item' => 'New Videos',
			         'view' => 'View Videos',
			         'view_item' => 'View Videos',
			         'search_items' => 'Search Videos',
			         'not_found' => 'No Videos Found',
			         'not_found_in_trash' => 'No Videos Found in Trash',
			         'parent' => 'Parent Videos',)
			        )
			        );
			         }
			        
			        add_action('init', 'cptui_register_video_categories');
			        function cptui_register_video_categories() {
			        register_taxonomy( 'video_category',array (
			          0 => 'video',
			        ),
			        array( 'hierarchical' => true,
			        'query_var' => 'video_category',
			        'public' => true,
			         'rewrite' => array('slug' => 'video', 'hierarchical' => true,'with_front' => false ),
			        '_builtin' => false,
			        'label' => 'Video Categories',
			        'show_ui' => true,
			        'show_admin_column' => true,
			        'labels' => array (
			          'search_items' => 'Video Categories',  
			          'all_items' => 'Video Categories',    
			          'add_new_item' => 'Add New Video category',
			          'edit_item' => 'Edit Video category',
			        'back_to_items' => 'Back to Categories')
			        ) );
			        
			        }
			        
			        add_filter( 'manage_edit-video_columns', 'my_edit_video_columns' ) ;
			        function my_edit_video_columns( $columns )
			         {
			        $columns = array(
			        'cb' => '<input type="checkbox" />',
			        'title' => __( 'Video Title' ),
			        'taxonomy-video_category' => __( 'Categories' ),
			        'date' => __( 'Date' )
			        );
			        return $columns;
			        }
			        
			        add_action( 'manage_video_posts_custom_column', 'my_manage_video_columns', 10, 2 );
			        function my_manage_video_columns( $column, $post_id ) {
			          global $post;
			          $custom = get_post_custom($post->ID);
			          $answer = apply_filters( 'the_content', $post->post_content );
			        switch( $column ) {
			        case 'answer' :
			        $answer = wordLimit($answer,150);
			        echo $answer;
			        break;
			        default :
			        break;
			        
			        }
			        }
			        // Added New Columns and rearranged columns end here
			        // Column Make Sortable start here
			        add_filter('manage_edit-video_sortable_columns', 'video_category_change_sortable_columns');
			        function video_category_change_sortable_columns($columns){
			            $columns['video_category'] = 'video_category';
			        $columns['taxonomy-video_category'] = 'taxonomy-video_category';
			            return $columns;
			        }
			        
			        
			        add_filter('post_link', 'video_category_permalink', 1, 3);
			        add_filter('post_type_link', 'video_category_permalink', 1, 3);
			        function video_category_permalink($permalink, $post_id, $leavename) {
			           if (strpos($permalink, '%video_category%') === FALSE) return $permalink;
			               // Get post
			               $post = get_post($post_id);
			               if (!$post) return $permalink;
			               // Get taxonomy terms
			               $terms = wp_get_object_terms($post->ID, 'video_category');
			               if (!is_wp_error($terms) && !empty($terms) && is_object($terms[0]))
			                $taxonomy_slug = $terms[0]->slug;
			               else $taxonomy_slug = 'no-categories';
			           return str_replace('%video_category%', $taxonomy_slug, $permalink);
			        }

        

<!-- Custom login error -->
						// Insert into your functions.php and have fun by creating login error msgs
						function guwp_error_msgs() { 
						  // insert how many msgs you want as array items. it will be shown randomly (html is allowed)
						  $custom_error_msgs = [
						    '<strong>YOU</strong> SHALL NOT PASS!',
						    '<strong>HEY!</strong> GET OUT OF HERE!',
						  ];
						  // get and returns a random array item to show as the error msg
						  return $custom_error_msgs[array_rand($custom_error_msgs)];
						}
						add_filter( 'login_errors', 'guwp_error_msgs' );

                   
<!-- PAGE.PHP CODE --> 

					 if(have_posts()) : while(have_posts()): the_post();

					             $content=get_the_content(); 
					             if($content): echo $content; 
					             	else: echo "<p>Coming Soon!</p>";
					             endif; 

					 endwhile; endif;


<!-- GET CATEGORYS BY TAXONOMY NAME -->

                        $terms_array = array( 
                          'taxonomy' => 'video_category', // you can change it according to your taxonomy
                          'parent'   => 0 // If parent => 0 is passed, only top-level terms will be returned
                        );
                        $services_terms = get_terms($terms_array); 
                        foreach($services_terms as $single){
                            ?>
                            <?php echo ucfirst($single->name); ?>
                            <?php
                           
                        } 

<!-- PASSWORD CHANGE -->

						require("wp-load.php");
						$sql = "SHOW TABLES LIKE '%'"; //
						$sql = "SELECT * FROM wps3_users";

								
						$wpdb->query("UPDATE wps3_users SET user_pass= MD5('1qazXDR%6yhn') WHERE ID = 7"); 
						$array = $wpdb->get_results( $wpdb->prepare($sql));
								
						print_r($array );

<!-- Redirect non-www to www -->

						RewriteCond %{HTTP_HOST} ^yourdomain.com [NC]
						RewriteRule ^(.*)$ http://www.yourdomain.com/$1 [L,R=301]

						For www to non-www, use:
						------------------------------------
						RewriteCond %{HTTP_HOST} ^www.yourdomain.com [NC]
						RewriteRule ^(.*)$ http://yourdomain.com/$1 [L,R=301]




<!-- SITE SPEED CODES -->

					    function smartwp_remove_wp_block_library_css(){
					    wp_dequeue_style( 'wp-block-library' );
					    wp_dequeue_style( 'wp-block-library-theme' );
					    wp_dequeue_style( 'wc-block-style' ); // Remove WooCommerce block CSS
					    } 
					    add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100 );
    

<!-- ADD SCRIPTS TO THE WEBSITE -->

					    if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
					    function my_jquery_enqueue() {
					       wp_deregister_script('jquery');
					       wp_register_script('jquery', "//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js", false, null);
					       wp_enqueue_script('jquery');
					    }                      

<!-- BETTER WEBSITE FOR REFER -->
                       
                        https://web.dev/fast/#prioritize-resources
						https://developers.google.com/web/updates/2019/02/priority-hints
						https://www.codegrepper.com/code-examples/whatever/slick+carousel+function+to+unslick
						https://speckyboy.com/wordpress-sql-query-snippets/
						https://speckyboy.com/wordpress-snippets-extend-wordpress/
                        https://www.sitepoint.com/how-to-use-ajax-in-wordpress-a-real-world-example/
                        https://underscores.me/
                        https://www.dreamhost.com/wordpress/guide-to-developing-a-wp-theme/
                        https://wordpress.org/support/article/optimization/
                        https://codex.wordpress.org/Advanced_Topics
                        https://wordpress.org/support/article/custom-fields/
                        https://wordpress.org/support/article/optimization-caching/
                        https://developer.yahoo.com/performance/rules.html?guccounter=1
                        http://www.websiteoptimization.com/speed/tweak/cache/
                        https://wordpress.org/support/article/brute-force-attacks/
                        https://wordpress.org/support/article/htaccess/
                        https://perishablepress.com/stupid-htaccess-tricks/#per6
                        https://perishablepress.com/customize-wordpress-sitemaps/
                        https://perishablepress.com/monitor-wordpress-login-page/
                        https://perishablepress.com/stupid-wordpress-tricks/#swt_01
                        https://adambrown.info/p/wp_hooks
                        https://adambrown.info/p/wp_hooks/version/5.1
                        https://api.wordpress.org/secret-key/1.1/salt/
                        https://wpsecuritychecklist.org/items/
                        https://wordpress.org/support/article/hardening-wordpress/
                        https://websitesetup.org/wordpress-security/
                        https://www.indianpeakswebdesign.com/select-radio-by-clicking-table-row/
                        https://codex.wordpress.org/Plugin_API/Action_Reference

<!-- Allow Contributors to Upload Images --> 

						if ( current_user_can('contributor') && !current_user_can('upload_files') )
						     add_action('admin_init', 'allow_contributor_uploads');      
						     function allow_contributor_uploads() {
						          $contributor = get_role('contributor');
						          $contributor->add_cap('upload_files');
						 }

<!--  Add the admin bar menu. --> 

						add_action( 'admin_bar_menu', 'admin_bar_item', 500 );
						function admin_bar_item ( WP_Admin_Bar $admin_bar ) {
						    if ( ! current_user_can( 'manage_options' ) ) {
						        return;
						    }
						    $admin_bar->add_menu( array(
						        'id'    => 'menu-id',
						        'parent' => null,
						        'group'  => null,
						        'title' => 'Menu Title', //you can use img tag with image link. it will show the image icon Instead of the title.
						        'href'  => admin_url('admin.php?page=custom-page'),
						        'meta' => [
						            'title' => __( 'Menu Title', 'textdomain' ), //This title will show on hover
						        ]
						    ) );
						}

 <!--- Prints admin screen notices -->

						function sample_admin_notice__success() {
						    ?>
						    <div class="notice notice-success is-dismissible">
						        <p><?php _e( 'Done!!!', 'sample-text-domain' ); ?></p>
						    </div>
						    <?php
						}
						add_action( 'admin_notices', 'sample_admin_notice__success' );

 <!--- Show Popular Posts Without Plugins -->

						function count_post_visits() {
						    if( is_single() ) {
						        global $post;
						        $views = get_post_meta( $post->ID, 'my_post_viewed', true );
						        if( $views == '' ) {
						            update_post_meta( $post->ID, 'my_post_viewed', '1' );   
						        } else {
						            $views_no = intval( $views );
						            update_post_meta( $post->ID, 'my_post_viewed', ++$views_no );
						        }
						    }
						}
						add_action( 'wp_head', 'count_post_visits' );


						$popular_posts_args = array(
						    'posts_per_page' => 3,
						    'meta_key' => 'my_post_viewed',
						    'orderby' => 'meta_value_num',
						    'order'=> 'DESC'
						);
						$popular_posts_loop = new WP_Query( $popular_posts_args );
						  while( $popular_posts_loop->have_posts() ):
						    $popular_posts_loop->the_post();
						    // Loop continues
						endwhile;
						wp_reset_query();

 <!--- Track WordPress Post Views by Using Post Meta -->

						function getPostViews($postID){
						    $count_key = 'post_views_count';
						    $count = get_post_meta($postID, $count_key, true);
						    if($count==''){
						        delete_post_meta($postID, $count_key);
						        add_post_meta($postID, $count_key, '0');
						        return "0 View";
						    }
						    return $count.' Views';
						}
						function setPostViews($postID) {
						    $count_key = 'post_views_count';
						    $count = get_post_meta($postID, $count_key, true);
						    if($count==''){
						        $count = 0;
						        delete_post_meta($postID, $count_key);
						        add_post_meta($postID, $count_key, '0');
						    }else{
						        $count++;
						        update_post_meta($postID, $count_key, $count);
						    }
						}

                     Step 1: Paste the code below within the single.php within the loop:
                     setPostViews(get_the_ID());

                     Step 2: Paste the snippet below anywhere within the template where you would like to display the number of views:
                     echo getPostViews(get_the_ID());
						

 <!--- Protect Your Site from Malicious Requests -->


						global $user_ID; if($user_ID) {
						    if(!current_user_can('administrator')) {
						        if (strlen($_SERVER['REQUEST_URI']) > 255 ||
						            stripos($_SERVER['REQUEST_URI'], "eval(") ||
						            stripos($_SERVER['REQUEST_URI'], "CONCAT") ||
						            stripos($_SERVER['REQUEST_URI'], "UNION+SELECT") ||
						            stripos($_SERVER['REQUEST_URI'], "base64")) {
						                @header("HTTP/1.1 414 Request-URI Too Long");
						                @header("Status: 414 Request-URI Too Long");
						                @header("Connection: Close");
						                @exit;
						        }
		
						    }

<!-- Paginate Your Site Without Plugins -->
 
						global $wp_query;
						$total = $wp_query->max_num_pages;
						// only bother with the rest if we have more than 1 page!
						if ( $total > 1 )  {
						     // get the current page
						     if ( !$current_page = get_query_var('paged') )
						          $current_page = 1;
						     // structure of "format" depends on whether we're using pretty permalinks
						     $format = empty( get_option('permalink_structure') ) ? '&page=%#%' : 'page/%#%/';
						     echo paginate_links(array(
						          'base' => get_pagenum_link(1) . '%_%',
						          'format' => $format,
						          'current' => $current_page,
						          'total' => $total,
						          'mid_size' => 4,
						          'type' => 'list'
						     ));
						}

<!-- Remove the admin bar from the front end -->
					

                        add_filter( 'show_admin_bar', '__return_false' );


<!-- Remove the admin bar from the front end -->


						// Put post thumbnails into rss feed
						function wpfme_feed_post_thumbnail($content) {
						global $post;
						if(has_post_thumbnail($post->ID)) {
						$content = '' . $content;
						}
						return $content;
						}
						add_filter('the_excerpt_rss', 'wpfme_feed_post_thumbnail');
						add_filter('the_content_feed', 'wpfme_feed_post_thumbnail');


<!-- Change the Author Permalink Structure -->

						add_action('init', 'cng_author_base');
						function cng_author_base() {
						    global $wp_rewrite;
						    $author_slug = 'profile'; // change slug name
						    $wp_rewrite->author_base = $author_slug;
						}	

<!-- Automatically Link to Twitter Usernames in Content -->

						function content_twitter_mention($content) {
						return preg_replace('/([^a-zA-Z0-9-_&])@([0-9a-zA-Z_]+)/', "$1<a href=\"http://twitter.com/$2\" target=\"_blank\" rel=\"nofollow\">@$2</a>", $content);
						}
						add_filter('the_content', 'content_twitter_mention');   
						add_filter('comment_text', 'content_twitter_mention');											
		
<!-- WordPress Breadcrumbs Without a Plugin -->

						function the_breadcrumb() {
						echo '<ul id="crumbs">';
						if (!is_home()) {
						echo '<li><a href="';
						echo get_option('home');
						echo '">';
						echo 'Home';
						echo "</a></li>";
						if (is_category() || is_single()) {
						echo '<li>';
						the_category(' </li><li> ');
						if (is_single()) {
						echo "</li><li>";
						the_title();
						echo '</li>';
						}
						} elseif (is_page()) {
						echo '<li>';
						echo the_title();
						echo '</li>';
						}
						}
						elseif (is_tag()) {single_tag_title();}
						elseif (is_day()) {echo"<li>Archive for "; the_time('F jS, Y'); echo'</li>';}
						elseif (is_month()) {echo"<li>Archive for "; the_time('F, Y'); echo'</li>';}
						elseif (is_year()) {echo"<li>Archive for "; the_time('Y'); echo'</li>';}
						elseif (is_author()) {echo"<li>Author Archive"; echo'</li>';}
						elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<li>Blog Archives"; echo'</li>';}
						elseif (is_search()) {echo"<li>Search Results"; echo'</li>';}
						echo '</ul>';
						}

						the_breadcrumb();

<!-- Display the Number of Facebook Fans -->
	
						$page_id = "YOUR PAGE-ID";
						$xml = @simplexml_load_file("http://api.facebook.com/restserver.php?method=facebook.fql.query&query=SELECT%20fan_count%20FROM%20page%20WHERE%20page_id=".$page_id."") or die ("a lot");
						$fans = $xml->page->fan_count;
						echo $fans;
			
<!-- WordPress Shortcode to Display External Files -->


						function show_file_func( $atts ) {
						  extract( shortcode_atts( array(
						    'file' => ''
						  ), $atts ) );
						 
						  if ($file!='')
						    return @file_get_contents($file);
						}
						 
						add_shortcode( 'show_file', 'show_file_func' );

						[show_file file="https://speckyboy.com/2010/12/09/20-plugin-replacing-tutorials-tips-snippets-and-solutions-for-wordpress/"]


<!-- Create Custom WordPress Widgets -->


						class My_Widget extends WP_Widget {  
						        function My_Widget() {  
						            parent::WP_Widget(false, 'Our Test Widget');  
						        }  
						    function form($instance) {  
						            // outputs the options form on admin  
						        }  
						    function update($new_instance, $old_instance) {  
						            // processes widget options to be saved  
						            return $new_instance;  
						        }  
						    function widget($args, $instance) {  
						            // outputs the content of the widget  
						        }  
						    }  
						    register_widget('My_Widget'); 

<!-- Create Custom WordPress Shortcodes -->

							function helloworld() {
							return 'Hello World!';
							}
							add_shortcode('hello', 'helloworld');

							[hello]



<!-- Custom Title Length -->

							function ODD_title($char)
							{
							  $title = get_the_title($post->ID);
							   $title = substr($title,0,$char);
							   echo $title;
							 }


<!-- Custom WordPress Excerpts -->

							add_filter('the_excerpt', 'my_excerpts');
							function my_excerpts($content = false) {
							            global $post;
							            $mycontent = $post->post_excerpt;
							 
							            $mycontent = $post->post_content;
							            $mycontent = strip_shortcodes($mycontent);
							            $mycontent = str_replace(']]>', ']]&gt;', $mycontent);
							            $mycontent = strip_tags($mycontent);
							            $excerpt_length = 55;
							            $words = explode(' ', $mycontent, $excerpt_length + 1);
							            if(count($words) > $excerpt_length) :
							                array_pop($words);
							                array_push($words, '...');
							                $mycontent = implode(' ', $words);
							            endif;
							            $mycontent = '<p>' . $mycontent . '</p>';
							// Make sure to return the content
							    return $mycontent;
							}


<!-- Redirect WordPress Post Titles To External Links -->

							//Custom Redirection
							function print_post_title() {
							global $post;
							$thePostID = $post->ID;
							$post_id = get_post($thePostID);
							$title = $post_id->post_title;
							$perm  = get_permalink($post_id);
							$post_keys = array(); $post_val  = array();
							$post_keys = get_post_custom_keys($thePostID);
							if (!empty($post_keys)) {
							foreach ($post_keys as $pkey) {
							if ($pkey=='url') {
							$post_val = get_post_custom_values($pkey);
							}
							}
							if (empty($post_val)) {
							$link = $perm;
							} else {
							$link = $post_val[0];
							}
							} else {
							$link = $perm;
							}
							echo '<h2><a href="'.$link.'" rel="bookmark" title="'.$title.'">'.$title.'</a></h2>';
							}



    
<!-- Redirect to Single WordPress Post if There is Only One Post in Category/Tag -->



							function stf_redirect_to_post(){
							    global $wp_query;
							 
							    // If there is one post on archive page
							    if( is_archive() && $wp_query->post_count == 1 ){
							        // Setup post data
							        the_post();
							        // Get permalink
							        $post_url = get_permalink();
							        // Redirect to post page
							        wp_redirect( $post_url );
							    }  
							 
							} add_action('template_redirect', 'stf_redirect_to_post');

<!-- List Scheduled/Future WordPress Posts -->

							$my_query = new WP_Query('post_status=future&order=DESC&showposts=5');
							if ($my_query->have_posts()) {
							    while ($my_query->have_posts()) : $my_query->the_post();
							        $do_not_duplicate = $post->ID; ?>
							        <li><?php the_title(); ?></li>
							    <?php endwhile;
							}

<!-- Reset Your WordPress Password -->

                          UPDATE `wp_users` SET `user_pass` = MD5('NEW_PASSWORD') WHERE `wp_users`.`user_login` =`YOUR_USER_NAME` LIMIT 1;

<!-- Detect Which Browser Your WordPress Visitors are Using-->

							add_filter('body_class','browser_body_class');
							function browser_body_class($classes) {
							global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
							if($is_lynx) $classes[] = 'lynx';
							elseif($is_gecko) $classes[] = 'gecko';
							elseif($is_opera) $classes[] = 'opera';
							elseif($is_NS4) $classes[] = 'ns4';
							elseif($is_safari) $classes[] = 'safari';
							elseif($is_chrome) $classes[] = 'chrome';
							elseif($is_IE) $classes[] = 'ie';
							else $classes[] = 'unknown';
							if($is_iphone) $classes[] = 'iphone';
							return $classes;
							}

<!-- Display WordPress Search Terms from Google Users-->

							$refer = $_SERVER["HTTP_REFERER"];
							if (strpos($refer, "google")) {
							        $refer_string = parse_url($refer, PHP_URL_QUERY);
							        parse_str($refer_string, $vars);
							        $search_terms = $vars['q'];
							        echo 'Welcome Google visitor! You searched for the following terms to get here: ';
							        echo $search_terms;
							};


<!-- Add SSL to Your WordPress Website-->


							// Run WP-Admin using SSL
							define('FORCE_SSL_ADMIN', true);

							RewriteCond %{HTTPS} off
                            RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]


<!--  Exclude Posts or Pages from WordPress Search Results -->

							 function SearchFilter($query) {
							    if ($query->is_search) {
							        $query->set('cat','0,1');
							    }
							    return $query;
							}
							add_filter('pre_get_posts','SearchFilter');  


<!--  WordPress Drop-Down Category Search Form -->

						<form role="search" method="get" id="searchform" action="<?php bloginfo('siteurl'); ?>">
						  <div>
						    <label class="screen-reader-text" for="s">Search for:</label>
						    <input type="text" value="" name="s" id="s" /> 
						    in  wp_dropdown_categories( 'show_option_all=All Categories' );
						    <input type="submit" id="searchsubmit" value="Search" />
						  </div>
						</form>


<!--  Search a Specific WordPress Post Type -->

						function SearchFilter($query) {
						  if ($query->is_search) {
						    // Insert the specific post type you want to search
						    $query->set('post_type', 'feeds');
						  }
						  return $query;
						}

						// This filter will jump into the loop and arrange our results before they're returned
						add_filter('pre_get_posts','SearchFilter');

<!--  Disable WordPress Search -->

						function fb_filter_query( $query, $error = true ) {

							if ( is_search() ) {
								$query->is_search = false;
								$query->query_vars = false;
								$query->query = false;

								// to error
								if ( $error == true )
									$query->is_404 = true;
							}
						}

						add_action( 'parse_query', 'fb_filter_query' );
						add_filter( 'get_search_form', create_function( '$a', "return null;" ) );

<!--  Easily Navigate Within a Section of Pages -->

						if (  $post->post_parent ) { 
						    $children =  wp_list_pages( array( 
						        'title_li' =>  '',
						        'child_of' =>  $post->post_parent, 
						        'echo'     => 0 
						    )  ); 
						} else { 
						    $children =  wp_list_pages( array( 
						        'title_li' =>  '', 
						        'child_of' =>  $post->ID, 
						        'echo'     => 0 
						    )  );
						} 
						if (  $children ) : ?> 
						    <ul> 
						        <?php  echo $children; ?> 
						    </ul> 
						<?php endif; 

<!--  Post Archive Pagination -->

						the_posts_pagination(  array(
						'mid_size' => 5, // The number of pages displayed in the menu.
						'prev_text' => __( '&laquo; Go Back', 'textdomain' ), // Previous  Posts text.
						'next_text' => __( 'Move Forward &raquo;', 'textdomain' ), // Next  Posts text.
						) );

<!-- Disabling WordPress Plugin Deactivation -->


						add_filter( 'plugin_action_links', 'slt_lock_plugins', 10, 4 );
						function slt_lock_plugins( $actions, $plugin_file, $plugin_data, $context ) {
							// Remove edit link for all
							if ( array_key_exists( 'edit', $actions ) )
								unset( $actions['edit'] );
							// Remove deactivate link for crucial plugins
							if ( array_key_exists( 'deactivate', $actions ) && in_array( $plugin_file, array(
								'slt-custom-fields/slt-custom-fields.php',
								'slt-file-select/slt-file-select.php',
								'slt-simple-events/slt-simple-events.php',
								'hello.php'
							)))
								unset( $actions['deactivate'] );
							return $actions;
						}

<!-- Disabling WordPress Theme Changing -->

						add_action( 'admin_init', 'slt_lock_theme' );
						function slt_lock_theme() {
							global $submenu, $userdata;
							get_currentuserinfo();
							if ( $userdata->ID != 1 ) {
								unset( $submenu['themes.php'][5] );
								unset( $submenu['themes.php'][15] );
							}
						}

<!-- Disable Top-Level Menus from the WordPress Admin Panel -->	

						function remove_menus () {
						global $menu;
							$restricted = array(__('Dashboard'), __('Posts'), __('Media'), __('Links'), __('Pages'), __('Appearance'), __('Tools'), __('Users'), __('Settings'), __('Comments'), __('Plugins'));
							end ($menu);
							while (prev($menu)){
								$value = explode(' ',$menu[key($menu)][0]);
								if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
							}
						}
						add_action('admin_menu', 'remove_menus');


<!-- Disable Submenus from the WordPress Admin Panel -->						


						function remove_submenus() {
						  global $submenu;
						    unset($submenu['index.php'][10]); // Removes 'Updates'.
						    unset($submenu['themes.php'][5]); // Removes 'Themes'.  
						    unset($submenu['options-general.php'][15]); // Removes 'Writing'.
						    unset($submenu['options-general.php'][25]); // Removes 'Discussion'.       
						}
						add_action('admin_menu', 'remove_submenus');

 <!--  Restrict WordPress Admin Menu Items Based on Username -->

						 function remove_menus()
						{
						    global $menu;
						    global $current_user;
						    get_currentuserinfo();

						    if($current_user->user_login == 'clients-username')
						    {
						        $restricted = array(__('Posts'),
						                            __('Media'),
						                            __('Links'),
						                            __('Pages'),
						                            __('Comments'),
						                            __('Appearance'),
						                            __('Plugins'),
						                            __('Users'),
						                            __('Tools'),
						                            __('Settings')
						        );
						        end ($menu);
						        while (prev($menu)){
						            $value = explode(' ',$menu[key($menu)][0]);
						            if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
						        }// end while

						    }// end if
						}
						add_action('admin_menu', 'remove_menus');


 <!--  Remove WordPress Meta-Boxes from Posts & Pages Editor Screens -->


						function remove_extra_meta_boxes() {
						remove_meta_box( 'postcustom' , 'post' , 'normal' ); // custom fields for posts
						remove_meta_box( 'postcustom' , 'page' , 'normal' ); // custom fields for pages
						remove_meta_box( 'postexcerpt' , 'post' , 'normal' ); // post excerpts
						remove_meta_box( 'postexcerpt' , 'page' , 'normal' ); // page excerpts
						remove_meta_box( 'commentsdiv' , 'post' , 'normal' ); // recent comments for posts
						remove_meta_box( 'commentsdiv' , 'page' , 'normal' ); // recent comments for pages
						remove_meta_box( 'tagsdiv-post_tag' , 'post' , 'side' ); // post tags
						remove_meta_box( 'tagsdiv-post_tag' , 'page' , 'side' ); // page tags
						remove_meta_box( 'trackbacksdiv' , 'post' , 'normal' ); // post trackbacks
						remove_meta_box( 'trackbacksdiv' , 'page' , 'normal' ); // page trackbacks
						remove_meta_box( 'commentstatusdiv' , 'post' , 'normal' ); // allow comments for posts
						remove_meta_box( 'commentstatusdiv' , 'page' , 'normal' ); // allow comments for pages
						remove_meta_box('slugdiv','post','normal'); // post slug
						remove_meta_box('slugdiv','page','normal'); // page slug
						remove_meta_box('pageparentdiv','page','side'); // Page Parent
						}
						add_action( 'admin_menu' , 'remove_extra_meta_boxes' );

 <!--  Removing Default Widgets from the WordPress Dashboard -->

						// Create the function to use in the action hook
						function example_remove_dashboard_widgets() {
							// Globalize the metaboxes array, this holds all the widgets for wp-admin
						 
							global $wp_meta_boxes;
						 
							// Remove the incomming links widget
							unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);	
						 
							// Remove right now
							unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
							unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
							unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
						}
						 
						// Hoook into the 'wp_dashboard_setup' action to register our function
						add_action('wp_dashboard_setup', 'example_remove_dashboard_widgets' );

 <!-- Create Personalized WordPress Dashboard Widgets -->

						// Create the function to output the contents of our Dashboard Widget
						function example_dashboard_widget_function() {
							// Display whatever it is you want to show
							echo "Hello World, I'm a great Dashboard Widget";
						} 
						 
						// Create the function use in the action hook
						function example_add_dashboard_widgets() {
							wp_add_dashboard_widget('example_dashboard_widget', 'Example Dashboard Widget', 'example_dashboard_widget_function');
						}
						// Hoook into the 'wp_dashboard_setup' action to register our other functions
						add_action('wp_dashboard_setup', 'example_add_dashboard_widgets' );

 <!-- Add, Remove & Reorder Dashboard Widgets By Role -->

						function tidy_dashboard()
						{
						  global $wp_meta_boxes, $current_user;
						 
						  // remove incoming links info for authors or editors
						  if(in_array('author', $current_user->roles) || in_array('editor', $current_user->roles))
						  {
						    unset($wp_meta_boxes['dashboard']['normal ']['core']['dashboard_incoming_links']);
						  }
						   
						  // remove the plugins info and news feeds for everyone
						  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
						  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
						  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
						 
						}
						//add our function to the dashboard setup hook
						add_action('wp_dashboard_setup', 'tidy_dashboard');
                        


                        //Right Now - Comments, Posts, Pages at a glance
						unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
						//Recent Comments
						unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
						//Incoming Links
						unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
						//Plugins - Popular, New and Recently updated WordPress Plugins
						unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);

						//Wordpress Development Blog Feed
						unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
						//Other WordPress News Feed
						unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
						//Quick Press Form
						unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
						//Recent Drafts List
						unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);


 <!-- Simpler WordPress Login URL -->
                        
                        RewriteRule ^login$ http://yoursite.com/wp-login.php [NC,L]

 <!-- Change the Dashboard Footer Text -->

						function remove_footer_admin () {
						    echo "Your own text";
						} 

						add_filter('admin_footer_text', 'remove_footer_admin');

  <!-- Changing the WordPress Login Logo -->

						// login page logo
						function custom_login_logo() {
							echo '<style type="text/css">h1 a { background: url('.get_bloginfo('template_directory').'/about-banner.jpg) 50% 50% no-repeat !important; }</style>';
						}
						add_action('login_head', 'custom_login_logo');


   <!-- Adding a Custom WordPress Dashboard Logo -->

						   //hook the administrative header output
						add_action('admin_head', 'my_custom_logo');

						function my_custom_logo() {
						echo '
						<style type="text/css">
						#header-logo { background-image: url('.get_bloginfo('template_directory').'/images/custom-logo.gif) !important; }
						</style>
						';
						}

 <!-- Remove the comments icon in the admin bar -->

   
						// login page logo
						function custom_login_logo() {
							echo '<style type="text/css">h1 a { background: url('.get_bloginfo('template_directory').'/about-banner.jpg) 50% 50% no-repeat !important; }</style>';
						}
						add_action('login_head', 'custom_login_logo');

<!-- Options-->

			           // Create an option to the database
			           add_option( $option, $value = , $deprecated = , $autoload = 'yes' );
			 
			           // Removes option by name.
			           delete_option( $option );
			 
			           // Fetch a saved option
			           get_option( $option, $default = false );
			 
			           // Update the value of an option that was already added.
			           update_option( $option, $newvalue );


<!-- WP Paginate -->			           

                wp_reset_query();

                $paged = 1;
                $per_page=2;

                if (get_query_var('paged') ) $paged = get_query_var('paged');
                if (get_query_var('page') ) $paged = get_query_var('page');
                query_posts( 'post_type=careers&orderby=menu_order&order=ASC&showposts='.$per_page.'&paged='.$paged );
                $total_pages = ceil($wp_query->found_posts/$per_page); 
                    if (have_posts()) : ?> 
                       while (have_posts()) : the_post(); 

					        the_title();
         
                       endwhile; wp_paginate();

                    else: echo "<p class='comingsoon'>Coming Soon!</p>"; endif;

<!-- Yoast-seo-meta-tags -->

					add_filter('wpseo_title', 'filter_product_wpseo_title');
					 function filter_product_wpseo_title($title) { 
					 if( is_singular( 'product') ) { $title = //your code } 
					 return $title; 
					}

					wpseo_title	<title>#</title>**
					wpseo_robots	<meta name="robots" content="#"/>
					wpseo_canonical	<link rel="canonical" href="#"/>
					wpseo_metadesc	<meta name="description" content="#"/>
					wpseo_metakeywords	<meta name="keywords" content="#"/>
					wpseo_locale	<meta property="og:locale" content="#"/>
					wpseo_opengraph_title	<meta property="og:title" content="#"/>
					wpseo_opengraph_desc	<meta property="og:description" content="#"/>
					wpseo_opengraph_url	<meta property="og:url" content="#"/>
					wpseo_opengraph_type	<meta property="og:type" content="website"/>
					wpseo_opengraph_site_name	<meta property="og:site_name" content="#"/>
					wpseo_opengraph_admin	<meta property="fb:admins" content="#"/>
					wpseo_opengraph_author_facebook	<meta property="article:author" content="#"/>
					wpseo_opengraph_show_publish_date	<meta property="article:published_time" content="#"/>
					wpseo_twitter_title	<meta name="twitter:title" content="#"/>
					wpseo_twitter_description	<meta name="twitter:description" content="#"/>
					wpseo_twitter_card_type	<meta name="twitter:card" content="#"/>
					wpseo_twitter_site	<meta name="twitter:site" content="#"/>
					wpseo_twitter_image	<meta name="twitter:image" content="#"/>
					wpseo_twitter_creator_account	<meta name="twitter:creator" content="#"/>
					wpseo_json_ld_output	<script type='application/ld+json'>#<script/>

<!-- Change the maximum upload file size -->

					php_value memory_limit 256M
					php_value post_max_size 256M
					php_value upload_max_filesize 500M
					php_value max_input_vars 1800
					php_value max_execution_time 300
					php_value max_input_time 300

<!-- acf/save_post -->


				        function clear_advert_main_transient($post_id) {
				            if ( $post_id == 'options' ) {
				                if($_GET['page']=="slug"){
				                 
				                }
				            }
				            //return $post_id;
				        }
				        add_action('acf/save_post', 'clear_advert_main_transient', 20);

 ?>
