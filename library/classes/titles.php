<?php
	class BlockTitle{
		public $title;
		public $type;
		public $look;
		public $subtitle = "";
		public $classes = "";

		function __construct($title, $type){
			$this->title = $title;
			$this->type = $type;
		}

		function getTitle(){
			return '
				<div class="titles'.$this->classes.'">
					<'.$this->type.' '.$this->look.'>'.$this->title.'</'.$this->type.'>
					'.$this->subtitle.'
				</div>
			';
		}

		function setLink($link, $linkTitle){
			$this->title = '
				<a href="'.$link.'" title="'.$linkTitle.'">
					'.$this->title.'
				</a>
			';
		}

		function setSubtitle($subtitle){
			$this->subtitle = '<h3 class="subtitle">'.$subtitle.'</h3>';
		}

		function setCentered(){
			$this->classes .= " text-center";
		}

		function setLook($look){
			$this->look = 'class="'.$look.'"';
		}
	}
?>
