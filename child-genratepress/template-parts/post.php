<?php
          $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
    $query = new WP_Query( array(
       'post_type'  => 'post', 
        'posts_per_page' => 4,
        'paged' => $paged
    ) );


 if ( $query->have_posts() ) { ?>

<!-- begin loop -->
<?php while ( $query->have_posts() ) {
$query->the_post(); ?>
      <div class="main-post-area">
       <div class="jaz-post">
       <div class="thumbnail-date-area">
            <div class="thumbnail-area">
            <a href="<?php echo get_the_permalink();?>">  <?php the_post_thumbnail();?></a>
        </div>
        <div class="date-area">
         <span class='day'><?php  echo get_the_date('j')?></span><br>
         <span class='month-year'><?php  echo get_the_date('F. Y'); ?></span>
         </div>
         </div>
         <div class="content_areaaa">
         <h2 class="post-title">
       <a href="<?php echo get_the_permalink();?>"> <?php the_title();?></a>
      </h2>
      <div class="content-area">
     <?php echo wp_trim_words( get_the_content(), 40, '...' );?>
     </div>
     <div class="comentsss">
     <div class="comments">
   <a href="<?php echo get_the_permalink();?>"> <img src="https://jaziaorg.wpcomstaging.com/wp-content/uploads/2021/05/chat-copy-2@1X.png"><span class="cpmment-numebr"><?php echo get_comments_number().'<span>'. Comments .'</span>'?></span></a>
     </div>
   <div class="read-more-jaxs">
   <span class="btn-read"> <a href="<?php echo get_the_permalink(); ?>">Read more</span> <img src="https://jaziaorg.wpcomstaging.com/wp-content/uploads/2021/05/straight-right-arrow.png"> </a>
    </div>
    </div>
    </div>
    </div>
</div>
    <?php  
     }
         ?>
              
    <div class="pagination">
    <?php 
        echo paginate_links( array(
            'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
            'total'        => $query->max_num_pages,
             'current'      => max( 1, get_query_var( 'paged' ) ),
            'format'       => '?paged=%#%',
            'show_all'     => false,
            'type'         => 'plain',
            'end_size'     => 2,
            'mid_size'     => 1,
            'prev_next'    => true,
            'prev_text'    => '<i class="fas fa-angle-left"></i>',
            'next_text'    => '<i class="fas fa-angle-right"></i>',
            'add_args'     => false,
            'add_fragment' => '',
        ) );
    ?>
</div>
         
     <?php     
    }else{
        echo "no post";
        
        
        }
         
        wp_reset_postdata();
?>    
 
 