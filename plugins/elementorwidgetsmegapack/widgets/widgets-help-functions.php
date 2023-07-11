<?php
/** Get Animations **/
if(!function_exists('ewmp_animate_class')) {
	function ewmp_animate_class($addon_animate,$effect,$delay) {
		if($addon_animate == 'on') : 
			wp_enqueue_script( 'appear' );			
			wp_enqueue_script( 'animate' );		
			$animate_class = ' animate-in" data-anim-type="'.$effect.'" data-anim-delay="'.$delay.'"'; 
		else :
			$animate_class = '"';
		endif;		
		return $animate_class;
	}
}

/** Get Category **/
if(!function_exists('ewmp_get_category')) {
	function ewmp_get_category($source,$posts_type,$css_link,$limit = 1) {
		$separator = ' ';
		$output = '';	
		$count = 1;
		if($source=='wp_posts') {			
			$categories = get_the_category();
			if($categories){
				foreach($categories as $category) {
					$output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s",'elementorwidgetsmegapack' ), $category->name ) ) . '" '.$css_link.'>'.esc_html($category->cat_name).'</a>'.esc_html($separator);
					if($count == $limit) { break; }
					$count++;
				}
			}
		} elseif($source=='post_type') {
			global $post;
			$taxonomy_names = get_object_taxonomies( $posts_type );
			$term_list = wp_get_post_terms($post->ID,$taxonomy_names);
			if($term_list){
				foreach ($term_list as $tax_term) {
					$output .= '<a href="' . esc_attr(get_term_link($tax_term, $posts_type)) . '" title="' . esc_attr( sprintf( __( "View all posts in %s",'elementorwidgetsmegapack' ), $tax_term->name ) ) . '" '.$css_link.'>' . esc_html($tax_term->name) .'</a>'.esc_html($separator);
				}
			}
		}
		$return = trim($output, $separator);
		return $return;
	}
}

/** Get Author **/
if(!function_exists('ewmp_get_author')) {
	function ewmp_get_author($css_link) {
		$return = '<a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'" '.$css_link.'>'.get_the_author_meta( 'display_name' ).'</a>';
		return $return;
	}	
}

/** Get Comments **/
if(!function_exists('ewmp_get_num_comments')) {	
	function ewmp_get_num_comments($css_comment,$css_comment_link) {
			$num_comments = get_comments_number();

			if ( $num_comments == 0 ) {
					$comments = esc_html__('No Comments','elementorwidgetsmegapack');
					$return = $comments;
			} elseif ( $num_comments > 1 ) {
					$comments = $num_comments . esc_html__(' Comments','elementorwidgetsmegapack');
					$return = '<a href="' . get_comments_link() .'" '.$css_comment_link.'>'. esc_html($comments).'</a>';
			} else {
					$comments = esc_html__('1 Comment','elementorwidgetsmegapack');
					$return = '<a href="' . get_comments_link() .'" '.$css_comment_link.'>'. esc_html($comments) .'</a>';
			}
			return $return;
	}
}

if(!function_exists('ewmp_get_only_num_comments')) {
	function ewmp_get_only_num_comments($css_comment,$css_comment_link) {
			$num_comments = get_comments_number();

			if ( $num_comments == 0 ) {
					$return = '<span '.$css_comment.'>'.esc_html($num_comments).'</span>';
			} elseif ( $num_comments > 1 ) {
					$return = '<a href="' . get_comments_link() .'" '.$css_comment_link.'>'. esc_html($num_comments).'</a>';
			} else {
					$return = '<a href="' . get_comments_link() .'" '.$css_comment_link.'>'. esc_html($num_comments).'</a>';
			}
			return $return;
	}
}

/** Get Thumbnails **/
if(!function_exists('ewmp_get_thumb')) {
	function ewmp_get_thumb($thumbs_size = 'fpg-normal') {
		global $post;
		$link = get_the_permalink();
		if(has_post_thumbnail()){ 
				$id_post = get_the_id();					
				$single_image = wp_get_attachment_image_src( get_post_thumbnail_id($id_post), $thumbs_size );	
				$return = '<a href="'.esc_url($link).'"><img class="fpg-thumbs" src="'.$single_image[0].'" alt="'.get_the_title().'"></a>';
			} else {               
				$return = '';                 
		}
		return $return;
	}
}

function ewmp_get_thumbs_link() {
	global $post;
	if(has_post_thumbnail()){ 
			$id_post = get_the_id();					
			$single_image = wp_get_attachment_image_src( get_post_thumbnail_id($id_post), 'wpfpg_zoom' );	 					 
		} else {               
             $single_image[0] = EWMP_URL .'assets/img/no-img.png';                 
    }	
	$return = $single_image[0];
	return $return;
}


/** Get Blog Thumbnails **/
if(!function_exists('ewmp_get_blogs_thumb')) {
	function ewmp_get_blogs_thumb($columns,$post_id) {
		global $post; 		
		if($columns == '1') :
			$return = ewmp_get_thumb('ewmp-blog-large');
		elseif($columns == '2') :
			$return = ewmp_get_thumb('ewmp-blog-medium');
		else :
			$return = ewmp_get_thumb('ewmp-blog-small');
		endif;	
		return $return;
	}
}	

/** Check Post Format **/
if(!function_exists('ewmp_bloglayouts_check_post_format')) {
	function ewmp_bloglayouts_check_post_format() {
		global $post;
		$format = get_post_format_string( get_post_format() );
		if($format == 'Video') :
			$return = '<span class="bloglayouts-format-type fa fa-play-circle-o"></span>';
		elseif($format == 'Audio') :
			$return = '<span class="bloglayouts-format-type fa fa-headphones"></span>';
		else :
			$return = '';
		endif;
		return $return;
	}
}

/** Get Blog Excerpt **/
if(!function_exists('ewmp_get_blogs_excerpt')) {
	function ewmp_get_blogs_excerpt($excerpt = 'default',$readmore = 'on',$css_link = '') {
		global $post;
		if($excerpt == 'default') : 
			$return = get_the_excerpt();
		else :
			$return = substr(get_the_excerpt(), 0, $excerpt);
			if($readmore == 'on') :
				$return .= '<a class="article-read-more" href="'. get_permalink($post->ID) . '" '.$css_link.'>'.esc_html__('Read More','elementorwidgetsmegapack').'</a>';
			else :
				$return .= '...';
			endif;
		endif;
		return $return;
	}
}

/** Get News Excerpt **/
if(!function_exists('ewmp_get_news_excerpt')) {
	function ewmp_get_news_excerpt($excerpt = 'default',$readmore = 'on',$css_link) {
		global $post;
		if($excerpt == 'default') : 
			$return = get_the_excerpt();
		else :
			$return = substr(get_the_excerpt(), 0, $excerpt);
			if($readmore == 'on') :
				$return .= '<a class="article-read-more" href="'. get_permalink($post->ID) . '" '.$css_link.'><i class="fa fa-angle-double-right"></i></a>';
			else :
				$return .= '...';
			endif;
		endif;
		return $return;
	}
}

/** Get News Excerpt **/
if(!function_exists('ewmp_get_news_v2_excerpt')) {
	function ewmp_get_news_v2_excerpt($excerpt = 'default',$readmore = 'on',$css_link) {
		global $post;
		if($excerpt == 'default') : 
			$return = get_the_excerpt();
		else :
			$return = substr(get_the_excerpt(), 0, $excerpt);
			if($readmore == 'on') :
				$return .= '<a class="article-read-more" href="'. get_permalink($post->ID) . '" '.$css_link.'>...</a>';
			else :
				$return .= '...';
			endif;
		endif;
		return $return;
	}
}

/** Check Post Format **/
if(!function_exists('ewmp_check_post_format')) {
	function ewmp_check_post_format() {
		global $post;
		$format = get_post_format_string( get_post_format() );
		if($format == 'Video') :
			$return = '<span class="fpg-format-type fa fa-play-circle-o"></span>';
		elseif($format == 'Audio') :
			$return = '<span class="fpg-format-type fa fa-headphones"></span>';
		else :
			$return = '';
		endif;
		return $return;
	}
}

/** Post Social Share **/
if(!function_exists('ewmp_post_social_share')) {
	function ewmp_post_social_share($css_link) {
		
		$return = '<div class="container-social">
			<a target="_blank" href="http://www.facebook.com/sharer.php?u='.get_the_permalink().'&amp;t='.get_the_title().'" title="'.esc_html__('Click to share this post on Facebook','elementorwidgetsmegapack').'" '.$css_link.'><i class="fa fa-facebook"></i></a>
			<a target="_blank" href="http://twitter.com/home?status='.get_the_permalink().'" title="'.esc_html__('Click to share this post on Twitter','elementorwidgetsmegapack').'"><i class="fa fa-twitter" '.$css_link.'></i></a>
			<a target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&amp;url='.get_the_permalink().'" title="'.esc_html__('Click to share this post on Linkedin','elementorwidgetsmegapack').'"><i class="fa fa-linkedin" '.$css_link.'></i></a></div>';
		
		return $return;
	}
}
/** Get Numeric Pagination **/
if(!function_exists('ewmp_posts_numeric_pagination')) {
	function ewmp_posts_numeric_pagination($pages = '', $range = 2,$loop,$paged,$css_current_pag_num,$css_link) {  
		 $showitems = ($range * 2)+1;  

		 if(empty($paged)) $paged = 1;

		 if($pages == '')
		 {
			 $pages = $loop->max_num_pages;
			 if(!$pages)
			 {
				 $pages = 1;
			 }
		 }   
		
		 $return = '';
		
		 if(1 != $pages) {		 	
			 $return .= "<div class='fnwp-numeric-pagination'>";
			 if($paged > 2 && $paged > $range+1 && $showitems < $pages) $return .=  "<a href='".get_pagenum_link(1)."' class=\"fnwp-pagination-numeric-arrow\" ".$css_link."><i class=\"fa fa-angle-double-left fnwp-icon-double-left\"></i></a>";
			 if($paged > 1 && $showitems < $pages) $return .=  "<a href='".get_pagenum_link($paged - 1)."' class=\"fnwp-pagination-numeric-arrow\" ".$css_link."><i class=\"fa fa-angle-left fnwp-icon-left\"></i></a>";

			 for ($i=1; $i <= $pages; $i++)
			 {
				 if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
				 {
					 $return .=  ($paged == $i)? "<span class='current' ".$css_current_pag_num.">".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' ".$css_link.">".$i."</a>";
				 }
			 }

			 if ($paged < $pages && $showitems < $pages) $return .= "<a href='".get_pagenum_link($paged + 1)."' class=\"fnwp-pagination-numeric-arrow\" ".$css_link."><i class=\"fa fa-angle-right fnwp-icon-right\"></i></a>";
			 if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) $return .=  "<a href='".get_pagenum_link($pages)."' class=\"fnwp-pagination-numeric-arrow\" ".$css_link."><i class=\"fa fa-angle-double-right fnwp-icon-double-right\"></i></a>";
			 $return .=  "</div>\n";
		 }
		 
		 return $return;
	}
}

/* Gallery Pagination */
function ewmp_get_gallery_pagination($num_page_for_pagination,$pagination) {
	$output = '<ul class="fpg_gallery_pagination">';
	for($i=1; $i <= $num_page_for_pagination; $i++) {
		
		if($i == $pagination) {
			$output .= '<li class="mg_current">'.esc_html($i).'</li>'; // CURRENT PAGE
		} else {
			$output .= '<li><a href="'.get_post_permalink().'&mg_page='.$i.'">'.esc_html($i).'</a></li>'; // OTHER PAGE
		}
	}
	$output .= '</ul>';
	return $output;
}

/* Var Gallery Pagination */
function ewmp_add_query_vars_fpg_gallery_pagination( $vars ){
  $vars[] = "mg_page";
  return $vars;
}
add_filter( 'query_vars', 'ewmp_add_query_vars_fpg_gallery_pagination' );

/* Gallery Share Button */
function ewmp_share_button($id,$image_lightbox,$text_caption) {
	$return = '';
	$return .= '<a href="" class="fa fa-share-alt"></a>';
	$return .= '<div class="fpg-gallery-social-share-container">';
		$return .= '<div class="fpg-gallery-social-share-container-content">';
			$return .= '<a target="_blank" href="http://www.facebook.com/sharer.php?caption='.$text_caption.'&description='.$text_caption.'&u='.$image_lightbox.'&picture='.$image_lightbox.'"><i class="fa fa-facebook"></i></a>';
		$return .= '</div>';
	$return .= '</div>';
	return $return;
	
}

function ewmp_share($skin) {
	global $post;
	$pinterestimage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
	
		
	$return = '<div class="fpg-share-container">
        <div class="fpg-share-item"><a target="_blank" class="icon-facebook fa fa-facebook" href="http://www.facebook.com/sharer.php?u='.get_the_permalink().'&amp;t='.get_the_title().'" title="'.esc_html__('Click to share this post on Facebook','elementorwidgetsmegapack').'"></a></div>
		<div class="fpg-share-item"><a target="_blank" class="icon-twitter fa fa-twitter" href="http://twitter.com/home?status='.get_the_permalink().'" title="'.esc_html__('Click to share this post on Twitter','elementorwidgetsmegapack').'"></a></div>';
       
	$return .= '<div class="fpg-share-item"><a target="_blank" class="icon-linkedin fa fa-linkedin" href="http://www.linkedin.com/shareArticle?mini=true&amp;url='.get_the_permalink().'" title="'.esc_html__('Click to share this post on Linkedin','elementorwidgetsmegapack').'"></a></div>';
	
	$return .= '<div class="fpg-share-item"><a target="_blank" class="icon-pinterest fa fa-pinterest" href="http://pinterest.com/pin/create/button/?url='.urlencode(get_permalink($post->ID)).'&media='.esc_url($pinterestimage[0]).'&description='.get_the_title().'" title="'.esc_html__('Click to share this post on Pinterest','elementorwidgetsmegapack').'"></a></div>
    </div>';
	
    return $return;
    
}

function ewmp_post_info(
						$show_date,
						$show_comments,
						$show_author,
						$show_category,
						$show_views,
						$source,
						$posts_type,
						$date_format) {	   
		   global $post;
		   $return = '';
		   if($show_date == 'true') {
		   
		   		$return .= '<span class="admp-date"><i class="fa fa-calendar"></i>' . get_the_date($date_format) . '</span>'; 
			
		   }
		    
		   if($show_author == 'true') {	   
		   		$return .= '<span class="admp-author"><i class="fa fa-user"></i><a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'">'.get_the_author_meta( 'display_name' ).'</a></span>'; 
		   } 	
		   	   
		   if($show_comments == 'true') {
           	   
           		$return .= '<span class="admp-comments"><i class="fa fa-comments"></i><a href="'.get_comments_link().'">'.get_comments_number().'</a></span>';
		   
		   }
		    		    
		   if($show_category == 'true' && $source == 'wp_posts') {
		   		$return .= '<span class="admp-category"><i class="fa fa-tag"></i>'.ewmp_get_category($source,$posts_type,'',1).'</span>'; 
		   }
			
		   if($show_views == 'true') {        
		   $return .= '<span class="admp-views"><i class="fa fa-eye"></i>'.ewmp_get_post_views(get_the_ID()).'</span>';
		   }
		   
		   return $return; 		   
}

/**************************************************************************/
/************************** FUNCTION VIEW *********************************/
/**************************************************************************/

function ewmp_get_post_views($postID){
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
		$view = esc_html__('Views','elementorwidgetsmegapack');
        return "0";
    }
	$count_final = $count;
    return $count_final;
}

