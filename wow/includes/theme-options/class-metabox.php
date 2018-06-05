<?php
/**
 * METABOX OPTIONS
 * @package wow
 * @author Chrom Themes
 * @link http://www.chromthemes.com
 * notes
 * http://wordpress.stackexchange.com/questions/49773/how-to-add-a-class-to-meta-box
 * https://en.bainternet.info/how-i-add-a-wordpress-metabox/
 */
global $CHfw_meta_key;


class CHfw_MetaboxEngine
{
	public $nonce = 'st_studio';
	private $meta_key;
	private $fields;
	public $SaveMethodSingle = false;

	public function __construct($fields, $CHfw_meta_key_staff, $SaveMethodSingle = false)

	{
		$this->meta_key = $CHfw_meta_key_staff;
		$this->SaveMethodSingle = $SaveMethodSingle;

		if (is_admin()) {
			$this->fields = $fields;

			add_action('load-post.php', array($this, 'init_metabox'));
			add_action('load-post-new.php', array($this, 'init_metabox'));
		}
	}

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
	public function fileExtension($file_name)
	{
		if ($file_name != '') {
			$pathinfo = pathinfo($file_name);

			return $pathinfo['extension'];
		}
	}

	public function init_metabox()
	{
		// add meta box
		add_action('add_meta_boxes', array(
			&$this,
			'add_custom_meta_box'
		));

		// metabox save
		add_action('save_post', array(
			&$this,
			'meta_box_save'
		));
	}

