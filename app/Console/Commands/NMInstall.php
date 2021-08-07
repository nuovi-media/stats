<?php

/** Nuovi Media - Stats
 *
 *  Copyright (C) 2020 Lorenzo Breda <lorenzo@lbreda.com>
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use NuoviMedia\LetterboxdClient\LetterboxdClient;

class NMInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nm:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Configures the system';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $adminEmail = $this->ask("Admin email:");
        $adminPassword = $this->secret('Admin password:');
        $adminName = $this->ask('Admin name:');

        // Creates admin user
        $user = new User([
            'name'              => $adminName,
            'email'             => $adminEmail,
            'password'          => Hash::make($adminPassword),
            'email_verified_at' => Carbon::now()->timestamp,
        ]);
        $user->save();

        $this->info('System installed');

        return 0;
    }
}
