![Unit Tests](https://github.com/treehousetim/xcsrf/workflows/Unit%20Tests/badge.svg)

# treehousetim/xcsrf
A library to enable simple cross site request forgery blocking

## Installing

`composer require treehousetim/xcsrf`

## Using

```php
<?php namespace App\Controllers;

use treehousetim\xcsrf\xcsrf;

if( $_POST )
{
	xcsrf::getInstance()->protect();
	// process POST request here.
}

echo '<form>';
echo '<input type="hidden" value="' . xcsrf::getInstance()->getCode() . '"></input>';
echo '<input type="submit" value="Submit"></input>';
echo '</form>';

```