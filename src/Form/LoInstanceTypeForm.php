<?php

namespace Drupal\ewp_courses\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class LoInstanceTypeForm.
 */
class LoInstanceTypeForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $loi_type = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $loi_type->label(),
      '#description' => $this->t("Label for the Learning Opportunity Instance type."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $loi_type->id(),
      '#machine_name' => [
        'exists' => '\Drupal\ewp_courses\Entity\LoInstanceType::load',
      ],
      '#disabled' => !$loi_type->isNew(),
    ];

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $loi_type = $this->entity;
    $status = $loi_type->save();

    switch ($status) {
      case SAVED_NEW:
        $this->messenger()->addMessage($this->t('Created the %label Learning Opportunity Instance type.', [
          '%label' => $loi_type->label(),
        ]));
        break;

      default:
        $this->messenger()->addMessage($this->t('Saved the %label Learning Opportunity Instance type.', [
          '%label' => $loi_type->label(),
        ]));
    }
    $form_state->setRedirectUrl($loi_type->toUrl('collection'));
  }

}
