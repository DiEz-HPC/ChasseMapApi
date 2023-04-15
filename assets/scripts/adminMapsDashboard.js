import 'leaflet';
let map;
let huntersGroup = L.featureGroup();
let obstaclesGroup = L.featureGroup();
let radiusGroup = L.featureGroup();
let CustomCircleMarker = L.Marker.extend({
    options: {
        radius: 'Custom data!',
    },
});
document.addEventListener('DOMContentLoaded', () => {
    initMap();
    getHunter();
    getObstacle();
    toggleMarker();
    handleMarkerClick();
});

const initMap = () => {
    map = L.map('map').setView([46.227638, 2.213749], 5);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution:
            '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
    }).addTo(map);
};

const toggleMarker = () => {
    const buttons = [
        document.querySelector('#btn_hunter'),
        document.querySelector('#btn_obstacle'),
    ];
    buttons.forEach((button) => {
        button.addEventListener('click', () => {
            if (button.classList.contains('hided')) {
                showGroup(eval(button.dataset.group));
                button.classList.remove('hided');
                button.querySelector('i').classList.remove('fa-eye');
                button.querySelector('i').classList.add('fa-eye-slash');
            } else {
                hideGroup(eval(button.dataset.group));
                button.classList.add('hided');
                button.querySelector('i').classList.remove('fa-eye-slash');
                button.querySelector('i').classList.add('fa-eye');
                
            }
        });
    });
};

const getHunter = async () => {
    try {
        const response = await fetch('/admin/maps/load');
        const data = await response.json();
        data.forEach(({ latitude, longitude, radius, type }) => {
            let marker = new CustomCircleMarker([latitude, longitude], {
                radius: radius,
            })
                .bindPopup(type + ' - ' + radius + 'km')
                .addTo(huntersGroup);
        });
    } catch (error) {
        console.error('Erreur :', error);
        throw error;
    }
};

const getObstacle = async () => {
    try {
        const response = await fetch('/admin/obstacles/load');
        const data = await response.json();
        data.forEach(({ latitude, longitude, type }) => {
            let marker = L.marker([latitude, longitude])
                .bindPopup(type)
                .addTo(obstaclesGroup);
        });
    } catch (error) {
        console.error('Erreur :', error);
        throw error;
    }
}
const handleMarkerClick = (e) => {
    map.on('popupopen', (e) => {
        let lat = e.popup._latlng.lat;
        let lng = e.popup._latlng.lng;
        if(e.popup._source.options.radius == undefined) return;
        let radius = e.popup._source.options.radius;
        showRadius(lat, lng, radius);
    });
    map.on('popupclose', (e) => {
        hideGroup(radiusGroup);
    });
};
const showRadius = (latitude, longitude, radius) => {
    if (map.hasLayer(radiusGroup)) {
        map.removeLayer(radiusGroup);
    }
    radiusGroup = L.featureGroup();

    let circle = L.circle([latitude, longitude], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.5,
        radius: radius * 1000,
    }).addTo(radiusGroup);
    showGroup(radiusGroup);
};

const showGroup = (group) => {
    if (!map.hasLayer(group)) {
        map.addLayer(group);
    }
};
const hideGroup = (group) => {
    if (map.hasLayer(group)) {
        map.removeLayer(group);
    }
};
