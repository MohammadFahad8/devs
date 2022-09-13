<?php

namespace App\Models;
use App\Scopes\AuthorScope;
use App\Events\SendEmailAuthor;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Contracts\BookContract as BookContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Books extends Model implements BookContract
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'tags'];
    protected $dispatchesEvents = [
        'created' => SendEmailAuthor::class,
    ];

    public function __construct()
    {
        $this->storage = Redis::connection();
    }
    //Global Scope
    // protected static function booted()
    // {
    //     static::addGlobalScope(new AuthorScope);
    // }

    //Local Scope

    public function scopeAuthor($query)
    {
        return $query->where('title', '!=', 'Friday assignee');
    }

    public function scopeSearch(Builder $query,$search)
    {
        return $query->where("title",'ILIKE','%'.$search.'%');
    }
    public static function fatModel(): Collection
    {
        return Books::latest()->get();
    }

    public function fetchAll()
    {
        $results = Cache::remember("books_records_cache",1,function(){
            return $this->get();
          });
          return $results;
    }

    public function fetchById($id)
    {
        return $this->find($id);
    }
}
