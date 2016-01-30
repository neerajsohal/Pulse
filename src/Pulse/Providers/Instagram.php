<?php

namespace Pulse\Providers;

use GuzzleHttp\Client;

class Instagram extends AbstractProvider {
	
	protected $config;

	function __construct($config) {
		$this->config = $config;
		parent::__construct($config);

		$this->client = new Client(['base_uri' => 'https://api.instagram.com/']);
	}
	
	public function followers($id) {
		
		$response = $this->client->get('v1/users/'.$id, [
				'query' => [
						'access_token' => $this->config['access_token']
					]
			]);
		return json_decode($response->getBody())->data->counts->followed_by;
	}

	public function userId($username) {
		$response = $this->client->get('v1/users/search', [
				'query' => [
					'q' => $username,
					'access_token' => $this->config['access_token']
				]
			]);
		return json_decode($response->getBody());
	}

	public function search($username) {
		$response = $this->client->get('v1/users/search', [
				'query' => [
					'q' => $username,
					'access_token' => $this->config['access_token']
				]
			]);
		return json_decode($response->getBody())->data;
	}

}