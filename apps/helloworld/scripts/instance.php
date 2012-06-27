<?php
/**
 * sandbox
 *
 * @package App.sandbox
 */
namespace helloworld;

require_once dirname(dirname(dirname(__DIR__))) . '/package/BEAR/Framework/src/BEAR/Framework/Framework.php';
require_once dirname(__DIR__) . '/App.php';

$app = App::factory(App::RUN_MODE_PROD, true);
return $app;
