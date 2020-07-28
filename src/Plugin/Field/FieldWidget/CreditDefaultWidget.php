<?php

namespace Drupal\ewp_courses\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'ewp_credit_default' widget.
 *
 * @FieldWidget(
 *   id = "ewp_credit_default",
 *   module = "ewp_courses",
 *   label = @Translation("Default"),
 *   field_types = {
 *     "ewp_credit"
 *   }
 * )
 */
class CreditDefaultWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
      'value_placeholder' => 'Number of credits',
      'scheme_placeholder' => 'Credit scheme',
    ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $elements = [];

    $elements['value_placeholder'] = [
      '#type' => 'textfield',
      '#title' => t('Placeholder for value'),
      '#default_value' => $this->getSetting('value_placeholder'),
      '#description' => t('Text that will be shown inside the value field until a value is entered. This hint is usually a sample value or a brief description of the expected format.'),
    ];
    $elements['scheme_placeholder'] = [
      '#type' => 'textfield',
      '#title' => t('Placeholder for scheme'),
      '#default_value' => $this->getSetting('scheme_placeholder'),
      '#description' => t('Text that will be shown inside the scheme field until a value is entered. This hint is usually a sample value or a brief description of the expected format.'),
    ];

    return $elements;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];

    if (!empty($this->getSetting('value_placeholder'))) {
      $summary[] = t('Value placeholder: @placeholder', ['@placeholder' => $this->getSetting('value_placeholder')]);
    }
    if (!empty($this->getSetting('scheme_placeholder'))) {
      $summary[] = t('Scheme placeholder: @placeholder', ['@placeholder' => $this->getSetting('scheme_placeholder')]);
    }

    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $element = $element + [
      '#type' => 'fieldset',
      '#attributes' => ['class' => ['container-inline']],
    ];

    $element['value'] = [
      '#type' => 'number',
      '#default_value' => isset($items[$delta]->value) ? $items[$delta]->value : NULL,
      '#placeholder' => $this->getSetting('value_placeholder'),
      '#step' => pow(0.5, $this->getFieldSetting('scale')),
      '#min' => 0,
    ];

    $element['scheme'] = [
      '#type' => 'textfield',
      '#default_value' => isset($items[$delta]->scheme) ? $items[$delta]->scheme : NULL,
      '#size' => 30,
      '#placeholder' => $this->getSetting('scheme_placeholder'),
      '#maxlength' => $this->getFieldSetting('max_length'),
    ];

    $element['level'] = [
      '#type' => 'select',
      '#options' => ['ba' => t('Bachelor'),'ma' => t('Masters'),'phd' => t('PhD')],
      '#empty_option' => '- '.t('Level').' -',
      '#empty_value' => '',
      '#default_value' => isset($items[$delta]->level) ? $items[$delta]->level : NULL,
    ];

    return $element;
  }

}
