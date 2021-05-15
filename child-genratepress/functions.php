
<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    $parenthandle = 'parent-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.
    $theme = wp_get_theme();
    wp_enqueue_style( $parenthandle, get_template_directory_uri() . '/style.css', 
        array(),  // if the parent theme code has a dependency, copy it to here
        $theme->parent()->get('Version')
    );
    wp_enqueue_style( 'child-style', get_stylesheet_uri(),
        array( $parenthandle ),
        $theme->get('Version') // this only works if you have Version in the style header
    );
   
}
function jaz_shortcode() {
    
 ob_start();
 include(get_stylesheet_directory() . '/template-parts/post.php');
 return    ob_get_clean();
}
add_shortcode('jaz-post' , 'jaz_shortcode');
function comment_shortcode() {
    
 ob_start();
 include(get_stylesheet_directory() . '/template-parts/comments.php');
 return    ob_get_clean();
}
add_shortcode('all-comment' , 'comment_shortcode');


// Add Breadcrumbs
function page_breadcrumbs() {
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
add_shortcode( 'page-menu', 'page_breadcrumbs' );

//for pagination
//-----------------------------------------------


// numbered pagination
//-----------------------------------------------


// numbered pagination
function pagination($pages = '', $range = 4)
{  
     $showitems = ($range * 2)+1;  
 
     global $paged;
     if(empty($paged)) $paged = 1;
 
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
 
     if(1 != $pages)
     {
         echo "<div class=\"pagination\"><span>Page ".$paged." of ".$pages."</span>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";
 
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
             }
         }
 
         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
         echo "</div>\n";
     }
}


add_filter( 'body_class', 'my_neat_body_class');
function my_neat_body_class( $classes ) {
     if ( is_page('1059'))
          $classes[] = 'blog';
 
     return $classes; 
}


 function wpbsearchform( $form ) {
 
    $form = '<form role="search" class="search_bar" method="get" id="searchform" action="' . home_url( '/' ) . '" >
    <div><label class="screen-reader-text" for="s">' . __('Search for:') . '</label>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="Search..." />
    <button type="submit" id="searchsubmit"><img src="https://jaziaorg.wpcomstaging.com/wp-content/uploads/2021/05/research.png"></button>
    </div>
    </form>';
 
    return $form;
}
 
add_shortcode('wpbsearch', 'wpbsearchform');

function timeago( $type = 'post' ) {
$d = 'comment' == $type ? 'get_comment_time' : 'get_post_time';
return human_time_diff($d('U'), current_time('timestamp')) . " " . __('ago');
}

 
	     	   $reply_href = wp_make_link_relative(
    get_permalink( $comment->comment_post_ID ) 
    ) 
    . '?replytocom=' . $comment->comment_ID . '#respond';

$reply_onclick = 'return addComment.moveForm(&quot;comment-' 
    . $comment->comment_ID 
    . '&quot;, &quot;' 
    . $comment->comment_ID 
    . '&quot;, &quot;respond&quot;, &quot;' 
    . $comment->comment_post_ID 
    . '&quot;)';
	     	   
	      
 
?>