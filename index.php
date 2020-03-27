<?php

function adminer_object()
{
	// Required to run any plugin.
	include_once "./plugins/plugin.php";

	// Plugins auto-loader.
	foreach (glob("plugins/*.php") as $filename) {
		include_once "./$filename";
	}

	// Specify enabled plugins here.
	$plugins = [
		new AdminerDumpJson,
		new AdminerEditTextarea,
		new AdminerEnumTypes,
		new AdminerPrettyJsonColumn('./adminer.php'),
	];

	return new AdminerPlugin($plugins);
}

// Include original Adminer or Adminer Editor.
include "./adminer.php";
