<?php defined('BASEPATH') OR exit('No direct access allowed');

if(!function_exists('alert_danger'))
{
	function alert_danger($text = '', $class = '')
	{
		if($text != '')
		{
			return '<div class="alert alert-danger '.$class.'"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$text.'</div>';
		}
		else
		{
			return '';
		}
	}
}

if(!function_exists('alert_warning'))
{
	function alert_warning($text = '', $class = '')
	{
		if($text != '')
		{
			return '<div class="alert alert-warning '.$class.'"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$text.'</div>';
		}
		else
		{
			return '';
		}
	}
}

if(!function_exists('alert_success'))
{
	function alert_success($text = '', $class = '')
	{
		if($text != '')
		{
			return '<div class="alert alert-success '.$class.'"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$text.'</div>';
		}
		else
		{
			return '';
		}
	}
}

if(!function_exists('text_danger'))
{
	function text_danger($text = '', $class = '')
	{
		if($text != '')
		{
			return '<div class="text-danger '.$class.'">'.$text.'</div>';
		}
		else
		{
			return '';
		}
	}
}
