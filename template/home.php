<?php
//$page_dataに投稿に関するデータが格納されている
//ページ情報
$page_meta = [
    //url canonical
    'canonical' => $blog_info['home-url'],
    //title 文字列
    'title' => $blog_info['name'],
    'description' => '',
    'og' => [
        'type' => 'website',
        'locale' => 'ja_JP',
    ],
    'twitter' => [
        //twitter user名
        'site' => '',
    ]
];
//現在のインデントの個数
$indent_level = 0;

//GETパラメータに"debug"を追加している場合圧縮しない
if( !isset($_GET["debug"]) ){
    //バッファリングスタート
    ob_start();
} else {
    echo "<script>console.log('debugが有効です、HTMLファイルを圧縮せずに出力しています。');</script>";
}
?>
<!DOCTYPE html>
<html lang="ja">
    <head><?php //余計な改行、インデントを防ぐためのタグ開始位置

        //現在のインデントの個数
        $indent_level = 2;
        ?>

        <!-- head内のtitle, meta, icon等 -->
        <?php include( "parts/head.php" )?>
        <!-- end head内のtitle, meta、icon等 -->

        <!-- font -->
        <!-- TODO:font設定 -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Noto+Sans+JP:wght@100..900&family=Noto+Serif+JP&display=swap" rel="stylesheet">

        <!-- アンカーテキストでスムーズにスクロール -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // ページ内リンクを全て取得
                const anchorLinks = document.querySelectorAll('a[href^="#"]');
                // 各リンクにクリックイベントを設定
                anchorLinks.forEach(function(anchor) {
                    anchor.addEventListener('click', function(e) {
                        e.preventDefault();
                        const speed = 800; // スクロール速度(ms)
                        const href = this.getAttribute("href");
                        const target = href === "#" || href === "" ? document.documentElement : document.querySelector(href);

                        if (!target) return;

                        const position = target.getBoundingClientRect().top + window.pageYOffset;

                        // スムーズスクロールのアニメーション
                        const startTime = performance.now();
                        const startPosition = window.pageYOffset;
                        const distance = position - startPosition;

                        function animateScroll(currentTime) {
                            const elapsedTime = currentTime - startTime;

                            if (elapsedTime < speed) {
                                // easeOutQuad アニメーション（緩やかに減速）
                                const progress = elapsedTime / speed;
                                const easeProgress = -progress * (progress - 2);
                                window.scrollTo(0, startPosition + distance * easeProgress);
                                requestAnimationFrame(animateScroll);
                            } else {
                                window.scrollTo(0, position);
                            }
                        }
                        requestAnimationFrame(animateScroll);
                    });
                });
            });
        </script>
        <!-- css共通 -->
        <link rel="stylesheet" href="css/style-top.css">
    </head>
    <body><?php //余計な改行、インデントを防ぐためのphpタグ開始位置
        //現在のインデントの個数
        $indent_level = 2;?>

        <?php
            //ヘッダー
            include( "parts/bl_header/header.php" )?>
        <div class="bl_spArea_inner"><?php //余計な改行、インデントを防ぐためのphpタグ開始位置
            //現在のインデントの個数
            $indent_level = 3;?>

            <main><?php //余計な改行、インデントを防ぐためのphpタグ開始位置
                //現在のインデントの個数
                $indent_level = 4;?>

                <?php
                //キービジュアル
                include( "parts/bl_kv/kv.php" )?>

            </main><?php //余計な改行、インデントを防ぐためのphpタグ開始位置
            //現在のインデントの個数
            $indent_level = 3;?>

            <?php //footer
            include( "parts/bl_footer/footer.php" )?>
        </div><?php //余計な改行、インデントを防ぐためのphpタグ開始位置
            //現在のインデントの個数
            $indent_level = 2;?>
    </body>
</html>
<?php
//GETパラメータに"debug"を追加している場合圧縮しない
//強制オフ
if(0){
    if( isset($_GET["debug"]) ){
        //バッファ終了、改行余計な空白削除して出力
        $compress = ob_get_clean();
        $compress = str_replace("\t", '', $compress);
        $compress = str_replace("\r", '', $compress);
        $compress = str_replace("\n", '', $compress);
        $compress = preg_replace('/<!--[\s\S]*?-->/', '', $compress);
        echo $compress;
    }
}
?>