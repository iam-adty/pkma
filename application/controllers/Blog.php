<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Blog extends CI_Controller {

	private $_message;
	private $_config;
	private $_template;

	public function __construct()
	{
		parent::__construct();
		$this->config->load('blog', TRUE);
		$this->_config = $this->config->item('blog');
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
		exit('<h1>PKMA</h1>');
	}
}