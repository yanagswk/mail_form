## 環境構築

```bash
# Docker イメージのビルド
docker-compose build

# Docker コンテナの起動
docker-compose up -d

# Docker コンテナの停止
docker-compose stop

# Docker コンテナの停止・削除
docker-compose down

```

接続先
http://localhost:8080  


## memo  

- index.php  
    - 62L : まずは送信情報をチェックするため、自分自身にPOSTする。  

    - L15 : 送信情報をチェックする。問題なければ、confirm.phpに遷移する。

    - L73,89,108 : htmlspecialchars関数を使い、エスケープ処理をする。(そのまま文字列として扱う。)  


- confirm.php  
    - L10 : 直接URLを入力して、アクセスされないように、セッション変数が定義されてないと、表示できないようにしている。  

## TODO  

メールサーバをたてて、実際にメールを送る処理を追加する。