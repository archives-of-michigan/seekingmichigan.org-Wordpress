<?php
  if (isset($_SERVER["QUERY_STRING"])) {
    $arglist = $_SERVER["QUERY_STRING"];
    $p = strpos($arglist,",",0);
    if ($p > 0) {
      $alias = substr($arglist,0,$p);
      $ptr = substr($arglist,$p+1);

      $link = "http://seekingmichigan.cdmhost.com/seeking_michigan/discover_item_viewer.php?CISOROOT=" . $alias . "&amp;CISOPTR=" . $ptr;
      
      print("<html>\n");
      print("<head>\n");
      print("<title>Redirect URL</title>\n");
      $line = '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=' . $link . '">' . "\n";
      print("$line");
      print("</head>\n");
      print("<body>\n");
      print("</body>\n");
      print("</html>\n");
    }
    else {
      print("Error, invalid item specified.\n");
    }
  }
  else {
    print("Error, no item specified.\n");
  }
?>
