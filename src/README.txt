=========================================================
                Assessment Website
                 Working Prototype
	          _________________________

---------------------------------------------------------
     This README has been generated with the focus of
   simplifying navigation of the website and making the
      purpose of the site structure understandable.
			
   Please read beyond the Navigation segment below to see
    instructions on how to use the website in a
	            step-by-step tutorial.
---------------------------------------------------------

                     ACCESS RIGHTS

RANKS:
  0 - Admin
  1 - Content moderator
  2 - Customer


NOTE: In order to set up an admin account, you must have
      access & editing rights to the MySQL database.

      After gaining access to the database, modify the
      intended admin account to have rank 0.
_________________________________________________________

                                                      _                 _
                                    __  _            |_|            _  |_| 
                                   |  \| | __ ___   ___  __ _  __ _| |_ _  ___  _ ___
                                   | \ | |/ _` \ \ / / |/ _` |/ _` | __| |/ _ \| '_  \ 
                                   | |\  | (_| |\ V /| | (_| | (_| | |_| | (_) | | | |
                                   |_| \_|\__,_| \_/ |_|\__, |\__,_|\__|_|\___/|_| |_|
                                                         __/ |
                                                        |___/ 
 _________________________________________________________________________________________________________________
|                                               FOLDER STRUCTURE                                                  |
|                                                                                                                 |
|=================================================================================================================|
|[ Root folder - prototypeSite ]----------> --------------------- WEBSITE ROOT FOLDER ----------------------------|
|  |                                                                                                              |
|--'___[ Child folder - control ]---------> SERVER-SIDE SCRIPTS, FUNCTIONS, AND CLASS DEFINITIONS-----------------|
|  |               |                                                                                              |
|  |               |                                                                                              |
|  |               '_____,[ dbConnect ]---> PHP file for establishing a PDO connection to the MySQL database.     |
|  |               |                                                                                              |
|  |               '_____,[ functions ]---> Miscellaneous PHP functions for proper functionality.                 |
|  |               |                                                                                              |
|  |               '_____,[ objects ]-----> PHP files for defining classes.                                       |
|  |               |                                                                                              |
|  |               '_____,[ process ]-----> PHP processing files to validate and store data from forms.           |
|  |                                                                                                              |
|  |                                                                                                              |
|  |                                                                                                              |
|--'___,[ Child folder - display ]-----> CONTENT TO BE DISPLAYED TO USER------------------------------------------|
|                 |                                                                                               |
|                 |                                                                                               |
|                 '_____,[ css ]-------> Site CSS files.                                                          |
|                 |                                                                                               |
|                 '_____,[ img ]-------> User-uploaded images.                                                    |
|                 |                                                                                               |
|                 '_____,[ js ]--------> Javascript files for form-validation and other client-end scripts.       |
|                 |                                                                                               |
|                 '_____,[ require ]---> Code snippets for frequent-use HTML/PHP.                                 |
|                 |                                                                                               |
|                 '_____,[ sites ]-----> Site structure files.                                                    |
|                                                                                                                 |
|=================================================================================================================|
|                                              URL NAVIGATION                                                     |
|                                                                                                                 |
'================================================================================================================='
| . = Site root folder                                                                                            |
|                                                                                                                 |
| ./index.php                           :: REDIRECT - Leads to site index page                                    |
| ./display/index.php                   :: REDIRECT - Leads to site index page                                    |
| ./display/sites/site_index.php        :: Site index page                                                        |
| ./display/sites/site_login.php        :: Site login page                                                        |
| ./display/sites/auction.php           :: Auction details page - INCOMPLETE                                      |
| ./display/sites/auctions_index.php    :: Site index page                                                        |
| ./display/sites/user_config.php       :: User configuration page                                                |
|                                                                                                                 |
'_________________________________________________________________________________________________________________'


 ________________________________________________________________
|                         HOW-TO                                 |
|LOGIN TO THE SITE                                               |
|  1.  Navigate to the site login page                           |
|  2.  Enter login credentials, or register an account           |
|  1.  If not registering, click 'Login'                         |
|  3.  If registering, click Register, and follow steps 1 - 3    |
|      with new login credentials                                |
|                                                                |
|MODIFY AUCTION DETAILS                                          |
|  This requires you to be logged in as either admin or a        |
|  content moderator.                                            |
|                                                                |
|  1. Once signed in, click 'Edit'                               |
|  2. Modify whichever form input fields to satisfy the          |
|     intended cause of modification                             |
|  3. Click 'Change'                                             |
|                                                                |
|                                                                |
|DELETE AUCTION                                                  |
|  This requires you to be logged in as either admin or a        |
|  content moderator.                                            |
|                                                                |
|  1. Once signed in, click 'Edit'                               |
|  2. Confirm that you want to delete the auction by             |
|     clicking 'OK'.                                             |
|                                                                |
'________________________________________________________________'


                                         _____
                                        |_   _|___ ___ _   __  ___  ___ 
                                          | | / __/ __| | |  |/ _ \/ __|
                                         _| |_\__ \__ \ |/ | |  __/\__ \
                                        |_____|___/___/___/|_|\___||___/


.-----------------------------------------------[UNRESOLVED]-----------------------------------------------------.
|                                                                                                                |
|  -  Editing auctions may occassionally not successfully edit, possibly from a session error.                   |
|  -  Errors don't seem to be displaying from time to time, also possibly a session error.                       |
|  -  No errors have been defined for throwing errors for Javascript XMLHTTPRequests.                            |
|                                                                                                                |
'----------------------------------------------------------------------------------------------------------------'

 ________________________________________________[SOLVED]________________________________________________________
|                                                                                                                |
| -  Users cannot bid to auctions                                                                                |
| -  Removing bids from auction in bids table attempts to delete bid in a different row                          |
| -  Users can add bids for lower than the starting/current bid                                                  |
|                                                                                                                |
'________________________________________________________________________________________________________________'