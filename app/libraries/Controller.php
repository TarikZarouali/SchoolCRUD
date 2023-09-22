<?php
// Dit wordt de parentclass van alle andere controller
// We loaden de model en de view
class Controller {
  // Geen properties
  

  public function model($model) {
    require_once(APPROOT . '/models/' . $model . '.php');
    return new $model();
  }

  public function view($view, $data = []) {
    if (file_exists(APPROOT . '/views/' . $view . '.php')) {
      require_once(APPROOT . '/views/' . $view . '.php');
    } else {
      die('View bestaat niet');
    }
  }
}