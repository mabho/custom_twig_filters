<?php
/**
 * Created by Marcos Hollanda.
 * Date: 9/28/2019
 * Time: 02:56 PM
 */
namespace Drupal\custom_twig_filters\TwigExtension;
class customFilters extends \Twig_Extension {
  public function getFilters() {
      return [ 
        new \Twig_SimpleFilter('slugify', array($this, 'slugify'))
      ];
  }

  public function getName() {
    return 'custom_twig_filters.twig_extension';
  }

  public static function slugify($string) {
    // Trim, remove special characters and strip HTML tags.
    $string = html_entity_decode(trim(strip_tags($string)));

    // Now, take advantage of Pathauto's cleanup and slugify services.
    $clean_string = \Drupal::service('pathauto.alias_cleaner')->cleanString($string);

    // Delivers a slug.
    return $clean_string;
  }
}