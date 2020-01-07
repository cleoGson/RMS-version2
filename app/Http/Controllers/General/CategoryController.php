<?php

namespace App\Http\Controllers\General;
use App\Http\Controllers\Controller;
use App\Model\Forum;
use App\Model\Post;
use App\User;
use App\Model\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
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
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }

     public function getCats()
    {
        $cats = Category::with('forum')->get();

        for ($i = 0; $i < count($cats); $i++)
        {
            $currentCategory = $cats[$i];

            for ($j = 0; $j < count($currentCategory['forum']); $j++)
            {
                $currentForum = $currentCategory['forum'][$j];

                $currentForum['latest'] = Post::leftJoin('threads', 'posts.thread_id', '=', 'threads.id')
                    ->where('threads.forum_id', '=', $currentForum->id)
                    ->latest()
                    ->select('posts.*', 'threads.title as thread_title', 'threads.id as thread_id')
                    ->first();

                $currentForum['latest']['user'] = User::find($currentForum['latest']->user_id);

                $currentForum['replies'] = Post::leftJoin('threads', 'posts.thread_id', '=', 'threads.id')
                    ->where('threads.forum_id', '=', $currentForum->id)
                    ->count();
            }

        }
        return response()->json($cats, 200);
    }
}
