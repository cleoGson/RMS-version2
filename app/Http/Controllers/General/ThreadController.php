<?php

namespace App\Http\Controllers\General;
use App\Http\Controllers\Controller;

use App\Model\Thread;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
 public $table = 'threads';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show(Thread $thread)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thread $thread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thread $thread)
    {
        //
    }


    public function getThreadById($id)
    {
        $thread = Thread::with('user', 'forum')->where('id', $id)->first();

        $posts = Post::with('user')->where('thread_id', $thread->id)->paginate(10);

        $thread['posts'] = $posts;

        return response()->json($thread, 200);
    }


    public function search($searchQuery)
    {
        $threads = Thread::with('user')
            ->where('title', 'like', '%'.strtolower($searchQuery).'%')
            ->select('threads.*' )
            ->latest()
            ->paginate(10);


        foreach ($threads as $thread)
        {
            $post = Post::with('user')->where('thread_id', $thread->id)->latest()->first();
            $thread['latestPost'] = $post;
        }


        return response()->json($threads, 200);
    }

    public function forumCreate(Request $request)
    {
        $thread = new Thread();
        $thread->forum_id = $request->forum_id;
        $thread->title = $request->title;
        $thread->user_id = Auth::id();
        $thread->save();



        $post = new Post();
        $post->thread_id = $thread->id;
        $post->user_id = Auth::id();
        $post->body = $request->body;
        $post->save();

        $thread['latestPost'] = Post::with('user')->where('id', $post->id)->first();

        return response()->json($thread, 200);
    }
}
