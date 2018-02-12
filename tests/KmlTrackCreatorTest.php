<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Aghayev\KmlTrackCreator;

class KmlTrackCreatorTest extends TestCase {

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testKmlTrackCreator() {

        $myKmlWriter = new KmlTrackCreator();

        // Append Name
        $params = [];
        $params['template'] = 'TARGET HISTORY LOCATION BETWEEN [%s] AND [%s]';
        $params['start'] = 'A';
        $params['end'] = 'B';
        $myKmlWriter->appendName($params);

        // Append Style
        $targets = [1, 2, 3];
        $myKmlWriter->appendStyle($targets);

        // Append Place
        $place[1]['target_id'] = 1;
        $place[1]['name'] = 'Start';
        $place[1]['last_position'] = false;
        $place[1]['index'] = 1;
        $place[1]['coordinates'] = '-122.2442883478408,37.4347536724074,0';
        $place[1]['description'] = 'Start Position<br/>I started from here';

        $place[2]['target_id'] = 2;
        $place[2]['name'] = 'Continue';
        $place[2]['last_position'] = false;
        $place[2]['index'] = 2;
        $place[2]['coordinates'] = '-122.2417741446485,37.43594997501623,0';
        $place[2]['description'] = 'Continue Position<br/>I continue here';

        $place[3]['target_id'] = 3;
        $place[3]['name'] = 'Stop';
        $place[3]['last_position'] = true;
        $place[3]['index'] = 3;
        $place[3]['coordinates'] = '-122.2414951359056,37.43611878445952,0';
        $place[3]['description'] = 'Stop Position<br/>I stop from here';

        foreach ($place as $placeParams) {
            $myKmlWriter->appendPlaceToFolder($placeParams);
        }

        // Generate
        $this->assertEmpty($myKmlWriter->generate());
    }
}