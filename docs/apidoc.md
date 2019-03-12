#User Management System API

#Table of Contents <a name="toc"></a>

1. [Users](#Users)
	- [Create User](#cu)
	- [Get Users](#gul)
	- [Delete User](#du)
	- [User Auth](#ua)
	- [Assign User to group](#aug)
	- [Remove User from group](#rug)
2. [Groups](#Groups)
	- [Create Group](#cn)
	- [Get Groups](#gnl)
	- [Delete Group](#dn)
3. [Error response](#er)

### Create User <a name="cu"></a> ([Top](#toc))
#### [http://127.0.0.1/api/users](http://127.0.0.1/api/users)
#### Request type - POST
##### Headers
header-data |Data Type | Description | Required
--- | --- | --- | ---
Authorization | string | JWT token | YES
##### POST Parameters
form-data |Data Type | Description | Required
--- | --- | --- | ---
name | string | Text content | YES
email | email | Email | YES
password | password | Password | YES

```
{
    "message": "User created successfully",
    "data": {
        "id": 4,
        "name": "Pasa",
        "email": "pasa2@test.test",
        "groups": []
    }
}
```
```
{
    "error": true,
    "causes": {
        "email": "The email must be a valid email address."
    }
}
```
```
{
    "error": true,
    "causes": {
        "email": "The email has already been taken."
    }
}
```
### Get Users <a name="gul"></a> ([Top](#toc))
#### [http://127.0.0.1/api/users](http://127.0.0.1/api/users)
#### Request type - GET
##### Headers
header-data |Data Type | Description | Required
--- | --- | --- | ---
Authorization | string | JWT token | YES
```
{
    "data": {
        "data": [
            {
                "id": 1,
                "name": "Pasa",
                "email": "pasa@test.test",
                "groups": [
                    "Admin"
                ]
            },
            {
                "id": 4,
                "name": "Pasa",
                "email": "pasa2@test.test",
                "groups": []
            }
        ],
        "paginate": {
            "current_page": 1,
            "per_page": 15,
            "total_in_page": 2,
            "total_page": 1,
            "total": 2
        }
    }
}
```

### Delete User <a name="du"></a> ([Top](#toc))
#### [http://127.0.0.1/api/users/{id}](http://127.0.0.1/api/users/{id})
#### Request type - DELETE
##### Headers
header-data |Data Type | Description | Required
--- | --- | --- | ---
Authorization | string | JWT token | YES
##### DELETE Parameters
form-data |Data Type | Description | Required
--- | --- | --- | ---
id | int| User ID | YES

```
{
    "message": "User deleted successfully"
}
```
```
{
    "error": true,
    "message": "User not found"
}
```

### User Auth <a name="ua"></a> ([Top](#toc))
#### [http://127.0.0.1/api/auth/login](http://127.0.0.1/api/auth/login)
#### Request type - POST
##### POST Parameters
form-data |Data Type | Description | Required
--- | --- | --- | ---
email | email | Email | YES
password | password | Password | YES

```
{
    "data": {
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ1bXMtand0Iiwic3ViIjoxLCJpYXQiOjE1NTIzOTIzOTQsImV4cCI6MTU1MjQ3ODc5NH0.9GJxzgQG7FoUy37r6V3tuUU46FkmeVH-PiCwRy8qgQY"
    }
}
```
```
{
    "error": true,
    "message": "These credentials do not match our records."
}
```

### Assign User to group <a name="aug"></a> ([Top](#toc))
#### [http://127.0.0.1/api/users/{user_id}/groups/{group_id}](http://127.0.0.1/api/users/{user_id}/groups/{group_id})
#### Request type - POST
##### Headers
header-data |Data Type | Description | Required
--- | --- | --- | ---
Authorization | string | JWT token | YES
##### URI Parameters
uri-data |Data Type | Description | Required
--- | --- | --- | ---
user_id | int | User ID | YES
group_id | int | Group ID | YES

```
{
    "message": "User assigned successfully"
}
```
```
{
    "error": true,
    "message": "User not found"
}
```
```
{
    "error": true,
    "message": "Group not found"
}
```
```
{
    "error": true,
    "message": "User already assigned to this group"
}
```

### Remove User from group <a name="rug"></a> ([Top](#toc))
#### [http://127.0.0.1/api/users/{user_id}/groups/{group_id}](http://127.0.0.1/api/users/{user_id}/groups/{group_id})
#### Request type - DELETE
##### Headers
header-data |Data Type | Description | Required
--- | --- | --- | ---
Authorization | string | JWT token | YES
##### URI Parameters
uri-data |Data Type | Description | Required
--- | --- | --- | ---
user_id | int | User ID | YES
group_id | int | Group ID | YES

```
{
    "message": "User removed from group successfully"
}
```
```
{
    "error": true,
    "message": "User not found"
}
```
```
{
    "error": true,
    "message": "Group not found"
}
```
```
{
    "error": true,
    "message": "User not assigned to this group"
}
```

## Group <a name="Group"></a>
### Create Group <a name="cn"></a> ([Top](#toc))
#### [http://127.0.0.1/api/groups](http://127.0.0.1/api/groups)
#### Request type - POST
##### Headers
header-data |Data Type | Description | Required
--- | --- | --- | ---
Authorization | string | JWT token | YES
##### POST Parameters
form-data |Data Type | Description | Required
--- | --- | --- | ---
name | string | Text content | YES

```
{
    "message": "Group created successfully",
    "data": {
        "id": 3,
        "name": "Developer",
        "user_count": 0
    }
}
```
```
{
    "error": true,
    "causes": {
        "name": "The name has already been taken."
    }
}
```

### Get Groups <a name="gnl"></a> ([Top](#toc))
#### [http://127.0.0.1/api/groups](http://127.0.0.1/api/groups)
#### Request type - GET
##### Headers
header-data |Data Type | Description | Required
--- | --- | --- | ---
Authorization | string | JWT token | YES
```
{
    "data": {
        "data": [
            {
                "id": 2,
                "name": "Admin",
                "user_count": 1
            },
            {
                "id": 3,
                "name": "Developer",
                "user_count": 0
            }
        ],
        "paginate": {
            "current_page": 1,
            "per_page": 15,
            "total_in_page": 2,
            "total_page": 1,
            "total": 2
        }
    }
}
```

### Delete Group <a name="dn"></a> ([Top](#toc))
#### [http://127.0.0.1/api/groups/{id}](http://127.0.0.1/api/groups/{id})
#### Request type - DELETE
##### Headers
header-data |Data Type | Description | Required
--- | --- | --- | ---
Authorization | string | JWT token | YES
##### DELETE Parameters
form-data |Data Type | Description | Required
--- | --- | --- | ---
id | int| Group ID | YES

```
{
    "message": "Group deleted successfully"
}
```
```
{
    "error": true,
    "message": "Group not found"
}
```
```
{
    "error": true,
    "message": "Non empty group can not be deleted"
}
```

### Error response <a name="er"></a> ([Top](#toc))

```
{
	 "error": true,
	 "message": "error string"
}
```
