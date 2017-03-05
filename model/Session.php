<?php

class Session
{
	private $maxLife;

	public function __construct($maxLife = 5) {
		session_start();
		$this->maxLife = $maxLife * 60;
	}

	public function setVar($name, $value) {
		if ($name != '') {
			$_SESSION[$name] = $value;
		}
	}

	public function getVar($name) {
		if ($name != '' && isset($_SESSION[$name]) ) {
			return $_SESSION[$name];
		}
		return null;
	}

	public function isExpired() {
		$sessionTimeout = $this->maxLife;
		$lastAction = $this->getVar('lastAction');
		$now = time();

		if (isset($lastAction)) {
			$timeGap = $now - $lastAction;

			if ($timeGap > $sessionTimeout) {
				return true;
			}
			else {
				return false;
			}
		}
		return false;
	}

	public function refresh() {
		$this->setVar('lastAction', time());
	}

	public function destroy() {
		unset($_SESSION);
		session_destroy();
	}
}
