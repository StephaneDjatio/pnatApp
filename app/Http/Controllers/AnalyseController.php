<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class AnalyseController extends Controller
{
    //Get all menus and sub menus
    public function getMenu(Request $request) {

        $results = [];
        $query = "SELECT load_data_domain.id AS id, load_data_domain.domain_name AS domain_name
        FROM load_data_domain";

        $domains = DB::select($query);

        $query1 = "SELECT load_data_shapefilezip.filename AS shape_name, load_data_shapefilezip.id AS shape_id,
        load_data_shapefilezip.domain_id AS domain_id
        FROM load_data_shapefilezip";

        $shapefiles = DB::select($query1);

        $results['domains'] = $domains;
        $results['shapefiles'] = $shapefiles;
        return $results;
    }

    public function analyze_data(Request $request) {
        $array_shapefile_id = $request->array_shapefile_id;
        $new_array_shapefile_id = implode(',', $array_shapefile_id);
        // dd($array_shapefile_id);
        $complete_result = [];
        $query = "SELECT json_build_object('type', 'FeatureCollection', 'features',
        json_agg(
            json_build_object(
                'type'      , 'Feature',
                'geometry'  , ST_AsGeoJSON(load_data_multipolygonfeatures.geo)::json,
                'properties', json_build_object(
                    'metadata', load_data_multipolygonfeatures.metadata,
                    'color', load_data_shapefilezip.shape_color,
                    'data_name', load_data_shapefilezip.filename,
                    'shapefile_id', load_data_shapefilezip.id
                )))) AS geom
        FROM load_data_multipolygonfeatures, load_data_shapefilezip
        WHERE shapefile_id IN ($new_array_shapefile_id)
        AND load_data_shapefilezip.id = shapefile_id";
        $results = DB::select($query);

        $query1 = "SELECT load_data_shapefilezip.id, load_data_shapefilezip.filename, load_data_shapefilezip.shape_color
        FROM load_data_shapefilezip
        WHERE load_data_shapefilezip.id IN ($new_array_shapefile_id)";
        $results1 = DB::select($query1);

        $complete_result[0] = $results;
        $complete_result[1] = $results1;

        $arrshape = [];
        $sub_array_shapefile_id = $array_shapefile_id;
        if (count($array_shapefile_id) >= 2) {

            $last_element_id = count($array_shapefile_id) - 1;
            foreach ($array_shapefile_id as $key => $value) {

                $sub_array_shapefile_id = Arr::except($sub_array_shapefile_id, $key);

                if (count($sub_array_shapefile_id) > 1) {

                    $sub_array_shapefile_id_list = implode(',', $sub_array_shapefile_id);

                    $intersect_query = "SELECT json_build_object('type', 'FeatureCollection', 'features', json_agg(ST_AsGeoJSON(clipped.geom)::json)) AS geom
                    FROM (
                        SELECT (ST_Dump(ST_Intersection(ST_MakeValid(A.geo), ST_MakeValid(B.geo)))).geom AS geom
                        FROM public.load_data_multipolygonfeatures AS A, public.load_data_multipolygonfeatures AS B
                        WHERE A.shapefile_id = $value
                        AND B.shapefile_id IN ($sub_array_shapefile_id_list)
                        AND ST_Intersects(A.geo, B.geo)
                    ) AS clipped
                    WHERE ST_Dimension(clipped.geom) = 2";

                } elseif(count($sub_array_shapefile_id) == 1) {
                    $intersect_query = "SELECT json_build_object('type', 'FeatureCollection', 'features', json_agg(ST_AsGeoJSON(clipped.geom)::json)) AS geom
                    FROM (
                        SELECT (ST_Dump(ST_Intersection(ST_MakeValid(A.geo), ST_MakeValid(B.geo)))).geom AS geom
                        FROM public.load_data_multipolygonfeatures AS A, public.load_data_multipolygonfeatures AS B
                        WHERE A.shapefile_id = $value
                        AND B.shapefile_id = $sub_array_shapefile_id[$last_element_id]
                        AND ST_Intersects(A.geo, B.geo)
                    ) AS clipped
                    WHERE ST_Dimension(clipped.geom) = 2";
                }
                $intersect_results = DB::select($intersect_query);
                $complete_result[$value] = $intersect_results;
                array_push($arrshape, $value);
            }

            $complete_result['listshape'] = $arrshape;
        }



        return $complete_result;

    }

    public function getData(Request $request) {
        $table_name = $request->table;
        $type = "Feature";
        // $query = "SELECT ST_AsGeoJSON($table_name.geom) as geom
        // FROM $table_name";

        // $query = "SELECT json_build_object('type', 'FeatureCollection', 'features', json_agg(json_build_object('type', 'Feature', 'features', ST_AsGeoJSON(public.$table_name.*)::json))) AS geom
        // FROM $table_name";

        $query = "SELECT json_build_object('type', 'FeatureCollection', 'features', json_agg(ST_AsGeoJSON(public.$table_name.*)::json)) AS geom
        FROM $table_name";

        // $query = "SELECT row_to_json(fc) AS geom
        // FROM ( SELECT 'FeatureCollection' As type, array_to_json(array_agg(f)) As features
        // FROM (SELECT 'Feature' As type
        //    , ST_AsGeoJSON(lg.geom)::json As geometry
        //   FROM $table_name As lg   ) As f )  As fc";
        $parcs = DB::select($query);
        // dd($parcs);
        return $parcs;
    }

    public function getDatas(Request $request) {
        $tables = $request->tables;
        $province = $request->option_value;
        // dd($province);
        $nb_tables = count($tables);
        // dd(count($tables));
        // $province = implode(',', $province);
        $province = implode("','",$province);
        // dd($province);
        $data = [];
        $sub_tables = $tables;
        foreach ($tables as $key => $table) {
            $query = "SELECT json_build_object('type', 'FeatureCollection', 'features', json_agg(ST_AsGeoJSON(public.$table.*)::json)) AS geom,
            SUM(ST_Area(public.$table.geom, true)/10000) AS area, COUNT(public.$table.id) AS total_items
            FROM $table
            WHERE LOWER($table.province) IN ('".$province."')";

            $query_execute = DB::select($query);
            $data[$table] = $query_execute;

            $sub_tables = array_except($sub_tables,array($key));
            // dd($sub_table);

            foreach ($sub_tables as $sub_table) {

                $query1 = "SELECT json_build_object('type', 'FeatureCollection', 'features', json_agg(ST_AsGeoJSON(clipped.geom)::json)) AS geom,
                SUM(ST_Area(clipped.geom, true)/10000) AS area, COUNT(clipped.id) AS total_items
                FROM (
                    SELECT a.id, a.province,
                        (ST_Dump(ST_Intersection(ST_MakeValid(a.geom), ST_MakeValid(b.geom)))).geom AS geom
                    FROM public.$table AS a INNER JOIN public.$sub_table AS b
                    ON ST_Intersects(a.geom, b.geom)
                ) AS clipped
                WHERE LOWER(clipped.province) IN ('".$province."')
                AND ST_Dimension(clipped.geom) = 2";

                $query_execute1 = DB::select($query1);
                $data[$table.' & '.$sub_table] = $query_execute1;
            }


        }
        // dd($data);

        return json_encode($data);
    }

    public function getPolygonData(Request $request) {
        $tables = $request->tables;
        $geometry = $request->option_value;
        $nb_tables = count($tables);
        // dd(count($tables));
        $tables_together = implode(", ", $tables);
        // dd($tables);
        $data = [];
        $sub_tables = $tables;
        foreach ($tables as $key => $table) {
            $query = "SELECT json_build_object('type', 'FeatureCollection', 'features',
            json_agg(ST_AsGeoJSON(ST_Intersection(ST_GeomFromGeoJSON('$geometry'), ST_MakeValid(public.$table.geom)))::json)) AS geom,
            SUM(ST_Area(public.$table.geom, true)/10000) AS area, COUNT(public.$table.id) AS total_items
            FROM $table
            WHERE ST_Intersects(ST_GeomFromGeoJSON('$geometry'),  public.$table.geom)";

            $query_execute = DB::select($query);
            $data[$table] = $query_execute;

            $sub_tables = array_except($sub_tables,array($key));
            // dd($sub_table);

            foreach ($sub_tables as $sub_table) {
                // $query1 = "SELECT json_build_object('type', 'FeatureCollection', 'features',
                // json_agg(ST_AsGeoJSON(ST_Intersection(ST_GeomFromGeoJSON('$geometry'), ST_Intersection(ST_MakeValid(public.$table.geom), ST_MakeValid(public.$sub_table.geom))))::json)) AS geom,
                // SUM(ST_Area(ST_Intersection(ST_GeomFromGeoJSON('$geometry'), ST_Intersection(ST_MakeValid(public.$table.geom), ST_MakeValid(public.$sub_table.geom))), true)/10000) AS area,
                // COUNT(public.$table.id) AS total_items
                // FROM $table, $sub_table
                // WHERE ST_Intersects(ST_GeomFromGeoJSON('$geometry'),  public.$table.geom)
                // AND ST_Intersects(public.$table.geom,  public.$sub_table.geom)";

                $query1 = "SELECT json_build_object('type', 'FeatureCollection', 'features', json_agg(ST_AsGeoJSON(clipped.geom)::json)) AS geom,
                SUM(ST_Area(clipped.geom, true)/10000) AS area, COUNT(clipped.id) AS total_items
                FROM (
                    SELECT a.id, a.province,
                        (ST_Dump(ST_Intersection(ST_GeomFromGeoJSON('$geometry'), ST_Intersection(ST_MakeValid(a.geom), ST_MakeValid(b.geom))))).geom AS geom
                    FROM public.$table AS a INNER JOIN public.$sub_table AS b
                    ON ST_Intersects(a.geom, b.geom)
                ) AS clipped
                WHERE ST_Dimension(clipped.geom) = 2";

                $query_execute1 = DB::select($query1);
                $data[$table.' & '.$sub_table] = $query_execute1;
            }


        }

        return json_encode($data);
    }

}
