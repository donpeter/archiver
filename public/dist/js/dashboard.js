/*SimpleWeather Init*/

"use strict";

$(document).ready(function() {  
  getWeather(); //Get the initial weather.
  getCurrentTime(); //Get the initial weather.
  getWeatherForcast();
  setInterval(getWeatherForcast, 10000); //Update time after every sec.
  // Format The Date 
  var dates = $('.dateTable');
  dates.each(function(index,item){
      item.innerText = moment(item.innerText).format('DD-MM-YYYY');
  })
  $('#documents').DataTable({
  		paging: false,
  		searching: false,
  		pageLength: false
  });
  $('#folders').DataTable({
  		paging: false,
  		searching: false,
  		pageLength: false
  });
});

/*Current Time Cal*/
var getCurrentTime = function(){
	var nowDate = moment().format('L');
	var nowDay = moment().format('dddd');
	$('.nowday').html(nowDay);
	$('.nowdate').html(nowDate);
};

/*Get Current Weather*/
var getWeather = function() {
   if( $('#weather_2').length > 0 ){
    
		/*Without Forcast*/
		$.simpleWeather({
		location: 'Güzelyurt',
		woeid: '',
		unit: 'c',
		success: function(weather) {
			var $this = $('#weather_2');
			var html='<span class="block temprature ">'+weather.temp+'<span class="unit">&deg;'+weather.units.temp+'</span></span>';
			$this.find('.left-block').html(html);
			//alert(this.id);
			html='<span class="block temprature-icon "><img src="dist/img/weathericons/'+weather.code+'.svg"/></span><h6>'+'Güzelyurt'+'</h6>';
			
			$this.find('.right-block').html(html);
		},
		error: function(error) {
			console.log(error);
		}
	  });
   }
   
    if( $('#weather_3').length > 0 ){
    
		/*Without Forcast*/
		$.simpleWeather({
		location: 'Lefkoşa',
		woeid: '',
		unit: 'c',
		success: function(weather) {
			var $this = $('#weather_3');
			var html='<span class="block temprature">'+weather.temp+'<span class="unit">&deg;'+weather.units.temp+'</span></span>';
			$this.find('.left-block').html(html);
			//alert(this.id);
			html='<span class="block temprature-icon"><img src="dist/img/weathericons/'+weather.code+'.svg"/></span><h6>'+'Lefkoşa'+'</h6>';
			
			$this.find('.right-block').html(html);
		},
		error: function(error) {
			console.log(error);
		}
	  });
   }
   
    if( $('#weather_4').length > 0 ){
    
		/*Without Forcast*/
		$.simpleWeather({
		location: 'Girne',
		woeid: '',
		unit: 'c',
		success: function(weather) {
			var $this = $('#weather_4');
			var html='<span class="block temprature">'+weather.temp+'<span class="unit">&deg;'+weather.units.temp+'</span></span>';
			$this.find('.left-block').html(html);
			//alert(this.id);
			html='<span class="block temprature-icon"><img src="dist/img/weathericons/'+weather.code+'.svg"/></span><h6>'+'Girne'+'</h6>';
			
			$this.find('.right-block').html(html);
		},
		error: function(error) {
			console.log(error);
		}
	  });
   }
   
    if( $('#weather_5').length > 0 ){
    
		/*Without Forcast*/
		$.simpleWeather({
		location: 'Magusa',
		woeid: '',
		unit: 'c',
		success: function(weather) {
			var $this = $('#weather_5');
			var html='<span class="block temprature">'+weather.temp+'<span class="unit">&deg;'+weather.units.temp+'</span></span>';
			$this.find('.left-block').html(html);
			//alert(this.id);
			html='<span class="block temprature-icon"><img src="dist/img/weathericons/'+weather.code+'.svg"/></span><h6>'+'Magusa'+'</h6>';
			
			$this.find('.right-block').html(html);
		},
		error: function(error) {
			console.log(error);
		}
	  });
   }
   
};	

var getWeatherForcast = function(location) {
	if( $('#weather_1').length > 0 ){ 
		location = location || 'Lefke'
		/*With Forcast*/
		$.simpleWeather({
		location: location,
		woeid: '',
		unit: 'c',
		success: function(weather) {
			var $this = $('#weather_1');
			var htmlCity =location+'('+weather.city+')';
			$this.find('.panel-heading button > span').html(htmlCity);
			var html='<span class="block temprature pull-left">'+weather.temp+'<span class="unit">&deg;'+weather.units.temp+'</span></span><span class="block temprature-icon pull-left"><img src="dist/img/weathericons/'+weather.code+'.svg"/></span><div class="clearfix"></div><span class="block currently">'+weather.currently+'</span><ul class="other-details"><li><span class="spec-label">wind</span> <span class="wind-speed">'+weather.wind.speed+''+weather.units.speed+'</span><span class="spec-label">humidity</span><span class="humidity">'+weather.humidity+'%</span></li><li><span class="spec-label">sunrise</span><span class="sunrise">'+weather.sunrise+'</span><span class="spec-label">high</span><span class="hightem">'+weather.high+'&deg;'+weather.units.temp+'</span></li></ul>';
			
			html += '<ul class="forcast-days">';
			
			/*Add below snippet if forcast required*/
			for(var i=1;i<weather.forecast.length -2 ;i++) {
				html += '<li><span class="forcast-day block">'+weather.forecast[i].day+'</span><img class="block" src="dist/img/weathericons/'+weather.code+'.svg"/><span class="forcast-high-deg block">'+weather.forecast[i].high+'&deg;C</span></li>';
			}
			html += '</ul>';
			$this.find(".weather").html(html);
		},
		error: function(error) {
			$this.find(".weather").html('<p>'+error+'</p>');
		}
	  });
	}
}

