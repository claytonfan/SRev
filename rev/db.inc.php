<?
   $server="****.****.com";
   $username="******";
   $password="********";
   $database="cfan_bc";
?> 

<?
 // Converts carriage return to <BR> and add $num spaces and beginning of line
 function nl2brnl($text, $num) {
   return preg_replace("/\\r\\n|\\n|\\r/", sprintf("% -".(5+$num)."s","<BR>\\n"), $text);
  }
?>