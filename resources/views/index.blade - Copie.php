@extends('layouts.app')

@section('content')
    <div id="sidebar" class="sidebar  bg-success bg-gradient">
        <!-- Zone de validation des couches -->
        <div id="liste_couches">
            <h4 class="text-center">Analyse par couches</h4>
            <p class="text-center text-danger">( Sélectionnez les couches avant d'appliquer l'analyse )</p>
            <div class="px-3" id="recherche_couches">
                <div class="mb-3">
                    <label for="province_list" class="form-label">Province <span id="check_province" class="text-danger text-center"></span></label>
                    <select id="province_list" class="form-control selectpicker form-control-sm" multiple
                    data-container="body" data-live-search="true" title="Choisir province" data-hide-disabled="true"
                    data-actions-box="true" data-virtual-scroll="false">
                        <!-- <option value="">Choisir une province</option> -->
                        <option value="estuaire">Estuaire</option>
                        <option value="moyen ogooue">Moyen Ogooue</option>
                        <option value="haut ogooue">Haut Ogooue</option>
                        <option value="ogooue maritime">Ogooue Maritime</option>
                        <option value="ogooue ivindo">Ogooue Ivindo</option>
                        <option value="ogooue lolo">Ogooue Lolo</option>
                        <option value="nyanga">Nyanga</option>
                        <option value="ngounie">Ngounie</option>
                        <option value="woleu ntem">Woleu Ntem</option>
                    </select>
                </div>
                <!-- <div class="mb-3">
                    <label for="dept_list" class="form-label">Département</label>
                    <select id="dept_list" class="form-select">
                        <option>Choisir un département</option>
                    </select>
                </div> -->
            </div>

            <div class="accordion p-1" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Conservation
                    </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body pl-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="parc_marins">
                                <label class="form-check-label" for="parc_marins">
                                    Parcs Marins
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="parc_terrestre">
                                <label class="form-check-label" for="parc_terrestre">
                                    Parcs Terrestres
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="serie_conser">
                                <label class="form-check-label" for="serie_conser">
                                    Séries de conservation
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="sites_biologiques">
                                <label class="form-check-label" for="sites_biologiques">
                                    Sites interêt biologique
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="reserves_prov">
                                <label class="form-check-label" for="reserves_prov">
                                    Reserves provisoires
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Forêt
                    </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="permis_forestiers">
                                <label class="form-check-label" for="permis_forestiers">
                                    Permis Forestier
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="forets_commu">
                                <label class="form-check-label" for="forets_commu">
                                    Forêts communautaires
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="plantations_forestieres">
                                <label class="form-check-label" for="plantations_forestieres">
                                    Plantations Forestières
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Mine
                    </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="permis_miniers_rech">
                                <label class="form-check-label" for="permis_miniers_rech">
                                    Permis Miniers de Recherche
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="permis_miniers_expl">
                                <label class="form-check-label" for="permis_miniers_expl">
                                    Permis Miniers d'Exploitation
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        Agriculture
                    </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="concessions_agricoles">
                                <label class="form-check-label" for="concessions_agricoles">
                                    Concessions agricoles
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFive">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        Hydrocarbure
                    </button>
                    </h2>
                    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="permis_petroliers">
                                <label class="form-check-label" for="permis_petroliers">
                                    Permis pétroliers
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="float-end mt-3 btn-group btn-group">
                <button type="button" class="btn btn-primary" title="Couches" id="rechercher"><span class="fa-solid fa-check"></span> Lancer l'analyse</button>
                <button type="button" class="btn btn-primary" title="Couches" id="draw_polygon"><span class="fa-solid fa-draw-polygon"></span> Selectionner la zone </button>
                <button type="button" class="btn btn-secondary" title="Couches" onclick="closeNav()"><span class="fa-solid fa-times"></span> Fermer</button>
            </div>
        </div>

        <!-- Resultat des analyses effectuées -->
        <div id="resultat_analyse">
            <div id="analyst_content">
                <h4 class="text-center mt-2 mb-2"><u>Statistiques d'analyse</u></h4>
                <h5 class="mt-2 text-center">Zone: <span id="zone_selection"></span></h5>
                <table class="table table-bordered text-center text-white" width="100%">
                    <thead>
                        <th width="50%">Eléments</th>
                        <th width="20%">Nombre</th>
                        <th width="30%">Superficie en ha</th>
                    </thead>
                    <tbody id="table_body"></tbody>
                    <tbody id="table_body_intersection">
                        <tr>
                            <td colspan="3" class="text-center text-white bg-primary">Intersections</td>
                        </tr>
                    </tbody>
                </table>
                <button type="button" class="btn btn-primary float-end" title="Couches" id="print-analysis"><span class="fa-solid fa-print"></span> Imprimer</button>
            </div>

        </div>

    </div>

    <div id="mapzone" style="margin-left: -11px;  margin-right: -10px;">
        <div class="col-md-12 pt-2 ps-0 ms-0">
            <div id="mapid" style="border: 2px solid #DCDCDC; height: 95vh; z-index: 1;"></div>
            {{-- <div class="pull-right"><h5 style="color:#e60b0b; font-size:10px">Date de dernière mise à jour : 20-01-2022</h5></div> --}}
            <div id="toggle-chartDiv-btn">
                <button type="button" class="btn btn-warning" onclick="togglePieChartDiv(1)"><i class="fa fa-caret-right"></i></button>
            </div>
            <div class="overlay" id="pieChartDiv">
                <div>
                    <button type="button" class="btn btn-warning" onclick="togglePieChartDiv(2)"><i class="fa fa-caret-left"></i></button>
                </div>
                <div id="chartdiv"></div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        function reloadPage() {
            location.reload(true);
        }

        function openNav() {
            document.getElementById("sidebar").style.width = "400px";
            document.getElementById("mapzone").style.marginLeft = "400px";
            document.getElementById('liste_couches').style.display = 'block'
            document.getElementById('resultat_analyse').style.display = 'none'
            document.getElementById('rechercher').style.display = 'block'
            document.getElementById('draw_polygon').style.display = 'none'
            document.getElementById('recherche_couches').style.display = 'block'
        }

        function closeNav() {
            document.getElementById("sidebar").style.width = "0";
            document.getElementById("mapzone").style.marginLeft= "0";
        }

        function openNavPolygone() {
            document.getElementById("sidebar").style.width = "400px";
            document.getElementById("mapzone").style.marginLeft = "400px";
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


    </script>

    <script>
         var mbAttr = 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            mbUrl = 'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';

            var grayscale   = L.tileLayer(mbUrl, {id: 'mapbox/light-v9', tileSize: 512, maxZoom: 20, minZoom: 7, zoomOffset: -1, attribution: mbAttr}),
            streets  = L.tileLayer(mbUrl, {id: 'mapbox/streets-v11', tileSize: 512, maxZoom: 40, minZoom: 7, zoomOffset: -1, attribution: mbAttr});
            googleSat = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',{
                maxZoom: 15,
                minZoom: 7,
                subdomains:['mt0','mt1','mt2','mt3']
            });
            googleLayer = L.tileLayer('http://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}',{
                maxZoom: 20,
                minZoom: 7,
                subdomains:['mt0','mt1','mt2','mt3']
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
    </script>

    <script>

        $.ajax({
            url: '{{ url("/getMenu") }}',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log(data)
            }
        })

        function load_layers(database_table, layer_name, layer_geojson) {
            $.ajax({
                url: '{{ url("/getData") }}',
                type: 'GET',
                dataType: 'json',
                data: {table: database_table},
                success: function(data) {
                    console.log(data)
                    layers = JSON.parse(data[0].geom)
                    layer_geojson.addData(layers);
                    mymap.fitBounds(layer_geojson.getBounds());
                    // // map.setZoom(13);
                    mymap.addLayer(layer_geojson);


                }
            })
        }

        function layerPopUp($table, layer_properties) {

        }


        function results_analysis(url_value, option_value, ifgeom) {
            var parcs_marins = document.getElementById('parc_marins')
            var parcs_terrestres = document.getElementById('parc_terrestre')
            var serie_conser = document.getElementById('serie_conser')
            var permis_forestiers = document.getElementById('permis_forestiers')
            var plantations_forestieres = document.getElementById('plantations_forestieres')
            var permis_miniers_rech = document.getElementById('permis_miniers_rech')
            var permis_miniers_expl = document.getElementById('permis_miniers_expl')
            var sites_biologiques = document.getElementById('sites_biologiques')
            var reserves_prov = document.getElementById('reserves_prov')
            var concessions_agricoles = document.getElementById('concessions_agricoles')
            var forets_commu = document.getElementById('forets_commu')
            var permis_petroliers = document.getElementById('permis_petroliers')
            document.querySelector('#rechercher').disabled = true;
            var table_array = []
            var layers_colors_array = []
            var chart_legend_label = []
            if (parc_marins.checked) {
                var table_name = 'map_view_parc_marins';
                table_array.push(table_name)
                chart_legend_label.push('Parcs marins')
                layers_colors_array.push("#0000FF")
            }

            if(parcs_terrestres.checked) {
                var table_name = 'map_view_parc_terrestres';
                table_array.push(table_name)
                layers_colors_array.push("#8B008B")
                chart_legend_label.push('Parcs terrestres')
            }

            if(permis_forestiers.checked) {
                var table_name = 'map_view_permis_forestiers';
                table_array.push(table_name)
                layers_colors_array.push("#006400")
                chart_legend_label.push('Permis forestiers')
            }

            if(serie_conser.checked) {
                var table_name = 'map_view_serie_de_conservation';
                table_array.push(table_name)
                layers_colors_array.push("#FF8C00")
                chart_legend_label.push('Série de conservation')
            }

            if(plantations_forestieres.checked) {
                var table_name = 'map_view_plantation_forestieres';
                table_array.push(table_name)
                layers_colors_array.push("#FFFF00")
                chart_legend_label.push('Plantations forestières')
            }

            if(permis_miniers_rech.checked) {
                var table_name = 'map_view_permis_minier_de_recherche';
                table_array.push(table_name)
                layers_colors_array.push("#C71585")
                chart_legend_label.push('Permis Miniers de Recherche')
            }

            if(permis_miniers_expl.checked) {
                var table_name = 'map_view_permis_minier_dexploitation';
                table_array.push(table_name)
                layers_colors_array.push("#F08080")
                chart_legend_label.push('Permis Miniers d\'Exploitation')
            }

            if(sites_biologiques.checked) {
                var table_name = 'map_view_site_interet_biologique';
                table_array.push(table_name)
                layers_colors_array.push("#808000")
                chart_legend_label.push('Sites interêt biologique')
            }

            if(reserves_prov.checked) {
                var table_name = 'map_view_reserve_provisoire';
                table_array.push(table_name)
                layers_colors_array.push("#BC8F8F")
                chart_legend_label.push('Reserves provisoires')
            }

            if(concessions_agricoles.checked) {
                var table_name = 'map_view_concessions_agricoles';
                table_array.push(table_name)
                layers_colors_array.push("#A0522D")
                chart_legend_label.push('Concessions agricoles')
            }

            if(forets_commu.checked) {
                var table_name = 'map_view_forets_communautaires';
                table_array.push(table_name)
                layers_colors_array.push("#00FF7F")
                chart_legend_label.push('Forêts Communautaires')
            }

            if(permis_petroliers.checked) {
                var table_name = 'map_view_permis_petroliers';
                table_array.push(table_name)
                layers_colors_array.push("#6A5ACD")
                chart_legend_label.push('Permis Pétroliers')
            }

            // console.log(table_array)

            var list_intersections = {
                'map_view_parc_marins & map_view_parc_terrestres' : 'Parcs Marins et Terrestres',
                'map_view_parc_marins & map_view_permis_forestiers' : 'Parcs Marins et permis Forestiers',
                'map_view_parc_marins & map_view_permis_minier_de_recherche' : 'Parcs Marins et Mine Recherche',
                'map_view_parc_marins & map_view_permis_minier_dexploitation' : 'Parcs Marins et Mine Exploitation',
                'map_view_parc_marins & map_view_plantation_forestieres' : 'Parcs Marins et Plantations Forestieres',
                'map_view_parc_marins & map_view_serie_de_conservation' : 'Parcs Marins et Serie conservation',
                'map_view_parc_terrestres & map_view_permis_forestiers' : 'Parcs Terrestres et permis Forestiers',
                'map_view_parc_terrestres & map_view_permis_minier_de_recherche' : 'Parcs Terrestres et Mine Recherche',
                'map_view_parc_terrestres & map_view_permis_minier_dexploitation' : 'Parcs Terrestres et Mine Exploitation',
                'map_view_parc_terrestres & map_view_plantation_forestieres' : 'Parcs Terrestres et Plantations forestieres',
                'map_view_parc_terrestres & map_view_serie_de_conservation' : 'Parcs Terrestres et Serie conservation',
                'map_view_permis_forestiers & map_view_permis_minier_de_recherche' : 'Permis Forestiers et Mine Recherche',
                'map_view_permis_forestiers & map_view_permis_minier_dexploitation' : 'Permis Forestiers et Mine Exploitation',
                'map_view_permis_forestiers & map_view_plantation_forestieres' : 'Permis Forestiers et Plantations Forestieres',
                'map_view_permis_forestiers & map_view_serie_de_conservation' : 'Permis Forestiers et Serie conservation',
                'map_view_permis_minier_de_recherche & map_view_permis_minier_dexploitation' : 'Mine Recherche et Mine Exploitation',
                'map_view_plantation_forestieres & map_view_permis_minier_de_recherche' : 'Plantations Forestieres et Mine Recherche',
                'map_view_plantation_forestieres & map_view_permis_minier_dexploitation' : 'Plantations Forestieres et Mine Exploitation',
                'map_view_serie_de_conservation & map_view_permis_minier_de_recherche' : 'Serie conservation et Mine Recherche',
                'map_view_serie_de_conservation & map_view_permis_minier_dexploitation' : 'Serie conservation et Mine Exploitation',
                'map_view_serie_de_conservation & map_view_plantation_forestieres' : 'Serie conservation et Plantations Forestieres'
            }

            var my_url = '{{ url(":url_value") }}'
            my_url = my_url.replace(':url_value', url_value)

            $.ajax({
                url: my_url,
                type: 'GET',
                dataType: 'json',
                data: {tables: table_array, option_value:option_value},
                success: function(data) {
                    // console.log(data)
                    var chart_data = []
                    var area_value = 0.0
                    var intersect_data = []
                    var chart_legend_label_interct = []
                    var map_legend_array = []
                    $.each(data, function(key, value) {
                        if (table_array.indexOf(key) === -1) {
                            // console.log('✅ value is not in array');
                            intersect_data.push(key);
                            chart_legend_label_interct.push(list_intersections[key]);
                            layers_colors_array.push('#FF0000');
                        }
                    })

                    $.each(table_array, function(key, value) {
                        // console.log(data[value][0])
                        var map_legend_content = {}
                        if (data[value][0].area != null) {
                            map_legend_content['color'] = layers_colors_array[key]
                            map_legend_content['label'] = chart_legend_label[key]
                            map_legend_array.push(map_legend_content)
                            layers = JSON.parse(data[value][0].geom)
                            area_value = parseFloat(data[value][0].area).toFixed(2)
                            // console.log(layers)
                            var layer_geojson = L.geoJson(layers, {
                                style: function(f){
                                    return { color: layers_colors_array[key], weight: 1, fillColor: layers_colors_array[key], fillOpacity: .5  };
                                },
                                onEachFeature: function (f, l) {
                                    const out = [];
                                    // console.log(f.properties)
                                    if (f.properties) {
                                        l.bindPopup(f.properties.province);
                                    }

                                }
                            })
                            // mymap.fitBounds(layer_geojson.getBounds());
                            layer_geojson.addTo(mymap)
                        }


                        chart_data.push({
                            "category": chart_legend_label[key],
                            "area": data[value][0].area,
                            "chart_color": layers_colors_array[key]
                        })

                        var table_content = "<tr>"+
                                                "<td>"+chart_legend_label[key]+"</td>"+
                                                "<td>"+parseInt(data[value][0].total_items)+"</td>"+
                                                "<td>"+area_value+"</td>"+
                                            "</tr>";

                        document.getElementById('table_body').innerHTML += table_content;
                    })

                    $.each(intersect_data, function(key, value) {
                        if (data[value][0].area != null) {
                            layers = JSON.parse(data[value][0].geom)
                            area_value = parseFloat(data[value][0].area).toFixed(2)
                            // console.log(layers)
                            var layer_geojson = L.geoJson(layers, {
                                // filter: function(feature) {
                                //     if(feature.type != "GeometryCollection"){
                                //         return true;
                                //     }

                                // },
                                style: function(f){
                                    return { color: '#FF0000', weight: 1, fillColor: '#FF0000', fillOpacity: .5  };
                                },
                                onEachFeature: function (f, l) {
                                    const out = [];
                                    // console.log(f.properties)
                                    if (f.properties) {
                                        l.bindPopup(f.properties.province);
                                    }

                                }
                            })
                            // mymap.fitBounds(layer_geojson.getBounds());
                            layer_geojson.addTo(mymap)
                        } else {
                            area_value = 0.0
                        }


                        chart_data.push({
                            "category": chart_legend_label_interct[key],
                            "area": data[value][0].area,
                            "chart_color": '#FF0000'
                        })

                        var table_content = "<tr>"+
                                                "<td>"+chart_legend_label_interct[key]+"</td>"+
                                                "<td>"+parseInt(data[value][0].total_items)+"</td>"+
                                                "<td>"+area_value+"</td>"+
                                            "</tr>";

                        document.getElementById('table_body_intersection').innerHTML += table_content;
                    })

                    if (ifgeom) {
                        document.getElementById('zone_selection').innerHTML = polygon._getMeasurementString();
                    } else {
                        document.getElementById('zone_selection').innerHTML = option_value;
                    }

                    var map_legend_intersection_content = {}

                    map_legend_intersection_content['color'] = '#FF0000'
                    map_legend_intersection_content['label'] = 'Intersections'
                    map_legend_array.push(map_legend_intersection_content)

                    createLegend(map_legend_array)

                    // Create root element
                    // https://www.amcharts.com/docs/v5/getting-started/#Root_element
                    var root = am5.Root.new("chartdiv");


                    // Set themes
                    // https://www.amcharts.com/docs/v5/concepts/themes/
                    root.setThemes([
                        am5themes_Animated.new(root)
                    ]);


                    // Create chart
                    // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
                    var chart = root.container.children.push(am5percent.PieChart.new(root, {
                        layout: root.horizontalLayout
                    }));


                    // Create series
                    // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
                    var series = chart.series.push(am5percent.PieSeries.new(root, {
                        name: 'Series',
                        valueField: "area",
                        categoryField: "category",
                        alignLabels: false,
                    }));

                    // Set up adapters for variable slice radius
                    // https://www.amcharts.com/docs/v5/concepts/settings/adapters/
                    series.slices.template.adapters.add("fill", function (fill, target) {
                        var dataItem = target.dataItem;

                        if (dataItem) {
                            // console.log(dataItem.dataContext.chart_color)
                            var chart_color = dataItem.dataContext.chart_color;
                            return chart_color;
                        }
                        return fill;
                    });


                    // Set data
                    // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
                    series.data.setAll(chart_data);



                    // Create legend
                    // https://www.amcharts.com/docs/v5/charts/percent-charts/legend-percent-series/
                    var legend = chart.children.push(am5.Legend.new(root, {
                        centerY: am5.percent(50),
                        y: am5.percent(50),
                        radius: am5.percent(60),
                        layout: root.verticalLayout
                    }));

                    legend.data.setAll(series.dataItems);

                    series.labels.template.set("forceHidden", true);
                    series.ticks.template.set("forceHidden", true);

                    legend.labels.template.setAll({
                        stroke: am5.color("#ffffff"),
                        strokeWidth: 2,
                        fill: am5.color("#ffffff")
                    });

                    legend.valueLabels.template.setAll({
                        fontSize: 16,
                        fontWeight: "400",
                        stroke: am5.color("#ffffff"),
                        strokeWidth: 2,
                        fill: am5.color("#ffffff")
                    });

                    // series.labels.template.setAll({
                    //     maxWidth: 150, // to truncate labels, use "truncate"
                    //     inside: true,
                    //     labelsEnabled: false
                    // });


                    // Play initial series animation
                    // https://www.amcharts.com/docs/v5/concepts/animations/#Animation_of_series
                    series.appear(1000, 100);

                    document.getElementById('liste_couches').style.display = 'none'
                    document.getElementById('resultat_analyse').style.display = 'block'

                }
            })

            var layer_btn = document.getElementById('layer_btn');
            var shape_btn = document.getElementById('shape_btn');
            layer_btn.setAttribute("disabled", "disabled");
            shape_btn.setAttribute("disabled", "disabled");
        }

        function createLegend(map_legend_array) {
            /*Legend specific*/
            var legend = L.control({ position: "bottomright" });
            legend.onAdd = function(mymap) {
                var div = L.DomUtil.create("div", "legend");
                div.innerHTML += "<h4>Légende</h4>";
                // console.log(map_legend_array)
                $.each(map_legend_array, function(key, value) {
                    // console.log(key)
                    div.innerHTML += '<i style="background: '+value.color+'"></i><span>'+value.label+'</span><br>';
                })

                return div;
            };
            legend.addTo(mymap);
        }


        $(document).on('click', '#rechercher', function() {
            var province = document.getElementById('province_list').options
            // console.log(province)

            var selected = [];
            for (var option of province) {
                if (option.selected) {
                    selected.push(option.value);
                }
            }
            // console.log(selected)

            if (selected.length != 0) {
                results_analysis('getDatas', selected, false);
                document.getElementById('pieChartDiv').style.display = 'block'
            } else {
                var province = document.getElementById('check_province').innerHTML = '( Choix de province obligatoire )'
            }


        })

        var polygon = new L.Draw.Polygon(mymap, {
            showArea: true,
            allowIntersection: false,
            shapeOptions: {
                color: '#D2691E',
                fillOpacity: .2,
                // weight: 2,
            },
            drawError: {
                color: '#e1e100', // Color the shape will turn when intersects
                fillOpacity: .5,
                message: '<strong>Attention<strong>' // Message that will show when intersect
            },
        });

        mymap.on('draw:created', function (e) {
            var type = e.layerType,
                layer = e.layer;

            // var content = getPopupContent(layer);
            var shape = layer.toGeoJSON()
            var shape_for_db = JSON.stringify(shape.geometry);

            console.log(shape_for_db)

            // Do whatever you want with the layer.
            // e.type will be the type of layer that has been draw (polyline, marker, polygon, rectangle, circle)
            // E.g. add it to the map

            results_analysis('getPolygonData', shape_for_db, true);
            document.getElementById('pieChartDiv').style.display = 'block'

            layer.addTo(mymap);
        });

        $('#draw_polygon').click(function() {
            var stopclick = false;
            polygon.enable();

            // function measurestart(){
            //     if (stopclick == false){
            //         stopclick = true;
            //         console.log("begin")
            //         $("b[class=selected_value]").html(polygon._getMeasurementString());
            //     };
            // };
            // function measurestop(){
            //     //reset button
            //     $("b[class=selected_value]").html(polygon._getMeasurementString());
            //     //remove listeners
            //     mymap.off("click", measurestart);
            //     mymap.off("draw:drawstop", measurestop);
            //     console.log("End")
            //     // polygon.addTo(mymap)
            // };

            // mymap.on("click", measurestart);
            // mymap.on("draw:drawstop", measurestop);
        });


    </script>
@endsection
