import "leaflet";

let map;

document.addEventListener("DOMContentLoaded", () => {
  initMap();
  pointeMap();
});

const handleData = async () => {
  try {
    const response = await fetch("/admin/maps/load");
    const data = await response.json();
    return data;
  } catch (error) {
    console.error("Erreur :", error);
    throw error;
  }
};

const pointeMap = async () => {
  try {
    const data = await handleData();
    data.forEach(({ latitude, longitude, radius }) => {
      let circle = L.circle([latitude, longitude], {
        color: "red",
        fillColor: "#f03",
        fillOpacity: 0.5,
        radius: radius * 100,
      }).addTo(map);
    });
  } catch (error) {
    console.error("Erreur :", error);
  }
};

const initMap = () => {
  map = L.map("map").setView([46.227638, 2.213749], 6);

  L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
    maxZoom: 19,
    attribution:
      '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
  }).addTo(map);
};