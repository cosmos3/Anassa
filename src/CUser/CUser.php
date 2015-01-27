<?php
	
	/**
	 * This is class CUser
	 *
	 */		
	class CUser extends CDatabase {

		public function getId($id) {
			$sql="SELECT * FROM ".ANASSA_TABLE_USER." WHERE id=?";
			return $this->getSQL($sql, array($id));
		}
		
		public function findAcronym($acronym) {
			$sql="SELECT * FROM ".ANASSA_TABLE_USER." WHERE _acronym=?";
			return $this->getSQL($sql, array($acronym));
		}
		
		public function getNameByAcronym($acronym) {
			$user=$this->findAcronym($acronym);
			if ($user) {
				return $user[0]->_name;
			}
			return "";			
		}				

		public function updateUser($sql, $params=array(), $id) {
			$sql="UPDATE ".ANASSA_TABLE_USER." SET ".$sql." WHERE id=?";
			$params[]=$id;
			return $this->executeSQL($sql, $params);
		}

		public function addUser($params=array()) {
			$sql="INSERT INTO ".ANASSA_TABLE_USER." (_acronym, _password, _name, _email, _level, _created) VALUES (?, ?, ?, ?, ?, ?)";
			$params[]=CAnassa::getNow();
			return $this->executeSQL($sql, $params);
		}
		
		public function deleteUser($id=0) {
			$sql="DELETE FROM ".ANASSA_TABLE_USER." WHERE id=?";
			return $this->executeSQL($sql, array($id));
		}		
		
		public function setUserSession($value) {
			if (!$value) {
				unset($_SESSION["user"]);
			} else {
				$_SESSION["user"]=$value[0];
				$_SESSION["user"]->_password="";
			}
		}

		public function checkLogin() {
			$acronym=CAnassa::readPost("acronym", null, "special");
			$password=CAnassa::readPost("password", null, "special");
			if ($acronym && $password) {
				$password_MD5=md5($password);
				$sql="SELECT * FROM ".ANASSA_TABLE_USER." WHERE _acronym=? AND _password=? AND _deleted IS NULL";
				$user=$this->getSQL($sql, array($acronym,	$password_MD5));
				if (count($user)==1) {
					$id=$user[0]->id;
					$logins=$user[0]->_logins+1;
					$this->updateUser("_logins=?, _logged_in=?", array($logins, CAnassa::getNow()), $id);
					$this->setUserSession($user);
					$_SESSION["message"]="
<h3>Välkommen, ".$_SESSION["user"]->_name.".</h3>
<p>".
						CAnassa::txtMessage("+Du är nu inloggad hos ANASSA.")."
</p>";
					return true;
				} else {
					$_SESSION["message"]="-Felaktiga inloggningsuppgifter!";
				}
			} else {
				$_SESSION["message"]="-Alla fält måste vara ifyllda!";
			}
			return false;
		}

		public function logout() {
			$this->updateUser("_logged_out=?", array(CAnassa::getNow()), $_SESSION["user"]->id);
			$_SESSION["message"]="
<h3>Välkommen åter, ".$_SESSION["user"]->_name.".</h3>
<p>".
				CAnassa::txtMessage("+Du är nu utloggad från ANASSA.")."
</p>";
			$this->setUserSession(null);
		}
		
		public function loginForm($loginPage) {
			$html="
<div>
	<form method='POST' action='".$loginPage."' autocomplete='off'>
		<table class='t-form'>
			<tbody>
				<tr>
					<td class='cell-right'><label for='txt_acronym'>Användarnamn:</label></td>
					<td><input type='text' name='acronym' id='txt_acronym' value='admin' size='32'/></td>
				</tr>
				<tr>
					<td class='cell-right'><label for='txt_password'>Lösenord:</label></td>
					<td><input type='password' name='password' id='txt_password' value='admin' size='32'/></td>
				</tr>
				<tr>
					<td></td>
					<td>";
			if (isset($_SESSION["message"])) {
				$html.=CAnassa::txtMessage($_SESSION["message"]);
				unset($_SESSION["message"]);
			}
			$html.="
					</td>
				</tr>
				<tr>
					<td></td>
					<td><input type='submit' name='login' value='Logga in'/></td>
				</tr>
			</tbody>
		</table>
	</form>
</div>".CAnassa::setFocus("txt_acronym");
			return $html;
		}
		
		public static function checkLevel($level=array()) {
			if (isset($_SESSION["user"])) {
				if (in_array($_SESSION["user"]->_level, $level)) {
					return true;
				}
			}
			return false;
		}
		
		public static function checkUser($acronym) {
			if (isset($_SESSION["user"])) {
				if ($acronym==$_SESSION["user"]->_acronym) {
					return true;
				}
			}
			return false;
		}
		
	}

?>