<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?
  include("db.inc.php");
  include("decode.inc.php");
  mysql_connect($server,$username,$password);
  @mysql_select_db($database) or die( "Unable to select database");
  $mid = $_GET['mid'];
  $query="SELECT * FROM Member WHERE mid = '$mid' ";
  $result=mysql_query($query);
  $num=mysql_numrows($result);
     if ( $num <= 0 ) {   
     echo "Member not found. System error; please contact your administrator";
     }
     else {
     $mname = mysql_result($result,0,"mname");
?>
<html>
<head>
<title>Service Review Prototype - Reviews Submitted by <? echo $mname; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="reviews.css" type="text/css" rel="stylesheet">
</head>
<body bgcolor="#FFFFCC">
<div align="center">
  <p><strong>Service Review Prototype - Reviews Submitted by <? echo $mname; ?></strong> </p>
  <p>&nbsp;</p>
  <?
     $query = "SELECT *, CASE price      "  . $q_price   . " AS price_s "
                    . ", CASE performance " . $q_perform . " AS performance_s "
                    . " FROM Provider, Review WHERE mid = '$mid' AND Provider.pid = Review.pid ORDER by visit_date, review_time DESC";
     $result=mysql_query($query);
     $num=mysql_numrows($result);
     mysql_close();
     $i=0;
        if ( $num == 0 ) {   
        echo "Reviews not found.";
        }
        else {
     ?>
  <table width="100%" border="1" cellspacing="0" cellpadding="2">
    <tr class="list">
      <td>&nbsp;</td>
      <td><strong>service provider's name</strong></td>
      <td><strong>location</strong></td>
      <td><strong>date of visit</strong></td>
      <td><strong>location of visit</strong></td>
      <td><strong>value</strong></td>
      <td><strong>performace</strong></td>
      <td><strong>attitude</strong></td>
    </tr>
    <?
        while ($i < $num) {
           $rid              = mysql_result($result,$i,"rid");
           if( ($pname       = mysql_result($result,$i,"pname")             ) == "" ) $pname       = "&nbsp;";
           if( ($location    = mysql_result($result,$i,"Provider.location") ) == "" ) $location    = "&nbsp;";
		   if( ($visitdate   = mysql_result($result,$i,"visit_date")        ) == "" ) $visitdate   = "&nbsp;";
           if( ($visitloc    = mysql_result($result,$i,"visit_loc")         ) == "" ) $visitloc    = "&nbsp;";
		   if( ($price       = mysql_result($result,$i,"price")             ) == "" ) $price       = "&nbsp;";
           if( ($performance = mysql_result($result,$i,"performance_s")     ) == "" ) $performance = "&nbsp;";
           if( ($attitude    = mysql_result($result,$i,"attitude")          ) == "" ) $attitude    = "&nbsp;";
           $i++;
    ?>
    <tr class="list">
      <td><a href="review.php?rid=<? echo $rid; ?>"><? echo $i; ?></a></td>
      <td><a href="review.php?rid=<? echo $rid; ?>"><? echo $pname; ?></a></td>
      <td><? echo $location; ?></td>
      <td><? echo $visitdate; ?></td>
      <td><? echo $visitloc; ?></td>
      <td><? echo $price; ?></td>
      <td><? echo $performance; ?></td>
      <td><? echo $attitude; ?></td>
    </tr>
    <? 
    }
  }
  ?>
  </table>
</div>
</body>
</html>
<? } ?>
