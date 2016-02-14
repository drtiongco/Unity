<?php
	namespace Unity\DynamicAttributes;
	
	/*
	 *
	 * Dynamic Attributes 
	 *	A dynamic attribute are pieces of data that can be added to instances of an object that implements it.
	 *	Normally, attributes are defined during the design of a class. However, as business changes over time,
	 *	there are significant number of changes required to class; most of which are simply additional fields.
	 *	By using dynamic attributes, one can make use of schema definition files to dynamically extend the
	 *	attributes or dynamically extend the attributes on an individual instance manner.
	 *
	 */
	interface IDynamicAttributes {
		public function getData(Array $Attributes);
		public function setData(Array $Attributes);
		public function delData(Array $Attributes);
	}

	trait TDynamicAttributes {
		private $dynamicAttributes = [];
		
		public function getData(Array $Attributes){
			if (empty($Attributes)) {
				return $this->dynamicAttributes;
			} else {
				return (array_intersect_key($this->dynamicAttributes, array_fill_keys($Attributes,null)));
			}
		}
		
		public function setData(Array $Attributes){
			$this->dynamicAttributes = array_merge($this->dynamicAttributes, $Attributes);
			
			if (isset($this->hasChanged)) {
				$this->hasChanged = true;
			}
			
			return count($this->dynamicAttributes);
		}
		
		public function delData(Array $Attributes){
			$iniCount = count($this->dynamicAttributes);
			$this->dynamicAttributes = array_diff_key($this->dynamicAttributes, array_fill_keys($Attributes,null));
			
			if (isset($this->hasChanged)) {
				$this->hasChanged = ($iniCount > count($this->dynamicAttributes));
			}
			
			return count($this->dynamicAttributes);
		}
		
		public function getKeys() {
			return (array_key($this->dynamicAttributes));
		}
	}

 
?>
