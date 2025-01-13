<?php
namespace Drupal\gavias_facdori\Theme;

use Drupal\Core\Theme\ThemeNegotiatorInterface;
use Drupal\Core\Routing\RouteMatchInterface;

class ThemeNegotiator implements ThemeNegotiatorInterface {
  /**
   * {@inheritdoc}
   */
  public function applies(RouteMatchInterface $route_match) {
    // Use this theme on a certain route.
    $node = $route_match->getParameter('node');
    if (!is_null($node) && $node instanceof \Drupal\node\Entity\Node) {
      return $node->getType() == 'newsletter';
    }

    // apply default theme
    return false;
  }

  /**
   * {@inheritdoc}
   */
  public function determineActiveTheme(RouteMatchInterface $route_match) {
    $current_url = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $edit_mode = '/edit';
    $pos = strpos($current_url, $edit_mode);
    if($pos !== false){
      return 'gin';
    }else{  
      return 'newsletter_theme';

    }
    // Here you return the actual theme name.
    
  }
}
?>
