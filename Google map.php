               $url = 'https://maps.googleapis.com/maps/api/geocode/json?address=80933&key=AIzaSyDn_vmceMuCTkF6dVezt5G704bRXDsGQig';


               // https://maps.googleapis.com/maps/api/place/findplacefromtext/json?input=mongolian%20grill&inputtype=textquery&fields=photos,formatted_address,name,opening_hours,rating&locationbias=circle:2000@47.6918452,-122.2226413&key=AIzaSyDn_vmceMuCTkF6dVezt5G704bRXDsGQig

               https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=-33.8670522,151.1957362&radius=1500&type=restaurant&keyword=cruise&key=AIzaSyDn_vmceMuCTkF6dVezt5G704bRXDsGQig

               https://maps.googleapis.com/maps/api/place/details/json?place_id=ChIJN1t_tDeuEmsRUsoyG83frY4&fields=name,rating,formatted_phone_number&key=AIzaSyDn_vmceMuCTkF6dVezt5G704bRXDsGQig

               https://maps.googleapis.com/maps/api/place/queryautocomplete/json?key=AIzaSyDn_vmceMuCTkF6dVezt5G704bRXDsGQig&input=pizza+near%20par



			   $ch = curl_init();
			   curl_setopt($ch, CURLOPT_URL, $url);
			   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			   $geoloc = json_decode(curl_exec($ch), true); 
                echo  $url;
			   print_r($ch);
			 
			   if($geoloc===NULL){
				  echo "Please enter valid place";
				  exit;
				}
			   $lat=$geoloc['results'][0]['geometry']['location']['lat'];
			   $lng=$geoloc['results'][0]['geometry']['location']['lng'];

			   echo $lat.",". $lng;