function ewmp_set_post_views() {
	if ( is_single() ) {
	global $post;
	$postID = $post->ID;	
    $count_key = 'wpb_post_views_count';
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
}
add_filter( 'wp_footer', 'ewmp_set_post_views', 200000 );


if(!function_exists('ewmp_query')) {
	function ewmp_query( $source,
						$posts_source, 
						$posts_type, 
						$categories,
						$categories_post_type,
						$order, 
						$orderby, 
						$pagination, 
						$pagination_type,
						$num_posts, 
						$num_posts_page) {
								  
						if($orderby == 'views') { 
								$orderby = 'meta_value_num'; 
								$view_order = 'views';
						} else { $view_order = ''; }	
										
						if($source == 'post_type') {
							$posts_source = 'all_posts';
						}
						
						if($posts_source == 'all_posts') {
						
							$query = 'post_type=Post&post_status=publish&ignore_sticky_posts=1&orderby='.$orderby.'&order='.$order.'';						
							
							// CUSTOM POST TYPE
							if($source == 'post_type') {
								$query .= '&post_type='.$posts_type.'';
							}

							if($view_order == 'views') { 
								$query .= '&meta_key=wpb_post_views_count';
							}
							
							// CATEGORIES POST TYPE
							if($categories_post_type != '' && !empty($categories_post_type) && $source == 'post_type') {
								$taxonomy_names = get_object_taxonomies( $posts_type );
								$query .= '&'.$taxonomy_names[0].'='.$categories_post_type.'';	
							}

							// CATEGORIES POSTS
							if($categories != '' && $categories != 'all' && !empty($categories) && $source == 'wp_posts') {
								$query .= '&category_name='.$categories.'';	
							}
								
							if($pagination == 'yes' || $pagination == 'load-more') {
								$query .= '&posts_per_page='.$num_posts_page.'';	
							} else {
								if($num_posts == '') { $num_posts = '-1'; }
								$query .= '&posts_per_page='.$num_posts.'';
							}
						
							// PAGINATION		
							if($pagination == 'yes' || $pagination == 'load-more') {
								if ( get_query_var('paged') ) {
									$paged = get_query_var('paged');
								
								} elseif ( get_query_var('page') ) {			
									$paged = get_query_var('page');			
								} else {			
									$paged = 1;			
								}			
								$query .= '&paged='.$paged.'';
							}
							// #PAGINATION	
						
						} else { // IF STICKY
							

							if($pagination == 'yes' || $pagination == 'load-more') {
								$num_posts = $num_posts_page;	
							} else {
								if($num_posts == '') { $num_posts = '-1'; }
								$num_posts = $num_posts;
							}

							// PAGINATION		
							
							if ( get_query_var('paged') ) {
								$paged = get_query_var('paged');							
							} elseif ( get_query_var('page') ) {			
								$paged = get_query_var('page');			
							} else {			
								$paged = 1;			
							}			
							
							// #PAGINATION	
												
							/* STICKY POST DA FARE ARRAY PER SCRITTURA IN ARRAY */
						
							$sticky = get_option( 'sticky_posts' );
							$sticky = array_slice( $sticky, 0, 5 );
							if($view_order == 'views') { 
								$query = array(
									'post_type' => 'post',
									'post_status' => 'publish',
									'orderby' 	=> $orderby,
									'order' => $order,
									'category_name' => $categories,
									'posts_per_page' => $num_posts,
									'meta_key' => 'wpb_post_views_count',
									'paged' => $paged, 
									'post__in'  => $sticky,
									'ignore_sticky_posts' => 1
								);
							} else {
								$query = array(
									'post_type' => 'post',
									'post_status' => 'publish',
									'orderby' 	=> $orderby,
									'order' => $order,
									'category_name' => $categories,
									'posts_per_page' => $num_posts,
									'paged' => $paged, 
									'post__in'  => $sticky,
									'ignore_sticky_posts' => 1
								);
							}						
							
						} // #all_posts
						
						return $query;	
	}
}

/************************************************************/
/*********************** CUSTOM STYLE ***********************/
/************************************************************/

function ewmp_custom_style(	$istance,
									$type,
									$masonrygrid,
								  	$columns,
									$settings_type,
									$skin,
									$fonts,
									$gfonts,
									$title_fs,
									$content_fs,
									$main_color,
									$secondary_color,
									$font_color,
									$a_color,
									$over_color,
									$margin_right,
									$margin_bottom
									) {
	
	// FONTS
	if($fonts != 'default') {
		if($fonts != 'google_fonts') {
			
			$return = '.fpg-general-container.fpg-container-number-'.$istance.' {
				font-family:'.$fonts.';
			}';
		} else {
			$return = '@import url(\'http://fonts.googleapis.com/css?family='.$gfonts.'\');';
			$return .= '.fpg-general-container.fpg-container-number-'.$istance.' {
				font-family:'.$gfonts.';
			}';
		}	
	}
		
	// COLUMNS FOR GRID
	

	
	if($masonrygrid == 'wpfpg_grid') {
			if($margin_right != '0' || !empty($margin_right)) {
				$return .= '.fpg-grid.fpg-'.$istance.' {
					padding-left:'.($margin_right/2).'px;
				}';
			}		
			if($columns == '2') {		
				$return .= '
					.fpg-grid.grid-columns-2.fpg-'.$istance.'.wpfpg_grid .fpg-grid-item {
						margin-right:'.$margin_right.';
						margin-bottom:'.$margin_bottom.';
						max-width: -webkit-calc(50% - '.$margin_right.');
						max-width:         calc(50% - '.$margin_right.');
					}';
			}
			if($columns == '3') {		
				$return .= '
					.fpg-grid.grid-columns-3.fpg-'.$istance.'.wpfpg_grid .fpg-grid-item {
						margin-right:'.$margin_right.';
						margin-bottom:'.$margin_bottom.';
						max-width: -webkit-calc(33.333333% - '.$margin_right.');
						max-width:         calc(33.333333% - '.$margin_right.');
					}';
			}
			if($columns == '4') {		
				$return .= '
					.fpg-grid.grid-columns-4.fpg-'.$istance.'.wpfpg_grid .fpg-grid-item {
						margin-right:'.$margin_right.';
						margin-bottom:'.$margin_bottom.';
						max-width: -webkit-calc(25% - '.$margin_right.');
						max-width:         calc(25% - '.$margin_right.');
					}';
			}			
			if($columns == '5') {		
				$return .= '
					.fpg-grid.grid-columns-5.fpg-'.$istance.'.wpfpg_grid .fpg-grid-item {
						margin-right:'.$margin_right.';
						margin-bottom:'.$margin_bottom.';
						max-width: -webkit-calc(20% - '.$margin_right.');
						max-width:         calc(20% - '.$margin_right.');
					}';
			}
	} else {
			if($columns == '2') {		
				$return .= '
					.fpg-grid.grid-columns-2.fpg-'.$istance.'.wpfpg_masonry .fpg-grid-item {
						margin-right:'.$margin_right.';
						margin-bottom:'.$margin_bottom.';
						max-width: -webkit-calc(50% - '.$margin_right.');
						max-width:         calc(50% - '.$margin_right.');
						width:50%;
					}';
			}
			if($columns == '3') {		
				$return .= '
					.fpg-grid.grid-columns-3.fpg-'.$istance.'.wpfpg_masonry .fpg-grid-item {
						margin-right:'.$margin_right.';
						margin-bottom:'.$margin_bottom.';
						max-width: -webkit-calc(33.333333% - '.$margin_right.');
						max-width:         calc(33.333333% - '.$margin_right.');
					}';
			}
			if($columns == '4') {		
				$return .= '
					.fpg-grid.grid-columns-4.fpg-'.$istance.'.wpfpg_masonry .fpg-grid-item {
						margin-right:'.$margin_right.';
						margin-bottom:'.$margin_bottom.';
						max-width: -webkit-calc(25% - '.$margin_right.');
						max-width:         calc(25% - '.$margin_right.');
					}';
			}			
			if($columns == '5') {		
				$return .= '
					.fpg-grid.grid-columns-5.fpg-'.$istance.'.wpfpg_masonry .fpg-grid-item {
						margin-right:'.$margin_right.';
						margin-bottom:'.$margin_bottom.';
						max-width: -webkit-calc(20% - '.$margin_right.');
						max-width:         calc(20% - '.$margin_right.');
					}';
			}			
	}
	// FONT SIZE
	
	$return .= '
			.fpg-grid.fpg-'.$istance.' h1 {
				font-size:'.$title_fs.'px;
			}
			.fpg-grid.fpg-'.$istance.' p, .fpg-grid.fpg-'.$istance.' .fpg-read-more,
			.fpg-container-portfolio,
			.fpg-header-container
			 {
				font-size:'.$content_fs.'px;
			}';
		if($type == 'fpg-type-grid') {
			$return .= '
			.fpg-grid.fpg-'.$istance.' .fpg-grid-item:hover .fpg-container-grid, 
			.fpg-controls ul li,
			.fpg-container-grid .fpg-title { 
				color:'.$font_color.';
			}
			.fpg-grid.fpg-'.$istance.' .fpg-grid-item:hover .fpg-container-grid a {
				color:'.$a_color.';
				background:'.$secondary_color.';
			}
			.fpg-grid.fpg-'.$istance.' .fpg-grid-item:hover .fpg-container-grid a:hover,
			.fpg-controls .active, .fpg-controls .filter:hover {
				color:'.$over_color.';
			} 	
			.fpg-grid.fpg-'.$istance.' .fpg-grid-item:hover .fpg-container-grid {
				background:'.$main_color.';
			}';
		}
		if($type == 'fpg-type-portfolio') {
			if($skin == 'piazzadispagna') {
					$return .= '.fpg-'.$istance.' .fpg-title { 
									color:'.$font_color.';
							}';
			}
			$return .= '.fpg-'.$istance.' .fpg-container-portfolio,
			.fpg-'.$istance.' .fpg-container-portfolio .fpg-title { 
				color:'.$font_color.';
			}
			.fpg-grid.fpg-'.$istance.' .fpg-grid-item .fpg-container-portfolio a {
				color:'.$a_color.';
			}	
			.fpg-controls .active, .fpg-controls .filter:hover,
			.fpg-grid.fpg-'.$istance.' .fpg-grid-item .fpg-container-portfolio a:hover {
				color:'.$over_color.';
			}';			
		}
			
			
			
			
			
			$return .= '.fpg-container-number-'.$istance.' .fpg-pagination span {
				color:'.$over_color.';
			}
			.fpg-container-number-'.$istance.' .fpg-pagination a {
				color:'.$font_color.';	
			}
			.fpg-container-number-'.$istance.' .fpg-pagination a:hover {
				color:'.$over_color.';	
			}';		
		
		
		
		
		if($skin == 'foriimperiali') {
			$return .= '.fpg-container-number-'.$istance.' .foriimperiali .fpg-container-grid .fpg-title {
				border-color:'.$secondary_color.';
			}
			.fpg-container-number-'.$istance.' .foriimperiali .fpg-container-grid .fpg-title {
				font-size:'.$title_fs.'px;
				line-height:'.$title_fs.'px;
			}
			';
		}
		if($skin == 'pantheon') {
			$return .= '.fpg-container-number-'.$istance.' .fpg-controls.filter-pantheon ul li, 
			.fpg-container-number-'.$istance.'  .fpg-pagination.pantheon a, 
			.fpg-container-number-'.$istance.'  .fpg-pagination.pantheon .current
			 {
				background:'.$secondary_color.';
			}';
			if($margin_right == '0px' || empty($margin_right)) {
				$return .= '.fpg-container-number-'.$istance.' .fpg-controls.filter-pantheon ul li {
					border-right:1px solid '.$font_color.';
					margin-right:0px;
				}
				.fpg-container-number-'.$istance.' .fpg-controls.filter-pantheon ul li:last-child {
					border-right:0px;
				}							
				';
			} else {
				$return .= '.fpg-container-number-'.$istance.' .fpg-controls.filter-pantheon ul li {
					border-right:0px;
					margin-right:10px;
				}';				
			}
			$return .= '.fpg-container-number-'.$istance.' .pantheon .fpg-container-grid .fpg-title {
					font-size:'.$title_fs.'px;
					line-height:'.($title_fs+8).'px;
			}';
		}
		if($skin == 'circomassimo') {
			$return .= '.fpg-container-number-'.$istance.' .circomassimo .fpg-grid-item:hover .fpg-title {
					margin-top:-'.($title_fs/2+10).'px;
			}
			.fpg-container-number-'.$istance.' .circomassimo .fpg-container-grid .fpg-title {
				border-color:'.$secondary_color.';
			}
			.fpg-container-number-'.$istance.' .circomassimo .fpg-container-grid .fpg-title {
				font-size:'.$title_fs.'px;
				line-height:'.$title_fs.'px;
			}
			.fpg-container-number-'.$istance.' .fpg-controls.filter-circomassimo ul li {
				border:1px solid '.$secondary_color.';
				margin-right:10px;
				padding:10px 20px;
				border-radius:5px;
			}
			.fpg-container-number-'.$istance.' .fpg-pagination.circomassimo .pagination a,
			.fpg-container-number-'.$istance.' .fpg-pagination.circomassimo .pagination .current {
				border:1px solid '.$secondary_color.';
			}
			.fpg-container-number-'.$istance.' .fpg-pagination.circomassimo a {
				border:1px solid '.$secondary_color.';
			}									
			.fpg-container-number-'.$istance.' .fpg-controls.filter-circomassimo ul li:hover, 
			.fpg-container-number-'.$istance.' .fpg-controls.filter-circomassimo ul li.active,
			.fpg-container-number-'.$istance.' .fpg-pagination.circomassimo .current,
			.fpg-container-number-'.$istance.' .fpg-pagination.circomassimo a:hover {
				background:'.$secondary_color.';
			}';
		}
		if($skin == 'fontanaditrevi') {
			$return .= '.fpg-container-number-'.$istance.' .fontanaditrevi .fpg-container-grid .fpg-title {
				background:'.$secondary_color.';
			}
			.fpg-container-number-'.$istance.' .fpg-controls.filter-fontanaditrevi ul li {
				background:'.$secondary_color.';
			}
			.fpg-container-number-'.$istance.' .fpg-pagination.fontanaditrevi span, 
			.fpg-container-number-'.$istance.' .fpg-pagination.fontanaditrevi a {
				background:'.$secondary_color.';	
			}
			.fpg-container-number-'.$istance.' .fpg-pagination.fontanaditrevi span {
				color:'.$over_color.';
			}
			.fpg-container-number-'.$istance.' .fpg-pagination.fontanaditrevi a {
				color:'.$a_color.';	
			}
			.fpg-container-number-'.$istance.' .fpg-pagination.fontanaditrevi a:hover {
				color:'.$over_color.';	
			}';
		}
		if($skin == 'piazzacolonna') {
			$return .= '.fpg-container-number-'.$istance.' .piazzacolonna .fpg-grid-item:hover .fpg-container-grid a {
						color:'.$a_color.';
						background:none!important;
						border:1px solid '.$secondary_color.';
			}';
		}
		if($skin == 'colosseo') {
			$return .= 	'.colosseo .fpg-grid.fpg-'.$istance.' .fpg-grid-item .fpg-container-portfolio a.fpg-read-more:hover {
				border-color:'.$over_color.';
			}
			.fpg-grid.fpg-'.$istance.'.colosseo .fpg-grid-item .fpg-container-portfolio a.fpg-read-more {
				border-color:'.$a_color.';
			}
			.fpg-grid.fpg-'.$istance.'.colosseo .fpg-grid-item:hover .fpg-container-portfolio {
				background:'.$main_color.';
			}
			.fpg-container-number-'.$istance.'.colosseo  .fpg-controls.filter-colosseo  ul li, 
			.fpg-container-number-'.$istance.'.colosseo  .fpg-pagination.colosseo a {
				color:'.$font_color.';
			}
			.fpg-container-number-'.$istance.'.colosseo  .fpg-controls.filter-colosseo  ul li:hover,
			.fpg-container-number-'.$istance.'.colosseo  .fpg-controls.filter-colosseo  ul li.active, 
			.fpg-container-number-'.$istance.'.colosseo  .fpg-pagination.colosseo a:hover {
				color:'.$over_color.';
			}			
			';			
		}		
		if($skin == 'piazzavenezia') {
			$return .= 	'.fpg-grid.fpg-'.$istance.' .fpg-grid-item .fpg-container-portfolio a.fpg-read-more	{
				background:'.$secondary_color.';
			}
			.fpg-grid.fpg-'.$istance.' .fpg-grid-item .fpg-container-portfolio a.fpg-read-more {
				border-color:'.$a_color.';
			}			
			.fpg-grid.fpg-'.$istance.' .fpg-grid-item .fpg-container-portfolio {
				background:'.$secondary_color.';
			}
			.fpg-grid.fpg-'.$istance.' .fpg-grid-item .fpg-container-portfolio a.fpg-read-more:hover {
				color:'.$over_color.';
			}
			.fpg-container-number-'.$istance.' .fpg-controls.filter-piazzavenezia ul li, 
			.fpg-container-number-'.$istance.' .fpg-pagination.piazzavenezia a {
				background:'.$font_color.';
				color:'.$secondary_color.';
			}
			.fpg-container-number-'.$istance.' .fpg-pagination.piazzavenezia .pagination .current {
				background:'.$font_color.';
			}
			.fpg-container-number-'.$istance.' .fpg-controls.filter-piazzavenezia ul li.active, 
			.fpg-container-number-'.$istance.' .fpg-controls.filter-piazzavenezia ul li.filter:hover,
			.fpg-container-number-'.$istance.' .fpg-pagination.piazzavenezia a:hover {
				color:'.$over_color.';	
			}
			.fpg-grid.fpg-'.$istance.' .fpg-grid-item:hover .fpg-container-portfolio {
				background:'.$main_color.';
			}';						
		}
		if($skin == 'sanpietro') {
			$return .= 	'.fpg-grid.fpg-'.$istance.' .fpg-grid-item .fpg-container-portfolio a.fpg-read-more:hover {
				background:'.$secondary_color.';
				border-color:'.$secondary_color.';
				color:'.$font_color.';
			}
			.fpg-container-number-'.$istance.' .fpg-controls.filter-sanpietro ul li,
			.fpg-container-number-'.$istance.' .fpg-controls.filter-sanpietro ul li, 
			.fpg-container-number-'.$istance.' .fpg-pagination.sanpietro a,
			.fpg-container-number-'.$istance.' .fpg-pagination.sanpietro .pagination .current
			 {
				border:1px solid '.$secondary_color.';
				margin-right:10px;
				padding:10px 20px;
				border-radius:12px;
			}
			.fpg-container-number-'.$istance.' .fpg-pagination.sanpietro .pagination a {
				color:'.$secondary_color.';
			}
			.fpg-container-number-'.$istance.' .fpg-pagination.sanpietro .pagination .current,
			.fpg-container-number-'.$istance.' .fpg-pagination.sanpietro a:hover {
				background:'.$secondary_color.';
				color:'.$font_color.';
			}
			.fpg-container-number-'.$istance.' .sanpietro .fpg-container-portfolio .fpg-read-more {
				border:1px solid '.$secondary_color.';
			}
			.fpg-container-number-'.$istance.' .fpg-controls.filter-sanpietro ul li:hover, 
			.fpg-container-number-'.$istance.' .fpg-controls.filter-sanpietro ul li.active,
			.fpg-'.$istance.' .fpg-container-portfolio .fpg-title {
				background:'.$secondary_color.';
				color:'.$font_color.';
			}
			.fpg-grid.fpg-'.$istance.' .fpg-grid-item:hover .fpg-container-portfolio {
				background:'.$main_color.';
			}';			
		}	
		if($skin == 'portamaggiore') {
			$return .= '
			 .fpg-container-number-'.$istance.' .portamaggiore .fpg-grid-item,
			 .fpg-container-number-'.$istance.' .portamaggiore .fpg-image-over .icon-plus,
			 .fpg-controls.filter-portamaggiore ul li {
				background:'.$main_color.';
			}
			.fpg-container-number-'.$istance.' .fpg-controls.filter-portamaggiore ul li:hover, 
			.fpg-container-number-'.$istance.' .fpg-controls.filter-portamaggiore ul li.active {
				background:'.$secondary_color.';
				color:'.$font_color.';
			}
			.fpg-container-number-'.$istance.' .fpg-controls.filter-portamaggiore ul li {
				color:'.$font_color.';
			}
			.fpg-container-number-'.$istance.' .portamaggiore .fpg-container-portfolio .fpg-text {
				border-color:'.$font_color.';
			}
			.fpg-container-number-'.$istance.' .fpg-pagination.portamaggiore .pagination .current,
			.fpg-container-number-'.$istance.' .fpg-pagination.portamaggiore a:hover {
				background:'.$secondary_color.';
			}
			.fpg-container-number-'.$istance.' .fpg-pagination.portamaggiore a {
				background:'.$main_color.';
			}
			.fpg-container-number-'.$istance.' .portamaggiore .fpg-image-over .icon-plus {
				color:'.$a_color.';
			}
			.fpg-container-number-'.$istance.' .portamaggiore .fpg-image-over .icon-plus:hover {
				color:'.$over_color.';
			}
			';
		}
		if($skin == 'piazzadispagna') {
			$return .= '
			 .fpg-container-number-'.$istance.' .piazzadispagna .fpg-grid-item,
			 .fpg-container-number-'.$istance.' .piazzadispagna .fpg-image-over .icon-plus,
			 .fpg-controls.filter-portamaggiore ul li {
				background:'.$main_color.';
			}
			 .fpg-container-number-'.$istance.' .piazzadispagna .fpg-image-over .icon-plus {
			 	color:'.$a_color.';
			}
			 .fpg-container-number-'.$istance.' .piazzadispagna .fpg-image-over .icon-plus:hover {
			 	color:'.$over_color.';
			}
			.fpg-container-number-'.$istance.' .fpg-controls.filter-piazzadispagna ul li {
				background:'.$main_color.';
				color:'.$font_color.';	
			}
			.fpg-container-number-'.$istance.' .fpg-controls.filter-piazzadispagna ul li:hover, 
			.fpg-container-number-'.$istance.' .fpg-controls.filter-piazzadispagna ul li.active {
				color:'.$over_color.';
			}
			.fpg-container-number-'.$istance.' .piazzadispagna .fpg-image-over .icon-plus {
				border-color:'.$font_color.';
			}
			.fpg-container-number-'.$istance.' .fpg-pagination.piazzadispagna .pagination .current,
			.fpg-container-number-'.$istance.' .fpg-pagination.piazzadispagna .pagination a {
				background:'.$main_color.';
				color:'.$font_color.';
			}
			.fpg-container-number-'.$istance.' .fpg-pagination.piazzadispagna a:hover,
			.fpg-container-number-'.$istance.' .fpg-pagination.piazzadispagna .pagination .current {	
				color:'.$over_color.';
			}
			.fpg-container-number-'.$istance.' .fpg-pagination.piazzadispagna a {
				background:'.$main_color.';
			}
			.fpg-container-number-'.$istance.' .piazzadispagna .fpg-grid-item:hover .fpg-image-over {
				background:'.$secondary_color.';
			}
			';			
		}		
		if($skin == 'cappellasistina') {
			$return .= '
			 .fpg-container-number-'.$istance.' .cappellasistina .fpg-grid-item,
			 .fpg-container-number-'.$istance.' .cappellasistina .fpg-image-over .icon-plus,
			 .fpg-controls.filter-cappellasistina ul li {
				background:'.$main_color.';
			}
			.fpg-container-number-'.$istance.' .fpg-controls.filter-piazzadispagna ul li {
				background:'.$main_color.';
				color:'.$font_color.';	
			}
			.fpg-container-number-'.$istance.' .fpg-controls.filter-piazzadispagna ul li:hover, 
			.fpg-container-number-'.$istance.' .fpg-controls.filter-piazzadispagna ul li.active {
				color:'.$over_color.';
			}
			.fpg-container-number-'.$istance.' .cappellasistina .fpg-image-over .icon-plus {
				border-color:'.$font_color.';
			}
			.fpg-container-number-'.$istance.' .fpg-pagination.cappellasistina .pagination .current,
			.fpg-container-number-'.$istance.' .fpg-pagination.cappellasistina .pagination a {
				background:'.$main_color.';
				color:'.$font_color.';
			}
			.fpg-container-number-'.$istance.' .fpg-pagination.cappellasistina a:hover,
			.fpg-container-number-'.$istance.' .fpg-pagination.cappellasistina .pagination .current {	
				color:'.$over_color.';
			}
			.fpg-container-number-'.$istance.' .cappellasistina .fpg-grid-item:hover .fpg-image-over {
				background:'.$secondary_color.';
			}
			.fpg-container-number-'.$istance.' .cappellasistina .fpg-grid-item .fpg-title {
				background:'.$secondary_color.';
				color:'.$main_color.';
			}
			.fpg-container-number-'.$istance.' .cappellasistina .fpg-image-container .fpg-info-date{
				background:'.$secondary_color.';
				color:'.$main_color.';
				font-size:'.$content_fs.';
			}
			.fpg-container-number-'.$istance.' .fpg-pagination.cappellasistina a {
				background:'.$main_color.';
			}
			.fpg-container-number-'.$istance.' .cappellasistina .fpg-grid-item:hover .fpg-image-over {
				background:'.$secondary_color.';
			}
			 .fpg-container-number-'.$istance.' .cappellasistina .fpg-image-over .icon-plus {
			 	color:'.$a_color.';
			}
			 .fpg-container-number-'.$istance.' .cappellasistina .fpg-image-over .icon-plus:hover {
			 	color:'.$over_color.';
			}						
			';
		}
		if($skin == 'piazzanavona') {
			$return .= '
			 .fpg-container-number-'.$istance.' .piazzanavona .fpg-grid-item,
			 .fpg-container-number-'.$istance.' .piazzanavona .fpg-image-over .icon-plus,
			 .fpg-controls.filter-piazzanavona ul li {
				background:'.$main_color.';
			}
			.fpg-container-number-'.$istance.' .fpg-controls.filter-piazzanavona ul li:hover, 
			.fpg-container-number-'.$istance.' .fpg-controls.filter-piazzanavona ul li.active {
				background:'.$secondary_color.';
			}
			.fpg-container-number-'.$istance.' .piazzanavona .fpg-image-over .icon-plus {
				border-color:'.$font_color.';
			}
			.fpg-container-number-'.$istance.' .fpg-pagination.piazzanavona .pagination .current,
			.fpg-container-number-'.$istance.' .fpg-pagination.piazzanavona a:hover {
				background:'.$secondary_color.';
			}
			.fpg-container-number-'.$istance.' .fpg-pagination.piazzanavona a {
				background:'.$main_color.';
			}
			.fpg-container-number-'.$istance.' .piazzanavona .fpg-share-container {
				background:'.$secondary_color.';
			}
			.fpg-container-number-'.$istance.' .piazzanavona .fpg-share-container a {
				color:'.$a_color.';
			}
			.fpg-container-number-'.$istance.' .piazzanavona .fpg-share-container a:hover {
				color:'.$over_color.';
			}						
			';
		}	
		if($skin == 'trastevere') {
			$return .= '.fpg-container-number-'.$istance.'.trastevere .fpg-type-portfolio-preview figure a.fpg-thumbnail h4 {
				color:'.$font_color.';
				background:'.$secondary_color.';
			}
			.fpg-container-number-'.$istance.'.trastevere .fpg-type-portfolio-preview figure.content {
				background:'.$main_color.';
			}
			.fpg-container-number-'.$istance.'.trastevere .fpg-type-portfolio-preview .post-content {
				color:'.$font_color.';
			}
			.fpg-container-number-'.$istance.'.trastevere .fpg-type-portfolio-preview.trastevere .social-container .icon-menu2, 
			.fpg-container-number-'.$istance.'.trastevere .fpg-type-portfolio-preview.trastevere .social-container .icon-close,
			.fpg-container-number-'.$istance.'.trastevere .fpg-type-portfolio-preview figure .fcp-read-more,
			.fpg-container-number-'.$istance.'.trastevere .fpg-type-portfolio-preview .social-container .fpg-share-container .fpg-share-item {
				background:'.$font_color.';
				color:'.$main_color.';
			}
			.fpg-container-number-'.$istance.'.trastevere .fpg-type-portfolio-preview.trastevere .social-container .icon-menu2:hover, 
			.fpg-container-number-'.$istance.'.trastevere .fpg-type-portfolio-preview.trastevere .social-container .icon-close:hover,
			.fpg-container-number-'.$istance.'.trastevere .fpg-type-portfolio-preview .social-container .fpg-share-container .fpg-share-item:hover {
				color:'.$over_color.';
			}			
			.fpg-container-number-'.$istance.'.trastevere .fpg-type-portfolio-preview figure.content .close {
				color:'.$font_color.';
			}
			.fpg-container-number-'.$istance.'.trastevere .fpg-type-portfolio-preview figure a.fpg-thumbnail .active-arrow {
				border-bottom-color:'.$main_color.';
			}
			.fpg-container-number-'.$istance.'.trastevere .fpg-type-portfolio-preview figure.content {
				border-right-color:'.$main_color.';
				border-left-color:'.$main_color.';
				border-bottom-color:'.$main_color.';
			}
			.fpg-container-number-'.$istance.'.trastevere .fpg-type-portfolio-preview figure a.fpg-thumbnail h4 {
				border-right-color:'.$font_color.';
				border-left-color:'.$font_color.';
				border-bottom-color:'.$font_color.';
			}
			.fpg-container-number-'.$istance.'.trastevere .fpg-type-portfolio-preview .social-container .fpg-share-container .fpg-share-item a {
				color:'.$main_color.';
			}
			.fpg-container-number-'.$istance.'.trastevere .fpg-type-portfolio-preview .social-container .fpg-share-container .fpg-share-item a:hover {
				color:'.$over_color.';
			}			
			.fpg-container-number-'.$istance.'.trastevere .fpg-pagination a,
			.fpg-container-number-'.$istance.'.trastevere a {
				color:'.$a_color.';
			}
			.fpg-container-number-'.$istance.'.trastevere .fpg-pagination a:hover,
			.fpg-container-number-'.$istance.'.trastevere a:hover,
			.fpg-container-number-'.$istance.'.trastevere .fpg-type-portfolio-preview figure .fcp-read-more:hover {
				color:'.$over_color.';
			}			
			.fpg-container-number-'.$istance.'.trastevere .fpg-pagination .current {
				color:'.$over_color.';
			}
			.fpg-container-number-'.$istance.'.trastevere .fpg-type-portfolio-preview .post-content h1{
				font-size:'.$title_fs.'px;
			}
			.fpg-container-number-'.$istance.'.trastevere .fpg-type-portfolio-preview .post-content {
				font-size:'.$content_fs.'px;
			}
			.fpg-container-number-'.$istance.'.trastevere figure.content {
				margin-bottom:'.$margin_bottom.';
				margin-top:-'.$margin_bottom.';	
			}	
			.fpg-container-number-'.$istance.'.trastevere .fpg-type-portfolio-preview figure.content {
				max-width: -webkit-calc(100% - '.$margin_right.');
				max-width:         calc(100% - '.$margin_right.');
			}
			';
		}
		if($skin == 'mausoleodiaugusto') {
			$return .= '.fpg-container-number-'.$istance.'.mausoleodiaugusto .fpg-type-portfolio-preview figure a.fpg-thumbnail h4 {
				color:'.$font_color.';
				background:'.$secondary_color.';
			}
			.fpg-container-number-'.$istance.'.mausoleodiaugusto .fpg-type-portfolio-preview figure.content {
				background:'.$main_color.';
			}
			.fpg-container-number-'.$istance.'.mausoleodiaugusto .fpg-type-portfolio-preview .post-content {
				color:'.$font_color.';
			}
			.fpg-container-number-'.$istance.'.mausoleodiaugusto .fpg-type-portfolio-preview.mausoleodiaugusto .social-container .icon-menu2, 
			.fpg-container-number-'.$istance.'.mausoleodiaugusto .fpg-type-portfolio-preview.mausoleodiaugusto .social-container .icon-close,
			.fpg-container-number-'.$istance.'.mausoleodiaugusto .fpg-type-portfolio-preview figure .fcp-read-more,
			.fpg-container-number-'.$istance.'.mausoleodiaugusto .fpg-type-portfolio-preview .social-container .fpg-share-container .fpg-share-item {
				background:'.$font_color.';
				color:'.$main_color.';
			}
			.fpg-container-number-'.$istance.'.mausoleodiaugusto .fpg-type-portfolio-preview.mausoleodiaugusto .social-container .icon-menu2:hover, 
			.fpg-container-number-'.$istance.'.mausoleodiaugusto .fpg-type-portfolio-preview.mausoleodiaugusto .social-container .icon-close:hover,
			.fpg-container-number-'.$istance.'.mausoleodiaugusto .fpg-type-portfolio-preview .social-container .fpg-share-container .fpg-share-item:hover {
				color:'.$over_color.';
			}			
			.fpg-container-number-'.$istance.'.mausoleodiaugusto .fpg-type-portfolio-preview figure.content .close {
				color:'.$font_color.';
			}
			.fpg-container-number-'.$istance.'.mausoleodiaugusto .fpg-type-portfolio-preview figure a.fpg-thumbnail .active-arrow {
				border-bottom-color:'.$main_color.';
			}
			.fpg-container-number-'.$istance.'.mausoleodiaugusto .fpg-type-portfolio-preview figure.content {
				border-right-color:'.$main_color.';
				border-left-color:'.$main_color.';
				border-bottom-color:'.$main_color.';
			}
			.fpg-container-number-'.$istance.'.mausoleodiaugusto .fpg-type-portfolio-preview figure a.fpg-thumbnail h4 {
				border-right-color:'.$font_color.';
				border-left-color:'.$font_color.';
				border-bottom-color:'.$font_color.';
			}
			.fpg-container-number-'.$istance.'.mausoleodiaugusto .fpg-type-portfolio-preview .social-container .fpg-share-container .fpg-share-item a {
				color:'.$main_color.';
			}
			.fpg-container-number-'.$istance.'.mausoleodiaugusto .fpg-type-portfolio-preview .social-container .fpg-share-container .fpg-share-item a:hover {
				color:'.$over_color.';
			}			
			.fpg-container-number-'.$istance.'.mausoleodiaugusto .fpg-pagination a,
			.fpg-container-number-'.$istance.'.mausoleodiaugusto a {
				color:'.$a_color.';
			}
			.fpg-container-number-'.$istance.'.mausoleodiaugusto .fpg-pagination a:hover,
			.fpg-container-number-'.$istance.'.mausoleodiaugusto a:hover,
			.fpg-container-number-'.$istance.'.mausoleodiaugusto .fpg-type-portfolio-preview figure .fcp-read-more:hover {
				color:'.$over_color.';
			}			
			.fpg-container-number-'.$istance.'.mausoleodiaugusto .fpg-pagination .current {
				color:'.$over_color.';
			}
			.fpg-container-number-'.$istance.'.mausoleodiaugusto .fpg-type-portfolio-preview .post-content h1{
				font-size:'.$title_fs.'px;
			}
			.fpg-container-number-'.$istance.'.mausoleodiaugusto .fpg-type-portfolio-preview .post-content {
				font-size:'.$content_fs.'px;
			}
			.fpg-container-number-'.$istance.'.mausoleodiaugusto figure.content {
				margin-bottom:'.$margin_bottom.';
				margin-top:-'.$margin_bottom.';	
			}	
			.fpg-container-number-'.$istance.'.mausoleodiaugusto .fpg-type-portfolio-preview figure.content {
				max-width: -webkit-calc(100% - '.$margin_right.');
				max-width:         calc(100% - '.$margin_right.');
			}
			';
		}
		if($skin == 'campidoglio') {
			$return .= '.fpg-container-number-'.$istance.'.campidoglio .fpg-grid-item .ac-container {
				background:'.$main_color.';	
			}
			.fpg-container-number-'.$istance.'.campidoglio .fpg-grid-item .title {
				color:'.$font_color.';
			}			
			.fpg-container-number-'.$istance.'.campidoglio .fpg-grid-item .ac-icon a,
			.fpg-container-number-'.$istance.'.campidoglio .owl-theme .owl-controls .owl-dots  span {
				border-color:'.$secondary_color.';
			}
			.fpg-container-number-'.$istance.'.campidoglio .fpg-grid-item .ac-icon a {
				color:'.$a_color.';
			}
			.fpg-container-number-'.$istance.'.campidoglio .fpg-grid-item .ac-icon a:hover {
				color:'.$over_color.';
				border-color:'.$over_color.';
			}
			.fpg-container-number-'.$istance.'.campidoglio .owl-next,
			.fpg-container-number-'.$istance.'.campidoglio .owl-prev {
				color:'.$font_color.'!important;
			}
			.fpg-container-number-'.$istance.'.campidoglio .owl-next:hover,
			.fpg-container-number-'.$istance.'.campidoglio .owl-prev:hover {
				color:'.$over_color.';
			}			
			';				
		}
		if($skin == 'quirinale') {
			$return .= '.fpg-container-number-'.$istance.'.quirinale .fpg-grid-item .ac-container {
				background:'.$main_color.';	
			}
			.fpg-container-number-'.$istance.'.quirinale .fpg-grid-item .title {
				color:'.$font_color.';
			}
			.fpg-container-number-'.$istance.'.quirinale .fpg-grid-item .ac-icon a,
			.fpg-container-number-'.$istance.'.quirinale .owl-theme .owl-controls .owl-dots  span {
				border-color:'.$secondary_color.';
			}
			.fpg-container-number-'.$istance.'.quirinale .fpg-grid-item .ac-icon a {
				color:'.$a_color.';
			}
			.fpg-container-number-'.$istance.'.quirinale .fpg-grid-item .ac-icon a:hover {
				color:'.$over_color.';
			}
			.fpg-container-number-'.$istance.'.quirinale .owl-next,
			.fpg-container-number-'.$istance.'.quirinale .owl-prev {
				color:'.$font_color.'!important;
			}
			.fpg-container-number-'.$istance.'.quirinale .owl-next:hover,
			.fpg-container-number-'.$istance.'.quirinale .owl-prev:hover {
				color:'.$over_color.';
			}			
			';				
		}
		if($skin == 'arcodicostantino') {
			$return .= '.fpg-container-number-'.$istance.'.arcodicostantino .fpg-grid-item .ac-container {
				background:'.$main_color.';	
			}
			.fpg-container-number-'.$istance.'.arcodicostantino .fpg-grid-item .title {
				color:'.$font_color.';
			}
			.fpg-container-number-'.$istance.'.arcodicostantino .fpg-grid-item .ac-icon a,
			.fpg-container-number-'.$istance.'.arcodicostantino .owl-theme .owl-controls .owl-dots  span {
				border-color:'.$secondary_color.';
			}
			.fpg-container-number-'.$istance.'.arcodicostantino .fpg-grid-item .ac-icon a {
				color:'.$a_color.';
			}
			.fpg-container-number-'.$istance.'.arcodicostantino .fpg-grid-item .ac-icon a:hover {
				color:'.$over_color.';
			}
			.fpg-container-number-'.$istance.'.arcodicostantino .owl-next,
			.fpg-container-number-'.$istance.'.arcodicostantino .owl-prev {
				color:'.$font_color.'!important;
			}
			.fpg-container-number-'.$istance.'.arcodicostantino .owl-next:hover,
			.fpg-container-number-'.$istance.'.arcodicostantino .owl-prev:hover {
				color:'.$over_color.';
			}			
			';				
		}
		if($skin == 'santamariamaggiore') {
			$return .= '.fpg-container-number-'.$istance.'.santamariamaggiore .fpg-grid-item .ac-container {
				background:'.$main_color.';	
			}
			.fpg-container-number-'.$istance.'.santamariamaggiore .fpg-grid-item .title {
				color:'.$font_color.';
			}
			.fpg-container-number-'.$istance.'.santamariamaggiore .fpg-grid-item .ac-icon a,
			.fpg-container-number-'.$istance.'.santamariamaggiore .owl-theme .owl-controls .owl-dots  span {
				border-color:'.$secondary_color.';
			}
			.fpg-container-number-'.$istance.'.santamariamaggiore .fpg-grid-item .ac-icon a {
				color:'.$a_color.';
			}
			.fpg-container-number-'.$istance.'.santamariamaggiore .fpg-grid-item .ac-icon a:hover {
				color:'.$over_color.';
			}
			.fpg-container-number-'.$istance.'.santamariamaggiore .owl-next,
			.fpg-container-number-'.$istance.'.santamariamaggiore .owl-prev {
				color:'.$font_color.'!important;
			}
			.fpg-container-number-'.$istance.'.santamariamaggiore .owl-next:hover,
			.fpg-container-number-'.$istance.'.santamariamaggiore .owl-prev:hover {
				color:'.$over_color.';
			}			
			';				
		}
		if($skin == 'sangiovanni') {
			$return .= '.fpg-container-number-'.$istance.'.sangiovanni .fpg-grid-item .ac-container {
				background:'.$main_color.';	
			}
			.fpg-container-number-'.$istance.'.sangiovanni .fpg-grid-item .title {
				color:'.$font_color.';
			}
			.fpg-container-number-'.$istance.'.sangiovanni .fpg-grid-item .ac-icon a,
			.fpg-container-number-'.$istance.'.sangiovanni .owl-theme .owl-controls .owl-dots  span {
				border-color:'.$secondary_color.';
			}
			.fpg-container-number-'.$istance.'.sangiovanni .fpg-grid-item .ac-icon a {
				color:'.$a_color.';
			}
			.fpg-container-number-'.$istance.'.sangiovanni .fpg-grid-item .ac-icon a:hover {
				color:'.$over_color.';
				border-color:'.$over_color.';
			}
			.fpg-container-number-'.$istance.'.sangiovanni .owl-next,
			.fpg-container-number-'.$istance.'.sangiovanni .owl-prev {
				color:'.$font_color.'!important;
			}
			.fpg-container-number-'.$istance.'.sangiovanni .owl-next:hover,
			.fpg-container-number-'.$istance.'.sangiovanni .owl-prev:hover {
				color:'.$over_color.';
			}
			.fpg-container-number-'.$istance.'.sangiovanni .fpg-grid-item .text {
				font-size:'.$content_fs.'px;
			}
			';				
		}
		if($skin == 'catacombedidomitilla') {
			$return .= '.fpg-container-number-'.$istance.'.catacombedidomitilla .fpg-grid-item .ac-container {
				background:'.$main_color.';	
			}
			.fpg-container-number-'.$istance.'.catacombedidomitilla .fpg-grid-item .title {
				color:'.$font_color.';
			}
			.fpg-container-number-'.$istance.'.catacombedidomitilla .fpg-grid-item .ac-icon a,
			.fpg-container-number-'.$istance.'.catacombedidomitilla .owl-theme .owl-controls .owl-dots  span {
				border-color:'.$secondary_color.';
			}
			.fpg-container-number-'.$istance.'.catacombedidomitilla .fpg-grid-item .ac-icon a {
				color:'.$a_color.';
			}
			.fpg-container-number-'.$istance.'.catacombedidomitilla .fpg-grid-item .ac-icon a:hover {
				background:'.$over_color.';
			}
			.fpg-container-number-'.$istance.'.catacombedidomitilla .owl-next,
			.fpg-container-number-'.$istance.'.catacombedidomitilla .owl-prev {
				color:'.$font_color.'!important;
			}
			.fpg-container-number-'.$istance.'.catacombedidomitilla .owl-next:hover,
			.fpg-container-number-'.$istance.'.catacombedidomitilla .owl-prev:hover {
				color:'.$over_color.';
			}
			.fpg-container-number-'.$istance.'.catacombedidomitilla .fpg-grid-item .text {
				font-size:'.$content_fs.'px;
			}
			.fpg-container-number-'.$istance.'.catacombedidomitilla .fpg-grid-item .container-top .hover-img .icon-plus {
				border-color:'.$main_color.';
				background:'.$secondary_color.';
			}
			.fpg-container-number-'.$istance.'.catacombedidomitilla .fpg-grid-item .container-top .hover-img {
				background:'.$secondary_color.';
			}
			';				
		}
		if($skin == 'villaadriana') {
			$return .= '.fpg-container-number-'.$istance.'.villaadriana .fpg-grid-item .title {
				color:'.$font_color.';
			}
			.fpg-container-number-'.$istance.'.villaadriana .fpg-grid-item .ac-icon a,
			.fpg-container-number-'.$istance.'.villaadriana .owl-theme .owl-controls .owl-dots  span {
				border-color:'.$secondary_color.';
			}
			.fpg-container-number-'.$istance.'.villaadriana .fpg-grid-item .ac-icon a {
				color:'.$a_color.';
			}
			.fpg-container-number-'.$istance.'.villaadriana .fpg-grid-item .ac-icon a:hover,
			.fpg-container-number-'.$istance.'.villaadriana .fpg-grid-item .ac-icon a {
				background:'.$over_color.';
			}
			.fpg-container-number-'.$istance.'.villaadriana .owl-next,
			.fpg-container-number-'.$istance.'.villaadriana .owl-prev {
				color:'.$font_color.'!important;
			}
			.fpg-container-number-'.$istance.'.villaadriana .owl-next:hover,
			.fpg-container-number-'.$istance.'.villaadriana .owl-prev:hover {
				color:'.$over_color.';
			}
			.fpg-container-number-'.$istance.'.villaadriana .fpg-grid-item .text {
				font-size:'.$content_fs.'px;
			}
			.fpg-container-number-'.$istance.'.villaadriana .fpg-grid-item .container-top .hover-img .icon-plus {
				border-color:'.$main_color.';
				background:'.$secondary_color.';
			}
			.fpg-container-number-'.$istance.'.villaadriana .fpg-grid-item .container-top .hover-img {
				background:'.$secondary_color.';
			}
			';				
		}	
		if($skin == 'palatino') {
			$return .= '.fpg-container-number-'.$istance.'.palatino .fpg-grid-item .title,
			.fpg-container-number-'.$istance.'.palatino .fpg-grid-item .text 
			 {
				color:'.$font_color.';
			}
			.fpg-container-number-'.$istance.'.palatino .fpg-grid-item .ac-icon a,
			.fpg-container-number-'.$istance.'.palatino .owl-theme .owl-controls .owl-dots  span {
				border-color:'.$secondary_color.';
			}
			.fpg-container-number-'.$istance.'.palatino .fpg-grid-item .ac-icon a {
				border-color:'.$a_color.';
				color:'.$a_color.';
			}
			.fpg-container-number-'.$istance.'.palatino .fpg-grid-item .ac-icon a:hover {
				border-color:'.$over_color.';
				color:'.$over_color.';				
			}
			.fpg-container-number-'.$istance.'.palatino .owl-next,
			.fpg-container-number-'.$istance.'.palatino .owl-prev {
				color:'.$font_color.'!important;
			}
			.fpg-container-number-'.$istance.'.palatino .owl-next:hover,
			.fpg-container-number-'.$istance.'.palatino .owl-prev:hover {
				color:'.$over_color.';
			}
			.fpg-container-number-'.$istance.'.palatino .fpg-grid-item .text {
				font-size:'.$content_fs.'px;
			}
			.fpg-container-number-'.$istance.'.palatino .fpg-grid-item .title {
				font-size:'.$title_fs.'px;
			}
			';				
		}															
	return $return;
}

