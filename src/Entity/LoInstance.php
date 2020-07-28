<?php

namespace Drupal\ewp_courses\Entity;

use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityPublishedTrait;
use Drupal\Core\Entity\EntityTypeInterface;

/**
 * Defines the Learning Opportunity Instance entity.
 *
 * @ingroup ewp_courses
 *
 * @ContentEntityType(
 *   id = "loi",
 *   label = @Translation("Learning Opportunity Instance"),
 *   bundle_label = @Translation("Learning Opportunity Instance type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\ewp_courses\LoInstanceListBuilder",
 *     "views_data" = "Drupal\ewp_courses\Entity\LoInstanceViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\ewp_courses\Form\LoInstanceForm",
 *       "add" = "Drupal\ewp_courses\Form\LoInstanceForm",
 *       "edit" = "Drupal\ewp_courses\Form\LoInstanceForm",
 *       "delete" = "Drupal\ewp_courses\Form\LoInstanceDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\ewp_courses\LoInstanceHtmlRouteProvider",
 *     },
 *     "access" = "Drupal\ewp_courses\LoInstanceAccessControlHandler",
 *   },
 *   base_table = "loi",
 *   translatable = FALSE,
 *   permission_granularity = "bundle",
 *   admin_permission = "administer learning opportunity instance entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "bundle" = "type",
 *     "label" = "label",
 *     "uuid" = "uuid",
 *     "langcode" = "langcode",
 *     "published" = "status",
 *   },
 *   links = {
 *     "canonical" = "/ewp/loi/{loi}",
 *     "add-page" = "/ewp/loi/add",
 *     "add-form" = "/ewp/loi/add/{loi_type}",
 *     "edit-form" = "/ewp/loi/{loi}/edit",
 *     "delete-form" = "/ewp/loi/{loi}/delete",
 *     "collection" = "/admin/ewp/loi/list",
 *   },
 *   bundle_entity_type = "loi_type",
 *   field_ui_base_route = "entity.loi_type.edit_form",
 *   common_reference_target = TRUE,
 * )
 */
class LoInstance extends ContentEntityBase implements LoInstanceInterface {

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
      ->setDescription(t('The internal label of this instance.'))
      ->setSettings([
        'max_length' => 50,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -20,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -20,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(TRUE);

    $fields['loi_id'] = BaseFieldDefinition::create('string')
      ->setLabel(t('LOI ID'))
      ->setDescription(t('Unique identifier of this LOI.'))
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
