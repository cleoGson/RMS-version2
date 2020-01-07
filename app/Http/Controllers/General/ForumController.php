<?php

namespace App\Http\Controllers\General;
use App\Http\Controllers\Controller;
use Auth;
use App\Model\Forum;
use App\Model\Thread;
use App\Model\Post;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return view('generals.forums.forums.dashboard');
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
     * @param  \App\Model\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function show(Forum $forum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function edit(Forum $forum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Forum $forum)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function destroy(Forum $forum)
    {
        //
    }

    public function indexForum(){
         return view('generals.forums.forums.dashboard');
    }

 public function getForumById($id)
    {
        $forum = Forum::find($id);
        if (!isset($forum->id))
        {
            return response()->json(['error' => 401], 200);
        }

        $forum->views ++;
        $forum->save();


        $threads = Thread::where('forum_id', $forum->id)->latest()->paginate(10);
        $forum['threads'] = $threads;


        for ($i = 0; $i < count($forum['threads']); $i++)
        {
            $thread = $forum['threads'][$i];
            $thread['latestPost'] = Post::with('user', 'thread.user')
                                        ->where('thread_id', '=', $thread['id'])
                                        ->latest()
                                        ->first();
            $thread['postCount'] = Post::where('thread_id', '=', $thread['id'])->count();

            $user = User::find($thread->user_id);
            $thread['user'] = $user;
        }

        return response()->json($forum, 200);
    }

     public function init()
    {
        $user = Auth::user();

        $threadsCount = Thread::all()->count();

        $activeThreads = Thread::latest('updated_at')->take(10)->get();

        foreach ($activeThreads as $activeThread)
        {
            $activeThread['latestPost'] = Post::with('user')->where('thread_id', $activeThread->id)->latest()->first();
        }

        $data_provider=array(
             'threadCount' => $threadsCount,
            'activeThreads' => $activeThreads,
            'user' => $user
        );
        return $data_provider;
        // return response()->json([
        //     'threadCount' => $threadsCount,
        //     'activeThreads' => $activeThreads,
        //     'user' => $user
        // ], 200);
    }

}
