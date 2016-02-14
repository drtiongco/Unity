<?php
	namespace Unity\Versioning;
	
	include_once("globalEnums.php");
	include_once("globalVariables.php");
	/*
	 *
	 * Version aware interfaces and traits
	 *
	*/
	
	interface IVersionAware {
		public static function getVersionNo();
		public static function setVersionNo($verNo);
		public static function getEnvironment();
		public static function setEnvironment($newEnv);
	}
	
	trait TVersionAware {
		private static $versionNumber = null;
		private static $environment = null;
		
		final public static function getVersionNo() {
			return self::$versionNumber;
		}
		
		final public static function setVersionNo($verNo) {
			if (isset(self::$versionNumber)) {
				die("Class version is already set to {" . self::getVersionNo() . "}. <br/>Operation aborted.");
			}
			
			self::$versionNumber = $verNo;
		}
		
		final public static function getEnvironment() {
			if (!isset($GLOBALS['AppEnv'])) {
				self::$environment = \Unity\Enumerations\APPENV::DevEnvironment;
				echo "Global variable AppEnv not set <br/>";
			} else {
				if (!(self::$environment == $GLOBALS['AppEnv'])) {
					die("Class and application environment mismatch.");
				}
			}
			return self::$environment;
		}		

		final public static function setEnvironment($newEnv) {
			if (isset(self::$environment)) {
				die("Environment is already set. Operation aborted.");
			} elseif ($newEnv != $GLOBALS['AppEnv']) {
				die("Settings does not match operting environment. Operation aborted.");
			} else {
				self::$environment = $newEnv;
			}
		}
	}
?>
