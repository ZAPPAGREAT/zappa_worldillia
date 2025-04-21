const express = require('express');
const mysql = require('mysql2');
const path = require('path');
const app = express();

// 静的ファイルの提供（ディレクトリリスティングを無効化）
const staticOptions = {
  index: false,
  dotfiles: 'deny'
};

app.use('/css', express.static(path.join(__dirname, 'public/css'), staticOptions));
app.use('/images', express.static(path.join(__dirname, 'public/images'), staticOptions));
app.use('/audio', express.static(path.join(__dirname, 'public/audio'), staticOptions));
app.use(express.static(path.join(__dirname, 'public'), {
  index: false,
  dotfiles: 'deny'
}));

// 不正なパスへのアクセスを防ぐ
app.use('/', (req, res, next) => {
  if (req.path === '/') {
    next();
  } else if (req.path.match(/^\/(?:profile|works|free-bgm|commission|links)$/)) {
    next();
  } else {
    res.redirect('/');
  }
});

// EJSをテンプレートエンジンとして設定
app.set('view engine', 'ejs');
app.set('views', path.join(__dirname, 'views'));

// テンプレート名のスペースを許可
app.set('view options', {
  filename: function(name) {
    return name.replace(/%20/g, ' ');
  }
});

// データベース接続設定
const connection = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '283zappa',
  database: 'zappa_worldillia'
});

// ルーティング設定
// トップページ
app.get('/', (req, res) => {
  res.render('Z-top');
});

// プロフィールページ
app.get('/profile', (req, res) => {
  res.render('Z-profile');
});

// 作品一覧ページ
app.get('/works', (req, res) => {
  res.render('Z-works');
});

// BGMリストページ
app.get('/free-bgm', (req, res) => {
  connection.query('SELECT * FROM bgm_tracks', (err, results) => {
    if (err) {
      console.error('BGMの取得に失敗しました:', err);
      return res.status(500).send('BGMの取得に失敗しました');
    }

    res.render('Z-free-BGM-DL', { bgm_tracks: results });
  });
});


// 依頼・お問い合わせページ
app.get('/commission', (req, res) => {
  res.render('Z-Commission-Contact');
});

// リンクページ
app.get('/links', (req, res) => {
  res.render('Z-Links');
});

// エラーハンドリング
app.use((req, res, next) => {
  console.log('リクエストパス:', req.path);
  next();
});

app.use((err, req, res, next) => {
  console.error('エラーが発生しました:', err);
  res.status(500).send('サーバーエラーが発生しました。');
});

// サーバーの起動
const PORT = process.env.PORT || 3000;
connection.connect((err) => {
  if (err) {
    console.error('データベース接続エラー:', err);
    return;
  }
  console.log('データベースに接続しました。');

  // ✅ DB接続が成功したらサーバーを起動
  app.listen(PORT, () => {
    console.log(`Server is running on port ${PORT}`);
  });
});

