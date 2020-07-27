<?php

namespace Drupal\ewp_courses\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityPublishedInterface;

/**
 * Provides an interface for defining Learning Opportunity Specification entities.
 *
 * @ingroup ewp_courses
 */
interface LoSpecificationInterface extends ContentEntityInterface, EntityChangedInterface, EntityPublishedInterface {

  /**
   * Add get/set methods for your configuration properties here.
   */

  /**
   * Gets the Learning Opportunity Specification name.
   *
   * @return string
   *   Name of the Learning Opportunity Specification.
   */
  public function getName();

  /**
   * Sets the Learning Opportunity Specification name.
   *
   * @param string $name
   *   The Learning Opportunity Specification name.
   *
   * @return \Drupal\ewp_courses\Entity\LoSpecificationInterface
   *   The called Learning Opportunity Specification entity.
   */
  public function setName($name);

  /**
   * Gets the Learning Opportunity Specification creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Learning Opportunity Specification.
   */
  public function getCreatedTime();

  /**
   * Sets the Learning Opportunity Specification creation timestamp.
   *
   * @param int $timestamp
   *   The Learning Opportunity Specification creation timestamp.
   *
   * @return \Drupal\ewp_courses\Entity\LoSpecificationInterface
   *   The called Learning Opportunity Specification entity.
   */
  public function setCreatedTime($timestamp);

}
