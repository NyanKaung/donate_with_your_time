<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArtistController extends Controller
{
     /**
     *  GET api/artists
     *  to get all artists with pagination and sorting
     */
    public function index()
    {
        //
    }


    /**
     *  POST api/artists
     *  to create a new artist
     */
    public function store(Request $request)
    {
        //
    }

    /**
     *  GET api/artists/{artist}
     *  to show a artist
     */
    public function show($id)
    {
        //
    }

    /**
     *  PUT/PATCH api/artists/{artist}
     *  to update a artist
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * DELETE api/artists/{artist}
     * to delete a artist
     */
    public function destroy($id)
    {
        //
    }
}
