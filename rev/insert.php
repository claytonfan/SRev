<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
  <?
     $status = 0;
     $return = "index.php";
     $button = "Return to review homepage";
     include("db.inc.php");
     mysql_connect($server,$username,$password);
     @mysql_select_db($database) or die( "Unable to select database");
     $entrytype  = $_POST['entrytype'];
     $pid        = $_POST['pid'];	      // valid for EXISTING provider only	
     $pname      = $_POST['pname'];		
     $visityear  = $_POST['year'];
     $visitmonth = $_POST['month'];
     $visitday   = $_POST['day'];
     $visitdate  = $visityear."-".$visitmonth."-".$visitday;
     $visitloc   = $_POST['visitloc'];
     $duration   = $_POST['duration'];
     $cost       = $_POST['cost'];
     $price      = $_POST['price'];
     $performance= $_POST['performance'];
     $attitude   = $_POST['attitude'];
     $environment= $_POST['environment'];
     $details    = nl2brnl( htmlspecialchars( $_POST['details'], ENT_QUOTES ), 0 );
     //
     $location   = $_POST['location'];
     $website    = $_POST['website'];
     $adsite     = $_POST['adsite'];
     $photo      = $_POST['photo'];
     $email      = $_POST['email'];
     $phone1     = $_POST['phone1'];
     // Start Transaction
     @mysql_query( 'BEGIN' );		
     //
     // Prototype only.
     // If member not found, add new member. Get member ID.
     //
     $myname = $_POST['myname'];
     $query  = "SELECT * FROM Member WHERE mname = '$myname'";
     $member = mysql_query($query);
     $num    = mysql_numrows($member);
     if ( $num <= 0 ) {
       $query = "INSERT INTO Member ( mid, mname ) VALUES ('', '$myname')";   // mid will be generated
       @mysql_query( $query );
       $mid = mysql_insert_id();                             // get automincremented mid
     }
     else {
       $mid = mysql_result($member,0,"mid");
     }
     //
     // ******* end of prototype code *******
     //
     // If Provider Profile is new, INSERT; otherwise UPDATE
     //
     if ( $entrytype == 'NEW' ) {
       $query = "INSERT INTO Provider ( pname, "
        .  "   location, website, adsite, photo, "
        .  "   email, phone1 ) "
        .  " VALUES ( '$pname', "
        .  "   '$location', '$website', '$adsite', '$photo', "
        .  "   '$email', '$phone1' )";
        $pid = mysql_insert_id();
     }
     else {
       $query = "UPDATE Provider SET pname = '$pname', "
        .  "  location = '$location', website = '$website', adsite = '$adsite', photo = '$photo', " 
        .  "  email = '$email', phone1 = '$phone1' "
        .  " WHERE pid = '$pid' ";
     }
     mysql_query($query);
     if( mysql_affected_rows() < 0 ) {
       $message = "Update of reviewed service provider's profile failed. System error; please conatct your administrator.";
     }
     else {
       if ( $entrytype == "NEW" ) {     // get pid
         $query = "SELECT MAX(pid) as lastpid from Provider where pname = '$pname' ";
         $provider = mysql_query($query);
         $pid =  mysql_result($provider,0,"lastpid");
       }
       $query = "INSERT INTO Review ( pid, mid, "
             .  "    visit_date, visit_loc, duration, cost, "
             .  "    price, performance, attitude, environment, "
             .  "    details, "
             .  "    location, website, adsite, photo, "
             .  "    email, phone1 ) "
             .  " VALUES ( '$pid', '$mid', "
             .  "    '$visitdate', '$visitloc', '$duration', '$cost', "
             .  "    '$price', '$performance', '$attitude', '$environment', "
             .  "    '$details', "					
             .  "    '$location', '$website', '$adsite', '$photo', "
             .  "    '$email', '$phone1' ) ";
       mysql_query($query);
       if( mysql_affected_rows() <= 0 ) {
         $message = "Submission of review failed. System error; please conatct your administrator.";
       }
       else {
         $rid     = mysql_insert_id();
         $message = "Submission of review successful.";
         $status  = 1;								
         $return  = "review.php?rid=$rid";
         $button  = "Display review";
       }
     }
     if( $status == 1 ) {
       @mysql_query( "COMMIT" );
     }
     else {
       @mysql_query( "ROLLBACK" );
     }
  ?>
<html>
<head>
<title>Service Review Prototype -  Submission of <? echo $mname ?>'s Review of <? echo $pname; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="reviews.css" type="text/css" rel="stylesheet">
</head>

<body bgcolor="#FFFFCC">
<div align="center">
  <p><strong>Service Review Prototype - Submission of <? echo $mname ?>'s Review of <? echo $pname; ?> </strong> </p>
  <p>&nbsp;</p>
  <p><? echo $message; ?></p>
  <p>&nbsp;</p>
  <form name="return" method="post" action="<? echo $return; ?>">
       <input name="return" type="submit" id="return" value="<? echo $button; ?>">
  </form>
</div>
</body>
</html>
