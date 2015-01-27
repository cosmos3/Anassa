<?php

	/**
	 * This is class CMenu
	 *
	 */
	class CMenu {
		
		public static function MainTop($menu) {
			$html="
<nav id='menu-top'>
	<ul>";
			foreach ($menu["item"] as $item) {
				$selected=($menu["selected"]($item["url"]) ? "selected" : "");
				$img=($item["img"] ? "<img src='img/".$item["img"]."' width='16' height='16' alt='".$item["title"]."'/>" : "");
				if ($item["url"]!=="") {
					$html.="
		<li>
			<a href='".$item["url"]."' class='".$selected."' title='".$item["title"]."'>".$img.$item["text"]."</a>
		</li>";
				}
			}
			$html.="
	</ul>
</nav>";
			return $html;
		}

		public static function User() {
			$onMouse="onMouseOver='divShow(\"menu-user\");' onMouseOut='divHide(\"menu-user\");'";
			if (!isset($_SESSION["user"])) {
				$pic="login-user-no";
				$txt="Du är inte inloggad";
				$menuUser="
		<li>
			<a href='user_login.php' title='Logga in'>Logga in</a>
		<li>
		<li>
			<a href='user_account.php?action=new' title='Registrera dig'>Skapa ett konto</a>
		<li>";
			} else {
				$pic="login-user-yes";
				$txt=$_SESSION["user"]->_name;
				$menuUser="
		<li>
			<a href='user_logout.php' title='Logga ut'>Logga ut</a>
		<li>
		<li>
			<a href='user_account.php?action=edit&amp;id=".$_SESSION["user"]->id."' title='Konto-inställningar'>Mitt konto</a>
		<li>";
			}
			$html="
<div id='login-user' ".$onMouse.">
	<span class='login-user ".$pic."'>".$txt."</span>
</div>
<div id='menu-user' ".$onMouse.">
	<ul>".
				$menuUser."
	</ul>
</div>";
			return $html;
		}
		
	}

?>