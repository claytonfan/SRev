<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
  <?
     include("db.inc.php");
     mysql_connect($server,$username,$password);
     @mysql_select_db($database) or die( "Unable to select database");
     $entrytype = $_POST['entrytype'];
     $pid       = 0;
     $location  = "";
     $website   = "";
     $adsite    = "";
     $photo     = "";
     $email     = "";
     $phone1    = "";
     $reviewstd = "";
     $reveiwtbd = "";
     $reviewother="";				
     if ($entrytype == "NEW") {
       $pname = $_POST['pname'];
     }
     else {
        $pid  = $_POST['pid'];
        $query="SELECT * FROM Provider WHERE pid = '$pid'";	    
        $result=mysql_query($query);
        $num=mysql_numrows($result);
        if ( $num > 0 ) {
           $pname    = mysql_result($result,0,"pname");
           $location = mysql_result($result,0,"location");
           $website  = mysql_result($result,0,"website");
           $adsite   = mysql_result($result,0,"adsite");
           $photo    = mysql_result($result,0,"photo");
           $email    = mysql_result($result,0,"email");
        }
        mysql_close();
     }
     ?>
<html>
<head>
<title>Service Review Prototype - Review Entry for <? echo $pname ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="reviews.css" type="text/css" rel="stylesheet">
</head>
<body bgcolor="#FFFFCC">
<div align="center">
  <p><strong>Service Review Prototype - Review Entry for <? echo $pname ?></strong></p>
  <form action="insert.php" method="post" name="reviewentry" id="reviewentry">
    <input name="entrytype" type="hidden" value="<? echo $entrytype; ?>">
    <input name="pid"       type="hidden" value="<? echo $pid;   ?>">
    <input name="pname"     type="hidden" value="<? echo $pname; ?>">
    <p align="left">&nbsp; </p>
    <table width="96%" border="0" cellspacing="2" cellpadding="2">
      <tr> 
        <td width="20%">Member's name</td>
        <td> 
          <input name="myname" type="text" id="myname" size="32" maxlength="32">
        </td>
        <td width="40%"><p><font size="2">If you are not already in the database, 
            it will be added.<br>
            </font><font size="2">For prototype only; this field is not necessary 
            for production version. </font></p>
        </td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <table width="96%" border="0" cellspacing="2" cellpadding="2">
      <tr> 
        <td width="20%">Service provider's name</td>
        <td><strong><? echo $pname; ?></strong></td>
        <td width="40%">&nbsp;</td>
      </tr>
      <tr> 
        <td>Service provider's location</td>
        <td><input name="location" type="text" id="location" value="<? echo $location; ?>" size="32" maxlength="32"></td>
        <td>&nbsp;</td>
      </tr>
      <tr> 
        <td>Web site URL</td>
        <td>
<input name="website" type="text" id="website" value="<? echo $website; ?>" size="54" maxlength="128"></td>
        <td><font size="2">For an URL make sure you enter the protocol -- http://, 
          https:// , etc.</font></td>
      </tr>
      <tr> 
        <td>Advertisement URL</td>
        <td>
<input name="adsite" type="text" value="<? echo $adsite; ?>" size="54" maxlength="128"></td>
        <td>&nbsp;</td>
      </tr>
      <tr> 
        <td>Photo URL</td>
        <td>
