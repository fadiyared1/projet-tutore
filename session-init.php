<?php

if (!defined('WPINC')) {
	die;
}

function start_session_wp()
{
	if (!session_id()) {
		session_start();
	}
}

function end_session()
{
	session_destroy();
}
