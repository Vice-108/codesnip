<?php

namespace Database\Seeders;

use App\Models\Snippet;
use App\Models\User;
use Illuminate\Database\Seeder;

class SnippetSeeder extends Seeder
{
    public function run(): void
    {
        // Create some test users if they don't exist
        $users = User::factory(3)->create();

        // Create snippets for each user
        foreach ($users as $user) {
            // JavaScript snippets
            Snippet::create([
                'user_id' => $user->id,
                'title' => 'Array Map Example',
                'description' => 'Simple example of using Array.map()',
                'code' => 'const numbers = [1, 2, 3, 4, 5];\nconst doubled = numbers.map(num => num * 2);\nconsole.log(doubled);',
                'language' => 'javascript',
                'is_public' => true,
            ]);

            // PHP snippets
            Snippet::create([
                'user_id' => $user->id,
                'title' => 'Laravel Collection Example',
                'description' => 'Using Laravel collections to filter and map data',
                'code' => 'collect([1, 2, 3, 4, 5])\n    ->filter(fn ($num) => $num > 2)\n    ->map(fn ($num) => $num * 2);',
                'language' => 'php',
                'is_public' => true,
            ]);

            // Python snippets
            Snippet::create([
                'user_id' => $user->id,
                'title' => 'List Comprehension',
                'description' => 'Python list comprehension example',
                'code' => 'numbers = [1, 2, 3, 4, 5]\ndoubled = [x * 2 for x in numbers if x > 2]',
                'language' => 'python',
                'is_public' => false,
            ]);
        }

        // Add some favorites
        $users->each(function ($user) {
            // Get random snippets to favorite (excluding user's own snippets)
            $snippetsToFavorite = Snippet::where('user_id', '!=', $user->id)
                ->inRandomOrder()
                ->take(2)
                ->get();

            // Add favorites
            $user->favoriteSnippets()->attach($snippetsToFavorite->pluck('id'));

            // Update favorites count
            $snippetsToFavorite->each(function ($snippet) {
                $snippet->favorites_count = $snippet->favoritedBy()->count();
                $snippet->save();
            });
        });
    }
}
