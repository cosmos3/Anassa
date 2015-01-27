<?php
	
	class CUserAccount {

		public function __construct($db) {
			$this->user=new CUser($db);
		}

		public function htmlTable($admin) {
		}

		public function checkPostAction() {
			if (CAnassa::readPost("cancel", null)) {
				return "cancel";
			} else {
				$id=CAnassa::readPost("id", null, "int");
				if (CAnassa::readPost("delete", null)) {
					$this->user->updateUser("_deleted=?, _logged_out=?", array(CAnassa::getNow(), CAnassa::getNow()), $_SESSION["user"]->id);
					$this->user->setUserSession(null);
					return "delete";
				} elseif (CAnassa::readPost("save", null)) {
					$_SESSION["tmp_user"]=array(
						'acronym'=>CAnassa::readPost("acronym", null, "html"),
						'password'=>CAnassa::readPost("password", null, "html"),
						'password_md5'=>CAnassa::readPost("password_md5", null),
						'name'=>CAnassa::readPost("name", null, "html"),
						'email'=>CAnassa::readPost("email", null, "email"),
						'level'=>CAnassa::readPost("level", null)
						);
					$tmp=(object)$_SESSION["tmp_user"];
					if ($tmp->acronym=="" || $tmp->name=="") {
						CAnassa::addToSession("message", "Alla fält måste vara ifyllda<br/>");
					}
					$user=$this->user->findAcronym($tmp->acronym);
					if ($user) {
						if ($user[0]->id!=$id) {
							CAnassa::addToSession("message", "Användarnamnet används redan<br/>");
						}
					}
					if (!filter_var($tmp->email, FILTER_VALIDATE_EMAIL)) {
						CAnassa::addToSession("message", "Ogiltig e-postadress<br/>");
					}
					if ($tmp->password_md5>"") {
						if ($tmp->password>"") {
							$tmp->password_md5=md5($tmp->password);
						}
					} else {
						if ($tmp->password>"") {
							$tmp->password_md5=md5($tmp->password);
						} else {
							CAnassa::addToSession("message", "Lösenord saknas<br/>");
						}
					}
					if (!isset($_SESSION["message"])) {
						unset($_SESSION["tmp_user"]);
						$params=array($tmp->acronym, $tmp->password_md5, $tmp->name, $tmp->email, $tmp->level);
						if ($id>0) {
							$this->user->updateUser("_acronym=?, _password=?, _name=?, _email=?, _level=?", $params, $id);
							$user=$this->user->getId($id);
							$this->user->setUserSession($user);
							return "edit";
						} else {
							$this->user->addUser($params);
							$id=$this->user->lastId();
							$user=$this->user->getId($id);
							$this->user->updateUser("_logins=?, _logged_in=?", array(1, CAnassa::getNow()), $id);
							$this->user->setUserSession($user);
							return "new";
						}
					} else {
						$_SESSION["message"]="-".$_SESSION["message"];
					}
				}
			}
			return false;
		}
		
		private function cmbLevel($level, $locked) {
			$optLevel=array("normal", "admin", "super");
			$maxLevel=(isset($_SESSION["user"]) ? $_SESSION["user"]->_level : $level);
			$html="
				<select class='label-above user-manage' name='level'>";
			if ($locked) {
				$html.="
					<option value='".$level."' selected>".$level."</option>";
			} else {
				foreach ($optLevel as $lvl) {
					$html.="
					<option value='".$lvl."'".($level==$lvl ? " selected" : "").">".$lvl."</option>";
					if ($lvl==$maxLevel) {
						break;
					}
				}
			}
			$html.="
				</select>";
			return $html;
		}

		public function htmlForm($action, $locked, $redirect) {
			$id=($action=="edit" ? CAnassa::readGet("id", null, "int") : 0);
			if ($action=="new" || ($action=="edit" && $id>0)) {
				if (!isset($_SESSION["tmp_user"])) {
					if ($id>0) {
						$user=$this->user->getId($id);
						$_SESSION["tmp_user"]=array(
							'acronym'=>$user[0]->_acronym,
							'password'=>"",
							'password_md5'=>$user[0]->_password,
							'name'=>$user[0]->_name,
							'email'=>$user[0]->_email,
							'level'=>$user[0]->_level
							);
					} else {
						$_SESSION["tmp_user"]=array(
							'acronym'=>"",
							'password'=>"",
							'password_md5'=>"",
							'name'=>"",
							'email'=>"",
							'level'=>"normal"
							);
					}
				}
				$txtTitle=($id>0 ? "Konto-inställningar" : "Ny användare - skapa ett konto");
				$btnDelete=($id>2 ? "<input type='submit' name='delete' value='Radera konto'/>" : "");
				$btnCancel=($redirect ? "<input type='submit' name='cancel' value='Avbryt'/>" : "");
				$tmp=(object)$_SESSION["tmp_user"];
				unset($_SESSION["tmp_user"]);
				$html="
<h3>".$txtTitle."</h3>";
				if ($id>0) {
					$user=$this->user->getId($id);
					$html.="
<h4>".$user[0]->_name."</h4>
<p class='font-small-italic'>
	Kontot skapat: ".CAnassa::txtDate($user[0]->_created, 3, "min")."<br/>
	Senaste utloggning: ".CAnassa::txtDate($user[0]->_logged_out, 3, "min")."<br/>
	Antal inloggningar: ".$user[0]->_logins."
</p>";
				}
				$html.="
<form method='POST' autocomplete='off'>
	<p>
		<label>
			Användarnamn:<br/>
			<input class='label-above user-manage' type='text' name='acronym' value='".$tmp->acronym."'/>
		</label>
	</p>
	<p>
		<label>
			Lösenord:<br/>
			<input class='label-above user-manage' type='password' name='password' value='".$tmp->password."'/>
		</label>
		<input type='hidden' name='password_md5' value='".$tmp->password_md5."'/>
	</p>
  <p>
		<label>
			Namn:<br/>
      <input class='label-above user-manage' type='text' name='name' value='".$tmp->name."'/>
		</label>
	</p>
	<p>
		<label>
			E-post:<br/>
      <input class='label-above user-manage' type='text' name='email' value='".$tmp->email."'/>
		</label>
	</p>
	<p>
		<label>
			Användarnivå:<br/>".
					$this->cmbLevel($tmp->level, $locked)."
		</label>
	</p>";
				if (isset($_SESSION["message"])) {
					$html.="
	<p>".
						CAnassa::txtMessage($_SESSION["message"])."
	</p>";
					unset($_SESSION["message"]);
				}
				$html.="
  <p>
		<input type='submit' name='save' value='Spara'/>".
					$btnDelete.
					$btnCancel."
		<input type='hidden' name='id' value='".$id."'/>
	</p>
</form>";
			}
			return $html;
		} 

	}

?>