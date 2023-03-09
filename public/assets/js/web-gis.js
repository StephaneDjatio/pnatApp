function analyze_gis_data() {
    var arr = [];
    $('input.checked_shp:checkbox:checked').each(function() {
        arr.push(parseInt($(this).val()));
    });
    // console.log(arr);

    var province = document.getElementById('province_list').options

    var selected = [];
    for (var option of province) {
        if (option.selected) {
            selected.push(option.value);
        }
    }

    var options = {
        container_width: "230px",
        group_minHeight: "100px",
        //container_maxHeight : "350px",
        exclusive: true,
        collapsed: false
    };

    var overlayers = {}

    var control1;

    var div = L.DomUtil.create("div", "legend");
    div.innerHTML += "<h4>Legende</h4>";
    $.ajax({
        url: base_path + "analyze_data",
        type: 'GET',
        data: { array_shapefile_id: arr },
        dataType: 'json',
        async: false,
        success: function(data) {
            console.log(data);
            var layers = JSON.parse(data[0][0].geom)
            var layer_geojson = L.geoJson();
            var layer_intersection_geojson = L.geoJson();
            var intersectionLayerGroup = L.featureGroup();
            $.each(data[1], function(key, value) {
                layer_geojson = L.geoJson(layers, {
                    style: function(f) {
                        return { color: f.properties.color, weight: 3, fillColor: f.properties.color, fillOpacity: .5 };
                    },
                    filter: function(feature) {
                        if (feature.properties.shapefile_id === value.id) return true
                    },
                    onEachFeature: function(f, l) {
                        var output = '';
                        if (f.properties) {
                            output += `<b class="data_name"><u>${f.properties.data_name}</u> </b></br></br>`;
                            $.each(f.properties.metadata, function(key, value) {
                                output += `<b class="popup-text"><u>${key}</u>: </b><i class="popup-text">${value}</i></br>`;
                            })
                            l.bindPopup(output);
                        }


                    }
                })
                layer_geojson.addData(layers);
                mymap.fitBounds(layer_geojson.getBounds());
                mymap.addLayer(layer_geojson);
                overlayers[value.filename] = layer_geojson;
                div.innerHTML += `<i style="background: ${value.shape_color}"></i><span>${value.filename}</span><br>`;
            })

            $.each(data['listshape'], function(key, value) {
                var layers_intersection = JSON.parse(data[value][0].geom)
                layer_intersection_geojson = L.geoJson(layers_intersection, {
                    style: function(f) {
                        return { color: '#FF0000', weight: 3, fillColor: '#FF0000', fillOpacity: .5 };
                    },
                })

                layer_intersection_geojson.addData(layers_intersection);
                intersectionLayerGroup.addLayer(layer_intersection_geojson)
            })

            mymap.addLayer(intersectionLayerGroup);
            overlayers['Intersections'] = intersectionLayerGroup;
            div.innerHTML += `<i style="background: #FF0000"></i><span>Intersections</span><br>`;

            control1 = L.control.layers(null, overlayers, options)

            mymap.addControl(control1);



        }
    })

    /*Legend specific*/
    var legend = L.control({ position: "bottomleft" });

    legend.onAdd = function(map) {
        return div;
    };

    legend.addTo(mymap);
}
