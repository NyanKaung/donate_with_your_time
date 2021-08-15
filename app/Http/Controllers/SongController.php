<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SongController extends Controller
{
    /**
     *  GET api/songs
     *  to get all songs with pagination and sorting
     */
    public function index()
    {
        //
    }


    /**
     *  POST api/songs
     *  to create a new song
     */
    public function store(Request $request)
    {
        //
    }

    /**
     *  GET api/songs/{song}
     *  to show a song
     */
    public function show($id)
    {
        //
    }

    /**
     *  PUT/PATCH api/songs/{song}
     *  to update a song
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * DELETE api/songs/{song}
     * to delete a song
     */
    public function destroy($id)
    {
        //
    }
}
