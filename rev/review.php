<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
  <?
     include("db.inc.php");
     include("decode.inc.php");
     mysql_connect($server,$username,$password);
     @mysql_select_db($database) or die( "Unable to select database");
     $rid = $_GET['rid'];
     // echo "rid = $rid\n";
     $query = "SELECT *,   CASE price "          . $q_price   . " AS price_s "
                     . " , CASE performance "    . $q_perform . " AS performance_s	"
         . " FROM Review, Provider, Member WHERE rid = '$rid' AND Provider.pid = Review.pid AND Member.mid = Review.mid";
     $result = mysql_query($query);
     $num = mysql_numrows($result);
     if ( $num == 0 ) {
       mysql_close();
       echo "Review not found. System error; please contact the administrator.";
     }
     else {
        $rid        = mysql_result($result,0,"rid");
        $pid        = mysql_result($result,0,"Review.pid");
        $mid        = mysql_result($result,0,"Review.mid");
        $pname      = mysql_result($result,0,"pname");		
        $mname      = mysql_result($result,0,"mname");
        $reviewtime = mysql_result($result,0,"review_time");
        $visitdate  = mysql_result($result,0,"visit_date");
        $visitloc   = mysql_result($result,0,"visit_loc");
        $duration   = mysql_result($result,0,"duration");
        $cost       = mysql_result($result,0,"cost");
        $price      = mysql_result($result,0,"price_s");
        $performance= mysql_result($result,0,"performance_s");
        $attitude   = mysql_result($result,0,"attitude");
        $environment= mysql_result($result,0,"environment");
        $details    = mysql_result($result,0,"details");					
        $location   = mysql_result($result,0,"Review.location");
        $website    = mysql_result($result,0,"Review.website");
        $adsite     = mysql_result($result,0,"Review.adsite");
        $photo      = mysql_result($result,0,"Review.photo");
        $email      = mysql_result($result,0,"Review.email");
        $phone1     = mysql_result($result,0,"Review.phone1");
  ?>
<html>
<head>
<title>Service Review Prototype -  <? echo $mname; ?>'s Review of <? echo $pname; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="reviews.css" type="text/css" rel="stylesheet">
</head>

<body bgcolor="#FFFFCC">
<div align="center">
  <p><strong>Service Review Prototype - <? echo $mname; ?>'s Review of <? echo $pname; ?> </strong> </p>
        <?
           if ( $photo == "" ) {
             echo "<p>photo not available</p>";
           }
           else {
             printf( "<p><img src=\"%s\"></p>", $photo );
           }
        ?>
  <p>&nbsp;
        </p><table width="100%" border="0" cellspacing="0" cellpadding="2">
    <tr class="profile"> 
      <td width="15%">website</td>
      <td><? echo $website; ?></td>
      <td width="10%">&nbsp;</td>
    </tr>
    <tr class="profile"> 
      <td>advertisement</td>
      <td><? echo $adsite; ?></td>
      <td>&nbsp;</td>
    </tr>
    <tr class="profile"> 
      <td>email address</td>
      <td><? echo $email; ?></td>
      <td>&nbsp;</td>
    </tr>
    <tr class="profile"> 
      <td>telephone number</td>
      <td><? echo $phone1; ?></td>
      <td>&nbsp;</td>
     </tr>
  </table>
<hr>
  <table width="100%" border="0" cellspacing="0" cellpadding="2">
    <tr class="profile"> 
      <td width="15%">date of visit</td>
      <td><? echo $visitdate; ?></td>
      <td width="10%">&nbsp;</td>
      <td width="15%">review timestamp</td>
      <td><? echo $reviewtime; ?></td>
    </tr>
    <tr class="profile"> 
      <td>location of visit</td>
      <td><? echo $visitloc; ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr class="profile"> 
      <td>duration of service (days)</td>
      <td><? echo $duration; ?></td>
      <td>&nbsp;</td>
      <td>attitude</td>
      <td><? echo $attitude; ?></td>
    </tr>
    <tr class="profile"> 
      <td>cost</td>
      <td>$<? echo $cost; ?></td>
      <td>&nbsp;</td>
      <td>environment</td>
      <td><? echo $environment; ?></td>
    </tr>
    <tr class="profile"> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>value</td>
      <td><? echo $price; ?></td>
    </tr>
    <tr class="profile"> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>performance</td>
      <td><? echo $performance; ?></td>
    </tr>
  </table>
  <hr>
  <table width="100%" border="0" cellspacing="0" cellpadding="2">
    <tr class="profile"> 
      <td width="15%">details</td>
    </tr>
    <tr class="profile"> 
      <td><? printf("%s\n", $details); ?></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <form name="writereview" method="post" action="entry.php">
    <input name="pid" type="hidden" id="pid" value="<? echo $pid; ?>">
    <input name="entrytype" type="hidden" id="entrytype" value="EXTISTING">
       <input name="write review" type="submit" id="write review" value="Write review for <? echo $pname; ?>">
  </form>
</div>
</body>
</html>
<? } ?>