function ewmp_filter_item($skin,$istance,$source,$wp_cat,$wp_fc_cat,$wp_custom_taxonomy_cat,$custom_type) {


		$return = '<div class="fpg-controls filter-'.$skin.'">
					<ul>
						<li data-filter="all" class="filter active">'.esc_html__('All','elementorwidgetsmegapack').'</li>';
			
		/* WP POST */
		if($source == 'wp_posts') {
			// ALL CATEGORY
			if(empty($wp_cat)) {
						$categories = get_categories();
						foreach ( $categories as $category ) {
								$return .= '<li data-filter="' . $category->slug . '" class="filter">' . $category->name . '</li>';
						}
			} else { 
						$wp_cat = explode(",", $wp_cat);
						//print_r($wp_cat);
						foreach ( $wp_cat as $category ) {
								$category_name = get_category_by_slug($category);
								$return .= '<li data-filter="' . $category . '" class="filter">' . $category_name->name . '</li>';
						}
			}
		}
		/* #WP POST */	

		/* WP CUSTOM POST */
		if($source == 'post_type') {
			// ALL CATEGORY
			$taxonomy_names = get_object_taxonomies( $custom_type );
			
			// CHECK WOOCOMMERCE
			if($custom_type == 'product' && class_exists('Woocommerce')) {
					$taxonomy_names[0]= 'product_cat';
			}
			// #CHECK WOOCOMMERCE
			 
			if(!empty($taxonomy_names)) {
				if(empty($wp_custom_taxonomy_cat)) {
							$categories = get_categories('taxonomy='.$taxonomy_names[0].'');
	
							foreach ( $categories as $category ) {
									$return .= '<li data-filter="' . $category->slug . '" class="filter">' . $category->name . '</li>';
							}
				} else {
						$wp_custom_taxonomy_cat_split = explode(",", $wp_custom_taxonomy_cat);
							foreach ( $wp_custom_taxonomy_cat_split as $category ) {
									$category_single = get_term_by('name',$category,$taxonomy_names[0]);								
									$return .= '<li data-filter="' . $category_single->slug . '" class="filter">' . $category . '</li>';
							}
				}
			}
		}
		/* #WP CUSTOM POST */		
		
		
		
		
		
		$return .= '</ul></div>';
		
		
	return $return;
}

function ewmp_filter_item_figure($source,$wp_cat,$wp_fc_cat,$wp_custom_taxonomy_cat,$custom_type) {

	/* WP POST */
	if($source == 'wp_posts') {
		if(empty($wp_cat)) {
			$category = get_the_category();
			$return = '<figure data-cat="'.$category[0]->slug.'" class="fpg-grid-item '.$category[0]->slug.'" style=" display: inline-block; opacity: 1;">';
		} else {
			$cat_array = get_the_category();
			$cat_list = '';
			$cat_list2 = array();
				foreach ( $cat_array as $category ) {
						$cat_list .= $category->slug.' ';
						$cat_list2[] = $category->name;
				}
			$return = '<figure data-cat="'.$cat_list.'" class="fpg-grid-item '.$cat_list.'" style=" display: inline-block; opacity: 1;">';				
		}
	}
	/* #WP POST */

	/* WP CUSTOM POST */
	if($source == 'post_type') {
					$taxonomy_names = get_object_taxonomies( $custom_type );
					
					// CHECK WOOCOMMERCE
					if($custom_type == 'product' && class_exists('Woocommerce')) {
						$taxonomy_names[0]= 'product_cat';
					}
					// #CHECK WOOCOMMERCE 
						
					if(!empty($taxonomy_names)) {					
						$cat_array = wp_get_post_terms( get_the_ID(), $taxonomy_names[0]);
						$cat_list = '';
						$cat_list2 = array();
						foreach ( $cat_array as $category ) {
							$cat_list .= $category->slug.' ';
							$cat_list2[] = $category->name;
						}
						$return = '<figure data-cat="'.$cat_list.'" class="fpg-grid-item '.$cat_list.'" style=" display: inline-block; opacity: 1;">';								
					} else {
						$return = '<figure class="fpg-grid-item" style=" display: inline-block; opacity: 1;">';
					}
	}	
	/* #WP CUSTOM POST */

	
	return $return;	
}

// HEX FUNCTION
function ewmp_elementor_hex2rgb($hex) {

   $hex = str_replace("#", "", $hex);

if(strlen($hex) == 3) {
		$r = hexdec(substr($hex,0,1).substr($hex,0,1));
		$g = hexdec(substr($hex,1,1).substr($hex,1,1));
		$b = hexdec(substr($hex,2,1).substr($hex,2,1));
	} else {
		$r = hexdec(substr($hex,0,2));
		$g = hexdec(substr($hex,2,2));
		$b = hexdec(substr($hex,4,2));
	}
	$rgb = array($r, $g, $b);
	return $rgb;
}

