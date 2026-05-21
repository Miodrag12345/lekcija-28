<?php

namespace App\Http\Controllers;

use App\Models\ShipmentDocuments;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\NewShipmentRequest;
use App\Models\Shipments;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ShipmentController extends Controller
{

    use ImageUploadTrait;


    public function index()


    {



        Cache::forget('unassigned_shipments');
        $shipments = Cache::remember('unassigned_shipments', 600,
            fn() => Shipments::where(['status' => Shipments::STATUS_UNASSIGNED])->get());

        return view('shipments.index', [
            'shipments' => $shipments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('canViewCreationPage', Shipment::class);

        return view('shipments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NewShipmentRequest $request)
    {

        Gate::authorize('create', Shipment::class);

        $data = $request->validated();

        $shipment=Shipments::create($request->validated());

        $fileTypes = [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        ];

        if ($request->hasFile('documents')) {
            $paths = [];

            foreach ($request->file('documents') as $document) {
                if (str_starts_with($document->getMimeType(), 'image/')) {
                    $name=$this->uploadImage($document, "/documents/$shipment->id");
                    $name=$document->id."/".$name;
                    ShipmentDocuments::create([
                       'shipment_id'=>$shipment->id,
                        'document_name'=>$name
                    ]);
                    $path = $document->store('images', 'public');
                    $paths[] = $path;

                } elseif (in_array($document->getMimeType(), $fileTypes)) {
                    $extension=$document->getClientOriginalExtension();
                    $fileName=uniqid().".".$extension;
                    $path = $document->storeAs("documents/{$shipment->id}",$fileName,'public');

                    $path=str_replace("documents/", "",$path);

                    ShipmentDocument::create([
                        'shipment_id' => $shipment->id,
                         'document_name'=>$path
                    ]);
                    $paths[] = $path;

                } else {
                    return back()->withErrors([
                        'documents' => 'Nije dozvoljeni tip fajla!'
                    ]);
                }
            }

            $data['documents'] = json_encode($paths);
        }



        return redirect()->route('shipments.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Shipments $shipment)
    {
        return view('shipments.show', compact('shipment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shipments $shipments)
    {
        Gate::authorize('view', $shipments);
        return view('shipments.edit',compact('shipments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shipments $shipments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shipments $shipments)
    {
        //
    }
}
