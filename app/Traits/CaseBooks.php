<?php
namespace App\Traits;
trait CaseBooks
{
    /**
     * @var array
     */
    protected static $itemBooks;

    /**
     * Construct the box with the given items.
     *
     * @param array $items
     */
    public static function setItems($items = [])
    {
        return static::$itemBooks = $items;
    }

    /**
     * Check if the specified item is in the box.
     *
     * @param string $item
     * @return bool
     */
    public function has($item,$books)
    {
        return in_array($item, $books);
    }

    /**
     * Remove an item from the box, or null if the box is empty.
     *
     * @return string
     */
    public function takeOne()
    {
        return array_shift(static::$itemBooks);
    }

    /**
     * Retrieve all items from the box that start with the specified letter.
     *
     * @param string $letter
     * @return array
     */
    public function startsWith($letter)
    {
        return array_filter(static::$itemBooks, function ($item) use ($letter) {
            return stripos($item, $letter) === 0;
        });
    }

}
