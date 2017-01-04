<?php namespace AndrewLarsson\Helpers;

abstract class InitializableAbstract {
	public function __construct(Array $properties = []) {
		$this->__init($properties);
	}

	final protected function __init(Array $properties) {
		foreach ($properties as $property => $value) {
			if (property_exists($this, $property)) {
				$this->$property = $value;
			}
		}
	}
}
?>
