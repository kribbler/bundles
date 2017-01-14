<?php

require_once( 'kohana/i18n.php' );

class I18n extends Kohana_I18n
{
	static $_cache = array();

	/**
	 * Returns the translation table for a given language.
	 *
	 *    // Get all defined Spanish messages
	 *     $messages = I18n::load('es-es');
	 *
	 * @param   string   language to load
	 * @return  array
	 */
	public static function load($lang)
	{
		if (isset(self::$_cache[$lang]))
		{
			return self::$_cache[$lang];
		}

		// New translation table
		$table = array();

		// Split the language: language, region, locale, etc
		$parts = explode('-', $lang);

		$file = "languages/{$lang}.php";

		$table = self::load_file($file);

		// Cache the translation table locally
		return self::$_cache[$lang] = $table;
	}

	protected static function load_file($file)
	{
		return require_once($file);
	}

}
