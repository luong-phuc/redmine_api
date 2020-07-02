# redmine_api

## Information

API SDK : https://github.com/kbsali/php-redmine-api  
Redmine API : https://www.redmine.org/projects/redmine/wiki/rest_api


## Setup

1. copy file .env.example to .env
2. add more infor for .env ( if you has authenticate, please input all username,password and auth_key )


## How use API Time Log:

View Time Log of Issues :

```
php TimeLog.php view
```

Add more Time Log for Issue 12345 :

```
php TimeLog.php add 12345
```

Delete Time Log Id 12345 of Issue 54321 :


```
php TimeLog.php del 54321 12345
```

## How use API Issue:

View Issue Information :

```
php Issues.php view {issue id}
```

Update Status for Issue :

```
php Issues.php update_status {issue id} {status id}
```