	/**
	 * Save the Meta box values
	 * backup
	 */
	/** @noinspection PhpInconsistentReturnPointsInspection */
	public function meta_box_save_func_cancel($post_id)
	{

		// Stop the script when doing autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}

		// Verify the nonce. If insn't there, stop the script
		if (!isset($_POST[$this->nonce]) && !wp_verify_nonce($_POST[$this->nonce], basename(__FILE__))) {
			return $post_id;
		}

		// check permissions
		// Stop the script if the user does not have edit permissions
		if ('page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', get_the_id())) {
				return $post_id;
			}
		} elseif (!current_user_can('edit_post', get_the_id())) {
			return $post_id;
		}


		foreach ($this->fields['fields'] as $field) {
			$old = get_post_meta($post_id, $field['id'], true);
			$new = intval($_POST[$field['id']]);

			if ($new && $new != $old) {
				update_post_meta($post_id, $field['id'], $new);
			} elseif ('' == $new && $old) {
				delete_post_meta($post_id, $field['id'], $old);
			}
		}
	}

	/**
	 * Save the Meta box values
	 * @return mixed
	 */
	/** @noinspection PhpInconsistentReturnPointsInspection */
	public function meta_box_save($post_id)
	{

		if (wp_is_post_autosave($post_id)) {
			/** @noinspection PhpInconsistentReturnPointsInspection */
			return;
		}

		// Check if not a revision.
		if (wp_is_post_revision($post_id)) {
			/** @noinspection PhpInconsistentReturnPointsInspection */
			return;
		}

		// Stop the script when doing autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}

		$post_meta_ = array();

		if ($this->SaveMethodSingle) {

			foreach ($this->fields as $fields) {
				foreach ($fields['fields'] as $key => $field) {
					if ($field['type'] == 'gmap') {
						update_post_meta($post_id, $field['name'], $_POST[$field['name']]);
					} else {
						update_post_meta($post_id, $field['name'], sanitize_text_field($_POST[$field['name']]));
					}

				}
			}
		} else {
			foreach ($this->fields as $fields) {
				foreach ($fields['fields'] as $key => $field) {

						$post_meta_[$field['name']] = isset($_POST[$field['name']]) ? sanitize_text_field($_POST[$field['name']]) : '';

				}
			}
			// Update the meta field in the database.
			update_post_meta($post_id, $this->meta_key, $post_meta_);

		}
	}

	/**
	 * Register the Meta box
	 */
	public function add_custom_meta_box()
	{
		foreach ($this->fields as $key => $field) {
			add_meta_box(
				$field['name'],
				$field['title'],
				array(&$this, 'meta_box_output'),
				$field['page'],
				$field['context'],
				$field['priority'],
				$field
			);
		}
	}

	/**
	 * Output the Meta box
	 * parse -- html element tag
	 */
	public function meta_box_output($post, $field_arg)
	{

		$fields = ($field_arg['args']);


		echo '<input type="hidden" name="' . $this->nonce . '" value="', wp_create_nonce(basename(__FILE__)), '" />';
		echo '<div class="wp-core-ui  st_studio-Engine-Form" style="' . $fields['style'] . '"  class="' . $fields['class'] . $fields['name'] . '"><ul>';

		if ($fields['title_h2']) {
			echo '<li><h2 data-required="wow_pageSetting_background_repeat">' . $fields['title'] . '</h2> </li>';
		}

		foreach ($fields['fields'] as $key => $values) {

			switch ($values['type']) {
				case 'info':
					echo '<li class="' . $values['class_li'] . '"  id="' . $values['name'] . '_li"> <h2>' . $values['title'] . '</h2>  <br>   <span style="padding-left: 15px;">' . $values['description'] . '</span>        </li>';
					break;

				case 'image_select':
					echo '<li  class="' . $values['class_li'] . '" id="' . $values['name'] . '_li"><label for="' . $values['name'] . '">' . $values['title'] . '</label>
                <select  style="' . $values['style'] . '" class="image_select_metabox image-picker show-labels ' . $values['class'] . '"  name="' . $values['name'] . '" id="' . $values['name'] . '">
                ' . $this->post_options_image_select($values['options'], $values['name']) . '
                </select>
               ' . $this->post_options_description($values['description']) . '</li>';
					break;

				case 'select':
					echo '<li class="' . $values['class_li'] . '" id="' . $values['name'] . '_li"><label for="' . $values['name'] . '">' . $values['title'] . '</label>
                <select  style="' . $values['style'] . '"  class="' . $values['class'] . '"  name="' . $values['name'] . '" id="' . $values['name'] . '">
                ' . $this->post_options_select($values['options'], $values['name']) . '
                </select>
               ' . $this->post_options_description($values['description']) . '</li>';
					break;

				case 'textarea':
					echo '<li class="' . $values['class_li'] . '" id="' . $values['name'] . '_li"><label for="' . $values['name'] . '">' . $values['title'] . '</label>
                 <textarea name="' . $values['name'] . '" class="' . $values['class'] . '" style="' . $values['style'] . '"  id="' . $values['name'] . '" cols="40" rows="6" >' .
						$this->get_meta($values['name']) . '</textarea>
               ' . $this->post_options_description($values['description']) . '</li>';
					break;

				case 'text':
					echo '<li class="' . $values['class_li'] . '" id="' . $values['name'] . '_li"><label for="' . $values['name'] . '">' . $values['title'] . '</label>
              <input type="text" value="' . $this->get_meta($values['name']) . '" class="' . $values['class'] . '" style="' . $values['style'] . '"  name="' . $values['name'] . '" id="' . $values['name'] . '"/>
               ' . $this->post_options_description($values['description']) . '</li>';
					break;

				case 'embed':
					echo '<li class="' . $values['class_li'] . '" id="' . $values['name'] . '_li"><label for="' . $values['name'] . '">' . $values['title'] . '</label>
              <input type="text" value="' . $this->get_meta($values['name']) . '" class="' . $values['class'] . '" style="' . $values['style'] . '"  name="' . $values['name'] . '" id="' . $values['name'] . '"/>
               ' . $this->post_options_description($values['description']) . '</li>';
					break;

				case 'checkbox':
					echo '<li id="' . $values['class_li'] . '_li"><label for="' . $values['name'] . '">' . $values['title'] . '</label>
              <input type="checkbox" value="on"  ' . $this->post_options_checked($values['name']) . '   class="' . $values['class'] . '" style="' . $values['style'] . '"  name="' . $values['name'] . '" id="' . $values['name'] . '"/>
               ' . $this->post_options_description($values['description']) . '</li>';
					break;

				case 'radio':
					echo '<li class="' . $values['class_li'] . '" id="' . $values['name'] . '_li"><label for="' . $values['name'] . '">' . $values['title'] . '</label>';
					foreach ($values['values'] as $key => $value) {
						echo ' <input type="radio" value="' . $key . '"  ' . $this->post_options_radio($values['name'], $key) . '  class="' . $values['class'] . '" style="' . $values['style'] . '"  name="' . $values['name'] . '" id="' . $values['name'] . '"/>';
						echo '<span>' . $value . '</span>';
					}

					echo $this->post_options_description($values['description']) . '</li>';
					break;

				case 'color':
					echo '<li class="' . $values['class_li'] . '" id="' . $values['name'] . '_li"><label for="' . $values['name'] . '">' . $values['title'] . '</label>
              <input type="text" value="' . $this->get_meta($values['name']) . '"  class="ch-color-picker ' . $values['class'] . '" style="' . $values['style'] . 'background-color:' . $this->get_meta($values['name']) . '" name="' . $values['name'] . '" id="' . $values['name'] . '"/>
               ' . $this->post_options_description($values['description']) . '</li>';
					break;

				case 'upload':
					echo '<li class="' . $values['class_li'] . '" id="' . $values['name'] . '_li"><label for="' . $values['name'] . '">' . $values['title'] . '</label>
              <input type="text" value="' . $this->get_meta($values['name']) . '"  class="' . $values['class'] . '" style="display:none;' . $values['style'] . '" name="' . $values['name'] . '" id="' . $values['name'] . '"/>
              <input  id="' . $values['name'] . '_extra"   class="page_upload_trigger_element button button-primary button-large" name="' . $values['name'] . '_extra" type="button" value="' . $values['button_text'] . '"  style="' . $values['button_style'] . '"/>
        ' . $this->post_options_description($values['description']) . '
        <br>
        <div class="background_attachment_metabox_container">';
					if (!empty($this->get_meta($values['name']))) {
						$fileExtension = $this->fileExtension($this->get_meta($values['name']));
						if ($fileExtension == "jpg" || $fileExtension == "jpeg" || $fileExtension == "png" || $fileExtension == "gif") {

							echo '<div class="images-containerBG"><div class="single-imageBG"><span class="delete">X</span>';
							echo '  <img  data-targetID="' . $values['name'] . '" alt="' . $values['name'] . '" class="attachment-100x100 wp-post-image" witdh="100" height="100" src="' . $this->get_meta($values['name']) . '">';
							echo '</div></div>';
						} else {
							?>
                            <div class="images-containerBG">
                                <div style="width: 53px; height: 53px;" class="single-imageBG">
                                    <span data-targetID="<?php echo $values['name'] ?>" class="delete_media">X</span>
                                    <span style="font-size: 46px" class="info dashicons dashicons-admin-media"></span>
                                </div>
                            </div>
							<?php
						}
					}
					echo '</div></li>';
					break;
				// Media Gallery Code

				case 'media-gallery':
					$imagewow2 = array();
					$imagesID = array();
					$pictures = "";
					$imagesBUll_ = $this->get_meta($values['name']);
					if (!empty($imagesBUll_)) {
						$imagesBUlls = explode(',', $imagesBUll_);
						$imagesBUlls = array_unique($imagesBUlls);

						foreach ($imagesBUlls as $key => $val) {
							if ($val == '') {
								unset($imagesBUlls[$key]);
							}
						}
					}
					if (!empty($imagesBUlls)) :
						foreach ($imagesBUlls as $imagesBUll) :
							$imagewow = wp_get_attachment_image_src(($imagesBUll), 'wow-BlogList_MediumSmall_SidebarOpen');
							$imagewow2 [] = $imagewow[0];
							$imagesID [] = $imagesBUll;
							$pictures .= '<div class="single-image" ><span class="delete"> X</span ><img data-id="' . $imagesBUll . '" src="' . $imagewow[0] . '" alt="sd"/></div >';
						endforeach;
					endif;
					echo '<li class="' . $values['class_li'] . '" id="' . $values['name'] . '_li">
                                <div class="drop_meta_item gallery">
	                            <label for="' . $values['name'] . '">' . $values['title'] . '</label>
	                            <div class="st_studio-metadata">
	                            <div class="images-container">' . $pictures . '</div>
	                            <div class="images-container2">
                                <input id="' . $values['name'] . '" class="meta_field media_field_content"  data-value="' . implode(',', $imagewow2) . '"  value="' . implode(',', $imagesID) . '" 
                                  name="' . $values['name'] . '" type="hidden"   style="' . $values['style'] . '"/>
	                            <input type="button" name="uploader" class="STNCupload_button button button-primary" value="' . __('Add Images', 'CHfw') . '">
	                            </div>
	                            </div>
	                            </div>
	                      </li>';
					break;
			}
		}


		echo '  </ul>
    </div>';
	}

	/**
	 *  function to return image select type value.
	 * @return mixed
	 */
	public function post_options_image_select($arrays, $name)
	{

		$out = '';

		$meta = $this->get_meta($name);
		foreach ($arrays as $key => $option) {


			if ($meta == $key) {
				$out .= '<option data-img-label="' . $arrays[$key]['title'] . '"  data-img-src="' . $arrays[$key]['img'] . '" value="' . $key . '" selected="selected"> ' . $arrays[$key]['title'] . '</option>';
			} else {
				$out .= '<option data-img-label="' . $arrays[$key]['title'] . '"  data-img-src="' . $arrays[$key]['img'] . '" value="' . $key . '" > ' . $arrays[$key]['title'] . '</option>';
			}
		}

		return $out;
	}

	/**
	 * function to return a custom field value.
	 */
	public function get_meta($value)
	{

		if ($this->SaveMethodSingle) {
		    print_r($this->get_metaSingle($value));
		    die ("sing");
			return $this->get_metaSingle($value);
		} else {
		  /*  echo 'selo--';
			print_r($this->get_metaSerialize($value));
			die ("seri");*/
			return $this->get_metaSerialize($value);
		}

	}

	/**
	 * function to return a custom field value.
	 */
	public function get_metaSerialize($value)
	{
		global $post;
		$field = get_post_meta($post->ID, $this->meta_key, true);
		if (!empty($field)) {
			if (array_key_exists($value, $field)) {
				$field = $field[$value];
			} else {
				return '';
			}
		}

		if (!empty($field)) {
			return is_array($field) ? stripslashes_deep($field) : stripslashes(wp_kses_decode_entities($field));
		} else {
			return false;
		}
	}


	/**
	 * function to return a custom field value.
	 */
	public function get_metaSingle($value)
	{
		global $post;
		return get_post_meta($post->ID, $value, true);
	}


	/**
	 * html option desc  value
	 * @return string
	 */
	public function post_options_description($value)
	{
		if ($value != '') {
			return '<span class="form_hint">' . $value . '</span>';
		} else {
			return '';
		}
	}

	/**
	 * html option select  value
	 * @return string
	 */
	public function post_options_select($arrays, $name)
	{
		$out = '';
		foreach ($arrays as $key => $option) {
			$meta = $this->get_meta($name);
			if ($meta == $key) {
				$out .= '<option  value="' . $key . '" selected="selected">' . $option . '</option>';
			} else {
				$out .= '<option value="' . $key . '" > ' . $option . '</option>';
			}
		}

		return $out;
	}

	/**
	 * html checked value
	 * @return string
	 */
	public function post_options_checked($value)
	{
		return $this->get_meta($value) === "on" ? "checked" : "";
	}

	/**
	 * html radio  value
	 * @return string
	 */
	public function post_options_radio($id, $value)
	{
		return $this->get_meta($id) === $value ? "checked" : "";
	}
}

