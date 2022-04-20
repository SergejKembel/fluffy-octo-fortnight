<p align="center">
    <img alt="project-logo" src="./.github/meta/project_logo.svg">
</p>
<h1 align="center">Welcome to fluffy-octo-fortnight 👋</h1>
<p>
  <img alt="Version" src="https://img.shields.io/badge/version-Alpha 0.1-blue.svg?cacheSeconds=2592000" />
  <a href="#" target="_blank">
    <img alt="License: Apache License 2.0" src="https://img.shields.io/badge/License-Apache License 2.0-yellow.svg" />
  </a>
<img alt="GitHub Workflow Status" src="https://img.shields.io/github/workflow/status/sergejkembel/fluffy-octo-fortnight/Laravel%20application%20testing%20(Mysql)?label=Laravel%20Tests">
<a href=""><img src="https://img.shields.io/badge/Documentation-Click%20me-blue.svg" alt="Read the Documentation"></a>
  <a href="https://twitter.com/sergej_kembel" target="_blank">
    <img alt="Twitter: sergej_kembel" src="https://img.shields.io/twitter/follow/sergej_kembel.svg?style=social" />
  </a>
</p>

> An example project to prove my knowledge.

> These are the requirements:
>
> > Build an API to display and store the following information:
> > ```
> > eventTitle
> > eventDate
> > eventCity
> > 
> > tickets[].barcode (alphanumeric, eight digits maximum)
> > tickets[].firstName 
> > tickets[].lastName
> > ```
> > The data does not have to be stored in a database but can be stored at runtime. It should be ensured that the SOLID principles are observed, so that, for example, the data stored at runtime could be exchanged for a database by making small adjustments.
> >
> > What also needs to be done:
> > - [ ] Dockerize laravel application into a image based on current version
> > - [x] Make a OpenAPI Specification that can be imported in postman for manual api testing

## Install

```sh
# start dev environment
vendor/bin/sail up -d
```

## Usage

```sh
# open bash in container
vendor/bin/sail bash
```

## Run tests

```sh
vendor/bin/sail artisan test
```

## Author

👤 **Sergej Kembel**

* Github: [@sergejkembel](https://github.com/sergejkembel)
* LinkedIn: [@sergej-kembel](https://linkedin.com/in/sergej-kembel)

## Show your support

Give a ⭐️ if this project helped you!
