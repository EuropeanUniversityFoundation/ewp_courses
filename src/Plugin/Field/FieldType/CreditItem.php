<?php

namespace Drupal\ewp_courses\Plugin\Field\FieldType;

use Drupal\Component\Utility\Random;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'ewp_credit' field type.
 *
 * @FieldType(
 *   id = "ewp_credit",
 *   label = @Translation("Credit"),
 *   description = @Translation("Auxiliary definition of Course Instance Credit"),
 *   category = "EWP Courses",
 *   default_widget = "ewp_credit_default",
 *   default_formatter = "ewp_credit_default"
 * )
 */
class CreditItem extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultStorageSettings() {
    return [
      'precision' => 10,
      'scale' => 1,
      'max_length' => 255,
    ] + parent::defaultStorageSettings();
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    // Prevent early t() calls by using the TranslatableMarkup.
    $properties['value'] = DataDefinition::create('string')
      ->setLabel(new TranslatableMarkup('Value'))
      ->setRequired(TRUE);

    $properties['scheme'] = DataDefinition::create('string')
      ->setLabel(new TranslatableMarkup('Scheme'))
      ->setRequired(TRUE);

    $properties['level'] = DataDefinition::create('string')
      ->setLabel(new TranslatableMarkup('Level'))
      ->setRequired(TRUE);

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    $schema = [
      'columns' => [
        'value' => [
          'type' => 'numeric',
          'precision' => $field_definition->getSetting('precision'),
          'scale' => $field_definition->getSetting('scale'),
        ],
        'scheme' => [
          'type' => 'varchar',
          'length' => (int) $field_definition->getSetting('max_length'),
        ],
        'level' => [
          'type' => 'varchar',
          'length' => 32,
        ],
      ],
    ];

    return $schema;
  }

  /**
   * {@inheritdoc}
   */
  public function getConstraints() {
    $constraints = parent::getConstraints();

    if ($max_length = $this->getSetting('max_length')) {
      $constraint_manager = \Drupal::typedDataManager()->getValidationConstraintManager();
      $constraints[] = $constraint_manager->create('ComplexData', [
        'scheme' => [
          'Length' => [
            'max' => $max_length,
            'maxMessage' => t('%name: may not be longer than @max characters.', [
              '%name' => $this->getFieldDefinition()->getLabel(),
              '@max' => $max_length
            ]),
          ],
        ],
      ]);
    }

    $constraints[] = $constraint_manager->create('ComplexData', [
      'value' => [
        'Regex' => [
          'pattern' => '/^[+-]?((\d+(\.\d*)?)|(\.\d+))$/i',
        ],
      ],
    ]);

    return $constraints;
  }


  /**
   * {@inheritdoc}
   */
  public function storageSettingsForm(array &$form, FormStateInterface $form_state, $has_data) {
    $elements = [];

    $elements['precision'] = [
      '#type' => 'number',
      '#title' => t('Precision'),
      '#min' => 10,
      '#max' => 32,
      '#default_value' => $this->getSetting('precision'),
      '#description' => t('The total number of digits to store in the database, including those to the right of the decimal.'),
      '#disabled' => $has_data,
    ];

    $elements['scale'] = [
      '#type' => 'number',
      '#title' => t('Scale', [], ['context' => 'decimal places']),
      '#min' => 0,
      '#max' => 10,
      '#default_value' => $this->getSetting('scale'),
      '#description' => t('The number of digits to the right of the decimal.'),
      '#disabled' => $has_data,
    ];

    $elements['max_length'] = [
      '#type' => 'number',
      '#title' => t('Maximum length'),
      '#default_value' => $this->getSetting('max_length'),
      '#required' => TRUE,
      '#description' => t('The maximum length of the scheme in characters.'),
      '#min' => 1,
      '#disabled' => $has_data,
    ];

    return $elements;
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $value = $this->get('value')->getValue();
    return $value === NULL || $value === '';
  }

}
