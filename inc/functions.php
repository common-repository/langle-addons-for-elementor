<?php
defined( 'ABSPATH' ) || die();
/**
 * Get elementor instance
 *
 * @return \Elementor\Plugin
 */
function la_elementor() {
	return \Elementor\Plugin::instance();
}

/**
 * Escaped title html tags
 *
 * @param string $tag input string of title tag
 * @return string $default default tag will be return during no matches
 */

function langle_addons_escape_tags( $tag, $default = 'span', $extra = [] ) {

	$supports = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'div', 'span', 'p'];

	$supports = array_merge($supports, $extra);

	if ( ! in_array( $tag, $supports, true ) ) {
		return $default;
	}

	return $tag;
}

function langle_addons_get_css_blend_modes() {
	return [
		'normal'      => __('Normal', 'langle-addons'),
		'multiply'    => __('Multiply', 'langle-addons'),
		'screen'      => __('Screen', 'langle-addons'),
		'overlay'     => __('Overlay', 'langle-addons'),
		'darken'      => __('Darken', 'langle-addons'),
		'lighten'     => __('Lighten', 'langle-addons'),
		'color-dodge' => __('Color Dodge', 'langle-addons'),
		'color-burn'  => __('Color Burn', 'langle-addons'),
		'saturation'  => __('Saturation', 'langle-addons'),
		'difference'  => __('Difference', 'langle-addons'),
		'exclusion'   => __('Exclusion', 'langle-addons'),
		'hue'         => __('Hue', 'langle-addons'),
		'color'       => __('Color', 'langle-addons'),
		'luminosity'  => __('Luminosity', 'langle-addons'),
	];
}

/*
	This function is used in Image Compare widget
*/ 
function la_prepare_data_prop_settings(&$settings, $field_map = []) {
	$data = [];
	foreach ($field_map as $key => $data_key) {
		$setting_value                          = la_get_setting_value($settings, $key);
		list($data_field_key, $data_field_type) = explode('.', $data_key);
		$validator                              = $data_field_type . 'val';

		if (is_callable($validator)) {
			$val = call_user_func($validator, $setting_value);
		} else {
			$val = $setting_value;
		}
		$data[$data_field_key] = $val;
	}
	return wp_json_encode($data);
}

/**
 * @param $settings
 * @param $keys
 * @return mixed
 */
function la_get_setting_value(&$settings, $keys) {
	if (!is_array($keys)) {
		$keys = explode('.', $keys);
	}
	if (is_array($settings[$keys[0]])) {
		return la_get_setting_value($settings[$keys[0]], array_slice($keys, 1));
	}
	return $settings[$keys[0]];
}

function la_is_localhost() {
	return isset($_SERVER['REMOTE_ADDR']) && in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1']);
}

function la_get_css_cursors() {
	return [
		'default'      => __('Default', 'langle-addons'),
		'alias'        => __('Alias', 'langle-addons'),
		'all-scroll'   => __('All scroll', 'langle-addons'),
		'auto'         => __('Auto', 'langle-addons'),
		'cell'         => __('Cell', 'langle-addons'),
		'context-menu' => __('Context menu', 'langle-addons'),
		'col-resize'   => __('Col-resize', 'langle-addons'),
		'copy'         => __('Copy', 'langle-addons'),
		'crosshair'    => __('Crosshair', 'langle-addons'),
		'e-resize'     => __('E-resize', 'langle-addons'),
		'ew-resize'    => __('EW-resize', 'langle-addons'),
		'grab'         => __('Grab', 'langle-addons'),
		'grabbing'     => __('Grabbing', 'langle-addons'),
		'help'         => __('Help', 'langle-addons'),
		'move'         => __('Move', 'langle-addons'),
		'n-resize'     => __('N-resize', 'langle-addons'),
		'ne-resize'    => __('NE-resize', 'langle-addons'),
		'nesw-resize'  => __('NESW-resize', 'langle-addons'),
		'ns-resize'    => __('NS-resize', 'langle-addons'),
		'nw-resize'    => __('NW-resize', 'langle-addons'),
		'nwse-resize'  => __('NWSE-resize', 'langle-addons'),
		'no-drop'      => __('No-drop', 'langle-addons'),
		'not-allowed'  => __('Not-allowed', 'langle-addons'),
		'pointer'      => __('Pointer', 'langle-addons'),
		'progress'     => __('Progress', 'langle-addons'),
		'row-resize'   => __('Row-resize', 'langle-addons'),
		's-resize'     => __('S-resize', 'langle-addons'),
		'se-resize'    => __('SE-resize', 'langle-addons'),
		'sw-resize'    => __('SW-resize', 'langle-addons'),
		'text'         => __('Text', 'langle-addons'),
		'url'          => __('URL', 'langle-addons'),
		'w-resize'     => __('W-resize', 'langle-addons'),
		'wait'         => __('Wait', 'langle-addons'),
		'zoom-in'      => __('Zoom-in', 'langle-addons'),
		'zoom-out'     => __('Zoom-out', 'langle-addons'),
		'none'         => __('None', 'langle-addons'),
	];
}

