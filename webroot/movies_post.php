<?php
	include(__DIR__."/config.inc");
	if (isset($_POST["show_all"])) {
		$_SESSION["movies"]["action"]="show_all";
	} elseif (isset($_POST["search"])) {
		$_SESSION["movies"]["action"]="search";
		$_SESSION["movies"]["title"]=CAnassa::readPost("title", null, "html");
		$_SESSION["movies"]["year_1"]=CAnassa::readPost("year_1", null, "int");
		$_SESSION["movies"]["year_2"]=CAnassa::readPost("year_2", null, "int");
		$_SESSION["movies"]["people"]=CAnassa::readPost("people", null, "html");
		$_SESSION["movies"]["genre"]=CAnassa::readPost("genre", null);
	} elseif (isset($_POST["clear_search"])) {
		$_SESSION["movies"]["action"]="clear_search";
	} elseif (isset($_POST["restore"])) {
		$_SESSION["movies"]["action"]="restore";
	} elseif (isset($_POST["show_last"])) {
		$_SESSION["movies"]["action"]="show_last";
	} elseif (isset($_POST["add_movie"])) {
		$_SESSION["movies"]["action"]="add_movie";
		$_SESSION["movies"]["movieID"]=-1;
	} elseif (isset($_POST["manage_movie_cancel"])) {
		$_SESSION["movies"]["action"]=null;
	} elseif (isset($_POST["manage_movie_save"])) {
		$id=CAnassa::readPost("manage_id", null, "int");
		$params=array();
		$params[]=CAnassa::readPost("manage_title", "", "html");
		$params[]=CAnassa::readPost("manage_year", 2014, "int");
		$genre_1=CAnassa::readPost("manage_genre_1", null);
		$genre_2=CAnassa::readPost("manage_genre_2", null);
		$genre_3=CAnassa::readPost("manage_genre_3", null);
		$genre="";
		if ($genre_1) {
			$genre.=$genre_1;
		}
		if ($genre_2) {
			$genre.=($genre!="" ? "/" : "").$genre_2;
		}
		if ($genre_3) {
			$genre.=($genre!="" ? "/" : "").$genre_3;
		}
		$params[]=$genre;
		$params[]=CAnassa::readPost("manage_content", null, "html");
		$params[]=CAnassa::readPost("manage_image", null, "url");
		$params[]=CAnassa::readPost("manage_imdb", null, "url");
		$params[]=CAnassa::readPost("manage_price", null, "int");
		$_SESSION["movies"]["action"]=null;
		$movieManage=new CMovieManage($anassa["db"]);
		if ($id>0) {
			$movieManage->updateMovie("_title=?, _year=?, _genre=?, _content=?, _image=?, _imdb=?, _price=?", $params, $id, CAnassa::readPost("manage_people_hidden", null));
		} else {
			if ($movieManage->addMovie($params, CAnassa::readPost("manage_people_hidden", null))) {
				$_SESSION["movies"]["action"]="show_last";
			}
		}
	} elseif (isset($_POST["manage_movie_delete"])) {
		$id=CAnassa::readPost("manage_id", null, "int");
		$_SESSION["movies"]["action"]=null;
		if ($id>0) {
			$movieManage=new CMovieManage($anassa["db"]);
			if ($movieManage->deleteMovie($id)) {
				$_SESSION["movies"]["action"]="show_last";
			}
		}
	}
	header("location:movies.php");
	exit();
?>