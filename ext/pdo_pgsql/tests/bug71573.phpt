--TEST--
Bug #71573 (Segfault (core dumped) if paramno beyond bound)
--SKIPIF--
<?php
if (!extension_loaded('pdo') || !extension_loaded('pdo_pgsql')) die('skip not loaded');
require_once dirname(__FILE__) . '/../../../ext/pdo/tests/pdo_test.inc';
require_once dirname(__FILE__) . '/config.inc';
PDOTest::skip();
?>
--FILE--
<?php
require_once dirname(__FILE__) . '/../../../ext/pdo/tests/pdo_test.inc';
require_once dirname(__FILE__) . '/config.inc';
$db = PDOTest::test_factory(dirname(__FILE__) . '/common.phpt');

$statement = $db->prepare('select ?');
$statement->execute([ 'test', 'test', 'test' ]);

?>
--EXPECTF--
Warning: PDOStatement::execute(): SQLSTATE[HY093]: Invalid parameter number: parameter was not defined in %sbug71573.php on line %d
