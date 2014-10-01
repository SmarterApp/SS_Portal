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
<?php
if(isset($_GET['p']))
{$slug = $_GET['p'];}

else
{$slug = 'home';}

global $post;
$blog_title = get_bloginfo();
?>

 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $blog_title; $slug = $post->post_name; if($slug!=''){echo ' : '; the_title();}?></title>
<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/jquery-1.4.1.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/script.js"></script>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/branding.css" type="text/css" media="screen" />
<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/images/favicon.ico" type="image/x-icon" />
</head>

<body>

	<div class="header">
    	<div class="roots">
        	<a href="<?php echo home_url(); ?>"><?php echo $blog_title; ?></a><?php $title=get_the_title(); if($title !=''){ echo ' > '; the_title();} ?>
        </div><!--end roots-->
        <a href="<?php echo home_url(); ?> " title="<?php echo $blog_title; ?>">
            	<img src="<?php echo get_template_directory_uri();?>/images/logo.png" alt="<?php echo $blog_title; ?>" />
        </a>
    </div><!--close header-->
     <?php if ( !is_user_logged_in() ) {  ?> 
         <div class="openSourceLogin">
            <a href="<?php echo home_url(); ?>/wp-login.php"></a>
         </div> 
     <?php }else{ ?> 
     	<div class="openSourceLogout"> <a href="<?php echo wp_logout_url( get_option("home") ); ?>" title="Sign Out"></a></div> 
	 <?php } ?>   
        <div class="clear border"></div>