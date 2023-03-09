<?php


namespace App\Services\Data;
use App\Http\Requests\StoreDataUploadRequest;
use App\Http\Requests\UpdateDataUploadRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Services\History\HistoryCreatorService;

use App\Models\DataUpload;
use App\Models\UserHistory;

class DataUploadCreatorService
{
    public static function create(StoreDataUploadRequest $request) {
        // dd(self::dataLink($request));
        DataUpload::create(
            [
                'user_id' => Auth::user()->id,
                'filename' => $request->filename,
                'database_name' => $request->database_name,
                'data_color' => $request->data_color,
                'link_uploaded_file' => self::dataLink($request)
            ]
        );
        HistoryCreatorService::create('Uploaded new data '.$request->filename);
    }

    public static function dataLink(StoreDataUploadRequest $request) {
        $file = $request->file('file_to_upload');
        $file_name = preg_replace('/[^A-Za-z0-9\-]/', '', strtolower( $request->filename )) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('shapefile_zip/'), $file_name);
        $link = 'shapefile_zip/'.$file_name;

        return $link;
    }
}
