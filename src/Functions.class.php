<?php namespace AndrewLarsson\Helpers;

use \Exception;
use AndrewLarsson\Helpers\InitializableAbstract;

class Functions {
	static public function array_clone(Array $array) {
		return array_map(function($element) {
			return ((is_array($element))
				? call_user_func(__FUNCTION__, $element)
				: ((is_object($element))
					? clone $element
					: $element
				)
			);
		}, $array);
	}

	static public function mexplode($delimiters, $string) {
		return explode(
			$delimiters[0],
			str_replace($delimiters, $delimiters[0], $string)
		);
	}

	static public function array_to_object(Array $properties, $objectType) {
		$object = null;
		if (!class_exists($objectType)) {
			throw new Exception("Class \"" . $objectType . "\" does not exist.");
		}
		if (is_subclass_of($objectType, InitializableAbstract::class)) {
			$object = new $objectType($properties);
		} else {
			$object = new $objectType();
			foreach ($properties as $property => $value) {
				if (property_exists($object, $property)) {
					$object->$property = $value;
				}
			}
		}
		return $object;
	}

	static public function camelCase($string, $delimeter = "_") {
		return lcfirst(implode(
			"",
			array_map(function($string) {
				return ucfirst($string);
			}, explode($delimeter, $string))
		));
	}

	static public function isAssocArray(Array $array) {
		return (bool) count(array_filter(array_keys($array), "is_string"));
	}
}
?>
