<?php

namespace App\Repositories;

use App\Exceptions\BookNotFoundException;
use App\Interfaces\BooksRepositoryInterface;
use App\Models\Books;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BookRepository implements BooksRepositoryInterface
{

    /**
     * @return Collection<int, Books>
     */
    public function getAll(): Collection
    {
        return Books::all();
    }


    /**
     * @param string $id
     * @throws BookNotFoundException
     */
    public function getById(string $id): Books
    {
        try {
            return Books::findOrFail($id);
        } catch (ModelNotFoundException $ex) {
            throw new BookNotFoundException("Book not found with id: {$id}");
        }

    }

    /**
     * Creates a new book entry.
     *
     * @param array{
     *     name: string,
     *     details: string,
     *     author: string
     * } $bookData The data for the book, containing:
     *             - 'name' (required|string|max:255): The name of the book.
     *             - 'details' (required|string): The details of the book.
     *             - 'author' (required|string|max:255): The author of the book.
     * @return Books The created book instance.
     */
    public function create(array $bookData): Books
    {
        return Books::create($bookData);
    }

    public function update(array $bookData,  string $id): Books
    {

        $book = $this->getById($id);

        $book->fill($bookData);
        $book->save();

        return $book;
    }

    public function delete(string $id): int
    {
        return Books::destroy($id);
    }
}
