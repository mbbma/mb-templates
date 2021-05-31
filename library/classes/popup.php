<?php
	class BlockPopup{
		public $name;
		public $title;
		public $form_id;
        public $popup;
        public $multi_titles;
        public $multi_names;

		function __construct($name, $title, $form_id){
            $this->name = $name;
            $this->title = $title;
            $this->form_id = $form_id;
        }
        
        function set_multi_titles($multi_titles,$number_of_multi_popups){
            $result = [];
            foreach ($multi_titles as $element) {
                $result[$element['id']][] = $element;
            }
            foreach($result[$number_of_multi_popups] as $key => $row){
                $this->multi_titles .= '<h3 class="h2 popup-title" data-title="'.strtolower(str_replace(" ", "-",  $row['name'])).'">
                                            '. $row['title'].'
                                        </h3>';
            }
           
        }

        function set_multi_names($multi_names,$number_of_multi_popups){
            $result = [];
            foreach ($multi_names as $element) {
                $result[$element['id']][] = $element;
            }
            foreach($result[$number_of_multi_popups] as $key => $row){
                $this->multi_names .= strtolower(str_replace(" ", "-",  $row['name'])) . ' ';
            }
        }

		function get_popup(){
            $this->popup = '
                            <div class="popup" data-name="'.strtolower(str_replace(" ", "-",  $this->name)).'">
                                <div class="close">
                                    <div class="line first-line"></div>
                                    <div class="line last-line"></div>
                                </div>
                                <div class="content">
                                    <div class="text-center">
                                        <h3 class="h2">
                                            '. $this->title.'
                                        </h3>
                                        <div class="form">
                                            '.do_shortcode('[gravityform id="'. $this->form_id.'" title="false" description="false" ajax="true"]').'
                                        </div>
                                    </div>
                                </div>
                            </div>';
			return $this->popup;
        }

        function get_multi_titles_popup(){
       
            $this->popup = '
                            <div class="popup multiple-titles" data-name="'.$this->multi_names.'">
                                <div class="close">
                                    <div class="line first-line"></div>
                                    <div class="line last-line"></div>
                                </div>
                                <div class="content">
                                    <div class="text-center">
                                        '.$this->multi_titles.'
                                        <div class="form">
                                            '.do_shortcode('[gravityform id="'. $this->form_id.'" title="false" description="false" ajax="true"]').'
                                        </div>
                                    </div>
                                </div>
                            </div>';
			return $this->popup;
		}

	}

?>