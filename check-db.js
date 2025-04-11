const mysql = require('mysql2');

const connection = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '283zappa',
  database: 'zappa_worldillia'
});

connection.connect((err) => {
  if (err) {
    console.error('データベース接続エラー:', err);
    return;
  }
  console.log('データベースに接続しました。');

  // BGMトラックの内容を確認
  connection.query('SELECT * FROM bgm_tracks', (error, results) => {
    if (error) {
      console.error('Error fetching BGM tracks:', error);
      return;
    }
    
    console.log('データベースの内容:');
    results.forEach(track => {
      console.log('-------------------');
      console.log('ID:', track.id);
      console.log('タイトル:', track.title);
      console.log('ファイルパス:', track.file_path);
      console.log('作成日時:', track.created_at);
    });

    connection.end();
  });
}); 