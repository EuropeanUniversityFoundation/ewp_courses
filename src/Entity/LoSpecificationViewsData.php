<?php

namespace Drupal\ewp_courses\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Learning Opportunity Specification entities.
 */
class LoSpecificationViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.
    return $data;
  }

}
