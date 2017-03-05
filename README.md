# tee
__tee__ is a small application that use MVC design pattern to show how can manage access control to different user profiles and manage the users with a REST API.
## Instaling
__tee__ don't need special instalation just copy the content into a valid web content directory
## Running
__tee__ runs in any webserver that support PHP. The required version to run Tee is PHP 5.5 or greather. Also you can use PHP biuld-in server to tun tee.

```
$ cd tee/
$ php -S localhost:8080
PHP 5.5 Development Server started at Sun Mar 5 13:05:31 2017
Listening on http://localhost:8080
Document root is /home/foo/tee
Press Ctrl-C to quit.
```
Now, you can access with your browser to http://localhost:8080 and see the login page.

## Default Users ##
* P1
  * Username: p1
  * Password: 123123
  * Role: page1
  * User p1 only can access to "Page1"
* P2
  * Username: p2
  * Password: 123123
  * Role: page2
  * User p2 only can access to "Page2"
* P3
  * Username: p3
  * Password: 123123
  * Role: page3
  * User p3 only can access to "Page3"
* FULL
  * Username: full
  * Password: 123123
  * Role: page1, page2, page3
  * User p2 can access to Page1, Page2 and Page3
* Admin
  * Username: admin
  * Password: 123123
  * Role: page1, page2, page3, admin
  * User p2 can access to Page1, Page2, Page3 and full access to the API
