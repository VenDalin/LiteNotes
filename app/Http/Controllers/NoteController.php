<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laravel\Prompts\Note as PromptsNote;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $notes = Note::where('user_id', Auth::id())->latest('updated_at')->paginate(5);
        //    $notes =  Auth::user()->notes->latest('updated_at')->paginate(5);
        $notes =  Note::whereBelongsTo(Auth::user())->latest('updated_at')->paginate(5);
        return view('notes.index')->with('notes', $notes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('notes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validate the request
    $request->validate([
        'title' => 'required|max:120',
        'text' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Handle file upload if an image is provided
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $fileName = Str::uuid() . '.' . $image->getClientOriginalExtension();
        $path = $image->storeAs('public/images', $fileName);

        $note = Note::create([
            'uuid' => Str::uuid(),
            'user_id' => Auth::id(),
            'title' => $request->title,
            'text' => $request->text,
            'image_path' => $fileName,
        ]);
    } else {
        $note = Note::create([
            'uuid' => Str::uuid(),
            'user_id' => Auth::id(),
            'title' => $request->title,
            'text' => $request->text,
        ]);
    }

    return redirect()->route('notes.index');
}

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        // $note = Note::where('uuid', $uuid)
        //     ->where('user_id', Auth::id())
        //     ->firstOrFail();
        if (!$note->user->is(Auth::user())) {
            return abort(403);
        }

        return view('notes.show')->with('note', $note);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        if (!$note->user->is(Auth::user())) {
            return abort(403);
        }

        return view('notes.edit')->with('note', $note);
    }

    /**
     * Update the specified resource in storage.
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        // Check if the user is authorized to update this note
        if (!$note->user->is(Auth::user())) {
            return abort(403);
        }

        // Validate the request data
        $request->validate([
            'title' => 'required|max:120',
            'text' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust image validation rules as needed
        ]);

        // Handle file upload if a new image is provided
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($note->image_path) {
                Storage::delete('public/images/' . $note->image_path);
            }

            // Store the uploaded image file
            $image = $request->file('image');
            $fileName = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/images', $fileName); // Adjust storage path as needed

            // Update the note with the new image filename
            $note->update([
                'title' => $request->title,
                'text' => $request->text,
                'image_path' => $fileName, // Store the file name or path in 'image_path' column in notes table
            ]);
        } else {
            // Update the note without changing the image
            $note->update([
                'title' => $request->title,
                'text' => $request->text,
            ]);
        }

        // Redirect to the note details page with a success message
        return redirect()->route('notes.show', $note)->with('success', 'Note Updated Successfully.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        if (!$note->user->is(Auth::user())) {
            return abort(403);
        }

        // Delete the associated image file if it exists
        if ($note->image_path) {
            Storage::delete('public/images/' . $note->image_path);
        }

        $note->delete();
        return redirect()->route('notes.index')->with('success', "Note moved to Trash.");
    }
}
