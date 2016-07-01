<?php
/**
 * Walker_Info_Buttons Class
 *
 * Wraps nav items in divs instead of an unordered list and list items.
 */

class Walker_Info_Buttons extends Walker_Nav_Menu {
	
	function start_el(&$output, $item, $depth=0, $args=array(), $id=0) {

		$indent = ( $depth ) ? str_repeat("\t", $depth) : '';

		// Crunch class names
		$class_names = $value = '';
		$classes = empty($item->classes) ? array() : $item->classes;
		$classes[] = 'info_button';
		$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
		$class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

		// Link attributes
		$atts = array();
		$atts['title'] = !empty($item->attr_title) ? $item->attr_title : '';
		$atts['target'] = !empty($item->target) ? $item->target : '';
		$atts['href'] = !empty($item->url) ? $item->url : '';
		$atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args);

		$attributes = '';

		foreach ($atts as $attr => $value) {
			if (!empty($value)) {
				$value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$item_output = $args->before;
		$item_output .= '<div' . $class_names . ">\n";
		$item_output .= '<a' . $attributes . '>';
		$item_output .= '<span>' . $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after . '</span>';
		$item_output .= '<div class="info_arrows"></div>';
		$item_output .= "</a>\n";
		$item_output .= $args->after;

		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);

	}

	function end_el(&$output, $item, $depth=0, $args=array()) {
		$output .= "</div>\n";
	}

}

?>
