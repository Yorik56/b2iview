<?php

namespace Drupal\b2iview\Plugin\views\argument;

use Drupal;
use Drupal\views\Plugin\views\argument\ArgumentPluginBase;

/**
 * Custom contextual filter for your b2iview module.
 *
 * @ViewsArgument("b2i_custom_argument")
 */
class B2iCustomArgument extends ArgumentPluginBase {

  /**
   * {@inheritdoc}
   */
  public function query($group_by = FALSE) {
    // Si l'argument est fourni, il s'agit de la valeur pour le champ "field_catalogue".
    $catalogueValue = $this->argument;

    // Nous filtrons toujours par type "mobilier".
    $this->query->addWhere(0, 'node_field_data.type', 'mobilier', '=');

    if ($catalogueValue) {
      // Ajouter une jointure pour le champ field_catalogue.
      $definition = [
        'table' => 'node__field_catalogue',
        'field' => 'entity_id',
        'left_table' => 'node_field_data',
        'left_field' => 'nid',
        'operator' => '=',
      ];
      $join = Drupal::service('plugin.manager.views.join')->createInstance('standard', $definition);

      // Ajoutez la jointure à la requête.
      $this->query->addRelationship('node__field_catalogue', $join, 'node_field_data');

      // Si une valeur pour "field_catalogue" est fournie, ajoutez cette condition.
      $this->query->addWhere(0, 'node__field_catalogue.field_catalogue_target_id', $catalogueValue, '=');
    }
  }

}

