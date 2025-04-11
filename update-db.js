const mysql = require('mysql2');

const connection = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '283zappa',
  database: 'zappa_worldillia'
});

const fileUpdates = [
  { title: 'ざわめきと胸騒ぎ', path: 'ざわめきと胸騒ぎ.mp3' },
  { title: 'Pop Step!', path: 'Pop Step!.mp3' },
  { title: '開幕ファンファーレ', path: '開幕ファンファーレ.mp3' },
  { title: 'いきるいみ', path: 'いきるいみ.mp3' },
  { title: '妖精さんたちとの森のお茶会', path: '妖精さんたちとの森のお茶会.mp3' },
  { title: 'おつきさまがみまもっている', path: 'おつきさまがみまもっている short.mp3' },
  { title: 'Crazy Rabbit\'s Laugh', path: 'Crazy Rabbit`s Laugh.mp3' },
  { title: '気ままな人', path: '気ままな人.mp3' },
  { title: 'Lux De Caelo', path: 'Lux de caelo.mp3' },
  { title: '空虚', path: '空虚.mp3' },
  { title: 'Day Dream Fantasy', path: 'Day Dream Fantasy.mp3' },
  { title: '迫り来る恐怖', path: '迫り来る恐怖.mp3' },
  { title: '乱れ雅', path: '乱れ雅.mp3' },
  { title: 'メーワクなお偉いさん', path: 'メーワクなお偉いさん.mp3' }
];

connection.connect((err) => {
  if (err) {
    console.error('データベース接続エラー:', err);
    return;
  }
  console.log('データベースに接続しました。');

  let completed = 0;
  fileUpdates.forEach(update => {
    connection.query(
      'UPDATE bgm_tracks SET file_path = ? WHERE title = ?',
      [update.path, update.title],
      (error, results) => {
        if (error) {
          console.error(`Error updating ${update.title}:`, error);
        } else {
          console.log(`Updated: ${update.title} -> ${update.path}`);
        }
        completed++;
        if (completed === fileUpdates.length) {
          console.log('すべての更新が完了しました。');
          connection.end();
        }
      }
    );
  });
}); 