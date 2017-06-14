<?php

namespace Roots\Sage\Utils;

/**
 * Tell WordPress to use searchform.php from the templates/ directory
 */
function get_search_form() {
  $form = '';
  locate_template('/templates/searchform.php', true, false);
  return $form;
}
add_filter('get_search_form', __NAMESPACE__ . '\\get_search_form');

function smallcapsify($input) {
	return preg_replace('/^(.*?)([.?!])\s*?/', '<span class="small-caps">${1}${2} </span>', $input);
}