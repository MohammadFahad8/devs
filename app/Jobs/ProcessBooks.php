<?php

namespace App\Jobs;

use App\Models\Books;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Queue\Middleware\WithoutOverlapping;

class ProcessBooks implements ShouldQueue, ShouldBeUnique
{
    public $tries = 1, $uniqueFor = 3600;
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * The podcast instance.
     *
     * @var \App\Models\Books
     */
    public $books;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Books $books)
    {
        $this->books = $books;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Books $books)
    {
        //
        // throw new \Exception('Job will fail.');
        for ($i = 0; $i < 10; $i++) {
            echo json_encode($this->books);
            sleep(1);
        }
    }

    public function uniqueId()
    {
        return $this->books->id;
    }

    public function middleware()
    {
        return [new WithoutOverlapping($this->book->id)];
    }
}
