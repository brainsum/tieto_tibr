<?php

namespace Drupal\tieto_tibr\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Field\WidgetInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * A widget bar.
 *
 * @FieldWidget(
 *   id = "tibbr_widget",
 *   label = @Translation("Tibbr widget"),
 *   field_types = {
 *     "tibbr"
 *   }
 * )
 */
class TibbrWidget extends WidgetBase implements WidgetInterface {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $element = [];

    $element['tibbr_subject_id'] = [
      '#type' => 'number',
      '#title' => t('Subject ID'),
      '#description' => t("Set to 0 if you don't want to fill out."),
      '#default_value' => isset($items[$delta]->tibbr_subject_id) ? $items[$delta]->tibbr_subject_id : 0,
      '#size' => 15,
    ];
    $element['tibbr_subject_name'] = [
      '#type' => 'textfield',
      '#title' => t('Subject Name'),
      '#description' => t("Left it empty if you don't want to fill out."),
      '#default_value' => isset($items[$delta]->tibbr_subject_name) ? $items[$delta]->tibbr_subject_name : "",
      '#size' => 30,
      '#maxlength' => 100,
    ];

    // If cardinality is 1, ensure a label is output for the field by wrapping
    // it in a details element.
    if ($this->fieldDefinition->getFieldStorageDefinition()->getCardinality() == 1) {
      $element += [
        '#type' => 'fieldset',
	/* '#attributes' => array('class' => array('container-inline')) */
      ];
    }

    return $element;
  }

}
