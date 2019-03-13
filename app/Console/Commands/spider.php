<?php

namespace App\Console\Commands;

use App\Repositories\KeywordRepository;
use Illuminate\Console\Command;
use Spider\Http\Resolver;

class spider extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:spider';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'spider aizhan keyword';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    protected $resolver;

    protected $keywordRepository;

    public function __construct(Resolver $resolver, KeywordRepository $keywordRepository)
    {
        $this->resolver = $resolver;
        $this->keywordRepository = $keywordRepository;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        for ($i=50;$i>0;$i--) {
            $words = $this->resolver->getAizhanKeyword($i);
            $words = $this->keywordRepository->createMultiple($words);
            echo $words->toJson();
            sleep(3);
        }

    }
}
