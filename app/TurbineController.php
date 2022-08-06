<?php

namespace App;

class TurbineController
{
  protected $addresses = [];

  function ex(int $id)
  {
    $this->rcd();
    $id = $id;
    $address = $this->addresses[$id];
    return json_encode($address);
  }

  function rcd()
  {
    $file = fopen(__DIR__ . '/../turbines.csv', 'r');
    while (($line = fgetcsv($file)) !== FALSE) {
        $this->addresses[] = [
            $line[0],
            $line[1],
            $line[2]
        ];
    }

    fclose($file);
  }
}
?>
