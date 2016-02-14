<?php
	namespace Unity\Enumerations;
	
	/*
	 * Enumeration type for ILinkable interface
	 *
	 * Usage: $msgType = LINKMSGTYPE::OnSave;
	 *
	 */
	abstract class LINKMSGTYPE {
		const OnLink = 1;
		const OnUnLink = 2;
		const OnDestroy = 3;
		const OnSave = 4;
		const OnLoad = 5;
		const OnChange = 6;
	}
	
	/*
	 * Enumeration type designed to represent various application environments
	 * 
	 * Usage : $appEnv = APPENG::Development;
	 *
	 */
	abstract class APPENV {
		const DevEnvironment = 1;
		const UATEnvironment = 2;
		const ProdEnvironment= 3;
	}
?>
