<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Channel;
use App\Models\Video;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
         $channel = Channel::with('videos')->findOrFail($id);

        return view('videos.index', compact('channel'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $channels = Channel::all();

        return view('admin.videos.create', compact('channels'));
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
    {
        $url = $request->url;

        if (str_contains($url, 'youtu.be/')) {
            $videoId = explode('youtu.be/', $url)[1];
            $videoId = explode('?', $videoId)[0];
        } else {
            parse_str(parse_url($url, PHP_URL_QUERY), $params);
            $videoId = $params['v'] ?? null;
        }

        if (!$videoId) {
            return back()->with('error', 'URL no válida');
        }

        $embedUrl = 'https://www.youtube.com/embed/' . $videoId;

        Video::create([
            'title' => $request->title,
            'description' => $request->description,
            'url' => $embedUrl,
            'channel_id' => $request->channel_id
        ]);

        return redirect()->route('admin.videos.create')
            ->with('success', 'Video creado correctamente');
    }
        

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $video = Video::with('comments.user')->findOrFail($id);

         return view('videos.show', compact('video'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
