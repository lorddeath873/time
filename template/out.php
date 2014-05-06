<body>
<form action="index.php?site=out&user=<? echo $_SESSION['mid'] ?>" method="post" name="mon">
<select name="month" onChange="document.forms['mon'].submit()">
<option selected="selected" value="1">Januar</option>
<option value="2">Februar</option>
<option value="3">März</option>
<option value="4">April</option>
<option value="5">Mai</option>
<option value="6">Juni</option>
<option value="7">Juli</option>
<option value="8">August</option>
<option value="9">September</option>
<option value="10">Oktober</option>
<option value="11">November</option>
<option value="12">Dezember</option>
</select>
<noscript><input type="submit" class="button" value="Ändern" name="submit_status"/></noscript>
</form>
</body>