function ewmp_elementor_photoswipe_style($rgba_main_color,
						  $fg_main_color,
						  $fg_secondary_color,
						  $rgba_secondary_color,
						  $fg_pagination_active,
						  $fg_spacing_active, 
						  $fg_spacing, 
						  $fg_image_lightbox, 
						  $selector, 
						  $fg_gallery_name_font_size, 
						  $fg_gallery_name_font_color, 
						  $fg_gallery_name_text_align,
						  $float,
						  $itemwidth,
						  $fg_gallery_name_show
						  ) {
							  
							  
				$gallery_style = "
				<style type='text/css'>
					#{$selector} {
					margin: auto;
					}
					#{$selector} .fg-gallery-item {
					float: {$float};
					margin-top: 10px;
					text-align: center;
					width: {$itemwidth}%;
					}
					#{$selector} .fg-gallery-caption {
					margin-left: 0;
					}
					#{$selector}.fastcarousel .fg-gallery-caption, 
					#{$selector}.fastcarousel .fg-gallery-caption:hover {
						background-color:".$rgba_main_color.";
					}
					#{$selector}.fastcarousel.gallery .fastcarousel-gallery-icon.fg_zoom a, 
					#{$selector}.fastcarousel.gallery .fastcarousel-gallery-icon.fg_zoom a:hover {
						color:".$fg_main_color.";
					}
					#{$selector}.fastcarousel.fg_style1 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}
					#{$selector}.fastcarousel.gallery.fg_style2 .fastcarousel-gallery-icon.fg_zoom a {
						background:".$rgba_secondary_color.";
					}
					#{$selector}.fastcarousel.fg_style2 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}			
					#{$selector}.fastcarousel.gallery.fg_style3 .fg_zoom, 
					#{$selector}.fastcarousel.gallery.fg_style3 .fg_zoom:hover {
						background:".$rgba_main_color.";
					}
					#{$selector}.fastcarousel.fg_style3 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}				
					#{$selector}.fastcarousel.fg_style4 .fg-gallery-caption,			
					#{$selector}.fastcarousel.gallery.fg_style4 .fastcarousel-gallery-icon.fg_zoom a, 
					#{$selector}.fastcarousel.gallery.fg_style4 .fastcarousel-gallery-icon.fg_zoom a:hover {
						color:".$fg_secondary_color.";
					}
					#{$selector}.fastcarousel.gallery.fg_style4 .fastcarousel-gallery-icon.fg_zoom a, 
					#{$selector}.fastcarousel.gallery.fg_style4 .fastcarousel-gallery-icon.fg_zoom a:hover,
					#{$selector}.fastcarousel.gallery.fg_style4 .fg-photoswipe .fastcarousel-mask	{
						background:".$rgba_main_color.";
					}			
					#{$selector}.fastcarousel.gallery.fg_style5 .fastcarousel-gallery-icon.fg_zoom a, 
					#{$selector}.fastcarousel.gallery.fg_style5 .fastcarousel-gallery-icon.fg_zoom a:hover {
						color:".$fg_secondary_color.";
					}
					#{$selector}.fastcarousel.gallery.fg_style5 .fg-photoswipe .fastcarousel-mask	{
						background-color:".$rgba_main_color.";
					}											
					#{$selector}.fastcarousel.gallery.fg_style6 .fastcarousel-gallery-icon.fg_zoom a,
					#{$selector}.fastcarousel.gallery.fg_style6 .fastcarousel-gallery-icon.fg_zoom a:hover {
						color:".$fg_secondary_color.";
						background:".$rgba_main_color.";				
					}
					#{$selector}.fastcarousel.gallery.fg_style6 .fg-photoswipe .fastcarousel-mask	{
						background:".$rgba_main_color.";
					}				
					#{$selector}.fastcarousel.fg_style6 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}
					#{$selector}.fastcarousel.gallery.fg_style7 .fastcarousel-gallery-icon.fg_zoom a,
					#{$selector}.fastcarousel.gallery.fg_style7 .fastcarousel-gallery-icon.fg_zoom a:hover {
						color:".$fg_secondary_color.";
						background:".$rgba_main_color.";				
					}
					#{$selector}.fastcarousel.gallery.fg_style7 .fg-photoswipe .fastcarousel-mask	{
						background:".$rgba_main_color.";
					}		
					#{$selector}.fastcarousel.fg_style7 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}
					
					#{$selector}.fastcarousel.gallery.fg_style8 .fastcarousel-gallery-icon.fg_zoom a,
					#{$selector}.fastcarousel.gallery.fg_style8 .fastcarousel-gallery-icon.fg_zoom a:hover {
						color:".$fg_secondary_color.";
						background:".$rgba_main_color.";				
					}

					#{$selector}.fastcarousel.gallery.fg_style8 .fg-photoswipe .fastcarousel-mask	{
						background:".$rgba_main_color.";
					}	
				
					#{$selector}.fastcarousel.fg_style8 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}
					
					#{$selector}.fastcarousel.gallery.fg_style9 .fastcarousel-gallery-icon.fg_zoom a,
					#{$selector}.fastcarousel.gallery.fg_style9 .fastcarousel-gallery-icon.fg_zoom a:hover {
						color:".$fg_secondary_color.";				
					}
					#{$selector}.fastcarousel.gallery.fg_style9 .fg-photoswipe .fastcarousel-mask	{
						background:".$rgba_main_color.";
					}							
					#{$selector}.fastcarousel.fg_style9 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}
					
					#{$selector}.fastcarousel.gallery.fg_style10 .fastcarousel-gallery-icon.fg_zoom a,
					#{$selector}.fastcarousel.gallery.fg_style10 .fastcarousel-gallery-icon.fg_zoom a:hover {
						color:".$fg_secondary_color.";
						background:".$rgba_main_color.";				
					}
					#{$selector}.fastcarousel.gallery.fg_style10 .fg-photoswipe .fastcarousel-mask	{
						background:".$rgba_main_color.";
					}							
					#{$selector}.fastcarousel.fg_style10 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}
					#{$selector}.fastcarousel.fg_style11 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}
					#{$selector}.fastcarousel.fg_style11 .fastcarousel-gallery-icon.fg_zoom a, 
					#{$selector}.fastcarousel.fg_style11 .fastcarousel-gallery-icon.fg_zoom a:hover {
						color:".$fg_main_color.";
						background:".$rgba_secondary_color.";
					}
					#{$selector}.fastcarousel.fg_style12 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}
					#{$selector}.fastcarousel.fg_style12 .fastcarousel-gallery-icon.fg_zoom a, 
					#{$selector}.fastcarousel.fg_style12 .fastcarousel-gallery-icon.fg_zoom a:hover {
						color:".$fg_main_color.";
						background:".$rgba_secondary_color.";
					}																									
					/* THUMBS ONE ON */
					#{$selector}.fastcarousel.fg_thumbs_one .fg-gallery-item {
						display:none;
					}
					#{$selector}.fastcarousel.fg_thumbs_one .fg-gallery-item:first-child {
						display:block;
					}
					#{$selector}.fastcarousel.fg_thumbs_one {
						width:auto!important;
					}
				";
				
				if($fg_pagination_active == 'on') {
					$gallery_style .= "
						#{$selector}.fastcarousel.fg_pagination_style1 ul.fg_pagination li a {
							background:".$rgba_main_color.";
							color:".$fg_secondary_color.";
						}
						#{$selector}.fastcarousel.fg_pagination_style1 ul.fg_pagination li a:hover {
							background:".$fg_secondary_color.";
							color:".$rgba_main_color.";
						}
						#{$selector}.fastcarousel.fg_pagination_style1 ul.fg_pagination li.fg_current {
							background:".$fg_secondary_color.";
							color:".$rgba_main_color.";
						}
						#{$selector}.fastcarousel.fg_pagination_style2 ul.fg_pagination li a {
							color:".$fg_secondary_color.";
						}
						#{$selector}.fastcarousel.fg_pagination_style2 ul.fg_pagination li a:hover {
							color:".$rgba_main_color.";
						}
						#{$selector}.fastcarousel.fg_pagination_style2 ul.fg_pagination li.fg_current {
							color:".$rgba_main_color.";
						}																		
					";
				}
				
				
				
				
				if($fg_spacing_active == 'on') {
					$gallery_style .= "
						.fastcarousel.gallery {
							width:100%;
							width: -webkit-calc(100% + ".$fg_spacing."px);
							width: calc(100% + ".$fg_spacing."px);
							/*margin-left:".$fg_spacing."px;*/
						}
						.fastcarousel .fg-gallery-item {
							margin-right:".$fg_spacing."px!important;
							margin-bottom:".$fg_spacing."px!important;
						}
						.fastcarousel.gallery-columns-2 .fg-gallery-item {
							max-width: 48%;
							max-width: -webkit-calc(50% - ".$fg_spacing."px);
							max-width:         calc(50% - ".$fg_spacing."px);
						}
						
						.fastcarousel.gallery-columns-3 .fg-gallery-item {
							max-width: 32%;
							max-width: -webkit-calc(33.3% - ".$fg_spacing."px);
							max-width:         calc(33.3% - ".$fg_spacing."px);
						}
						
						.fastcarousel.gallery-columns-4 .fg-gallery-item {
							max-width: 23%;
							max-width: -webkit-calc(25% - ".$fg_spacing."px);
							max-width:         calc(25% - ".$fg_spacing."px);
						}
						
						.fastcarousel.gallery-columns-5 .fg-gallery-item {
							max-width: 19%;
							max-width: -webkit-calc(20% - ".$fg_spacing."px);
							max-width:         calc(20% - ".$fg_spacing."px);
						}
						
						.fastcarousel.gallery-columns-6 .fg-gallery-item {
							max-width: 15%;
							max-width: -webkit-calc(16.7% - ".$fg_spacing."px);
							max-width:         calc(16.7% - ".$fg_spacing."px);
						}
						
						.fastcarousel.gallery-columns-7 .fg-gallery-item {
							max-width: 13%;
							max-width: -webkit-calc(14.28% - ".$fg_spacing."px);
							max-width:         calc(14.28% - ".$fg_spacing."px);
						}
						
						.fastcarousel.gallery-columns-8 .fg-gallery-item {
							max-width: 11%;
							max-width: -webkit-calc(12.5% - ".$fg_spacing."px);
							max-width:         calc(12.5% - ".$fg_spacing."px);
						}
						
						.fastcarousel.gallery-columns-9 .fg-gallery-item {
							max-width: 9%;
							max-width: -webkit-calc(11.1% - ".$fg_spacing."px);
							max-width:         calc(11.1% - ".$fg_spacing."px);
						}
					";
				}

				if($fg_image_lightbox == 'zoomin') {
					$gallery_style .= '#'.$selector.'.fastcarousel .icon-plus:before {	
										content: "\e6ef"!important;
					}';
				}
				if($fg_image_lightbox == 'image') {
					$gallery_style .= '#'.$selector.'.fastcarousel .icon-plus:before {	
										content: "\e687"!important;
					}';
				}	
				if($fg_image_lightbox == 'images') {
					$gallery_style .= '#'.$selector.'.fastcarousel .icon-plus:before {	
										content: "\e605"!important;
					}';
				}	
				if($fg_image_lightbox == 'spinner_icon') {
					$gallery_style .= '#'.$selector.'.fastcarousel .icon-plus:before {	
										content: "\e6e7"!important;
					}';
				}
				if($fg_image_lightbox == 'search_icon') {
					$gallery_style .= '#'.$selector.'.fastcarousel .icon-plus:before {	
										content: "\e6ee"!important;
					}';
				}				
				
				if($fg_gallery_name_show == 'true') {
					$gallery_style .= ".fg_gallery_title-{$instance}.fg_gallery_name {
							font-size:".$fg_gallery_name_font_size."px;
							color:".$fg_gallery_name_font_color.";
							text-align:".$fg_gallery_name_text_align.";
					}";
				}
				
				$gallery_style .= "</style>";								  
							  
							  
				return $gallery_style;				  
							  
}

// PAGINATION FUNCTION //
function ewmp_elementor_pagination($num_page_for_pagination,$pagination) {
	$output = '<ul class="fg_pagination">';
	for($i=1; $i <= $num_page_for_pagination; $i++) {
		
		if($i == $pagination) {
			$output .= '<li class="fg_current">'.$i.'</li>'; // CURRENT PAGE
		} else {
			$output .= '<li><a href="'.get_post_permalink().'&fg_page='.$i.'">'.$i.'</a></li>'; // OTHER PAGE
		}
	}
	$output .= '</ul>';
	return $output;
}

function ewmp_fastmediagallery_elementor_enqueue_css_and_javascript($type,$layout,$responsive_type,$lazyload,$active_custom_responsive,$fg_animate) {
	
		// LOAD GENERAL CSS AND JAVASCRIPT
		wp_enqueue_script('fast-media-gallery');
		wp_enqueue_style('fonts-vc');
		wp_enqueue_style( 'elementor-icons' );
		wp_enqueue_style( 'font-awesome' );
		wp_enqueue_style( 'elementor-editor' );
		wp_enqueue_style( 'elementor-icons' );	
		wp_enqueue_style( 'fontawesome' );
			
		// CUSTOM RESPONSIVE: LOAD CSS
		if($active_custom_responsive == 'active_custom_responsive') {	
			wp_enqueue_style( 'custom-responsive-vc' );
		}

		// MASONRY: LOAD JAVASCRIPT 
		if($layout == 'fmg-masonry') {
			wp_enqueue_script('jquery-masonry');
		}
		
		// LIGHTGALLERY: LOAD CSS AND JAVASCRIPT
		if($type == 'lightgallery') {
			wp_enqueue_style( 'lightgallery' );
			wp_enqueue_script( 'lightgallery');					
		}

		if($fg_animate == 'on') {
			wp_enqueue_style( 'animations' );
			wp_enqueue_script( 'appear');
			wp_enqueue_script( 'animate');				
		}

		if($lazyload == 'on') {
			wp_enqueue_script( 'lazyload');
			wp_enqueue_script( 'imagesLoaded');	
		}

}

function ewmp_fastmediagallery_elementor_style($selector,
				   $main_color,
				   $main_color_opacity,
				   $secondary_color,
				   $spacing_active,
				   $spacing,
				   $name_show,
				   $gallery_name_font_size,
				   $gallery_name_font_color,
				   $gallery_name_text_align,
				   $pagination_active,
				   $pagination_style,
				   $image_width) {
					   
				// CHECK MAIN COLOR
				$rgb_main_color = ewmp_elementor_hex2rgb($main_color);
				$rgba_main_color = "rgba( ".$rgb_main_color[0]." , ".$rgb_main_color[1]." , ".$rgb_main_color[2]." , ".$main_color_opacity.")";	
				$rgb_secondary_color = ewmp_elementor_hex2rgb($secondary_color);
				$rgba_secondary_color = "rgba( ".$rgb_secondary_color[0]." , ".$rgb_secondary_color[1]." , ".$rgb_secondary_color[2]." , 0.3)";	
				// END MAIN COLOR	
			
				$output = "
				<style type='text/css'>
					#{$selector} {
					margin: auto;
					}
					#{$selector} .fg-gallery-item {
					margin-top: 10px;
					text-align: center;
					}
					#{$selector} .fg-gallery-caption {
					margin-left: 0;
					}
					#{$selector}.fastgallery .fg-gallery-caption, 
					#{$selector}.fastgallery .fg-gallery-caption:hover {
						background-color:".$rgba_main_color.";
					}
					#{$selector}.fastgallery.gallery .fastgallery-gallery-icon .fg_zoom a, 
					#{$selector}.fastgallery.gallery .fastgallery-gallery-icon .fg_zoom a:hover {
						color:".$main_color.";
					}
					#{$selector}.fastgallery.fg_style1 .fg-gallery-caption {
						color:".$secondary_color.";	
					}
					#{$selector}.fastgallery.gallery.fg_style2 .fastgallery-gallery-icon .fg_zoom a {
						background:".$rgba_secondary_color.";
					}
					#{$selector}.fastgallery.fg_style2 .fg-gallery-caption {
						color:".$secondary_color.";	
					}			
					#{$selector}.fastgallery.gallery.fg_style3 .fg_zoom, #{$selector}.fastgallery.gallery.fg_style3 .fg_zoom:hover {
						background:".$rgba_main_color.";
					}
					#{$selector}.fastgallery.fg_style3 .fg-gallery-caption {
						color:".$secondary_color.";	
					}				
					#{$selector}.fastgallery.fg_style4 .fg-gallery-caption,			
					#{$selector}.fastgallery.gallery.fg_style4 .fastgallery-gallery-icon .fg_zoom a, 
					#{$selector}.fastgallery.gallery.fg_style4 .fastgallery-gallery-icon .fg_zoom a:hover {
						color:".$secondary_color.";
					}
					#{$selector}.fastgallery.gallery.fg_style4 .fastgallery-gallery-icon .fg_zoom a, 
					#{$selector}.fastgallery.gallery.fg_style4 .fastgallery-gallery-icon .fg_zoom a:hover	{
						background:".$rgba_main_color.";
					}			
					#{$selector}.fastgallery.gallery.fg_style5 .fastgallery-gallery-icon .fg_zoom a, 
					#{$selector}.fastgallery.gallery.fg_style5 .fastgallery-gallery-icon .fg_zoom a:hover	{
						color:".$secondary_color.";
						background-color:".$rgba_main_color.";
					}					
					#{$selector}.fastgallery.gallery.fg_style6 .fastgallery-gallery-icon .fg_zoom a,
					#{$selector}.fastgallery.gallery.fg_style6 .fastgallery-gallery-icon .fg_zoom a:hover {
						color:".$secondary_color.";
						background:".$rgba_main_color.";				
					}
				
					#{$selector}.fastgallery.fg_style6 .fg-gallery-caption {
						color:".$secondary_color.";	
					}
					#{$selector}.fastgallery.gallery.fg_style7 .fastgallery-gallery-icon .fg_zoom a,
					#{$selector}.fastgallery.gallery.fg_style7 .fastgallery-gallery-icon .fg_zoom a:hover {
						color:".$secondary_color.";
						background:".$rgba_main_color.";				
					}		
					#{$selector}.fastgallery.fg_style7 .fg-gallery-caption {
						color:".$secondary_color.";	
					}
					
					#{$selector}.fastgallery.gallery.fg_style8 .fastgallery-gallery-icon .fg_zoom a,
					#{$selector}.fastgallery.gallery.fg_style8 .fastgallery-gallery-icon .fg_zoom a:hover {
						color:".$secondary_color.";
						background:".$rgba_main_color.";				
					}
				
					#{$selector}.fastgallery.fg_style8 .fg-gallery-caption {
						color:".$secondary_color.";	
					}
					
					#{$selector}.fastgallery.gallery.fg_style9 .fastgallery-gallery-icon .fg_zoom a,
					#{$selector}.fastgallery.gallery.fg_style9 .fastgallery-gallery-icon .fg_zoom a:hover {
						color:".$secondary_color.";
						background:".$rgba_main_color.";				
					}		
					#{$selector}.fastgallery.fg_style9 .fg-gallery-caption {
						color:".$secondary_color.";	
					}
					
					#{$selector}.fastgallery.gallery.fg_style10 .fastgallery-gallery-icon .fg_zoom a,
					#{$selector}.fastgallery.gallery.fg_style10 .fastgallery-gallery-icon .fg_zoom a:hover {
						color:".$secondary_color.";
						background:".$rgba_main_color.";				
					}		
					#{$selector}.fastgallery.fg_style10 .fg-gallery-caption {
						color:".$secondary_color.";	
					}
					#{$selector}.fastgallery.fg_style11 .fg-gallery-caption {
						color:".$secondary_color.";	
					}
					#{$selector}.fastgallery.fg_style11 .fastgallery-gallery-icon .fg_zoom a, 
					#{$selector}.fastgallery.fg_style11 .fastgallery-gallery-icon .fg_zoom a:hover {
						color:".$main_color.";
						background:".$rgba_secondary_color.";
					}
					#{$selector}.fastgallery.fg_style12 .fg-gallery-caption {
						color:".$secondary_color.";	
					}
					#{$selector}.fastgallery.fg_style12 .fastgallery-gallery-icon .fg_zoom a, 
					#{$selector}.fastgallery.fg_style12 .fastgallery-gallery-icon .fg_zoom a:hover {
						color:".$main_color.";
						background:".$rgba_secondary_color.";
					}";


				if($spacing_active == 'on') {
					$output .= "
						.fastgallery.gallery {
							width:100%;
							width: -webkit-calc(100% + ".$spacing."px);
							width: calc(100% + ".$spacing."px);
							/*margin-left:".$spacing."px;*/
						}
						.fastgallery .fg-gallery-item {
							margin-right:".$spacing."px!important;
							margin-bottom:".$spacing."px!important;
						}
						.fastgallery.gallery-columns-2 .fg-gallery-item {
							max-width: 48%;
							max-width: -webkit-calc(50% - ".$spacing."px);
							max-width:         calc(50% - ".$spacing."px);
						}
						
						.fastgallery.gallery-columns-3 .fg-gallery-item {
							max-width: 32%;
							max-width: -webkit-calc(33.3% - ".$spacing."px);
							max-width:         calc(33.3% - ".$spacing."px);
						}
						
						.fastgallery.gallery-columns-4 .fg-gallery-item {
							max-width: 23%;
							max-width: -webkit-calc(25% - ".$spacing."px);
							max-width:         calc(25% - ".$spacing."px);
						}
						
						.fastgallery.gallery-columns-5 .fg-gallery-item {
							max-width: 19%;
							max-width: -webkit-calc(20% - ".$spacing."px);
							max-width:         calc(20% - ".$spacing."px);
						}
						
						.fastgallery.gallery-columns-6 .fg-gallery-item {
							max-width: 15%;
							max-width: -webkit-calc(16.7% - ".$spacing."px);
							max-width:         calc(16.7% - ".$spacing."px);
						}
						
						.fastgallery.gallery-columns-7 .fg-gallery-item {
							max-width: 13%;
							max-width: -webkit-calc(14.28% - ".$spacing."px);
							max-width:         calc(14.28% - ".$spacing."px);
						}
						
						.fastgallery.gallery-columns-8 .fg-gallery-item {
							max-width: 11%;
							max-width: -webkit-calc(12.5% - ".$spacing."px);
							max-width:         calc(12.5% - ".$spacing."px);
						}
						
						.fastgallery.gallery-columns-9 .fg-gallery-item {
							max-width: 9%;
							max-width: -webkit-calc(11.1% - ".$spacing."px);
							max-width:         calc(11.1% - ".$spacing."px);
						}
					";
				}

				if($name_show == 'true') {
					$output .= ".fg_gallery_title-{$selector}.fg_gallery_name {
							font-size:".$gallery_name_font_size."px;
							color:".$gallery_name_font_color.";
							text-align:".$gallery_name_text_align.";
					}";
				}

				if($pagination_active == 'on') {
					$output .= "
						#{$selector}.fastgallery.fg_pagination_style1 ul.fg_pagination li a {
							background:".$rgba_main_color.";
							color:".$secondary_color.";
						}
						#{$selector}.fastgallery.fg_pagination_style1 ul.fg_pagination li a:hover {
							background:".$secondary_color.";
							color:".$rgba_main_color.";
						}
						#{$selector}.fastgallery.fg_pagination_style1 ul.fg_pagination li.fg_current {
							background:".$secondary_color.";
							color:".$rgba_main_color.";
						}
						#{$selector}.fastgallery.fg_pagination_style2 ul.fg_pagination li a {
							color:".$secondary_color.";
						}
						#{$selector}.fastgallery.fg_pagination_style2 ul.fg_pagination li a:hover {
							color:".$rgba_main_color.";
						}
						#{$selector}.fastgallery.fg_pagination_style2 ul.fg_pagination li.fg_current {
							color:".$rgba_main_color.";
						}																		
					";
				}

				if($image_width == 'small') {
					$output .= "#{$selector}.fastgallery.gallery span {
										font-size:20px!important;
					}
					#{$selector}.fastgallery.gallery .fg-zoom-icon {
										margin-left:-10px!important;
										margin-top:-40px;
					}
					#{$selector}.fastgallery.gallery.fg_style2 .fg-zoom-icon,
					#{$selector}.fastgallery.gallery.fg_style5 .fg-zoom-icon  {
										margin-top:-10px;
					}		
					#{$selector}.fastgallery.gallery .no-caption .fg-zoom-icon {
										margin-top:-10px!important;
					}
					#{$selector}.fastgallery.fg_style7 .fg-gallery-caption,
					#{$selector}.fastgallery.fg_style8 .fg-gallery-caption {
										top:55%;
					}
					";
				}
				
				if($image_width == 'medium') {
					$output .= "#{$selector}.fastgallery.gallery span {
										font-size:30px!important;
					}
					#{$selector}.fastgallery.gallery .fg-zoom-icon {
										margin-left:-15px!important;
										margin-top:-40px;
					}
					#{$selector}.fastgallery.gallery.fg_style2 .fg-zoom-icon,
					#{$selector}.fastgallery.gallery.fg_style5 .fg-zoom-icon  {
										margin-top:-15px;
					}		
					#{$selector}.fastgallery.gallery .no-caption .fg-zoom-icon {
										margin-top:-15px!important;
					}
					#{$selector}.fastgallery.fg_style7 .fg-gallery-caption,
					#{$selector}.fastgallery.fg_style8 .fg-gallery-caption {
										top:55%;
					}
					";
				}
		
				if($image_width == 'large') {
					$output .= "#{$selector}.fastgallery.gallery span {
										font-size:50px!important;
					}
					#{$selector}.fastgallery .fg-zoom-icon {
										margin-left:-25px!important;
										margin-top:-50px;
					}
					#{$selector}.fastgallery.fg_style1 .fg-zoom-icon,
					#{$selector}.fastgallery.fg_style2 .fg-zoom-icon,
					#{$selector}.fastgallery.fg_style5 .fg-zoom-icon {
										margin-top:-25px;
					}		
					#{$selector}.fastgallery .no-caption .fg-zoom-icon {
										margin-top:-25px!important;
					}
					#{$selector}.fastgallery.fg_style7 .fg-gallery-caption,
					#{$selector}.fastgallery.fg_style8 .fg-gallery-caption {
										top:55%;
					}
					";
				}						
					
			$output .= '</style>';				
	return $output;					
}

