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
    <div class="wrapper page">
		
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			
            <h2><?php the_title(); ?></h2>
            <div class="post"><?php the_content(); ?></div>
            
		<?php endwhile; else: ?>
            <p><?php _e('Sorry, there is no content on this page.'); ?></p>
        <?php endif; ?>
    
    </div><!--close wrapper-->
<?php get_footer(); ?>