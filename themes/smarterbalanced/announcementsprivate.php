<?php
/*
Template Name: Private Announcements
*/
?>
<!--This Portal acts as the gateway to accessing your Assessment Systems.
Copyright (C) 2014 American Institutes for Research

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.-->
<?php get_header(); ?>
<?php if ( is_user_logged_in() ) { ?>

	<div class="wrapper archivedAnnouncements">
		
        <div class="announcements"> 
                       <h2>Archived Announcements</h2>
                        <ul>          
                        <?php query_posts( array( 'post_type' => 'announcement', 'secure' => 'private', 'posts_per_page' => -1 ) );
                                      if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                              <li <?php $mylimit=7 * 86400; $post_age = date('U') - mysql2date('U', $post->post_date_gmt);
								if ($post_age < $mylimit) { echo ('class="newAnnouncement"');}?>>
                        			<?php the_content(); ?>
                                <div class="date">Added <?php the_time('F j, Y'); ?></div>
								</li>
                                       <?php  $x = $x +1; endwhile; endif;  wp_reset_query(); ?>
                         </ul>       
                   </div><!--close announcement-->
    
    </div><!--close wrapper-->
     <?php }else{ ?> 
     <div class="privatePageMessage">
	 	<?php query_posts( array( 'post_type' => 'privatemessage', 'posts_per_page' => 1 ) );
                  if ( have_posts() ) : while ( have_posts() ) : the_post(); 
				  
				  the_content();
				  
				  endwhile; endif;  wp_reset_query(); ?>
      
      </div> <?php } ?>	

<?php get_footer(); ?>

