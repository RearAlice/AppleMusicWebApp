# Apple Music WebApp Demo



このコードは、ユーザーが楽曲やアーティスト名を入力して検索できるシンプルなWebアプリです。

> [!TIP]
>検索結果には、楽曲名、アーティスト名、および試聴用のオーディオプレーヤーが表示されます。フル再生を行うためには、Apple Musicのサブスクリプションが必要です。




> [!IMPORTANT]
> Apple Musicと連動して楽曲を検索し、楽曲をフルで再生できるWebアプリを作成するには、Apple Music APIを使用します。Apple Music APIは、楽曲、アルバム、アーティストなどの情報を取得するためのAPIです。Apple Music APIを利用するためには、Apple Developerアカウントが必要です。

# Requirement
- Apple Music API
- [Firebase JWT GitHub](/libs/php-jwt/README.md)

# Usage

以下の手順でPHPを使用してApple Music検索Webアプリを作成する方法を説明します。

## Apple Music APIの設定:

- Apple Developerアカウントにサインアップし、Apple Music APIを有効にします。
-  APIキーとシークレットキーを取得します。
- JWTトークンを生成します（認証に使用します）。

## PHPスクリプトの作成:

このスクリプトでは、PHPコードの上部でJWTトークンの生成を行い、その後、検索フォームと結果表示のHTMLを出力します。


> [!NOTE]
>フル再生を実現するためには、Apple Musicの再生機能を組み込む必要がありますが、そのためにはiOSやmacOSアプリの開発が必要になる場合があります。ウェブアプリでフル再生を行うための公式な方法は現在提供されていないため、APIの制限や利用規約を確認してください。


# Licence
 The API used in this project is from Apple Music. Apple Music is a registered trademark of Apple Inc.
