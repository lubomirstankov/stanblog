<?php
class session_manager {
	public $sn;
	
	public function check_session() {
		if (!isset($_SESSION['stanblog'])) {
			return false;
		} else {
			return true;
		}
	}
	public function get_session_name() {
		$sn = $_SESSION['stanblog'];
		return $sn;
	}
}