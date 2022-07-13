### 環境構築
* Macの場合
```
brew install php@バージョン
```

```
brew install composer
```

```
cd php_training/
```

```
composer install
```

```
cp .env.example .env
```

```
mysql -uroot
mysql> CREATE DATABASE php_training;
```

```
php artisan migrate
```

```
php artisan serve
```

### ユーザーの作成方法

```
php artisan tinker

>>> $user = new User();
>>> $user->name = "username";
>>> $user->email = "mail@example.com";
>>> $user->password = Hash::make('password');
>>> $user->save();
```