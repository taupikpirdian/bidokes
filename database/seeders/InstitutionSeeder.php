<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Access;
use App\Models\Institution;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstitutionSeeder extends Seeder
{
    public function run()
    {
        $institutions = [
            [
                "parent_id" => 0,
                "code" => "01",
                "name" => "Polda Sumatera Selatan",
                "level" => 0,
                "polres" => [
                    [
                        "code" => "0101",
                        "name" => "Polrestabes Palembang",
                        "level" => 1,
                        "polsek" => [
                            ["code" => "010101", "name" => "Polsek IB I", "level" => 2],
                            ["code" => "010102", "name" => "Polsek IB II", "level" => 2],
                            ["code" => "010103", "name" => "Polsek IT I", "level" => 2],
                            ["code" => "010104", "name" => "Polsek IT II", "level" => 2],
                            ["code" => "010105", "name" => "Polsek Sako", "level" => 2],
                            ["code" => "010106", "name" => "Polsek Sukarami", "level" => 2],
                            ["code" => "010107", "name" => "Polsek Kalidoni", "level" => 2],
                            ["code" => "010108", "name" => "Polsek Kemuning", "level" => 2],
                            ["code" => "010109", "name" => "Polsek SU I", "level" => 2],
                            ["code" => "010110", "name" => "KSK Boom Baru", "level" => 2],
                            ["code" => "010111", "name" => "Polsek Kertapati", "level" => 2],
                            ["code" => "010112", "name" => "Polsek SU II", "level" => 2],
                            ["code" => "010113", "name" => "Polsek Plaju", "level" => 2],
                            ["code" => "010114", "name" => "Polsek Gandus", "level" => 2],
                        ],
                    ],
                    [
                        "code" => "0102",
                        "name" => "Polres Musi Banyuasin",
                        "level" => 1,
                        "polsek" => [
                            ["code" => "010201", "name" => "Polsek Sanga Desa", "level" => 2],
                            ["code" => "010202", "name" => "Polsek Plakat Tinggi", "level" => 2],
                            ["code" => "010203", "name" => "Polsek Sungai Lilin", "level" => 2],
                            ["code" => "010204", "name" => "Polsek Bayung Lencir", "level" => 2],
                            ["code" => "010205", "name" => "Polsek Tungkal Jaya", "level" => 2],
                            ["code" => "010206", "name" => "Polsek Babat Supat", "level" => 2],
                            ["code" => "010207", "name" => "Polsek Lais", "level" => 2],
                            ["code" => "010208", "name" => "Polsek Sekayu", "level" => 2],
                            ["code" => "010209", "name" => "Polsek Keluang", "level" => 2],
                            ["code" => "010210", "name" => "Polsek Batang Hari Leko", "level" => 2],
                            ["code" => "010211", "name" => "Polsek Lalan", "level" => 2],
                            ["code" => "010212", "name" => "Polsek Sungai Keruh", "level" => 2],
                            ["code" => "010213", "name" => "Polsek Babat Toman", "level" => 2],
                        ],
                    ],
                    [
                        "code" => "0103",
                        "name" => "Polres Lahat",
                        "level" => 1,
                        "polsek" => [
                            ["code" => "010301", "name" => "Polsek Kota Lahat", "level" => 2],
                            ["code" => "010302", "name" => "Polsek Merapi Barat", "level" => 2],
                            ["code" => "010303", "name" => "Polsek Pulau Pinang", "level" => 2],
                            ["code" => "010304", "name" => "Polsek Kota Agung", "level" => 2],
                            ["code" => "010305", "name" => "Polsek Mulak Ulu", "level" => 2],
                            ["code" => "010306", "name" => "Polsek Jarai", "level" => 2],
                            ["code" => "010307", "name" => "Polsek Pajar Bulan", "level" => 2],
                            ["code" => "010308", "name" => "Polsek Tanjung Sakti", "level" => 2],
                            ["code" => "010309", "name" => "Polsek Pseksu", "level" => 2],
                            ["code" => "010310", "name" => "Polsek Kikim Timur", "level" => 2],
                            ["code" => "010311", "name" => "Polsek Kikim Tengah", "level" => 2],
                            ["code" => "010312", "name" => "Polsek Kikim Barat", "level" => 2],
                            ["code" => "010313", "name" => "Polsek Kikim Selatan", "level" => 2],
                        ],
                    ],
                    [
                        "code" => "0104",
                        "name" => "Polres Prabumulih",
                        "level" => 1,
                        "polsek" => [
                            ["code" => "010401", "name" => "Polsek Prabumulih Timur", "level" => 2],
                            ["code" => "010402", "name" => "Polsek Prabumulih Barat", "level" => 2],
                            ["code" => "010403", "name" => "Polsek Rambang Kapak Tengah", "level" => 2],
                            ["code" => "010404", "name" => "Polsek Cambai", "level" => 2],
                        ],
                    ],
                    [
                        "code" => "0105",
                        "name" => "Polres Ogan Ilir",
                        "level" => 1,
                        "polsek" => [
                            ["code" => "010501", "name" => "Polsek Pemulutan", "level" => 2],
                            ["code" => "010502", "name" => "Polsek Indralaya", "level" => 2],
                            ["code" => "010503", "name" => "Polsek Tanjung Batu", "level" => 2],
                            ["code" => "010504", "name" => "Polsek Rantau Alai", "level" => 2],
                            ["code" => "010505", "name" => "Polsek Tanjung Raja", "level" => 2],
                            ["code" => "010506", "name" => "Polsek Muara Kuang", "level" => 2],
                        ],
                    ],
                    [
                        "code" => "0106",
                        "name" => "Polres Banyuasin",
                        "level" => 1,
                        "polsek" => [
                            ["code" => "010601", "name" => "Polsek Talang Kelapa", "level" => 2],
                            ["code" => "010602", "name" => "Polsek Mariana", "level" => 2],
                            ["code" => "010603", "name" => "Polsek Pangkalan Balai", "level" => 2],
                            ["code" => "010604", "name" => "Polsek Betung", "level" => 2],
                            ["code" => "010605", "name" => "Polsek Rambutan", "level" => 2],
                            ["code" => "010606", "name" => "Polsek Muara Telang", "level" => 2],
                            ["code" => "010607", "name" => "Polsek Rantau Bayur", "level" => 2],
                            ["code" => "010608", "name" => "Polsek Sungsang", "level" => 2],
                            ["code" => "010609", "name" => "Polsek Makarti Jaya", "level" => 2],
                            ["code" => "010610", "name" => "Polsek Muara Padang", "level" => 2],
                            ["code" => "010611", "name" => "Polsek Tanjung Lago", "level" => 2],
                            ["code" => "010612", "name" => "Polsek Tungkal Ilir", "level" => 2],
                            ["code" => "010613", "name" => "Polsek Air Kumbang", "level" => 2],
                            ["code" => "010614", "name" => "Polsek Pulau Rimau", "level" => 2],
                        ],
                    ],
                    [
                        "code" => "0107",
                        "name" => "Polres OKU",
                        "level" => 1,
                        "polsek" => [
                            ["code" => "010701", "name" => "Polsek Peninjaun", "level" => 2],
                            ["code" => "010702", "name" => "Polsek Lubuk Batang", "level" => 2],
                            ["code" => "010703", "name" => "Polsek Lubuk Raja", "level" => 2],
                            ["code" => "010704", "name" => "Polsek Sinar Peninjuan", "level" => 2],
                            ["code" => "010705", "name" => "Polsek Pengandonan", "level" => 2],
                            ["code" => "010706", "name" => "Polsek Ulu Ogan", "level" => 2],
                            ["code" => "010707", "name" => "Polsek Baturaja Barat", "level" => 2],
                            ["code" => "010708", "name" => "Polsek Baturaja Timur", "level" => 2],
                            ["code" => "010709", "name" => "Polsek Sosoh Buay Rayap", "level" => 2],
                            ["code" => "010710", "name" => "Polsek Lengkiti", "level" => 2],
                            ["code" => "010711", "name" => "Polsek Semidang Aji", "level" => 2],
                        ],
                    ],
                    [
                        "code" => "0108",
                        "name" => "Polres OKU Timur",
                        "level" => 1,
                        "polsek" => [
                            ["code" => "010801", "name" => "Polsek Martapura", "level" => 2],
                            ["code" => "010802", "name" => "Polsek BP Peliung", "level" => 2],
                            ["code" => "010803", "name" => "Polsek Buay Madang", "level" => 2],
                            ["code" => "010804", "name" => "Polsek Buay Madang Timur", "level" => 2],
                            ["code" => "010805", "name" => "Polsek Belitang I", "level" => 2],
                            ["code" => "010806", "name" => "Polsek Belitang II", "level" => 2],
                            ["code" => "010807", "name" => "Polsek Belitang III", "level" => 2],
                            ["code" => "010808", "name" => "Polsek Madang Suku I", "level" => 2],
                            ["code" => "010809", "name" => "Polsek Madang Suku II", "level" => 2],
                            ["code" => "010810", "name" => "Polsek Semendawai Suku III", "level" => 2],
                            ["code" => "010811", "name" => "Polsek Cempaka", "level" => 2],
                        ],
                    ],
                    [
                        "code" => "0109",
                        "name" => "Polres OKU Selatan",
                        "level" => 1,
                        "polsek" => [
                            ["code" => "010901", "name" => "Polsek Banding Agung", "level" => 2],
                            ["code" => "010902", "name" => "Polsek Buay Pemaca", "level" => 2],
                            ["code" => "010903", "name" => "Polsek Buay Runjung", "level" => 2],
                            ["code" => "010904", "name" => "Polsek Buay Sandang Aji", "level" => 2],
                            ["code" => "010905", "name" => "Polsek Kisam Tinggi", "level" => 2],
                            ["code" => "010906", "name" => "Polsek Mekakau Ilir", "level" => 2],
                            ["code" => "010907", "name" => "Polsek Muara Dua", "level" => 2],
                            ["code" => "010908", "name" => "Polsek Muara Dua Kisam", "level" => 2],
                            ["code" => "010909", "name" => "Polsek Pulau Beringin", "level" => 2],
                            ["code" => "010910", "name" => "Polsek Simpang Martapura", "level" => 2],
                        ],
                    ],
                    [
                        "code" => "0110",
                        "name" => "Polres Lubuk Linggau",
                        "level" => 1,
                        "polsek" => [
                            ["code" => "011001", "name" => "Polsek Lubuklinggau Barat", "level" => 2],
                            ["code" => "011002", "name" => "Polsek Lubuklinggau Utara", "level" => 2],
                            ["code" => "011003", "name" => "Polsek Lubuklinggau Timur", "level" => 2],
                            ["code" => "011004", "name" => "Polsek Lubuklinggau Selatan", "level" => 2],
                        ],
                    ],
                    [
                        "code" => "0111",
                        "name" => "Polres Pagar Alam",
                        "level" => 1,
                        "polsek" => [
                            ["code" => "011101", "name" => "Polsek Pagaralam Utara", "level" => 2],
                            ["code" => "011102", "name" => "Polsek Pagaralam Selatan", "level" => 2],
                            ["code" => "011103", "name" => "Polsek Dempo Utara", "level" => 2],
                            ["code" => "011104", "name" => "Polsek Dempo Tengah", "level" => 2],
                            ["code" => "011105", "name" => "Polsek Dempo Selatan", "level" => 2],
                        ],
                    ],
                    [
                        "code" => "0112",
                        "name" => "Polres Empat Lawang",
                        "level" => 1,
                        "polsek" => [
                            ["code" => "011201", "name" => "Polsek Tebing Tinggi", "level" => 2],
                            ["code" => "011202", "name" => "Polsek Pendopo", "level" => 2],
                            ["code" => "011203", "name" => "Polsek Ulu Musi", "level" => 2],
                            ["code" => "011204", "name" => "Polsek Paiker", "level" => 2],
                            ["code" => "011205", "name" => "Polsek Muara Pinang", "level" => 2],
                            ["code" => "011206", "name" => "Polsek Lintang Kanan", "level" => 2],
                            ["code" => "011207", "name" => "Polsek Tanjung Padang", "level" => 2],
                        ],
                    ],
                    [
                        "code" => "0113",
                        "name" => "Polres Musi Rawas",
                        "level" => 1,
                        "polsek" => [
                            ["code" => "011301", "name" => "Polsek Megang Sakti", "level" => 2],
                            ["code" => "011302", "name" => "Polsek Jaya Loka", "level" => 2],
                            ["code" => "011303", "name" => "Polsek Muara Lakitan", "level" => 2],
                            ["code" => "011304", "name" => "Polsek Purwodadi", "level" => 2],
                            ["code" => "011305", "name" => "Polsek STL Ulu Terawas", "level" => 2],
                            ["code" => "011306", "name" => "Polsek Tugu Mulyo", "level" => 2],
                            ["code" => "011307", "name" => "Polsek Muara Kelingi", "level" => 2],
                            ["code" => "011308", "name" => "Polsek BTS Ulu Cecar", "level" => 2],
                            ["code" => "011309", "name" => "Polsek Muara Beliti", "level" => 2],
                        ],
                    ],
                    [
                        "code" => "0114",
                        "name" => "Polres OKI",
                        "level" => 1,
                        "polsek" => [
                            ["code" => "011401", "name" => "Polsek Kayu Agung", "level" => 2],
                            ["code" => "011402", "name" => "Polsek Pedamaran", "level" => 2],
                            ["code" => "011403", "name" => "Polsek Tanjung Lubuk", "level" => 2],
                            ["code" => "011404", "name" => "Polsek Lempuing", "level" => 2],
                            ["code" => "011405", "name" => "Polsek Lempuing Jaya", "level" => 2],
                            ["code" => "011406", "name" => "Polsek Mesuji", "level" => 2],
                            ["code" => "011407", "name" => "Polsek Mesuji Makmur", "level" => 2],
                            ["code" => "011408", "name" => "Polsek Pedamaran Timur", "level" => 2],
                            ["code" => "011409", "name" => "Polsek Cengal", "level" => 2],
                            ["code" => "011410", "name" => "Polsek Sungai Menang", "level" => 2],
                            ["code" => "011411", "name" => "Polsek SP. Padang", "level" => 2],
                            ["code" => "011412", "name" => "Polsek Pampangan", "level" => 2],
                            ["code" => "011413", "name" => "Polsek Pangkalan Lampam", "level" => 2],
                            ["code" => "011414", "name" => "Polsek Tulung Selapan", "level" => 2],
                            ["code" => "011415", "name" => "Polsek Jejawi", "level" => 2],
                            ["code" => "011416", "name" => "Polsek Air Sugihan", "level" => 2],
                            ["code" => "011417", "name" => "Polsek Teluk Gelam", "level" => 2],
                            ["code" => "011418", "name" => "Polsek Mesuji Raya", "level" => 2],
                        ],
                    ],
                    [
                        "code" => "0115",
                        "name" => "Polres Muara Enim",
                        "level" => 1,
                        "polsek" => [
                            ["code" => "011501", "name" => "Polsek Semendo", "level" => 2],
                            ["code" => "011502", "name" => "Polsek Tanjung Agung", "level" => 2],
                            ["code" => "011503", "name" => "Polsek Lawang Kidul", "level" => 2],
                            ["code" => "011504", "name" => "Polsek Gunung Megang", "level" => 2],
                            ["code" => "011505", "name" => "Polsek Rambang Dangku", "level" => 2],
                            ["code" => "011506", "name" => "Polsek Rambang", "level" => 2],
                            ["code" => "011507", "name" => "Polsek Rambang Lubai", "level" => 2],
                            ["code" => "011508", "name" => "Polsek Lembak", "level" => 2],
                            ["code" => "011509", "name" => "Polsek Gelumbang", "level" => 2],
                            ["code" => "011510", "name" => "Polsek Sungai Rotan", "level" => 2],
                        ],
                    ],
                    [
                        "code" => "0116",
                        "name" => "Polres Muratara",
                        "level" => 1,
                        "polsek" => [
                            ["code" => "011601", "name" => "Polsek Karang Jaya", "level" => 2],
                            ["code" => "011602", "name" => "Polsek Muara Rupit", "level" => 2],
                            ["code" => "011603", "name" => "Polsek Rawas Ulu", "level" => 2],
                            ["code" => "011604", "name" => "Polsek Rawas Ilir", "level" => 2],
                            ["code" => "011605", "name" => "Polsek Karang Dapo", "level" => 2],
                            ["code" => "011606", "name" => "Polsek Nibung", "level" => 2],
                        ],
                    ],
                    [
                        "code" => "0117",
                        "name" => "Polres Pali",
                        "level" => 1,
                        "polsek" => [
                            ["code" => "011701", "name" => "Polsek Talang Ubi", "level" => 2],
                            ["code" => "011702", "name" => "Polsek Tanah Abang", "level" => 2],
                            ["code" => "011703", "name" => "Polsek Penukal Abab", "level" => 2],
                            ["code" => "011704", "name" => "Polsek Penukal Utara", "level" => 2],
                        ],
                    ],
                ],
            ],
        ];

        Institution::truncate();
        User::truncate();
        Access::truncate();
        foreach ($institutions as $polda) {
            $poldaId = DB::table('institutions')->insertGetId([
                'parent_id' => $polda['parent_id'],
                'code' => $polda['code'],
                'name' => $polda['name'],
                'level' => $polda['level'],
            ]);
            $this->generateUser($polda['name'], 'polda', $poldaId);

            foreach ($polda['polres'] as $polres) {
                $polresId = DB::table('institutions')->insertGetId([
                    'parent_id' => $poldaId,
                    'code' => $polres['code'],
                    'name' => $polres['name'],
                    'level' => $polres['level'],
                ]);
                $this->generateUser($polres['name'], 'polres', $polresId);

                foreach ($polres['polsek'] as $polsek) {
                    $polsekId = DB::table('institutions')->insertGetId([
                        'parent_id' => $polresId,
                        'code' => $polsek['code'],
                        'name' => $polsek['name'],
                        'level' => $polsek['level'],
                    ]);
                    $this->generateUser($polsek['name'], 'polsek', $polsekId);
                }
            }
        }
    }

    function generateUser($name, $role, $institutionId)
    {
        // lowercase and remove space on $name param
        $username = Str::lower(str_replace(' ', '', $name));

        $user = User::create([
            'name' => $name,
            'email' => $username . '@sopintas.com',
            'password' => bcrypt('P@ssw0rd'),
        ]);

        $user->assignRole($role);

        // assign access
        Access::create([
            'user_id' => $user->id,
            'institution_id' => $institutionId,
        ]);
        return $user;
    }
}
