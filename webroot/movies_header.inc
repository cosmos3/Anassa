<?php
	if (!isset($_SESSION["movies"])) {
		$_SESSION["movies"]=array(
			'title'=>null,
			'year_1'=>null,
			'year_2'=>null,
			'genre'=>null,
			'people'=>null,
			'action'=>"show_all",
			'movieID'=>null,
			'query'=>"",
			'params'=>array(),
			'quantity'=>null,
			'view_people_content'=>0,
			'order_by'=>"_title",
			'order'=>"ASC",
			'page'=>1,
			'per_page'=>10
			);
	}

	function cmbGenre() {
		$genre=CMovie::getGenre();
		$html="
			<select name='genre' id='cmb_genre'>
				<option value=' '> </option>";
		for ($i=0; $i<count($genre); $i++) {
			$html.="
				<option value='".$genre[$i]."'".($genre[$i]==$_SESSION["movies"]["genre"] ? " selected" : "").">".$genre[$i]."</option>";
		}
		$html.="
			</select>";
		return $html;
	}
	
	function htmlHeader() {
		$html="
<div style='margin-top:5px;'>
	<form method='POST' action='movies_post.php' autocomplete='off'>
		<table class='t-form' style='width:100%;'>
			<tbody>
				<tr>
					<td>
						<div style='float:left; padding-top:4px; margin-right:5px;'>
							<label for='txt_title'>Titel:</label>
						</div>
						<div style='float:left;'>
							<input type='text' name='title' id='txt_title' value='".$_SESSION["movies"]["title"]."' size='20' style='margin-right:10px;' onKeyUp='txtAutoComplete(\"txt_title\", \"movies_title_ac.php\");' onBlur='hideAutoCompleteCheck(\"txt_title\");'/>
							<div class='auto-complete' id='txt_title_ac'>
							</div>
						</div>
						<div style='float:left; margin-right:5px;'>
							<label for='txt_year_1'>År:</label>
							<input type='text' name='year_1' id='txt_year_1' value='".$_SESSION["movies"]["year_1"]."' size='4'/>
							<label for='txt_year_2'> &gt;&nbsp;&lt; </label>
							<input type='text' name='year_2' id='txt_year_2' value='".$_SESSION["movies"]["year_2"]."' size='4' style='margin-right:10px;'/>
							<label for='txt_people'>Medverkande:</label>
						</div>
						<div style='float:left;'>
							<input type='text' name='people' id='txt_people' value='".$_SESSION["movies"]["people"]."' size='20' style='margin-right:10px;' onKeyUp='txtAutoComplete(\"txt_people\", \"movies_people_ac.php\");' onBlur='hideAutoCompleteCheck(\"txt_people\");'/>
							<div class='auto-complete' id='txt_people_ac'>
							</div>
						</div>
						<div style='float:left;'>
							<label for='cmb_genre'>Genre:</label>".
			cmbGenre()."
						</div>
					</td>
				</tr>
				<tr>
					<td>";
		if (isset($_SESSION["message"])) {
			$html.=CAnassa::txtMessage($_SESSION["message"]);
			unset($_SESSION["message"]);
		}
		$html.="
					</td>
				</tr>
				<tr>
					<td>
						<input type='submit' name='search' value='Sök'/>
						<input type='submit' name='clear_search' value='Rensa sökfälten'/>
						<input type='submit' name='show_all' value='Visa alla'/>
						<input type='submit' name='show_last' value='Visa senaste'/>";
		if (CUser::checkLevel(array("super"))) {
			$html.="
						<input type='submit' name='restore' value='Återställ databasen' style='float:right; margin-right:0;'/>";
						}
		if (CUser::checkLevel(array("admin", "super"))) {
			$html.="
						<input type='submit' name='add_movie' value='Lägg till film' style='float:right; margin-right:0;'/>";
		}
		$html.="
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>";
		return $html;
	}
	
?>