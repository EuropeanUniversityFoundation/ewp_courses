<?php

namespace Drupal\ewp_courses\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityPublishedInterface;

/**
 * Provides an interface for defining Learning Opportunity Instance entities.
 *
 * @ingroup ewp_courses
 */
interface LoInstanceInterface extends ContentEntityInterface, EntityChangedInterface, EntityPublishedInterface {

  /**
   * Add get/set methods for your configuration properties here.
   */

  /**
   * Gets the Learning Opportunity Instance name.
   *
   * @return string
   *   Name of the Learning Opportunity Instance.
   */
  public function getName();

  /**
   * Sets the Learning Opportunity Instance name.
   *
   * @param string $name
   *   The Learning Opportunity Instance name.
   *
   * @return \Drupal\ewp_courses\Entity\LoInstanceInterface
   *   The called Learning Opportunity Instance entity.
   */
  public function setName($name);

  /**
   * Gets the Learning Opportunity Instance creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Learning Opportunity Instance.
   */
  public function getCreatedTime();

  /**
   * Sets the Learning Opportunity Instance creation timestamp.
   *
   * @param int $timestamp
   *   The Learning Opportunity Instance creation timestamp.
   *
   * @return \Drupal\ewp_courses\Entity\LoInstanceInterface
   *   The called Learning Opportunity Instance entity.
   */
  public function setCreatedTime($timestamp);

}
