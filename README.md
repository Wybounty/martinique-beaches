# Martinique Beaches

Petite application Laravel pour gérer des plages de Martinique avec leurs communes, pagination, formulaire de contact et envoi d'email via Mailpit.

## Présentation du projet

- Liste des plages en base de données
- Ajout, modification et suppression d'une plage
- Formulaire de contact avec envoi d'email
- Import des données via des seeders / CSV

## Prérequis

- PHP 8.5
- Composer
- MySQL
- Un serveur mail local comme Mailpit

## Installation

```bash
composer install
```

Copiez ensuite le fichier `.env.example` en `.env`, puis adaptez vos variables d'environnement.

```bash
php artisan key:generate
```

```bash
php artisan migrate --seed
```

## Configuration `.env`

Voici les points importants à vérifier dans votre fichier `.env` :

```env
APP_URL=http://localhost
DB_HOST=127.0.0.1
DB_CONNECTION=mysql
DB_DATABASE=martinique_beaches
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=127.0.0.1
MAIL_PORT=1025
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

## Commandes utiles

```bash
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate:fresh --seed
php artisan test
composer run dev
```

## Fonctionnalités réalisées

- Affichage paginé des plages
- Ajout d'une plage
- Modification d'une plage
- Suppression d'une plage
- Formulaire de contact
- Envoi du message par email avec Mailpit

## Technologies utilisées

- Laravel 13
- Blade
- Eloquent ORM
- Pest
- Bootstrap 5
- Mailpit
