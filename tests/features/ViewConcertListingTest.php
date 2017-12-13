<?php

use App\Concert;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ViewConcertListignTest extends TestCase
{
    use DatabaseMigrations;
    
    /** @test */
    public function user_can_view_a_published_concert_listing()
    {
        // Arrange
        $concert = Concert::create([
            'title' => 'The Red Chord',
            'subtitle' => 'Whatever',
            'date' => Carbon::parse('December 16, 2016 8:00pm'),
            'ticket_price' => 3250,
            'venue' => 'The Mosch Pit',
            'venue_address' => '123 Example Road',
            'city' => 'Laraville',
            'state' => 'ON',
            'zip' => '18z76',
            'additional_information' => 'For tickets call 000',
            'published_at' => Carbon::parse('-1 week'),
        ]);
        
        // Action
        $this->visit('/concerts/'.$concert->id);
        
        // Assertion
        $this->see('The Red Chord');
        $this->see('Whatever');
        $this->see('December 16, 2016');
        $this->see('8:00pm');
        $this->see('32.50');
        $this->see('The Mosch Pit');
        $this->see('123 Example Road');
        $this->see('Laraville');
        $this->see('ON');
        $this->see('18z76');
        $this->see('For tickets call 000');
    }

    /** @test */
    public function user_cannot_view_unpublished_concert_listings()
    {
        $concert = factory(Concert::class)->create([
            'published_at' => null
        ]);

        $this->get('/concerts/'.$concert->id);

        $this->assertResponseStatus(404);
    }
}
