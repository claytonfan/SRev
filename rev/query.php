<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Service Review Prototype - Entry</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="reviews.css" type="text/css" rel="stylesheet">
</head>
<body bgcolor="#FFFFCC">
<div align="center">
  <p><strong>Service Review Prototype - Query Result</strong> </p>
  <p>&nbsp;</p>
  <?
     include("db.inc.php");
     mysql_connect($server,$username,$password);
     @mysql_select_db($database) or die( "Unable to select database");
        $query="SELECT * FROM PDAT WHERE pname = '$pppppp'";	    
        
     $result=mysql_query($query);
     $num=mysql_numrows($result);
     mysql_close();
     $i=0;
        if ( $num == 0 ) {   
        $message = "Person not found. You may create a new profile";
        }
        else {
     ?>
  <table width="100%" border="1" cellspacing="0" cellpadding="2">
    <tr class="list"> 
      <td><strong>name</strong></td>
      <td><strong>location</strong></td>
      <td><strong>web site</strong></td>
      <td><strong>email address</strong></td>
      <td><strong>telephone number</strong></td>
    </tr> 
     <?
        while ($i < $num) {
           if( ($pid      = mysql_result($result,$i,"pid")      ) == "" ) $pid      = "&nbsp;"; 
           if( ($location = mysql_result($result,$i,"location") ) == "" ) $location = "&nbsp;";
           if( ($website  = mysql_result($result,$i,"website")  ) == "" ) $website  = "&nbsp;";
           if( ($email    = mysql_result($result,$i,"email")    ) == "" ) $email    = "&nbsp;";
           if( ($phone1   = mysql_result($result,$i,"phone1")   ) == "" ) $phone1   = "&nbsp;";
           $i++;
    ?>
    <tr class="list"> 
      <td><a href="profile.php?pid=<? echo $pid; ?>"><? echo $pname; ?></a></td>
      <td><? echo $location; ?></td>
      <td><a href="<? echo $website; ?>" target="_blank"><? echo $website; ?></a></td>
      <td><? echo $email; ?></td>
      <td><? echo $phone1; ?></td>
    </tr>
  </table>
    
  <p><? echo $message; ?></p>
  <p>&nbsp;</p>
  <form name="entry.php" method="post" action="entry.php">
    <input name="entrytype" type="hidden" value="NEW">
    <table width="64%" border="0" cellspacing="2" cellpadding="2">
      <tr> 
        <td width="40%"><font face="Geneva, Arial, Helvetica, sans-serif">Person's 
          name </font></td>
        <td width="60%"> <input name="pname" type="text" id="pname" value="<? echo $pppppp ?>" size="32" maxlength="32"> 
        </td>
      </tr>
    </table>
    <p>
      <input type="submit" name="Submit" value="Submit">
    </p>
  </form>	 
</div>
</body>
</html>
