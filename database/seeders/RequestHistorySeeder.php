<?php

namespace Database\Seeders;

use App\Models\RequestHistory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RequestHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sessionId = Str::uuid()->toString();
        RequestHistory::factory()
            ->count(10)
            ->create([
                RequestHistory::SESSION_ID_COLUMN => $sessionId
            ]);

        RequestHistory::factory()
            ->count(1)
            ->create([
                RequestHistory::SESSION_ID_COLUMN => $sessionId,
                RequestHistory::METHOD_COLUMN     => 'POST',
                RequestHistory::TO_COLUMN        => route('apply')
            ]);

        $sessionId = Str::uuid()->toString();
        RequestHistory::factory()
            ->count(8)
            ->create([
                RequestHistory::SESSION_ID_COLUMN => $sessionId,
            ]);

        $sessionId = Str::uuid()->toString();
        RequestHistory::factory()
            ->count(12)
            ->create([
                RequestHistory::SESSION_ID_COLUMN => $sessionId
            ]);

        RequestHistory::factory()
            ->count(1)
            ->create([
                RequestHistory::SESSION_ID_COLUMN => $sessionId,
                RequestHistory::METHOD_COLUMN     => 'POST',
                RequestHistory::TO_COLUMN        => route('apply')
            ]);

        $sessionId = Str::uuid()->toString();
        RequestHistory::factory()
            ->count(1)
            ->create([
                RequestHistory::SESSION_ID_COLUMN => $sessionId,
            ]);

        RequestHistory::factory()
            ->count(1)
            ->create([
                RequestHistory::SESSION_ID_COLUMN => $sessionId,
                RequestHistory::METHOD_COLUMN     => 'POST',
                RequestHistory::TO_COLUMN        => route('apply')
            ]);

        $sessionId = Str::uuid()->toString();
        RequestHistory::factory()
            ->count(200)
            ->create([
                RequestHistory::SESSION_ID_COLUMN   => $sessionId,
                RequestHistory::COUNTRY_CODE_COLUMN => 'USA',
            ]);
    }
}
