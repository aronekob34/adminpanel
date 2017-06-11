<?php 

class Google_Map
{    
    // this will only work for localhost
    // get a key for your domain at http://code.google.com/apis/maps/signup.html
    const API_KEY = 'ABQIAAAACtz_NE80X2TGxRhrXZEodBT2yXp_ZAY8_ufC3CFXhHIE1NvwkxSpKkzU5hRrn3DFeEkN1nY9netADw';

    /**
     * The url to use for geocoding
     * @var string
     */
    protected $_apiUri = 'http://maps.google.com/maps/geo';    

    /**
     * The HTTP client to use to connect to the service
     * @var Zend_Http_Client
     */
    protected $_client = null;
    
    public function __construct()
    {
        $this->_client = new Zend_Http_Client();
        $this->_client->setUri($this->_apiUri);
        $this->_client->setParameterGet('output', 'json');
        $this->_client->setParameterGet('sensor', 'false');
        $this->_client->setParameterGet('key', self::API_KEY);
    }
        
    /**
     * @param $zip - The zip code you want to look up
     * @return array of city, state, longitude, and latitude
     */
    public function getGeoDataFromZip($zip)
    {
	// the query string must be utf8_encoded.  Not a problem for just a zip, but if
        // you add more data later (like an address) then it'll matter
        $queryStr = utf8_encode($zip);
        $this->_client->setParameterGet('q', $queryStr);
        
        // make sure we return something in case some part isn't found
        $returnData = array('city' => '', 'state' => '', 'longitude' => '', 'latitude' => '');
        
        try {
           $result = $this->_client->request(Zend_Http_Client::GET);
        } catch (Exception $e) {
           throw $e;
        }
        
        if ($result->getStatus() == '200') {
            
            $data = Zend_Json::decode($result->getBody());
            
            if ($data['Status']['code'] != '200') {
                return $returnData;
            }
            
            // the state
            if (isset($data['Placemark'][0]['AddressDetails']['Country']['AdministrativeArea']['AdministrativeAreaName'])) {
                $returnData['state'] = $data['Placemark'][0]['AddressDetails']['Country']['AdministrativeArea']['AdministrativeAreaName'];	
    	    }
    		
            // the city
    	    if (isset($data['Placemark'][0]['AddressDetails']['Country']['AdministrativeArea']['SubAdministrativeArea']['Locality']['LocalityName'])) {
                $returnData['city'] = $data['Placemark'][0]['AddressDetails']['Country']['AdministrativeArea']['SubAdministrativeArea']['Locality']['LocalityName'];
    	    }
            
            // the longitude
            if (isset($data['Placemark'][0]['Point']['coordinates'][0])) {
                $returnData['longitude'] = $data['Placemark'][0]['Point']['coordinates'][0];  
            }
             
            // the latitude
            if (isset($data['Placemark'][0]['Point']['coordinates'][1])) {
                $returnData['latitude'] = $data['Placemark'][0]['Point']['coordinates'][1];  
            }
        }
        
        return $returnData;
    }
}