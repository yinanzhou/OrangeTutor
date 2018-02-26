# Welcome to OrangeTutor
**OrangeTutor** is a online tutor managing portal that we are working on for Syracuse University CIS 454 Spring 2018 course.

## Team Members

 - Yinan Zhou
 - Samuel Haws
 - Kyle Ornstein
 - Marcus John

## Dependencies
 * PHP 5.6+
 * Composer (https://getcomposer.org/)
 * ThinkPHP 5.1 (https://github.com/top-think/think/tree/5.1)
 * MySQL or MariaDB
 * Google reCAPTCHA (https://www.google.com/recaptcha/)

## Installation

We provides two options for you to try out our system.

### Use the Deployed Version Maintained by Our Team

If you are a student on Syracuse University CIS 454 and you are assigned our project for your software testing assignment, instead of taking enumerous amount of time deploy our system, you can try out OrangeTutor by an already on-the-cloud deployment maintained by our team at <https://orangetutor.tk>.

We go to great length to make sure the on-the-cloud version will keep available until May 1, 2018.

Also, we would like to let you know that your password is always stored with one-way hashing using bcrypt algorthim, so we are not able to see your password. Implementation can be found inside <code>application/portal/controller/Auth.php</code>.

### Deploy Your Own OrangeTutor
#### Get reCAPTCHA API Keys

OrangeTutor utlizes Google reCAPTCHA to prevent brute force password cracking or abuse of system functions by automated software. Thus, reCAPTCHA API Keys is required.

Please obtain a pair of Google reCAPTCHA <b>V2</b> API keys at <https://www.google.com/recaptcha/>. You will need this pair of keys later.

#### SSL Certificiate for Encrypted Connection
As the system stores and processes educational information, the system is designed to serve all the connections over HTTPS. Some critical function inside the system may not work correctly without HTTPS. For example, the system by default set all cookies to be transmitted only on HTTPS connection.

##### Obtain a self-signed certificate

We suggest the following tutorial <https://www.digitalocean.com/community/tutorials/openssl-essentials-working-with-ssl-certificates-private-keys-and-csrs>

NOTE: Self-signed certificate are not trusted by client browsers by default. Browser may raise warning or even block the connection if the certificiate is not trusted.

##### Obtain a trusted certificate

You can obtain or purchase certificate for your domain from any trsuted Certificate Authority (CA). We suggest obtaining the certificate from Let's Encrypt (https://letsencrypt.org/getting-started/), which is fast and free.

#### Obtain OrangeTutor source code

If you do not already have the source code in the deployment environment, you can quickly obtain a copy by running <code>git clone git@github.com:yinanzhou/OrangeTutor.git REPLACE_HERE_WITH_PATH_YOU_WANT</code>. Please change your webserver setting accordingly. The document root should be the <code>public</code> folder inside the application root directory.


#### Set up LEMP stack

Our recommended shortcut for deployment is using Linux + Nginx + MySQL + PHP, we suggest using the following tutorial <https://www.digitalocean.com/community/tutorials/how-to-install-linux-nginx-mysql-php-lemp-stack-in-ubuntu-16-04>.

Please also install the <code>php-curl</code> library, as curl is used when connecting with Google reCAPTCHA service. On Debian/Ubuntu, you can run <code>apt-get install php-curl</code>.

You do not have to use Nginx. Please note that some of the configuration are passed via environment variable, please refer to Sample Nginx configuration File for those environment variable you need to set up.
##### Set up database
Please run the <code>install/install-db.sql</code> to establish the database tables.

Please also create a database user named "orangetutor" and grant access to "orangetutor" database.
##### Sample Nginx configuration File
Under <code>install/orangetutor-sample-nginx.conf</code> is an example configuration file for nginx deployment. Please change contents wrapped by angle brackets such as `<put your domain here>` to appropriate values.

#### Install PHP dependencies
OrangeTutor uses Composer as its dependency manager. All dependencies are recorded into <code>composer.json</code> file located in the root directory.

To install Composer, follow the documentation on <https://getcomposer.org/>.

After Composer is intalled, run <code>composer install</code> on the command line inside the application root directory.

#### Grant writing priviledge to runtime folder
Under the application root directory there is a folder named `runtime`, please grant write access for `www-data` user, which is used by php-fpm. Otherwise the system won't be able to function correctly.

You can set this by running <code>chown www-data:www-data runtime</code> under the application root directory.

#### Finish the installation
Now your own copy of OrangeTutor should be up and running. You can register an account and access the system. You will see an option to upgrade yourself to an administrator if there is no administrator in the system (which is true for new installation).

## License
Copyright 2018 Yinan Zhou

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.

Most of the codes depend on ThinkPHP 5.1 framework, which is also
licensed under the Apache License, Version 2.0. See Dependencies
section for details.
