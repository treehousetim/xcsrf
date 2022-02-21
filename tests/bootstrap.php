<?php

define( 'BASEPATH', realpath( dirname( __FILE__ ) . '/..' ) );
include BASEPATH . '/vendor/autoload.php';

use treehousetim\xcsrf\xcsrf;
use treehousetim\xcsrf\test\testStorage;
use treehousetim\xcsrf\test\testRequest;

xcsrf::getInstance( new testStorage(), new testRequest() );
