::/<?php echo($section_title); ?>
<script language="JavaScript1.2" src="global/js/selectbox.js" type="text/javascript"></script>
<script language="JavaScript1.2" type="text/javascript">
function allSelect() {
  List = document.forms[0].list21;
  //alert(List.length);
  if (List.length && List.options[0].value == 'temp') return;
  for (i=0;i<List.length;i++) {
     List.options[i].selected = true;
  }
}
</script>
<form action="<?php $http ?>home.php?action=<?php if($action == "homepage_content2") { echo("homepage_content3"); }  ?>&amp;cat_id=<?php if(isset($cat_id)) { echo($cat_id); } ?>" method="post" name="frm_organise" id="frm_organise" enctype="application/x-www-form-urlencoded" onSubmit="return allSelect();">
<table border="0" cellpadding="0" cellspacing="0">
<tr><td colspan="3" class="norm">Manage the priority of the content display of the homepage. Items in the left hand slect box are content tiems that are not assigned to the homepage yet. You can move these across to the home page display select box (right hand one). Items are prioritised from top to bottom where top signifies the first element on the page.<hr /></td></tr>
<tr>
 <td class="norm"><strong>content</strong></td>
 <td></td>
 <td class="norm"><strong>content displayed on homepage</strong></td>
</tr>
<tr><td><img src="images/s.gif" width="20" height="10" alt="spacer" border="0" /></td></tr>
<tr>
	<td width="40%"><select id="list11" name="list11[]" multiple="multiple" size="10" onDblClick="moveSelectedOptions(this.form.list11,this.form.list21,false)" class="form">
		<?php if(isset($options)) {echo($options);} else {echo("<option value=\"\">Sorry no options found</option>");} ?>
	</select></td>
	<td align="center"><br><br></td>
	<td width="40%"><select id="list21" name="list21[]" multiple="multiple" size="10" onDblClick="moveSelectedOptions(this.form.list21,this.form.list11,false)" class="form">
		<?php if(isset($home_options)) {echo($home_options);} else {echo("<option value=\"\">Sorry no options found</option>");} ?>
	</select></td>
</tr>
<tr>
 <td align="center"><input type="button" name="right" value="&gt;&gt;" class="form" onclick="moveSelectedOptions(document.forms[0].list11,document.forms[0].list21,false);return false;" /> <input type="button" name="right" value="All &gt;&gt;" class="form" onclick="moveAllOptions(document.forms[0].list11,document.forms[0].list21,false); return false;" /></td>
 <td align="center"><input type="button" value="&nbsp;Up&nbsp;" onClick="moveOptionUp(this.form.list21)" class="form" />
 	<br /><br />
 	<input type="button" value="Down" onClick="moveOptionDown(this.form.list21)" class="form" /></td>
 <td align="center"><input type="button" name="left" value="All &lt;&lt;" class="form" onclick="moveAllOptions(document.forms[0].list21,document.forms[0].list11,false); return false;" /> <input type="button" name="left" value="&lt;&lt;" class="form" onclick="moveSelectedOptions(document.forms[0].list21,document.forms[0].list11,false); return false;" /></td>
</tr>
<tr><td colspan="3"><input type="Submit" name="btn_submit" id="btn_submit" value="Submit" class="form" /></td></tr>
</table>
<input type="Hidden" name="hdn_site_id" id="hdn_site_id" value="<?php echo($_POST['r_site']); ?>" />
</form>