## Hjemmeoppgave by Daniel Sandnes

## Installasjon (Windows)

Åpne prosjektmappen i Explorer.
Skriv CMD i winduet, eller åpne CMD og naviger til prosjektmappen.
Kjør kommandoen '**composer install**'

Lag en tom MySQL-database (eventuelt bruk en egen eksisterende), for eksempel:
Installer WAMP, og gå til localhost/phpmyadmin
Trykk New og lag databasen 'hjemmeoppgave'

I prosjektmappen: 
Lag en **.env** fil i roten av prosjektmappen
kopier inn innhold fra .env.example til .env og erstatt følgende:

**DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret**

med informasjon til egen MySQL-database, f.eks. :

**DB_DATABASE=hjemmeoppgave
DB_USERNAME=root
DB_PASSWORD=**

Lagre filen og kjør følgende fra CMD:
'**php artisan key:generate**'

For å fylle database med data til dette prosjektet, kjør følgende kommando fra CMD:
'**php artisan migrate**'
'**php artisan db:seed**'

Du skal da ha fått 2 brukere: **admin@admin.no** og user@user.no (passord: admin eller user)
PS: Det går ikke an å lage admin-bruker fra prosjektet selv, dette må lages manuelt i database eller ved seeding.

**_VIKTIG_**: applikasjonen er laget med public-folderen som root, dvs. applikasjonen fungerer kun med denne som root.
Kjør kommando '**php artisan serve --port:1337**' fra prosjektmappen for å få til dette (kan bruke andre porter også).
Url-er skal være på formen: 'http://localhost:1337/auth/register'

## Hvordan bruke applikasjonen?

Dersom du har fulgt installasjonen går du til **http://localhost:1337** for å finne frem forsiden.
Herfra kan du registrere en ny bruker eller logge inn med eksisterende fra seeding.
Trykk logg inn og logg inn med e-post: admin@admin.no og passord: admin.
Du har nå mulighet til å laste opp bilder eller besøke kontrollpanelet.
Trykk last opp og velg selv om du vil hente bilder fra lokal datamaskin eller Instagram.
Etter at et bilde er lastet opp kan du besøke kontrollpanelet der du har mulighet til å godkjenne/avslå bilder.
Etter at du har godkjent et bilde kan du enten besøke forsiden eller /images for å se alle godkjente bilder.
Ellers er det bare å se seg rundt.

## Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Laravel is accessible, yet powerful, providing powerful tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

### License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
