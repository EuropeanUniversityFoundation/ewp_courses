<?php

namespace Drupal\ewp_courses\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class LoSpecificationTypeForm.
 */
class LoSpecificationTypeForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $los_type = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $los_type->label(),
      '#description' => $this->t("Label for the Learning Opportunity Specification type."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $los_type->id(),
      '#machine_name' => [
        'exists' => '\Drupal\ewp_courses\Entity\LoSpecificationType::load',
      ],
      '#disabled' => !$los_type->isNew(),
    ];

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $los_type = $this->entity;
    $status = $los_type->save();

    switch ($status) {
      case SAVED_NEW:
        $this->messenger()->addMessage($this->t('Created the %label Learning Opportunity Specification type.', [
          '%label' => $los_type->label(),
        ]));
        break;

      default:
        $this->messenger()->addMessage($this->t('Saved the %label Learning Opportunity Specification type.', [
          '%label' => $los_type->label(),
        ]));
    }
    $form_state->setRedirectUrl($los_type->toUrl('collection'));
  }

}
