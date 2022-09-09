<?php
namespace Tests\Feature;
use Tests\TestCase;
use App\Cases\Books;
use App\Traits\CaseBooks;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Faker\Generator as Faker;
class BooksTest extends TestCase
{
    use CaseBooks, WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function test_books_not_null()
    // {
    //     $books = CaseBooks::setItems(['toy']);
    //     $this->assertTrue($this->has('toy',$books));
    //     $this->assertFalse($this->has('ball',$books));
    // }

    public function testBooksSearch()
    {
       $result =$this->call('GET', '/bookme/search', ["query"=>"i"]);
       dd();
        $this->assertViewHas('title');
    }
}
