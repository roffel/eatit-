<?php

// Er zou een autloader gebruikt kunnen worden
require 'libs/Bootstrap.php';
require 'libs/Controller.php';
require 'libs/Model.php';
require 'libs/View.php';


// Libraries
require 'libs/Database.php';
require 'libs/Session.php';

// Configuraties
require 'config/paths.php';
require 'config/database.php';

$app = new Bootstrap();
