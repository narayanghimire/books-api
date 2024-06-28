<?php

namespace App\Interfaces;

use App\Models\Books;
use Illuminate\Database\Eloquent\Collection;

interface BooksRepositoryInterface
{
    /**
     * @return Collection<int, Books>
     */
    public function getAll(): Collection;

    public function getById(string $id): Books;

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
    public function create(array $bookData): Books;

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
    public function update(array $bookData, string $id);

    public function delete(string $id): int;
}
