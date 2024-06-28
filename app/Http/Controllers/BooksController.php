<?php

namespace App\Http\Controllers;

use App\Classes\ResponseClass;
use App\Exceptions\BookNotFoundException;
use App\Http\Requests\CreateBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Interfaces\BooksRepositoryInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class BooksController extends Controller
{
    public function __construct(
        private readonly BooksRepositoryInterface $booksRepositoryInterface
    ){
    }

    public function create(CreateBookRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            // Save the book using the repository interface
            $createdBook = $this->booksRepositoryInterface->create($request->validated());

            DB::commit();

            // Return success response
            return ResponseClass::sendResponse(new BookResource($createdBook), 'Book Created Successfully', 201);
        } catch (Exception $ex) {
            DB::rollback();
            // Handle and return error response
            return ResponseClass::throw($ex);
        }
    }

    /**
     * @throws BookNotFoundException
     */
    public function edit(UpdateBookRequest $updateBookRequest, string $id): JsonResponse
    {
        DB::beginTransaction();
        try {
            $product = $this->booksRepositoryInterface->update($updateBookRequest->validated(), $id);

            DB::commit();
            return ResponseClass::sendResponse(new BookResource($product), 'Book updated Successful', 201);

        } catch (Exception $ex) {
            if ($ex instanceof BookNotFoundException) {
                throw new BookNotFoundException();
            }
            ResponseClass::rollback($ex);
            return ResponseClass::throw($ex);
        }
    }

    public function delete(string $id): JsonResponse
    {
        $this->booksRepositoryInterface->getById($id);
        $this->booksRepositoryInterface->delete($id);

        return ResponseClass::sendResponse('book Delete Successful', '', 200);
    }


    /**
     * TODO: When there are too many books, we can implement pagination so that the API returns
     * only a few books per call. This will improve API performance in case of large amounts of data.
     * Similarly, on this API route, we can add a search filter by adding a search query parameter,
     * for example, by author.
     */
    public function getAll(): JsonResponse
    {
        $data = $this->booksRepositoryInterface->getAll();

        return ResponseClass::sendResponse(BookResource::collection($data), '', 200);
    }

    public function getById(string $id): JsonResponse
    {
        $book = $this->booksRepositoryInterface->getById($id);

        return ResponseClass::sendResponse(new BookResource($book), '', 200);
    }
}
