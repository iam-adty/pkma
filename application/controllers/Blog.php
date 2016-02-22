<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Blog extends CI_Controller {

	private $_message;
	private $_config;
	private $_template;

	public function __construct()
	{
		parent::__construct();
		$this->config->load('adtyblog', TRUE);
		$this->_config = $this->config->item('adtyblog');
		$this->_template = $this->_config['template']['default']['blog'];
		$this->load->library('blog_template', array(
			'config' => array(
				'general' => $this->_config['general'],
				'template' => $this->_config['template']
			)
		));
	}

	public function _remap()
	{
		$uri = $this->uri->segment(1, 'index');
		$view = '_' . $uri;
		if(method_exists($this, $view))
			$this->$view();
		else
			show_404();
	}

	private function _index()
	{
		$data = array();
		$index_view = $this->parser->parse($this->_template . '/index', $data, TRUE);
		$this->blog_template->parse($index_view, $data);
	}
}