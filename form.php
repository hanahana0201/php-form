<?php
var_dump($_POST);

// 変数の初期化
$page_flag = 0;

if (!empty ($_POST['btn_confirm'])) {

	$page_flag = 1;
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<title>お問合せフォーム</title>
	<link rel="stylesheet" href="styles.css">
</head>

<body>
	<div class="min-h-screen flex items-center">
		<div class="w-full">
			<h2 class="text-center text-blue-400 font-bold text-2xl mb-10">お問合せフォーム</h2>
			<div class="p-10 md:w-3/4 mx-auto lg:w-1/2">
				<?php if ($page_flag === 1): ?>

				<?php else: ?>
					<form method="post" action="">
						<div class="mb-5">
							<label for="" class="block mb-2 font-bold text-gray-600">氏名</label>
							<input type="text" id="" name="your_name" placeholder=""
								class="border border-gray-300 shadow p-3 w-full rounded mb-">
						</div>

						<div class="mb-5">
							<label for="" class="block mb-2 font-bold text-gray-600">メールアドレス</label>
							<input type="text" id="" name="email" placeholder=""
								class="border border-gray-300 shadow p-3 w-full rounded mb-">
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