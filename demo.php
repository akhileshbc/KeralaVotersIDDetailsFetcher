<?php
	// --------------------------------------
	// DEMO Code on how to use this function!
	// --------------------------------------
	

	include 'voters_id/code.php';	// this file should be included.
	
	
	//------------------------------------------------------------------------------------------------------------------
	/*
	*  @paramter 		- ID card number
	*  @return values 	- array with name and guardian name
	*
	*  eg: $details = getVotersIDDetails('xxxxxxx');
	*
	*  		echo $details['name'];    		--> prints name of id card holder
	*		echo $details['guardian_name']; --> prints name of the guardian
	*/
	
	
	$details = getVotersIDDetails( 'xxxxx' ); //eg: ICR123456
	if( $details !== false )	// check whether we were successfully able to fetch the data
	{
		var_dump( $details );
	}
	
	
	
	//------------------------------------------------------------------------------------------------------------------
	//==================================================================================================================
	//------------------------------------------------------------------------------------------------------------------
	
	
	/*
	*  @1st paramter 	- ID card number
	*  @2nd parameter	- TRUE, to fetch more details
	*  @return values 	- array with name, guardian(mom/dad), guardian's name, age, house name
	*
	*  eg: $details = getVotersIDDetails('xxxxxxx', TRUE);
	*
	*  		echo $details['id'];    		--> id card number
	*  		echo $details['name'];    		--> prints name of id card holder
	*  		echo $details['age'];    		--> age of the card holder at the time of issuing the card
	*  		echo $details['guardian'];    	--> whether it's mother or father
	*		echo $details['guardian_name']; --> prints name of the guardian
	*  		echo $details['house_name'];  	--> house name of the card holder
	*/
	
	
	$details = getVotersIDDetails( 'xxxxxxx', TRUE ); //eg: ICR123456
	if( $details !== false )	// check whether we were successfully able to fetch the data
	{
		var_dump( $details );
	}
	
	
	//------------------------------------------------------------------------------------------------------------------
?>