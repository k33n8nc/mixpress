<?php
/**
 * Adds option 'li_class' to 'wp_nav_menu'.
 *
 * @param string  $classes String of classes.
 * @param mixed   $item The curren item.
 * @param WP_Term $args Holds the nav menu arguments.
 *
 * @return array
 */
function mixpress_nav_menu_add_li_class( $classes, $item, $args, $depth ) {
	if ( isset( $args->li_class ) ) {
		$classes[] = $args->li_class;
	}

	if ( isset( $args->{"li_class_$depth"} ) ) {
		$classes[] = $args->{"li_class_$depth"};
	}

	return $classes;
}

add_filter( 'nav_menu_css_class', 'mixpress_nav_menu_add_li_class', 10, 4 );

/**
 * Adds option 'submenu_class' to 'wp_nav_menu'.
 *
 * @param string  $classes String of classes.
 * @param mixed   $item The curren item.
 * @param WP_Term $args Holds the nav menu arguments.
 *
 * @return array
 */
function mixpress_nav_menu_add_submenu_class( $classes, $args, $depth ) {
	if ( isset( $args->submenu_class ) ) {
		$classes[] = $args->submenu_class;
	}

	if ( isset( $args->{"submenu_class_$depth"} ) ) {
		$classes[] = $args->{"submenu_class_$depth"};
	}

	return $classes;
}

add_filter( 'nav_menu_submenu_css_class', 'mixpress_nav_menu_add_submenu_class', 10, 3 );

// ******************************
// WALKER CLASS For Tailwind CSS
// ******************************
class Mixpress_Tailwind_Menu extends Walker_Nav_Menu {
  private $curItem;
  function start_lvl(&$output, $depth = 0, $args = array()) {
      $indent = str_repeat("\t", $depth);
      // $output .= "\n$indent<div x-data=\"{ open: false }\"><button @click=\"open = ! open\">Expand</button><ul x-show=\"open\" class=\"subz-menu\">\n";
      $output .= "\n$indent<ul class=\"sub-menu\" x-data=\"{ open: false }\" x-show=\"open\" @open-dropdown.window=\"if (\$event.detail.id == ".$this->curItem->ID.") open = true\" @click.away=\"open = false\">\n";
  }

  function end_lvl(&$output, $depth = 0, $args = array()) {
      $indent = str_repeat("\t", $depth);
      $output .= "$indent</ul>\n";
  }

  function start_el(&$output, $item, $depth=0, $args=[], $id=0) {
    $this->curItem = $item;
		$output .= "<li class='" .  implode(" ", $item->classes) . "'>";

		if ($item->url && $item->url != '#') {
			$output .= '<a href="' . $item->url . '">';
      $output .= $item->title;
		} else {
			$output .= '<div x-data="{id: '.$item->ID.'}"><button @click="$dispatch(\'open-dropdown\',{id})">'.$item->title.'<i class="ml-2 caret fa fa-angle-down"></i></button>';
		}

		if ($item->url && $item->url != '#') {
			$output .= '</a>';
		} else {
			$output .= '</div>';
		}

		// if ($args->walker->has_children) {
		// 	$output .= '<i class="caret fa fa-angle-down"></i>';
		// }
	}

}
