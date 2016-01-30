<?php

namespace Pulse\Providers;

use GuzzleHttp\Client;

class Twitter extends AbstractProvider {
	
	protected $config;

	function __construct($config) {
		$this->config = $config;
		parent::__construct($config);

		$this->twitter = new \TwitterAPIExchange([
			    'oauth_access_token' => $this->config['access_token'],
			    'oauth_access_token_secret' => $this->config['access_token_secret'],
			    'consumer_key' => $this->config['api_key'],
			    'consumer_secret' => $this->config['api_secret']
			]);
	}
	
	public function followers($id) {

		$url = 'https://api.twitter.com/1.1/users/show.json';
		$getfield = '?screen_name='.$id;
		$requestMethod = 'GET';

		return json_decode($this->twitter->setGetfield($getfield)
		->buildOauth($url, $requestMethod)
		->performRequest())->followers_count;
	}

	public function search($id) {

		$url = 'https://api.twitter.com/1.1/users/show.json';
		$getfield = '?screen_name='.$id;
		$requestMethod = 'GET';

		
		return json_decode($this->twitter->setGetfield($getfield)
		->buildOauth($url, $requestMethod)
		->performRequest());
	}

}