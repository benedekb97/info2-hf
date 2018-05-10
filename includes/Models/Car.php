<?php

namespace Auto\Models;

use Auto\Base;

class Car extends Base
{
    private $id;
    private $type;
    private $age;
    private $technical_exam_year;
    private $owner_id;

    public static function all()
    {
        $cars = [];

        $query = self::$mysql->query("SELECT id FROM cars");

        while ($row = $query->fetch_assoc()) {
            $cars[] = new Car($row['id']);
        }

        return $cars;
    }

    public static function find($id)
    {
        return new Car($id);
    }

    public function __construct($id)
    {
        $query = self::$mysql->query("SELECT * FROM cars WHERE id='$id'");

        if ($query == null || $query->num_rows != 1) {
            return false;
        }

        $results = $query->fetch_assoc();

        $this->id = $results['id'];
        $this->type = $results['type'];
        $this->age = $results['age'];
        $this->technical_exam_year = $results['technical_exam_year'];
        $this->owner_id = $results['owner_id'];

        return true;
    }

    public static function create($type, $age, $technical_exam_year, User $owner)
    {
        $type = self::$mysql->real_escape_string($type);
        $age = self::$mysql->real_escape_string($age);
        $technical_exam_year = self::$mysql->real_escape_string($technical_exam_year);
        $owner_id = $owner->getId();

        self::$mysql->query("INSERT INTO cars (type, age, technical_exam_year, owner_id) VALUES ('$type', '$age', '$technical_exam_year', '$owner_id')");

        return true;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function getTechnicalExamYear()
    {
        return $this->technical_exam_year;
    }

    public function getOwner()
    {
        return new User($this->owner_id);
    }

    public function delete()
    {
        self::$mysql->query("DELETE FROM cars WHERE id='$this->id'");
        self::$mysql->query("DELETE FROM services WHERE car_id='$this->id'");

        return true;
    }
}