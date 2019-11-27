<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
\Illuminate\Support\Facades\DB::table('users')->insert([
    'name'=>'Alex',
    'email'=>'test@test.com',
    'password'=>\Hash::make('password')
]);
        factory(\App\User::class, 30)->create();
        factory(\App\Category::class, 20)->create();
        \App\User::all()->each(function ($u){
            $u->posts()->saveMany(factory(\App\Post::class, rand(10, 20))->make())->each(function($p) use ($u){
                $cats = \App\Category::inRandomOrder()->limit(rand(2,5))->get()->pluck('id');
                $p->categories()->sync($cats, true);
                $p->comments()->saveMany(factory(\App\Comment::class, rand(1, 10))->make(['user_id'=>$u->id]));
            });

        });
    }
}
