<?php

namespace Drupal\ewp_courses\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Learning Opportunity Specification type entity.
 *
 * @ConfigEntityType(
 *   id = "los_type",
 *   label = @Translation("Learning Opportunity Specification type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\ewp_courses\LoSpecificationTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\ewp_courses\Form\LoSpecificationTypeForm",
 *       "edit" = "Drupal\ewp_courses\Form\LoSpecificationTypeForm",
 *       "delete" = "Drupal\ewp_courses\Form\LoSpecificationTypeDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\ewp_courses\LoSpecificationTypeHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "los_type",
 *   admin_permission = "administer site configuration",
 *   bundle_of = "los",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/ewp/los_type/{los_type}",
 *     "add-form" = "/admin/ewp/los_type/add",
 *     "edit-form" = "/admin/ewp/los_type/{los_type}/edit",
 *     "delete-form" = "/admin/ewp/los_type/{los_type}/delete",
 *     "collection" = "/admin/ewp/los_type"
 *   }
 * )
 */
class LoSpecificationType extends ConfigEntityBundleBase implements LoSpecificationTypeInterface {

  /**
   * The Learning Opportunity Specification type ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Learning Opportunity Specification type label.
   *
   * @var string
   */
  protected $label;

}
