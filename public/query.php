<?php
// setup the autoloading
require_once 'C:\xampp\htdocs\MyOwnAPI\vendor\autoload.php';

// setup Propel
require_once 'C:\xampp\htdocs\MyOwnAPI\generated-conf\config.php';

use Anand\Make;
use Propel\Runtime\ActiveQuery\Criteria;

echo "hello";

$make = new Make();

$make->setBrandName("Suzuki");

$make->save();

$json_make = json_encode($make);

echo $json_make;

?>