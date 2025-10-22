<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatMunicipiosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Carga el catálogo de Municipios de Michoacán.
     */
    public function run(): void
    {
        
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('cat_municipios')->insert([
            [
                'id_municipio' => 1,
                'nombre_municipio' => 'Acuitzio',
                'clave_municipio' => '001'
            ],
            [
                'id_municipio' => 2,
                'nombre_municipio' => 'Aguililla',
                'clave_municipio' => '002'
            ],
            [
                'id_municipio' => 3,
                'nombre_municipio' => 'Álvaro Obregón',
                'clave_municipio' => '003'
            ],
            [
                'id_municipio' => 4,
                'nombre_municipio' => 'Angamacutiro',
                'clave_municipio' => '004'
            ],
            [
                'id_municipio' => 5,
                'nombre_municipio' => 'Angangueo',
                'clave_municipio' => '005'
            ],
            [
                'id_municipio' => 6,
                'nombre_municipio' => 'Apatzingán',
                'clave_municipio' => '006'
            ],
            [
                'id_municipio' => 7,
                'nombre_municipio' => 'Aporo',
                'clave_municipio' => '007'
            ],
            [
                'id_municipio' => 8,
                'nombre_municipio' => 'Aquila',
                'clave_municipio' => '008'
            ],
            [
                'id_municipio' => 9,
                'nombre_municipio' => 'Ario',
                'clave_municipio' => '009'
            ],
            [
                'id_municipio' => 10,
                'nombre_municipio' => 'Arteaga',
                'clave_municipio' => '010'
            ],
            [
                'id_municipio' => 11,
                'nombre_municipio' => 'Briseñas',
                'clave_municipio' => '011'
            ],
            [
                'id_municipio' => 12,
                'nombre_municipio' => 'Buenavista',
                'clave_municipio' => '012'
            ],
            [
                'id_municipio' => 13,
                'nombre_municipio' => 'Carácuaro',
                'clave_municipio' => '013'
            ],
            [
                'id_municipio' => 14,
                'nombre_municipio' => 'Coahuayana',
                'clave_municipio' => '014'
            ],
            [
                'id_municipio' => 15,
                'nombre_municipio' => 'Coalcomán de Vázquez Pallares',
                'clave_municipio' => '015'
            ],
            [
                'id_municipio' => 16,
                'nombre_municipio' => 'Coeneo',
                'clave_municipio' => '016'
            ],
            [
                'id_municipio' => 17,
                'nombre_municipio' => 'Contepec',
                'clave_municipio' => '017'
            ],
            [
                'id_municipio' => 18,
                'nombre_municipio' => 'Copándaro',
                'clave_municipio' => '018'
            ],
            [
                'id_municipio' => 19,
                'nombre_municipio' => 'Cotija',
                'clave_municipio' => '019'
            ],
            [
                'id_municipio' => 20,
                'nombre_municipio' => 'Cuitzeo',
                'clave_municipio' => '020'
            ],
            [
                'id_municipio' => 21,
                'nombre_municipio' => 'Charapan',
                'clave_municipio' => '021'
            ],
            [
                'id_municipio' => 22,
                'nombre_municipio' => 'Charo',
                'clave_municipio' => '022'
            ],
            [
                'id_municipio' => 23,
                'nombre_municipio' => 'Chavinda',
                'clave_municipio' => '023'
            ],
            [
                'id_municipio' => 24,
                'nombre_municipio' => 'Cherán',
                'clave_municipio' => '024'
            ],
            [
                'id_municipio' => 25,
                'nombre_municipio' => 'Chilchota',
                'clave_municipio' => '025'
            ],
            [
                'id_municipio' => 26,
                'nombre_municipio' => 'Chinicuila',
                'clave_municipio' => '026'
            ],
            [
                'id_municipio' => 27,
                'nombre_municipio' => 'Chucándiro',
                'clave_municipio' => '027'
            ],
            [
                'id_municipio' => 28,
                'nombre_municipio' => 'Churintzio',
                'clave_municipio' => '028'
            ],
            [
                'id_municipio' => 29,
                'nombre_municipio' => 'Churumuco',
                'clave_municipio' => '029'
            ],
            [
                'id_municipio' => 30,
                'nombre_municipio' => 'Ecuandureo',
                'clave_municipio' => '030'
            ],
            [
                'id_municipio' => 31,
                'nombre_municipio' => 'Epitacio Huerta',
                'clave_municipio' => '031'
            ],
            [
                'id_municipio' => 32,
                'nombre_municipio' => 'Erongarícuaro',
                'clave_municipio' => '032'
            ],
            [
                'id_municipio' => 33,
                'nombre_municipio' => 'Gabriel Zamora',
                'clave_municipio' => '033'
            ],
            [
                'id_municipio' => 34,
                'nombre_municipio' => 'Hidalgo',
                'clave_municipio' => '034'
            ],
            [
                'id_municipio' => 35,
                'nombre_municipio' => 'La Huacana',
                'clave_municipio' => '035'
            ],
            [
                'id_municipio' => 36,
                'nombre_municipio' => 'Huandacareo',
                'clave_municipio' => '036'
            ],
            [
                'id_municipio' => 37,
                'nombre_municipio' => 'Huaniqueo',
                'clave_municipio' => '037'
            ],
            [
                'id_municipio' => 38,
                'nombre_municipio' => 'Huetamo',
                'clave_municipio' => '038'
            ],
            [
                'id_municipio' => 39,
                'nombre_municipio' => 'Huiramba',
                'clave_municipio' => '039'
            ],
            [
                'id_municipio' => 40,
                'nombre_municipio' => 'Indaparapeo',
                'clave_municipio' => '040'
            ],
            [
                'id_municipio' => 41,
                'nombre_municipio' => 'Irimbo',
                'clave_municipio' => '041'
            ],
            [
                'id_municipio' => 42,
                'nombre_municipio' => 'Ixtlán',
                'clave_municipios' => '042'
            ],
            [
                'id_municipio' => 43,
                'nombre_municipio' => 'Jacona',
                'clave_municipio' => '043'
            ],
            [
                'id_municipio' => 44,
                'nombre_municipio' => 'Jiménez',
                'clave_municipio' => '044'
            ],
            [
                'id_municipio' => 45,
                'nombre_municipio' => 'Jiquilpan',
                'clave_municipio' => '045'
            ],
            [
                'id_municipio' => 46,
                'nombre_municipio' => 'José Sixto Verduzco',
                'clave_municipio' => '046'
            ],
            [
                'id_municipio' => 47,
                'nombre_municipio' => 'Juárez',
                'clave_municipio' => '047'
            ],
            [
                'id_municipio' => 48,
                'nombre_municipio' => 'Jungapeo',
                'clave_municipio' => '048'
            ],
            [
                'id_municipio' => 49,
                'nombre_municipio' => 'Lagunillas',
                'clave_municipio' => '049'
            ],
            [
                'id_municipio' => 50,
                'nombre_municipio' => 'Madero',
                'clave_municipio' => '050'
            ],
            [
                'id_municipio' => 51,
                'nombre_municipio' => 'Maravatío',
                'clave_municipio' => '051'
            ],
            [
                'id_municipio' => 52,
                'nombre_municipio' => 'Marcos Castellanos',
                'clave_municipio' => '052'
            ],
            [
                'id_municipio' => 53,
                'nombre_municipio' => 'Lázaro Cárdenas',
                'clave_municipio' => '053'
            ],
            [
                'id_municipio' => 54,
                'nombre_municipio' => 'Morelia',
                'clave_municipio' => '054'
            ],
            [
                'id_municipio' => 55,
                'nombre_municipio' => 'Morelos',
                'clave_municipio' => '055'
            ],
            [
                'id_municipio' => 56,
                'nombre_municipio' => 'Múgica',
                'clave_municipio' => '056'
            ],
            [
                'id_municipio' => 57,
                'nombre_municipio' => 'Nahuatzen',
                'clave_municipio' => '057'
            ],
            [
                'id_municipio' => 58,
                'nombre_municipio' => 'Nocupétaro',
                'clave_municipio' => '058'
            ],
            [
                'id_municipio' => 59,
                'nombre_municipio' => 'Nuevo Parangaricutiro',
                'clave_municipio' => '059'
            ],
            [
                'id_municipio' => 60,
                'nombre_municipio' => 'Nuevo Urecho',
                'clave_municipio' => '060'
            ],
            [
                'id_municipio' => 61,
                'nombre_municipio' => 'Numarán',
                'clave_municipio' => '061'
            ],
            [
                'id_municipio' => 62,
                'nombre_municipio' => 'Ocampo',
                'clave_municipio' => '062'
            ],
            [
                'id_municipio' => 63,
                'nombre_municipio' => 'Pajacuarán',
                'clave_municipio' => '063'
            ],
            [
                'id_municipio' => 64,
                'nombre_municipio' => 'Panindícuaro',
                'clave_municipio' => '064'
            ],
            [
                'id_municipio' => 65,
                'nombre_municipio' => 'Parácuaro',
                'clave_municipio' => '065'
            ],
            [
                'id_municipio' => 66,
                'nombre_municipio' => 'Paracho',
                'clave_municipio' => '066'
            ],
            [
                'id_municipio' => 67,
                'nombre_municipio' => 'Pátzcuaro',
                'clave_municipio' => '067'
            ],
            [
                'id_municipio' => 68,
                'nombre_municipio' => 'Penjamillo',
                'clave_municipio' => '068'
            ],
            [
                'id_municipio' => 69,
                'nombre_municipio' => 'Peribán',
                'clave_municipio' => '069'
            ],
            [
                'id_municipio' => 70,
                'nombre_municipio' => 'La Piedad',
                'clave_municipio' => '070'
            ],
            [
                'id_municipio' => 71,
                'nombre_municipio' => 'La Purúa',
                'clave_municipio' => '071'
            ],
            [
                'id_municipio' => 72,
                'nombre_municipio' => 'Queréndaro',
                'clave_municipio' => '072'
            ],
            [
                'id_municipio' => 73,
                'nombre_municipio' => 'Quiroga',
                'clave_municipio' => '073'
            ],
            [
                'id_municipio' => 74,
                'nombre_municipio' => 'Cojumatlán de Régules',
                'clave_municipio' => '074'
            ],
            [
                'id_municipio' => 75,
                'nombre_municipio' => 'Los Reyes',
                'clave_municipio' => '075'
            ],
            [
                'id_municipio' => 76,
                'nombre_municipio' => 'Sahuayo',
                'clave_municipio' => '076'
            ],
            [
                'id_municipio' => 77,
                'nombre_municipio' => 'San Lucas',
                'clave_municipio' => '077'
            ],
            [
                'id_municipio' => 78,
                'nombre_municipio' => 'Santa Ana Maya',
                'clave_municipio' => '078'
            ],
            [
                'id_municipio' => 79,
                'nombre_municipio' => 'Salvador Escalante',
                'clave_municipio' => '079'
            ],
            [
                'id_municipio' => 80,
                'nombre_municipio' => 'Senguio',
                'clave_municipio' => '080'
            ],
            [
                'id_municipio' => 81,
                'nombre_municipio' => 'Susupuato',
                'clave_municipio' => '081'
            ],
            [
                'id_municipio' => 82,
                'nombre_municipio' => 'Tacámbaro',
                'clave_municipio' => '082'
            ],
            [
                'id_municipio' => 83,
                'nombre_municipio' => 'Tancítaro',
                'clave_municipio' => '083'
            ],
            [
                'id_municipio' => 84,
                'nombre_municipio' => 'Tangamandapio',
                'clave_municipio' => '084'
            ],
            [
                'id_municipio' => 85,
                'nombre_municipio' => 'Tangancícuaro',
                'clave_municipio' => '085'
            ],
            [
                'id_municipio' => 86,
                'nombre_municipio' => 'Tanhuato',
                'clave_municipio' => '086'
            ],
            [
                'id_municipio' => 87,
                'nombre_municipio' => 'Taretan',
                'clave_municipio' => '087'
            ],
            [
                'id_municipio' => 88,
                'nombre_municipio' => 'Tarímbaro',
                'clave_municipio' => '088'
            ],
            [
                'id_municipio' => 89,
                'nombre_municipio' => 'Tepalcatepec',
                'clave_municipio' => '089'
            ],
            [
                'id_municipio' => 90,
                'nombre_municipio' => 'Tingambato',
                'clave_municipio' => '090'
            ],
            [
                'id_municipio' => 91,
                'nombre_municipio' => 'Tingüindín',
                'clave_municipio' => '091'
            ],
            [
                'id_municipio' => 92,
                'nombre_municipio' => 'Tiquicheo de Nicolás Romero',
                'clave_municipio' => '092'
            ],
            [
                'id_municipio' => 93,
                'nombre_municipio' => 'Tlalpujahua',
                'clave_municipio' => '093'
            ],
            [
                'id_municipio' => 94,
                'nombre_municipio' => 'Tlazazalca',
                'clave_municipio' => '094'
            ],
            [
                'id_municipio' => 95,
                'nombre_municipio' => 'Tocumbo',
                'clave_municipio' => '095'
            ],
            [
                'id_municipio' => 96,
                'nombre_municipio' => 'Tumbiscatío',
                'clave_municipio' => '096'
            ],
            [
                'id_municipio' => 97,
                'nombre_municipio' => 'Turicato',
                'clave_municipio' => '097'
            ],
            [
                'id_municipio' => 98,
                'nombre_municipio' => 'Tuxpan',
                'clave_municipio' => '098'
            ],
            [
                'id_municipio' => 99,
                'nombre_municipio' => 'Tuzantla',
                'clave_municipio' => '099'
            ],
            [
                'id_municipio' => 100,
                'nombre_municipio' => 'Tzintzuntzan',
                'clave_municipio' => '100'
            ],
            [
                'id_municipio' => 101,
                'nombre_municipio' => 'Tzitzio',
                'clave_municipio' => '101'
            ],
            [
                'id_municipio' => 102,
                'nombre_municipio' => 'Uruapan',
                'clave_municipio' => '102'
            ],
            [
                'id_municipio' => 103,
                'nombre_municipio' => 'Venustiano Carranza',
                'clave_municipio' => '103'
            ],
            [
                'id_municipio' => 104,
                'nombre_municipio' => 'Villamar',
                'clave_municipio' => '104'
            ],
            [
                'id_municipio' => 105,
                'nombre_municipio' => 'Vista Hermosa',
                'clave_municipio' => '105'
            ],
            [
                'id_municipio' => 106,
                'nombre_municipio' => 'Yurécuaro',
                'clave_municipio' => '106'
            ],
            [
                'id_municipio' => 107,
                'nombre_municipio' => 'Zacapu',
                'clave_municipio' => '107'
            ],
            [
                'id_municipio' => 108,
                'nombre_municipio' => 'Zamora',
                'clave_municipio' => '108'
            ],
            [
                'id_municipio' => 109,
                'nombre_municipio' => 'Zináparo',
                'clave_municipio' => '109'
            ],
            [
                'id_municipio' => 110,
                'nombre_municipio' => 'Zinapécuaro',
                'clave_municipio' => '110'
            ],
            [
                'id_municipio' => 111,
                'nombre_municipio' => 'Ziracuaretiro',
                'clave_municipio' => '111'
            ],
            [
                'id_municipio' => 112,
                'nombre_municipio' => 'Zitácuaro',
                'clave_municipio' => '112'
            ],
        ]);

        $maxId = DB::table('cat_municipios')->max('id_municipio');
        if ($maxId !== null) {
            // Establece el próximo valor de autoincremento al máximo ID + 1
            DB::statement('ALTER TABLE cat_municipios AUTO_INCREMENT = ' . ($maxId + 1));
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}