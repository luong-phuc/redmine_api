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

Add more Time Log for Issue {issue id} :

```
php TimeLog.php add {issue id}
```

Add more Time Log for Issue {issue id} with spent_on:

```
php TimeLog.php add {issue id} {spent on}
```

Delete Time Log Id {log id} of Issue {issue id} :


```
php TimeLog.php del {issue id} {log id}
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
