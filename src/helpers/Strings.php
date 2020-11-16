<?php
namespace andrewdanilov\yandexmap;

class Strings
{
	public static function cleanScriptStr($text)
	{
		$text = trim($text);
		$text = preg_replace('~[\n\r]+~', ' ', $text);
		$text = addslashes($text);
		return $text;
	}

	public static function cleanScriptText($text)
	{
		$text = trim($text);
		$text = preg_replace('~[\n\r]+~', '<br>', $text);
		$text = addslashes($text);
		return $text;
	}
}