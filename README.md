# COACHTECH_MOCK02

# 環境構築

## Dockerビルド
```
git clone --branch release/20250112 https://github.com/hanabi0703/COACHTECH_MOCK02.git
```

docker-compose.ymlファイルの存在する階層へ移動し以下を実行
```
docker compose up -d --build
```

## Laravel 環境構築
```
docker compose exec php bash
```
```
composer install
```
```
cp .env.example .env
```
※環境変数は適宜変更
```
php artisan key:generate
```

```
php artisan migrate
```

```
php artisan db:seed
```

## 開発環境
・商品一覧画面:http://localhost/

・ユーザー登録:http://localhost/register

・phpMyAdmin:http://localhost:8080/

## 使用技術(実行環境)
・PHP 7.4.9
・Laravel 8.83.29
・MySQL 8.0.26
・nginx 1.21.1

## ER図
![MockCase02 drawio](https://github.com/user-attachments/assets/0ff967a6-8f80-45ef-b439-1757be2b612f)