// request option -------------------------------------------------------
$ch_postID = isset($_GET['post']) ? $_GET['post'] : null;//post  id  for edit
$post_type_ch = (get_post_type($ch_postID));//get type
$post_type_post = isset($_REQUEST['post_type']) ? $_REQUEST['post_type'] : 'post';//for new


/* ---------------------------------------------------------------------------
 * Metabox Post Format init
 * --------------------------------------------------------------------------- */
function CHfw_post_options($CHfw_meta_key)
{
	include('metabox_options.php');
//post options
	$ch_post_options['0'] = $options_post_setting;
	$ch_post_options['1'] = $options_link_setting;
	$ch_post_options['2'] = $options_audio_setting;
	$ch_post_options['3'] = $options_quote_setting;
	$ch_post_options['4'] = $options_video_setting;
	$ch_post_options['5'] = $options_gallery_setting;
	//$ch_post_options['6'] = $options_status_setting;
	$chpost_op = new CHfw_MetaboxEngine($ch_post_options, $CHfw_meta_key);
}


/* ---------------------------------------------------------------------------
 * Metabox Page Format init
 * --------------------------------------------------------------------------- */
function CHfw_page_options($CHfw_meta_key)
{
	include('metabox_options.php');
	$ch_post_options_page['0'] = $options_page_setting_forPage;
	$engine_page = new CHfw_MetaboxEngine($ch_post_options_page, $CHfw_meta_key);
}


