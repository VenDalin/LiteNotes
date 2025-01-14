<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TrashedNoteController extends Controller
{
    public function index()
    {
        $notes =  Note::whereBelongsTo(Auth::user())->onlyTrashed()->latest('updated_at')->paginate(5);
        return view('notes.index')->with('notes', $notes);
    }

    public function show(Note $note)
    {
        if(!$note->user->is(Auth::user())) {
            return abort(403);
        }
        return view('notes.show')->with('note', $note);
    }

    public function update(Request $request, Note $note)
    {
        // Ensure you have the necessary checks and authorization here
        if (!$note->user->is(Auth::user())) {
            return abort(403);
        }

        if ($note->image_path && Storage::exists('public/images/' . $note->image_path)) {
            // Retrieve the image file if it exists
            Storage::url('public/images/' . $note->image_path);

            // If you need to do something with the image, you can handle it here
            // For example, you might want to store it again or process it in some way
        }
        // Restore the note and its associated image file if it exists
        $note->restore();

        return redirect()->route('trashed.index')->with('success', 'Note restored successfully.');
    }

    public function destroy(Note $note)
    {
        // Ensure you have the necessary checks and authorization here
        if (!$note->user->is(Auth::user())) {
            return abort(403);
        }

        // Delete the associated image file if it exists
        if ($note->image_path) {
            Storage::delete('public/images/' . $note->image_path);
        }

        $note->forceDelete();

        return redirect()->route('trashed.index')->with('success', 'Note deleted permanently.');
    }
}
