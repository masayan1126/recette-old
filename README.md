# Recette

- 献立が楽しくなるアプリ

# Features

- トップ画面から、マイレシピ、新着レシピ、旬のレシピなどのレシピ一覧がすぐに見れます
- レシピのブックマーク機能を使えば、お気に入り登録をカンタンに行うことができます
- レシピや食事のキーワード検索からレシピを探すことができます
- レシピをカテゴリ別に探したり、面倒な日は献立くん(AI)にレシピの提案を任せることができます

# Requirement

- php 7.3
- Laravel Framework 8.12
- axios 0.21
- bootstrap 4.0.0"
- laravel/framework 7.0
- vue 3.0.5
- vuex 4.0.0

# Installation

Docker デスクトップアプリを起動します。

```
git clone https://github.com/masayan1126/recette.git
```

```
cd recette
```

```
docker-compose up -d
```

```
docker-compose exec php sh
```

```
cd recette
```

```
composer install
```

```
cp .env.example .env && vi .env
```

```
APP_NAME=Recette
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=recipe_db
DB_USERNAME=root
DB_PASSWORD=root

SESSION_DRIVER=database
SESSION_LIFETIME=1440

MAIL_MAILER=smtp
MAIL_HOST=mailcatcher
MAIL_PORT=1025
MAIL_USERNAME={yourusername}
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS={yourmailadress}
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=AKIAWBYEGB4YU4E2SWZ7
AWS_SECRET_ACCESS_KEY=yYGOuqr1kzB5Yd0Gf8DTnOqkowsH/Dc+RV2hkSER
AWS_DEFAULT_REGION=ap-northeast-1
AWS_BUCKET=recipe-img-bucket
```

```
php artisan key:generate
```

```
php artisan migrate && php artisan db:seed
```

The application can then be accessed at http://localhost:8000/

# Usage

- デモユーザー
  - usernama:レシピ太郎
  - email:recipetarou@gmail.com
  - password:recipetarou4719

# Author

- name
  - @masayan1126
- email
  - masa199311266@gmail.com
