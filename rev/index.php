<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Service Review Prototype - Entry</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="reviews.css" type="text/css" rel="stylesheet">
</head>

<body bgcolor="#FFFFCC">
<div align="center">
  <p><font face="Arial, Helvetica, sans-serif"><strong><font face="Geneva, Arial, Helvetica, sans-serif">
    Service Review Prototype</font></strong></font> </p>
  <p>Search Service Provider</p>
  <form action="query.php" method="post" name="reviewmain" id="reviewmain">
    <p>&nbsp;</p>
    <table width="96%" border="0" cellspacing="2" cellpadding="2">
      <tr> 
        <td>Provider's name </td>
        <td> 
          <label> <font size="2"> <font size="1"> 
          <input name="querykey" type="radio" value="IS" checked>
          matches exactly</font></font></label> <font size="1"><br>
          <label> 
          <input type="radio" name="querykey" value="LIKE">
          contains</label>
          </font><font face="Geneva, Arial, Helvetica, sans-serif">
          <label></label>
          </font></td>
        <td> 
          <input name="provider" type="text" id="provider" size="32" maxlength="32">
        </td>
        <td> 
          <p> 
            <label> </label>
            <font size="2" face="Geneva, Arial, Helvetica, sans-serif">Before 
            you write a review, search for the service provider to see if it is 
            already in our database.</font><br>
            <font face="Geneva, Arial, Helvetica, sans-serif"> 
            <label></label>
            </font></p></td>
      </tr>
    </table>
    <p><font face="Geneva, Arial, Helvetica, sans-serif"> 
      <input type="submit" name="Submit" value="Search">
      </font></p>
    </form>
  <p align="left">&nbsp;</p>
  <p><font face="Geneva, Arial, Helvetica, sans-serif">Advanced Search (future)</font></p>
</div>
</body>
</html>
