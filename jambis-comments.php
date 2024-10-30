<?php
/*
Plugin Name: Jambis Comments
Plugin URI: http://www.jambis.com/wp.php
Description: Add Jambis comments to your WordPress blog posts. If you want to exclusively use Jambis comments you may want to disable your WordPress comments. Under your WordPress admin page go to; Options > Discussion > and uncheck "Allow people to post comments on the article"
Author: Jambis.com - Jason McPheron
Author URI: http://jambis.com/wp.php
Version: 0.1
*/

/*  This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

function jambis_content( $content ) {

	// Make sure that it is not a post
	if ( ! ( is_home() || is_single() || is_category() || is_date() || is_archive() || is_search() ) ) {
		return $content;
	}

	$content_orig = $content;

	$content= "<!-- begin jambis comments -->\r";
	$content.= $content_orig; 
	$content.= "<!-- end jambis comments -->\r";		

	
	
		$content.= jambis_link( get_permalink() ); 
		$content.= "<br/><br/>";
	
	return $content;
}

function jambis_link( $link, $content=NULL ) {

	//Firgure out what page we are on
	$current_page = "http://".$_SERVER[SERVER_NAME].$_SERVER[REQUEST_URI];
	//And see if it matches the permalink. If so, show an iframe with the wp version of the Jambis comments
	if ($current_page == $link){

	//You can change some of the iframe parameters like width and height to make the Jambis iframe look better with your WordPress theme
	
	//A width of 100% tends to auto fill the width of different themes, but feel free to change it.
	$width = "100%";
	
	//Height is a little tricky. Too much any you'll have a bunch of blank space before people add comments.
	//Too little and your readers will have to scroll too much.
	$height = "300";
	
	$content.= '<iframe frameborder=0 width="'.$width.'" height="'.$height.'" src="http://jambis.com/wp.php//';
	$content.= $link;
	$content.= '"></iframe>'; 
	
	//Else, we are looking at more than one post so just show a link to the Jambis comments for each specific post.
	}else{
	$content.= '<a href="http://jambis.com/url//'.$link.'">';	
	$content.= '<img src="http://www.jambis.com/images/jambis_smaller.png">Comments</a>';	
	}

	return $content;
}

add_action('the_content','jambis_content');

?>

