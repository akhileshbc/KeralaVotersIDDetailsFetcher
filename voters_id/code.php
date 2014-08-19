<?php
/*
	===================================================================================================================================
	Kerala Voter's ID Details Fetcher
	---------------------------------
	For one of my projects, the client suggested to add a facility to validate user supplied Voter's ID number. 
	Manual verification was a tedious task since there are lots of users and the client wants it to be automated.
	Since I wasn't aware of any existing API of Kerala Election Commision, 
	I thought of writing one myself that fetches ID card details from www.ceo.kerala.gov.in
	Then thought of publishing it in GitHub, so that it would be useful for other developers who needs this functionaility.
	
	As an addon I used, PHP Simple HTML Dom Parser(http://simplehtmldom.sourceforge.net/). 
	Because I have to parse the HTML obtained after accessing the election commission's site, to pull details about the Voter's ID !
	
	You could use this function in your free/commercial projects.
	
	By,
		Akhilesh.B.Chandran
		
		Email: 		abcthedeveloper@gmail.com
		Facebook: 	www.facebook.com/akhileshbc
		Website:	www.akhileshbc.com
	===================================================================================================================================
*/	

	/*	@function name 	- getVotersIDDetails() 
	*	@parameters 	- 
	*					 |	$id 			-- voter's id
	*					 |	$getAllDetails 	-- (default = FALSE) use TRUE to fetch more details(ie. name, guardian's name, age, housename)
	*	@return			- 
	*					 |	FALSE, if not successful in fetching the details
	*					 |	associative array, containing the details if successful
	*/
	
	function getVotersIDDetails($id, $getAllDetails = false)
	{
		//--- Check whether an ID is there in the database of Election Commision
		$url = "http://www.ceo.kerala.gov.in/electoralroll/edetailListAjax.html?epicNo={$id}";
		
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $url,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_POST => FALSE
		));
		$resp = curl_exec($curl);
		curl_close($curl);
		
		if($resp === false)
			return false;
		else{	
		
			$resp = json_decode($resp, true );
			if(!empty($resp['errors']) || empty($resp['aaData']))
				return false;
			else	//--- ID card exists !
			{
				if(! $getAllDetails)	//--- If we need only to check the name associated with the ID, we could fetch the name got while searching the databse
				{
					return array(
									'name' 			=> $resp['aaData'][0][0],
									'guardian_name' => $resp['aaData'][0][1]
								);
				}
				else					//--- Otherwise, if more details is needed, we could fetch that too (this part is heavier than the above one. Because this one needs another call to the page, then parse the html to get the content, etc)
				{
					try{
						if(preg_match('/paramValue\=(.*?)\"/', $resp['aaData'][0][6], $match))
						{
							$url = "http://www.ceo.kerala.gov.in/searchDetails.html?paramValue=" . $match[1];
							
							$curl = curl_init();
					
							curl_setopt_array($curl, array(
								CURLOPT_RETURNTRANSFER => 1,
								CURLOPT_URL => $url,
								CURLOPT_SSL_VERIFYPEER => false,							
								CURLOPT_POST => FALSE
							));

							$resp = curl_exec($curl);
							curl_close($curl);
													
							include 'simple_html_dom.php';
							$html = str_get_html($resp);						
							
							$rows = $html->find('form[id=command] table tr');
							
							return array(
											'id' 			=> trim($rows[0]->children(1)->plaintext),
											'name'			=> trim($rows[1]->children(1)->plaintext),
											'age'			=> trim($rows[2]->children(1)->plaintext),
											'guardian' 		=> explode("&#039;", trim($rows[3]->children(0)->plaintext))[0],
											'guardian_name' => trim($rows[3]->children(1)->plaintext),
											'house_name' 	=> trim(explode("/&nbsp;", trim($rows[4]->children(1)->plaintext))[1])
										);
						}
						else
							return false;
					} 
					catch (Exception $e) 
					{
						return false; // do nothing
					}
				}
			}
		}			
	}
	
?>

