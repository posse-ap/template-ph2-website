<?php

class Database {
  private static $db;

  static function get() {
      if(!isset(self::$db))
          self::$db = new PDO('mysql:host=db;dbname=posse', 'root', 'root');
          self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          self::$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

      return self::$db;
  }
}