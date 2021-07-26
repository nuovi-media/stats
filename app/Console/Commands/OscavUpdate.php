<?php

/** ACLink
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

use Illuminate\Console\Command;
use NuoviMedia\LetterboxdClient\LetterboxdClient;

class OscavUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'oscav:update
                            {--tag=* : Prefix, multiple supported, default: current year}
                            {--update-movies : Forces movies update}
                            {--update-users : Forces users update}
                            {--update-ratings : Forces ratings update}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports data from Letterboxd';

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
        // Parameters
        $tags = $this->option('tag') ?? [null];
        $updateMovies = $this->option('update-movies') ?? false;
        $updateMovies = $this->option('update-users') ?? false;
        $updateMovies = $this->option('update-ratings') ?? false;

        // Test
        $lboxd = new LetterboxdClient();

        return 0;
    }
}
