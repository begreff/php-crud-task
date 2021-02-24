<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use PHPUnit\DbUnit\TestCaseTrait;
use src\models\StudentRepository;

class StudentRepositoryTest extends TestCase
{

    use TestCaseTrait;
    private $studentRepo;

    public function setUp()
    {
        $this->studentRepo = new StudentRepository($this->getConnection());
    }

    public function getConnection()
    {
        $pdo = new \PDO($GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD']);
        return $this->createDefaultDBConnection($pdo, $GLOBALS['DB_DBNAME']);
    }

    public function getDataSet()
    {
        return $this->createFlatXmlDataSet(dirname(__FILE__).'/students_fixture.xml');
    }

    public function testRowCount()
    {
        $this->assertSame(2, $this->getConnection()->getRowCount('students'), "Pre-condition");
    }
}



