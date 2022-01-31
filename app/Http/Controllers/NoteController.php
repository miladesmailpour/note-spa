<?php

namespace App\Http\Controllers;

use App\Http\Resources\NoteResource;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\NoteCollection;


class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        // return new NoteCollection(Note::all());

        return response()->json(new NoteCollection(Note::latest()->paginate(20)), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return NoteResource
     */
    public function store(Request $request)
    {
        $note = Note::create($request->only([
            'title',
            'note',
            'user_id'
        ]));
        return new NoteResource($note);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return NoteResource
     */
    public function show(Note $note)
    {
        return new NoteResource($note);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Note  $note
     * @return NoteResource
     */
    public function update(Request $request, Note $note)
    {
        $note->update($request->only([
            'title',
            'note',
            'updated_at'
        ]));
        return new NoteResource($note);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        $note->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