function la_get_css_blend_modes() {
	return [
		'normal'      => __('Normal', 'langle-addons'),
		'multiply'    => __('Multiply', 'langle-addons'),
		'screen'      => __('Screen', 'langle-addons'),
		'overlay'     => __('Overlay', 'langle-addons'),
		'darken'      => __('Darken', 'langle-addons'),
		'lighten'     => __('Lighten', 'langle-addons'),
		'color-dodge' => __('Color Dodge', 'langle-addons'),
		'color-burn'  => __('Color Burn', 'langle-addons'),
		'saturation'  => __('Saturation', 'langle-addons'),
		'difference'  => __('Difference', 'langle-addons'),
		'exclusion'   => __('Exclusion', 'langle-addons'),
		'hue'         => __('Hue', 'langle-addons'),
		'color'       => __('Color', 'langle-addons'),
		'luminosity'  => __('Luminosity', 'langle-addons'),
	];
}

/**
 * Check elementor version
 *
 * @param string $version
 * @param string $operator
 * @return bool
 */
function langle_addons_is_elementor_version($operator = '<', $version = '2.6.0') {
	return defined('ELEMENTOR_VERSION') && version_compare(ELEMENTOR_VERSION, $version, $operator);
}
/**
 * Strip all the tags except allowed html tags
 *
 * The name is based on inline editing toolbar name
 *
 * @param string $string
 * @return string
 */
function langle_addons_kses_intermediate( $string = '' ) {
	return wp_kses( $string, langle_addons_get_allowed_html_tags( 'intermediate' ) );
}

/**
 * Strip all the tags except allowed html tags
 *
 * The name is based on inline editing toolbar name
 *
 * @param string $string
 * @return string
 */
function langle_addons_kses_basic($string = '') {
	return wp_kses($string, langle_addons_get_allowed_html_tags('basic'));
}

/**
 * Render icon html with backward compatibility
 *
 * @param array $settings
 * @param string $old_icon_id
 * @param string $new_icon_id
 * @param array $attributes
 */
function langle_addons_render_icon($settings = [], $old_icon_id = 'icon', $new_icon_id = 'selected_icon', $attributes = []) {
	
	$migrated = isset($settings['__fa4_migrated'][$new_icon_id]);
	$is_new = empty($settings[$old_icon_id]);

	$attributes['aria-hidden'] = 'true';

	if (langle_addons_is_elementor_version('>=', '2.6.0') && ($is_new || $migrated)) {
		\Elementor\Icons_Manager::render_icon($settings[$new_icon_id], $attributes);
	} else {
		if (empty($attributes['class'])) {
			$attributes['class'] = $settings[$old_icon_id];
		} else {
			if (is_array($attributes['class'])) {
				$attributes['class'][] = $settings[$old_icon_id];
			} else {
				$attributes['class'] .= ' ' . $settings[$old_icon_id];
			}
		}
		printf('<i %s></i>', \Elementor\Utils::render_html_attributes($attributes));
	}
}

