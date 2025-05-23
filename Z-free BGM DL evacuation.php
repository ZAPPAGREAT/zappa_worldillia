<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ザッパワールディリア - Free BGM DL</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="https://unpkg.com/ress@4.0.0/dist/ress.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/stylesheet.css">
    <link rel="stylesheet" href="responsive.css">
    <script>
      window.addEventListener('load', function() {
        const logo = document.querySelector('.top-logo');
        setTimeout(() => {
          logo.classList.add('fade-in');
        }, 100);
      });
    </script>
    <script>
      // モーダル関連の要素を取得
      const modal = document.getElementById('termsModal');
      const agreeBtn = document.getElementById('agreeBtn');
      const cancelBtn = document.getElementById('cancelBtn');
      let currentDownloadLink = null;

      // ダウンロードボタンのイベントリスナーを設定
      document.querySelectorAll('.download-btn').forEach(button => {
        button.addEventListener('click', function(e) {
          e.preventDefault();
          currentDownloadLink = this.href;
          modal.style.display = 'block';
        });
      });

      // 同意ボタンのクリックイベント
      agreeBtn.addEventListener('click', function() {
        if (currentDownloadLink) {
          window.location.href = currentDownloadLink;
        }
        modal.style.display = 'none';
      });

      // キャンセルボタンのクリックイベント
      cancelBtn.addEventListener('click', function() {
        modal.style.display = 'none';
      });

      // モーダルの外側をクリックした時の処理
      window.addEventListener('click', function(e) {
        if (e.target === modal) {
          modal.style.display = 'none';
        }
      });
    </script>
  </head>
  <body>
    <header>
      <div class="container">
        <div class="header-left">
          <img src="images/ZAPPA Worldillia logo.png">
        </div>
        <div class="header-right">
          <a>Home</a>
          <a href="profile.html">Profile</a>
          <a href="menu.html">Works</a>
          <a href="access.html">Free BGM DL</a>
          <a href="access.html">Commision & Contact</a>
          <a href="access.html">Links</a>
        </div>
      </div>
    </header>
    
    <div class="main-content">
      <h1>フリーBGMを配布いたします</h1>
      
      <div class="bgm-list">
        <?php
        require_once 'config/database.php';
        
        try {
            $stmt = $pdo->query("SELECT * FROM bgm_tracks ORDER BY created_at DESC");
            $bgm_tracks = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($bgm_tracks as $track) {
                echo '<div class="bgm-item">';
                echo '<h3>' . htmlspecialchars($track['title']) . '</h3>';
                echo '<p class="genre-tag">' . htmlspecialchars($track['genre']) . '</p>';
                echo '<audio controls>';
                echo '<source src="' . htmlspecialchars($track['file_path']) . '" type="audio/mpeg">';
                echo '</audio>';
                echo '<p class="keywords">キーワード：' . htmlspecialchars($track['keywords']) . '</p>';
                echo '<a href="' . htmlspecialchars($track['file_path']) . '" download class="download-btn" data-track-id="' . $track['id'] . '">ダウンロード</a>';
                echo '</div>';
            }
        } catch(PDOException $e) {
            echo '<p>データベースエラーが発生しました。</p>';
        }
        ?>
      </div>
    </div>

    <!-- 利用規約ポップアップ -->
    <div id="termsModal" class="modal">
      <div class="modal-content">
        <h2>ご利用について</h2>
        
        <div class="terms-section">
          <h3>☆ご利用の範囲</h3>
          <ul>
            <li>営利(商用)、非営利、個人、法人での制作物内の「背景音楽」(BGM)</li>
            <li>一部加工（エフェクト、ピッチシフト、タイムストレッチ、一部分のカット）</li>
            <li>原曲を流用しないアレンジ及びリミックス(申請が必要です)</li>
          </ul>
          
          <h3>【利用例】</h3>
          <ul>
            <li>テレビ番組、CM</li>
            <li>舞台(演劇、朗読)</li>
            <li>映像コンクール出品作品</li>
            <li>YouTube、ニコニコ生放送、WEBラジオ、その他配信及び生放送</li>
            <li>店舗、結婚式、広告、イベント</li>
            <li>有償及び無償のアプリ、ゲーム、DVD</li>
            <li>プレゼンテーション</li>
          </ul>
        </div>
        
        <div class="terms-section">
          <h3>☆禁止事項</h3>
          <ul>
            <li>政治や宗教関係の制作物及びコンテンツへの利用</li>
            <li>日本法令に違反、公序良俗に反する制作物及びコンテンツでの利用</li>
            <li>音源の有料販売</li>
            <li>音源の楽譜を作成し、有料販売及び公開</li>
            <li>無許可でのアレンジ及びリミックス</li>
            <li>当サイト及び製作者の名誉や信用毀損、その恐れがあると判断される用途での利用</li>
          </ul>
        </div>
        
        <div class="terms-notice">
          <p>以上の項目を同意したものとみなして、音源をダウンロードさせていただきます。</p>
          <p>ご利用の際にいかなるトラブルが発生しても故意や重過失がない限り、一切の責任を負いません。</p>
          <p>ダウンロードの際は、下のコメント欄で、曲名とご利用用途とご感想のご記入をお願いします。</p>
          <p>※ご記入内容は公開いたします。</p>
        </div>
        
        <div class="modal-buttons">
          <button id="agreeBtn" class="agree-btn">同意してダウンロードする</button>
          <button id="cancelBtn" class="cancel-btn">キャンセル</button>
        </div>
      </div>
    </div>

    <footer>
      <div class="footer-visual">
        <h2>ザッパワールディリア</h2>
        <p>© 2024 ZAPPAWorldillia, All Rights Reserved.</p>
      </div>
    </footer>
  </body>
</html>