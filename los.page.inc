<?php

/**
 * @file
 * Contains los.page.inc.
 *
 * Page callback for Learning Opportunity Specification entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Learning Opportunity Specification templates.
 *
 * Default template: los.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_los(array &$variables) {
  // Fetch LoSpecEntity Entity Object.
  $los = $variables['elements']['#los'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
