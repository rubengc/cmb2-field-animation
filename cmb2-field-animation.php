<?php
/**
 * @package      CMB2\Field_Animation
 * @author       Tsunoa
 * @copyright    Copyright (c) Tsunoa
 *
 * Plugin Name: CMB2 Field Type: Animation
 * Plugin URI: https://github.com/rubengc/cmb2-field-animation
 * GitHub Plugin URI: https://github.com/rubengc/cmb2-field-animation
 * Description: CMB2 field type to allow pick an order of predefined options.
 * Version: 1.0.0
 * Author: Tsunoa
 * Author URI: https://tsunoa.com
 * License: GPLv2+
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
            add_action( 'admin_enqueue_scripts', array( $this, 'setup_admin_scripts' ) );

            add_action( 'cmb2_render_animation', array( $this, 'render' ), 10, 5 );
            add_action( 'cmb2_sanitize_animation', array( $this, 'sanitize' ), 10, 4 );
        }

        /**
         * Render field
         */
        public function render( $field, $value, $object_id, $object_type, $field_type ) {
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
                    'bounce' => 'Bounce',
                    'flash' => 'Flash',
                    'pulse' => 'Pulse',
                    'rubberBand' => 'Rubber Band',
                    'shake' => 'Shake',
                    'swing' => 'Swing',
                    'tada' => 'Tada',
                    'wobble' => 'Wobble',
                    'jello' => 'Jello',
                );
            }

            if( in_array( 'entrances', $selected_groups ) || in_array( 'bouncing_entrances', $selected_groups ) ) {
                $options['Bouncing Entrances'] = array(
                    'bounceIn' => 'Bounce In',
                    'bounceInDown' => 'Bounce In Down',
                    'bounceInLeft' => 'Bounce In Left',
                    'bounceInRight' => 'Bounce In Right',
                    'bounceInUp' => 'Bounce In Up',
                );
            }

            if( in_array( 'exits', $selected_groups ) || in_array( 'bouncing_exits', $selected_groups ) ) {
                $options['Bouncing Exits'] = array(
                    'bounceOut' => 'Bounce Out',
                    'bounceOutDown' => 'Bounce Out Down',
                    'bounceOutLeft' => 'Bounce Out Left',
                    'bounceOutRight' => 'Bounce Out Right',
                    'bounceOutUp' => 'Bounce Out Up',
                );
            }

            if( in_array( 'entrances', $selected_groups ) || in_array( 'fading_entrances', $selected_groups ) ) {
                $options['Fading Entrances'] = array(
                    'fadeIn' => 'Fade In',
                    'fadeInDown' => 'Fade In Down',
                    'fadeInDownBig' => 'Fade In Down Big',
                    'fadeInLeft' => 'Fade In Left',
                    'fadeInLeftBig' => 'Fade In Left Big',
                    'fadeInRight' => 'Fade In Right',
                    'fadeInRightBig' => 'Fade In Right Big',
                    'fadeInUp' => 'Fade In Up',
                    'fadeInUpBig' => 'Fade In Up Big',
                );
            }

            if( in_array( 'exits', $selected_groups ) || in_array( 'fading_exits', $selected_groups ) ) {
                $options['Fading Exits'] = array(
                    'fadeOut' => 'Fade Out',
                    'fadeOutDown' => 'Fade Out Down',
                    'fadeOutDownBig' => 'Fade Out Down Big',
                    'fadeOutLeft' => 'Fade Out Left',
                    'fadeOutLeftBig' => 'Fade Out Left Big',
                    'fadeOutRight' => 'Fade Out Right',
                    'fadeOutRightBig' => 'Fade Out Right Big',
                    'fadeOutUp' => 'Fade Out Up',
                    'fadeOutUpBig' => 'Fade Out Up Big',
                );
            }

            if( in_array( 'flippers', $selected_groups ) ) {
                $options['Flippers'] = array(
                    'flip' => 'Flip',
                    'flipInX' => 'Flip In X',
                    'flipInY' => 'Flip In Y',
                    'flipOutX' => 'Flip Out X',
                    'flipOutY' => 'Flip Out Y',
                );
            }

            if( in_array( 'lightspeed', $selected_groups ) ) {
                $options['Light Speed'] = array(
                    'lightSpeedIn' => 'Light Speed In',
                    'lightSpeedOut' => 'Light Speed Out',
                );
            }

            if( in_array( 'entrances', $selected_groups ) || in_array( 'rotating_entrances', $selected_groups ) ) {
                $options['Rotating Entrances'] = array(
                    'rotateIn' => 'Rotate In',
                    'rotateInDownLeft' => 'Rotate In Down Left',
                    'rotateInDownRight' => 'Rotate In Down Right',
                    'rotateInUpLeft' => 'Rotate In Up Left',
                    'rotateInUpRight' => 'Rotate In Up Right',
                );
            }

            if( in_array( 'exits', $selected_groups ) || in_array( 'rotating_exits', $selected_groups ) ) {
                $options['Rotating Exits'] = array(
                    'rotateOut' => 'Rotate Out',
                    'rotateOutDownLeft' => 'Rotate Out Down Left',
                    'rotateOutDownRight' => 'Rotate Out Down Right',
                    'rotateOutUpLeft' => 'Rotate Out Up Left',
                    'rotateOutUpRight' => 'Rotate Out Up Right',
                );
            }

            if( in_array( 'entrances', $selected_groups ) || in_array( 'sliding_entrances', $selected_groups ) ) {
                $options['Sliding Entrances'] = array(
                    'slideInUp' => 'Slide In Up',
                    'slideInDown' => 'Slide In Down',
                    'slideInLeft' => 'Slide In Left',
                    'slideInRight' => 'Slide In Right',

                );
            }

            if( in_array( 'exits', $selected_groups ) || in_array( 'sliding_exits', $selected_groups ) ) {
                $options['Sliding Exits'] = array(
                    'slideOutUp' => 'Slide Out Up',
                    'slideOutDown' => 'Slide Out Down',
                    'slideOutLeft' => 'Slide Out Left',
                    'slideOutRight' => 'Slide Out Right',

                );
            }

            if( in_array( 'entrances', $selected_groups ) || in_array( 'zoom_entrances', $selected_groups ) ) {
                $options['Zoom Entrances'] = array(
                    'zoomIn' => 'Zoom In',
                    'zoomInDown' => 'Zoom In Down',
                    'zoomInLeft' => 'Zoom In Left',
                    'zoomInRight' => 'Zoom In Right',
                    'zoomInUp' => 'Zoom In Up',
                );
            }

            if( in_array( 'exits', $selected_groups ) || in_array( 'zoom_exits', $selected_groups ) ) {
                $options['Zoom Exits'] = array(
                    'zoomOut' => 'Zoom Out',
                    'zoomOutDown' => 'Zoom Out Down',
                    'zoomOutLeft' => 'Zoom Out Left',
                    'zoomOutRight' => 'Zoom Out Right',
                    'zoomOutUp' => 'Zoom Out Up',
                );
            }

            if( in_array( 'specials', $selected_groups ) ) {
                $options['Specials'] = array(
                    'hinge' => 'Hinge',
                    'rollIn' => 'Roll In',
                    'rollOut' => 'Roll Out',
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
            wp_register_script( 'cmb-animation', plugins_url( 'js/animation.js', __FILE__ ), array( 'jquery' ), self::VERSION, true );
            wp_enqueue_script( 'cmb-animation' );

            wp_enqueue_style( 'animate-css', plugins_url( 'css/animate.css', __FILE__ ), array(), self::VERSION );
            wp_enqueue_style( 'cmb-field-animation', plugins_url( 'css/animation.css', __FILE__ ), array(), self::VERSION );
            wp_enqueue_style( 'animate-css' );
            wp_enqueue_style( 'cmb-animation' );

        }

    }

    $cmb2_field_animation = new CMB2_Field_Animation();
}
