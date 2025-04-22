-- データベースの作成
CREATE DATABASE IF NOT EXISTS zappa_worldillia;
USE zappa_worldillia;

-- BGMテーブルの作成
CREATE TABLE IF NOT EXISTS bgm_tracks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    genre VARCHAR(100),
    file_path VARCHAR(255) NOT NULL,
    keywords TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ダウンロード履歴テーブルの作成
CREATE TABLE IF NOT EXISTS download_history (
    id INT AUTO_INCREMENT PRIMARY KEY,
    track_id INT,
    user_name VARCHAR(255),
    usage_purpose TEXT,
    feedback TEXT,
    downloaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (track_id) REFERENCES bgm_tracks(id)
);

-- コメント欄のテーブル
CREATE TABLE comments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  message TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);



-- サンプルデータの挿入
INSERT INTO bgm_tracks (title, genre, file_path, keywords) VALUES
('ざわめきと胸騒ぎ', 'ジャズ', 'audio/ざわめきと胸騒ぎ.mp3', 'ジャズ シリアス ミステリアス トレンディ スタイリッシュ かっこいい ピアノ'),
('Pop Step!', 'ポップス', 'audio/Pop Step!.mp3', 'ポップス エレクトロ ほのぼの 日常 かわいい シンセサイザー'),
('開幕ファンファーレ', 'ファンファーレ', 'audio/開幕ファンファーレ.mp3', 'ファンファーレ ブラス 開幕 パロディ コメディ'),
('いきるいみ', 'ノスタルジック', 'audio/いきるいみ.mp3', 'シリアス コメディ ホラー ワンポイント ノスタルジック ピアノ'),
('妖精さんたちとの森のお茶会', '吹奏楽', 'audio/妖精さんたちとの森のお茶会.mp3', '吹奏楽 ほのぼの 日常 コミカル かわいい フルート'),
('おつきさまがみまもっている', 'オルゴール', 'audio/おつきさまがみまもっている short.mp3', 'オルゴール ほのぼの 回想 子守唄 かわいい ミュージックボックス'),
('熱い心', 'ロック', 'audio/熱い心.mp3', 'ロック シリアス 戦闘 白熱 かっこいい エレキギター バンドミュージック'),
('Retro Party！！', 'チップチューン', 'audio/Retro Party!!.mp3', 'ポップス ファミコン 楽しい ゲーム かわいい チップチューン'),
('Crazy Rabbit`s Laugh', 'ジャズ', 'audio/Crazy Rabbit`s Laugh.mp3', 'ジャズ 騒がしい 楽しい ハイテンション コミカル ビッグバンド'),
('気ままな人', 'ピアノ', 'audio/気ままな人.mp3', 'ほのぼの 日常 かわいい 優雅 コミカル ピアノ'),
('フルート吹きの愉快な休日', '吹奏楽', 'audio/フルート吹きの愉快な休日.mp3', 'ほのぼの 日常 かわいい コミカル フルート ピアノ'),
('Lux De Caelo', 'ロック', 'audio/Lux De Caelo.mp3', 'ロック ゴシック かっこいい シリアス 戦闘 エレキギター バンドミュージック'),
('空虚', 'テクノ', 'audio/空虚.mp3', 'テクノ アンビエント スタイリッシュ かっこいい シリアス 幻想 ピアノ'),
('Day Dream Fantasy', 'テクノ', 'audio/Day Dream Fantasy.mp3', 'テクノ スタイリッシュ かわいい ポップス チルアウト シンセサイザー'),
('迫りくる恐怖', 'ホラー', 'audio/迫りくる恐怖.mp3', 'シリアス ホラー 不安 肝試し 不協和音 ループ'),
('乱れ雅', '和風ロック', 'audio/乱れ雅.mp3', 'シリアス スタイリッシュ 和風 ロック バンドミュージック 都節 和洋折衷'),
('メーワクなお偉いさん', 'バロック', 'audio/メーワクなお偉いさん.mp3', 'コミカル ほのぼの 優雅 バロック ループ オーボエ'); 