<?php 

    session_start();

    function h($str) {
        return htmlspecialchars($str);
    }


    $error = [];
    // $error['name'] = '';
    // $error['email'] = '';
    // $error['contact'] = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // フォームの送信時にエラーをチェックする
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if ($post['name'] === '') {
            $error['name'] = 'blank';
        }
        if ($post['email'] === '') {
            $error['email'] = 'blank';
        // 入力されたメールアドレスのバリテーションチェック
        } elseif (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
            $error['email'] = 'email';
        }
        if ($post['contact'] === '') {
            $error['contact'] = 'blank';
        }

        if (count($error) === 0) {
            // エラーがないので確認画面に移動
            $_SESSION['form'] = $post;
            header('Location: confirm.php');
            exit();
        }

    } else {
        // 戻るボタンを押して戻ってきた時(GETの時)
        if (isset($_SESSION['form'])) {
            $post = $_SESSION['form'];
        }
    }


?>



<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>お問合せフォーム</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="contact.css">
</head>
<body>
    <!-- お問合せフォーム画面 -->
    <div class="container">
        <!-- まずは送信情報をチェックするため、自分自身にPOSTする。エラーが出ない場合にconfirm.phpに送信する。 -->
        <form action="" method="POST" novalidate>
            <p>お問い合わせ</p>
            <div class="form-group">1
                <div class="row">
                    <div class="col-2">
                        <label for="inputName">お名前</label>
                    </div>
                    <div class="col-2">
                        <p class="require_item">必須</p>
                    </div>
                    <div class="col-8">                                                            <!-- $post['name']に値が送られていたら表示、そうでないなら空欄 -->
                        <input type="text" name="name" id="inputName" class="form-control" value="<?php if (isset($post['name'])) echo h($post['name']) ; echo ''; ?>" required autofocus>
                        <?php if ($error['name'] === 'blank'): ?>
                            <p class="error_msg">※お名前をご記入下さい</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-2">
                        <label for="inputEmail">メールアドレス</label>
                    </div>
                    <div class="col-2">
                        <p class="require_item">必須</p>
                    </div>
                    <div class="col-8">
                        <input type="email" name="email" id="inputEmail" class="form-control" value="<?php if (isset($post['email'])) echo h($post['email']) ; echo ''; ?>" required>
                        <?php if ($error['email'] === 'blank'): ?>
                            <p class="error_msg">※メールをご記入下さい</p>
                        <?php endif; ?>
                        <?php if ($error['email'] === 'email'): ?>
                            <p class="error_msg">※メールアドレスを正しくご記入ください。</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-2">
                        <label for="inputContent">お問い合わせ内容</label>
                    </div>
                    <div class="col-2">
                        <p class="require_item">必須</p>
                    </div>
                    <div class="col-8">
                        <textarea name="contact" id="inputContent" rows="10" class="form-control" required><?php if (isset($post['contact'])) echo h($post['contact']) ; echo ''; ?></textarea>
                        <?php if ($error['contact'] === 'blank'): ?>
                            <p class="error_msg">※メールをご記入下さい</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-8 offset-4">
                    <button type="submit">確認画面へ</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>