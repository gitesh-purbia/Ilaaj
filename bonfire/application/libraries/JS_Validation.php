<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

// ------------------------------------------------------------------------

/**
 * Validation Class extension
 *
 * @package        CodeIgniter
 * @subpackage    Libraries
 * @category    Validation
 * @author        AK
 * @link        http://codeigniter.com/user_guide/libraries/validation.html
 */

    /**
     * Set Fields
     *
     * This function takes an array of field names as input
     * and generates class variables with the same name, which will
     * either be blank or contain the $_POST value corresponding to it
     *
     * @access    public
     * @param    string
     * @param    string
     * @return    void
     */
class JS_Validation {

	protected $CI;
	function __construct($rules = array())
	{
		$this->CI =& get_instance();
	}

    /**
     * JavaScript
     *
     * This function provides default implementation of the built-in CI validation rules in javascript.
     * The function generates a client-side js script, complete with <script>...</script> html tags,
     * suitable for inclusion in the document header. Additionally, custom rules can be added by
     * defining global js functions, or extending Validation js object.
     *
     * @access    public
     * @param    string - custom error message (optional)
     * @param    string - name of a js error callback function (optional)
     * @return    string - js
     */

    public function javascript($form_name = '' ,$configs = array(),$add_to_asset = TRUE,$callback = '')
    {
    	$arr_for_js =array();
		foreach ($configs as $config)
		{
			$mini_js_arr = array();
			$mini_js_arr['name'] = $config['field'];
			$mini_js_arr['display'] = $config['label'];
			$mini_js_arr['rules'] = $this->filter_rules($config['rules']);
			array_push($arr_for_js,$mini_js_arr);
		}

    	$script  = "jQuery(document.getElementsByName('".$form_name."')).prepend(\"<div id='form_error_div'></div>\");
    				new FormValidator('".$form_name."',".json_encode($arr_for_js)." , function(errors, event) {
			    if (errors.length > 0) {
			        var errorString = '';
			        for (var i = 0, errorLength = errors.length; i < errorLength; i++) {
			            errorString += '<div class=\"alert warning\">'+ errors[i].message + '</div>';
			        }
			        var form = document.getElementsByName('".$form_name."')[0];
			        var error_div = jQuery('#form_error_div',form);
			        error_div.html(errorString);
			        var offset = error_div.offset();
			        jQuery('html,body').animate({
			        	scrollTop : offset.top - 100
			        });
			    }
			});";
    	if($add_to_asset)
    	{
    		Assets::add_js($script,'inline');
    	}
    	return $script;
    }

 	private function filter_rules($rules)
 	{
		$ex = explode('|', $rules);
		$new_rules_arr  = array();
		foreach ($ex as $rule)
		{
			if(!preg_match("/is_unique\w*/", $rule)){
				array_push($new_rules_arr, $rule);
			}

		}
	    $new_filter_rules = implode("|", $new_rules_arr);
	    return $new_filter_rules;
    }
}

?>