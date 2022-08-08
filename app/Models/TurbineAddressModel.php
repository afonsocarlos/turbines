<?php

namespace App\Models;


class TurbineAddressModel extends Model
{
    /**
     * @param int $id
     *
     * Retrieve a record from the database by id.
     * @return mixed
     */
    public static function find(int $id): mixed
    {
        $stmt = self::$db->query('SELECT * FROM turbine_addresses WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    /**
     * @param int $id
     *
     * Retrieve all records from the database.
     * @return array
     */
    public static function all(): array
    {
        $stmt = self::$db->query('SELECT * FROM turbine_addresses');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * @param int $id
     *
     * Create a new record in the database.
     * @return mixed
     */
    public static function create(array $data): mixed
    {
        $stmt = self::$db->prepare('INSERT INTO turbine_addresses (name, description, latitude, longitude) VALUES (:name, :description, :latitude, :longitude)');
        $stmt->execute([
            'name' => $data['name'],
            'description' => $data['description'],
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude']
        ]);
        return self::find(self::$db->lastInsertId());
    }

    /**
     * @param int $id
     *
     * Update an existing record in the database.
     * @return bool
     */
    public static function update(int $id, array $data): bool
    {
        $address = self::find($id);
        $stmt = self::$db->prepare('UPDATE turbine_addresses SET name = :name, description = :description, latitude = :latitude, longitude = :longitude WHERE id = :id');
        $stmt->execute([
            'name' => $data['name'] ?? $address['name'],
            'description' => $data['description'] ?? $address['description'],
            'latitude' => $data['latitude'] ?? $address['latitude'],
            'longitude' => $data['longitude'] ?? $address['longitude'],
            'id' => $id
        ]);
        return $stmt->rowCount() > 0;
    }

    /**
     * @param int $id
     *
     * Delete an existing record in the database.
     * @return bool
     */
    public static function delete(int $id): bool
    {
    }
}
