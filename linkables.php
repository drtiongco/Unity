<?php
	namespace Unity\Linkables;
	
	/*
	 *
	 * Linkable Objects
	 *	A linkable object allows instances of objects that implement this interface to establish "links" to one another.
	 *	This allows object to have a loose binding to one another. Some common uses of this technique are
	 *		- Creating graphs and trees
	 *		- Creating a linked list and other similar data structures
	 *		- Associating information such as student, his payments, his grades, and so on.
	 *
	 */

	include_once("globalEnums.php");

	interface ILinkable {
		public function getLinks();
		public function getLink($linkID);
		public function getLinkID();
		public function inform($messageType, ILinkable &$Source);
		public function broadcast($messageType);
		public function addLink(ILinkable &$Object);
		public function unLink(ILinkable &$Object);
		public function unLinkAll();
        public function isLinked($linkID);
	}

	trait TLinkable {

		private $linkedObjects = [];

		public function getLinks() {
			return ($this->linkedObjects);
		}
		
		public function getLink($linkID) {
			return ($this->linkedObjects[$linkID]);
		}
		
		abstract public function getLinkID();
		
		abstract public function inform($messageType,ILinkable &$Source);
		
		public function broadcast($messageType) {
			foreach($this->linkedObjects as $key => $Instance) {
				$Instance->inform($messageType, $this);
			}
		}
		
		public function addLink(ILinkable &$Object) {
			$linkID = $Object->getLinkID();
					
			$this->linkedObjects[$linkID] = $Object;
            if (!$Object->isLinked($this->getLinkID())) {
                $Object->addLink($this);
                $Object->inform(\Unity\Enumerations\LINKMSGTYPE::OnLink, $this);
            }

			return (count($this->linkedObjects));
		}
		
		public function unLink(ILinkable &$Object) {
			$linkID = $Object->getLinkID();
			
            if ($this->isLinked($linkID)) {
                $position = array_search($linkID,array_keys($this->linkedObjects));
                array_splice($this->linkedObjects,$position,1);
                $Object->unLink($this);
                $Object->inform(\Unity\Enumerations\LINKMSGTYPE::OnUnLink, $this);
            }
			return (count($this->linkedObjects));
		}
		
		public function unLinkAll() {
			foreach($this->linkedObjects as $key => $Object) {
                $this->unLink($Object);
            }
			return (count($this->linkedObjects));
		}
        
        public function isLinked($linkID) {
            return array_key_exists($linkID, $this->linkedObjects);
        }

	}
?>
