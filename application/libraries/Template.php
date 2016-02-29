<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Template
{
	private $CI;
	private $_template = '';
	private $_template_url = '';
	private $_templates_path = '';
	private $_data = array();
	private $_config = array();
	private $_menu_parent_flag = '';
	private $_template_type = '';

	public function __construct($init = array())
	{
		$this->CI =& get_instance();

		$this->CI->load->library('parser');

		$this->CI->config->load('blog', TRUE);
		$this->_config = $this->CI->config->item('blog');

		$this->_template_type = $init['type'];
		$this->_template = $this->_config['secure']['template']['default'][$this->_template_type];
		$this->_template_url = base_url($this->_config['secure']['template']['path'] . '/' . $this->_template);
		$this->_templates_path = './' . $this->_config['secure']['template']['path'];

		$this->_data = array(
			'base_url' => base_url(),
			'template_url' => $this->_template_url,
		);

		$this->_data = array_merge($this->_data, $this->_parse_config_data($this->_config['non-secure']));

		if(array_key_exists('data', $init))
			$this->_data = array_merge($this->_data, $init['data']);
	}

	public function parse($template = '', $data = array(), $as_string = FALSE)
	{
		$data = array_merge($this->_data, $data);
		$view_string = '';
		if(get_file_info($this->_templates_path . '/' . $this->_template . '/' . $template . '.php'))
			$view_string = $this->CI->parser->parse($this->_template . '/' . $template, $data, TRUE);
		elseif (get_file_info($this->_templates_path . '/' . $this->_template . '/' . $template . '/' . $template . '.php'))
			$view_string = $this->CI->parser->parse($this->_template . '/' . $template . '/' . $template . '.php', $data, TRUE);

		preg_match_all('/{template_.+?}/s', $view_string, $matches);
		if(count($matches[0]) > 0)
		{
			foreach ($matches[0] as $key => $value)
			{
				$matched_template = str_replace(array('{template_', '}'), '', $value);
				if(strpos($matched_template, '|'))
				{
					$ex_matched_template = explode('|', $matched_template);
					$ex_matched_template[1] = preg_replace('/\s+/S', "", $ex_matched_template[1]);
					$parameter = str_replace(array('(', ')'), array('{', '}'), $ex_matched_template[1]);
					$json_parameter = json_decode($parameter, TRUE);
					foreach ($json_parameter as $json_key => $json_value)
					{
						$variable_key = str_replace(array('{','}'), '', $value);
						$data[$variable_key] = $this->_call($ex_matched_template[0], $json_key, $json_value);
					}
				}
				else
				{
					$data[str_replace(array('{','}'), '', $value)] = $this->parse($matched_template, $data, TRUE);
				}
			}
		}
		if($as_string)
			return $this->CI->parser->parse_string($view_string, $data, $as_string);
		else
    		$this->CI->parser->parse_string($view_string, $data, $as_string);
	}

	private function _menu($template = '', $data = array())
	{
		$view = '';

		$item_to_show = array();
		if(array_key_exists('item-to-show', $data))
		{
			$item_to_show = $data['item-to-show'];
			unset($data['item-to-show']);
		}

		foreach($this->_config['secure']['menu'][$this->_template_type] as $key => $value)
		{
			if(in_array($key, $item_to_show))
			{
				$show_menu = FALSE;
				foreach ($value['access'] as $key_access => $value_access)
				{
					if(in_array($value_access, $this->CI->session->userdata('blog_user')['access']))
					{
						$show_menu = $show_menu ? $show_menu : TRUE;
					}
				}

				if($show_menu)
				{
					$value['active'] = '';
					if($key == $this->CI->uri->segment(2, 'index'))
						$value['active'] = ' active';

					if(!array_key_exists('style', $value))
						$value['style'] = '';
					else
						$value['style'] = ' ' . $value['style'];

					$this->_menu_parent_flag = '';
					if(array_key_exists('child', $value))
					{
						$this->_menu_parent_flag = $key;
						unset($value['child']);
						$view .= $this->parse($template . '-has-child', array_merge($this->_data, $data, $value), TRUE);
					}
					else
					{
						$view .= $this->parse($template, array_merge($this->_data, $data, $value), TRUE);
					}
				}
			}
		}

		return $view;
	}

	private function _sub_menu($template = '', $data = array())
	{
		$view = '';
		foreach ($this->_config['secure']['menu'][$this->_template_type][$this->_menu_parent_flag]['child'] as $key => $value)
		{
			if(!is_array($value))
				$view .= $this->parse($template . $value, array_merge($this->_data, $data), TRUE);
			else
			{
				$show_menu = FALSE;
				foreach ($value['access'] as $key_access => $value_access)
				{
					if(in_array($value_access, $this->CI->session->userdata('blog_user')['access']))
					{
						$show_menu = $show_menu ? $show_menu : TRUE;
					}
				}

				if($show_menu)
				{
					$view .= $this->parse($template, array_merge($this->_data, $data, $value), TRUE);
				}
			}
		}
		return $view;
	}

	private function _parse_config_data($array = array(), $parent_key = '')
	{
		$result = array();
		foreach ($array as $key => $value)
		{
			if(is_array($value))
				$result = array_merge($result, $this->_parse_config_data($value, $key));
			else
				$result[trim($parent_key . '_' . $key, '_')] = $value;
		}
		return $result;
	}

	private function _call($template = '', $type = '', $data = array())
	{
		$return = '';
		switch ($type)
		{
			case 'get':
				if(is_array($data))
				{
					$method = '_' . $data[0];
					$return = $this->$method($template, array_key_exists(1, $data) ? array_merge($this->_data, $data[1]) : $this->_data);
				}
				else
				{
					$method = '_' . $data;
					$return = $this->$method($template);
				}
				break;
			case 'library':
				$return = $this->_call_library($template, $data[0], $data[1], array_key_exists(2, $data) ? array_merge($this->_data, $data[2]) : $this->_data);
				break;
		}
		return $return;
	}

	private function _call_library($template = '', $library_name = '', $method = '', $data = array())
	{
		$return = '';
		$this->CI->load->library($library_name, array_merge($this->_data, $data));
		$library_data = $this->CI->$library_name->$method(array_merge($this->_data, $data));
		switch ($library_data['type'])
		{
			case 'array-list-to-parse':
				foreach ($library_data['data'] as $key => $value)
				{
					$return .= $this->parse($template, array_merge($this->_data, $value), TRUE);
				}
				break;
			
			case 'string':
				$return = $library_data['data'];
				break;

			case 'single-array-to-parse':
				$return = $this->parse($template, array_merge($this->_data, $library_data['data']), TRUE);
				break;
		}
		return $return;
	}
}