function ewmp_header_custom_style($instance,$type,$layout,$maincolor,$secondcolor,$thirdcolor) {
	
	$return = '<style type="text/css">';
	
	if($type == 'type1') {
		
		if($layout == 'layout1') {
		
			$return .= '.headerblocks.wpmp_post_display1.wpmepack-header-'.$instance.' .share a,
						.headerblocks.wpmp_post_display1.wpmepack-header-'.$instance.' .share-icon:hover,
						.headerblocks.wpmp_post_display1.wpmepack-header-'.$instance.' .headerblocks-item.ad_three_fifth.big-post .title-info-post a, 
						.headerblocks.wpmp_post_display1.wpmepack-header-'.$instance.' .headerblocks-item.ad_two_fifth.ad_margin.first .title-info-post a, 
						.headerblocks.wpmp_post_display1.wpmepack-header-'.$instance.' .headerblocks-item.ad_two_fifth.ad_margin .title-info-post a,
						.headerblocks.wpmp_post_display1.wpmepack-header-'.$instance.' .headerblocks-item.ad_three_fifth.big-post .title-info-post span, 
						.headerblocks.wpmp_post_display1.wpmepack-header-'.$instance.' .headerblocks-item.ad_two_fifth.ad_margin.first .title-info-post span, 
						.headerblocks.wpmp_post_display1.wpmepack-header-'.$instance.' .headerblocks-item.ad_two_fifth.ad_margin .title-info-post span,
						.headerblocks.wpmp_post_display1.wpmepack-header-'.$instance.' .headerblocks-item.ad_three_fifth.big-post i, 
						.headerblocks.wpmp_post_display1.wpmepack-header-'.$instance.' .headerblocks-item.ad_two_fifth.ad_margin i,
						.headerblocks.wpmp_post_display1.wpmepack-header-'.$instance.' .separator {
							color:'.$secondcolor.';
						}
						.headerblocks.wpmp_post_display1.wpmepack-header-'.$instance.' .category a {
							border-left:5px solid '.$maincolor.';
						}
						.headerblocks.wpmp_post_display1.wpmepack-header-'.$instance.' .category a:hover,
						.headerblocks.wpmp_post_display1.wpmepack-header-'.$instance.' .share,
						.headerblocks.wpmp_post_display1.wpmepack-header-'.$instance.' .headerblocks-item.ad_three_fifth.big-post .info-post, 
						.headerblocks.wpmp_post_display1.wpmepack-header-'.$instance.' .headerblocks-item.ad_two_fifth.ad_margin .info-post {
							background:'.$maincolor.';						
						}
						.headerblocks.wpmp_post_display1.wpmepack-header-'.$instance.' .headerblocks-item.ad_three_fifth.big-post .title-info-post a:hover, 
						.headerblocks.wpmp_post_display1.wpmepack-header-'.$instance.' .headerblocks-item.ad_two_fifth.ad_margin .title-info-post a:hover,
						.headerblocks.wpmp_post_display1.wpmepack-header-'.$instance.' .icon-calendar {
							color:'.$maincolor.';
						}
						.headerblocks.wpmp_post_display1.wpmepack-header-'.$instance.' .share a:hover,
						.headerblocks.wpmp_post_display1.wpmepack-header-'.$instance.' .headerblocks-item.ad_three_fifth.big-post .info-post a:hover, 
						.headerblocks.wpmp_post_display1.wpmepack-header-'.$instance.' .headerblocks-item.ad_two_fifth.ad_margin .info-post a:hover,  
						.headerblocks.wpmp_post_display1.wpmepack-header-'.$instance.' .share .icon a:hover,
						.headerblocks.wpmp_post_display1.wpmepack-header-'.$instance.' .headerblocks-item.ad_three_fifth.big-post .info-post span:hover,
						.headerblocks.wpmp_post_display1.wpmepack-header-'.$instance.' .headerblocks-item.ad_two_fifth.ad_margin .info-post span:hover {
							color:'.$thirdcolor.';
						}';
		
		} else {
			
			$return .= '.headerblocks.wpmp_post_display1_bis.wpmepack-header-'.$instance.' .separator {
							color:'.$secondcolor.';
						}
						.headerblocks.wpmp_post_display1_bis.wpmepack-header-'.$instance.' .category a {
							border-left:5px solid '.$maincolor.';
						}
						.headerblocks.wpmp_post_display1_bis.wpmepack-header-'.$instance.' .category a:hover,
						.headerblocks.wpmp_post_display1_bis.wpmepack-header-'.$instance.' .share,
						.headerblocks.wpmp_post_display1_bis.wpmepack-header-'.$instance.' .headerblocks-item.ad_three_fifth.big-post .info-post, 
						.headerblocks.wpmp_post_display1_bis.wpmepack-header-'.$instance.' .headerblocks-item.ad_two_fifth.ad_margin .info-post {
							background:'.$maincolor.';
						}
						.headerblocks.wpmp_post_display1_bis.wpmepack-header-'.$instance.' .icon-calendar,
						.headerblocks.wpmp_post_display1_bis.wpmepack-header-'.$instance.' .headerblocks-item.ad_three_fifth.big-post .title-info-post a:hover, 
						.headerblocks.wpmp_post_display1_bis.wpmepack-header-'.$instance.' .headerblocks-item.ad_two_fifth.ad_margin .title-info-post a:hover {
							color:'.$maincolor.';
						}
						.headerblocks.wpmp_post_display1_bis.wpmepack-header-'.$instance.' .share a:hover,
						.headerblocks.wpmp_post_display1_bis.wpmepack-header-'.$instance.' .headerblocks-item.ad_three_fifth.big-post .info-post a:hover, 
						.headerblocks.wpmp_post_display1_bis.wpmepack-header-'.$instance.' .headerblocks-item.ad_two_fifth.ad_margin .info-post a:hover,  
						.headerblocks.wpmp_post_display1_bis.wpmepack-header-'.$instance.' .share .icon a:hover,
						.headerblocks.wpmp_post_display1_bis.wpmepack-header-'.$instance.' .category a:hover  {
							color:'.$thirdcolor.';
						}';
						
		}	
		
	}
	
	if($type == 'type2') {
		
		if($layout == 'layout1') {
		
			$return .= '.headerblocks.wpmp_post_display2.wpmepack-header-'.$instance.' .headerblocks-item.ad_one_third.ad_margin .box-post,
						.headerblocks.wpmp_post_display2.wpmepack-header-'.$instance.' .ad_one_one .category a,
						.headerblocks.wpmp_post_display2.wpmepack-header-'.$instance.' .ad_one_third .category a,
						.headerblocks.wpmp_post_display2.wpmepack-header-'.$instance.' .category a:hover,
						.headerblocks.wpmp_post_display2.wpmepack-header-'.$instance.' .share,
						.headerblocks.wpmp_post_display2.wpmepack-header-'.$instance.' .share a,
						.headerblocks.wpmp_post_display2.wpmepack-header-'.$instance.' .share-icon:hover,
						.headerblocks.wpmp_post_display2.wpmepack-header-'.$instance.' .headerblocks-item.ad_one_one.ad_last.big-post .title-info-post a,
						.headerblocks.wpmp_post_display2.wpmepack-header-'.$instance.' .headerblocks-item.ad_one_one.ad_last.big-post i,
						.headerblocks.wpmp_post_display2.wpmepack-header-'.$instance.' .separator,
						.headerblocks.wpmp_post_display2.wpmepack-header-'.$instance.' .headerblocks-item.ad_one_one.ad_last.big-post .title-info-post span {
							color:'.$secondcolor.';
						}
						.headerblocks.wpmp_post_display2.wpmepack-header-'.$instance.' .headerblocks-item.ad_one_third.ad_margin {
							background:'.$secondcolor.';
						}
						.headerblocks.wpmp_post_display2.wpmepack-header-'.$instance.' .ad_one_one .category a {
							border-left:5px solid '.$maincolor.';
						}
						.headerblocks.wpmp_post_display2.wpmepack-header-'.$instance.' .ad_one_third .category a {
							border-right:5px solid '.$maincolor.';
						}
						.headerblocks.wpmp_post_display2.wpmepack-header-'.$instance.' .category a:hover,
						.headerblocks.wpmp_post_display2.wpmepack-header-'.$instance.' .share,
						.headerblocks.wpmp_post_display2.wpmepack-header-'.$instance.' .headerblocks-item.ad_one_one.ad_last.big-post .info-post {
							background:'.$maincolor.';
						}
						.headerblocks.wpmp_post_display2.wpmepack-header-'.$instance.' .headerblocks-item.ad_one_one.ad_last.big-post .title-info-post a:hover,
						.headerblocks.wpmp_post_display2.wpmepack-header-'.$instance.' .headerblocks-item.ad_one_third.ad_margin .box-post:hover .title-info-post .title-post a,
						.headerblocks.wpmp_post_display2.wpmepack-header-'.$instance.' .headerblocks-item.ad_one_third.ad_margin .data:hover,
						.headerblocks.wpmp_post_display2.wpmepack-header-'.$instance.' .icon-calendar {
							color:'.$maincolor.';
						}
						.headerblocks.wpmp_post_display2.wpmepack-header-'.$instance.' .share a:hover,
						.headerblocks.wpmp_post_display2.wpmepack-header-'.$instance.' .headerblocks-item.ad_one_one.ad_last.big-post .info-post a:hover {
							color:'.$thirdcolor.';
						}
			';
		
		} else {
			
			$return .= '.headerblocks.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .ad_one_one .category a {
							border-left:5px solid '.$maincolor.';
						}
						.headerblocks.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .ad_one_third .category a {
							border-top: 2px solid '.$maincolor.';
						}
						.headerblocks.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .category a:hover,
						.headerblocks.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .share,
						.headerblocks.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .headerblocks-item.ad_one_one.ad_last.big-post .info-post {
							background:'.$maincolor.';
						}
						.headerblocks.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .headerblocks-item.ad_one_one.ad_last.big-post .title-info-post a:hover,
						.headerblocks.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .headerblocks-item.ad_one_one.ad_last.big-post .title-info-post a:hover,
						.headerblocks.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .headerblocks-item.ad_one_third.ad_margin .box-post:hover .title-info-post .title-post a,
						.headerblocks.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .headerblocks-item.ad_one_third.ad_margin .data:hover,
						.headerblocks.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .icon-calendar {
							color:'.$maincolor.';
						}
						.headerblocks.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .headerblocks-item.ad_one_third.ad_margin .box-post,
						.headerblocks.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .headerblocks-item.ad_one_third.ad_margin.second,
						.headerblocks.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .headerblocks-item.ad_one_third.ad_margin.third {
							background:'.$secondcolor.';
						}
						.headerblocks.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .ad_one_one .category a,
						.headerblocks.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .ad_one_third .category a,					
						.headerblocks.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .share,
						.headerblocks.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .share a,
						.headerblocks.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .share-icon:hover,
						.headerblocks.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .headerblocks-item.ad_one_one.ad_last.big-post .title-info-post a,
						.headerblocks.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .headerblocks-item.ad_one_one.ad_last.big-post .title-info-post span,
						.headerblocks.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .headerblocks-item.ad_one_one.ad_last.big-post .info-post a,
						.headerblocks.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .headerblocks-item.ad_one_one.ad_last.big-post .info-post span,
						.headerblocks.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .headerblocks-item.ad_one_one.ad_last.big-post i,
						.headerblocks.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .separator {
							color:'.$secondcolor.';
						}				
						.headerblocks.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .share a:hover,
						.headerblocks.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .headerblocks-item.ad_one_one.ad_last.big-post .info-post a:hover,
						.headerblocks.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .category a:hover,
						.headerblocks.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .headerblocks-item.ad_one_third.ad_margin .data,
						.headerblocks.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .headerblocks-item.ad_one_third.ad_margin .title-info-post h4 a {
							color:'.$thirdcolor.';
						}';
			
		}
		
	}	
	
	if($type == 'type3') {
		
		if($layout == 'layout1') {
		
			$return .= '.headerblocks.wpmp_post_display3.wpmepack-header-'.$instance.' .category a {
							border-left:5px solid '.$maincolor.';
						}
						.headerblocks.wpmp_post_display3.wpmepack-header-'.$instance.' .category a:hover,
						.headerblocks.wpmp_post_display3.wpmepack-header-'.$instance.' .share,
						.headerblocks.wpmp_post_display3.wpmepack-header-'.$instance.' .headerblocks-item.ad_three_fifth.big-post .info-post, 
						.headerblocks.wpmp_post_display3.wpmepack-header-'.$instance.' .headerblocks-item.ad_two_fifth.ad_margin .info-post {
							background:'.$maincolor.';
						}
						.headerblocks.wpmp_post_display3.wpmepack-header-'.$instance.' .headerblocks-item.ad_three_fifth.big-post .title-info-post a:hover, 
						.headerblocks.wpmp_post_display3.wpmepack-header-'.$instance.' .headerblocks-item.ad_one_fifth.ad_margin .title-info-post a:hover, 
						.headerblocks.wpmp_post_display3.wpmepack-header-'.$instance.' .headerblocks-item.ad_two_fifth.ad_margin .title-info-post a:hover,
						.headerblocks.wpmp_post_display3.wpmepack-header-'.$instance.' .icon-calendar {
							color:'.$maincolor.';
						}
						.headerblocks.wpmp_post_display3.wpmepack-header-'.$instance.' .category a,
						.headerblocks.wpmp_post_display3.wpmepack-header-'.$instance.' .share,
						.headerblocks.wpmp_post_display3.wpmepack-header-'.$instance.' .share a,
						.headerblocks.wpmp_post_display3.wpmepack-header-'.$instance.' .share-icon:hover,
						.headerblocks.wpmp_post_display3.wpmepack-header-'.$instance.' .headerblocks-item.ad_three_fifth.big-post .title-info-post a, 
						.headerblocks.wpmp_post_display3.wpmepack-header-'.$instance.' .headerblocks-item.ad_one_fifth.ad_margin .title-info-post a, 
						.headerblocks.wpmp_post_display3.wpmepack-header-'.$instance.' .headerblocks-item.ad_two_fifth.ad_margin .title-info-post a, 
						.headerblocks.wpmp_post_display3.wpmepack-header-'.$instance.' .headerblocks-item .title-info-post span,
						.headerblocks.wpmp_post_display3.wpmepack-header-'.$instance.' .headerblocks-item.ad_three_fifth.big-post i, 
						.headerblocks.wpmp_post_display3.wpmepack-header-'.$instance.' .headerblocks-item.ad_two_fifth.ad_margin i, 
						.headerblocks.wpmp_post_display3.wpmepack-header-'.$instance.' .headerblocks-item.ad_two_fifth.ad_margin .info-post,
						.headerblocks.wpmp_post_display3.wpmepack-header-'.$instance.' .separator {
							color:'.$secondcolor.';
						}
						.headerblocks.wpmp_post_display3.wpmepack-header-'.$instance.' .share a:hover,
						.headerblocks.wpmp_post_display3.wpmepack-header-'.$instance.' .headerblocks-item.ad_three_fifth.big-post .info-post a:hover, 
						.headerblocks.wpmp_post_display3.wpmepack-header-'.$instance.' .headerblocks-item.ad_two_fifth.ad_margin .info-post a:hover,  
						.headerblocks.wpmp_post_display3.wpmepack-header-'.$instance.' .share .icon a:hover,
						.headerblocks.wpmp_post_display3.wpmepack-header-'.$instance.' .category a:hover {
							color:'.$thirdcolor.';
						}						
						';
		
		} else {
			
			$return .= '.headerblocks.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .category a,
						.headerblocks.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .share,
						.headerblocks.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .ad_one_fifth .share,
						.headerblocks.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .ad_one_fifth .share a,
						.headerblocks.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .share a,
						.headerblocks.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .share-icon:hover,
						.headerblocks.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .headerblocks-item.ad_three_fifth.big-post .title-info-post a, 
						.headerblocks.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .headerblocks-item.ad_one_fifth.ad_margin .title-info-post a, 
						.headerblocks.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .headerblocks-item.ad_two_fifth.ad_margin .title-info-post a,
						.headerblocks.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .headerblocks-item.ad_three_fifth.big-post .title-info-post span,
						.headerblocks.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .headerblocks-item.ad_two_fifth.ad_margin .title-info-post span,
						.headerblocks.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .headerblocks-item.ad_three_fifth.big-post i, 
						.headerblocks.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .headerblocks-item.ad_two_fifth.ad_margin i,
						.headerblocks.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .headerblocks-item.ad_three_fifth.big-post .info-post a, 
						.headerblocks.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .headerblocks-item.ad_two_fifth .info-post a,
						.headerblocks.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .headerblocks-item.ad_three_fifth.big-post .info-post span,
						.headerblocks.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .headerblocks-item.ad_two_fifth .info-post span,						
						.headerblocks.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .headerblocks-item.ad_one_fifth.big-post .title-info-post span,
						.headerblocks.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .headerblocks-item.ad_one_fifth.ad_margin .title-info-post span,
						.headerblocks.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .separator,
						.headerblocks.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .data {
							color:'.$secondcolor.';
						}
						.headerblocks.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .category a {
							border-left:5px solid '.$maincolor.';
						}
						.headerblocks.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .category a:hover,
						.headerblocks.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .share,
						.headerblocks.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .ad_one_fifth .share,
						.headerblocks.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .headerblocks-item.ad_three_fifth.big-post .info-post, 
						.headerblocks.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .headerblocks-item.ad_two_fifth.ad_margin .info-post {
							background:'.$maincolor.';
						}
						.headerblocks.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .headerblocks-item.ad_three_fifth.big-post .title-info-post a:hover, 
						.headerblocks.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .headerblocks-item.ad_one_fifth.ad_margin .title-info-post a:hover, 
						.headerblocks.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .headerblocks-item.ad_two_fifth.ad_margin .title-info-post a:hover,
						.headerblocks.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .icon-calendar {
							color:'.$maincolor.';
						}
						.headerblocks.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .share a:hover,
						.headerblocks.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .headerblocks-item.ad_three_fifth.big-post .info-post a:hover, 
						.headerblocks.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .headerblocks-item.ad_two_fifth.ad_margin .info-post a:hover,  
						.headerblocks.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .share .icon a:hover,
						.headerblocks.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .category a:hover {
							color:'.$thirdcolor.';
						}';
							
		}
		
	}
	
	if($type == 'type4') {
		
		if($layout == 'layout1') {
		
			$return .= '.headerblocks.wpmp_post_display4.wpmepack-header-'.$instance.'  .ad_one_one .category a {
							border-left:5px solid '.$maincolor.';
						}
						.headerblocks.wpmp_post_display4.wpmepack-header-'.$instance.'  .ad_one_third .category a {
							border-right:5px solid '.$maincolor.';
						}
						.headerblocks.wpmp_post_display4.wpmepack-header-'.$instance.'  .category a:hover,
						.headerblocks.wpmp_post_display4.wpmepack-header-'.$instance.'  .share {
							background:'.$maincolor.';
						}
						.headerblocks.wpmp_post_display4.wpmepack-header-'.$instance.' .headerblocks-item.ad_one_one.ad_last.big-post .title-info-post a:hover,
						.headerblocks.wpmp_post_display4.wpmepack-header-'.$instance.' .icon-calendar,
						.headerblocks.wpmp_post_display4.wpmepack-header-'.$instance.' .owl-controls .owl-nav [class*="owl-"]:hover {
							color:'.$maincolor.';
						}
						.headerblocks.wpmp_post_display4.wpmepack-header-'.$instance.' .ad_one_one .category a,
						.headerblocks.wpmp_post_display4.wpmepack-header-'.$instance.' .ad_one_third .category a,
						.headerblocks.wpmp_post_display4.wpmepack-header-'.$instance.' .share,
						.headerblocks.wpmp_post_display4.wpmepack-header-'.$instance.' .share a,
						.headerblocks.wpmp_post_display4.wpmepack-header-'.$instance.' .share-icon:hover,
						.headerblocks.wpmp_post_display4.wpmepack-header-'.$instance.' .headerblocks-item.ad_one_one.ad_last.big-post .title-info-post a,
						.headerblocks.wpmp_post_display4.wpmepack-header-'.$instance.' .headerblocks-item.ad_one_one.ad_last.big-post i,
						.headerblocks.wpmp_post_display4.wpmepack-header-'.$instance.' .headerblocks-item.ad_one_one.ad_last.big-post .title-info-post span,
						.headerblocks.wpmp_post_display4.wpmepack-header-'.$instance.' .headerblocks-item.ad_one_one.ad_last.big-post .title-info-post .category a:hover	{
							color:'.$secondcolor.';
						}
						.headerblocks.wpmp_post_display4.wpmepack-header-'.$instance.' .share a:hover,
						.headerblocks.wpmp_post_display4.wpmepack-header-'.$instance.' .category a:hover {
							color:'.$thirdcolor.'!important;
						}					
						';
						
		} else {
			
			$return .= '.headerblocks.wpmp_post_display4_bis.wpmepack-header-'.$instance.'  .ad_one_one .category a {
							border-left:5px solid '.$maincolor.';
						}
						.headerblocks.wpmp_post_display4_bis.wpmepack-header-'.$instance.'  .ad_one_third .category a {
							border-right:5px solid '.$maincolor.';
						}
						.headerblocks.wpmp_post_display4_bis.wpmepack-header-'.$instance.'  .category a:hover,
						.headerblocks.wpmp_post_display4_bis.wpmepack-header-'.$instance.'  .share {
							background:'.$maincolor.';
						}
						.headerblocks.wpmp_post_display4_bis.wpmepack-header-'.$instance.' .headerblocks-item.ad_one_one.ad_last.big-post .title-info-post a:hover,
						.headerblocks.wpmp_post_display4_bis.wpmepack-header-'.$instance.' .icon-calendar,
						.headerblocks.wpmp_post_display4_bis.wpmepack-header-'.$instance.' .owl-controls .owl-nav [class*="owl-"]:hover {
							color:'.$maincolor.';
						}
						.headerblocks.wpmp_post_display4_bis.wpmepack-header-'.$instance.' .ad_one_one .category a,
						.headerblocks.wpmp_post_display4_bis.wpmepack-header-'.$instance.' .ad_one_third .category a,
						.headerblocks.wpmp_post_display4_bis.wpmepack-header-'.$instance.' .share,
						.headerblocks.wpmp_post_display4_bis.wpmepack-header-'.$instance.' .share a,
						.headerblocks.wpmp_post_display4_bis.wpmepack-header-'.$instance.' .share-icon:hover,
						.headerblocks.wpmp_post_display4_bis.wpmepack-header-'.$instance.' .headerblocks-item.ad_one_one.ad_last.big-post .title-info-post a,
						.headerblocks.wpmp_post_display4_bis.wpmepack-header-'.$instance.' .headerblocks-item.ad_one_one.ad_last.big-post i,
						.headerblocks.wpmp_post_display4_bis.wpmepack-header-'.$instance.' .headerblocks-item.ad_one_one.ad_last.big-post .title-info-post span	{
							color:'.$secondcolor.';
						}
						.headerblocks.wpmp_post_display4_bis.wpmepack-header-'.$instance.' .share a:hover,
						.headerblocks.wpmp_post_display4_bis.wpmepack-header-'.$instance.' .category a:hover {
							color:'.$thirdcolor.'!important;
						}					
						';
			
		}
	}
	
	if($type == 'type5') {
		
		if($layout == 'layout1') {
		
			$return .= '.headerblocks.wpmp_post_display5.wpmepack-header-'.$instance.' .ad_one_one .category a {
							border-left:5px solid '.$maincolor.';
						}
						.headerblocks.wpmp_post_display5.wpmepack-header-'.$instance.' .ad_one_third .category a {
							border-right:5px solid '.$maincolor.';
						}
						.headerblocks.wpmp_post_display5.wpmepack-header-'.$instance.' .category a:hover,
						.headerblocks.wpmp_post_display5.wpmepack-header-'.$instance.' .share,
						.headerblocks.wpmp_post_display5.wpmepack-header-'.$instance.' .share .info-comments {
							background:'.$maincolor.';
						}
						.headerblocks.wpmp_post_display5.wpmepack-header-'.$instance.' .info-post i,
						.headerblocks.wpmp_post_display5.wpmepack-header-'.$instance.' .title-info-post.ad_one_half a:hover,
						.headerblocks.wpmp_post_display5.wpmepack-header-'.$instance.' .icon-calendar,
						.wpmp_post_display5.wpmepack-header-'.$instance.' .mini-post .title-post a:hover,
						.wpmp_post_display5.wpmepack-header-'.$instance.' .mini-post .info-post a:hover  {
							color:'.$maincolor.';
						}';
	
			$return .= '.headerblocks.wpmp_post_display5.wpmepack-header-'.$instance.' .ad_one_one .category a,
						.headerblocks.wpmp_post_display5.wpmepack-header-'.$instance.' .ad_one_third .category a,
						.headerblocks.wpmp_post_display5.wpmepack-header-'.$instance.' .category a:hover,
						.headerblocks.wpmp_post_display5.wpmepack-header-'.$instance.' .share,
						.headerblocks.wpmp_post_display5.wpmepack-header-'.$instance.' .title-info-post.ad_one_half p,
						.headerblocks.wpmp_post_display5.wpmepack-header-'.$instance.' .info-post a,
						.headerblocks.wpmp_post_display5.wpmepack-header-'.$instance.' .title-info-post.ad_one_half span,
						.headerblocks.wpmp_post_display5.wpmepack-header-'.$instance.' .separator,
						.headerblocks.wpmp_post_display5.wpmepack-header-'.$instance.' .view,
						.headerblocks.wpmp_post_display5.wpmepack-header-'.$instance.' .share a,
						.headerblocks.wpmp_post_display5.wpmepack-header-'.$instance.' .share-icon:hover,
						.headerblocks.wpmp_post_display5.wpmepack-header-'.$instance.' .title-info-post.ad_one_half a,
						.headerblocks.wpmp_post_display5.wpmepack-header-'.$instance.' .title-info-post.ad_one_half span,
						.headerblocks.wpmp_post_display5.wpmepack-header-'.$instance.' .headerblocks-item.ad_one_one.ad_last.big-post i,
						.wpmp_post_display5.wpmepack-header-'.$instance.' .mini-post .title-post a {
							color:'.$secondcolor.';
						}';
			
			$return .= '.headerblocks.wpmp_post_display5.wpmepack-header-'.$instance.',
						.headerblocks.wpmp_post_display5.wpmepack-header-'.$instance.' .ad_one_third .category a {
							background:'.$thirdcolor.';
						}';
		
		} else {
			
			$return .= '.headerblocks.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .ad_one_one .category a {
							border-left:5px solid '.$maincolor.';
						}
						.headerblocks.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .ad_one_one .category a {
							border-right:5px solid '.$maincolor.';
						}
						.headerblocks.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .category a:hover,
						.headerblocks.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .share,
						.headerblocks.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .share .info-comments {
							background:'.$maincolor.';
						}
						.headerblocks.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .info-post i,
						.headerblocks.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .title-info-post.ad_one_half a:hover,
						.headerblocks.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .icon-calendar,
						.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .mini-post .title-post a:hover,
						.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .mini-post .info-post a:hover  {
							color:'.$maincolor.';
						}';
	
			$return .= '.headerblocks.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .ad_one_one .category a,
						.headerblocks.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .ad_one_third .category a,
						.headerblocks.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .category a:hover,
						.headerblocks.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .share,
						.headerblocks.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .title-info-post.ad_one_half p,
						.headerblocks.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .info-post a,
						.headerblocks.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .title-info-post.ad_one_half span,
						.headerblocks.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .separator,
						.headerblocks.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .view,
						.headerblocks.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .share a,
						.headerblocks.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .share-icon:hover,
						.headerblocks.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .title-info-post.ad_one_half a,
						.headerblocks.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .title-info-post.ad_one_half span,
						.headerblocks.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .headerblocks-item.ad_one_one.ad_last.big-post i,
						.wpmp_post_display5.wpmepack-header-'.$instance.' .mini-post .title-post a {
							color:'.$secondcolor.';
						}';
			
			$return .= '.headerblocks.wpmp_post_display5_bis.wpmepack-header-'.$instance.',
						.headerblocks.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .ad_one_third .category a {
							background:'.$thirdcolor.';
						}';
						
		}
		
		
	}
	
	
	$return .= '</style>';
	
	
	return $return;
}




