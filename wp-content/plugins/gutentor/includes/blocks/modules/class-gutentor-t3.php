<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Gutentor_T3_Hooks' ) ) {

	/**
	 * Block Specific Hooks Class For Gutentor
	 *
	 * @package Gutentor
	 * @since 2.0.0
	 */
	class Gutentor_T3_Hooks {


		/**
		 * Gets an instance of this object.
		 * Prevents duplicate instances which avoid artefacts and improves performance.
		 *
		 * @static
		 * @access public
		 * @since 2.0.0
		 * @return object
		 */
		public static function get_instance() {

			// Store the instance locally to avoid private static replication
			static $instance = null;

			// Only run these methods if they haven't been ran previously
			if ( null === $instance ) {
				$instance = new self();
			}

			// Always return the instance
			return $instance;

		}

		/**
		 * Add Filter
		 *
		 * @access public
		 * @since 2.0.0
		 * @return void
		 */
		public function add_filter( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
			add_filter( $hook, array( $component, $callback ), $priority, $accepted_args );
		}

		/**
		 * Add Action
		 *
		 * @access public
		 * @since 2.0.0
		 * @return void
		 */
		public function add_action( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
			add_action( $hook, array( $component, $callback ), $priority, $accepted_args );
		}


		/**
		 * Run Block
		 *
		 * @access public
		 * @since 2.0.0
		 * @return void
		 */
		public function run() {
			/*Block Specific PHP hooks*/
			$this->add_filter( 'gutentor_term_module_main_wrap_class', $this, 'add_carousel_arrow_class', 15, 2 );
			$this->add_filter( 'gutentor_term_module_grid_row_class', $this, 'add_carousel_row', 15, 2 );
			$this->add_filter( 'gutentor_term_module_attr', $this, 'add_carousel_data', 15, 2 );
			$this->add_filter( 'gutentor_term_module_article_class', $this, 'add_carousel_class', 15, 2 );
			$this->add_filter( 'gutentor_term_module_before_block_items', $this, 'add_carousel_arrow', 15, 2 );
		}

		/**
		 * Adding Carousel Class
		 *
		 * @param {array} output
		 * @param {object} props
		 * @return {array}
		 */
		public function add_carousel_arrow_class( $output, $attributes ) {

			$gutentorBlockName = ( isset( $attributes['gName'] ) ) ? $attributes['gName'] : '';
			$block_list        = array( 'gutentor/t1' );
			if ( ! in_array( $gutentorBlockName, $block_list ) ) {
				return $output;
			}
			if ( ! isset( $attributes['t1CarouselOpt'] ) || ! $attributes['t1CarouselOpt']['enable'] ) {
				return $output;
			}
			if ( ! isset( $attributes['t1CarouselOpt']['arrowsPosition'] ) ) {
				return $output;
			}

			$arrow_postition       = $attributes['t1CarouselOpt']['arrowsPosition'];
			$enable_desktop_arrow  = ( isset( $attributes['t1CarouselOpt']['arrows'] ) ) ? $attributes['t1CarouselOpt']['arrows'] : false;
			$enable_tablet_arrow   = ( isset( $attributes['t1CarouselOpt']['arrowsT'] ) ) ? $attributes['t1CarouselOpt']['arrowsT'] : false;
			$enable_mobile_arrow   = ( isset( $attributes['t1CarouselOpt']['arrowsM'] ) ) ? $attributes['t1CarouselOpt']['arrowsM'] : false;
			$arrow_desktop_desktop = array_key_exists( 'desktop', $arrow_postition ) ? $arrow_postition['desktop'] : false;
			if ( $enable_desktop_arrow && $arrow_desktop_desktop ) {
				$output = gutentor_concat_space( $output, $arrow_desktop_desktop . '-desktop' );

			}
			$arrow_tablet_tablet = array_key_exists( 'tablet', $arrow_postition ) ? $arrow_postition['tablet'] : false;
			if ( $enable_tablet_arrow && $arrow_tablet_tablet ) {
				$output = gutentor_concat_space( $output, $arrow_tablet_tablet . '-tablet' );

			}
			$arrow_tablet_mobile = array_key_exists( 'mobile', $arrow_postition ) ? $arrow_postition['mobile'] : false;
			if ( $enable_mobile_arrow && $arrow_tablet_mobile ) {
				$output = gutentor_concat_space( $output, $arrow_tablet_mobile . '-mobile' );
			}
			return $output;
		}

		/**
		 * Adding Container Remove Classes
		 *
		 * @param {array} output
		 * @param {object} props
		 * @return string
		 */
		public function add_carousel_row( $output, $attributes ) {
			if ( ! isset( $attributes['t1CarouselOpt'] ) || ! $attributes['t1CarouselOpt']['enable'] ) {
				return $output;
			}

			$local_data = str_replace( 'grid-row', '', $output );
			if ( isset( $attributes['t1CarouselOpt']['carouselID'] ) ) {
				$local_data = gutentor_concat_space( $local_data, $attributes['t1CarouselOpt']['carouselID'] );
			}
			$local_data = gutentor_concat_space( $local_data, 'gutentor-module-carousel-row' );
			return $local_data;
		}

		/**
		 * Adding Carousel Data
		 *
		 * @param {array} output
		 * @param {object} props
		 * @return {array}
		 */
		public function add_carousel_data( $output, $attributes ) {
			if ( ! isset( $attributes['t1CarouselOpt'] ) || ! $attributes['t1CarouselOpt']['enable'] ) {
				return $output;
			}
			$t1CarouselOpt = $attributes['t1CarouselOpt'];
            $local_data    = array();
			if ( isset( $t1CarouselOpt['dots'] ) ) {
				$local_data['data-dots'] = ( $t1CarouselOpt['dots'] ) ? 'true' : 'false';
			}
			if ( isset( $t1CarouselOpt['dotsT'] ) ) {
				$local_data['data-dotstablet'] = ( $t1CarouselOpt['dotsT'] ) ? 'true' : 'false';
			}
			if ( isset( $t1CarouselOpt['dotsM'] ) ) {
				$local_data['data-dotsmobile'] = ( $t1CarouselOpt['dotsM'] ) ? 'true' : 'false';
			}
            if ( isset( $t1CarouselOpt['arrowNext'] ) ) {
                $local_data['data-nextarrow'] = ( $t1CarouselOpt['arrowNext'] ) ? $t1CarouselOpt['arrowNext'] : '';
            }
            if ( isset( $t1CarouselOpt['arrowsPrev'] ) ) {
                $local_data['data-prevarrow'] = ( $t1CarouselOpt['arrowsPrev'] ) ? $t1CarouselOpt['arrowsPrev'] : '';
            }
			if ( isset( $t1CarouselOpt['arrows'] ) ) {
				$local_data['data-arrows'] = ( $t1CarouselOpt['arrows'] ) ? 'true' : 'false';
			}
			if ( isset( $t1CarouselOpt['arrowsT'] ) ) {
				$local_data['data-arrowstablet'] = ( $t1CarouselOpt['arrowsT'] ) ? 'true' : 'false';
			}
			if ( isset( $t1CarouselOpt['arrowsM'] ) ) {
				$local_data['data-arrowsmobile'] = ( $t1CarouselOpt['arrowsM'] ) ? 'true' : 'false';
			}
			if ( isset( $t1CarouselOpt['arrowsPosition']['desktop'] ) ) {
				$local_data['data-arrowsPositionDesktop'] = ( $t1CarouselOpt['arrowsPosition']['desktop'] . '-desktop' );
			}
			if ( isset( $t1CarouselOpt['arrowsPosition']['tablet'] ) ) {
				$local_data['data-arrowsPositionTablet'] = ( $t1CarouselOpt['arrowsPosition']['tablet'] . '-tablet' );
			}
			if ( isset( $t1CarouselOpt['arrowsPosition']['mobile'] ) ) {
				$local_data['data-arrowsPositionMobile'] = ( $t1CarouselOpt['arrowsPosition']['mobile'] . '-mobile' );
			}
			if ( isset( $t1CarouselOpt['infinite'] ) ) {
                $local_data['data-infinite'] = ( $t1CarouselOpt['infinite'] ) ? 'true' : 'false';

            }
			if ( isset( $t1CarouselOpt['speed'] ) ) {
				$local_data['data-speed'] = $t1CarouselOpt['speed'];
			}
			if ( isset( $t1CarouselOpt['autoplay'] ) ) {
                $local_data['data-autoplay'] = ( $t1CarouselOpt['autoplay'] ) ? 'true' : 'false';
                if ( isset( $t1CarouselOpt['autoplaySpeed'] ) ) {
					$local_data['data-autoplayspeed'] = $t1CarouselOpt['autoplaySpeed'];
				}
			}
			if ( isset( $t1CarouselOpt['slideitem']['desktop'] ) ) {
				$local_data['data-slideitemdesktop'] = $t1CarouselOpt['slideitem']['desktop'];
			}
			if ( isset( $t1CarouselOpt['slideitem']['tablet'] ) ) {
				$local_data['data-slideitemtablet'] = $t1CarouselOpt['slideitem']['tablet'];
			}
			if ( isset( $t1CarouselOpt['slideitem']['mobile'] ) ) {
				$local_data['data-slideitemmobile'] = $t1CarouselOpt['slideitem']['mobile'];
			}
			if ( isset( $t1CarouselOpt['slidescroll']['desktop'] ) ) {
				$local_data['data-slidescroll-desktop'] = $t1CarouselOpt['slidescroll']['desktop'];
			}
			if ( isset( $t1CarouselOpt['slidescroll']['tablet'] ) ) {
				$local_data['data-slidescroll-tablet'] = $t1CarouselOpt['slidescroll']['tablet'];
			}
			if ( isset( $t1CarouselOpt['slidescroll']['mobile'] ) ) {
				$local_data['data-slidescroll-mobile'] = $t1CarouselOpt['slidescroll']['mobile'];
			}
			return $local_data;
		}

		/**
		 * Adding carousel class
		 *
		 * @param {array} output
		 * @param {object} props
		 * @return {array}
		 */
		public function add_carousel_class( $output, $attributes ) {

			if ( ! isset( $attributes['t1CarouselOpt'] ) || ! $attributes['t1CarouselOpt']['enable'] ) {
				return $output;
			}
			return gutentor_concat_space( $output, 'gutentor-carousel-item' );
		}

		/**
		 * Adding carousel class
		 *
		 * @param {array} output
		 * @param {object} props
		 * @return {array}
		 */
		public function add_carousel_arrow( $output, $attributes ) {

			$gutentorBlockName = ( isset( $attributes['gName'] ) ) ? $attributes['gName'] : '';
			$block_list        = array( 'gutentor/t1' );
			if ( ! in_array( $gutentorBlockName, $block_list ) ) {
				return $output;
			}
			if ( ! isset( $attributes['t1CarouselOpt'] ) || ! $attributes['t1CarouselOpt']['enable'] ) {
				return $output;
			}
			$t1CarouselOpt        = ( isset( $attributes['t1CarouselOpt'] ) && $attributes['t1CarouselOpt']['enable'] ) ? $attributes['t1CarouselOpt'] : false;
			$desktop_row_position = ( $t1CarouselOpt && $t1CarouselOpt['arrowsPosition']['desktop'] ) ? $t1CarouselOpt['arrowsPosition']['desktop'] . '-desktop' : false;
			if ( $desktop_row_position != 'gutentor-slick-a-default-desktop' ) {
				$output .= '<div class="gutentor-slick-arrows"></div>';
			}
			return $output;
		}
	}
}

/**
 * Return instance of  Gutentor_T3_Hooks class
 *
 * @since    1.0.0
 */
if ( ! function_exists( 'gutentor_t3_hooks' ) ) {

	function gutentor_t3_hooks() {
	    
	    return Gutentor_T3_Hooks::get_instance();
	}
}
gutentor_t3_hooks()->run();
