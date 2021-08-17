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
use Jackiedo\DotenvEditor\Facades\DotenvEditor;

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
        $env = DotenvEditor::load();

        $this->line('Application settings:');
        $this->call('key:generate');
        $env->setKey('APP_NAME', $this->ask('Application name:', $env->getValue('APP_NAME')));
        $env->setKey('APP_URL', $this->ask('Application URL:', $env->getValue('APP_URL')));
        $env->save();
        $this->info('Application settings saved successfully.');

        $this->line('');
        $this->line('Database settings:');
        $env->setKey('DB_HOST', $this->ask('Database host:', $env->getValue('DB_HOST')));
        $env->setKey('DB_PORT', $this->ask('Database port:', $env->getValue('DB_PORT')));
        $env->setKey('DB_DATABASE', $this->ask('Database name:', $env->getValue('DB_DATABASE')));
        $env->setKey('DB_USERNAME', $this->ask('Database user name:', $env->getValue('DB_USERNAME')));
        $env->setKey('DB_PASSWORD', $this->ask('Database user password:', $env->getValue('DB_PASSWORD')));
        $env->save();
        $this->info('Database settings saved successfully.');

        $this->line('');
        $this->line('Database setup:');
        $this->call('migrate:fresh', ['--seed']);
        $this->info('Database successfully set up.');

        $this->line('');
        $this->line('Letterboxd settings:');
        $env->setKey('LETTERBOXD_API_KEY', $this->ask('Letterboxd API key:', $env->getValue('LETTERBOXD_API_KEY')));
        $env->setKey('LETTERBOXD_API_SECRET', $this->ask('Letterboxd API secret:', $env->getValue('LETTERBOXD_API_SECRET')));
        $env->setKey('LETTERBOXD_USERNAME', $this->ask('Letterboxd username:', $env->getValue('LETTERBOXD_USERNAME')));
        $env->setKey('LETTERBOXD_PASSWORD', $this->ask('Letterboxd password:', $env->getValue('LETTERBOXD_PASSWORD')));
        $env->save();
        $this->info('Letterboxd settings saved successfully.');

        $this->line('');
        $this->line('Administration user:');
        $adminEmail = $this->ask("Admin email:");
        $adminPassword = $this->secret('Admin password:');
        $adminName = $this->ask('Admin name:');
        $user = new User([
            'name'              => $adminName,
            'email'             => $adminEmail,
            'password'          => Hash::make($adminPassword),
            'email_verified_at' => Carbon::now()->timestamp,
        ]);
        $user->save();
        $this->info('Administration user saved successfully.');

        $this->line('');
        $this->info('System installed');

        return 0;
    }
}
