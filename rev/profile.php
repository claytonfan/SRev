<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
  <?
     include("db.inc.php");
     include("decode.inc.php");
     mysql_connect($server,$username,$password);
     @mysql_select_db($database) or die( "Unable to select database");
     $pid  = $_GET['pid'];
     $query = "SELECT * FROM Provider WHERE pid = '$pid'";
     $result = mysql_query($query);
     $num = mysql_numrows($result);
     if ( $num == 0 ) {
           mysql_close();
           echo "Not found. System error; please contact the administrator.";
     }
     else {
        $pname    = mysql_result($result,0,"pname");
        $location = mysql_result($result,0,"location");
        $website  = mysql_result($result,0,"website");
        $adsite   = mysql_result($result,0,"adsite");
        $photo    = mysql_result($result,0,"photo");
        $email    = mysql_result($result,0,"email");
        $phone1   = mysql_result($result,0,"phone1");
  ?>
<html>
<head>
<title>Prototype - Profile of <? echo $pname; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="reviews.css" type="text/css" rel="stylesheet">
</head>

<body bgcolor="#FFFFCC">
<div align="center">
  <p><strong>Service Review Prototype - Profile of <? echo $pname; ?></strong> </p>
        <?
           if ( $photo == "" ) {
             echo "<p>&nbsp;</p>";
           }
           else {
             printf( "<p><img src=\"%s\"></p>", $photo );
           }
        ?>
  <p>&nbsp;
  <table width="100%" border="0" cellspacing="0" cellpadding="2">
    <tr class="profile">
      <td>location</td>
      <td><? echo $location; ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr class="profile"> 
      <td width="15%">website</td>
      <td><? echo $website; ?></td>
      <td width="10%">&nbsp;</td>
    </tr>
    <tr class="profile"> 
      <td>advertisement</td>
      <td><? echo $adsite; ?></td>
    </tr>
    <tr class="profile"> 
      <td>email address</td>
      <td><? echo $email; ?></td>
    </tr>
    <tr class="profile"> 
      <td>telephone number</td>
      <td><? echo $phone1; ?></td>
    </tr>
    <tr class="profile"> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
     <?
           while ($i < $num) {
              $rid        = mysql_result($review,$i,"rid");		
              $mid        = mysql_result($review,$i,"mid");
              $mname      = mysql_result($review,$i,"mname");
              $reviewtime = mysql_result($review,$i,"review_time");
              $servicedate= mysql_result($review,$i,"service_date");
              $serviceloc = mysql_result($review,$i,"service_loc");
                                                        $i++;
    ?>
    <tr class="list">
        <td><a href="review.php?rid=<? echo $rid; ?>"><? echo $i; ?></a></td> 
      <td><? echo $servicedate; ?></td>
      <td><a href="review.php?rid=<? echo $rid; ?>"><? echo $reviewtime; ?></a></td>
      <td><a href="member.php?mid=<? echo $mid; ?>"><? echo $mname; ?></a></td>
      <td><? echo $serviceloc; ?></td>
    </tr>
  <? 
         }
       }
     }
     ?> 
  </table>
  <p>&nbsp;</p>  <p>&nbsp;</p>
  <form name="writereview" method="post" action="entry.php">
    <input name="pid" type="hidden" id="pid" value="<? echo $pid ?>">
    <input name="entrytype" type="hidden" id="entrytype" value="EXISIING">
    <input name="write review" type="submit" id="write review" value="Write review for <? echo $pname; ?>">
  </form>
</div>
</body>
</html>
