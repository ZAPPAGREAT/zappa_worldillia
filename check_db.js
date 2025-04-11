const mysql = require('mysql2');

// データベース接続設定
const connection = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '283zappa',
  database: 'zappa_worldillia'
});

// データベースに接続
connection.connect((err) => {
  if (err) {
    console.error('データベース接続エラー:', err);
    return;
  }
  console.log('データベースに接続しました。');

  // BGMトラックを取得
  connection.query('SELECT * FROM bgm_tracks', (error, results) => {
    if (error) {
      console.error('Error fetching BGM tracks:', error);
      return;
    }
    console.log('BGMトラック:');
    console.log(results);
    
    // 接続を閉じる
    connection.end();
  });
}); 