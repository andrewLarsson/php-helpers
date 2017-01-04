<?php namespace AndrewLarsson\Helpers;

use \stdClass;

class STDObject extends stdClass {
	public function __construct(Array $properties = []) {
		$this->__init($properties);
	}

	public function __call($method, Array $arguments) {
		if (
			property_exists($this, $method)
			&& is_callable($this->$method)
		) {
			return call_user_func_array($this->$method, $arguments);
		} else {
			throw new Exception("STDObject method \"" . $method . "()\" does not exist.");
		}
	}

	final protected function __init(Array $properties) {
		foreach ($properties as $property => $value) {
			$this->$property = $value;
		}
	}
}
?>
