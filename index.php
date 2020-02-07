<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Weather</title>
		<script rel="" src="https://kit.fontawesome.com/0beaaae9e3.js" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="assets/css/style.css">
	</head>
	<body>
		<!-- Page Content Goes Here -->
		<section class="container weather text-center">
			<div class="row justify-content-center">
			<?php
			function dump($content){
				echo "<pre>";
				print_r($content);
				echo "</pre>";
			}
			
			$data = file_get_contents('https://api.openweathermap.org/data/2.5/forecast?id=593116&units=metric&APPID=d9443486c1295255ac720b15d777bef9');
			$data = json_decode($data);
			// dump($data);

			//get current weather
			$current = $data->list[0];
			// dump($current);
			?>
				<div class="town-div bgDark row align-items-center col-12 col-md-6 col-lg-3">
					<div class="col-12 col-sm-4">
						<?php
							//get location name
							$location = $data->city;
							$city_name = $location->name;
							// dump($city_name);
						?>
						<div class="town"><?php echo $city_name; ?></div>
						<div>WEATHER</div>
					</div>
					<?php
						//get current weather description and icon
						$current_desc = $current->weather[0];
						//get current weather icon
						$current_icon = $current_desc->icon;
						//get current weather description
						$current_description = $current_desc->main;
					?>
					<div class="col-6 col-sm-4"><img class="weather-icon-now" src="http://openweathermap.org/img/wn/<?php echo $current_icon; ?>@2x.png" alt="weather"></div>
					<div class="col-6 col-sm-4">
						<?php 
							//get current weather temperature
							$current_temp_main = $current->main;
							$current_temp = $current_temp_main->temp;
							// dump($current_temp); 
						?>
						<div class="temp-now"><?php echo $current_temp; ?>&#8451;</div>
						<div class="weather-description"><?php echo $current_description; ?></div>
					</div>
				</div>
				<div class="week-days justify-content-center row col-12 col-md-6 col-lg-8">

				<?php
					$list=$data->list;
					// dump($list);
					for($i=0; $i<sizeof($list); $i += 8){
						// change unix timestamp (dt) to weekday name
						$days = array('0', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday','Sunday'); 
						$date = $list[$i]->dt;
						// dump($date);
						$weekdayNum = date('N', $date);
						// dump($weekdayNum);
						$dayName = $days[$weekdayNum];
						// dump($dayName);

						// //get min temperatute
						$dayWeather=$list[$i]->main;
						$dayTempMin=$dayWeather->temp_min;
				
						// //get max temperatute
						$dayTempMax=$dayWeather->temp_max;
				
						// //get weather icon
						$weekWeatherArr=$list[$i]->weather;
						$weekIcon=$weekWeatherArr[0]->icon;
						// dump($weekIcon);
					?>
						<div class="one-day row col-12 col-sm bgLight">
							<div class="day-name col-3 col-sm-12"><?php echo $dayName; ?></div>
							<div class="col-3 col-sm-12"><img class="weather-icon" src="http://openweathermap.org/img/wn/<?php echo $weekIcon; ?>@2x.png" alt="weather"></div>
							<div class="row weather-temperature row col-6 col-sm-12">
								<div class="max-temp col-6 col-sm-12 col-lg-6"><?php echo $dayTempMax; ?>&#8451;</div>
								<div class="min-temp col-6 col-sm-12 col-lg-6"><?php echo $dayTempMin; ?>&#8451;</div>
							</div>
						</div>
					<?php
					}
				?>
				</div>
			</div>
		</section>


		
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	</body>
</html>