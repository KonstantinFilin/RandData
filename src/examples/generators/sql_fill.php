<?php

require "../init.php";

$dbhost = "localhost";
$dbname = "test";
$dbuser = "root";
$dbpass = "123";
$dsn = sprintf("mysql:dbname=%s;host=%s", $dbname, $dbhost);

try {
    $dbh = new PDO($dsn, $dbuser, $dbpass);
    $rows = $dbh->query("show TABLES", PDO::FETCH_COLUMN, 0);

    foreach ($rows as $tblName) {        
        $rowCountSql = "SELECT count(*) FROM `" . $tblName . "`";
        $rowCountRes = $dbh->query($rowCountSql, PDO::FETCH_COLUMN, 0);
        $rowCount = $rowCountRes->fetch();
        
        if ($rowCount > 0) {
            echo "Non empty table: [" . $tblName . "]. Rows count: " . $rowCount . PHP_EOL;
            die;
        }

        $createSqlRow = "SHOW CREATE TABLE `" . $tblName . "`";
        $createSqlRes = $dbh->query($createSqlRow, PDO::FETCH_COLUMN, 1);
        $sql = $createSqlRes->fetch();
        $tuple = new \RandData\Fabric\Tuple\SqlCreateTable($sql);
        $generator = new \RandData\Generator($tuple, 20);
        $formatter = new \RandData\Formatter\Sql($generator, $tblName);
        $sqlIns = $formatter->build();
        $dbh->exec($sqlIns);
    }
    
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

echo PHP_EOL;