<?php
/*
Template Name: Secure Browsers
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

<div class="browserPage clear">	
                      
               <div class="intro" style="padding-bottom:1em;"><?php if (have_posts()) : while (have_posts()) : the_post(); the_content(); endwhile; endif; ?>
                <hr />       </div>
             	<div class="bDownloads">
                	<div class="browser">
                            	
                            		<?php query_posts( array( 'post_type' => 'browserinfo', 'posts_per_page' => -1 ) );
                        				if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                                        <div class="bSection"><div>
                                            <h2><?php the_title(); ?>:</h2>
                                            <div class="binfo"><?php the_content(); ?></div>
                                        </div>    </div>
                                     <?php endwhile; endif; wp_reset_query(); ?>  
                                  
                            </div>
                	<?php query_posts( array( 'post_type' => 'browser', 'posts_per_page' => -1 ) );
                        if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	
                                  
                        	<div class="browser">

                            	<div class="bSection">
                                	<h1>Download the <?php the_title(); ?> Secure Browser:</h1>
                                    <div><a class="dlBrowser" href="<?php echo(types_render_field("browserfile", array("raw" => "true"))); ?>">
                                    	<?php echo(types_render_field("version", array("raw" => "false"))); ?>
                                        <span class="browserArrow"></span>
                                        <span class="download">
                                        	<div>Download Browser</div>
                                            <span>Click here to download the Secure Browser.</span>
                                        </span>
                                    </a></div>
                                </div>
                                <hr/>
                                <div class="bSection">
                                    <div><?php echo(types_render_field("note", array("raw" => "true"))); ?></div>
                                </div>
								
                            </div>
                                                                    
                	<?php endwhile; endif; wp_reset_query(); ?> 
                </div>
                <ul class="btabs">
                		<li class="active">
                        	<span class="bIcon inform"></span>
                                <span class="OS">
									<div class="osName">
										Important Information 
                                    </div>
                                </span>
                        </li>
                                
                	<?php query_posts( array( 'post_type' => 'browser', 'posts_per_page' => -1 ) );
						
                        if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	
                                  
                        	<li class="<?php echo(types_render_field( "disabled" , array("raw" => "true"))); ?>">
                            	<span class="bIcon <?php echo(types_render_field("os-icon", array("raw" => "false"))); ?>"></span>
                                <span class="OS">
									<div class="osName">
									<?php $OS = types_render_field("os-icon", array("raw" => "false")); 
                                        if ($OS == 'windows'){
                                            echo 'Windows';
                                        }else if ($OS == 'mac'){
                                            echo 'Mac OS X';
                                        }else if ($OS == 'ipad'){
                                            echo 'iOS (iPad)';
                                        }else if ($OS == 'droid'){
                                            echo 'Android';
                                        }else if ($OS == 'chrome'){
                                            echo 'Google Chromebooks';
                                        }else{
                                            echo 'Linux';
                                        }
                                    ?>
                                    </div>
                                    <div class="version">
                                    	<?php echo(types_render_field("osv", array("raw" => "true"))); ?>
                                    </div>
                                </span>
                            </li>
                                                                    
                	<?php $x++; endwhile; endif; wp_reset_query(); ?> 
				</ul>    

     <div class="clear"></div>
         
     </div><!--close content-->
<?php get_footer(); ?>

    

