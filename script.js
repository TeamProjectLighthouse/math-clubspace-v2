function updateDate() {
  const d = new Date();
  const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
  const weekdays = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];
  
  document.getElementById("date").innerHTML = `${d.getDate()} ${months[d.getMonth()]}, ${weekdays[d.getDay()]}`;
}

function updateTime() {
  const d = new Date();

  if (d.getHours >= 12) {
    document.getElementById("time").innerHTML = `${d.getHours() - 12}:${d.getMinutes()} PM`; 
  }
  else {
    document.getElementById("time").innerHTML = `${d.getHours()}:${d.getMinutes()} AM`;
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
                  "";
  imgElement.innerHTML = `
    <img class='today-img' src='../images/weather/${weather}.png'>
  ` 
}

updateDate();
updateTime();
updateWeather();
setInterval(updateDate, 64800000);
setInterval(updateTime, 10000);
setInterval(updateWeather, 3600000);