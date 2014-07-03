<?php

namespace QafooLabs\Profiler;

class SqlAnonymizerTest extends \PHPUnit_Framework_TestCase
{
    static public function dataSqlQuotes()
    {
        return array(
            array('SELECT 1', 'SELECT ?'),
            array('select * from foo', 'select * from foo'),
            array('SELECT "foo" FROM bar', 'SELECT ? FROM bar'),
            array('SELECT "foo", "bar", "baz" FROM bar', 'SELECT ?, ?, ? FROM bar'),
            array('SELECT "foo", \'bar\', 1234, 17.45 FROM baz', 'SELECT ?, ?, ?, ? FROM baz'),
            array('SELECT "foo" FROM bar WHERE "baz" = 1', 'SELECT ? FROM bar WHERE ? = ?'),
        );
    }

    /**
     * @dataProvider dataSqlQuotes
     * @test
     */
    public function it_anonymizes_sql_replacing_quotes_with_question_marks($sql, $anonymizedSql)
    {
        $this->assertEquals($anonymizedSql, SqlAnonymizer::anonymize($sql));
    }
}
