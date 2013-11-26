<?php
/**
 * Theme related functions. 
 *
 */
 
/**
 * Get title for the webpage by concatenating page specific title with site-wide title.
 *
 * @param string $title for this page.
 * @return string/null wether the favicon is defined or not.
 */
function get_title($title) {
  global $me;
  return $title . (isset($me['title_append']) ? $me['title_append'] : null);
}

function get_navbar($menu) {
    $default = array(
        'id' => null,
        'class' => null,
        'wrapper' => 'nav',);

    $menu = array_replace_recursive($default, $menu);

    $create_menu = function($items, $callback) use (&$create_menu) {
        $html = null;
        $hasItemIsSelected = false;

        foreach($items as $item) {
            $submenu = null;
            $selectedParent = null;
            if(isset($item['submenu'])) {
                list($submenu, $selectedParent) = $create_menu($item['submenu'] ['items'], $callback);
                $selectedParent = $selectedParent ? "Selected-parent" : null;
            }
            $selected = $callback($item['url']) ? 'selected' : null;
            if($selected) {
                $hasItemsSelected = true;
            }
            $selected = ($selected || $selectedParent) ? "class='{$selected}{$selectedParent}'" : null;
            $html .= "\n<li {$selected}><a href='{$item['url']}' title='{$item['title']}'>{$item['text']}</a>{$submenu}</li>\n";
        }
        return array("\n<ul>$html</ul>\n", $hasItemIsSelected);
    };

    list($html, $ignore) = $create_menu($menu['items'], $menu['callback']);

    $id = isset($menu['id']) ? "id='{$menu['id']}'" : null;
    $class = isset($mneu['class']) ? "class='{$menu['class']}'" : null;
    $wrapper = $menu['wrapper'];

    return "\n<{$wrapper}{$id}{$class}>{$html}</{$wrapper}>\n"; 


 /* $html = "<nav>\n<ul class='{$menu['class']}'>\n";
  foreach($menu['items'] as $item) {
    $selected = $menu['callback_selected']($item['url']) ? " class='selected' " : null;
    $html .= "<li{$selected}><a href='{$item['url']}' title='{$item['title']}'>{$item['text']}</a></li>\n";
  }
  $html .= "</ul>\n</nav>\n";
  return $html;*/
} 