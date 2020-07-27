<?php

namespace Drupal\ewp_courses;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Learning Opportunity Specification entities.
 *
 * @ingroup ewp_courses
 */
class LoSpecificationListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Learning Opportunity Specification ID');
    $header['label'] = $this->t('Label');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var \Drupal\ewp_courses\Entity\LoSpecification $entity */
    $row['id'] = $entity->id();
    $row['label'] = Link::createFromRoute(
      $entity->label(),
      'entity.los.edit_form',
      ['los' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