<input name="photo" type="text" id="photo" value="<? echo $photo; ?>" size="54" maxlength="128"></td>
        <td>&nbsp;</td>
      </tr>
      <tr> 
        <td>Email address</td>
        <td><input name="email" type="text" id="email" value="<? echo $email; ?>" size="54" maxlength="128"></td>
        <td>&nbsp;</td>
      </tr>
      <tr> 
        <td>Telephone number</td>
        <td><input name="phone1" type="text" value="<? echo $phone1; ?>" size="16" maxlength="16"></td>
        <td>&nbsp;</td>
      </tr>
      
    </table>
    <p>&nbsp;</p>
    <table width="96%" border="0" cellspacing="2" cellpadding="2">
      <tr> 
        <td width="20%">Standard Review URL</td>
        <td> <input name="website2" type="text" id="website2" value="<? echo $reviewstd; ?>" size="32" maxlength="64"></td>
        <td width="40%"><font size="2">For an URL make sure you enter the protocol 
          -- http://, https:// , etc.</font></td>
      </tr>
      <tr> 
        <td>TBD Review URL</td>
        <td> <input name="adsite2" type="text" value="<? echo $reviewtdb; ?>" size="32" maxlength="64"></td>
        <td><font size="2">In this prototype these data are not stored in the 
          database.</font></td>
      </tr>
      <tr> 
        <td>Other Review URL</td>
        <td> <input name="photo2" type="text" id="photo2" value="<? echo $reviewother; ?>" size="32" maxlength="64"></td>
        <td>&nbsp;</td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <table width="96%" border="0" cellspacing="2" cellpadding="2">
      <tr> 
        <td width="20%">Date of service</td>
        <td>month 
          <input name="month" type="text" id="month" size="2">
          / day 
          <input name="day" type="text" id="day" size="2" maxlength="2">
          / year 
          <input name="year" type="text" id="year" size="4" maxlength="4">
        </td>
        <td width="40%">&nbsp;</td>
      </tr>
      <tr>
        <td>Location of service</td>
        <td><input name="visitloc" type="text" id="visitloc" size="32" maxlength="32"></td>
        <td>&nbsp;</td>
      </tr>
      <tr> 
        <td>Duration of service</td>
        <td> <input name="duration" type="text" id="duration" size="4" maxlength="4">
          days </td>
        <td><font size="2">If it was an large job visit, please specify duration in 
          review details.</font></td>
      </tr>
      <tr> 
        <td>Cost</td>
        <td>$ 
          <input name="cost" type="text" id="cost"> </td>
        <td>&nbsp;</td>
      </tr>
      <tr> 
        <td>Value</td>
        <td><select name="price" id="price">
            <option value="1">1 - total rip off</option>
            <option value="2">2 . . .</option>
            <option value="3">3 . . .</option>
            <option value="4">4 . . .</option>
            <option value="5">5 . . .</option>
            <option value="6">6 . . .</option>
            <option value="7" selected>7 reasonable</option>
            <option value="8">8 . . .</option>
            <option value="9">9 . . .</option>
            <option value="10">10 - excellent value</option>
          </select></td>
        <td>&nbsp;</td>
      </tr>
      <tr> 
        <td>Service</td>
        <td><select name="service" id="service">
            <option value="1">1 - total rip off</option>
            <option value="2">2 . . .</option>
            <option value="3">3 . . .</option>
            <option value="4">4 . . .</option>
            <option value="5">5 . . .</option>
            <option value="6">6 . . .</option>
            <option value="7" selected>7 - adequate</option>
            <option value="8">8 . . .</option>
            <option value="9">9 . . .</option>
            <option value="10">10 exceptional service</option>
          </select></td>
        <td>&nbsp;</td>
      </tr>
      <tr> 
        <td>Attitude</td>
        <td><input name="attitude" type="text" id="attitude" size="32" maxlength="64"></td>
        <td>&nbsp;</td>
      </tr>
      <tr> 
        <td>Atmosphere</td>
        <td><input name="environment" type="text" id="environment" size="32" maxlength="64"></td>
        <td>&nbsp;</td>
      </tr>
      <tr> 
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr> 
        <td>Review Details</td>
        <td><p><font size="2">Note: The text is wrap automatically. </font></p>
          </td>
        <td>&nbsp;</td>
      </tr>
      <tr> 
        <td colspan="3"><textarea name="details" cols="80" rows="32" wrap="VIRTUAL" id="details"></textarea></td>
      </tr>
      <tr> 
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
    <p>
      <input type="submit" name="Submit" value="Submit Review">
    </p>
  </form>
</div>
</body>
</html>
