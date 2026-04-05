<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;    


class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($video_id)
    {
        $video = Video::with('comments.user')->findOrFail($video_id);
        return view('comments.index', compact('video'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $request->validate([
            'content' => 'required',
            'video_id' => 'required',
        ]);

        Comment::create([
            'content' => $request->content,
            'user_id' =>  Auth::id(),
            'video_id' => $request->video_id
        ]);

        return back()->with('success', 'Comentario agregado');
    }
    
    /**
     * Display the specified resource.
     */
    public function show()
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        return view('comments.edit', compact('comment'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
         $comment = Comment::findOrFail($id);
        $comment->update([
            'content' => $request->content
        ]);
        return redirect()->route('videos.show', $comment->video_id)
            ->with('success', 'Comentario actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return back()->with('success', 'Comentario eliminado');
    }
    
}
