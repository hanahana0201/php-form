<?php
// var_dump($_POST);

// 変数の初期化
$page_flag = 0;

if (!empty ($_POST['btn_confirm'])) {

	$page_flag = 1;

} elseif (!empty ($_POST['btn_submit'])) {

	$page_flag = 2;

	mb_language("ja");
	mb_internal_encoding("UTF-8");

	// 変数とタイムゾーンを初期化
	$header = null;
	$auto_reply_subject = null;
	$auto_reply_text = null;
	$admin_reply_subject = null;
	$admin_reply_text = null;
	date_default_timezone_set('Asia/Tokyo');

	// ヘッダー情報を設定
	$header .= "MIME-Version: 1.0\n";
	$header .= "Content-Type: text/plain; charset=UTF-8\n";
	$header .= "From: センチメートル <masatoshi-hanai@centi_meter.net>\n";
	$header .= "Reply-To: センチメートル <masatoshi-hanai@centi_meter.net>\n";
	$header .= "Content-Transfer-Encoding: BASE64 \n";

	// 件名を設定
	$auto_reply_subject = 'お問い合わせありがとうございます。';

	// 本文を設定
	$auto_reply_text .= "この度は、お問い合わせ頂き誠にありがとうございます。\n";
	$auto_reply_text .= "下記の内容でお問い合わせを受け付けました。\n\n";
	$auto_reply_text .= "お問い合わせ日時：" . date("Y-m-d H:i") . "\n";
	$auto_reply_text .= "氏名：" . $_POST['your_name'] . "\n";
	$auto_reply_text .= "メールアドレス：" . $_POST['email'] . "\n\n";
	$auto_reply_text .= "センチメートル";

	// メール送信
	mb_send_mail( $_POST['email'], $auto_reply_subject, $auto_reply_text, $header);
	// 運営側へ送るメールの件名
	$admin_reply_subject = "お問い合わせを受け付けました";

	// 本文を設定
	$admin_reply_text = "下記の内容でお問い合わせがありました。\n\n";
	$admin_reply_text .= "お問い合わせ日時：" . date("Y-m-d H:i") . "\n";
	$admin_reply_text .= "氏名：" . $_POST['your_name'] . "\n";
	$admin_reply_text .= "メールアドレス：" . $_POST['email'] . "\n\n";

	// 運営側へメール送信
	mb_send_mail( 'masatoshi_hanai@centi-meter.net', $admin_reply_subject, $admin_reply_text, $header);

}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, viewport-fit=cover">
	<title>お問合せフォーム</title>
	<link rel="stylesheet" href="styles.css">
</head>

<body>
	<div class="min-h-screen flex items-center">
		<div class="w-full">
			<h2 class="text-center text-blue-400 font-bold text-2xl mb-10">お問合せフォーム</h2>
			<div class="p-10 w-full mx-auto lg:w-1/2">
				<?php if ($page_flag === 1): ?>
					<form method="post" action="">
						<div class="mb-5">
							<label for="" class="block mb-2 font-bold text-gray-600">氏名</label>
							<p class="py-3 w-full mb-2">
								<?php echo $_POST['your_name']; ?>
							</p>
						</div>

						<div class="mb-5">
							<label for="" class="block mb-2 font-bold text-gray-600">メールアドレス</label>
							<p class="py-3 w-full mb-2">
								<?php echo $_POST['email']; ?>
							</p>
						</div>
						<div class="flex">
							<div class="w-6/12 pr-3"><input type="submit" name="btn_back" value="戻る"
									class="block w-full bg-gray-500 text-white font-bold p-4 rounded-lg"></div>
							<div class="w-6/12 pl-3">
								<input type="submit" name="btn_submit" value="送信"
									class="block w-full bg-blue-500 text-white font-bold p-4 rounded-lg">
							</div>
						</div>
						<input type="hidden" name="your_name" value="<?php echo $_POST['your_name']; ?>">
						<input type="hidden" name="email" value="<?php echo $_POST['email']; ?>">
					</form>

				<?php elseif ($page_flag === 2): ?>

					<p class="text-center">送信が完了しました。</p>

				<?php else: ?>
					<form method="post" action="">
						<div class="mb-5">
							<label for="" class="block mb-2 font-bold text-gray-600">氏名</label>
							<input type="text" id="" name="your_name" placeholder="" value="<?php if( !empty($_POST['your_name']) ){ echo $_POST['your_name']; } ?>"
								class="border border-gray-300 shadow p-3 w-full rounded mb-2">
						</div>

						<div class="mb-5">
							<label for="" class="block mb-2 font-bold text-gray-600">メールアドレス</label>
							<input type="text" id="" name="email" placeholder="" value="<?php if( !empty($_POST['email']) ){ echo $_POST['email']; } ?>"
								class="border border-gray-300 shadow p-3 w-full rounded mb-2">
						</div>

						<div class="mb-5">
							<label for="" class="block mb-2 font-bold text-gray-600">性別</label>
							<div class="flex flex-wrap">
								<div class="flex items-center me-4">
									<input id="gender_male" type="radio" name="gender" value="male" class="w-4 h-4 text-blue-500 border-gray-300 focus:ring-blue-400">
									<label for="gender_male" class="ms-2 text-sm font-medium text-gray-900">男性</label>
								</div>
								<div class="flex items-center me-4">
									<input id="gender_female" type="radio" name="gender" value="male" class="w-4 h-4 text-blue-500 border-gray-300 focus:ring-blue-400">
									<label for="gender_female" class="ms-2 text-sm font-medium text-gray-900">女性</label>
								</div>
							</div>
						</div>

						<div class="mb-5">
							<label for="" class="block mb-2 font-bold text-gray-600">年齢</label>
							<select id="countries" class="border border-gray-300 shadow text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
    							<option selected>選択してください</option>
    							<option value="1">〜19歳</option>
    							<option value="2">20歳〜29歳</option>
    							<option value="3">30歳〜39歳</option>
    							<option value="4">40歳〜49歳</option>
								<option value="5">50歳〜59歳</option>
								<option value="6">60歳〜</option>
  							</select>
						</div>
						<div class="mb-5">
							<label for="" class="block mb-2 font-bold text-gray-600">メールアドレス</label>
							<textarea class="border border-gray-300 shadow p-3 w-full rounded mb-2" name="contact"></textarea>				
						</div>
						<div class="mb-5">
							<input id="agreement" type="checkbox" name="agreement" value="1" class="w-4 h-4 text-blue-500 border-gray-300 rounded focus:ring-blue-400">
							<label for="agreement" class="ms-2 text-sm font-medium text-gray-900">プライバシーポリシーに同意する</label>	
						</div>
						<input type="submit" name="btn_confirm" value="入力内容を確認する"
							class="block w-full bg-blue-500 text-white font-bold p-4 rounded-lg">
					</form>
				</div>
			</div>
		</div>
	<?php endif; ?>
</body>

</html>
