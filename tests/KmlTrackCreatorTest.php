<?php

use Aghayev\KmlTrackCreator\KmlTrackCreator;
use PHPUnit\Framework\TestCase;

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

        // Match
        $this->assertXmlStringEqualsXmlString(
          $myKmlWriter->generate(), '<?xml version="1.0" encoding="UTF-8"?>
<kml xmlns="http://www.opengis.net/kml/2.2">
  <Document>
    <name>TARGET HISTORY LOCATION BETWEEN [A] AND [B]</name>
    <Style id="waypoint">
      <LabelStyle>
        <scale>0.9</scale>
        <color>ff00ff0c</color>
      </LabelStyle>
      <IconStyle>
        <Icon>
          <href>http://maps.google.com/mapfiles/kml/pal4/icon61.png</href>
          <x>64</x>
          <y>128</y>
          <w>32</w>
          <h>32</h>
        </Icon>
      </IconStyle>
    </Style>
    <Style id="track1">
      <LineStyle>
        <width>5</width>
        <color>64eeee17</color>
      </LineStyle>
      <LabelStyle>
        <scale>0.9</scale>
        <color>ff00ff0c</color>
      </LabelStyle>
      <IconStyle>
        <Icon>
          <href>http://maps.google.com/mapfiles/kml/pal4/icon62.png</href>
          <x>64</x>
          <y>128</y>
          <w>32</w>
          <h>32</h>
        </Icon>
      </IconStyle>
    </Style>
    <Style id="track2">
      <LineStyle>
        <width>5</width>
        <color>7d0000ff</color>
      </LineStyle>
      <LabelStyle>
        <scale>0.9</scale>
        <color>ff00ff0c</color>
      </LabelStyle>
      <IconStyle>
        <Icon>
          <href>http://maps.google.com/mapfiles/kml/pal4/icon62.png</href>
          <x>64</x>
          <y>128</y>
          <w>32</w>
          <h>32</h>
        </Icon>
      </IconStyle>
    </Style>
    <Style id="track3">
      <LineStyle>
        <width>5</width>
        <color>afff0000</color>
      </LineStyle>
      <LabelStyle>
        <scale>0.9</scale>
        <color>ff00ff0c</color>
      </LabelStyle>
      <IconStyle>
        <Icon>
          <href>http://maps.google.com/mapfiles/kml/pal4/icon62.png</href>
          <x>64</x>
          <y>128</y>
          <w>32</w>
          <h>32</h>
        </Icon>
      </IconStyle>
    </Style>
    <Folder>
      <name><![CDATA[Start]]></name>
      <Placemark>
        <name><![CDATA[Start (1)]]></name>
        <description><![CDATA[Start Position<br/>I started from here]]></description>
        <styleUrl>#waypoint</styleUrl>
        <Point>
          <coordinates>-122.2442883478408,37.4347536724074,0</coordinates>
        </Point>
      </Placemark>
      <Placemark>
        <name><![CDATA[Continue (2)]]></name>
        <description><![CDATA[Continue Position<br/>I continue here]]></description>
        <styleUrl>#waypoint</styleUrl>
        <Point>
          <coordinates>-122.2417741446485,37.43594997501623,0</coordinates>
        </Point>
      </Placemark>
      <Placemark>
        <name><![CDATA[Stop (3)]]></name>
        <description><![CDATA[Stop Position<br/>I stop from here]]></description>
        <styleUrl>#track3</styleUrl>
        <Point>
          <coordinates>-122.2414951359056,37.43611878445952,0</coordinates>
        </Point>
      </Placemark>
      <Placemark>
        <name>Path</name>
        <styleUrl>#track3</styleUrl>
        <LineString>
          <coordinates>-122.2442883478408,37.4347536724074,0
-122.2417741446485,37.43594997501623,0
-122.2414951359056,37.43611878445952,0
</coordinates>
        </LineString>
      </Placemark>
    </Folder>
  </Document>
</kml>');
    }
}
