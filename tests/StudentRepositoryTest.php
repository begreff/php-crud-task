<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use PHPUnit\DbUnit\TestCaseTrait;
use src\models\StudentRepository;

class StudentRepositoryTest extends TestCase
{
    use TestCaseTrait;
    private $studentRepo;

    // only instantiate pdo once for test clean-up/fixture load
    static private $pdo = null;

    // only instantiate PHPUnit\DbUnit\Database\Connection once per test
    private $conn = null;

    final public function getConnection() {
        if ($this->conn === null) {
            if (self::$pdo == null) {
                self::$pdo = new \PDO( $GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD'] );
            }
            $this->conn = $this->createDefaultDBConnection(self::$pdo, $GLOBALS['DB_DBNAME']);
        }

        return $this->conn;
    }

    public function getDataSet()
    {
        return $this->createFlatXmlDataSet(dirname(__FILE__).'/students_fixture.xml');
    }

    public function testRowCount()
    {
        $this->assertSame(3, $this->getConnection()->getRowCount('students'), "Initial size");
    }

    public function testStudentDelete()
    {
        // Create student repo
        $this->studentRepo = new StudentRepository($this->getConnection()->getConnection());

        // Delete student
        $this->studentRepo->delete(3);

        // Assert row count is as expected (from 3 to 2)
        $this->assertSame(2, $this->getConnection()->getRowCount('students'), 'After delete');

        // Assert correct data was deleted
        $tableAfterDelete = $this->getConnection()->createQueryTable('after delete', 'SELECT * FROM students');
        $expectedTable = $this->createFlatXMLDataSet(dirname(__FILE__).'/students_expected.xml')->getTable('students');
        $tableAfterDelete->matches($expectedTable);
    }
}



