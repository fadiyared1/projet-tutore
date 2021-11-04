<?php

if (!defined('WPINC')) {
	die;
}

$shortcodes_folder = 'shortcodes';
require_once(join(DIRECTORY_SEPARATOR, array($shortcodes_folder, 'metadata.php')));
require_once(join(DIRECTORY_SEPARATOR, array($shortcodes_folder, 'identification.php')));
require_once(join(DIRECTORY_SEPARATOR, array($shortcodes_folder, 'feedback.php')));
