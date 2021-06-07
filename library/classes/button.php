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
			return $this->button;
		}

		function setType($type){
			$this->type = $type;
		}

		function setLink($link, $linkTitle, $linkTarget){
			$this->link = $link;
			$this->linkTitle = $linkTitle;
			$target = $linkTarget == '_blank' ? ' target="_blank"' : '';

			$this->button = '
				<a href="'.$this->link.'" title="'.$this->linkTitle.'" class="'.$this->type.'"'.$target.'>
					'.$this->text.'
				</a>
			';
		}
		
		function setPopup($popup){
			add_global_popup($popup);
			$this->popup = $popup;

			$this->button = '
				<div class="'.$this->type.' show-popup" data-value="'.$this->popup.'">
					'.$this->text.'
				</div>
			';
		}
	}
?>
