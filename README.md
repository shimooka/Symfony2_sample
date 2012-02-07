Symfony2サンプル
================

Symfony2を使ったサンプルです。

インストール
------------

    mkdir -p app/cache app/logs
    sudo setfacl -R -m u:nobody:rwx -m u:mobylog:rwx app/cache app/logs
    sudo setfacl -dR -m u:nobody:rwx -m u:mobylog:rwx app/cache app/logs
    cp -p app/config/parameters.ini-dist app/config/parameters.ini
    php bin/vender install

Bundle
------

### Acme/AndRoleVoterBundle
   - [Symfony2で権限の組み合わせを満たす場合のみアクセスを許可したい - Do You PHP はてな](http://d.hatena.ne.jp/shimooka/20120201/1328093870)を参照
   - security.access.role_hierarchy_voter.classを上書きして権限のチェックロジックを差し替える例

###  Acme/TransportBundle
   - [Symfony2 service container: how to make your service use tags | PHP & Symfony](http://php-and-symfony.matthiasnoback.nl/2011/10/symfony2-service-container-how-to-make-your-service-use-tags/)を元にしたサンプル

###  Acme/ResponseListenerBundle
   - [Symfony2: create a response filter and set extra response headers | PHP & Symfony](http://php-and-symfony.matthiasnoback.nl/2011/10/symfony2-create-a-response-filter-and-set-extra-response-headers/)を元にしたサンプル
   - _formatがcsvの場合にContent-Type、Content-Dispositionの各ヘッダを設定するEventListenerを追加する例
   - "/"にアクセスした場合、所定のActionにforwardする
   - Routeアノテーションの記述例
