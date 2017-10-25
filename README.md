# Kerala Voter's ID Details Fetcher [DEPRECIATED]

**Am no longer maintaining this project**

For one of my projects, the client suggested to add a facility to validate user supplied Voter's ID number. 
Manual verification was a tedious task since there are lots of users and the client wants it to be automated.
Since I wasn't aware of any existing API of Kerala Election Commision, 
I thought of writing one myself that fetches ID card details from www.ceo.kerala.gov.in
Then thought of publishing it in GitHub, so that it would be useful for other developers who needs this functionaility.

As an addon I used, PHP Simple HTML Dom Parser(http://simplehtmldom.sourceforge.net/). 
Because I have to parse the HTML obtained after accessing the election commission's site, to pull details about the Voter's ID !

*You could use this function in your free/commercial projects.*

By,
Akhilesh.B.Chandran

---
## Usage
Copy the contents of **voters_id** folder into your project.Then include the **code.php** file in your PHP page.

```
include 'voters_id/code.php';
```

Then to get the name of the ID holder and the guardian name, call the function like this:
```
$details = getVotersIDDetails( 'xxxxx' ); //eg: ICR123456
if( $details !== false )	// check whether the fetching was successful
{
	var_dump( $details );
}
```
That **$details** variable will have either FALSE upon failure, or an associative array with ID details if it was successful in fetching the data.

To get detailed info like name, guardian(mom/dad), guardian name, age and housename, supply **TRUE** as second parameter when you call that function. ie,

```
$details = getVotersIDDetails( 'xxxxxxx', TRUE ); //eg: ICR123456
if( $details !== false )	// check whether the fetching was successful
{
	var_dump( $details );
}
```
## Screenshot

![](http://i.imgur.com/vxDIIYt.png)
