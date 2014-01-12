<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Single Posts Template
 *
 *
 * @file           single.php
 * @package        Responsive 
 * @author         Emil Uzelac 
 * @copyright      2003 - 2013 ThemeID
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/single.php
 * @link           http://codex.wordpress.org/Theme_Development#Single_Post_.28single.php.29
 * @since          available since Release 1.0
 */

get_header(); ?>

<div id="content" class="grid col-940">
        
	<?php get_template_part( 'loop-header' ); ?>
        
	<?php if (have_posts()) : ?>
		
		<?php if ( in_category( 'characters' )): ?>
		
			<?php while (have_posts()) : the_post(); ?>
	        
				<?php responsive_entry_before(); ?>
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>       
					<?php responsive_entry_top(); ?>
	
	                <div class="post-entry">
	                	<div id="character-image">
			                <?php if ( has_post_thumbnail()) : ?>
			                	<?php the_post_thumbnail('thumbnail', array('class' => 'alignleft')); ?>
			                <?php endif; ?>
			                <h1 class="entry-title post-title codename"><?php the_title(); ?></h1>
		                </div>
		                <div id="character-content">
	                    	<?php the_content(__('Read more &#8250;', 'responsive')); ?>
		                </div>
	                    
	                    <?php wp_link_pages(array('before' => '<div class="pagination">' . __('Pages:', 'responsive'), 'after' => '</div>')); ?>
	                </div><!-- end of .post-entry -->
	                
	                <div class="navigation">
				        <div class="previous"><?php previous_post_link( '%link', '&#8249;', TRUE ); ?></div>
	                    <div class="next"><?php next_post_link( '%link', '&#8250;', TRUE ); ?></div>
			        </div><!-- end of .navigation -->
					               
					<?php responsive_entry_bottom(); ?>      
				</div><!-- end of #post-<?php the_ID(); ?> -->       
				<?php responsive_entry_after(); ?>       
	            
	        <?php 
			endwhile; 
	
			get_template_part( 'loop-nav' ); 
			?>
		
		<?php else: ?>

			<?php while (have_posts()) : the_post(); ?>
	        
				<?php responsive_entry_before(); ?>
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>       
					<?php responsive_entry_top(); ?>
	
	                <h1 class="entry-title post-title codename"><?php the_title(); ?></h1>
	
	                <div class="post-entry">
	                	<div class="grid col-540">
			                <?php if ( has_post_thumbnail()) : ?>
			                	<?php the_post_thumbnail('large', array('class' => 'alignleft')); ?>
			                <?php endif; ?>
		                </div>
		                <div class="grid-right col-380 fit">
	                    	<?php the_content(__('Read more &#8250;', 'responsive')); ?>
		                </div>
	                    
	                    <?php wp_link_pages(array('before' => '<div class="pagination">' . __('Pages:', 'responsive'), 'after' => '</div>')); ?>
	                </div><!-- end of .post-entry -->
	                
	                <div class="navigation">
				        <div class="previous"><?php previous_post_link( '%link', '&#8249;', TRUE ); ?></div>
	                    <div class="next"><?php next_post_link( '%link', '&#8250;', TRUE ); ?></div>
			        </div><!-- end of .navigation -->
					               
					<?php responsive_entry_bottom(); ?>      
				</div><!-- end of #post-<?php the_ID(); ?> -->       
				<?php responsive_entry_after(); ?>       
	            
	        <?php 
			endwhile; 
	
			get_template_part( 'loop-nav' ); 
		
		endif;

	else : 

		get_template_part( 'loop-no-posts' ); 

	endif; 
	?>  
      
</div><!-- end of #content -->

<?php get_footer(); ?>
