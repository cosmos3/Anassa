<?php

	/**
	 * This is class CMovieManageHTML
	 *
	 */
	class CMovieManageHTML {
		private $movie=null;
		private $moviePeople=null;
		private $moviePeopleAll=null;
		private $movieId=null;
		private $arrGenre=array();
		
		public function __construct($db) {
			$this->movie=new CMovie($db);
			$this->moviePeople=new CMoviePeople($db);
			$this->moviePeopleAll=new CMoviePeopleAll($db);
		}

		private function cmbPeople() {
			$html="
				<select id='manage_cmb_people' name='manage_people' style='width:250px;' onChange='cmbSelectChk(\"manage_cmb_people\", \"manage_chk_\", \"director,writer,actor\", \"".ANASSA_DELIMITER_SUB."\");'>";
			if ($this->movieId>0) {
				$peopleList=$this->moviePeople->getPeopleInMovie($this->movieId);
				foreach ($peopleList as $aPeople) {
					$name=$this->moviePeopleAll->getNameFromId($aPeople->_people_id);
					$html.="
					<option value='".$aPeople->_function."'>".$name[0]->_name."</option>";
				}
			}
			$html.="
				</select>";
			return $html;
		}

		private function btnSubmit() {
			return "
				<input type='submit' name='manage_movie_save' value='Spara' onClick='cmbToHidden(\"manage_cmb_people\", \"".ANASSA_DELIMITER."\");'/>";
		}
		
		private function cmbGenre($nr) {
			$allGenre=CMovie::getGenre();
			$html="
				<select id='manage_cmb_genre_".$nr."' name='manage_genre_".$nr."'>
					<option value=' '> </option>";
			for ($i=0; $i<count($allGenre); $i++) {
				$html.="
					<option".((isset($this->arrGenre[$nr-1]) && $this->arrGenre[$nr-1]==$allGenre[$i]) ? " selected" : "")." value='".$allGenre[$i]."'>".$allGenre[$i]."</option>";
			}
			$html.="
				</select>";
			return $html;
		}

		private function chkFunction($function, $label) {
			return "
				<input type='checkbox' id='manage_chk_".$function."' onClick='chkChangeCmb(\"manage_cmb_people\", \"manage_chk_".$function."\", \"".$function."\", \"".ANASSA_DELIMITER_SUB."\");'/><label for='manage_chk_".$function."'>".$label."</label>";
		}
		
		public function show($action, $movieId) {
			$this->movieId=$movieId;
			$editable=($action=="add_movie" || $action=="edit_movie");
			$btnCancel="<input type='submit' name='manage_movie_cancel' value='Avbryt'/>";
			if ($this->movieId>0) {
				$aMovie=$this->movie->getMovie($this->movieId);
				$title=$aMovie[0]->_title;
				$year=$aMovie[0]->_year;
				$director=$this->movie->getPeopleByFunction($this->movieId, "director");
				$writer=$this->movie->getPeopleByFunction($this->movieId, "writer");
				$actor=$this->movie->getPeopleByFunction($this->movieId, "actor");
				$genre=$aMovie[0]->_genre;
				$this->arrGenre=explode("/", $genre);
				$content=$aMovie[0]->_content;
				$image=$aMovie[0]->_image;
				$imdb=$aMovie[0]->_imdb;
				$price=$aMovie[0]->_price;
				if ($action=="delete_movie") {
					$action="Ta bort filmen:";
					$btnSubmit="<input type='submit' name='manage_movie_delete' value='Ta bort filmen'/>";
				} elseif ($action=="edit_movie") {
					$action="Gör ändringar av filmen:";
					$btnSubmit=$this->btnSubmit();
				} else {
					$action="Film:";
					$btnSubmit="";
					$btnCancel="<input type='submit' name='manage_movie_cancel' value='Tillbaka'/>";
				}
				$action.=" <span style='color:#840;'>".$title."</span>";
			} else {
				$title="";
				$year="";
				$genre=array("", "", "");
				$content="";
				$image="";
				$imdb="";
				$action="Lägg tll en ny film";
				$btnSubmit=$this->btnSubmit();
			}
			$html="
<h4 style='margin-top: 0;'>".$action."</h4>
<div id='movie-manage-image'>
		<img src='".$image."' width='300' height='450' alt='Filmbild'/>
</div>
<div id='movie-manage'>
	<form method='POST' action='movies_post.php' autocomplete='off'>
		<table class='t-form'>";
			if ($editable) {
				$html.="
			<tr>
				<td class='cell-right'>
					<label for='manage_txt_title'>Filmtitel:</label>
				</td>
				<td>
					<input type='text' id='manage_txt_title' name='manage_title' value='".$title."' size='48'/>
				</td>
			</tr>
			<tr>
				<td class='cell-right'>
					<label for='manage_txt_year'>Inspelningsår:</label>
				</td>
				<td>
					<input type='text' id='manage_txt_year' name='manage_year' value='".$year."' size='4'/>
				</td>
			</tr>
			<tr>
				<td class='cell-right'>
					<label for='manage_cmb_people'>Medverkande:</label>
				</td>
				<td>".
					$this->cmbPeople()."
					<input type='hidden' name='manage_people_hidden' id='manage_cmb_people_hidden'/>
					<input type='button' class='small' value='-' onClick='cmbRemoveOption(\"manage_cmb_people\"); cmbSelectChk(\"manage_cmb_people\", \"manage_chk_\", \"director,writer,actor\",\"".ANASSA_DELIMITER_SUB."\");'/>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>".
					$this->chkFunction("director", "Regi").
					$this->chkFunction("writer", "Manus").
					$this->chkFunction("actor", "Aktör")."
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<div>
						<input type='text' id='manage_txt_people' value='' style='width:238px;' onKeyUp='txtAutoComplete(\"manage_txt_people\", \"movies_people_ac.php\");' onBlur='hideAutoCompleteCheck(\"manage_txt_people\");'/>
						<input type='button' class='small' value='+' onClick='cmbAddOptionFromText(\"manage_cmb_people\", \"manage_txt_people\", \"\"); cmbSelectChk(\"manage_cmb_people\", \"manage_chk_\", \"director,writer,actor\", \"".ANASSA_DELIMITER_SUB."\");'/>
						<div class='auto-complete' id='manage_txt_people_ac'>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td class='cell-right'>
					<label for='manage_cmb_genre_1'>Genre:</label>
				</td>
				<td>".
					$this->cmbGenre(1)."
					<label for='manage_cmb_genre_2'>/</label>".
					$this->cmbGenre(2)."
					<label for='manage_cmb_genre_3'>/</label>".
					$this->cmbGenre(3)."
				</td>
			</tr>
			<tr>
				<td class='cell-right cell-top'>
					<label for='manage_txa_content'>Beskrivning:</label>
				</td>
				<td>
					<textarea id='manage_txa_content' name='manage_content' cols='45' rows='5'>".$content."</textarea>
				</td>
			</tr>
			<tr>
				<td class='cell-right'>
					<label for='manage_txt_image'>Bild-länk:</label>
				</td>
				<td>
					<input type='text' id='manage_txt_image' name='manage_image' value='".$image."' size='48'/>
				</td>
			</tr>
			<tr>
				<td class='cell-right'>
					<label for='manage_txt_imdb'>IMDb-länk:</label>
				</td>
				<td>
					<input type='text' id='manage_txt_imdb' name='manage_imdb' value='".$imdb."' size='48'/>
				</td>
			</tr>
			<tr>
				<td class='cell-right'>
					<label for='manage_txt_price'>Pris:</label>
				</td>
				<td>
					<input type='text' id='manage_txt_price' name='manage_price' value='".$price."' size='4'/>
				</td>
			</tr>";
			} else {
				$html.="
			<tr>
				<td class='cell-right'>
					Filmtitel:
				</td>
				<td>".
					$title."
				</td>
			</tr>
			<tr>
				<td class='cell-right'>
					Inspelningsår:
				</td>
				<td>".
					$year."
				</td>
			</tr>
			<tr>
				<td class='cell-right'>
					Regi:
				</td>
				<td>".
					$director."
				</td>
			</tr>
			<tr>
				<td class='cell-right'>
					Manus:
				</td>
				<td>".
					$writer."
				</td>
			</tr>
			<tr>
				<td class='cell-right'>
					Aktörer:
				</td>
				<td>".
					$actor."
				</td>
			</tr>
			<tr>
				<td class='cell-right'>
					Genre:
				</td>
				<td>".
					$genre."
				</td>
			</tr>
			<tr>
				<td class='cell-right cell-top'>
					Beskrivning:
				</td>
				<td>".
					$content."
				</td>
			</tr>
			<tr>
				<td class='cell-right'>
					IMDb-länk:
				</td>
				<td>".
					CAnassa::txtLinkBlank($imdb, $imdb)."
				</td>
			</tr>
			<tr>
				<td class='cell-right'>
					Pris:
				</td>
				<td>".
					CAnassa::txtPrice($price, true)."
				</td>
			</tr>";
			}
			$html.="
		</table>
		<br/><br/>
		<input type='hidden' name='manage_id' value='".$this->movieId."'/>".
				$btnSubmit.$btnCancel."
	</form>		
</div>			
<div class='clear'></div>
<script type='text/javascript'>
	cmbSelectChk('manage_cmb_people', 'manage_chk_', 'director,writer,actor', '".ANASSA_DELIMITER_SUB."');
</script>";
			return $html;
		}

	}

?>