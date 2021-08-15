<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Exception;
use Illuminate\Http\Request;
use App\Traits\Base64;

class ArtistController extends Controller
{
    use Base64;
     /**
     *  GET api/artists
     *  to get all artists with pagination and sorting
     */
    public function index()
    {
        try {
            $artists = Artist::all();
            return response()->json([
                'success' => true,
                'data' => $artists,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }


    /**
     *  POST api/artists
     *  to create a new artist
     */
    public function store(Request $request)
    {
        try {
            $image = $this->uploadBase64($request->image);

            $artist = new Artist();
            $artist->artist_name = $request->name;
            $artist->artist_image = $image;
            $artist->artist_description = $image;
            $artist->save();
            return response()->json([
                'success' => true,
                'data' => $artist,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     *  GET api/artists/{artist}
     *  to show a artist
     */
    public function show(Artist $artist)
    {
        try {
            return response()->json([
                'success' => true,
                'data' => $artist,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     *  PUT/PATCH api/artists/{artist}
     *  to update a artist
     */
    public function update(Request $request, Artist $artist)
    {
        try {
            $image = $this->uploadBase64($request->image);

            $artist->artist_name = $request->name;
            $artist->artist_image = $image;
            $artist->artist_description = $image;
            $artist->update();
            return response()->json([
                'success' => true,
                'data' => $artist,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     * DELETE api/artists/{artist}
     * to delete a artist
     */
    public function destroy(Artist $artist)
    {
        try {
            $artist->delete();
            return response()->json([
                'success' => true,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }
}
