<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\DataUpload;
use App\Http\Requests\StoreDataUploadRequest;
use App\Http\Requests\UpdateDataUploadRequest;
use App\Services\Data\DataUploadCreatorService;
use App\Services\Data\DataUploadUpdatorService;
use Illuminate\Http\Request;

class DataUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = DataUpload::get();
        return view('admin.data.index', ['datas' => $datas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.data.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDataUploadRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDataUploadRequest $request)
    {
        DataUploadCreatorService::create($request);

        return redirect()->route('data.list')->withMessage('New data uploaded.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataUpload  $dataUpload
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data = DataUpload::findOrFail($request->id);

        return json_encode($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DataUpload  $dataUpload
     * @return \Illuminate\Http\Response
     */
    public function edit(DataUpload $dataUpload)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDataUploadRequest  $request
     * @param  \App\Models\DataUpload  $dataUpload
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDataUploadRequest $request)
    {
        DataUploadUpdatorService::update($request, $request->id);

        return redirect()->route('data.list')->withMessage('Data updated.');
    }


    public function uploadNewFile(UpdateDataUploadRequest $request)
    {
        DataUploadUpdatorService::uploadNewFile($request, $request->id);

        return redirect()->route('data.list')->withMessage('Data updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataUpload  $dataUpload
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataUpload $dataUpload)
    {
        //
    }
}
