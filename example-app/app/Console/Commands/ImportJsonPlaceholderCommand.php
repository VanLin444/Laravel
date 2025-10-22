<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;
use App\app\Components\ImportDataClient;

class ImportJsonPlaceholderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:jsonplaceholder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get data from jsonplaceholder';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $import = new ImportDataClient();
        $response = $import->client->request('GET', 'todos');
        $data = json_decode($response->getBody()->getContents());

        foreach ($data as $item) {
            Post::firstOrCreate([
                'title' => $item->title
            ],[
                'title' => $item->title,
                'content' => $item->title,
                'category_id' => 2
            ]);
        }
    }
}
