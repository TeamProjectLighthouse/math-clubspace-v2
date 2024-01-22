function updateDate() {
  const d = new Date();
  const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
  const weekdays = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
  
  document.getElementById("date").innerHTML = `${d.getDate()} ${months[d.getMonth()]}, ${weekdays[d.getDay()]}`;
  console.log(d.getDay());
}

function updateTime() {
  const d = new Date();
  let h = d.getHours();
  let m = d.getMinutes();

  if (m < 10) {
    m = '0'+m;
  }
  if (h >= 12) {
    h = h - 12;
    document.getElementById("time").innerHTML = `${h}:${m} PM`; 
  } else {
    document.getElementById("time").innerHTML = `${h}:${m} AM`;
  }
}

function updateWeather() {
  const apiUrl = 'https://data.weather.gov.hk/weatherAPI/opendata/weather.php?dataType=flw&lang=en';
  var weather = "";

  fetch(apiUrl)
  .then(response => {
    if  (!response.ok) {
      throw new Error('Network response was not ok');
    }
    return response.json();
  })
  .then(data => {
    weather = data.forecastDesc;
    analyseWeather(weather);
  })
  .catch(error => {
    console.error('Error: ', error);
  })
}

function analyseWeather(forecast) {
  forecast = forecast.toLowerCase();
  const imgElement = document.querySelector(".today-img-box");
  const weather = forecast.includes("fine") ? "fine" :
                  forecast.includes("sunny") ? "sunny" :
                  forecast.includes("rainy") ? "rainy" :
                  forecast.includes("cloudy") ? "cloudy" :
                  forecast.includes("dry") ? "dry" :
                  forecast.includes("windy") ? "windy" :
                  "";
  imgElement.innerHTML = `
    <img class='today-img' src='../images/weather/${weather}.png'>
  ` 
}

updateDate();
updateTime();
updateWeather();
setInterval(updateDate, 7200000);
setInterval(updateTime, 10000);
setInterval(updateWeather, 3600000);