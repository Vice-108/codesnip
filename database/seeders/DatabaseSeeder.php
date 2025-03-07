<?php

namespace Database\Seeders;

use App\Models\Snippet;
use App\Models\SnippetView;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a test user if none exists
        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // Create a sample snippet
        $snippet = Snippet::create([
            'title' => 'Example Sorting Algorithm',
            'description' => 'A simple sorting algorithm implementation for demonstration purposes',
            'code' => "function bubbleSort(arr) {\n  const n = arr.length;\n  \n  for (let i = 0; i < n; i++) {\n    for (let j = 0; j < n - i - 1; j++) {\n      if (arr[j] > arr[j + 1]) {\n        // Swap elements\n        [arr[j], arr[j + 1]] = [arr[j + 1], arr[j]];\n      }\n    }\n  }\n  \n  return arr;\n}",
            'language' => 'javascript',
            'is_public' => true,
            'user_id' => $user->id,
            'views_count' => 0,
            'favorites_count' => rand(5, 20),
        ]);

        // Generate views for each month (January to current month)
        $this->generateMonthlyViews($snippet);

        $this->command->info('Test snippet created with ID: ' . $snippet->id);
        $this->command->info('Monthly views have been generated for the test snippet');
    }

    /**
     * Generate monthly views for a snippet
     */
    private function generateMonthlyViews(Snippet $snippet): void
    {
        // Get current month and year
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Set up IP addresses for variety
        $ipAddresses = [
            '192.168.1.1', '192.168.1.2', '192.168.1.3',
            '192.168.1.4', '192.168.1.5', '192.168.1.6',
            '172.16.0.1', '172.16.0.2', '172.16.0.3',
            '10.0.0.1', '10.0.0.2', '10.0.0.3'
        ];

        $viewsCount = 0;

        // Generate views for each month from January to current month
        for ($month = 1; $month <= $currentMonth; $month++) {
            // Generate a random number of views for this month (increasing trend)
            $monthlyViews = rand(20, 50) + ($month * 15); // More views in later months

            // For each view in this month
            for ($i = 0; $i < $monthlyViews; $i++) {
                // Create a random date within the month
                $day = rand(1, Carbon::create($currentYear, $month)->daysInMonth);
                $hour = rand(0, 23);
                $minute = rand(0, 59);

                $viewDate = Carbon::create($currentYear, $month, $day, $hour, $minute);

                // Skip future dates
                if ($viewDate->isFuture()) {
                    continue;
                }

                // Create the view record
                SnippetView::create([
                    'snippet_id' => $snippet->id,
                    'viewed_at' => $viewDate,
                    'viewer_ip' => $ipAddresses[array_rand($ipAddresses)],
                    'created_at' => $viewDate,
                    'updated_at' => $viewDate,
                ]);

                $viewsCount++;
            }
        }

        // Update the snippet's views_count
        $snippet->update(['views_count' => $viewsCount]);
    }
}
