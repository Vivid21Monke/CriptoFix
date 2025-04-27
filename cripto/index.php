<?php
  $data1 = file_get_contents("https://www.worldcoinindex.com/apiservice/json?key=eA1UQLojDkGOqxJiglMoE4Aw6ddVyITD80f");
  $cryptoData1 = json_decode($data1, true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crypto</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
  <div class="container">

      <!--  navigation  -->
      <div class="container__nav">
        <div class="Our-Logo-Name">
          N/A
        </div>
        <div class="conntainer__nav__buttons">
          <button class="Main-Nav-Button">N/A</button>
          <button class="Info-Nav-Button">N/A</button>
          <button class="meme-Nav-Button">N/A</button>
        </div>
      <div>
    </div>
  </div>
    
        <!--  Crypto Main/Price  -->
        
        <div class="container__main__crypto"> <?php 
                foreach ($cryptoData1['Markets'] as $x) {
            echo "<div>";
                echo "<div class='container__Border__all'>";
                        echo  $x['Name'];
                    echo "<div class='container__Crypto__Name'>";
                    echo "</div>";
                        echo "<div class='container__price__graph'>";
                        echo "<div>";
                            echo "Price:";  
                            echo  $x['Price_eur'];
                            echo "€";
                        echo "</div>";
                        echo "Graph Placeholder";
                        echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
                        ?>
        </div>
        <!--  Extra Pirces  -->
            <div class="continer__extra__prices">
                N/A
            </div>
    
    
    
</body>
</html>