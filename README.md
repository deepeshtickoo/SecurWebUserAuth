# Login-Webpage
<h1>For database connection</h1>
Change information on the databaseCon.php to configure your database.

<h1>Database Table Structure</h1>
CREATE TABLE `users` (<br>
  `username` text NOT NULL PRIMARY,<br>
  `password` text NOT NULL,<br>
  `status` text NOT NULL,<br>
  `country` text NOT NULL,<br>
  `firstname` text NOT NULL,<br>
  `lastname` text NOT NULL,<br>
  `email` text NOT NULL,<br>
  `children` int(11) NOT NULL<br>
)<br>

<h1>Admin Access vs Regular Access</h1>

temp.txt file is a list of Admin emails who have access to the admin portal. Accounts created with the emails in the text file will have Admin privileges.
