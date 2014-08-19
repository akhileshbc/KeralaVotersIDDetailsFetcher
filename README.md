# Kerala Voter's ID Details Fetcher
	
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