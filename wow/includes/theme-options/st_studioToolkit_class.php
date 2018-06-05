<?php
/**
 * TOOLS CLASS
 *
 * @package wow
 * @author Chrom Themes
 * @link http://chromthemes.com
 * @version 2.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class CHfw_studioToolkit_class {

	/**
	 * Check if current request is made via AJAX
	 *
	 * @return mixed
	 */
	public function is_ajax_request() {
		if ( ! empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) == 'xmlhttprequest' ) {
			return true;
		}

		return false;
	}


	/**
	 * Current URL
	 *
	 * @return mixed
	 */
	public function getCurrentUrl() {
		$pageURL = 'http';
		if ( isset( $_SERVER["HTTPS"] ) and $_SERVER["HTTPS"] == "on" ) {
			$pageURL .= "s";
		}
		$pageURL .= "://";
		if ( $_SERVER["SERVER_PORT"] != "80" ) {
			$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
		}

		return $pageURL;
	}

	/**
	 * file_extension
	 * find the file extension
	 *
	 * @access puplic
	 *
	 * @param string $file_name file names
	 *
	 * @return string
	 */
	public function fileExtension( $file_name ) {
		$file_extension = strtolower( substr( strrchr( $file_name, '.' ), 1 ) );

		return $file_extension;
	}

	/*
	 *
	 * https://secure.php.net/manual/tr/function.parse-url.php
	 * https://secure.php.net/parse_str
	 * https://secure.php.net/manual/tr/function.http-build-query.php
	 *
	 */


	/**
	 * file info
	 * find the file extension
	 *
	 * @access puplic
	 *
	 * @param string $file_name
	 *            dosya isimleri
	 *
	 * @return string
	 */
	public function fileInfo( $file_name ) {
		return pathinfo( $file_name );
	}

	/**
	 * Resize image on the fly
	 *
	 * @param  int $attachment_id Attachment ID
	 * @param  int $width Width
	 * @param  int $height Height
	 * @param  boolean $crop Crop or not
	 *
	 * @return string|bool            URL of resized image, original file if error
	 */
	public function rw_resize( $attachment_id, $width, $height, $crop = true ) {
		// Get upload directory info
		$upload_info = wp_upload_dir();
		$upload_dir  = $upload_info['basedir'];
		$upload_url  = $upload_info['baseurl'];

		// Get file path info
		$path      = get_attached_file( $attachment_id );
		$path_info = pathinfo( $path );
		$rel_path  = str_replace( $upload_dir, '', $path_info['dirname'] );

		// Generate new size
		$resized = image_make_intermediate_size( $path, $width, $height, $crop );

		if ( $resized ) {
			return "{$upload_url}{$rel_path}/{$resized['file']}";
		} else {
			// return original if fails
			return "{$upload_url}{$rel_path}/{$path_info['basename']}";
		}
	}

	/**
	 * file info
	 * find the file extension
	 *
	 * @access puplic
	 *
	 * @param string $file_name
	 *            fille name
	 *
	 * @return string
	 */
	public function fileName( $file_name, $breakinword = 50 ) {
		$path_parts = pathinfo( $file_name );
		if ( $breakinword != 50 ) {
			$path_parts['filename'] = substr( $path_parts['filename'], 0, $breakinword );
		}

		return $path_parts['filename'];
	}

	/**
	 *SEO URL
	 *
	 * notes http://stackoverflow.com/questions/14114411/remove-all-special-characters-from-a-string
	 * @access puplic
	 *
	 * @param string $string
	 *
	 * @return string
	 */
	public function seo_friendly_url( $string ) {
		$string = str_replace( array( '[\', \']' ), '', $string );
		$string = preg_replace( '/\[.*\]/U', '', $string );
		$string = preg_replace( '/&(amp;)?#?[a-z0-9]+;/i', '-', $string );
		$string = htmlentities( $string, ENT_COMPAT, 'utf-8' );
		$string = preg_replace( '/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );
		$string = preg_replace( array( '/[^a-z0-9]/i', '/[-]+/' ), '-', $string );

		return strtolower( trim( $string, '-' ) );
	}

	/**
	 *SEO URL
	 *
	 * notes http://stackoverflow.com/questions/14114411/remove-all-special-characters-from-a-string
	 * @access puplic
	 *
	 * @param string $string
	 *
	 * @return string
	 */
	public function wow_admin_path() {
		// Replace the site base URL with the absolute path to its installation directory.
		$admin_path = str_replace( esc_url( home_url() ) . '/', ABSPATH, get_admin_url() );

		// Make it filterable, so other plugins can hook into it.
		$admin_path = apply_filters( 'my_plugin_get_admin_path', $admin_path );

		return $admin_path;
	}


}

