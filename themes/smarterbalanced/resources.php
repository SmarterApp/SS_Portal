<?php
/*
Template Name: Resources
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

	<div class="resourcesWrapper clear">
       <h2>Resources and Documentation</h2>
       <?php $tax='resource-group';
	   $cat_args = array ('orderby'=> 'title', 'order' => 'ASC' ) ;
	   $terms = get_terms($tax, $cat_args );
	   $count = count($terms);
	   if ( $count > 0 ){ ?>
       
            	<ul class="jump">
                	<?php foreach ( $terms as $term ) { 
                        $term_id = $term->term_id;?>
						<li class="resourceGroup"><a href="#<?php echo $term->slug; ?>"><?php echo $term->name ?></a></li>
                    <?php } ?>
                </ul>	
       	   
           			<?php foreach ( $terms as $term ) { 
                        $term_id = $term->term_id;?>
						<h3 class="resourceGroupHead" id="<?php echo $term->slug; ?>"><?php echo $term->name ?></h3>
                        <table   border="1" cellpadding="0" cellspacing="0" class="browser_table">
                            <tr>
                              <th width="48%">Resource</th>
                              <th width="48%">Description</th>
                            </tr>
                       <?php $group = $term->slug; query_posts( array( 'post_type' => 'resource', 'resource-group' => $group, 'secure' => 'public', 'posts_per_page' => -1  ) );
							 if ( have_posts() ) : while ( have_posts() ) : the_post(); $published_posts++;?>                   
                            <tr>
                                    <td><?php 
                                        
                                            $y = types_render_field('rtype'); 
                                            $today = strtotime(date("F j, Y"));
                                            ?>
                                            <div class="resourceTitle">	<?php
                                            if ($y == '1'){ 
                                                ?>
                                                <a target="_blank" href="<?php echo types_render_field('resource') ?>"><?php the_title(); ?></a>
                                                <?php $arr = explode('.',types_render_field('resource'));
                                                $string = end($arr);
                                                if ($string == 'swf'){$string='Flash';}
                                                ?><span style="text-transform:uppercase;">[<?php echo $string ?>]</span> <?php
                                            } elseif ($y == 2){?>
                                                <a target="_blank" href="<?php echo types_render_field('linkedresource', array("raw" => "true")); ?>"><?php echo the_title(); ?></a>
                                                <?php
                                            }else{ ?>
                                                <?php the_title(); ?></a><?php
                                                echo '<span style="color:#666; font-size:.85em;  padding-left:.5em;">(Coming Soon)</span>';
                                            }?>
                                            </div>
                                     </td>
                                     <td><?php the_content(); ?></td>
                            </tr>
                        <?php endwhile; endif; wp_reset_query(); if($published_posts == 0){ ?>
                        <tr><td style="color:#666; font-style:italic;">Coming Soon</td><td></td></tr>
                         <?php } ?>
                      </table>
                    <?php } ?>
           
	   <?php }else{ ?>     
           		
						<table   border="1" cellpadding="0" cellspacing="0" class="browser_table">
                            <tr>
                              <th width="48%">Resource</th>
                              <th width="48%">Description</th>
                            </tr>
                       <?php query_posts( array( 'post_type' => 'resource', 'secure' => 'public', 'posts_per_page' => -1  ) );
							 if ( have_posts() ) : while ( have_posts() ) : the_post(); $published_posts++;?>                   
                            <tr>
                                    <td><?php 
                                        
                                            $y = types_render_field('rtype'); 
                                            $today = strtotime(date("F j, Y"));
                                            ?>
                                            <div class="resourceTitle">	<?php
                                            if ($y == '1'){ 
                                                ?>
                                                <a target="_blank" href="<?php echo types_render_field('resource') ?>"><?php the_title(); ?></a>
                                                <?php $arr = explode('.',types_render_field('resource'));
                                                $string = end($arr);
                                                if ($string == 'swf'){$string='Flash';}
                                                ?><span style="text-transform:uppercase;">[<?php echo $string ?>]</span> <?php
                                            } elseif ($y == 2){?>
                                                <a target="_blank" href="<?php echo types_render_field('linkedresource', array("raw" => "true")); ?>"><?php the_title(); ?></a>
                                                <?php
                                            }else{ ?>
                                                <?php the_title(); ?></a><?php
                                                echo '<span style="color:#666; font-size:.85em;  padding-left:.5em;">(Coming Soon)</span>';
                                            }?>
                                            </div>
                                     </td>
                                     <td><?php the_content(); ?></td>
                                      
                            </tr>
                        <?php endwhile; endif; wp_reset_query(); if($published_posts == 0){ ?>
                        <tr><td style="color:#666; font-style:italic;">Coming Soon</td><td></td></tr>
                         <?php } ?>
                      </table>
           <?php } ?>
	</div>
    	
<?php get_footer(); ?>

