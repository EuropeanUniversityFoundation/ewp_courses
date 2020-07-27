<?php

namespace Drupal\ewp_courses\Entity;

use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityPublishedTrait;
use Drupal\Core\Entity\EntityTypeInterface;

/**
 * Defines the Learning Opportunity Specification entity.
 *
 * @ingroup ewp_courses
 *
 * @ContentEntityType(
 *   id = "los",
 *   label = @Translation("Learning Opportunity Specification"),
 *   bundle_label = @Translation("Learning Opportunity Specification type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\ewp_courses\LoSpecificationListBuilder",
 *     "views_data" = "Drupal\ewp_courses\Entity\LoSpecificationViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\ewp_courses\Form\LoSpecificationForm",
 *       "add" = "Drupal\ewp_courses\Form\LoSpecificationForm",
 *       "edit" = "Drupal\ewp_courses\Form\LoSpecificationForm",
 *       "delete" = "Drupal\ewp_courses\Form\LoSpecificationDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\ewp_courses\LoSpecificationHtmlRouteProvider",
 *     },
 *     "access" = "Drupal\ewp_courses\LoSpecificationAccessControlHandler",
 *   },
 *   base_table = "los",
 *   translatable = FALSE,
 *   permission_granularity = "bundle",
 *   admin_permission = "administer learning opportunity specification entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "bundle" = "type",
 *     "label" = "label",
 *     "uuid" = "uuid",
 *     "langcode" = "langcode",
 *     "published" = "status",
 *   },
 *   links = {
 *     "canonical" = "/ewp/los/{los}",
 *     "add-page" = "/ewp/los/add",
 *     "add-form" = "/ewp/los/add/{los_type}",
 *     "edit-form" = "/ewp/los/{los}/edit",
 *     "delete-form" = "/ewp/los/{los}/delete",
 *     "collection" = "/admin/ewp/los/list",
 *   },
 *   bundle_entity_type = "los_type",
 *   field_ui_base_route = "entity.los_type.edit_form",
 *   common_reference_target = TRUE,
 * )
 */
class LoSpecification extends ContentEntityBase implements LoSpecificationInterface {

  use EntityChangedTrait;
  use EntityPublishedTrait;

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->get('label')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setName($name) {
    $this->set('label', $name);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCreatedTime($timestamp) {
    $this->set('created', $timestamp);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    // Add the published field.
    $fields += static::publishedBaseFieldDefinitions($entity_type);

    $fields['label'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Label'))
      ->setDescription(t('The internal label of the Learning Opportunity Specification entity.'))
      ->setSettings([
        'max_length' => 50,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -20
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -20
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(TRUE);

    $fields['los_id'] = BaseFieldDefinition::create('string')
      ->setLabel(t('LOS ID'))
      ->setDescription(t('Unique identifier of this LOS.'))
      ->setSettings([
        'max_length' => 50,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -19
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -19
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(TRUE);

    $fields['status']
      ->setDisplayOptions('form', [
        'type' => 'boolean_checkbox',
        'weight' => 20,
      ]);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }

}