function ewmp_thumbs_url($id_post) {
	global $post;
	if(has_post_thumbnail()){  
			$id_post = get_the_id();					
			$single_image = wp_get_attachment_image_src( get_post_thumbnail_id($id_post), 'ewmp-header' );	 					 
		} else {               
             $single_image[0] = WPMP_VC_URL .'assets/img/no-img.jpg';                
    }	
	$return = $single_image[0];
	return $return;
}

/** Post Social Share **/
if(!function_exists('ewmp_headerblocks_post_social_share')) {
	function ewmp_headerblocks_post_social_share($css_link = '') {
		
		$return = '<div class="share">
			<div class="icon">	
				<a target="_blank" href="http://www.facebook.com/sharer.php?u='.get_the_permalink().'&amp;t='.get_the_title().'" title="'.esc_html__('Click to share this post on Facebook','elementorwidgetsmegapack').'" '.$css_link.'><i class="fa fa-facebook"></i></a>
				<a target="_blank" href="http://twitter.com/home?status='.get_the_permalink().'" title="'.esc_html__('Click to share this post on Twitter','elementorwidgetsmegapack').'"><i class="fa fa-twitter" '.$css_link.'></i></a>
				<a target="_blank" href="https://plus.google.com/share?url='.get_the_permalink().'" title="'.esc_html__('Click to share this post on Google+','elementorwidgetsmegapack').'"><i class="fa fa-google-plus" '.$css_link.'></i></a>
				<a target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&amp;url='.get_the_permalink().'" title="'.esc_html__('Click to share this post on Linkedin','elementorwidgetsmegapack').'"><i class="fa fa-linkedin" '.$css_link.'></i></a>
				<a href="#" class="share-icon fa fa-rocket"></a>
			</div>	
		</div>';
		
		return $return;
	}
}

function ewmp_vcmegaposts_thumbs() {
	global $post;
	if(has_post_thumbnail()){ 
			$id_post = get_the_id();					
			$single_image = wp_get_attachment_image_src( get_post_thumbnail_id($id_post), 'vcmegaposts-type1' );	 					 
		} else {               
             $single_image[0] = plugins_url( 'megapostsdisplayelementor/assets/img/no-img.png');                 
    }	
	$return =	'<img class="megaposts-thumbs" src="'.$single_image[0].'" alt="'.get_the_title().'">';
	return $return;
}

function ewmp_vcmegaposts_format_icon() {
	$id_post = get_the_id(); 
    $format = get_post_format( $id_post );   
    if (empty($format)) { $format = 'standard'; }
	if ($format == 'standard') { $return = '<span class="fa fa-file"></span>'; }
	if ($format == 'aside') { $return = '<span class="fa fa-file-o"></span>'; }
	if ($format == 'link') { $return = '<span class="fa fa-paperclip"></span>'; }   
    if ($format == 'gallery') { $return = '<span class="fa fa-file-image-o"></span>'; }
    if ($format == 'video') { $return = '<span class="fa fa-play"></span>'; }
    if ($format == 'audio') { $return = '<span class="fa fa-headphones"></span>'; }
    if ($format == 'image') { $return = '<span class="fa fa-picture-o"></span>'; } 
    if ($format == 'quote') { $return = '<span class="fa fa-quote-left"></span>'; }
    if ($format == 'status') { $return = '<span class="fa fa-comments"></span>'; }
	
	return $return;	
}

function ewmp_vcmegaposts_excerpt($excerpt) {
	$return = substr(get_the_excerpt(), 0, $excerpt);
	return $return;
}

