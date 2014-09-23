<?php 
	include(__DIR__."/config.inc");
	$title=getPageTitle('ctrlTest', true);
	$anassa['main']=<<<EOD
$title
<article>
	
	<input type='text' name='' value='' size='24'/>
	<br/><br/>
	
	<textarea name='' rows='6' cols='51'></textarea>
	<br/><br/>
	
	<input type='text' name='' value='' size='12' style='float:left;'/>
	&nbsp;<input type='checkbox' name='' value=''/> Checkbox
	<br/><br/>
	
	<input type='radio' name='r' checked /> Radio 1
	<input type='radio' name='r' checked /> Radio 2
	<br/><br/>						
	
	<input type='text' name='' value='' size='12' style='float:left;'/>
	&nbsp;<input type='submit' name='' value='Submit'/>
	<input type='button' name='new' value='Button'/>
	<br/><br/>
	
	<input type='text' name='' value='' size='12' style='float:left;'/>
	&nbsp;<select>
		<option>cmb 1</option>
		<option>cmb 2</option>
		<option>cmb 3</option>
	</select>
	<br/><br/>	

</article>
EOD;
	include(ANASSA_THEME_PATH);
?>