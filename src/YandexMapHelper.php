<?php

namespace andrewdanilov\yandexmap;

class YandexMapHelper
{
	/**
	 * Преобразует порядок следования координат.
	 * Может работать как со строковым представлением координат,
	 * разделенным пробелом или запятой, так и с массивом.
	 * Возвращает данные того же типа как и входящий аргумент.
	 *
	 * @param string|array $coordinates
	 * @param bool $remove_spaces - удалять пробельные символы из результирующей строки,
	 *                              если параметр $coordinates передан в виде строки
	 * @return string|array
	 */
	public static function invCoordsOrder($coordinates, $remove_spaces=false) {
		if (is_array($coordinates)) {
			return array_reverse($coordinates);
		} else {
			$coordinates = preg_split("/([,\s])/", $coordinates, -1, PREG_SPLIT_DELIM_CAPTURE);
			$coordinates = array_reverse($coordinates);
			$coordinates = implode("", $coordinates);
			if ($remove_spaces) {
				$coordinates = preg_replace("/[\s]/", "", $coordinates);
			}
			return $coordinates;
		}
	}

	/**
	 * Преобразует любую нотацию координат к строке с разделителем пробелом
	 * с заменой десятичной запятой в числах на точку
	 *
	 * @param string|array $coordinates
	 * @return string
	 */
	public static function coordsToSpaceNotation($coordinates)
	{
		$coordinates = static::coordsToArrayNotation($coordinates);
		return implode(" ", $coordinates);
	}

	/**
	 * Преобразует любую нотацию координат к строке с разделителем запятой
	 * с заменой десятичной запятой в числах на точку
	 *
	 * @param string|array $coordinates
	 * @return string
	 */
	public static function coordsToCommaNotation($coordinates)
	{
		$coordinates = static::coordsToArrayNotation($coordinates);
		if (is_array($coordinates) && !empty($coordinates)) {
			return implode(",", $coordinates);
		}
		return '';
	}

	/**
	 * Преобразует любую нотацию координат к массиву
	 * с заменой десятичной запятой в числах на точку
	 *
	 * @param string|array $coordinates
	 * @return array
	 */
	public static function coordsToArrayNotation($coordinates)
	{
		if (!is_array($coordinates)) {
			$coordinates = preg_replace("/[^\d\.\,\s]+/", "", $coordinates);
			if (preg_match("/^([\d\.]+)[\,\s]+([\d\.]+)$/", $coordinates, $matches)) {
				$coordinates = [$matches[1], $matches[2]];
			} elseif (preg_match("/^([\d\,]+)[\s]+([\d\,]+)$/", $coordinates, $matches)) {
				$coordinates = [$matches[1], $matches[2]];
			} else {
				$coordinates = [];
			}
		} else {
			$coordinates = array_slice($coordinates, 0, 2);
		}
		foreach ($coordinates as &$coordinate) {
			$coordinate = str_replace(",", ".", $coordinate);
		}
		return $coordinates;
	}
}