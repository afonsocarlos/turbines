<?php

namespace App\Interfaces;


interface ModelInterface
{
    /**
     * @param int $id
     *
     * Retrieve a record from the database by id.
     * @return mixed
     */
    public function find(int $id): mixed;

    /**
     * @param int $id
     *
     * Retrieve all records from the database.
     * @return array
     */
    public function all(): array;

    /**
     * @param int $id
     *
     * Create a new record in the database.
     * @return mixed
     */
    public function create(array $data): mixed;

    /**
     * @param int $id
     *
     * Update an existing record in the database.
     * @return bool
     */
    public function update(int $id, array $data): bool;

    /**
     * @param int $id
     *
     * Delete an existing record in the database.
     * @return bool
     */
    public function delete(int $id): bool;
}
