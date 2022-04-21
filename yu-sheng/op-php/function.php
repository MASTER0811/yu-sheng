<?php

class Mlpr {
  public function createRandomChar($scope) {
    if (empty($scope)) {
      return 'NULL';
    } elseif (!is_numeric($scope)) {
      return 'ERROR: only numbers';
    } else {
      $start_value = '1234567890qazwsxedcrfvtgbyhnujmikolpQAZWSXEDCRFVTGBYHNUJMIKOLP-_';
      $start_value_length = strlen($start_value)-1;
      $result = '';
      for ($i = 0; $i < $scope; $i++) {
        $char = mt_rand(0, $start_value_length);
        $result .= $start_value[$char];
      }
      return $result;
    }
  }
}