             


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
