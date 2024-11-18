<?php

if ( class_exists( 'WP_Customize_Control' ) ) {
	// Add all your Customizer Custom Control classes here...

	/**
	 * Sample Custom Control
	 */
	
	class My_Awesome_Custom_Control extends WP_Customize_Control {
        /**
            * The type of control being rendered
            */
        public $type = 'sample_custom_control';
        
        /**
            * Enqueue our scripts and styles
            */
        public function enqueue() {
            wp_enqueue_script( 'actapptpl-MyAwesomeCustomControl', get_template_directory_uri() . '/js/MyAwesomeCustomControl.js', array(), 100, true );
        }
        
        /**
            * Render the control in the customizer
            */
            public function render_content() {
               //echo($this->link());
               //$tmpLink = $this->link();
               echo($this->id);
                ?>
                
                <input type="hidden" <?php $this->link(); ?>></input>
                <div class="simple-notice-custom-control ui message">
                <div class="ui button" action="myaw1" settingval="primary" setting="<?php echo( $this->id ); ?>">Primary Option</div>
                <div class="ui button" action="myaw1" settingval="secondary" setting="<?php echo( $this->id ); ?>">Secondary Option</div>
                <?php if( !empty( $this->label ) ) { ?>
                      <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                   <?php } ?>
                   <?php if( !empty( $this->description ) ) { ?>
                      <span class="customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
                   <?php } ?>
                </div>
                <?php
                }
	}
	class ActAppSt_Color_Picker extends WP_Customize_Control {
        /**
            * The type of control being rendered
            */
        public $type = 'actappst_color_picker';
        
        /**
            * Enqueue our scripts and styles
            */
        public function enqueue() {
            wp_enqueue_script( 'actappst_color_picker', get_template_directory_uri() . '/js/actappst_color_picker.js', array(), 100, true );
        }
        
        /**
            * Render the control in the customizer
            */
            public function render_content() {
               //echo($this->link());
               //$tmpLink = $this->link();
              
                ?>
                

                <input type="hidden" <?php $this->link(); ?>></input>

                <?php if( !empty( $this->label ) ) { ?>
                      <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                   <?php } ?>
                   <?php if( !empty( $this->description ) ) { ?>
                      <span class="customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
                   <?php } ?>
                   
                <div class="simple-notice-custom-control ui message">
                <div class="ui compact button" action="actappst_color_picker__select" settingval="white" setting="<?php echo( $this->id ); ?>">White</div>
                <div class="ui compact button black" action="actappst_color_picker__select" settingval="black" setting="<?php echo( $this->id ); ?>">Black</div>
                <div class="ui compact button blue" action="actappst_color_picker__select" settingval="blue" setting="<?php echo( $this->id ); ?>">Blue</div>
                <div class="ui compact button green" action="actappst_color_picker__select" settingval="green" setting="<?php echo( $this->id ); ?>">Green</div>
                <?php
                }
	}

 }