function ewmp_woocommerceheaderproducts_header_custom_style($instance,$type,$layout,$maincolor,$secondcolor,$thirdcolor) {
	
	$return = '<style type="text/css">';
	
	if($type == 'type1') {
		
		if($layout == 'layout1') {
		
			$return .= '.woocommerceheaderproducts.wpmp_post_display1.wpmepack-header-'.$instance.' .share a,
						.woocommerceheaderproducts.wpmp_post_display1.wpmepack-header-'.$instance.' .share-icon:hover,
						.woocommerceheaderproducts.wpmp_post_display1.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_three_fifth.big-post .title-info-post a, 
						.woocommerceheaderproducts.wpmp_post_display1.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_two_fifth.ad_margin.first .title-info-post a, 
						.woocommerceheaderproducts.wpmp_post_display1.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_two_fifth.ad_margin .title-info-post a,
						.woocommerceheaderproducts.wpmp_post_display1.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_three_fifth.big-post .title-info-post span, 
						.woocommerceheaderproducts.wpmp_post_display1.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_two_fifth.ad_margin.first .title-info-post span, 
						.woocommerceheaderproducts.wpmp_post_display1.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_two_fifth.ad_margin .title-info-post span,
						.woocommerceheaderproducts.wpmp_post_display1.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_three_fifth.big-post i, 
						.woocommerceheaderproducts.wpmp_post_display1.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_two_fifth.ad_margin i,
						.woocommerceheaderproducts.wpmp_post_display1.wpmepack-header-'.$instance.' .separator {
							color:'.$secondcolor.';
						}
						.woocommerceheaderproducts.wpmp_post_display1.wpmepack-header-'.$instance.' .category a {
							border-left:5px solid '.$maincolor.';
						}
						.woocommerceheaderproducts.wpmp_post_display1.wpmepack-header-'.$instance.' .category a:hover,
						.woocommerceheaderproducts.wpmp_post_display1.wpmepack-header-'.$instance.' .share,
						.woocommerceheaderproducts.wpmp_post_display1.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_three_fifth.big-post .info-post, 
						.woocommerceheaderproducts.wpmp_post_display1.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_two_fifth.ad_margin .info-post {
							background:'.$maincolor.';						
						}
						.woocommerceheaderproducts.wpmp_post_display1.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_three_fifth.big-post .title-info-post a:hover, 
						.woocommerceheaderproducts.wpmp_post_display1.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_two_fifth.ad_margin .title-info-post a:hover,
						.woocommerceheaderproducts.wpmp_post_display1.wpmepack-header-'.$instance.' .icon-calendar {
							color:'.$maincolor.';
						}
						.woocommerceheaderproducts.wpmp_post_display1.wpmepack-header-'.$instance.' .share a:hover,
						.woocommerceheaderproducts.wpmp_post_display1.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_three_fifth.big-post .info-post a:hover, 
						.woocommerceheaderproducts.wpmp_post_display1.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_two_fifth.ad_margin .info-post a:hover,  
						.woocommerceheaderproducts.wpmp_post_display1.wpmepack-header-'.$instance.' .share .icon a:hover,
						.woocommerceheaderproducts.wpmp_post_display1.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_three_fifth.big-post .info-post span:hover,
						.woocommerceheaderproducts.wpmp_post_display1.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_two_fifth.ad_margin .info-post span:hover {
							color:'.$thirdcolor.';
						}';
		
		} else {
			
			$return .= '.woocommerceheaderproducts.wpmp_post_display1_bis.wpmepack-header-'.$instance.' .separator {
							color:'.$secondcolor.';
						}
						.woocommerceheaderproducts.wpmp_post_display1_bis.wpmepack-header-'.$instance.' .category a {
							border-left:5px solid '.$maincolor.';
						}
						.woocommerceheaderproducts.wpmp_post_display1_bis.wpmepack-header-'.$instance.' .category a:hover,
						.woocommerceheaderproducts.wpmp_post_display1_bis.wpmepack-header-'.$instance.' .share,
						.woocommerceheaderproducts.wpmp_post_display1_bis.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_three_fifth.big-post .info-post, 
						.woocommerceheaderproducts.wpmp_post_display1_bis.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_two_fifth.ad_margin .info-post {
							background:'.$maincolor.';
						}
						.woocommerceheaderproducts.wpmp_post_display1_bis.wpmepack-header-'.$instance.' .icon-calendar,
						.woocommerceheaderproducts.wpmp_post_display1_bis.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_three_fifth.big-post .title-info-post a:hover, 
						.woocommerceheaderproducts.wpmp_post_display1_bis.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_two_fifth.ad_margin .title-info-post a:hover {
							color:'.$maincolor.';
						}
						.woocommerceheaderproducts.wpmp_post_display1_bis.wpmepack-header-'.$instance.' .share a:hover,
						.woocommerceheaderproducts.wpmp_post_display1_bis.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_three_fifth.big-post .info-post a:hover, 
						.woocommerceheaderproducts.wpmp_post_display1_bis.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_two_fifth.ad_margin .info-post a:hover,  
						.woocommerceheaderproducts.wpmp_post_display1_bis.wpmepack-header-'.$instance.' .share .icon a:hover,
						.woocommerceheaderproducts.wpmp_post_display1_bis.wpmepack-header-'.$instance.' .category a:hover  {
							color:'.$thirdcolor.';
						}';
						
		}	
		
	}
	
	if($type == 'type2') {
		
		if($layout == 'layout1') {
		
			$return .= '.woocommerceheaderproducts.wpmp_post_display2.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_one_third.ad_margin .box-post,
						.woocommerceheaderproducts.wpmp_post_display2.wpmepack-header-'.$instance.' .ad_one_one .category a,
						.woocommerceheaderproducts.wpmp_post_display2.wpmepack-header-'.$instance.' .ad_one_third .category a,
						.woocommerceheaderproducts.wpmp_post_display2.wpmepack-header-'.$instance.' .category a:hover,
						.woocommerceheaderproducts.wpmp_post_display2.wpmepack-header-'.$instance.' .share,
						.woocommerceheaderproducts.wpmp_post_display2.wpmepack-header-'.$instance.' .share a,
						.woocommerceheaderproducts.wpmp_post_display2.wpmepack-header-'.$instance.' .share-icon:hover,
						.woocommerceheaderproducts.wpmp_post_display2.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_one_one.ad_last.big-post .title-info-post a,
						.woocommerceheaderproducts.wpmp_post_display2.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_one_one.ad_last.big-post i,
						.woocommerceheaderproducts.wpmp_post_display2.wpmepack-header-'.$instance.' .separator,
						.woocommerceheaderproducts.wpmp_post_display2.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_one_one.ad_last.big-post .title-info-post span {
							color:'.$secondcolor.';
						}
						.woocommerceheaderproducts.wpmp_post_display2.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_one_third.ad_margin {
							background:'.$secondcolor.';
						}
						.woocommerceheaderproducts.wpmp_post_display2.wpmepack-header-'.$instance.' .ad_one_one .category a {
							border-left:5px solid '.$maincolor.';
						}
						.woocommerceheaderproducts.wpmp_post_display2.wpmepack-header-'.$instance.' .ad_one_third .category a {
							border-right:5px solid '.$maincolor.';
						}
						.woocommerceheaderproducts.wpmp_post_display2.wpmepack-header-'.$instance.' .category a:hover,
						.woocommerceheaderproducts.wpmp_post_display2.wpmepack-header-'.$instance.' .share,
						.woocommerceheaderproducts.wpmp_post_display2.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_one_one.ad_last.big-post .info-post {
							background:'.$maincolor.';
						}
						.woocommerceheaderproducts.wpmp_post_display2.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_one_one.ad_last.big-post .title-info-post a:hover,
						.woocommerceheaderproducts.wpmp_post_display2.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_one_third.ad_margin .box-post:hover .title-info-post .title-post a,
						.woocommerceheaderproducts.wpmp_post_display2.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_one_third.ad_margin .data:hover,
						.woocommerceheaderproducts.wpmp_post_display2.wpmepack-header-'.$instance.' .icon-calendar {
							color:'.$maincolor.';
						}
						.woocommerceheaderproducts.wpmp_post_display2.wpmepack-header-'.$instance.' .share a:hover,
						.woocommerceheaderproducts.wpmp_post_display2.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_one_one.ad_last.big-post .info-post a:hover {
							color:'.$thirdcolor.';
						}
			';
		
		} else {
			
			$return .= '.woocommerceheaderproducts.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .ad_one_one .category a {
							border-left:5px solid '.$maincolor.';
						}
						.woocommerceheaderproducts.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .ad_one_third .category a {
							border-top: 2px solid '.$maincolor.';
						}
						.woocommerceheaderproducts.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .category a:hover,
						.woocommerceheaderproducts.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .share,
						.woocommerceheaderproducts.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_one_one.ad_last.big-post .info-post {
							background:'.$maincolor.';
						}
						.woocommerceheaderproducts.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_one_one.ad_last.big-post .title-info-post a:hover,
						.woocommerceheaderproducts.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_one_one.ad_last.big-post .title-info-post a:hover,
						.woocommerceheaderproducts.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_one_third.ad_margin .box-post:hover .title-info-post .title-post a,
						.woocommerceheaderproducts.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_one_third.ad_margin .data:hover,
						.woocommerceheaderproducts.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .icon-calendar {
							color:'.$maincolor.';
						}
						.woocommerceheaderproducts.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_one_third.ad_margin .box-post,
						.woocommerceheaderproducts.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_one_third.ad_margin.second,
						.woocommerceheaderproducts.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_one_third.ad_margin.third {
							background:'.$secondcolor.';
						}
						.woocommerceheaderproducts.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .ad_one_one .category a,
						.woocommerceheaderproducts.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .ad_one_third .category a,					
						.woocommerceheaderproducts.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .share,
						.woocommerceheaderproducts.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .share a,
						.woocommerceheaderproducts.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .share-icon:hover,
						.woocommerceheaderproducts.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_one_one.ad_last.big-post .title-info-post a,
						.woocommerceheaderproducts.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_one_one.ad_last.big-post .title-info-post span,
						.woocommerceheaderproducts.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_one_one.ad_last.big-post .info-post a,
						.woocommerceheaderproducts.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_one_one.ad_last.big-post .info-post span,
						.woocommerceheaderproducts.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_one_one.ad_last.big-post i,
						.woocommerceheaderproducts.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .separator {
							color:'.$secondcolor.';
						}				
						.woocommerceheaderproducts.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .share a:hover,
						.woocommerceheaderproducts.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_one_one.ad_last.big-post .info-post a:hover,
						.woocommerceheaderproducts.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .category a:hover,
						.woocommerceheaderproducts.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_one_third.ad_margin .data,
						.woocommerceheaderproducts.wpmp_post_display2_bis.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_one_third.ad_margin .title-info-post h4 a {
							color:'.$thirdcolor.';
						}';
			
		}
		
	}	
	
	if($type == 'type3') {
		
		if($layout == 'layout1') {
		
			$return .= '.woocommerceheaderproducts.wpmp_post_display3.wpmepack-header-'.$instance.' .category a {
							border-left:5px solid '.$maincolor.';
						}
						.woocommerceheaderproducts.wpmp_post_display3.wpmepack-header-'.$instance.' .category a:hover,
						.woocommerceheaderproducts.wpmp_post_display3.wpmepack-header-'.$instance.' .share,
						.woocommerceheaderproducts.wpmp_post_display3.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_three_fifth.big-post .info-post, 
						.woocommerceheaderproducts.wpmp_post_display3.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_two_fifth.ad_margin .info-post {
							background:'.$maincolor.';
						}
						.woocommerceheaderproducts.wpmp_post_display3.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_three_fifth.big-post .title-info-post a:hover, 
						.woocommerceheaderproducts.wpmp_post_display3.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_one_fifth.ad_margin .title-info-post a:hover, 
						.woocommerceheaderproducts.wpmp_post_display3.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_two_fifth.ad_margin .title-info-post a:hover,
						.woocommerceheaderproducts.wpmp_post_display3.wpmepack-header-'.$instance.' .icon-calendar {
							color:'.$maincolor.';
						}
						.woocommerceheaderproducts.wpmp_post_display3.wpmepack-header-'.$instance.' .category a,
						.woocommerceheaderproducts.wpmp_post_display3.wpmepack-header-'.$instance.' .share,
						.woocommerceheaderproducts.wpmp_post_display3.wpmepack-header-'.$instance.' .share a,
						.woocommerceheaderproducts.wpmp_post_display3.wpmepack-header-'.$instance.' .share-icon:hover,
						.woocommerceheaderproducts.wpmp_post_display3.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_three_fifth.big-post .title-info-post a, 
						.woocommerceheaderproducts.wpmp_post_display3.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_one_fifth.ad_margin .title-info-post a, 
						.woocommerceheaderproducts.wpmp_post_display3.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_two_fifth.ad_margin .title-info-post a, 
						.woocommerceheaderproducts.wpmp_post_display3.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item .title-info-post span,
						.woocommerceheaderproducts.wpmp_post_display3.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_three_fifth.big-post i, 
						.woocommerceheaderproducts.wpmp_post_display3.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_two_fifth.ad_margin i, 
						.woocommerceheaderproducts.wpmp_post_display3.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_two_fifth.ad_margin .info-post,
						.woocommerceheaderproducts.wpmp_post_display3.wpmepack-header-'.$instance.' .separator {
							color:'.$secondcolor.';
						}
						.woocommerceheaderproducts.wpmp_post_display3.wpmepack-header-'.$instance.' .share a:hover,
						.woocommerceheaderproducts.wpmp_post_display3.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_three_fifth.big-post .info-post a:hover, 
						.woocommerceheaderproducts.wpmp_post_display3.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_two_fifth.ad_margin .info-post a:hover,  
						.woocommerceheaderproducts.wpmp_post_display3.wpmepack-header-'.$instance.' .share .icon a:hover,
						.woocommerceheaderproducts.wpmp_post_display3.wpmepack-header-'.$instance.' .category a:hover {
							color:'.$thirdcolor.';
						}						
						';
		
		} else {
			
			$return .= '.woocommerceheaderproducts.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .category a,
						.woocommerceheaderproducts.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .share,
						.woocommerceheaderproducts.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .ad_one_fifth .share,
						.woocommerceheaderproducts.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .ad_one_fifth .share a,
						.woocommerceheaderproducts.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .share a,
						.woocommerceheaderproducts.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .share-icon:hover,
						.woocommerceheaderproducts.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_three_fifth.big-post .title-info-post a, 
						.woocommerceheaderproducts.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_one_fifth.ad_margin .title-info-post a, 
						.woocommerceheaderproducts.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_two_fifth.ad_margin .title-info-post a,
						.woocommerceheaderproducts.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_three_fifth.big-post .title-info-post span,
						.woocommerceheaderproducts.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_two_fifth.ad_margin .title-info-post span,
						.woocommerceheaderproducts.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_three_fifth.big-post i, 
						.woocommerceheaderproducts.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_two_fifth.ad_margin i,
						.woocommerceheaderproducts.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_three_fifth.big-post .info-post a, 
						.woocommerceheaderproducts.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_two_fifth .info-post a,
						.woocommerceheaderproducts.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_three_fifth.big-post .info-post span,
						.woocommerceheaderproducts.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_two_fifth .info-post span,						
						.woocommerceheaderproducts.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_one_fifth.big-post .title-info-post span,
						.woocommerceheaderproducts.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_one_fifth.ad_margin .title-info-post span,
						.woocommerceheaderproducts.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .separator,
						.woocommerceheaderproducts.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .data {
							color:'.$secondcolor.';
						}
						.woocommerceheaderproducts.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .category a {
							border-left:5px solid '.$maincolor.';
						}
						.woocommerceheaderproducts.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .category a:hover,
						.woocommerceheaderproducts.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .share,
						.woocommerceheaderproducts.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .ad_one_fifth .share,
						.woocommerceheaderproducts.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_three_fifth.big-post .info-post, 
						.woocommerceheaderproducts.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_two_fifth.ad_margin .info-post {
							background:'.$maincolor.';
						}
						.woocommerceheaderproducts.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_three_fifth.big-post .title-info-post a:hover, 
						.woocommerceheaderproducts.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_one_fifth.ad_margin .title-info-post a:hover, 
						.woocommerceheaderproducts.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_two_fifth.ad_margin .title-info-post a:hover,
						.woocommerceheaderproducts.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .icon-calendar {
							color:'.$maincolor.';
						}
						.woocommerceheaderproducts.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .share a:hover,
						.woocommerceheaderproducts.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_three_fifth.big-post .info-post a:hover, 
						.woocommerceheaderproducts.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_two_fifth.ad_margin .info-post a:hover,  
						.woocommerceheaderproducts.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .share .icon a:hover,
						.woocommerceheaderproducts.wpmp_post_display3_bis.wpmepack-header-'.$instance.' .category a:hover {
							color:'.$thirdcolor.';
						}';
							
		}
		
	}
	
	if($type == 'type4') {
		
		if($layout == 'layout1') {
		
			$return .= '.woocommerceheaderproducts.wpmp_post_display4.wpmepack-header-'.$instance.'  .ad_one_one .category a {
							border-left:5px solid '.$maincolor.';
						}
						.woocommerceheaderproducts.wpmp_post_display4.wpmepack-header-'.$instance.'  .ad_one_third .category a {
							border-right:5px solid '.$maincolor.';
						}
						.woocommerceheaderproducts.wpmp_post_display4.wpmepack-header-'.$instance.'  .category a:hover,
						.woocommerceheaderproducts.wpmp_post_display4.wpmepack-header-'.$instance.'  .share {
							background:'.$maincolor.';
						}
						.woocommerceheaderproducts.wpmp_post_display4.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_one_one.ad_last.big-post .title-info-post a:hover,
						.woocommerceheaderproducts.wpmp_post_display4.wpmepack-header-'.$instance.' .icon-calendar,
						.woocommerceheaderproducts.wpmp_post_display4.wpmepack-header-'.$instance.' .owl-controls .owl-nav [class*="owl-"]:hover {
							color:'.$maincolor.';
						}
						.woocommerceheaderproducts.wpmp_post_display4.wpmepack-header-'.$instance.' .ad_one_one .category a,
						.woocommerceheaderproducts.wpmp_post_display4.wpmepack-header-'.$instance.' .ad_one_third .category a,
						.woocommerceheaderproducts.wpmp_post_display4.wpmepack-header-'.$instance.' .share,
						.woocommerceheaderproducts.wpmp_post_display4.wpmepack-header-'.$instance.' .share a,
						.woocommerceheaderproducts.wpmp_post_display4.wpmepack-header-'.$instance.' .share-icon:hover,
						.woocommerceheaderproducts.wpmp_post_display4.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_one_one.ad_last.big-post .title-info-post a,
						.woocommerceheaderproducts.wpmp_post_display4.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_one_one.ad_last.big-post i,
						.woocommerceheaderproducts.wpmp_post_display4.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_one_one.ad_last.big-post .title-info-post span,
						.woocommerceheaderproducts.wpmp_post_display4.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_one_one.ad_last.big-post .title-info-post .category a:hover	{
							color:'.$secondcolor.';
						}
						.woocommerceheaderproducts.wpmp_post_display4.wpmepack-header-'.$instance.' .share a:hover,
						.woocommerceheaderproducts.wpmp_post_display4.wpmepack-header-'.$instance.' .category a:hover {
							color:'.$thirdcolor.'!important;
						}					
						';
						
		} else {
			
			$return .= '.woocommerceheaderproducts.wpmp_post_display4_bis.wpmepack-header-'.$instance.'  .ad_one_one .category a {
							border-left:5px solid '.$maincolor.';
						}
						.woocommerceheaderproducts.wpmp_post_display4_bis.wpmepack-header-'.$instance.'  .ad_one_third .category a {
							border-right:5px solid '.$maincolor.';
						}
						.woocommerceheaderproducts.wpmp_post_display4_bis.wpmepack-header-'.$instance.'  .category a:hover,
						.woocommerceheaderproducts.wpmp_post_display4_bis.wpmepack-header-'.$instance.'  .share {
							background:'.$maincolor.';
						}
						.woocommerceheaderproducts.wpmp_post_display4_bis.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_one_one.ad_last.big-post .title-info-post a:hover,
						.woocommerceheaderproducts.wpmp_post_display4_bis.wpmepack-header-'.$instance.' .icon-calendar,
						.woocommerceheaderproducts.wpmp_post_display4_bis.wpmepack-header-'.$instance.' .owl-controls .owl-nav [class*="owl-"]:hover {
							color:'.$maincolor.';
						}
						.woocommerceheaderproducts.wpmp_post_display4_bis.wpmepack-header-'.$instance.' .ad_one_one .category a,
						.woocommerceheaderproducts.wpmp_post_display4_bis.wpmepack-header-'.$instance.' .ad_one_third .category a,
						.woocommerceheaderproducts.wpmp_post_display4_bis.wpmepack-header-'.$instance.' .share,
						.woocommerceheaderproducts.wpmp_post_display4_bis.wpmepack-header-'.$instance.' .share a,
						.woocommerceheaderproducts.wpmp_post_display4_bis.wpmepack-header-'.$instance.' .share-icon:hover,
						.woocommerceheaderproducts.wpmp_post_display4_bis.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_one_one.ad_last.big-post .title-info-post a,
						.woocommerceheaderproducts.wpmp_post_display4_bis.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_one_one.ad_last.big-post i,
						.woocommerceheaderproducts.wpmp_post_display4_bis.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_one_one.ad_last.big-post .title-info-post span	{
							color:'.$secondcolor.';
						}
						.woocommerceheaderproducts.wpmp_post_display4_bis.wpmepack-header-'.$instance.' .share a:hover,
						.woocommerceheaderproducts.wpmp_post_display4_bis.wpmepack-header-'.$instance.' .category a:hover {
							color:'.$thirdcolor.'!important;
						}					
						';
			
		}
	}
	
	if($type == 'type5') {
		
		if($layout == 'layout1') {
		
			$return .= '.woocommerceheaderproducts.wpmp_post_display5.wpmepack-header-'.$instance.' .ad_one_one .category a {
							border-left:5px solid '.$maincolor.';
						}
						.woocommerceheaderproducts.wpmp_post_display5.wpmepack-header-'.$instance.' .ad_one_third .category a {
							border-right:5px solid '.$maincolor.';
						}
						.woocommerceheaderproducts.wpmp_post_display5.wpmepack-header-'.$instance.' .category a:hover,
						.woocommerceheaderproducts.wpmp_post_display5.wpmepack-header-'.$instance.' .share,
						.woocommerceheaderproducts.wpmp_post_display5.wpmepack-header-'.$instance.' .share .info-comments {
							background:'.$maincolor.';
						}
						.woocommerceheaderproducts.wpmp_post_display5.wpmepack-header-'.$instance.' .info-post i,
						.woocommerceheaderproducts.wpmp_post_display5.wpmepack-header-'.$instance.' .title-info-post.ad_one_half a:hover,
						.woocommerceheaderproducts.wpmp_post_display5.wpmepack-header-'.$instance.' .icon-calendar,
						.wpmp_post_display5.wpmepack-header-'.$instance.' .mini-post .title-post a:hover,
						.wpmp_post_display5.wpmepack-header-'.$instance.' .mini-post .info-post a:hover  {
							color:'.$maincolor.';
						}';
	
			$return .= '.woocommerceheaderproducts.wpmp_post_display5.wpmepack-header-'.$instance.' .ad_one_one .category a,
						.woocommerceheaderproducts.wpmp_post_display5.wpmepack-header-'.$instance.' .ad_one_third .category a,
						.woocommerceheaderproducts.wpmp_post_display5.wpmepack-header-'.$instance.' .category a:hover,
						.woocommerceheaderproducts.wpmp_post_display5.wpmepack-header-'.$instance.' .share,
						.woocommerceheaderproducts.wpmp_post_display5.wpmepack-header-'.$instance.' .title-info-post.ad_one_half p,
						.woocommerceheaderproducts.wpmp_post_display5.wpmepack-header-'.$instance.' .info-post a,
						.woocommerceheaderproducts.wpmp_post_display5.wpmepack-header-'.$instance.' .title-info-post.ad_one_half span,
						.woocommerceheaderproducts.wpmp_post_display5.wpmepack-header-'.$instance.' .separator,
						.woocommerceheaderproducts.wpmp_post_display5.wpmepack-header-'.$instance.' .view,
						.woocommerceheaderproducts.wpmp_post_display5.wpmepack-header-'.$instance.' .share a,
						.woocommerceheaderproducts.wpmp_post_display5.wpmepack-header-'.$instance.' .share-icon:hover,
						.woocommerceheaderproducts.wpmp_post_display5.wpmepack-header-'.$instance.' .title-info-post.ad_one_half a,
						.woocommerceheaderproducts.wpmp_post_display5.wpmepack-header-'.$instance.' .title-info-post.ad_one_half span,
						.woocommerceheaderproducts.wpmp_post_display5.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_one_one.ad_last.big-post i,
						.wpmp_post_display5.wpmepack-header-'.$instance.' .mini-post .title-post a {
							color:'.$secondcolor.';
						}';
			
			$return .= '.woocommerceheaderproducts.wpmp_post_display5.wpmepack-header-'.$instance.',
						.woocommerceheaderproducts.wpmp_post_display5.wpmepack-header-'.$instance.' .ad_one_third .category a {
							background:'.$thirdcolor.';
						}';
		
		} else {
			
			$return .= '.woocommerceheaderproducts.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .ad_one_one .category a {
							border-left:5px solid '.$maincolor.';
						}
						.woocommerceheaderproducts.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .ad_one_one .category a {
							border-right:5px solid '.$maincolor.';
						}
						.woocommerceheaderproducts.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .category a:hover,
						.woocommerceheaderproducts.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .share,
						.woocommerceheaderproducts.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .share .info-comments {
							background:'.$maincolor.';
						}
						.woocommerceheaderproducts.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .info-post i,
						.woocommerceheaderproducts.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .title-info-post.ad_one_half a:hover,
						.woocommerceheaderproducts.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .icon-calendar,
						.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .mini-post .title-post a:hover,
						.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .mini-post .info-post a:hover  {
							color:'.$maincolor.';
						}';
	
			$return .= '.woocommerceheaderproducts.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .ad_one_one .category a,
						.woocommerceheaderproducts.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .ad_one_third .category a,
						.woocommerceheaderproducts.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .category a:hover,
						.woocommerceheaderproducts.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .share,
						.woocommerceheaderproducts.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .title-info-post.ad_one_half p,
						.woocommerceheaderproducts.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .info-post a,
						.woocommerceheaderproducts.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .title-info-post.ad_one_half span,
						.woocommerceheaderproducts.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .separator,
						.woocommerceheaderproducts.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .view,
						.woocommerceheaderproducts.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .share a,
						.woocommerceheaderproducts.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .share-icon:hover,
						.woocommerceheaderproducts.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .title-info-post.ad_one_half a,
						.woocommerceheaderproducts.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .title-info-post.ad_one_half span,
						.woocommerceheaderproducts.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .woocommerceheaderproducts-item.ad_one_one.ad_last.big-post i,
						.wpmp_post_display5.wpmepack-header-'.$instance.' .mini-post .title-post a {
							color:'.$secondcolor.';
						}';
			
			$return .= '.woocommerceheaderproducts.wpmp_post_display5_bis.wpmepack-header-'.$instance.',
						.woocommerceheaderproducts.wpmp_post_display5_bis.wpmepack-header-'.$instance.' .ad_one_third .category a {
							background:'.$thirdcolor.';
						}';
						
		}
		
		
	}
	
	$return .= '.woocommerceheaderproducts .cart-button-container a,
				.woocommerceheaderproducts .info-post {
					background:'.$maincolor.'!important;
				}
				.woocommerceheaderproducts .cart-button-container a,
				.woocommerceheaderproducts .info-post {
					color:'.$secondcolor.';
				}
				.woocommerceheaderproducts .cart-button-container a:hover,
				.woocommerceheaderproducts .info-post:hover {
					color:'.$thirdcolor.'!important;
				}				
				';
	
	$return .= '</style>';
	
	
	return $return;
}

/** Post Social Share **/
if(!function_exists('ewmp_woocommerceheaderproducts_post_social_share')) {
	function ewmp_woocommerceheaderproducts_post_social_share($css_link = '') {
		
		$return = '<div class="share">
			<div class="icon">	
				<a target="_blank" href="http://www.facebook.com/sharer.php?u='.get_the_permalink().'&amp;t='.get_the_title().'" title="'.esc_html__('Click to share this post on Facebook','woocommerceheaderproductselementor').'" '.$css_link.'><i class="icon-facebook2"></i></a>
				<a target="_blank" href="http://twitter.com/home?status='.get_the_permalink().'" title="'.esc_html__('Click to share this post on Twitter','woocommerceheaderproductselementor').'"><i class="icon-twitter" '.$css_link.'></i></a>
				<a target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&amp;url='.get_the_permalink().'" title="'.esc_html__('Click to share this post on Linkedin','woocommerceheaderproductselementor').'"><i class="icon-linkedin" '.$css_link.'></i></a>
				<a href="#" class="share-icon icon-rocket"></a>
			</div>	
		</div>';
		
		return $return;
	}
}

