# ①課題番号-プロダクト名

課題番号11-おさかなハぅマっチ？(卒制プロトタイプ版 ver.01)

## ②課題内容（どんな作品か）

- PHPのPOSTを利用したアプリです。
- 画像含めた情報をPOSTしphpMyAdmin内のデータベースに保存します。
- データベースからの呼び出しは、画像を含めた情報を一覧で出す形式と、日付と価格情報のみをグラフ形式で呼び出す形式の２パターンがあります。
- ユーザID、PWを利用したログイン・ログアウト機能を追加しました。
- 新規アカウント登録時に、PWのハッシュ化を行ってデータベースに保存します。
- ログイン中のユーザー名はプロダクト内のサイドメニューより確認可能です。
- ログイン中のユーザーIDに紐づくデータのみを、データベースから呼び出して表示が可能です。

・課題10からの変更点

- uploadディレクトリに格納するファイル名をファイル名オリジナル→ユニークに変更
- uploadディレクトリに格納している画像をdelete_data.phpでuploadディレクトリからデータごと削除
- データ更新時には既存の画像ファイルをuploadディレクトリより削除し、新しいファイルを格納
- Adminフラグに応じてダッシュボードに表示されるパネル、h2を変更
- ハンバーガーメニューのコンポーネント化
- ログイン画面にID・PW未入力、不一致の場合のエラーメッセージ表示
- 新規登録時のPWバリデーション追加
- メモ欄に200文字の入力制限追加
- ユーザー毎にアカウント設定画面を作成　ユーザー名、ID、PWの変更が可能
- 管理者は登録されている全データが参照可能に変更
- 管理者向け、一般ユーザー向けでメニューバーの出しわけ
- データグラフの並び替え、サイズ変更が可能
- ユーザーライフフラグの判定を導入（管理者画面からユーザー削除→フラグが1から0へ）
- ログイン時にユーザーのライフフラグを判定
- 自動ログアウトの機能追加（30分無操作でログアウト）


## ③DEMO

https://bluebat2024.sakura.ne.jp/kadai11_Sakura5/index.php

## ④作ったアプリケーション用のIDまたはPasswordがある場合

- 管理者　ID Satoru Tauchi 　PW user1
- 一般　　ID Taro Yamada 　  PW user2

## ⑤工夫した点・こだわった点

- より本番環境に近づけることを目標に実装しました。

## ⑥難しかった点・次回トライしたいこと(又は機能)
- 表示したグラフの位置を任意で変更できるようにしたかったのですが、レイアウト崩れを起こすことが多く、なかなかうまくいきませんでした。

## ⑦質問・疑問・感想、シェアしたいこと等なんでも

- [質問]
- 

- [感想]
いよいよ最後の課題だと思うと感慨深いです！

- [参考記事]
  - 1. https://plugmize.jp/archives/blog/20161118_diff_equals.html
  - 2. https://irodori-design-web.com/blog/blog-1168/
  - 3. https://web-camp.io/magazine/archives/85043
  