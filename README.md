# laravel-twitter-clone-webapp

ユーザ認証を備えたシンプルなTwitter風のWebアプリケーションです。  
ユーザはログインして自分のツイートを投稿し、他のユーザのツイートにコメントやいいねをすることができます。  
ユーザ同士でフォローをすることで、フォローしているユーザのツイートのみが表示されるタイムラインを利用できます。

# DEMO



https://github.com/RyunosukeSekido/laravel-twitter-clone-webapp/assets/69836702/59457688-e31f-4b9f-b03b-a8ba307071f0


# Versions

* PHP 8.1.20
* Laravel 9.52.16
* nginx 1.20.2
* MySQL 8.0.32

# Usage

1. リポジトリのクローン
```
git clone https://github.com/RyunosukeSekido/laravel-twitter-clone-webapp.git
```

2. Makefileを使って環境を構築
```
make install
```

3. ソースコードのビルド
```
docker compose exec app bash
npm run build
```

[http://127.0.0.1:8080/register](http://127.0.0.1:8080/register)にアクセスすると、アカウント新規登録画面へ遷移します。

# Directory Structure

```shell-session
.
├── docker
│   ├── mysql
│   │   ├── Dockerfile
│   │   └── my.cnf
│   ├── nginx
│   │   └── default.conf
│   └── php
│       ├── Dockerfile
│       └── php.ini
├── src
│   └── Laravelのルートディレクトリ
├── Makfile 
├── README.md 
└── docker-compose.yml
```

