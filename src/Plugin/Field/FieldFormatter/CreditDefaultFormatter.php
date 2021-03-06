<?php

namespace Drupal\ewp_courses\Plugin\Field\FieldFormatter;

use Drupal\Component\Utility\Html;
use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'ewp_credit_default' formatter.
 *
 * @FieldFormatter(
 *   id = "ewp_credit_default",
 *   label = @Translation("Default"),
 *   field_types = {
 *     "ewp_credit"
 *   }
 * )
 */
class CreditDefaultFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
      // Implement default settings.
    ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    return [
      // Implement settings form.
    ] + parent::settingsForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];
    // Implement settings summary.

    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];

    foreach ($items as $delta => $item) {
      $level_list = ['ba' => t('Bachelor'),'ma' => t('Masters'),'phd' => t('PhD')];
      $level_key = $item->level;
      $level = ($level_key) ? $level_list[$level_key] : NULL;
      $elements[$delta] = [
        '#theme' => 'ewp_credit_default',
        '#value' => $item->value,
        '#scheme' => $item->scheme,
        '#level' => $level,
      ];
    }

    return $elements;
  }

}
