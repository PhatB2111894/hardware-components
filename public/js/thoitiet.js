const weather = {
    apiKey: "01cd7c7799f377a3b6838394ddac1728",
    fetchWeather: (city) => {
      fetch(
        `https://api.openweathermap.org/data/2.5/weather?q=${city}&lang=vi&units=metric&appid=${this.apiKey}`
      )
        .then((response) => {
          if (!response.ok) throw new Error("Không có địa điểm");
          return response.json();
        })
        .then((data) => this.displayWeather(data));
    },
    displayWeather: (data) => {
      const { name } = data;
      const { icon, description } = data.weather[0];
      const { temp, humidity } = data.main;
      const { speed } = data.wind;
      const { country } = data.sys;
  
      document.querySelector(".city").textContent = `${name} , ${country}`;
      document.querySelector(".may").src = `https://openweathermap.org/img/wn/${icon}.png`;
      document.querySelector(".description").textContent = description;
      document.querySelector(".temp").textContent = `${temp}°C`;
      document.querySelector(".humidity").textContent = `Độ ẩm: ${humidity}%`;
      document.querySelector(".wind").textContent = `Độ gió: ${speed} km/h`;
    },
    search: () => this.fetchWeather(document.querySelector(".search-bar").value),
  };
  
  document.querySelector(".searchtiet button").addEventListener("click", weather.search);
  
  document.querySelector(".search-bar").addEventListener("keyup", (event) => {
    if (event.key === "Enter") weather.search();
  });
  
  weather.fetchWeather("Trà Vinh");

  