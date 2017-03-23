<?php
/*
Plugin Name: CMB2 Field Type: Animation
Plugin URI: https://github.com/rubengc/cmb2-field-order
GitHub Plugin URI: https://github.com/rubengc/cmb2-field-order
Description: CMB2 field type to allow pick an order of predefined options.
Version: 1.0.0
Author: Ruben Garcia
Author URI: http://rubengc.com/
License: GPLv2+
*/


// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;

if( !class_exists( 'CMB2_Field_Animation' ) ) {
    /**
     * Class CMB2_Field_Animation
     */
    class CMB2_Field_Animation {

        /**
         * Current version number
         */
        const VERSION = '1.0.1';

        /**
         * Initialize the plugin by hooking into CMB2
         */
        public function __construct() {
            add_action( 'cmb2_render_animation', array( $this, 'render' ), 10, 5 );
            add_action( 'cmb2_sanitize_animation', array( $this, 'sanitize' ), 10, 4 );
        }

        /**
         * Render field
         */
        public function render( $field, $value, $object_id, $object_type, $field_type ) {
            $this->setup_admin_scripts();

            $selected_groups = array(
                'seekers',

                'entrances', // All entrances
                'bouncing_entrances',
                'fading_entrances',
                'rotating_entrances',
                'sliding_entrances',
                'zoom_entrances',

                'exits', // All exits
                'bouncing_exits',
                'fading_exits',
                'rotating_exits',
                'sliding_exits',
                'zoom_exits',

                'flippers',
                'lightspeed',
                'specials',
            );

            if( is_array( $field->args( 'groups' ) ) ) {
                $selected_groups = $field->args( 'groups' );
            }

            $options = array();

            if( in_array( 'seekers', $selected_groups ) ) {
                $options['Attention Seekers'] = array(
                    'bounce' => 'bounce',
                    'flash' => 'flash',
                    'pulse' => 'pulse',
                    'rubberBand' => 'rubberBand',
                    'shake' => 'shake',
                    'swing' => 'swing',
                    'tada' => 'tada',
                    'wobble' => 'wobble',
                    'jello' => 'jello',
                );
            }

            if( in_array( 'entrances', $selected_groups ) || in_array( 'bouncing_entrances', $selected_groups ) ) {
                $options['Bouncing Entrances'] = array(
                    'bounceIn' => 'bounceIn',
                    'bounceInDown' => 'bounceInDown',
                    'bounceInLeft' => 'bounceInLeft',
                    'bounceInRight' => 'bounceInRight',
                    'bounceInUp' => 'bounceInUp',
                );
            }

            if( in_array( 'exits', $selected_groups ) || in_array( 'bouncing_exits', $selected_groups ) ) {
                $options['Bouncing Exits'] = array(
                    'bounceOut' => 'bounceOut',
                    'bounceOutDown' => 'bounceOutDown',
                    'bounceOutLeft' => 'bounceOutLeft',
                    'bounceOutRight' => 'bounceOutRight',
                    'bounceOutUp' => 'bounceOutUp',
                );
            }

            if( in_array( 'entrances', $selected_groups ) || in_array( 'fading_entrances', $selected_groups ) ) {
                $options['Fading Entrances'] = array(
                    'fadeIn' => 'fadeIn',
                    'fadeInDown' => 'fadeInDown',
                    'fadeInDownBig' => 'fadeInDownBig',
                    'fadeInLeft' => 'fadeInLeft',
                    'fadeInLeftBig' => 'fadeInLeftBig',
                    'fadeInRight' => 'fadeInRight',
                    'fadeInRightBig' => 'fadeInRightBig',
                    'fadeInUp' => 'fadeInUp',
                    'fadeInUpBig' => 'fadeInUpBig',
                );
            }

            if( in_array( 'exits', $selected_groups ) || in_array( 'fading_exits', $selected_groups ) ) {
                $options['Fading Exits'] = array(
                    'fadeOut' => 'fadeOut',
                    'fadeOutDown' => 'fadeOutDown',
                    'fadeOutDownBig' => 'fadeOutDownBig',
                    'fadeOutLeft' => 'fadeOutLeft',
                    'fadeOutLeftBig' => 'fadeOutLeftBig',
                    'fadeOutRight' => 'fadeOutRight',
                    'fadeOutRightBig' => 'fadeOutRightBig',
                    'fadeOutUp' => 'fadeOutUp',
                    'fadeOutUpBig' => 'fadeOutUpBig',
                );
            }

            if( in_array( 'flippers', $selected_groups ) ) {
                $options['Flippers'] = array(
                    'flip' => 'flip',
                    'flipInX' => 'flipInX',
                    'flipInY' => 'flipInY',
                    'flipOutX' => 'flipOutX',
                    'flipOutY' => 'flipOutY',
                );
            }

            if( in_array( 'lightspeed', $selected_groups ) ) {
                $options['Lightspeed'] = array(
                    'lightSpeedIn' => 'lightSpeedIn',
                    'lightSpeedOut' => 'lightSpeedOut',
                );
            }

            if( in_array( 'entrances', $selected_groups ) || in_array( 'rotating_entrances', $selected_groups ) ) {
                $options['Rotating Entrances'] = array(
                    'rotateIn' => 'rotateIn',
                    'rotateInDownLeft' => 'rotateInDownLeft',
                    'rotateInDownRight' => 'rotateInDownRight',
                    'rotateInUpLeft' => 'rotateInUpLeft',
                    'rotateInUpRight' => 'rotateInUpRight',
                );
            }

            if( in_array( 'exits', $selected_groups ) || in_array( 'rotating_exits', $selected_groups ) ) {
                $options['Rotating Exits'] = array(
                    'rotateOut' => 'rotateOut',
                    'rotateOutDownLeft' => 'rotateOutDownLeft',
                    'rotateOutDownRight' => 'rotateOutDownRight',
                    'rotateOutUpLeft' => 'rotateOutUpLeft',
                    'rotateOutUpRight' => 'rotateOutUpRight',
                );
            }

            if( in_array( 'entrances', $selected_groups ) || in_array( 'sliding_entrances', $selected_groups ) ) {
                $options['Sliding Entrances'] = array(
                    'slideInUp' => 'slideInUp',
                    'slideInDown' => 'slideInDown',
                    'slideInLeft' => 'slideInLeft',
                    'slideInRight' => 'slideInRight',

                );
            }

            if( in_array( 'exits', $selected_groups ) || in_array( 'sliding_exits', $selected_groups ) ) {
                $options['Sliding Exits'] = array(
                    'slideOutUp' => 'slideOutUp',
                    'slideOutDown' => 'slideOutDown',
                    'slideOutLeft' => 'slideOutLeft',
                    'slideOutRight' => 'slideOutRight',

                );
            }

            if( in_array( 'entrances', $selected_groups ) || in_array( 'zoom_entrances', $selected_groups ) ) {
                $options['Zoom Entrances'] = array(
                    'zoomIn' => 'zoomIn',
                    'zoomInDown' => 'zoomInDown',
                    'zoomInLeft' => 'zoomInLeft',
                    'zoomInRight' => 'zoomInRight',
                    'zoomInUp' => 'zoomInUp',
                );
            }

            if( in_array( 'exits', $selected_groups ) || in_array( 'zoom_exits', $selected_groups ) ) {
                $options['Zoom Exits'] = array(
                    'zoomOut' => 'zoomOut',
                    'zoomOutDown' => 'zoomOutDown',
                    'zoomOutLeft' => 'zoomOutLeft',
                    'zoomOutRight' => 'zoomOutRight',
                    'zoomOutUp' => 'zoomOutUp',
                );
            }

            if( in_array( 'specials', $selected_groups ) ) {
                $options['Specials'] = array(
                    'hinge' => 'hinge',
                    'rollIn' => 'rollIn',
                    'rollOut' => 'rollOut',
                );
            }

            $options_string = '';

            $options_string .= $field_type->select_option( array(
                'label'		=> __( 'Select an animation', 'cmb2' ),
                'value'		=> '',
                'checked'	=> ! $value
            ) );

            foreach ( $options as $group_label => $group ) {
                $options_string .= '<optgroup label="'. $group_label .'">';
                foreach ( $group as $key => $label ) {
                    $options_string .= $field_type->select_option( array(
                        'label'		=> $label,
                        'value'		=> $key,
                        'checked'	=> $value == $key
                    ) );
                }
                $options_string .= '</optgroup>';
            }

            echo $field_type->select( array(
                'name'    => $field_type->_name(),
                'desc'    => '',
                'id'      => $field_type->_id(),
                'options' => $options_string,
            ) );

            if( $field->args( 'preview' ) ) {
                echo '<span class="cmb-animation-preview button">' . __( 'Animate it', 'cmb2' ) . '</span>';
            }

            $field_type->_desc( true, true );
        }

        /**
         * Optionally save the latitude/longitude values into two custom fields
         */
        public function sanitize( $override_value, $value, $object_id, $field_args ) {
            $fid = $field_args['id'];

            if( $field_args['render_row_cb'][0]->data_to_save[$fid] ) {
                $value = $field_args['render_row_cb'][0]->data_to_save[$fid];
            } else {
                $value = false;
            }

            return $value;
        }

        /**
         * Enqueue scripts and styles
         */
        public function setup_admin_scripts() {
            wp_register_script( 'cmb-animation', plugins_url( 'js/animation.js', __FILE__ ), array( 'jquery' ), self::VERSION );
            wp_enqueue_script( 'cmb-animation' );

            wp_enqueue_style( 'animate-css', plugins_url( 'css/animate.css', __FILE__ ), array(), self::VERSION );
            wp_enqueue_style( 'cmb-field-animation', plugins_url( 'css/animation.css', __FILE__ ), array(), self::VERSION );
            wp_enqueue_style( 'animate-css' );
            wp_enqueue_style( 'cmb-animation' );

        }

    }

    $cmb2_field_animation = new CMB2_Field_Animation();
}
