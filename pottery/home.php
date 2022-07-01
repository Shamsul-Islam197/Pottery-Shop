<?php
    session_start();
        require_once('connection.php');
        if(isset($_SESSION['userid'])){ 
            $query="SELECT * FROM `order` ORDER BY date ASC";
            $result=mysqli_query($con,$query);
        }else{
            header('location:login.php');
        }
        
         if(isset($_POST['logout'])){
            if(isset(($_SESSION['userid']))){
                session_destroy();
                header('location:login.php');
            }
            
        }
    
?>
        
        
        

<!DOCTYPE html>
<html>
<head>
	<title>Statistics</title>
    <meta charset="utf-8">
    <link rel="stylesheet" a href="css\order.CSS">

</head>
<body>
    <form action="graph.php" method="POST" >
    <div class="container">
    <ul>
        <li><a href="home.php">Home</a></li>
        <li><a href="prod.php">Product</a></li>
        <li><a href="add.php">Add Product</a></li>
        <li><a href="order.php">Ordered Product</a></li>
        <li class="active"><a href="graph.php">Statistics</a></li>
        <li><a href="message.php">Message</a></li>
        <li><a href="user.php">User</a></li>
        <li><a href="about.php">About Us</a></li>
    </ul>
    <input type="submit" name="logout" onclick="return Confirmation()" value="Log Out" class="btn-logout"/>
    </div>
    
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Product Name ', 'saleQnty '],

          <?php

            
            $query="SELECT `product_name`,SUM(`product_qnty`)`saleQnty` FROM `order` GROUP BY `product_name`";
            $result=mysqli_query($con,$query);
            while($row=mysqli_fetch_assoc($result)){
                    
                    echo"['".$row['product_name']."',".$row['saleQnty']."],";
                    
                    }



          ?>

        
        ]);

        var options = {
          title: 'Product sale',
          colors:['#4ab065','#a06eb8','#517eb5','#de6262','#803060','#E6E6FA','#708090']
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

    <div id="piechart" style="margin: 150px auto;width: 1000px; height: 500px;"></div>




<script type="text/javascript">
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawBarColors);

function drawBarColors() {
      var data = google.visualization.arrayToDataTable([
        ['Customer ID ', 'Quantity '],

        <?php

            
            $query="SELECT `customer_id`,SUM(`product_qnty`)`saleQnty` FROM `order` GROUP BY `customer_id`";
            $result=mysqli_query($con,$query);
            while($row=mysqli_fetch_assoc($result)){
                    
                    echo"['".$row['customer_id']."',".$row['saleQnty']."],";
                    
                    }



          ?>
        
      ]);

      var options = {
        title: 'Product bought by customer',
        chartArea: {width: '50%'},
        colors: ['#7387bf'],
        hAxis: {
          title: 'Quantity',
          minValue: 0
        },
        vAxis: {
          title: 'Customer ID'
        }
      };
      var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }


</script>
    <div id="chart_div" style="margin: 150px auto; width: 1000px; height: 500px;"></div>





    <script type="text/javascript">

    google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        var data = google.visualization.arrayToDataTable([
          ['Product ID ', 'Stock Available '],

          <?php

            
            $query="SELECT `id`, `qnty` FROM `product` GROUP BY `id`";
            $result=mysqli_query($con,$query);
            while($row=mysqli_fetch_assoc($result)){
                    
                    echo"['".$row['id']."',".$row['qnty']."],";
                    
                    }



          ?>
          
        ]);

        var options = {
          title : 'Stock available per product',
          colors:['#de6262'],
          vAxis: {title: 'Stock Quantity'},
          hAxis: {title: 'Product ID'},
          seriesType: 'bars',
          series: {5: {type: 'line'}}        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div2'));
        chart.draw(data, options);
      }
    </script>

    <div id="chart_div2" style="margin: 150px auto; width: 1000px; height: 500px;"></div>

    <script type="text/javascript">
    function Confirmation(){
    var x=confirm("Are you sure?")
    if(x==true){
        return true;
    }else{
        return false;
    }
}
</script>


    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Product ID ', 'Profit '],




          <?php

            $query="SELECT * FROM `order` ORDER BY `product_id` ASC";
            $result=mysqli_query($con,$query);
            while($rows=mysqli_fetch_assoc($result))
                    {

                      $id=$rows["product_id"];
                      $name=$rows["product_name"];

            
                      $query2="SELECT `buy_price` FROM `product` where id='".$id."'";
                      $result2=mysqli_query($con,$query2);
                      while($row=mysqli_fetch_assoc($result2)){
                      $tmp=number_format($rows["product_qnty"] * $row["buy_price"]);
                    }
                  

                    $profit=number_format(($rows["product_qnty"] * $rows["product_price"])-$tmp);
                    echo"['".$id."',".$profit."],";
                           
                  }
          ?>

        ]);

        var options = {
          title: 'Profit per product (ID)',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
    <div id="curve_chart" style="margin: 150px auto; width: 1000px; height: 500px;"></div>










</body>
</html>

