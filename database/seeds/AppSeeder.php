<?php

use Illuminate\Database\Seeder;

class AppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run():void
    {
        $users = factory(\App\User::class, 50)->make();

        foreach ($users as $user)
        {
            $user->save();

            $profile = $this->generateProfile($user);

            $profile->save();

        }
    }

    private function generateProfile($user): \App\Profile
    {
        $profile = factory(\App\Profile::class)->make();
        $profile->user()->associate($user);

        return $profile;
    }
}
