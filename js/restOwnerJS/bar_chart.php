<script type="text/javascript">
		google.charts.load('current', {
			'packages': ['corechart']
		});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart() {
			var data = google.visualization.arrayToDataTable([
				['Date', 'Profit (RM)', 'No. of orders'],

				<?php

				$queryWeekday = "SELECT DISTINCT OrderDate, month(OrderDate), day(OrderDate) FROM orderlist WHERE OrderDate BETWEEN DATE_SUB( CURDATE( ), INTERVAL 7 DAY ) AND CURDATE( ) order by OrderDate asc";
				$resultweekDay = mysqli_query($con, $queryWeekday) or die(mysqli_error($con));

				
				if (mysqli_num_rows($resultweekDay) > 0) {
					while ($row = mysqli_fetch_array($resultweekDay)) {
						$day = $row['OrderDate'];

						$sumTotal = 0;
						$totalSumTotal = 0;
						$queryCountOrderDay = "SELECT * from orderlist where OrderDate = '$day'";
						$resultCountOrderDay = mysqli_query($con, $queryCountOrderDay) or die(mysqli_error($con));
						$countOrderListDay = mysqli_num_rows($resultCountOrderDay);

						$date = "$day";
						$dateFullName = date('l', strtotime($date));
						$dateMonth = $row['month(OrderDate)'];
						$dateDay = $row['day(OrderDate)'];

						while ($row = mysqli_fetch_array($resultCountOrderDay)) {
							$sumTotal = $sumTotal + $row['amountPaid'];
							$totalSumTotal = $totalSumTotal + ($row['amountPaid']);
						}

				?>

						["<?php echo $dateFullName ?> <?php echo $dateDay . '/' . $dateMonth ?> ", <?php echo $totalSumTotal ?>, <?php echo $countOrderListDay ?>], <?php }
																																} ?>
			]);

			var view = new google.visualization.DataView(data);
			view.setColumns([0, 1, {
				calc: 'stringify',
				sourceColumn: 1,
				type: 'string',
				role: 'annotation'
			}, 2, {
				calc: 'stringify',
				sourceColumn: 2,
				type: 'string',
				role: 'annotation'
			}, ]);


			var options = {
				curveType: 'function',
				legend: {
					position: 'bottom'
				},
				pointSize: 5,
				crosshair: {
					trigger: 'both',
					color: 'red'
				},
				vAxis: {
					/*viewWindow:{
					    max:100,
					    min:0
					  },*/
					minValue: 0
				},
				//colors: ['#8bb4dd', '#44739b'],
				maxwidth: 550,
				height: 220,
				chartArea: {
					top: 20,
					bottom: 50,
					right: 50,
					left: 40
				},
			};

			var chart = new google.visualization.LineChart(document.getElementById('linechart_profitday'));

			chart.draw(view, options);
		}
	</script>