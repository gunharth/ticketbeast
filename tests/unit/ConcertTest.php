<?php
use App\Concert;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ConcertTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    function can_get_formatted_date()
    {
        
        // Arrange
        $concert = factory(Concert::class)->create([
            'date' => Carbon::parse('2017-12-23')
        ]);

        // Action
        $date = $concert->formatted_date;

        // Assert
        $this->assertEquals('December 23, 2017', $date);
    }
}
