<?php

require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

class Users
{
	static $table_name = "";

	static function init()
	{
		global $wpdb;
		Users::$table_name = $wpdb->prefix . 'ps_users';

		Users::maybe_create_table();
	}

	static function maybe_create_table()
	{
		$table_name = Users::$table_name;

		$create_users_table_sql =
			"CREATE TABLE {$table_name}
			(id int(16) NOT NULL auto_increment,
			numero varchar(16) NOT NULL,
			INDEX numero_index(numero)";

		maybe_create_table($table_name, $create_users_table_sql);
	}

	static function is_numero_valid($numero)
	{
		global $wpdb;

		$table_name = Users::$table_name;

		$prepared_statement = $wpdb->prepare("SELECT id FROM {$table_name} WHERE numero = %d", $numero);
		$values = $wpdb->get_col($prepared_statement);

		var_dump($values);

		return count($values) > 0;
	}
}
