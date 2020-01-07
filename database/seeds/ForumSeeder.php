<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Model\Category;
use App\User;
use App\Model\Forum;
use App\Model\Post;
use App\Model\Thread;
use Faker\Factory as Faker;
class ForumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    /*
         * Create Categories and forums
         */

        $cf = [
            'Official' => ['Announcements', 'News', 'Press'],
            'General' => ['Attackers', 'Midfielders', 'Defenders', 'Goalkeepers'],
            'Mobile' => ['Android', 'iOS'],
            'Help' => ['Bugs', 'Contact']
        ];

        $allCats = [];
        $allForums = [];

        foreach ($cf as $category => $forums)
        {
            $_category = new Category();
            $_category->title = $category;
            $_category->save();

            $allCats[] = $_category;

            foreach ($forums as $forum)
            {
                $_forum = new Forum();
                $_forum->category_id = $_category->id;
                $_forum->title = $forum;
                $_forum->save();

                $allForums[] = $_forum;
            }
        }


        $numberOfUsers = 30;
        $userFaker = Faker::create();


        for ($i = 0; $i < $numberOfUsers; $i++)
        {
            $password = $userFaker->password;

            $user = new User();
            $user->username = $userFaker->unique()->name;
            $user->email = $userFaker->email;
            $user->password = bcrypt('Kileo@2019');
            $user->userable_type = null;
            $user->userable_id = null; 
            $user->verifiedstatus =1;
            $user->remember_token = null;
            $user->save();

            $users = User::all();


            $numberOfThreads = rand(1, 4);

            for ($j = 0; $j < $numberOfThreads; $j++)
            {
                $randomForum = $allForums[array_rand($allForums)];
                $threadFaker = Faker::create();

                $thread = new Thread();
                $thread->forum_id = $randomForum->id;
                $thread->title = $threadFaker->sentence;
                $thread->user_id = $user->id;
                $thread->save();

                $p = new Post();
                $p->thread_id = $thread->id;
                $p->user_id = $user->id;

                $numberOfPosts = rand(10, 25);
                $postFaker = Faker::create();

                for ($z = 0; $z < $numberOfPosts; $z++)
                {
                    $post = new Post();
                    $post->thread_id = $thread->id;
                    $post->body = $postFaker->paragraphs(3, true);
                    $randomIndex = rand(0, count($users) - 1);
                    $post->user_id = $users[ $randomIndex ]->id;
                    $post->save();
                }
            }
        }
    }
}
