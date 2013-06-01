<?php

namespace Dashboard\System {
	class AuthenticationProvider {
		public static function authenticate() {
			include_once 'config/settings.php';
			if($loginEnabled) {
				function dieWithAuthenticationError() {
					header('HTTP/1.1 401 Unauthorized');
					die('<html><head><title>Access denied</title></head><body><br/><br/><font color="#0000FF">Error 401 Unauthorized: You need to provide a valid username and password.</font></body></html>');
				}
			
				// function to parse the http auth header
				function http_digest_parse($txt)
				{
					// protect against missing data
					$needed_parts = array('nonce'=>1, 'nc'=>1, 'cnonce'=>1, 'qop'=>1, 'username'=>1, 'uri'=>1, 'response'=>1);
					$data = array();
					$keys = implode('|', array_keys($needed_parts));
			
					preg_match_all('@(' . $keys . ')=(?:([\'"])([^\2]+?)\2|([^\s,]+))@', $txt, $matches, PREG_SET_ORDER);
			
					foreach ($matches as $m) {
						$data[$m[1]] = $m[3] ? $m[3] : $m[4];
						unset($needed_parts[$m[1]]);
					}
			
					return $needed_parts ? false : $data;
				}
			
				if (empty($_SERVER['PHP_AUTH_DIGEST']) && !(isset($_SESSION['AUTHOR']) && $_SESSION['AUTHOR'] == "")) {
					header('WWW-Authenticate: Digest realm="'.$loginRealm.'",qop="auth",nonce="'.uniqid().'",opaque="'.md5($device_name.gettimeofday(true)).'"');
			
					dieWithAuthenticationError();
				}
			
				if (!($data = http_digest_parse($_SERVER['PHP_AUTH_DIGEST']))) {
					dieWithAuthenticationError();
				}
			
				$A1 = "";
				if(!$loginA1Hash) {
					$A1 = md5($loginUser.":".$loginRealm.":".$loginPass);
				} else {
					$A1 = $loginA1Hash;
				}
			
				$A2 = md5($_SERVER['REQUEST_METHOD'].':'.$data['uri']);
				$valid_response = md5($A1.':'.$data['nonce'].':'.$data['nc'].':'.$data['cnonce'].':'.$data['qop'].':'.$A2);
				if ($data['response'] != $valid_response) {
					dieWithAuthenticationError();
				}
			}
		}
	}
}
?>
