<?php
/**
 * @file
 * theme-settings.php
 *
 * Provides theme settings.
 *
 * @see ./includes/settings.inc
 */

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\Component\Serialization\Json;
use GuzzleHttp\Exception\RequestException;

/**
 * Implements hook_form_FORM_ID_alter().
 */
function kinex1_form_system_theme_settings_alter(&$form, FormStateInterface $form_state, $form_id = NULL) {
  $base_theme_path = drupal_get_path('theme', 'mbase');
  if (!$base_theme_path) {
    $form = array();
    $form['nombase'] = array(
      '#type' => 'markup',
      '#title' => t('Error'),
      '#markup' => '<div class = "nombasetheme">This theme depend on 
        <strong><a href = "https://www.drupal.org/project/mbase" target = "_blank">mbase</a></strong> 
        base theme. Please install <strong><a href = "https://www.drupal.org/project/mbase" target = "_blank">
        mbase</a></strong> theme first. Please read the readme.txt file.</div>',
    );
    unset($form['olor_scheme_form']);
  }
  else {
    include_once $base_theme_path . '/includes/helper.inc';
    $regions = array(
    'home_welcome' => t('Homepage Welcome'),
    'content_aqua_green' => t('Homepage Aqua'),
    'footer' => t('Footer'),
    'footer_menu' => t('Footer Menu'),
    'footer_copyright' => t('Footer Copyright'),
  );
    $home_page_settings = _mbase_homepage_settings($regions, 'kinex1');
    $form = $form + $home_page_settings;
  }
}

