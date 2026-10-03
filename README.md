# Mali Services Backend

API backend Laravel pour la plateforme Mali Services. Le projet centralise l'authentification, les catégories de services, la recherche d'artisans et les espaces client et professionnel.

## Fonctionnalités

- inscription et connexion avec Laravel Sanctum ;
- gestion des utilisateurs et des statuts professionnels ;
- consultation des catégories ;
- recherche d'artisans ;
- recherche d'artisans proches selon leur localisation ;
- mise à jour de la position d'un artisan authentifié ;
- routes dédiées aux espaces client, professionnel et administration.

## Stack technique

- PHP 8.3+ ;
- Laravel 13 ;
- Laravel Sanctum ;
- Spatie Laravel Permission ;
- MySQL ou SQLite selon l'environnement ;
- Docker / Laravel Sail.

## Installation

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

Avec Sail :

```bash
./vendor/bin/sail up -d
./vendor/bin/sail artisan migrate
```

## API

Les principales routes publiques sont disponibles sous `/api` :

- `POST /api/register`
- `POST /api/login`
- `GET /api/categories`
- `GET /api/artisans`
- `GET /api/artisans/proches`

Les routes protégées utilisent un token Sanctum.

## Tests

```bash
php artisan test
```

## Statut

Projet en développement actif.

## Auteur

[Ibrahim Bassoum](https://github.com/Ibrahim-bassoum)
