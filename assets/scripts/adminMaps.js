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
    console.log(data);
    data.forEach(({ latitude, longitude }) => {
      let circle = L.circle([latitude, longitude], {
        color: "red",
        fillColor: "#f03",
        fillOpacity: 0.5,
        radius: 500,
      }).addTo(map);
    });
  } catch (error) {
    console.error("Erreur :", error);
  }
};

const initMap = () => {
  map = L.map("map").setView([47.993905448635, 2.0694358597768], 10);

  L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
    maxZoom: 19,
    attribution:
      '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
  }).addTo(map);
};