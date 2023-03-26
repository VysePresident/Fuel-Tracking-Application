<?php
declare(strict_types=1);
require_once 'dummyFile.php';
use PHPUnit\Framework\TestCase;
class testDummy extends TestCase{
    public function testCreateTable() {
        $db_name = ':memory:';
        $quote = new FuelQuotePractice($db_name);
        $connection = new SQLite3($db_name);
        $table_check = $connection->query("SELECT name FROM sqlite_master WHERE type='table' AND name='fuel_quotes'");
        $this->assertNotNull($table_check->fetchArray());
    }

    public function testAddQuote() {
        $db_name = ':memory:';
        $quote = new FuelQuotePractice($db_name);
        $quote->add_quote('Acme Inc', 'TX', 'Houston', '123 Main St.');
        $connection = new SQLite3($db_name);
        $result = $connection->query('SELECT * FROM fuel_quotes');
        $quotes = array();
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            array_push($quotes, $row);
        }
        $this->assertCount(1, $quotes);
        $this->assertEquals('Acme Inc', $quotes[0]['company_name']);
        $this->assertEquals('TX', $quotes[0]['state']);
        $this->assertEquals('Houston', $quotes[0]['city']);
        $this->assertEquals('123 Main St.', $quotes[0]['address']);
    }
    public function testGetAllQuotes() {
        $db_name = ':memory:';
        $quote = new FuelQuotePractice($db_name);
        $quote->add_quote('Acme Inc', 'TX', 'Houston', '123 Main St.');
        $quote->add_quote('Globex Corp', 'CA', 'Los Angeles', '456 Elm St.');
        $quotes = $quote->get_all_quotes();
        $this->assertCount(2, $quotes);
        $this->assertEquals('Acme Inc', $quotes[0]['company_name']);
        $this->assertEquals('TX', $quotes[0]['state']);
        $this->assertEquals('Houston', $quotes[0]['city']);
        $this->assertEquals('123 Main St.', $quotes[0]['address']);
        $this->assertEquals('Globex Corp', $quotes[1]['company_name']);
        $this->assertEquals('CA', $quotes[1]['state']);
        $this->assertEquals('Los Angeles', $quotes[1]['city']);
        $this->assertEquals('456 Elm St.', $quotes[1]['address']);
    }
    public function testGetLastQuoteLocation() {
        $db_name = ':memory:';
        $quote = new FuelQuotePractice($db_name);
        $quote->add_quote('Acme Inc', 'TX', 'Houston', '123 Main St.');
        $quote->add_quote('Globex Corp', 'CA', 'Los Angeles', '456 Elm St.');
        $location = $quote->get_last_quote_location();
        $this->assertEquals('Los Angeles', $location['city']);
        $this->assertEquals('CA', $location['state']);
    }
    public function testGetNumQuotes() {
        $db_name = ':memory:';
        $quote = new FuelQuotePractice($db_name);
        $quote->add_quote('Acme Inc', 'TX', 'Houston', '123 Main St.');
        $quote->add_quote('Globex Corp', 'CA', 'Los Angeles', '456 Elm St.');
        $this->assertEquals(2, $quote->get_num_quotes());
    }
    public function testIsValidState() {
        $fq = new FuelQuotePractice();
        $this->assertTrue($fq->is_valid_state('TX'));
        $this->assertFalse($fq->is_valid_state('Texas'));
        $this->assertFalse($fq->is_valid_state('TX1'));
    }

    public function testIsValidCity() {
        $fq = new FuelQuotePractice();
        $this->assertTrue($fq->is_valid_city('Houston'));
        $this->assertTrue($fq->is_valid_city('San Antonio'));
        $this->assertTrue($fq->is_valid_city('New York'));
        $this->assertFalse($fq->is_valid_city('Houston, TX'));
        $this->assertFalse($fq->is_valid_city('H0uston'));
    }
    public function testIsValidAddress() {
        $fq = new FuelQuotePractice();
        $this->assertTrue($fq->is_valid_address('123 Main St.'));
        $this->assertTrue($fq->is_valid_address('500 5th Ave., Suite 1200'));
        $this->assertFalse($fq->is_valid_address('123 Main St #456'));
        $this->assertFalse($fq->is_valid_address('123 Main St.!'));
    }
}
?>