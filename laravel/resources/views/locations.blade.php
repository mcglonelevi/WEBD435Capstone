@extends('layouts.app')

@section('content')

<div class="container">
	<br>
	<div class="grid">
		<div class="col-sm-5">
		<h1>201 S Grant Ave, Columbus, OH</h1>
		<h1>614-123-4567</h1>
			<br>
			<p>
				<b>Hours:</b>
			</p>
			<div class="grid">
				<table class="table table-striped col-sm-11">
					<tr>
						<td>Monday-Thursday:</td>
						<td>9am-10pm</td>
					</tr>
					<tr>
						<td>Friday &amp; Saturday:</td>
						<td>9am-11pm</td>
					</tr>
					<tr>
						<td>Sunday:</td>
						<td>10am-9pm</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="col-sm-1"></div>
		<div class="col-sm-6">
			<div id="map"></div>
		</div>
	</div>
</div>
<script>
  function initMap() {
    var franklin = {lat: 39.959488, lng: -82.990637};
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 14,
      center: franklin
    });
    var marker = new google.maps.Marker({
      position: franklin,
      map: map
    });
  }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-DdjUx6R9NElmaK8ReVx1KBeFsHKOqMY&callback=initMap"></script>

@endsection

<!-- API KEY GOOGLE MAPS:  AIzaSyD-DdjUx6R9NElmaK8ReVx1KBeFsHKOqMY  -->