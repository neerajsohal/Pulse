<?php

namespace Pulse\Providers;

class Facebook extends AbstractProvider {
	
	protected $config;

	function __construct($config) {
		$this->config = $config;
		parent::__construct($config);

		$this->facebook = new \Facebook\Facebook([
			'app_id' => $this->config['app_id'],
			'app_secret' => $this->config['app_secret'],
			'default_graph_version' => 'v2.5',
			'default_access_token' => $this->config['access_token'],
		]);

	}

	public function info($id) {
		$response = $this->facebook->get('/'.$id.'?fields=id,name,about,username');
		return json_decode($response->getBody());
	}

	public function userId($id) {
		$response = $this->facebook->get('/'.$id.'?fields=id');
		return ($response->getDecodedBody()['id']);
	}

	public function likes($id) {
		$response = $this->facebook->get('/'.$id.'?fields=likes');
		return $response->getDecodedBody()['likes'];
	}

}