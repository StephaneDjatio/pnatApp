<?php


namespace App\Services\Data;
use App\Http\Requests\UpdateDataUploadRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Services\History\HistoryCreatorService;

use App\Models\DataUpload;

class DataUploadUpdatorService
{
    public static function update(UpdateDataUploadRequest $request) {
        // dd(self::dataLink($request));
        DataUpload::where('id', $request->id)->update(
            [
                'filename' => $request->filename,
                'database_name' => $request->database_name,
                'data_color' => $request->data_color,
            ]
        );
        HistoryCreatorService::create('Data updated '.$request->filename);
    }


    public static function uploadNewFile(UpdateDataUploadRequest $request) {
        // dd(self::dataLink($request));
        DataUpload::where('id', $request->id)->update(
            [
                'link_uploaded_file' => self::fileToUploadLink($request)
            ]
        );
        HistoryCreatorService::create('Data updated '.$request->filename);
    }

    public static function fileToUploadLink(StoreDataUploadRequest $request) {
        $data = DataUpload::findOrFail($request->id);
        $image_path = app_path($data->link_uploaded_file);
        unlink($image_path);
        $file = $request->file('file_to_upload');
        $file_name = preg_replace('/[^A-Za-z0-9\-]/', '', strtolower( $request->filename )) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('shapefile_zip/'), $file_name);
        $link = 'shapefile_zip/'.$file_name;

        return $link;
    }
}
