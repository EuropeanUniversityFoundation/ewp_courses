<?php

namespace Drupal\ewp_courses;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Learning Opportunity Specification entity.
 *
 * @see \Drupal\ewp_courses\Entity\LoSpecification.
 */
class LoSpecificationAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\ewp_courses\Entity\LoSpecificationInterface $entity */

    switch ($operation) {

      case 'view':

        if (!$entity->isPublished()) {

          return AccessResult::allowedIfHasPermission($account, 'view unpublished learning opportunity specification entities');
        }


        return AccessResult::allowedIfHasPermission($account, 'view published learning opportunity specification entities');

      case 'update':

        return AccessResult::allowedIfHasPermission($account, 'edit learning opportunity specification entities');

      case 'delete':

        return AccessResult::allowedIfHasPermission($account, 'delete learning opportunity specification entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add learning opportunity specification entities');
  }

}
