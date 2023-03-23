import "leaflet";

document.addEventListener("DOMContentLoaded", () => {
  initMap();
  handleCoords();
});

const handleCoords = () => {
  fetch("/admin/maps/load")
    .then((response) => response.json())
    .then((response) => alert(JSON.stringify(response)))
    .catch((error) => alert("Erreur : " + error));
};

const initMap = () => {
  let map = L.map("map").setView([51.505, -0.09], 13);

  L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
    maxZoom: 19,
    attribution:
      '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
  }).addTo(map);

  let circle = L.circle([51.508, -0.11], {
    color: "red",
    fillColor: "#f03",
    fillOpacity: 0.5,
    radius: 500,
  }).addTo(map);
};
