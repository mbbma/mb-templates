<?php
	class BlockButton{
		public $text;
		public $type;
		public $link;
		public $linkTitle;
		public $popup;
		public $button;

		function __construct($text){
			$this->text = $text;
			$this->type = 'btn-primary';
		}

		function getButton(){
			return $button;
		}

		function setType($type){
			$this->type = $type;
		}

		function setLink($link, $linkTitle){
			$this->link = $link;
			$this->linkTitle = $linkTitle;

			$button = '
				<a href="'.$this->link.'" title="'.$this->linkTitle.'" class="'.$this->type.'">
					'.$this->text.'
				</a>
			';
		}
		
		function setPopup($popup){
			$this->popup = $popup;

			$button = '
				<div class="'.$this->type.' show-popup" data-value="'.$this->popup.'">
					'.$this->text.'
				</div>
			';
		}
	}
?>