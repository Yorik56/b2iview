<?php
use Drupal\views\Entity\View;

/**
 * Implements hook_views_data().
 */
function b2iview_views_data(): array {
  $data = [];

  $data['node']['custom_filter'] = [
    'title' => t('Mon filtre personnalisé'),
    'filter' => [
      'title' => t('Mon filtre personnalisé'),
      'help' => t('Description de ce que fait le filtre.'),
      'id' => 'b2i_custom_argument',
      'allow empty' => TRUE,
      'missing behavior' => ['hide row' => TRUE],
    ],
    'argument' => [
      'id' => 'b2i_custom_argument',
    ],
  ];

  return $data;
}
