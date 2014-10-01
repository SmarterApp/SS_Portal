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
<?php get_header();?>


<div class="wrapper">
    <div class="cardArea">
    <h2>Get Started!</h2>
    
    <?php if ( is_user_logged_in() ) { ?>
       
    <?php query_posts( array( 'post_type' => 'card', 'secure' => 'private', 'posts_per_page' => -1  ) );
if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	

<div class="cardBox <?php echo(types_render_field("disabled", array("raw" => "true")));?>">
  <a <?php $disabled = types_render_field( "disabled", array("raw" => "true") );
if ( $disabled == 'disabled'){
  echo '';
 }else{ $tab = (types_render_field("new-tab", array("raw" => "true"))); if($tab=='1'){echo 'target="_blank"';}} ?> 
 href="<?php $disabled = types_render_field( "disabled", array("raw" => "true") );
                                    {if ( $disabled == 'disabled'){
                                        echo '';
									}elseif( types_render_field( "linktype", array("raw" => "true") ) == "Internal"){echo(types_render_field( "ilink", array("raw" => "true") ));
                                    	}elseif(types_render_field( "linktype", array("raw" => "true") ) == "External"){echo(types_render_field( "external-link", array("raw" => "true") ));
										}else{echo(types_render_field( "file", array("raw" => "true") ));}
									};?>">
  <div class="cardTop">
  <?php echo (types_render_field("card-image", array("alt" => "Click Here"))); ?>
 </div><!--close cardTop-->
 <div class="cardBottom">
  <div><span class="cardTitle"><?php the_title(); ?></span></div>
  <?php $mykey_secure = types_render_field('secure', array("alt" => "Secure Link"));

 {if ( $mykey_secure == 'true'){
     echo '<span class="secure"></span>';}}?>
     <span class="coming"><?php $var = types_render_field('closedmsg', array("raw" => "true"));
     {if ( $var == ''){
	 echo 'Coming Soon';}else{echo types_render_field('closedmsg', array("raw" => "true"));}}?></span>
	 </div><!--close cardBottom-->
	 </a>
	 </div><!--close cardBox-->
	 <?php endwhile; endif;  wp_reset_query(); ?> 
       
     <?php 
       $debug = false; // true
       if (isset($_COOKIE["saml-response"])) {
	 $r= $_COOKIE["saml-response"];
	 $saml_resp = unserialize(base64_decode($r));
	 if ($debug) {
	   echo "<P>COOKIE saml-response value: </p>";
	   print_r ($r);
	   echo "<P>--DECODED VALUE--</p>";
	   var_dump ($saml_resp);
	 }
       } else {
	 echo "<p>No SAML response found in cookie. Are your cookies enabled?</p>";
       }
       if ($saml_resp) {
	 $email = $saml_resp['mail'][0];
	 $tcy_chains = $saml_resp['sbacTenancyChain'];
	 //print_r ($tcy_chains);
	 foreach ($tcy_chains as $chain) {
	   list ($junk, $bar, $rol, $foo) = explode ("|", $chain, 4);
	   //echo "<p>Role is $rol</P>";
	   $roles[$rol] = 1;
	 }
	 //print_r ($roles);
	 $current_date_time =  date("Y-m-d\TH:i:s");// 2014-08-13T07:25:09
	 
	 $lines = file('/var/www/etc/component_mapping.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	 
	 $jsonData .= "{\n\t\"info\"     : \"Portal links for authenticated user\",\n";
	 $jsonData .= "\t\"sbacUUID\"    : \"$email\",\n";
	 $jsonData .= "\t\"timestamp\"   : \"$current_date_time\",\n";
	 $jsonData .= "\t\"links\"       : [ {\n";
	 
	 $first_role = 1;
	 foreach ($lines as $line_num => $line)
	   {
	     list($role,$component,$displayname,$url,$icon) = explode("|", $line);
	     if (isset($roles[$role]))
	       {
		 if (isset($seen_component[$component]) || ($component == "") || ($url == ""))
		   {
		     continue;
		   }
		 $seen_component[$component] = 1;
		 if ($first_role === 1)
		   {
		     $first_role = 0;
		   }
		 else
		   {
		     $jsonData .= "\t\t} , {\n";
		   }
		 $jsonData .= "\t\t\"name\"        : \"$component\",\n";
		 $jsonData .= "\t\t\"displayName\" : \"$displayname\",\n";
		 $jsonData .= "\t\t\"url\"         : \"$url\",\n";
		 $jsonData .= "\t\t\"icon\"        : \"$icon\"\n";
	       }
	   }
	 $jsonData .= "\t} ]\n}\n";
	 
	 $phpArray = json_decode($jsonData, true);
	 foreach ($phpArray as $key => $value) {
	   if($key = 'links'){
	     foreach ($value as $k => $v) {
	       $displayName = $v['displayName'];
	       $url = $v['url'];
	       $icon = $v['icon'];
	       ?>

		 <div class="cardBox">
		    <a target="_blank" href="<?php echo $url; ?>">
		    <div class="cardTop">
		    <img src="<?php echo $icon; ?>" alt="Click Here"/>
		    </div><!--close cardTop-->
		    <div class="cardBottom">
		    <div><span class="cardTitle"><?php echo $displayName; ?></span></div>
										</div><!--close cardBottom-->
										</a>
										</div><!--close cardBox-->
										
										<?php
										}
	   }
	 }
       } 
     }else{ ?>
     	
        <?php query_posts( array( 'post_type' => 'card', 'secure' => 'public', 'posts_per_page' => -1  ) );
if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	

<div class="cardBox <?php echo(types_render_field("disabled", array("raw" => "true")));?>">
  <a <?php $disabled = types_render_field( "disabled", array("raw" => "true") );
if ( $disabled == 'disabled'){
  echo '';
 }else{ $tab = (types_render_field("new-tab", array("raw" => "true"))); if($tab=='1'){echo 'target="_blank"';}} ?> 
 href="<?php $disabled = types_render_field( "disabled", array("raw" => "true") );
                                    {if ( $disabled == 'disabled'){
                                        echo '';
									}elseif( types_render_field( "linktype", array("raw" => "true") ) == "Internal"){echo(types_render_field( "ilink", array("raw" => "true") ));
                                    	}elseif(types_render_field( "linktype", array("raw" => "true") ) == "External"){echo(types_render_field( "external-link", array("raw" => "true") ));
										}else{echo(types_render_field( "file", array("raw" => "true") ));}
									};?>">
  <div class="cardTop">
  <?php echo (types_render_field("card-image", array("alt" => "Click Here"))); ?>
 </div><!--close cardTop-->
 <div class="cardBottom">
  <div><span class="cardTitle"><?php the_title(); ?></span></div>
  <?php $mykey_secure = types_render_field('secure', array("alt" => "Secure Link"));

 {if ( $mykey_secure == 'true'){
     echo '<span class="secure"></span>';}}?>
     <span class="coming"><?php $var = types_render_field('closedmsg', array("raw" => "true"));
     {if ( $var == ''){
	 echo 'Coming Soon';}else{echo types_render_field('closedmsg', array("raw" => "true"));}}?></span>
	 </div><!--close cardBottom-->
	 </a>
	 </div><!--close cardBox-->
	 <?php endwhile; endif;  wp_reset_query(); ?> 
        
     <?php } ?>   
	 </div>
	     </div>
	     <div class="border clear"></div> 
				   <div class="wrapper"> 
				   <div class="quickLinks">
                    <?php if ( is_user_logged_in() ) { ?> 
                    
                    	<?php query_posts( array( 'post_type' => 'quicklink', 'secure' => 'private', 'posts_per_page' => -1  ) );
if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<a class="quickLink <?php echo(types_render_field("disabled", array("raw" => "true"))); $name = get_the_title(); if ($name == 'Secure Browser'){echo ' sblink';}?>" <?php $disabled = types_render_field( "disabled", array("raw" => "true") );
if ( $disabled == 'disabled'){
  echo '';
 }else{ $tab = (types_render_field("new-tab", array("raw" => "true"))); if($tab=='1'){echo 'target="_blank"';}} ?> 
 href="<?php $disabled = types_render_field( "disabled", array("raw" => "true") );
                                    {if ( $disabled == 'disabled'){
                                        echo '';
									}elseif( types_render_field( "linktype", array("raw" => "true") ) == "Internal"){echo(types_render_field( "ilink", array("raw" => "true") ));
                                    	}elseif(types_render_field( "linktype", array("raw" => "true") ) == "External"){echo(types_render_field( "external-link", array("raw" => "true") ));
										}else{echo(types_render_field( "file", array("raw" => "true") ));}
									};?>"><?php echo (types_render_field("card-image", array("alt" => "click here"))); ?><div class="title"><span class="fontSizer"><?php the_title(); ?></span></div></a>
									<?php endwhile; endif; wp_reset_query();?>
                    
				   <?php }else{ query_posts( array( 'post_type' => 'quicklink', 'secure' => 'public', 'posts_per_page' => -1  ) );
if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<a class="quickLink <?php echo(types_render_field("disabled", array("raw" => "true"))); $name = get_the_title(); if ($name == 'Secure Browser'){echo ' sblink';}?>" <?php $disabled = types_render_field( "disabled", array("raw" => "true") );
if ( $disabled == 'disabled'){
  echo '';
 }else{ $tab = (types_render_field("new-tab", array("raw" => "true"))); if($tab=='1'){echo 'target="_blank"';}} ?> 
 href="<?php $disabled = types_render_field( "disabled", array("raw" => "true") );
                                    {if ( $disabled == 'disabled'){
                                        echo '';
									}elseif( types_render_field( "linktype", array("raw" => "true") ) == "Internal"){echo(types_render_field( "ilink", array("raw" => "true") ));
                                    	}elseif(types_render_field( "linktype", array("raw" => "true") ) == "External"){echo(types_render_field( "external-link", array("raw" => "true") ));
										}else{echo(types_render_field( "file", array("raw" => "true") ));}
									};?>"><?php echo (types_render_field("card-image", array("alt" => "click here"))); ?><div class="title"><span class="fontSizer"><?php the_title(); ?></span></div></a>
									<?php endwhile; endif; wp_reset_query(); }?>
                                    
                                    
                                    
					</div><!--close quickLinks-->
									
									<div class="welcomeMessage">
                                    <?php if ( is_user_logged_in() ) { ?> 
												 <?php  query_posts( array( 'post_type' => 'message', 'secure' => 'private', 'posts_per_page' => 1 ));
if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	
<h2> <?php the_title(); ?> </h2>
<div><?php the_content(); ?></div>
<?php endwhile; endif; wp_reset_query(); ?>
<?php }else{ ?>
	 <?php  query_posts( array( 'post_type' => 'message', 'secure' => 'public', 'posts_per_page' => 1 ));
if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	
<h2> <?php the_title(); ?> </h2>
<div><?php the_content(); ?></div>
<?php endwhile; endif; wp_reset_query(); ?>
<?php }?>

<!--call announcements-->     
<div class="announcements"> 
			 <h2>Recent Announcements</h2>
			 <ul> 
              <?php if ( is_user_logged_in() ) { ?>          
			 <?php query_posts( array( 'post_type' => 'announcement', 'secure' => 'private', 'posts_per_page' => 5  ) );
if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<li <?php $mylimit=3 * 86400; $post_age = date('U') - mysql2date('U', $post->post_date_gmt);
if ($post_age < $mylimit) { echo ('class="newAnnouncement"');}?>>
<?php the_content(); ?>
<div class="date">Added <?php the_time('F j, Y'); ?></div>
</li>
<?php  $x = $x +1; endwhile; endif;  wp_reset_query();    
$pages = get_pages();
?>
    <li><p><a href="announcements">Click here</a> to view archived announcements</p></li>
      
      <?php }else{ ?>
      	
        <?php query_posts( array( 'post_type' => 'announcement', 'secure' => 'public', 'posts_per_page' => 5  ) );
if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<li <?php $mylimit=3 * 86400; $post_age = date('U') - mysql2date('U', $post->post_date_gmt);
if ($post_age < $mylimit) { echo ('class="newAnnouncement"');}?>>
<?php the_content(); ?>
<div class="date">Added <?php the_time('F j, Y'); ?></div>
</li>
<?php  $x = $x +1; endwhile; endif;  wp_reset_query();    
$pages = get_pages();
?>
    <li><p><a href="private-announcements">Click here</a> to view archived announcements</p></li>
        
      <?php } ?>
      </ul>       
      </div><!--close announcement-->
      </div><!--close welcomeMessage--> 
      <div class="clear"></div>
  </div><!--close wrapper-->   
  
  <?php get_footer(); ?>

