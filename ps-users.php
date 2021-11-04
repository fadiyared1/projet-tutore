<?php

class PSUsers
{
	static $table_name = "";

	static function init()
	{
		global $wpdb;
		PSUsers::$table_name = $wpdb->prefix . 'ps_users';

		PSUsers::maybe_create_table();
	}

	static function maybe_create_table()
	{
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

		$table_name = PSUsers::$table_name;

		$create_users_table_sql =
			"CREATE TABLE {$table_name}
			(
				id int(16) NOT NULL auto_increment primary key,
				numero varchar(16) NOT NULL,
				INDEX numero_index(numero)
			)";

		maybe_create_table($table_name, $create_users_table_sql);
	}

	static function add_users($numeros)
	{
		global $wpdb;

		$table_name = PSUsers::$table_name;

		$sql = "INSERT INTO {$table_name} (numero) VALUES ";

		foreach ($numeros as $numero)
		{
			$sql .= "($numero),";
		}
		$sql = substr($sql, 0, -1);

		$wpdb->query($sql);
	}

	static function get_user($numero)
	{
		global $wpdb;

		$table_name = PSUsers::$table_name;

		$prepared_statement = $wpdb->prepare("SELECT id FROM {$table_name} WHERE numero = %d", $numero);
		$values = $wpdb->get_col($prepared_statement);

		if (count($values) > 0)
		{
			return $values[0];
		}
		else
		{
			return null;
		}
	}

	static function is_numero_valid($numero)
	{
		return PSUsers::get_user($numero) != null;
	}
}
