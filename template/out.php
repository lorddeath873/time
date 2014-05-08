<body>
<form action="index.php?site=out&user=<? echo $_SESSION['mid'] ?>" method="post" name="mon">
<select name="month" onChange="document.forms['mon'].submit()">
<option selected="selected" value="1"><? echo $locate['196'] ?></option>
<option value="2"><? echo $locate['197'] ?></option>
<option value="3"><? echo $locate['198'] ?></option>
<option value="4"><? echo $locate['199'] ?></option>
<option value="5"><? echo $locate['200'] ?></option>
<option value="6"><? echo $locate['201'] ?></option>
<option value="7"><? echo $locate['202'] ?></option>
<option value="8"><? echo $locate['203'] ?></option>
<option value="9"><? echo $locate['204'] ?></option>
<option value="10"><? echo $locate['205'] ?></option>
<option value="11"><? echo $locate['206'] ?></option>
<option value="12"><? echo $locate['207'] ?></option>
</select>
<noscript><input type="submit" class="button" value="<? echo $locate['253'] ?>" name="submit_status"/></noscript>
</form>
</body>