/* ---------------------------------------------------------------------------
 * Function to return a custom field value (GLOBAL)
 * //for frontend
 * @used visual composer elemnts
 * --------------------------------------------------------------------------- */
function CHfw_get_meta($ID, $value, $meta_key = 'global')
{
	if ($meta_key == 'global') {
		global $CHfw_meta_key;
		$meta_key = $CHfw_meta_key;
	}

	 $field = get_post_meta($ID, $meta_key, true);

	if (!empty($field)) {
		if (array_key_exists($value, $field)) {
			$field = $field[$value];
		}
	}

	if (!empty($field)) {
		return is_array($field) ? stripslashes_deep($field) : stripslashes(wp_kses_decode_entities($field));
	} else {
		return false;
	}
}


/* ---------------------------------------------------------------------------
 * Function to return a custom field value (GLOBAL)
 * //for frontend
 * @used visual composer elemnts
 * --------------------------------------------------------------------------- */
function CHfw_get_metaSingle($ID, $value, $default = "")
{
	return get_post_meta($ID, $value, true);
}

// how to init  post or page -------------------------------------------------------
if ($post_type_ch == 'post') {
	CHfw_post_options($CHfw_meta_key);
} elseif ($post_type_ch == 'page') {
	CHfw_page_options($CHfw_meta_key);
}

// how to init  post or page (for $_REQUEST ) --------------------------------------
if ($post_type_post == 'post') {
	CHfw_post_options($CHfw_meta_key);
} elseif ($post_type_post == 'page') {
	CHfw_page_options($CHfw_meta_key);
}