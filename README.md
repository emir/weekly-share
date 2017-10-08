Add URLs to Weekly Services
=================

Installation
------------

```
git clone https://github.com/emir/weekly.git
```

```
composer install
```

You need to copy .env.example to .env and update variables

```
php artisan migrate
```

API
------------

| URL 	| METHOD 	| PARAMS 	| VALIDATION ERRORS (HTTP STATUS: 422) 	| SUCCESS CODE 	|
|---------------	|--------	|---------------------------------------------------------	|-------------------------------------------------------------------------------------------------------------------------------------	|--------------	|
| /api/v1/links 	| POST 	| {"url": "https://google.com", "email": "test@test.com"} 	| {"message":"The given data was invalid.","errors":{"url":["The url field is required."], "email":["The email field is required."]}} 	| 201 	|


License
-------------

[MIT License](http://emir.mit-license.org/)