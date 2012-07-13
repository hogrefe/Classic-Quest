<?php 
    echo '<?xml version="1.0" encoding="UTF-8"?>
         <rss version="2.0">
             <channel>
            
                <title>Classic Quest</title>
                 <link>http://classic-quest.olympe.in/</link>
                 <description>Les actualités du site</description>';
            

            include('../bdd.php');
            include('../pages/functions.php');
            $query = "SELECT * FROM artist ORDER BY id DESC";
            $result = mysql_query($query);
            // Recuperation des resultats
            while($row = mysql_fetch_row($result)){
                $neele = Decoupedatetime($row[3]);
                $mortle =  Decoupedatetime($row[5]);
                echo "  <item>
                        <title>$row[2]</title>
                        <link>http://classic-quest.olympe.in/artist$row[0]</link>
                        <guid isPermaLink='true'>http://classic-quest.olympe.in/artist$row[0]</guid>
                        <description>
                            Née le $neele à $row[4]
                            et décédé(e) le $mortle à $row[6]
                        </description>
                        <pubDate>Sun, 8 Jul 2012 15:21:$row[0] GMT</pubDate>
                        </item>";
            }
                
     echo "</channel>
         </rss>";
 ?>