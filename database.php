<?php
class Database {
  private static $dbName = "customers";
  private static $dbHost = "localhost";

  private static $cont = null;

  public function __construct() {
    die("Init function not allowed!");
  }

  public static function connect() {
    if ( null == self::$cont ) {
      try {
        self::$cont = new PDO( "sqlite:" . self::$dbName . ".db" );
      } catch (PDOException $e) {
        die($e->getMessage());
      }
      return self::$cont;
    }
  }

  public static function disconnect() {
    self::$cont = null;
  }
}
