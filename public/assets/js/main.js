function reloadPage() {
    location.reload(true);
}

function openNav() {
    document.getElementById("sidebar").style.width = "300px";
    document.getElementById("mapzone").style.marginLeft = "300px";
    document.getElementById('liste_couches').style.display = 'block'
    document.getElementById('resultat_analyse').style.display = 'none'
    document.getElementById('rechercher').style.display = 'block'
    document.getElementById('draw_polygon').style.display = 'none'
    document.getElementById('recherche_couches').style.display = 'block'
}

function closeNav() {
    document.getElementById("sidebar").style.width = "0";
    document.getElementById("mapzone").style.marginLeft = "0";
}

function openNavPolygone() {
    document.getElementById("sidebar").style.width = "300px";
    document.getElementById("mapzone").style.marginLeft = "300px";
    document.getElementById('liste_couches').style.display = 'block'
    document.getElementById('resultat_analyse').style.display = 'none'
    document.getElementById('draw_polygon').style.display = 'block'
    document.getElementById('rechercher').style.display = 'none'
    document.getElementById('recherche_couches').style.display = 'none'
}

function togglePieChartDiv(id) {
    if (id == 1) {
        document.getElementById('pieChartDiv').style.display = 'block'
        document.getElementById('toggle-chartDiv-btn').style.display = 'none'
    } else {
        document.getElementById('pieChartDiv').style.display = 'none'
        document.getElementById('toggle-chartDiv-btn').style.display = 'block'
    }
}

// Get all domains with shapefiles
$.ajax({
    url: base_path + "getMenu",
    type: 'GET',
    dataType: 'json',
    success: function(data) {
        // console.log(data);
        var content = '';
        $.each(data.domains, function(key, value) {
            var filtered = data.shapefiles.filter(function(item) {
                return item.domain_id == value.id;
            });

            content += `<div class="accordion-item">
                <h2 class="accordion-header" id="heading${value.id}">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse${value.id}" aria-expanded="true" aria-controls="collapse${value.id}">
                    ${value.domain_name}
                </button>
                </h2>
                <div id="collapse${value.id}" class="accordion-collapse collapse" aria-labelledby="heading${value.id}" data-bs-parent="#accordionExample">
                    <div class="accordion-body pl-2">`
            $.each(filtered, function(key, value) {
                content += `<div class="form-check">
                                <input class="form-check-input checked_shp" type="checkbox" value="${value.shape_id}" id="${value.shape_id}">
                                <label class="form-check-label" for="${value.shape_id}">
                                    ${value.shape_name}
                                </label>
                            </div>`
            });
            content += `</div>
                </div>
            </div>`;
        })
        document.getElementById('accordionExample').innerHTML = content;
    }
})


// Define Leaflet Map and BaseMaps
var mbAttr = 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
    '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
    'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    mbUrl = 'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';

var grayscale = L.tileLayer(mbUrl, { id: 'mapbox/light-v9', tileSize: 512, maxZoom: 20, minZoom: 7, zoomOffset: -1, attribution: mbAttr }),
    streets = L.tileLayer(mbUrl, { id: 'mapbox/streets-v11', tileSize: 512, maxZoom: 40, minZoom: 7, zoomOffset: -1, attribution: mbAttr });
googleSat = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
    maxZoom: 15,
    minZoom: 7,
    subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
});
googleLayer = L.tileLayer('http://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}', {
    maxZoom: 20,
    minZoom: 7,
    subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
});

var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '© OpenStreetMap'
});

var mymap = L.map('mapid', {
    center: [-0.826779, 11.773469],
    zoomDelta: 0.25,
    zoomSnap: 0.25,
    zoom: 7,
    // dragging: false,
    // scrollWheelZoom: false,
    // zoomControl: false ,
    layers: [streets]
});
mymap.options.minZoom = 7;
mymap.options.maxZoom = 25;

var baseMaps = {
    "OpenStreetMap": osm,
    "Mapbox Streets": streets,
    "Satellite": googleSat,
};
var layerControl = L.control.layers(baseMaps).addTo(mymap);
var browserControl = L.control.browserPrint().addTo(mymap);