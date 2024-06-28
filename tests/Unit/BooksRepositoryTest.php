<?php

namespace Tests\Unit;

use App\Interfaces\BooksRepositoryInterface;
use App\Models\Books;
use Illuminate\Database\Eloquent\Collection;
use Mockery;
use Tests\TestCase;

class BooksRepositoryTest extends TestCase
{
    protected BooksRepositoryInterface $repository;

    public function setUp(): void
    {
        parent::setUp();

        $this->repository = Mockery::mock(BooksRepositoryInterface::class);
    }

    public function testGetAll(): void
    {
        $this->repository
            ->shouldReceive('getAll')
            ->once()
            ->andReturn(new Collection([new Books(), new Books()]));

        // Call the method and assert the result
        $books = $this->repository->getAll();
        $this->assertCount(2, $books);
        $this->assertInstanceOf(Books::class, $books->first());
    }

    public function testGetById(): void
    {
        // Mock the expected behavior of getById method
        $bookId = 1;
        $this->repository
            ->shouldReceive('getById')
            ->with($bookId)
            ->once()
            ->andReturn(new Books());

        // Call the method and assert the result
        $book = $this->repository->getById($bookId);
        $this->assertInstanceOf(Books::class, $book);
    }

    public function testCreate(): void
    {
        // Mock the expected behavior of create method
        $bookData = [
            'name' => 'Test Book',
            'details' => 'Test details',
            'author' => 'Test Author'
        ];

        // Create a new Book instance to return
        $newBook = new Books($bookData);

        $this->repository
            ->shouldReceive('create')
            ->with($bookData)
            ->once()
            ->andReturn($newBook);

        // Call the method and assert the result
        $createdBook = $this->repository->create($bookData);
        $this->assertInstanceOf(Books::class, $createdBook);
        $this->assertEquals('Test Book', $createdBook->name);
    }

    public function testUpdate(): void
    {
        // Mock the expected behavior of update method
        $bookId = 1;
        $bookData = [
            'name' => 'Updated Book',
            'details' => 'Updated details',
            'author' => 'Updated Author'
        ];

        $this->repository
            ->shouldReceive('update')
            ->with($bookData, $bookId)
            ->once()
            ->andReturn(new Books($bookData));

        // Call the method and assert the result
        $updatedBook = $this->repository->update($bookData, $bookId);
        $this->assertInstanceOf(Books::class, $updatedBook);
        $this->assertEquals('Updated Book', $updatedBook->name);
    }

    public function testDelete(): void
    {
        $bookId = 1;

        $this->repository
            ->shouldReceive('delete')
            ->with($bookId)
            ->once()
            ->andReturn(1);

        // Call the method and assert the result
        $deleted = $this->repository->delete($bookId);
        $this->assertEquals(1, $deleted);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
