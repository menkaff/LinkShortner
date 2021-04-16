---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://ShortnerLink.test/docs/collection.json)

<!-- END_INFO -->

#general


<!-- START_4fb33e62cdf2404b0d17d47c06d82b91 -->
## Display a listing of the Links.

> Example request:

```bash
curl -X GET \
    -G "http://ShortnerLink.test/api/shortner-link/v0/links" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://ShortnerLink.test/api/shortner-link/v0/links"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/shortner-link/v0/links`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `page` |  optional  | optional . Example : 0 starts from zero
    `per_page` |  optional  | optional . Example : 10

<!-- END_4fb33e62cdf2404b0d17d47c06d82b91 -->

<!-- START_b9daf4e147b99e5897b47db16d489e84 -->
## Store a Link.

> Example request:

```bash
curl -X POST \
    "http://ShortnerLink.test/api/shortner-link/v0/links/store" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"main_link":"sint"}'

```

```javascript
const url = new URL(
    "http://ShortnerLink.test/api/shortner-link/v0/links/store"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "main_link": "sint"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/shortner-link/v0/links/store`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `main_link` | required |  optional  | . Example : https://laravel.com/
    
<!-- END_b9daf4e147b99e5897b47db16d489e84 -->

<!-- START_c4b6dcffb1967b20739985b66e02a68c -->
## Update a Link.

> Example request:

```bash
curl -X POST \
    "http://ShortnerLink.test/api/shortner-link/v0/links/update" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"link":"odit"}'

```

```javascript
const url = new URL(
    "http://ShortnerLink.test/api/shortner-link/v0/links/update"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "link": "odit"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/shortner-link/v0/links/update`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `link` | required |  optional  | . Example : https://laravel.com/
    
<!-- END_c4b6dcffb1967b20739985b66e02a68c -->

<!-- START_3e14b696df6a878345188477836e7f3d -->
## Retirve short link
[write short link in url]

> Example request:

```bash
curl -X GET \
    -G "http://ShortnerLink.test/api/shortner-link/v0/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://ShortnerLink.test/api/shortner-link/v0/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/shortner-link/v0/{short_link}`


<!-- END_3e14b696df6a878345188477836e7f3d -->

<!-- START_1f14a96cf9e01c7d3d958c8874eecb53 -->
## Retirve short link from Database
[write short link in url]

> Example request:

```bash
curl -X GET \
    -G "http://ShortnerLink.test/api/shortner-link/v0/database/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://ShortnerLink.test/api/shortner-link/v0/database/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/shortner-link/v0/database/{short_link}`


<!-- END_1f14a96cf9e01c7d3d958c8874eecb53 -->


