<?php

/**
 * @file
 * Contains loi.page.inc.
 *
 * Page callback for Learning Opportunity Instance entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Learning Opportunity Instance templates.
 *
 * Default template: loi.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_loi(array &$variables) {
  // Fetch LoInstance Entity Object.
  $loi = $variables['elements']['#loi'];
  //provide the label
  $variables['label'] = $loi->label();
  //provide the alias
  $variables['url'] = $loi->toUrl()->toString();
  //provide the view mode
  $variables['view_mode'] = $variables['elements']['#view_mode'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
