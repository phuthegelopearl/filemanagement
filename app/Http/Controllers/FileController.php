<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Document;
use App\Models\User;
use \OwenIt\Auditing\Models\Audit;

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
        File::create($request->all());
        return redirect()->route('home')->with('success', 'File created successfully.');
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

    public function assignUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'file_id' => 'required|exists:files,id',
        ]);

        $file = File::find($request->file_id);
        $file->user_id = $request->user_id;
        $file->save();


       return response()->json([
            'message' => 'User assigned to file successfully',
            'file' => $file
        ]);
    }


    public function showAudits()
    {
        $audits = Audit::where('auditable_type', 'App\Models\File')->with([
            'user',
        ])->get();
        return view('admin.audit', ['audits' => $audits]);
    }

    public function files()
    {
        $files = File::whereDoesntHave('user', 
            function ($query) {
                $query->where('id', auth()->id());
            })->get();
        return view('user.files', compact('files'));
    }

    public function changeStatus(Request $request)
    {
        $request->validate([
            'status' => 'required|in:in_use,not_in_use',
            'file_id' => 'required|exists:files,id',
        ]);

        $file = File::find($request->file_id);
        $file->status = $request->status;
        $file->save();

        return response()->json([
            'message' => 'File status updated successfully',
            'file' => $file
        ]);
    }

  
}
