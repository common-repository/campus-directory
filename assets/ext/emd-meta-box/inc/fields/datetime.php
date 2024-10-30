<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( !class_exists( 'EMD_MB_Datetime_Field' ) )
{
	class EMD_MB_Datetime_Field extends EMD_MB_Field
	{
		/**
		 * Enqueue scripts and styles
		 *
		 * @return void
		 */
		static function admin_enqueue_scripts()
		{
			$url_css = EMD_MB_CSS_URL . 'jqueryui';
			wp_register_script( 'jquery-ui-timepicker', EMD_MB_JS_URL . 'jqueryui/jquery-ui-timepicker-addon.js', array( 'jquery-ui-datepicker', 'jquery-ui-slider' ), '0.9.7', true );
			wp_enqueue_style( 'jquery-ui-timepicker-css', "{$url_css}/jquery-ui-timepicker-addon.css");
			$deps = array( 'jquery-ui-datepicker', 'jquery-ui-timepicker' );

                        $locale = get_locale();
                        $date_vars['closeText'] = __('Done','campus-directory');
                        $date_vars['prevText'] = __('Prev','campus-directory');
                        $date_vars['nextText'] = __('Next','campus-directory');
                        $date_vars['currentText'] = __('Today','campus-directory');
                        $date_vars['monthNames'] = Array(__('January','campus-directory'),__('February','campus-directory'),__('March','campus-directory'),__('April','campus-directory'),__('May','campus-directory'),__('June','campus-directory'),__('July','campus-directory'),__('August','campus-directory'),__('September','campus-directory'),__('October','campus-directory'),__('November','campus-directory'),__('December','campus-directory'));
                        $date_vars['monthNamesShort'] = Array(__('Jan','campus-directory'),__('Feb','campus-directory'),__('Mar','campus-directory'),__('Apr','campus-directory'),__('May','campus-directory'),__('Jun','campus-directory'),__('Jul','campus-directory'),__('Aug','campus-directory'),__('Sep','campus-directory'),__('Oct','campus-directory'),__('Nov','campus-directory'),__('Dec','campus-directory'));
                        $date_vars['dayNames'] = Array(__('Sunday','campus-directory'),__('Monday','campus-directory'),__('Tuesday','campus-directory'),__('Wednesday','campus-directory'),__('Thursday','campus-directory'),__('Friday','campus-directory'),__('Saturday','campus-directory'));
                        $date_vars['dayNamesShort'] = Array(__('Sun','campus-directory'),__('Mon','campus-directory'),__('Tue','campus-directory'),__('Wed','campus-directory'),__('Thu','campus-directory'),__('Fri','campus-directory'),__('Sat','campus-directory'));
                        $date_vars['dayNamesMin'] = Array(__('Su','campus-directory'),__('Mo','campus-directory'),__('Tu','campus-directory'),__('We','campus-directory'),__('Th','campus-directory'),__('Fr','campus-directory'),__('Sa','campus-directory'));
                        $date_vars['weekHeader'] = __('Wk','campus-directory');

			$time_vars['timeOnlyTitle'] = __('Choose Time','campus-directory');
			$time_vars['timeText'] = __('Time','campus-directory');
			$time_vars['hourText'] = __('Hour','campus-directory');
			$time_vars['minuteText'] = __('Minute','campus-directory');
			$time_vars['secondText'] = __('Second','campus-directory');
			$time_vars['millisecText'] = __('Millisecond','campus-directory');
			$time_vars['timezoneText'] = __('Time Zone','campus-directory');
			$time_vars['currentText'] = __('Now','campus-directory');
			$time_vars['closeText'] = __('Done','campus-directory');

                        $vars['date'] = $date_vars;
                        $vars['time'] = $time_vars;
                        $vars['locale'] = $locale;

			wp_enqueue_script( 'emd-mb-datetime', EMD_MB_JS_URL . 'datetime.js', $deps, EMD_MB_VER, true );
                        wp_localize_script( 'emd-mb-datetime', 'dtvars', $vars);
		}

		/**
		 * Get field HTML
		 *
		 * @param mixed  $meta
		 * @param array  $field
		 *
		 * @return string
		 */
		static function html( $meta, $field )
		{
			if($meta != '')
                        {
                                if($field['js_options']['timeFormat'] == 'hh:mm')
                                {
                                        $getformat = 'Y-m-d H:i';
                                }
                                else
                                {
                                        $getformat = 'Y-m-d H:i:s';
                                }
				if(DateTime::createFromFormat($getformat,$meta)){
                                	$meta = DateTime::createFromFormat($getformat,$meta)->format(self::translate_format($field));
				}
                        }
                        return sprintf(
                                '<input type="text" class="emd-mb-datetime" name="%s" value="%s" id="%s" size="%s" data-options="%s" readonly/>',
                                $field['field_name'],
                                $meta,
                                isset( $field['clone'] ) && $field['clone'] ? '' : $field['id'],
                                $field['size'],
                                esc_attr( json_encode( $field['js_options'] ) )
                        );
		}

		/**
		 * Calculates the timestamp from the datetime string and returns it
		 * if $field['timestamp'] is set or the datetime string if not
		 *
		 * @param mixed $new
		 * @param mixed $old
		 * @param int   $post_id
		 * @param array $field
		 *
		 * @return string|int
		 */
		/*static function value( $new, $old, $post_id, $field )
		{
			if ( !$field['timestamp'] )
				return $new;

			$d = DateTime::createFromFormat( self::translate_format( $field ), $new );
			return $d ? $d->getTimestamp() : 0;
		}*/

		/**
		 * Normalize parameters for field
		 *
		 * @param array $field
		 *
		 * @return array
		 */
		static function normalize_field( $field )
		{
			$field = wp_parse_args( $field, array(
				'size'       => 30,
				'js_options' => array(),
				'timestamp'  => false,
			) );

			// Deprecate 'format', but keep it for backward compatible
			// Use 'js_options' instead
			$field['js_options'] = wp_parse_args( $field['js_options'], array(
				'dateFormat'      => empty( $field['format'] ) ? 'yy-mm-dd' : $field['format'],
				'timeFormat'      => 'hh:mm:ss',
				'showButtonPanel' => true,
				'separator'       => ' ',
				'changeMonth' => true,
				'changeYear' => true,
				'yearRange' => '-100:+10',
			) );

			return $field;
		}

		/**
		 * Returns a date() compatible format string from the JavaScript format
		 *
		 * @see http://www.php.net/manual/en/function.date.php
		 *
		 * @param array $field
		 *
		 * @return string
		 */
		static function translate_format( $field )
		{
			return strtr( $field['js_options']['dateFormat'], self::$date_format_translation )
				. $field['js_options']['separator']
				. strtr( $field['js_options']['timeFormat'], self::$time_format_translation );
		}
		static function save( $new, $old, $post_id, $field )
                {
                        $name = $field['id'];
                        if ( '' === $new)
                        {
                                delete_post_meta( $post_id, $name );
                                return;
                        }
                        if($field['js_options']['timeFormat'] == 'hh:mm')
                        {
                                $getformat = 'Y-m-d H:i';
                        }
                        else
                        {
                                $getformat = 'Y-m-d H:i:s';
                        }
			if(DateTime::createFromFormat(self::translate_format($field), $new)){
                        	$new = DateTime::createFromFormat(self::translate_format($field), $new)->format($getformat);
                        	update_post_meta( $post_id, $name, $new );
			}
                }
	}
}
