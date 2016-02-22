<?php defined('BASEPATH') OR exit('No direct access allowed');

if(!function_exists('input_post'))
{
	function input_post($name = '', $default = '')
	{
		$CI =& get_instance();
		return array_key_exists($name, $CI->input->post()) ? $CI->input->post($name) : $default;
	}
}

if(!function_exists('input_get'))
{
	function input_get($name = '', $default = '')
	{
		$CI =& get_instance();
		return array_key_exists($name, $CI->input->get()) ? $CI->input->get($name) : $default;
	}
}