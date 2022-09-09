<?php

namespace App\Observers;

use App\Models\Books;
use App\Jobs\ProcessBooks;

class UserObserver
{
    /**
     * Handle the Books "created" event.
     *
     * @param  \App\Models\Books  $books
     * @return void
     */
    public function created(Books $books)
    {
        //
        ProcessBooks::dispatch($books)->onQueue('major');
        ProcessBooks::dispatch($books)->onQueue('mfr');
    }

    /**
     * Handle the Books "updated" event.
     *
     * @param  \App\Models\Books  $books
     * @return void
     */
    public function updated(Books $books)
    {
        //
    }

    /**
     * Handle the Books "deleted" event.
     *
     * @param  \App\Models\Books  $books
     * @return void
     */
    public function deleted(Books $books)
    {
        //
    }

    /**
     * Handle the Books "restored" event.
     *
     * @param  \App\Models\Books  $books
     * @return void
     */
    public function restored(Books $books)
    {
        //
    }

    /**
     * Handle the Books "force deleted" event.
     *UserObserver
     * @param  \App\Models\Books  $books
     * @return void
     */
    public function forceDeleted(Books $books)
    {
        //
    }

    public function creating(Books $books)
    {
        echo "A new Book record creation is process";
    }
}
