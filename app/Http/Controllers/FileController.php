<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Document;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $barcode = echo 'DNS1D::getBarcodeSVG('4445645656', 'PHARMA2T',3,33)';
        return view('admin.files.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $file = new File;
        $file->file_number = $request->file_number;
        $file->client_name = $request->client_name;
        $file->place_of_allocation = $request->place_of_allocation;
        $file->plot_number = $request->plot_number;
        $file->category = $request->category;
        $file->created_at = now();
        $file->updated_at = now();
        $file->save();
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
   // public function show(string $id)
   public function show($id)
{
    $file = File::findOrFail($id);
    $documents = Document::where('file_id', $file->id)->get();
    return view('admin.files.show')->with(["file"=>$file, "documents" => $documents ]);
}
   
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    $file = File::findOrFail($id);
    return view('admin.files.edit', compact('file'));
}
   // public function edit(string $id)
    //{
      //  $file = File::find($id);
      //  return view("admin.forms.edit")->with('file',$file);
    // }

    /**
     * Update the specified resource in storage.
     */
   // public function update(Request $request, string $id)
    public function update(Request $request, $id)
{
    $file = File::findOrFail($id);
    $file->update($request->all());
    return redirect()->route('admin.dashboard')->with('success', 'File updated successfully.');
}
    
    /**
     * Remove the specified resource from storage.
     */
    //public function destroy(string $id)
    public function destroy($id)
        {
            $file = File::findOrFail($id);
            $file->delete();
            return redirect()->route('admin.dashboard')->with('success', 'File deleted successfully.');
        }

    public function uploadDocument(Request $request){
        // Store the file
        $file = $request->file('attachment');
        $filename = $file->getClientOriginalName();
        $file->storeAs('uploads', $filename); // Adjust storage path as needed

        // Save file information to the database
        $document = new Document();
        $document->file_id = $request->file_id;
        $document->document_name = $request->document_name;
        $fileName = $document->document_name . '.' . pathinfo($document->attachment, PATHINFO_EXTENSION);
        $document->attachment =  $filename; // Adjust file path as needed
        $document->save();

        return redirect()->back()->with('success', 'File uploaded successfully.');
    }

    public function download($id){
        $document = Document::findOrFail($id);
        $filePath = storage_path('app/uploads/' . $document->attachment);
        $fileName = $document->document_name . '.' . pathinfo($document->attachment, PATHINFO_EXTENSION);
        return response()->download($filePath, $fileName);
    }
  
}