$chToolkit = new CHfw_studioToolkit_class();


class CHfw_place_holder_image_size {
	function stnc_resize( $options_values ) {
		global $CHfw_themeSettingsOptions, $CHfw_rdx_options, $CHfw_placeholder_image;
		$shop_image_size_site_get_option_values = get_option( $options_values );
		$wow_setup_options_values            = json_decode( get_option( $CHfw_themeSettingsOptions ), true );
		if ( isset( $CHfw_rdx_options['placeholder_image_shop']['url'] ) && $CHfw_rdx_options['placeholder_image_shop']['url'] != '' ) {
			$CHfw_placeholder_image = $CHfw_rdx_options['placeholder_image_shop']['url'];
		}

		$toolkit       = new CHfw_studioToolkit_class();
		$filename      = $toolkit->fileName( $CHfw_placeholder_image );
		$fileExtension = $toolkit->fileExtension( $CHfw_placeholder_image );
		if ( $fileExtension == 'jpg' ) {
			$fileExtension_mimme = 'image/jpg';
		} elseif ( $fileExtension == 'png' ) {
			$fileExtension_mimme = 'image/png';
		}
		$original_placeholder_image = parse_url( $CHfw_placeholder_image )['path'];

		$a_temp = explode( '/', $original_placeholder_image );
		unset( $a_temp[0] );
		$cach = count( $a_temp );
		unset( $a_temp[ $cach ] );
		$save_path = '/' . implode( '/', $a_temp ) . '/';

		$shop_image_width                     = $shop_image_size_site_get_option_values['width'];
		$shop_image_height                    = $shop_image_size_site_get_option_values['height'];
		$shop_image_size_site_options_values  = $shop_image_width . '*' . $shop_image_height;
		$shop_image_size_theme_options_values = $wow_setup_options_values->shop_catalog_image_size->width . '*' . $wow_setup_options_values->shop_catalog_image_size->height;
//if placeholder is changed
		if ( $wow_setup_options_values->place_holder_image != '' && $wow_setup_options_values->place_holder_image != $CHfw_placeholder_image ) {
			//echo 'pl ch changes';
			$shop_image_crop = $shop_image_size_site_get_option_values['crop'] === 1 ? true : false;
			$img             = wp_get_image_editor( $_SERVER['DOCUMENT_ROOT'] . $original_placeholder_image );
			if ( ! is_wp_error( $img ) ) {
				$img->resize( $shop_image_width, $shop_image_height, $shop_image_crop );
				$img->save( $_SERVER['DOCUMENT_ROOT'] . $save_path . $filename . '_' . $options_values, $fileExtension_mimme );
			}
			wow_setup_options();
		}

//if shop catalog imageSize=  witdh and height size changes
		if ( $shop_image_size_site_options_values != $shop_image_size_theme_options_values ) {
			//echo 'size ch changes';
			$shop_image_crop = $shop_image_size_site_get_option_values['crop'] === 1 ? true : false;
			$img             = wp_get_image_editor( $_SERVER['DOCUMENT_ROOT'] . $original_placeholder_image );
			if ( ! is_wp_error( $img ) ) {
				$img->resize( $shop_image_width, $shop_image_height, $shop_image_crop );
				$img->save( $_SERVER['DOCUMENT_ROOT'] . $save_path . $filename . '_' . $options_values, $fileExtension_mimme );
			}
			wow_setup_options();
		}
	}

	function get_place_holder_image( $options_values ) {
		global $CHfw_rdx_options;
		$shop_image_size_site_get_option_values = get_option( $options_values );
		if ( isset( $CHfw_rdx_options['placeholder_image_shop']['url'] ) && $CHfw_rdx_options['placeholder_image_shop']['url'] != '' ) {
			$CHfw_placeholder_image = $CHfw_rdx_options['placeholder_image_shop']['url'];
		}

		$original_placeholder_image = pathinfo( $CHfw_placeholder_image );

		return $original_placeholder_image['dirname'] . '/' . $original_placeholder_image['filename'] . '_' . $options_values . '.' . $original_placeholder_image['extension'];
	}

}