function ewmp_woocommerceproductsgallery_elementor_photoswipe_style($rgba_main_color,
						  $fg_main_color,
						  $fg_secondary_color,
						  $rgba_secondary_color,
						  $fg_pagination_active,
						  $fg_spacing_active, 
						  $fg_spacing, 
						  $fg_image_lightbox, 
						  $selector, 
						  $fg_gallery_name_font_size, 
						  $fg_gallery_name_font_color, 
						  $fg_gallery_name_text_align,
						  $float,
						  $itemwidth,
						  $fg_gallery_name_show
						  ) {
							  
							  
				$gallery_style = "
				<style type='text/css'>
					#{$selector} {
					margin: auto;
					}
					#{$selector} .fg-gallery-item {
					float: {$float};
					margin-top: 10px;
					text-align: center;
					width: {$itemwidth}%;
					}
					#{$selector} .fg-gallery-caption {
					margin-left: 0;
					}
					#{$selector}.woocommerceproductsgallery .fg-gallery-caption, 
					#{$selector}.woocommerceproductsgallery .fg-gallery-caption:hover {
						background-color:".$rgba_main_color.";
					}
					#{$selector}.woocommerceproductsgallery.gallery .woocommerceproductsgallery-gallery-icon.fg_zoom a, 
					#{$selector}.woocommerceproductsgallery.gallery .woocommerceproductsgallery-gallery-icon.fg_zoom a:hover {
						color:".$fg_main_color.";
					}
					#{$selector}.woocommerceproductsgallery.fg_style1 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}
					#{$selector}.woocommerceproductsgallery.gallery.fg_style2 .woocommerceproductsgallery-gallery-icon.fg_zoom a {
						background:".$rgba_secondary_color.";
					}
					#{$selector}.woocommerceproductsgallery.fg_style2 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}			
					#{$selector}.woocommerceproductsgallery.gallery.fg_style3 .fg_zoom, 
					#{$selector}.woocommerceproductsgallery.gallery.fg_style3 .fg_zoom:hover {
						background:".$rgba_main_color.";
					}
					#{$selector}.woocommerceproductsgallery.fg_style3 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}				
					#{$selector}.woocommerceproductsgallery.fg_style4 .fg-gallery-caption,			
					#{$selector}.woocommerceproductsgallery.gallery.fg_style4 .woocommerceproductsgallery-gallery-icon.fg_zoom a, 
					#{$selector}.woocommerceproductsgallery.gallery.fg_style4 .woocommerceproductsgallery-gallery-icon.fg_zoom a:hover {
						color:".$fg_secondary_color.";
					}
					#{$selector}.woocommerceproductsgallery.gallery.fg_style4 .woocommerceproductsgallery-gallery-icon.fg_zoom a, 
					#{$selector}.woocommerceproductsgallery.gallery.fg_style4 .woocommerceproductsgallery-gallery-icon.fg_zoom a:hover,
					#{$selector}.woocommerceproductsgallery.gallery.fg_style4 .fg-photoswipe .woocommerceproductsgallery-mask	{
						background:".$rgba_main_color.";
					}			
					#{$selector}.woocommerceproductsgallery.gallery.fg_style5 .woocommerceproductsgallery-gallery-icon.fg_zoom a, 
					#{$selector}.woocommerceproductsgallery.gallery.fg_style5 .woocommerceproductsgallery-gallery-icon.fg_zoom a:hover {
						color:".$fg_secondary_color.";
					}
					#{$selector}.woocommerceproductsgallery.gallery.fg_style5 .fg-photoswipe .woocommerceproductsgallery-mask	{
						background-color:".$rgba_main_color.";
					}											
					#{$selector}.woocommerceproductsgallery.gallery.fg_style6 .woocommerceproductsgallery-gallery-icon.fg_zoom a,
					#{$selector}.woocommerceproductsgallery.gallery.fg_style6 .woocommerceproductsgallery-gallery-icon.fg_zoom a:hover {
						color:".$fg_secondary_color.";
						background:".$rgba_main_color.";				
					}
					#{$selector}.woocommerceproductsgallery.gallery.fg_style6 .fg-photoswipe .woocommerceproductsgallery-mask	{
						background:".$rgba_main_color.";
					}				
					#{$selector}.woocommerceproductsgallery.fg_style6 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}
					#{$selector}.woocommerceproductsgallery.gallery.fg_style7 .woocommerceproductsgallery-gallery-icon.fg_zoom a,
					#{$selector}.woocommerceproductsgallery.gallery.fg_style7 .woocommerceproductsgallery-gallery-icon.fg_zoom a:hover {
						color:".$fg_secondary_color.";
						background:".$rgba_main_color.";				
					}
					#{$selector}.woocommerceproductsgallery.gallery.fg_style7 .fg-photoswipe .woocommerceproductsgallery-mask	{
						background:".$rgba_main_color.";
					}		
					#{$selector}.woocommerceproductsgallery.fg_style7 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}
					
					#{$selector}.woocommerceproductsgallery.gallery.fg_style8 .woocommerceproductsgallery-gallery-icon.fg_zoom a,
					#{$selector}.woocommerceproductsgallery.gallery.fg_style8 .woocommerceproductsgallery-gallery-icon.fg_zoom a:hover {
						color:".$fg_secondary_color.";
						background:".$rgba_main_color.";				
					}

					#{$selector}.woocommerceproductsgallery.gallery.fg_style8 .fg-photoswipe .woocommerceproductsgallery-mask	{
						background:".$rgba_main_color.";
					}	
				
					#{$selector}.woocommerceproductsgallery.fg_style8 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}
					
					#{$selector}.woocommerceproductsgallery.gallery.fg_style9 .woocommerceproductsgallery-gallery-icon.fg_zoom a,
					#{$selector}.woocommerceproductsgallery.gallery.fg_style9 .woocommerceproductsgallery-gallery-icon.fg_zoom a:hover {
						color:".$fg_secondary_color.";				
					}
					#{$selector}.woocommerceproductsgallery.gallery.fg_style9 .fg-photoswipe .woocommerceproductsgallery-mask	{
						background:".$rgba_main_color.";
					}							
					#{$selector}.woocommerceproductsgallery.fg_style9 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}
					
					#{$selector}.woocommerceproductsgallery.gallery.fg_style10 .woocommerceproductsgallery-gallery-icon.fg_zoom a,
					#{$selector}.woocommerceproductsgallery.gallery.fg_style10 .woocommerceproductsgallery-gallery-icon.fg_zoom a:hover {
						color:".$fg_secondary_color.";
						background:".$rgba_main_color.";				
					}
					#{$selector}.woocommerceproductsgallery.gallery.fg_style10 .fg-photoswipe .woocommerceproductsgallery-mask	{
						background:".$rgba_main_color.";
					}							
					#{$selector}.woocommerceproductsgallery.fg_style10 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}
					#{$selector}.woocommerceproductsgallery.fg_style11 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}
					#{$selector}.woocommerceproductsgallery.fg_style11 .woocommerceproductsgallery-gallery-icon.fg_zoom a, 
					#{$selector}.woocommerceproductsgallery.fg_style11 .woocommerceproductsgallery-gallery-icon.fg_zoom a:hover {
						color:".$fg_main_color.";
						background:".$rgba_secondary_color.";
					}
					#{$selector}.woocommerceproductsgallery.fg_style12 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}
					#{$selector}.woocommerceproductsgallery.fg_style12 .woocommerceproductsgallery-gallery-icon.fg_zoom a, 
					#{$selector}.woocommerceproductsgallery.fg_style12 .woocommerceproductsgallery-gallery-icon.fg_zoom a:hover {
						color:".$fg_main_color.";
						background:".$rgba_secondary_color.";
					}																									
					/* THUMBS ONE ON */
					#{$selector}.woocommerceproductsgallery.fg_thumbs_one .fg-gallery-item {
						display:none;
					}
					#{$selector}.woocommerceproductsgallery.fg_thumbs_one .fg-gallery-item:first-child {
						display:block;
					}
					#{$selector}.woocommerceproductsgallery.fg_thumbs_one {
						width:auto!important;
					}
				";
				
				if($fg_pagination_active == 'on') {
					$gallery_style .= "
						#{$selector}.woocommerceproductsgallery.fg_pagination_style1 ul.fg_pagination li a {
							background:".$rgba_main_color.";
							color:".$fg_secondary_color.";
						}
						#{$selector}.woocommerceproductsgallery.fg_pagination_style1 ul.fg_pagination li a:hover {
							background:".$fg_secondary_color.";
							color:".$rgba_main_color.";
						}
						#{$selector}.woocommerceproductsgallery.fg_pagination_style1 ul.fg_pagination li.fg_current {
							background:".$fg_secondary_color.";
							color:".$rgba_main_color.";
						}
						#{$selector}.woocommerceproductsgallery.fg_pagination_style2 ul.fg_pagination li a {
							color:".$fg_secondary_color.";
						}
						#{$selector}.woocommerceproductsgallery.fg_pagination_style2 ul.fg_pagination li a:hover {
							color:".$rgba_main_color.";
						}
						#{$selector}.woocommerceproductsgallery.fg_pagination_style2 ul.fg_pagination li.fg_current {
							color:".$rgba_main_color.";
						}																		
					";
				}
				
				
				
				
				if($fg_spacing_active == 'on') {
					$gallery_style .= "
						.woocommerceproductsgallery.gallery {
							width:100%;
							width: -webkit-calc(100% + ".$fg_spacing."px);
							width: calc(100% + ".$fg_spacing."px);
							/*margin-left:".$fg_spacing."px;*/
						}
						.woocommerceproductsgallery .fg-gallery-item {
							margin-right:".$fg_spacing."px!important;
							margin-bottom:".$fg_spacing."px!important;
						}
						.woocommerceproductsgallery.gallery-columns-2 .fg-gallery-item {
							max-width: 48%;
							max-width: -webkit-calc(50% - ".$fg_spacing."px);
							max-width:         calc(50% - ".$fg_spacing."px);
						}
						
						.woocommerceproductsgallery.gallery-columns-3 .fg-gallery-item {
							max-width: 32%;
							max-width: -webkit-calc(33.3% - ".$fg_spacing."px);
							max-width:         calc(33.3% - ".$fg_spacing."px);
						}
						
						.woocommerceproductsgallery.gallery-columns-4 .fg-gallery-item {
							max-width: 23%;
							max-width: -webkit-calc(25% - ".$fg_spacing."px);
							max-width:         calc(25% - ".$fg_spacing."px);
						}
						
						.woocommerceproductsgallery.gallery-columns-5 .fg-gallery-item {
							max-width: 19%;
							max-width: -webkit-calc(20% - ".$fg_spacing."px);
							max-width:         calc(20% - ".$fg_spacing."px);
						}
						
						.woocommerceproductsgallery.gallery-columns-6 .fg-gallery-item {
							max-width: 15%;
							max-width: -webkit-calc(16.7% - ".$fg_spacing."px);
							max-width:         calc(16.7% - ".$fg_spacing."px);
						}
						
						.woocommerceproductsgallery.gallery-columns-7 .fg-gallery-item {
							max-width: 13%;
							max-width: -webkit-calc(14.28% - ".$fg_spacing."px);
							max-width:         calc(14.28% - ".$fg_spacing."px);
						}
						
						.woocommerceproductsgallery.gallery-columns-8 .fg-gallery-item {
							max-width: 11%;
							max-width: -webkit-calc(12.5% - ".$fg_spacing."px);
							max-width:         calc(12.5% - ".$fg_spacing."px);
						}
						
						.woocommerceproductsgallery.gallery-columns-9 .fg-gallery-item {
							max-width: 9%;
							max-width: -webkit-calc(11.1% - ".$fg_spacing."px);
							max-width:         calc(11.1% - ".$fg_spacing."px);
						}
					";
				}

				if($fg_image_lightbox == 'zoomin') {
					$gallery_style .= '#'.$selector.'.woocommerceproductsgallery .icon-plus:before {	
										content: "\e6ef"!important;
					}';
				}
				if($fg_image_lightbox == 'image') {
					$gallery_style .= '#'.$selector.'.woocommerceproductsgallery .icon-plus:before {	
										content: "\e687"!important;
					}';
				}	
				if($fg_image_lightbox == 'images') {
					$gallery_style .= '#'.$selector.'.woocommerceproductsgallery .icon-plus:before {	
										content: "\e605"!important;
					}';
				}	
				if($fg_image_lightbox == 'spinner_icon') {
					$gallery_style .= '#'.$selector.'.woocommerceproductsgallery .icon-plus:before {	
										content: "\e6e7"!important;
					}';
				}
				if($fg_image_lightbox == 'search_icon') {
					$gallery_style .= '#'.$selector.'.woocommerceproductsgallery .icon-plus:before {	
										content: "\e6ee"!important;
					}';
				}				
				
				if($fg_gallery_name_show == 'true') {
					$gallery_style .= ".fg_gallery_title-{$instance}.fg_gallery_name {
							font-size:".$fg_gallery_name_font_size."px;
							color:".$fg_gallery_name_font_color.";
							text-align:".$fg_gallery_name_text_align.";
					}";
				}
				
				$gallery_style .= "</style>";								  
							  
							  
				return $gallery_style;				  
							  
}

function ewmp_woocommerceproductsshowcase_elementor_photoswipe_style($rgba_main_color,
						  $fg_main_color,
						  $fg_secondary_color,
						  $rgba_secondary_color,
						  $fg_pagination_active,
						  $fg_spacing_active, 
						  $fg_spacing, 
						  $fg_image_lightbox, 
						  $selector, 
						  $fg_gallery_name_font_size, 
						  $fg_gallery_name_font_color, 
						  $fg_gallery_name_text_align,
						  $float,
						  $itemwidth,
						  $fg_gallery_name_show
						  ) {
							  
							  
				$gallery_style = "
				<style type='text/css'>
					#{$selector} {
					margin: auto;
					}
					#{$selector} .fg-gallery-item {
					float: {$float};
					margin-top: 10px;
					text-align: center;
					width: {$itemwidth}%;
					}
					#{$selector} .fg-gallery-caption {
					margin-left: 0;
					}
					#{$selector}.woocommerceproductsshowcase .fg-gallery-caption, 
					#{$selector}.woocommerceproductsshowcase .fg-gallery-caption:hover {
						background-color:".$rgba_main_color.";
					}
					#{$selector}.woocommerceproductsshowcase.gallery .woocommerceproductsshowcase-gallery-icon.fg_zoom a, 
					#{$selector}.woocommerceproductsshowcase.gallery .woocommerceproductsshowcase-gallery-icon.fg_zoom a:hover {
						color:".$fg_main_color.";
					}
					#{$selector}.woocommerceproductsshowcase.fg_style1 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}
					#{$selector}.woocommerceproductsshowcase.gallery.fg_style2 .woocommerceproductsshowcase-gallery-icon.fg_zoom a {
						background:".$rgba_secondary_color.";
					}
					#{$selector}.woocommerceproductsshowcase.fg_style2 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}			
					#{$selector}.woocommerceproductsshowcase.gallery.fg_style3 .fg_zoom, 
					#{$selector}.woocommerceproductsshowcase.gallery.fg_style3 .fg_zoom:hover {
						background:".$rgba_main_color.";
					}
					#{$selector}.woocommerceproductsshowcase.fg_style3 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}				
					#{$selector}.woocommerceproductsshowcase.fg_style4 .fg-gallery-caption,			
					#{$selector}.woocommerceproductsshowcase.gallery.fg_style4 .woocommerceproductsshowcase-gallery-icon.fg_zoom a, 
					#{$selector}.woocommerceproductsshowcase.gallery.fg_style4 .woocommerceproductsshowcase-gallery-icon.fg_zoom a:hover {
						color:".$fg_secondary_color.";
					}
					#{$selector}.woocommerceproductsshowcase.gallery.fg_style4 .woocommerceproductsshowcase-gallery-icon.fg_zoom a, 
					#{$selector}.woocommerceproductsshowcase.gallery.fg_style4 .woocommerceproductsshowcase-gallery-icon.fg_zoom a:hover,
					#{$selector}.woocommerceproductsshowcase.gallery.fg_style4 .fg-photoswipe .woocommerceproductsshowcase-mask	{
						background:".$rgba_main_color.";
					}			
					#{$selector}.woocommerceproductsshowcase.gallery.fg_style5 .woocommerceproductsshowcase-gallery-icon.fg_zoom a, 
					#{$selector}.woocommerceproductsshowcase.gallery.fg_style5 .woocommerceproductsshowcase-gallery-icon.fg_zoom a:hover {
						color:".$fg_secondary_color.";
					}
					#{$selector}.woocommerceproductsshowcase.gallery.fg_style5 .fg-photoswipe .woocommerceproductsshowcase-mask	{
						background-color:".$rgba_main_color.";
					}											
					#{$selector}.woocommerceproductsshowcase.gallery.fg_style6 .woocommerceproductsshowcase-gallery-icon.fg_zoom a,
					#{$selector}.woocommerceproductsshowcase.gallery.fg_style6 .woocommerceproductsshowcase-gallery-icon.fg_zoom a:hover {
						color:".$fg_secondary_color.";
						background:".$rgba_main_color.";				
					}
					#{$selector}.woocommerceproductsshowcase.gallery.fg_style6 .fg-photoswipe .woocommerceproductsshowcase-mask	{
						background:".$rgba_main_color.";
					}				
					#{$selector}.woocommerceproductsshowcase.fg_style6 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}
					#{$selector}.woocommerceproductsshowcase.gallery.fg_style7 .woocommerceproductsshowcase-gallery-icon.fg_zoom a,
					#{$selector}.woocommerceproductsshowcase.gallery.fg_style7 .woocommerceproductsshowcase-gallery-icon.fg_zoom a:hover {
						color:".$fg_secondary_color.";
						background:".$rgba_main_color.";				
					}
					#{$selector}.woocommerceproductsshowcase.gallery.fg_style7 .fg-photoswipe .woocommerceproductsshowcase-mask	{
						background:".$rgba_main_color.";
					}		
					#{$selector}.woocommerceproductsshowcase.fg_style7 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}
					
					#{$selector}.woocommerceproductsshowcase.gallery.fg_style8 .woocommerceproductsshowcase-gallery-icon.fg_zoom a,
					#{$selector}.woocommerceproductsshowcase.gallery.fg_style8 .woocommerceproductsshowcase-gallery-icon.fg_zoom a:hover {
						color:".$fg_secondary_color.";
						background:".$rgba_main_color.";				
					}

					#{$selector}.woocommerceproductsshowcase.gallery.fg_style8 .fg-photoswipe .woocommerceproductsshowcase-mask	{
						background:".$rgba_main_color.";
					}	
				
					#{$selector}.woocommerceproductsshowcase.fg_style8 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}
					
					#{$selector}.woocommerceproductsshowcase.gallery.fg_style9 .woocommerceproductsshowcase-gallery-icon.fg_zoom a,
					#{$selector}.woocommerceproductsshowcase.gallery.fg_style9 .woocommerceproductsshowcase-gallery-icon.fg_zoom a:hover {
						color:".$fg_secondary_color.";				
					}
					#{$selector}.woocommerceproductsshowcase.gallery.fg_style9 .fg-photoswipe .woocommerceproductsshowcase-mask	{
						background:".$rgba_main_color.";
					}							
					#{$selector}.woocommerceproductsshowcase.fg_style9 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}
					
					#{$selector}.woocommerceproductsshowcase.gallery.fg_style10 .woocommerceproductsshowcase-gallery-icon.fg_zoom a,
					#{$selector}.woocommerceproductsshowcase.gallery.fg_style10 .woocommerceproductsshowcase-gallery-icon.fg_zoom a:hover {
						color:".$fg_secondary_color.";
						background:".$rgba_main_color.";				
					}
					#{$selector}.woocommerceproductsshowcase.gallery.fg_style10 .fg-photoswipe .woocommerceproductsshowcase-mask	{
						background:".$rgba_main_color.";
					}							
					#{$selector}.woocommerceproductsshowcase.fg_style10 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}
					#{$selector}.woocommerceproductsshowcase.fg_style11 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}
					#{$selector}.woocommerceproductsshowcase.fg_style11 .woocommerceproductsshowcase-gallery-icon.fg_zoom a, 
					#{$selector}.woocommerceproductsshowcase.fg_style11 .woocommerceproductsshowcase-gallery-icon.fg_zoom a:hover {
						color:".$fg_main_color.";
						background:".$rgba_secondary_color.";
					}
					#{$selector}.woocommerceproductsshowcase.fg_style12 .fg-gallery-caption {
						color:".$fg_secondary_color.";	
					}
					#{$selector}.woocommerceproductsshowcase.fg_style12 .woocommerceproductsshowcase-gallery-icon.fg_zoom a, 
					#{$selector}.woocommerceproductsshowcase.fg_style12 .woocommerceproductsshowcase-gallery-icon.fg_zoom a:hover {
						color:".$fg_main_color.";
						background:".$rgba_secondary_color.";
					}																									
					/* THUMBS ONE ON */
					#{$selector}.woocommerceproductsshowcase.fg_thumbs_one .fg-gallery-item {
						display:none;
					}
					#{$selector}.woocommerceproductsshowcase.fg_thumbs_one .fg-gallery-item:first-child {
						display:block;
					}
					#{$selector}.woocommerceproductsshowcase.fg_thumbs_one {
						width:auto!important;
					}
				";
				
				if($fg_pagination_active == 'on') {
					$gallery_style .= "
						#{$selector}.woocommerceproductsshowcase.fg_pagination_style1 ul.fg_pagination li a {
							background:".$rgba_main_color.";
							color:".$fg_secondary_color.";
						}
						#{$selector}.woocommerceproductsshowcase.fg_pagination_style1 ul.fg_pagination li a:hover {
							background:".$fg_secondary_color.";
							color:".$rgba_main_color.";
						}
						#{$selector}.woocommerceproductsshowcase.fg_pagination_style1 ul.fg_pagination li.fg_current {
							background:".$fg_secondary_color.";
							color:".$rgba_main_color.";
						}
						#{$selector}.woocommerceproductsshowcase.fg_pagination_style2 ul.fg_pagination li a {
							color:".$fg_secondary_color.";
						}
						#{$selector}.woocommerceproductsshowcase.fg_pagination_style2 ul.fg_pagination li a:hover {
							color:".$rgba_main_color.";
						}
						#{$selector}.woocommerceproductsshowcase.fg_pagination_style2 ul.fg_pagination li.fg_current {
							color:".$rgba_main_color.";
						}																		
					";
				}
				
				
				
				
				if($fg_spacing_active == 'on') {
					$gallery_style .= "
						.woocommerceproductsshowcase.gallery {
							width:100%;
							width: -webkit-calc(100% + ".$fg_spacing."px);
							width: calc(100% + ".$fg_spacing."px);
							/*margin-left:".$fg_spacing."px;*/
						}
						.woocommerceproductsshowcase .fg-gallery-item {
							margin-right:".$fg_spacing."px!important;
							margin-bottom:".$fg_spacing."px!important;
						}
						.woocommerceproductsshowcase.gallery-columns-2 .fg-gallery-item {
							max-width: 48%;
							max-width: -webkit-calc(50% - ".$fg_spacing."px);
							max-width:         calc(50% - ".$fg_spacing."px);
						}
						
						.woocommerceproductsshowcase.gallery-columns-3 .fg-gallery-item {
							max-width: 32%;
							max-width: -webkit-calc(33.3% - ".$fg_spacing."px);
							max-width:         calc(33.3% - ".$fg_spacing."px);
						}
						
						.woocommerceproductsshowcase.gallery-columns-4 .fg-gallery-item {
							max-width: 23%;
							max-width: -webkit-calc(25% - ".$fg_spacing."px);
							max-width:         calc(25% - ".$fg_spacing."px);
						}
						
						.woocommerceproductsshowcase.gallery-columns-5 .fg-gallery-item {
							max-width: 19%;
							max-width: -webkit-calc(20% - ".$fg_spacing."px);
							max-width:         calc(20% - ".$fg_spacing."px);
						}
						
						.woocommerceproductsshowcase.gallery-columns-6 .fg-gallery-item {
							max-width: 15%;
							max-width: -webkit-calc(16.7% - ".$fg_spacing."px);
							max-width:         calc(16.7% - ".$fg_spacing."px);
						}
						
						.woocommerceproductsshowcase.gallery-columns-7 .fg-gallery-item {
							max-width: 13%;
							max-width: -webkit-calc(14.28% - ".$fg_spacing."px);
							max-width:         calc(14.28% - ".$fg_spacing."px);
						}
						
						.woocommerceproductsshowcase.gallery-columns-8 .fg-gallery-item {
							max-width: 11%;
							max-width: -webkit-calc(12.5% - ".$fg_spacing."px);
							max-width:         calc(12.5% - ".$fg_spacing."px);
						}
						
						.woocommerceproductsshowcase.gallery-columns-9 .fg-gallery-item {
							max-width: 9%;
							max-width: -webkit-calc(11.1% - ".$fg_spacing."px);
							max-width:         calc(11.1% - ".$fg_spacing."px);
						}
					";
				}

				if($fg_image_lightbox == 'zoomin') {
					$gallery_style .= '#'.$selector.'.woocommerceproductsshowcase .icon-plus:before {	
										content: "\e6ef"!important;
					}';
				}
				if($fg_image_lightbox == 'image') {
					$gallery_style .= '#'.$selector.'.woocommerceproductsshowcase .icon-plus:before {	
										content: "\e687"!important;
					}';
				}	
				if($fg_image_lightbox == 'images') {
					$gallery_style .= '#'.$selector.'.woocommerceproductsshowcase .icon-plus:before {	
										content: "\e605"!important;
					}';
				}	
				if($fg_image_lightbox == 'spinner_icon') {
					$gallery_style .= '#'.$selector.'.woocommerceproductsshowcase .icon-plus:before {	
										content: "\e6e7"!important;
					}';
				}
				if($fg_image_lightbox == 'search_icon') {
					$gallery_style .= '#'.$selector.'.woocommerceproductsshowcase .icon-plus:before {	
										content: "\e6ee"!important;
					}';
				}				
				
				if($fg_gallery_name_show == 'true') {
					$gallery_style .= ".fg_gallery_title-{$instance}.fg_gallery_name {
							font-size:".$fg_gallery_name_font_size."px;
							color:".$fg_gallery_name_font_color.";
							text-align:".$fg_gallery_name_text_align.";
					}";
				}
				
				$gallery_style .= "</style>";								  
							  
							  
				return $gallery_style;				  
							  
}