/**
 * Get a list of all the allowed html tags.
 *
 * @param string $level Allowed levels are basic and intermediate
 * @return array
 */
function langle_addons_get_allowed_html_tags( $level = 'basic' ) {
	$allowed_html = [
		'b'      => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'i'      => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'u'      => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		's'      => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'br'     => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'em'     => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'del'    => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'ins'    => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'sub'    => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'sup'    => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'code'   => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'mark'   => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'small'  => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'strike' => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'abbr'   => [
			'title' => [],
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'span'   => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'strong' => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
	];

	if ( 'intermediate' === $level || 'all' === $level ) {
		$tags = [
			'a'       => [
				'href'  => [],
				'title' => [],
				'class' => [],
				'id'    => [],
				'style' => [],
			],
			'q'       => [
				'cite'  => [],
				'class' => [],
				'id'    => [],
				'style' => [],
			],
			'img'     => [
				'src'    => [],
				'alt'    => [],
				'height' => [],
				'width'  => [],
				'class'  => [],
				'id'     => [],
				'style'  => [],
			],
			'dfn'     => [
				'title' => [],
				'class' => [],
				'id'    => [],
				'style' => [],
			],
			'time'    => [
				'datetime' => [],
				'class'    => [],
				'id'       => [],
				'style'    => [],
			],
			'cite'    => [
				'title' => [],
				'class' => [],
				'id'    => [],
				'style' => [],
			],
			'acronym' => [
				'title' => [],
				'class' => [],
				'id'    => [],
				'style' => [],
			],
			'hr'      => [
				'class' => [],
				'id'    => [],
				'style' => [],
			],
		];

		$allowed_html = array_merge($allowed_html, $tags);
	}

	return $allowed_html;
}

/**
 * Get a translatable string with allowed html tags.
 *
 * @param string $level Allowed levels are basic and intermediate
 * @return string
 */
function langle_addons_get_allowed_html_desc( $level = 'basic' ) {
	if (!in_array($level, ['basic', 'intermediate'])) {
		$level = 'basic';
	}

	$tags_str = '<' . implode( '>,<', array_keys( langle_addons_get_allowed_html_tags( $level ) ) ) . '>';
	return sprintf(__('This input field has support for the following HTML tags: %1$s', 'langle-addons'), '<code>' . esc_html($tags_str) . '</code>');
}

/**
 * Render icon html with backward compatibility
 *
 * @param array $settings
 * @param string $old_icon_id
 * @param string $new_icon_id
 * @param array $attributes
 */
function langle_addons_render_button_icon($settings = [], $old_icon_id = 'icon', $new_icon_id = 'selected_icon', $attributes = []) {
	// Check if its already migrated
	$migrated = isset($settings['__fa4_migrated'][$new_icon_id]);
	// Check if its a new widget without previously selected icon using the old Icon control
	$is_new = empty($settings[$old_icon_id]);

	$attributes['aria-hidden'] = 'true';
	$is_svg                    = (isset($settings[$new_icon_id], $settings[$new_icon_id]['library']) && 'svg' === $settings[$new_icon_id]['library']);

	if (langle_addons_is_elementor_version('>=', '2.6.0') && ($is_new || $migrated)) {
		if ($is_svg) {
			echo wp_kses_post( '<span class="la-btn-icon la-btn-icon--svg">' );
		}
		\Elementor\Icons_Manager::render_icon($settings[$new_icon_id], $attributes);
		if ($is_svg) {
			echo wp_kses_post( '</span>' );
		}
	} else {
		if (empty($attributes['class'])) {
			$attributes['class'] = $settings[$old_icon_id];
		} else {
			if (is_array($attributes['class'])) {
				$attributes['class'][] = $settings[$old_icon_id];
			} else {
				$attributes['class'] .= ' ' . $settings[$old_icon_id];
			}
		}
		printf('<i %s></i>', \Elementor\Utils::render_html_attributes($attributes));
	}
}