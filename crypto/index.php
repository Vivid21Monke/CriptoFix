<?php
$data1 = file_get_contents("https://www.worldcoinindex.com/apiservice/json?key=eA1UQLojDkGOqxJiglMoE4Aw6ddVyITD80f");
$cryptoData1 = json_decode($data1, true);
$coins = [];
if (isset($cryptoData1['Markets'])) {
    foreach ($cryptoData1['Markets'] as $market) {
        if (isset($market['Name']) && isset($market['Price_eur'])) {
            $coins[] = [
                'label' => $market['Name'],
                'y' => floatval($market['Price_eur'])
            ];
        }
    }
}
$coins = array_slice($coins, 0, 1000);
$coinsJson = json_encode($coins);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CryptoCur</title>
  <link rel="stylesheet" href="index.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Space+Mono|Muli">
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</head>
<body>
<div class="container">

  <!-- Navigation -->

  <div class="container__nav">
    <div class="Our-Logo-Name"><h1>CryptoCur</h1></div>
      <div>
          <button class="button-85" role="button">Main</button>
      </div>
      <div>
          <button class="button-85" role="button">Info</button>
      </div>
      <div>
          <button class="button-85" role="button">Buy/Sell</button>
      </div>
  </div> 
  <div class="Big__Flex">

    <!-- Crypto Main/Price -->

    <div class="container__main__crypto">
      <?php 
      foreach ($cryptoData1['Markets'] as $x) {
          echo "<div class='container__Border__all'>";
          echo "<div class='container__Crypto__Name'>{$x['Name']}</div>";
          echo "<div class='container__price__graph'>";
          echo "<div>Price: {$x['Price_eur']}€</div>";
          echo "</div>";
          echo "</div>";
      }
      ?>
    </div>
    <!-- Grapht container  -->
    <div class="continer__extra_prices">
      <div class="chart-container">
        <div id="chartContainer" style="height: 370px; width: 3000px;"></div> 
      </div>
    </div>
  </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function () {
    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        theme: "light2",
        title: {
            text: "Crypto Prices (EUR)"
        },
        axisX: {
            interval: 7, 
            labelAngle: -90, 
        },
        axisY: {
            title: "Price (EUR)",
            minimum: 0, 
            labelFormatter: function (e) {
                return e.value.toFixed(12) + "€"; 
            },
            maximum: Math.max(...<?php echo json_encode(array_column($coins, 'y')); ?>) * 1.1 
        },
        data: [{
            type: "column",
            dataPointWidth: 0.2, 
            dataPoints: <?php echo $coinsJson; ?>
        }]
    });
    chart.render();
});
</script>
</body>
</html>
