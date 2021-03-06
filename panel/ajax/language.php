<?php
/*
    PufferPanel - A Minecraft Server Management Panel
    Copyright (c) 2013 Dane Everitt
 
    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.
 
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
 
    You should have received a copy of the GNU General Public License
    along with this program.  If not, see http://www.gnu.org/licenses/.
 */

/*
 * Set Language in Database (& Set Cookie)
 */
if(file_exists('../src/framework/lang/'.$route->params['lang'].'.json')){

	if($core->auth->isLoggedIn($_SERVER['REMOTE_ADDR'], $core->auth->getCookie('pp_auth_token'), $core->auth->getCookie('pp_server_hash')) === true){
	
		$updateLanguage = $mysql->prepare("UPDATE `users` SET `language` = :language WHERE `id` = :id");
		$updateLanguage->execute(array(
			':language' => $route->params['lang'],
			':id' => $core->user->getData('id')
		));
	
	}
	
	setcookie("pp_language", $route->params['lang'], time() + 2678400, '/', null);

}

/*
 * Redirect
 */
if(!isset($_SERVER["HTTP_REFERER"]) || $_SERVER["HTTP_REFERER"] == "")
	Page\components::redirect('login');
else
	Page\components::redirect($_SERVER["HTTP_REFERER"]);

?>