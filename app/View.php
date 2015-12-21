<?php

class View {

  function __construct() {
    
  }


  /**
   * Render
   * @param string $name name of the folder en file
   */
  public function render($path, $data) {
    require 'views/' . $path . '.php';
  }


}
