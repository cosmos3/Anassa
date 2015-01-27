<?php
	if (!isset($_SESSION["gallery"])) {
		$_SESSION["gallery"]=array(
			'path'=>null,
			'size'=>100,
			'quality'=>80,
			'ignoreCache'=>true,
			'cropToFit'=>true,
			'sharpen'=>null,
			'grayScale'=>null,
			'emboss'=>null,
			'colorize_1'=>0,
			'colorize_2'=>0,
			'colorize_3'=>0,
			'negate'=>null,
			'sketchy'=>null
			);
	}

	function checkPostGet() {
		if (isset($_POST["show-gallery"])) {
			$_SESSION["gallery"]["size"]=CAnassa::readPost("size", 100, "int");
			$_SESSION["gallery"]["quality"]=CAnassa::readPost("quality", 80, "int");
			$_SESSION["gallery"]["ignoreCache"]=CAnassa::readPost("no-cache", null);
			$_SESSION["gallery"]["cropToFit"]=CAnassa::readPost("crop-to-fit", null);
			$_SESSION["gallery"]["sharpen"]=CAnassa::readPost("sharpen", null);
			$_SESSION["gallery"]["grayScale"]=CAnassa::readPost("gray-scale", null);
			$_SESSION["gallery"]["emboss"]=CAnassa::readPost("emboss", null);
			$_SESSION["gallery"]["colorize_1"]=CAnassa::readPost("colorize-1", 0, "int");
			$_SESSION["gallery"]["colorize_2"]=CAnassa::readPost("colorize-2", 0, "int");
			$_SESSION["gallery"]["colorize_3"]=CAnassa::readPost("colorize-3", 0, "int");
			$_SESSION["gallery"]["negate"]=CAnassa::readPost("negate", null);
			$_SESSION["gallery"]["sketchy"]=CAnassa::readPost("sketchy", null);
		} else {
			$_SESSION["gallery"]["path"]=CAnassa::readGet("path", null, "html");
		}
	}		
	
	function cmbColorize($nr) {
		$cmbColorize="
			<select name='colorize-".$nr."' id='cmb_colorize-".$nr."'>";
		for ($i=0; $i<52; $i++) {
			$tmp=260-$i*10;
			$cmbColorize.="
				<option value='".$tmp."'".($tmp==$_SESSION["gallery"]["colorize_".$nr] ? " selected" : "").">".$tmp."</option>";
		}
		$cmbColorize.="
			</select>";
		return $cmbColorize;
	}

	function htmlHeader() {
		$cmbSize="
			<select name='size' id='cmb_size'>";
		for ($i=0; $i<9; $i++) {
			$tmp=40+$i*20;
			$cmbSize.="
				<option value='".$tmp."'".($tmp==$_SESSION["gallery"]["size"] ? " selected" : "").">".$tmp."</option>";
		}
		$cmbSize.="
			</select>";
		$cmbQuality="
			<select name='quality' id='cmb_quality'>";
		for ($i=0; $i<=10; $i++) {
			$tmp=100-$i*10;
			$cmbQuality.="
				<option value='".$tmp."'".($tmp==$_SESSION["gallery"]["quality"] ? " selected" : "").">".$tmp."</option>";
		}
		$cmbQuality.="
			</select>";
		$html="
<div style='margin-top:5px;'>
	<form method='POST' action='gallery.php'>
		<table class='t-form' style='width:100%;'>
			<tbody>
				<tr>
					<td>
						<div style='float:left; margin-right:10px;'>
							<label for='cmb_size'>Bildstorlek:</label>".$cmbSize."
						</div>
						<div style='float:left; margin-right:30px;'>
							<label for='cmb_quality'>JPG-Kvalité:</label>".$cmbQuality."
						</div>
						<div style='float:left; margin-right:10px;'>
							<label for='cmb_colorize-1'>Färgsättning - Rött:</label>".cmbColorize(1)."
						</div>
						<div style='float:left; margin-right:10px;'>
							<label for='cmb_colorize-2'>- Grönt:</label>".cmbColorize(2)."
						</div>
						<div style='float:left; margin-right:10px;'>
							<label for='cmb_colorize-3'>- Blått:</label>".cmbColorize(3)."
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div style='float:left;'>
							Filter:&nbsp;&nbsp;
							<input type='checkbox' id='chk-sharpen' name='sharpen'".($_SESSION["gallery"]["sharpen"] ? " checked" : "")."/><label for='chk-sharpen'>Skärpa</label>
							<input type='checkbox' id='chk-grayScale' name='gray-scale'".($_SESSION["gallery"]["grayScale"] ? " checked" : "")."/><label for='chk-grayScale'>Gråskala</label>
							<input type='checkbox' id='chk-emboss' name='emboss'".($_SESSION["gallery"]["emboss"] ? " checked" : "")."/><label for='chk-emboss'>Relief</label>
							<input type='checkbox' id='chk-negate' name='negate'".($_SESSION["gallery"]["negate"] ? " checked" : "")."/><label for='chk-negate'>Negativ</label>
							<input type='checkbox' id='chk-sketchy' name='sketchy'".($_SESSION["gallery"]["sketchy"] ? " checked" : "")."/><label for='chk-sketchy'>\"Sketchy\" effekt</label>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div style='float:left;'>
							<input type='checkbox' id='chk-ignoreCache' name='no-cache'".($_SESSION["gallery"]["ignoreCache"] ? " checked" : "")."/><label for='chk-ignoreCache'>Ingen cache</label>
							<input type='checkbox' id='chk-cropToFit' name='crop-to-fit'".($_SESSION["gallery"]["cropToFit"] ? " checked" : "")."/><label for='chk-cropToFit'>Passnings-beskärning</label>
						</div>
						<input type='submit' name='show-gallery' value='Visa' style='float:right;'/>
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
			</tbody>
		</table>
	</form>
</div>";
		return $html;
	}
	
?>