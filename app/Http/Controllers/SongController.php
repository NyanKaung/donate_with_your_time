<?php

namespace App\Http\Controllers;

use App\Http\Requests\SongStoreRequest;
use App\Http\Requests\SongUpdateRequest;
use App\Models\Song;
use Exception;
use Illuminate\Http\Request;
use App\Traits\Base64;
use App\Traits\Query;
class SongController extends Controller
{
    use Query;
    use Base64;

    /**
     *  GET api/songs
     *  to get all songs with pagination and sorting
     */
    public function index(Request $request)
    {
        try {
            request()->validate([
                'page' => 'required',
                'limit' => 'required',
            ]);
            $product = new Song();
            $query = $product->newQuery();
            $query = $product->select('suppliers.*');
            $query = $this->_sort($query, $request->sorts ?? []);
            $query = $this->_filter($query, ['name'], $request->name ?? '');

            $total = $query->count();
            $query = $this->_paginate($query, $request->page, $request->limit);

            $data = $query->get();

            return [
                'success' => true,
                'data' => $data,
                'total' => $total,
            ];
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    /**
     *  POST api/songs
     *  to create a new song
     */
    public function store(SongStoreRequest $request)
    {
        try {
            $image = $this->uploadBase64($request->image);

            $song = new Song();
            $song->song_name = $request->name;
            $song->song_duration = $request->duration;
            $song->song_image = $image;
            $song->today_playlist = $request->today_playlist;
            $song->category_id = $request->category_id;
            $song->artist_id = $request->artist_id;
            $song->released_at = $request->released_at;
            $song->save();
            return response()->json([
                'success' => true,
                'data' => $song,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     *  GET api/songs/{song}
     *  to show a song
     */
    public function show(Song $song)
    {
        try {
            return response()->json([
                'success' => true,
                'data' => $song,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     *  PUT/PATCH api/songs/{song}
     *  to update a song
     */
    public function update(SongUpdateRequest $request, Song $song)
    {
        try {
            $image = $this->uploadBase64($request->image);

            $song->song_name = $request->name;
            $song->song_duration = $request->duration;
            $song->song_image = $image;
            $song->today_playlist = $request->today_playlist;
            $song->category_id = $request->category_id;
            $song->artist_id = $request->artist_id;
            $song->released_at = $request->released_at;
            $song->update();
            return response()->json([
                'success' => true,
                'data' => $song,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     * DELETE api/songs/{song}
     * to delete a song
     */
    public function destroy(Song $song)
    {
        try {
            $song->delete();
            return response()->json([
                'success' => true,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }
}
