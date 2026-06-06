<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Bikin Data User
        $userId = DB::table('users')->insertGetId([
            'username' => 'UserTes', 
            'email' => 'test@naratia.com',
            'password' => Hash::make('password123'), 
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // =========================================================================
        // BATAS AMAN: INI KODINGAN TAKDIR TERINDAH (TIDAK DIUTAK-ATIK SAMA SEKALI)
        // =========================================================================
        
        // 2. Bikin Data Cerita 
        $storyId = DB::table('stories')->insertGetId([
            'user_id' => $userId, 
            'title' => 'TAKDIR TERINDAH',
            'description' => 'Sebuah kisah tentang keajaiban dan takdir yang tak terduga. Semuanya bermula ketika senja turun di ujung kota, membawa rahasia yang sudah lama terpendam.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 3. Daftar 5 Bab yang Saling Menyambung dan Sangat Panjang
        $chaptersData = [
            [
                'title' => 'Misteri',
                'content' => 'Malam itu, rintik hujan turun membasahi kaca jendela kamar [NAMA_USER]. Suara petir yang menggelegar seolah menjadi pertanda bahwa kehidupan tenang yang selama ini dijalani akan segera berakhir. [NAMA_USER] duduk termenung di sudut ruangan, memandangi sebuah kotak kayu berukir aneh yang baru saja ia temukan di loteng peninggalan kakeknya. Kotak itu memancarkan aura dingin yang membuat bulu kuduk berdiri. Dengan tangan gemetar, [NAMA_USER] mencoba membuka gembok kuno yang mengunci kotak tersebut. Ada perasaan ragu yang menyelimuti hatinya. Apakah ia siap menghadapi apa pun yang ada di dalamnya? Begitu penutup kotak itu terbuka, aroma kertas tua dan melati kering langsung menyeruak memenuhi udara. Di dalamnya, tidak ada harta karun seperti yang sering diceritakan dalam dongeng. Hanya ada sebuah buku harian bersampul kulit hitam yang sudah mengelupas di beberapa bagian, dan sebuah kalung berliontin batu merah darah. 

[NAMA_USER] meraih buku harian itu. Halaman pertamanya dipenuhi tulisan tangan yang sangat berantakan, seolah ditulis dalam keadaan terburu-buru. "Jika kau membaca ini, berarti garis keturunan kita belum terputus. Jaga kalung itu, mereka akan datang mencarinya," begitulah bunyi kalimat pertama yang berhasil dieja oleh [NAMA_USER]. Jantungnya berdegup kencang. Siapa \'mereka\' yang dimaksud? Mengapa kakeknya menyembunyikan hal sebesar ini? Pikiran [NAMA_USER] dipenuhi oleh ratusan pertanyaan yang tidak memiliki jawaban. Tiba-tiba, lampu di kamarnya berkedip hebat lalu mati total, menyisakan kegelapan pekat. Dari arah luar jendela, terdengar suara langkah kaki yang berat dan teratur, semakin lama semakin mendekat ke arah pintu utama rumah. [NAMA_USER] menahan napas, menggenggam erat kalung batu merah itu di dadanya. Ia tahu, mulai detik ini, hidupnya tidak akan pernah sama lagi. Ini adalah awal dari sebuah misteri besar yang harus ia pecahkan sendirian, tanpa tahu siapa kawan dan siapa lawan di luar sana.'
            ],
            [
                'title' => 'Pertemuan',
                'content' => 'Setelah berhasil meloloskan diri dari rumahnya malam itu, [NAMA_USER] terus berlari menembus hujan badai tanpa arah tujuan yang pasti. Pakaiannya basah kuyup, dan udara dingin menusuk hingga ke tulang. Berbekal petunjuk samar dari buku harian kakeknya, [NAMA_USER] memutuskan untuk pergi ke Stasiun Kereta Api Tua di ujung kota yang sudah bertahun-tahun tidak beroperasi. Setibanya di sana, suasana sangat mencekam. Hanya ada suara derik besi tua yang tertiup angin dan tetesan air hujan dari atap peron yang bocor. Di tengah remang-remang cahaya lampu jalan yang berkedip, [NAMA_USER] melihat sesosok bayangan manusia duduk sendirian di bangku peron. Bayangan itu mengenakan mantel panjang berwarna gelap, topi yang menutupi separuh wajahnya, dan terlihat sangat tenang meskipun badai sedang mengamuk di sekeliling mereka. 

Dengan sisa keberanian yang ada, [NAMA_USER] melangkah mendekat. Pria itu perlahan mengangkat wajahnya, memperlihatkan sepasang mata tajam yang menatap langsung ke kedalaman jiwa [NAMA_USER]. "Aku sudah menunggumu, Pembawa Takdir," ucap pria itu dengan suara berat yang menggema di keheningan stasiun. [NAMA_USER] terkesiap, melangkah mundur secara naluriah. Bagaimana pria misterius ini bisa tahu siapa dirinya? Pria itu kemudian berdiri, mendekati [NAMA_USER] perlahan, dan menyodorkan sebuah tiket kereta kuno yang terbuat dari lempengan tembaga. "Kereta menuju kota rahasia akan segera tiba. Jika kau ingin tahu kebenaran tentang kalung yang kau bawa, kau harus ikut denganku. Tapi ingat, begitu kau menaiki kereta itu, kau tidak akan pernah bisa kembali ke kehidupan normalmu," jelasnya dengan nada serius. Di kejauhan, suara peluit kereta yang sangat aneh mulai terdengar. Asap tebal perlahan menyelimuti peron. [NAMA_USER] menatap tiket tembaga di tangannya, lalu menatap pria itu bergantian. Tidak ada waktu untuk ragu. Dengan tekad yang bulat, [NAMA_USER] menganggukkan kepala, menerima tawaran pertemuan tak terduga yang akan membawanya masuk ke dunia yang selama ini tak pernah ia bayangkan.'
            ],
            [
                'title' => 'Rahasia',
                'content' => 'Perjalanan menggunakan kereta kuno itu terasa seperti melintasi dimensi waktu. Pemandangan di luar jendela hanyalah kabut ungu bergulung-gulung yang tidak masuk akal. Selama perjalanan, pria bermantel yang ternyata bernama Elian itu mulai menceritakan rahasia besar yang selama berabad-abad dijaga oleh keluarga [NAMA_USER]. Ternyata, kalung batu merah itu bukanlah perhiasan biasa, melainkan "Jantung Aurora"—sebuah artefak magis yang menahan keseimbangan antara dunia manusia dan dunia bayangan. Kakek [NAMA_USER] adalah Sang Penjaga terakhir yang mengorbankan nyawanya agar artefak tersebut tidak jatuh ke tangan Ordo Malam, sebuah organisasi gelap yang ingin menguasai kedua dunia. Mendengar penjelasan itu, kepala [NAMA_USER] terasa pusing. Fakta bahwa selama ini keluarganya menyembunyikan identitas asli mereka benar-benar sulit dipercaya. Namun, bukti itu nyata berada di tangannya. Kalung itu terkadang berdenyut hangat saat [NAMA_USER] merasa terancam, seolah memiliki kesadarannya sendiri. 

Kereta akhirnya berhenti di sebuah stasiun bawah tanah yang megah, tersembunyi di bawah perut gunung berapi yang sudah mati. Mereka tiba di markas rahasia para pemberontak yang menentang Ordo Malam. Di sana, [NAMA_USER] diperlihatkan ribuan arsip sejarah dan ramalan kuno. Salah satu gulungan perkamen yang paling tua mencatat sebuah ramalan yang membuat darah [NAMA_USER] berdesir. Ramalan itu menyebutkan bahwa hanya keturunan langsung dari Penjaga Pertama yang bisa membangkitkan kekuatan penuh Jantung Aurora, dan itu harus dilakukan saat gerhana bulan merah terjadi. [NAMA_USER] menyadari bahwa semua beban kini berada di pundaknya. Rahasia besar ini terlalu berat untuk ditanggung, namun ia tidak bisa mundur. Jika Ordo Malam berhasil menemukannya sebelum gerhana terjadi, maka seluruh umat manusia akan berada dalam bahaya besar. Malam itu, [NAMA_USER] tidak bisa tidur. Ia menatap pantulan dirinya di cermin ruang ganti markas, merenungi takdir yang kini mengikatnya. Ia harus berlatih, ia harus menjadi kuat, demi mengungkap semua rahasia yang masih tersembunyi di balik kematian kakeknya.'
            ],
            [
                'title' => 'Pengkhianatan',
                'content' => 'Satu bulan berlalu sejak [NAMA_USER] tiba di markas rahasia. Latihan fisik dan magis yang keras telah mengubahnya menjadi sosok yang lebih tangguh. Hubungannya dengan Elian pun semakin dekat, pria itu menjadi mentor sekaligus sosok yang paling dipercayai oleh [NAMA_USER]. Hari gerhana bulan merah semakin dekat, dan persiapan untuk ritual kebangkitan Jantung Aurora hampir selesai. Namun, suasana di markas mulai terasa tegang. Beberapa misi pengintaian yang dilakukan oleh anggota pemberontak selalu berakhir dengan kegagalan, seolah Ordo Malam selalu tahu setiap langkah yang akan mereka ambil. Kecurigaan mulai menyebar, bahwa ada mata-mata di dalam markas mereka. [NAMA_USER] berusaha menepis pikiran negatif itu, fokus pada ritual yang akan menentukan nasib dunia. Malam sebelum gerhana, Elian mengajak [NAMA_USER] ke sebuah kuil terbengkalai di tepi jurang bawah tanah, dengan alasan untuk melakukan meditasi persiapan terakhir. Tanpa curiga sedikit pun, [NAMA_USER] mengikuti langkah pria itu. 

Setibanya di kuil yang dingin dan lembap tersebut, suasana tiba-tiba berubah. Pintu batu tebal tertutup rapat di belakang mereka dengan suara dentuman keras. Belasan pasukan Ordo Malam yang mengenakan topeng tengkorak melangkah keluar dari kegelapan, mengepung [NAMA_USER]. Di tengah kebingungan dan kepanikan, [NAMA_USER] menoleh ke arah Elian, berharap mentornya itu akan mengeluarkan pedangnya dan bertarung. Namun, yang terjadi justru menghancurkan hati [NAMA_USER] berkeping-keping. Elian berjalan tenang melewati barisan pasukan Ordo Malam, berbalik, dan menatap [NAMA_USER] dengan tatapan dingin tanpa belas kasihan. "Maafkan aku, Pembawa Takdir. Tapi kekuasaan yang dijanjikan Ordo Malam terlalu besar untuk kutolak," ucap Elian dengan nada datar. Pengkhianatan ini terasa lebih menyakitkan daripada seribu tusukan pedang. Orang yang paling ia percayai, orang yang membawanya masuk ke dunia ini, ternyata adalah musuh terbesarnya. Di tengah keputusasaan, kemarahan yang luar biasa mulai mendidih di dalam dada [NAMA_USER]. Jantung Aurora di lehernya bereaksi atas emosi tersebut, memancarkan cahaya merah yang menyilaukan dan membuat pasukan Ordo Malam mundur selangkah. Pertarungan yang sebenarnya baru saja akan dimulai.'
            ],
            [
                'title' => 'Kebenaran',
                'content' => 'Kuil terbengkalai itu kini menjadi saksi bisu pertarungan hebat antara [NAMA_USER] yang memendam amarah, melawan pasukan Ordo Malam dan Elian sang pengkhianat. Cahaya merah dari Jantung Aurora membentuk perisai magis yang menahan setiap serangan sihir gelap yang diarahkan padanya. Meski kalah jumlah, kekuatan tekad [NAMA_USER] tidak terbendung. Ia mengingat kembali semua pelajaran kakeknya, semua rasa sakit akibat kebohongan yang ia terima, dan menjadikannya kekuatan. Dengan satu hempasan energi yang sangat besar, [NAMA_USER] berhasil memukul mundur pasukan topeng tengkorak hingga mereka bergelimpangan di lantai batu. Kini, hanya tersisa ia dan Elian yang berdiri saling berhadapan, napas mereka memburu. Elian tersenyum sinis, mengeluarkan belati beracun yang sedari tadi ia sembunyikan. "Kau kuat, [NAMA_USER]. Tapi kau terlalu naif untuk memimpin," desisnya sambil menerjang maju dengan kecepatan kilat. Namun, [NAMA_USER] sudah memprediksi gerakan itu. Dengan kelincahan yang baru ia kuasai, [NAMA_USER] menghindar dan memberikan pukulan telak yang membuat belati itu terlempar ke jurang. Elian jatuh berlutut, tak berdaya. 

Saat itulah, cahaya bulan merah menembus celah atap kuil, jatuh tepat di atas tubuh [NAMA_USER]. Jantung Aurora bereaksi seketika, melepaskan gelombang kejut yang membersihkan seluruh energi gelap di tempat itu. Di tengah pendar cahaya yang menyilaukan, [NAMA_USER] melihat sebuah visi masa lalu yang sangat jelas. Ia melihat kebenaran yang sesungguhnya: kakeknya tidak dibunuh oleh Ordo Malam, melainkan mengorbankan dirinya sendiri untuk menyegel kekuatan asli artefak tersebut agar tidak merusak jiwa keturunannya. Kebenaran ini membuat [NAMA_USER] menitikkan air mata. Segala dendam yang ada di hatinya perlahan luruh. Ia memandang Elian yang gemetar ketakutan di lantai, dan memutuskan untuk tidak membunuhnya. Kemenangan sejati bukanlah tentang seberapa banyak musuh yang bisa dibunuh, melainkan seberapa kuat seseorang mempertahankan kemanusiaannya. Gerhana berakhir, dan fajar mulai menyingsing. [NAMA_USER] melangkah keluar dari kuil, menghirup udara kebebasan. Takdirnya kini berada di tangannya sendiri. Perjalanan panjang ini telah mengubahnya dari seorang pemimpi yang penakut, menjadi seorang Penjaga yang sesungguhnya. Dan dunia, untuk sementara waktu, akhirnya bisa bernapas lega.'
            ]
        ];

        // Looping untuk memasukkan data TAKDIR TERINDAH
        foreach ($chaptersData as $index => $chapter) {
            DB::table('story_contents')->insert([
                'story_id' => $storyId,
                'chapter_number' => $index + 1,
                'title' => $chapter['title'],
                'content' => $chapter['content'], 
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // =========================================================================
        // MULAI PENAMBAHAN 4 NOVEL BARU UNTUK PERPUSTAKAAN
        // =========================================================================
        
        $novelBaru = [
            [
                'title' => 'A THEORY DREAMING',
                'description' => 'Mimpi yang menjadi kenyataan membawa [NAMA_USER] melintasi batas realita dan imajinasi di malam yang penuh bintang.',
                'chapters' => [
                    ['title' => 'Dunia Kaca', 'content' => '[NAMA_USER] membuka mata dan menyadari langit tidak lagi biru, melainkan ungu gelap yang bertabur bintang raksasa. Semua bangunan di sekitarnya terbuat dari kaca transparan yang memantulkan kenangan masa kecilnya. "Apakah aku sedang bermimpi?" batin [NAMA_USER]. Namun hembusan angin dingin yang menerpa wajahnya terasa terlalu nyata untuk sebuah ilusi belaka. Di kejauhan, sebuah menara jam raksasa berdentang dengan jarum yang berputar mundur, menandakan bahwa waktu berjalan terbalik di dunia aneh ini.'],
                    ['title' => 'Penjaga Tidur', 'content' => 'Langkah kaki [NAMA_USER] membawanya ke sebuah jembatan yang terbuat dari jalinan cahaya. Di ujung jembatan, berdirilah sosok berjubah putih yang menyebut dirinya Sang Penjaga Tidur. "Kau tidak seharusnya berada di sini, [NAMA_USER], kecuali ada sesuatu di dunia nyata yang terlalu menyakitkan untuk kau hadapi," ucap sosok itu dengan suara lembut. [NAMA_USER] terdiam terpaku, menyadari bahwa ia memang sedang melarikan diri dari sebuah kenyataan pahit yang belum sanggup ia terima.'],
                ]
            ],
            [
                'title' => 'WHAT SHOULD BE WILD',
                'description' => 'Alam liar memanggil. [NAMA_USER] menemukan rahasia kelam dari hutan terlarang yang menyimpan kutukan kuno.',
                'chapters' => [
                    ['title' => 'Panggilan Hutan', 'content' => 'Sejak masih kecil, [NAMA_USER] selalu diperingatkan dengan keras untuk tidak pernah melewati batas pepohonan pinus tinggi di belakang desanya. Namun malam itu berbeda, sebuah nyanyian misterius menggema pelan dari dalam hutan, memanggil namanya berulang kali. Tanpa sadar dan seolah terhipnotis, kaki [NAMA_USER] melangkah memasuki kegelapan. Semakin dalam ia berjalan, pepohonan seolah bergerak menyibak, membuka jalan rahasia menuju sebuah reruntuhan kuil kuno yang dililit oleh akar-akar raksasa berduri.'],
                    ['title' => 'Kutukan Alam', 'content' => 'Di tengah halaman kuil yang hancur, seekor serigala berbulu perak bersinar menatap tajam ke arah [NAMA_USER] dengan mata yang memancarkan kebijaksanaan masa lalu. "Akhirnya kau datang juga, Anak Rimba," suara serigala itu bergema langsung di dalam pikiran [NAMA_USER]. Ia mulai menjelaskan bahwa hutan ini sedang sekarat karena sebuah kutukan manusia, dan hanya tetesan darah dari keturunan penjaga alam murni—yaitu [NAMA_USER]—yang bisa menyembuhkan kembali jantung hutan ini.'],
                ]
            ],
            [
                'title' => 'REWRITING MEMORIES',
                'description' => 'Memori yang terhapus perlahan kembali kepingan demi kepingan. [NAMA_USER] harus menyusun ulang masa lalunya yang penuh teka-teki.',
                'chapters' => [
                    ['title' => 'Kepingan Kosong', 'content' => '[NAMA_USER] menatap pantulan dirinya di cermin kamar mandi, merasa asing dengan wajahnya sendiri. Sudah tepat satu tahun berlalu sejak kecelakaan tragis itu merenggut hampir seluruh ingatannya. Namun hari ini, sebuah amplop hitam tanpa nama pengirim tergeletak manis di depan pintunya. Isinya hanya satu kalimat singkat yang diketik rapi: "Mereka berbohong tentang siapa dirimu sebenarnya." Jantung [NAMA_USER] berdegup kencang, firasat buruk mulai merayapi benaknya. Ia mulai menyadari bahwa orang-orang terdekat di sekitarnya mungkin menyimpan rahasia paling gelap tentang dirinya.'],
                    ['title' => 'Menyusun Ulang', 'content' => 'Mengikuti satu-satunya petunjuk alamat dari surat misterius itu, [NAMA_USER] tiba di sebuah perpustakaan kota yang sudah terbengkalai. Di dalam tumpukan dokumen usang di rak paling belakang, ia menemukan fotonya sendiri—diambil sepuluh tahun yang lalu—mengenakan seragam militer rahasia dari sebuah agensi yang tidak terdaftar. Rasa sakit yang luar biasa menusuk kepalanya saat serpihan memori tiba-tiba membanjiri otaknya. Kini ia tahu kenyataan pahit itu: ingatannya tidak hilang karena kecelakaan mobil, melainkan sengaja dihapus paksa karena ia mengetahui konspirasi yang terlalu berbahaya.'],
                ]
            ],
            [
                'title' => 'AFTERLIFE',
                'description' => 'Apa yang sebenarnya terjadi setelah kematian? [NAMA_USER] terbangun di sebuah dunia transisi yang tak dikenal dan harus mencari jalan pulang.',
                'chapters' => [
                    ['title' => 'Padang Sabana Terang', 'content' => 'Rasa sakit di sekujur tubuh yang terakhir kali [NAMA_USER] ingat kini telah lenyap sepenuhnya tanpa bekas. Ia perlahan terbangun di tengah hamparan padang sabana yang sangat luas dengan rumput yang memancarkan cahaya keemasan lembut. Langit di atasnya tidak memiliki matahari, awan, maupun bintang, namun keadaannya terang benderang. Tidak ada sedikit pun rasa lapar, haus, dingin, atau lelah yang tersisa. "Apakah aku... sudah mati?" bisik [NAMA_USER] gemetar. Di kejauhan sekelilingnya, bayangan-bayangan manusia bercahaya tampak berjalan sangat lambat, semuanya menuju satu arah yang sama: sebuah sungai perak berkilau di ujung cakrawala.'],
                    ['title' => 'Sang Penuntun', 'content' => 'Tepat sebelum [NAMA_USER] membiarkan kakinya melangkah masuk ke dalam air sungai perak itu, sebuah tangan kokoh menahannya dari belakang. "Jangan melangkah masuk, waktumu belum tiba," tegur sebuah suara bariton. [NAMA_USER] menoleh dan melihat seorang pria berjas rapi yang menyebut dirinya sebagai Sang Penuntun Jiwa. Ia memberi tahu [NAMA_USER] sebuah fakta mengejutkan: terjadi kesalahan teknis di alam semesta, dan jiwa [NAMA_USER] tidak sengaja ditarik keluar dari tubuhnya terlalu cepat. Kini, ia harus memenangkan sebuah ujian sulit untuk bisa berlomba dengan waktu, kembali ke tubuh fisiknya di rumah sakit sebelum garis kehidupan ditutup selamanya.'],
                ]
            ]
        ];

        // Looping untuk memasukkan 4 novel baru beserta ceritanya ke dalam database
        foreach ($novelBaru as $novel) {
            
            // Masukkan data ke tabel stories
            $newStoryId = DB::table('stories')->insertGetId([
                'user_id' => $userId, 
                'title' => $novel['title'],
                'description' => $novel['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Masukkan bab-bab ceritanya ke tabel story_contents
            foreach ($novel['chapters'] as $index => $chapter) {
                DB::table('story_contents')->insert([
                    'story_id' => $newStoryId,
                    'chapter_number' => $index + 1,
                    'title' => $chapter['title'],
                    'content' => $chapter['content'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}