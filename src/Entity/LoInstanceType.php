<?php

namespace Drupal\ewp_courses\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Learning Opportunity Instance type entity.
 *
 * @ConfigEntityType(
 *   id = "loi_type",
 *   label = @Translation("Learning Opportunity Instance type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\ewp_courses\LoInstanceTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\ewp_courses\Form\LoInstanceTypeForm",
 *       "edit" = "Drupal\ewp_courses\Form\LoInstanceTypeForm",
 *       "delete" = "Drupal\ewp_courses\Form\LoInstanceTypeDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\ewp_courses\LoInstanceTypeHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "loi_type",
 *   admin_permission = "administer site configuration",
 *   bundle_of = "loi",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/ewp/loi_type/{loi_type}",
 *     "add-form" = "/admin/ewp/loi_type/add",
 *     "edit-form" = "/admin/ewp/loi_type/{loi_type}/edit",
 *     "delete-form" = "/admin/ewp/loi_type/{loi_type}/delete",
 *     "collection" = "/admin/ewp/loi_type"
 *   }
 * )
 */
class LoInstanceType extends ConfigEntityBundleBase implements LoInstanceTypeInterface {

  /**
   * The Learning Opportunity Instance type ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Learning Opportunity Instance type label.
   *
   * @var string
   */
  protected $label;

}
