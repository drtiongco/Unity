<?php
	namespace Unity;
	include_once("Linkables.php");
	include_once("DynamicAttributes.php");
	include_once("Versionings.php");
	include_once("globalEnums.php");
	
	/*
	 *
	 * Root Class
	 *
	 */
	abstract class CRootClass implements 
		Linkables\ILinkable, 
		DynamicAttributes\IDynamicAttributes,
		Versioning\IVersionAware
		{
		use Linkables\TLinkable, 
			DynamicAttributes\TDynamicAttributes,
			Versioning\TVersionAware;
	}

	class CTestClass extends CRootClass {
		function getLinkID() {
			return "ID1";
		}
		function inform($messageType, Linkables\ILinkable &$Source) {}
	}
	
	$test = new CTestClass();
	
	//echo $test->getLinkID();
	$test->setVersionNo("1.00.0000");
	$test->setEnvironment(Enumerations\APPENV::DevEnvironment);
	echo "Object version is : {$test->getVersionNo()} <br/>";
	echo "Environment is : {$test->getEnvironment()} <br/>";
	
	// Trying out linkables
	class CLinkedClass extends CRootClass {
		function getLinkID() {
			return "ID2";
		}
		function inform($messageType, Linkables\ILinkable &$Source) {}
		
		function xx() {echo "XXX";}
	}
	
	class CLinkedAgain extends CRootClass {
		function getLinkID() {
			return "ID3";
		}
		function inform($messageType, Linkables\ILinkable &$Source) {}
		function yy() {echo "YYY";}
	}

	$test->setData(array("attrib1" => 1, "attrib2" => 2, "attrib3" => 3, "attrib4" => 4));
	print_r($test->getData([])); echo "<br/>";
	
	$test->delData(["attrib2","attrib4"]);
	print_r(json_encode($test->getData([]))); echo "<br/>";
	
?>
