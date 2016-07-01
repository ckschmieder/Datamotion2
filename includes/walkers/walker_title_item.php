<?php
/**
 * Walker_Title_Item Class
 * aka Walker_Texas_Ranger :)
 *
 * Adds an empty title list item to each sublevel of a nav menu.
 * This list item's content is then populated via JavaScript.
 */

class Walker_Title_Item extends Walker_Nav_Menu {
	
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent<ul class=\"sub-menu\">\n";
		$output .= "$indent\t<li class=\"title\">\n";
		$output .= "$indent\t\t<a href=\"#\" class=\"back\">Back</a>\n";
		$output .= "$indent\t</li>";
	}

}

?>
