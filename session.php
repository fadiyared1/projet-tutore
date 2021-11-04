<?php

add_action('init', 'start_session_wp', 1);
function start_session_wp()
{
	if (!session_id())
	{
		session_start();
	}
}

function end_session()
{
	session_destroy();
}
