# TrekKing
TrekKing is a website developed using PHP, HTML, CSS and Javascript. The website allows users to browse through treks according to their preferences and book treks they like. The site keeps a record of all treks that the user has booked. A confirmation email is sent on successful booking of the trek. A reminder is displayed on the homepage, along with the weather forecast of the place of the trek. 
<br/>
<b>Pre-requisite-</b>
<ul>
  <li>XAMPP Software</li>
  <ul>
    <li>Apache</li>
    <li>MySQL</li>
  </ul>
  <li>Composer</li>
</ul>
<br/>
<b>Settings-</b>
<ul>
  <li><b>Put all the files in the Xampp/htdocs folder</b> (Can be accessed as url: localhost/Trekking/home.php)</li>
  <li><b>Changes in my.ini file</b> (Can be accessed through Xampp Control Panel MySQL-Config or Xampp/mysql/bin/my.ini)</li>
  <ul>
    <li>max_allowed_packet = 64M</li>
    <li>innodb_log_file_size = 256M</li>
    <li>innodb_lock_wait_timeout = 500</li>
  </ul>
  <li><b>Changes in php.ini file</b> (Can be accessed through Xampp Control Panel Apache-Config or Xampp/php/php.ini)</li>
  <ul>
    <li>max_execution_time=300</li>
    <li>display_errors=Off</li>
    <li>post_max_size=1280M</li>
    <li>upload_max_filesize=1280M</li>
    <li>sendmail_path = "\"...\Xampp\sendmail\sendmail.exe\" -t" (<b>... has to be replaced by whole path</b>)</li>
  </ul>
  <li><b>Changes in sendmail.ini file</b> (Can be accessed through Xampp/sendmail/sendmail.ini)</li>
  <ul>
    <li>smtp_server=smtp.gmail.com (<b>for Gmail</b>)</li>
    <li>smtp_port=587 (<b>for Gmail</b>)</li>
    <li>auth_username=... (<b>... has to be replaced by your email</b>)</li>
    <li>auth_password=... (<b>... has to be replaced by your password</b>)</li>
  </ul>
  <li>Import <b>trekking(2).sql</b> in localhost/phpmyadmin</li>
</ul>
<br/>
<b>Features-</b>
<ul>
  <li>Home Page where the user will get Reminders of his latest treks and the weather conditions in the area </li>
  <li>Sign-Up Page</li>
  <li>Login Page</li>
  <li>Profile Page</li>
  <li>Featured Treks Page</li>
  <li>Trek Information Page</li>
  <li>Search Page</li>
  <li>List of Treks depending upon search criteria</li>
  <li>Checkout Page</li>
</ul>
<br/>
<b>Future Scope</b>
<ul>
  <li>Mail System (using PHPMailer/SendGrid instead of PHP mail function)</li>
  <li>SMS System (using Way2SMS/TextLocal API)</li>
  <li>Google Login System</li>
  <li>Payment System (using PayPal API)</li>
  <li>Realtime Notifications (using Pusher & toastr.js)</li>
  <li>Pretty URLs</li>
  <p>(removing .php in url by uncommenting mod_rewrite.so in Xampp/apache/conf/httpd.conf & creating '.htaccess' named file in our Project folder & writing rules using regular expressions in it)</p>
  <li>Security Measures</li>
  <li>Group Bookings</li>
  <li>Predicted Weather conditions for a Trek using Machine Learning or paid APIs</li>
  <li>Animations</li>
  <li>Admin Panel</li>
</ul>
<br/>

