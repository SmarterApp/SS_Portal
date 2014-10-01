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
add_theme_support( 'post-thumbnails' ); 

add_action('admin_head', 'my_custom_css');
			
			function my_custom_css() {
			   echo '
				  <style type="text/css">
					  #posts-filter div.top.tablenav div.actions.alignleft .ex-filter { display: block; }
					  #adminmenu li.wp-menu-separator { background:#000000; opacity:.05; margin-bottom:0; border:1px solid #999; border-right:none; border-left:none;}
				  </style>
			   ';
			}

register_sidebar( ); 

function wp_get_attachment( $attachment_id ) {
				$attachment = get_post( $attachment_id );
				return array(
					'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
					'caption' => $attachment->post_excerpt,
					'description' => $attachment->post_content,
					'href' => get_permalink( $attachment->ID ),
					'src' => $attachment->guid,
					'title' => $attachment->post_title
				);
			}


//prevent subscribers from accessing backend
   function prevent_admin_access()
   {
   if ( false !== strpos( strtolower( $_SERVER['REQUEST_URI'] ), '/wp-admin' ) && !current_user_can( 'edit_posts' ) && !defined('DOING_AJAX') ) 
   wp_redirect( home_url() );
   }
   add_action( 'init', 'prevent_admin_access', 0 );

/* Shortcode to display linked URLs to files uploaded via Types post meta
*
* @arg file_url optionally will hold a specific URL to process & display a link to the file directly
* with the link display being the file name & extension
*
* @arg types_field optionally will hold the field name of a Types field for File uploads
* and dsiplay each (if multiple) as the file name with extension linked to full file download URL
*
*/
add_shortcode( 'my_file_name', 'wpml_hard_link'); // Actually activate the shortcode
function wpml_hard_link($atts) {
    global $post; // So we can get the post meta later on
 
    $url = "{$atts['file_url']}";
    $types = "wpcf-{$atts['types_field']}";
     
    if ($types) { // if the types_field argument was provided
 
        $urls = get_post_meta($post->ID,$types); // let's get the (potentially multiple) values
        $content = ''; // Setting up a variable to hold the links so we can return it later

        foreach ($urls as $fileurl) { // Let's iterate for each of the multiple values
						$arr = explode('/',$fileurl); // Split it up so that we can just grab the end part, the filename
        				$arr1 = end($arr);
						$arr2 = explode('.',$arr1);
						$string = reset($arr2);
						$pattern = '/_/';
						$replacement = ' ';
						$title = preg_replace($pattern, $replacement, $string);
						
			//$arr = explode('/',$fileurl); // Split it up so that we can just grab the end part, the filename
            if ($types == 'wpcf-resource'){
				$content .= '<div class="rsource"><a target="_blank" href="'.$fileurl.'">'.$title.'</a> <span style="text-transform: uppercase;">['.end($arr2).']</span></div>'; 
			}// Create the link and store it in the $content variable
        }
         
        return $content; // Return the content as the shortcode value
     
    } else {  // Else we didn't use the fields_type argument, we just needed one URL we provided explicitly
            $arr = explode('/',$url); // So let's split that URL up so we can grab the end
            return '<a target="_blank" href="'.$url.'">'.end($arr).'</a>'; // And return the resultant link
     
    } // We're done!
     
}

function logout_clear_cookie( $cookie_name="saml-response" ) {
  echo "<h1> CLEARING COOKIE</h1>";
  if (($cookie_name != "") && isset($_COOKIE["saml-response"])) { //'$cookie_name])) {
    setcookie($cookie_name, "", time()-3600, "/");
    unset($_COOKIE[$cookie_name]);
  }
}
add_action('wp_logout', 'logout_clear_cookie');

?>
