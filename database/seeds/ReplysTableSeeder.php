<?php

use Illuminate\Database\Seeder;
use App\Models\Reply;
use app\Models\User;
use app\Models\Topic;


class ReplysTableSeeder extends Seeder
{
    public function run()
    {

        $user_ids = User::all()->pluck('id')->toArray();

        $topic_ids = Topic::all()->pluck('id')->toArray();

        //获取faker 实例
        $faker = app(Faker\Generator::class);

        $replys = factory(Reply::class)
            ->times(1000)
            ->make()
            ->each(function ($reply, $index) use ($user_ids, $topic_ids, $faker){

                //从用户ID 数组中随机取出一个并复制
                $reply->user_id = $faker->randomElement($user_ids);

                //话题 ID  同上
                $reply->topic_id = $faker->randomElement($topic_ids);
        });

        //将数据集合转换成数组， 并插入到数据库中
        Reply::insert($replys->toArray());
    }

}

