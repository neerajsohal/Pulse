<?php

namespace Pulse;

use Pulse\Providers\Instagram;
use Pulse\Providers\Twitter;
use Pulse\Providers\Facebook;

class Pulse {

	function __construct($config) {
		$this->config = $config;
	}

	public function facebook() {
		return new Facebook($this->config['facebook']);
	}

	public function instagram() {
		return new Instagram($this->config['instagram']);
	}

	public function twitter() {
		return new Twitter($this->config['twitter']);
	}

	public function followers() {

	}

	public function getFacebookLikes() {
		return rand(100, 1000000);
	}

	public function getTwitterFollowers($handle) {
		$data = file_get_contents('https://cdn.syndication.twimg.com/widgets/followbutton/info.json?screen_names='.$handle); 
		$parsed =  json_decode($data, true);
		return $parsed[0]['followers_count'];
	}

}