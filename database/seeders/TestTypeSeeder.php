<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\TestType;

class TestTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TestType::insert([
            //weight
            ['name' => 'Peso',
            'unit' => 'kg',
            'calc_type' => 'direct',
            'calc_key' => 'weight',
            'higher' => false,
            'description' => 'As crianças e adolescentes devem ser aferidas preferencialmente em trajes de educação física e descalços. Deverão manter-se em pé com os cotovelos (braços) estendidos e juntos ao corpo. ',
            'video_url' => 'https://www.youtube.com/embed/8qA14Jb2p5M'],

            //height
            ['name' => 'Estatura',
            'unit' => 'cm',
            'calc_type' => 'direct',
            'calc_key' => 'height',
            'higher' => false,
            'description' => 'Na utilização da fita métrica (considerando que normalmente mede 150 cm) se aconselha prendê-la à parede a 100 cm do solo, estendendo-a de baixo para cima (neste caso o avaliador não poderá esquecer de acrescentar 100 cm ao
                            resultado aferido pela fita métrica). Para a leitura da estatura deve ser utilizado um dispositivo em forma de esquadro (ver a figura abaixo). Deste modo um dos lados do esquadro é fixado à parede e o lado perpendicular inferior junto à cabeça do aluno
                            avaliado (este procedimento elimina erros decorrentes das possíveis inclinações de materiais tais como réguas ou pranchetas quando livremente apoiados apenas sobre a cabeça do sujeito avaliado).',
            'video_url' => 'https://www.youtube.com/embed/j-9_DJwJYFk'],

            //waist
            ['name' => 'Cintura',
            'unit' => 'cm',
            'calc_type' => 'direct',
            'calc_key' => 'waist',
            'higher' => false,
            'description' => 'A medida é realizada no ponto médio entre a borda inferior da última costela e a borda superior da crista ilíaca.',
            'video_url' => 'https://www.youtube.com/embed/OkhNPXFhL7g '],

            //body mass index
            ['name' => 'IMC',
            'unit' => 'kg/m²',
            'calc_type' => 'derived',
            'calc_key' => 'bmi',
            'higher' => false,
            'description' => 'É determinado através do cálculo da razão (divisão) entre a medida de massa corporal total em quilogramas pela estatura em metros elevada ao quadrado (kg/m²). A medida é registrada com uma casa após a vírgula. ',
            'video_url' => ''],

            //waist ratio
            ['name' => 'Razão Cintura Estatura',
            'unit' => 'razao cintura estatura',
            'calc_type' => 'derived',
            'calc_key' => 'wtr',
            'higher' => false,
            'description' => ' É determinado através do cálculo da razão (divisão) entre a medida do perímetro da cintura em cm e a estatura em cm [cintura(cm)/estatura(cm)]. A medida é registrada com uma casa após a virgula.',
            'video_url' => ''],

            //sit and reach
            ['name' => 'Flexibilidade',
            'unit' => 'cm',
            'calc_type' => 'direct',
            'calc_key' => null,
            'higher' => true,
            'description' => 'O aluno, com os joelhos estendidos e os pés fixos, tenta alcançar a maior distância à frente com as mãos. A distância é registrada em centímetros.',
            'video_url' => 'https://www.youtube.com/embed/cdugHSL6C_o'],

            //abdominals
            ['name' => 'Força Abdominal',
            'unit' => 'repetições',
            'calc_type' => 'direct',
            'calc_key' => null,
            'higher' => true,
            'description' => 'O aluno realiza o maior número de abdominais corretos em 1 minuto. Avalia a resistência abdominal.',
            'video_url' => 'https://www.youtube.com/embed/Y2ppstBWUfg'],

            //6min run
            ['name' => 'Aptidão Cardiorrespiratória',
            'unit' => 'metros',
            'calc_type' => 'direct',
            'calc_key' => null,
            'higher' => true,
            'description' => 'O aluno corre ou caminha pelo maior tempo possível durante 6 minutos. A distância percorrida é registrada em metros.',
            'video_url' => 'https://www.youtube.com/embed/1YxMuyf6cVs'],

            //medicine ball throw
            ['name' => 'Força Membros Superiores',
            'unit' => 'cm',
            'calc_type' => 'direct',
            'calc_key' => null,
            'higher' => true,
            'description' => 'O aluno lança uma bola de 2kg da posição sentada. Mede-se a distância do arremesso em centímetros.',
            'video_url' => 'https://www.youtube.com/embed/MiIxu4vovzI'],

            //horizontal jump
            ['name' => 'Força Membros Inferiores',
            'unit' => 'cm',
            'calc_type' => 'direct',
            'calc_key' => null,
            'higher' => true,
            'description' => 'O aluno salta o mais longe que conseguir, com os dois pés, a partir de uma linha. Mede-se a distância em centímetros.',
            'video_url' => 'https://www.youtube.com/embed/XhYAobKfh9M'],

            //square run
            ['name' => 'Agilidade',
            'unit' => 'segundos',
            'calc_type' => 'direct',
            'calc_key' => null,
            'higher' => false,
            'description' => 'O aluno corre dentro de um quadrado de 4x4 metros, tocando os cones indicados. Mede-se o tempo em segundos e centésimos.',
            'video_url' => 'https://www.youtube.com/embed/UmtKjnxLJGo'],

            //20m run
            ['name' => 'Velocidade',
            'unit' => 'segundos',
            'calc_type' => 'direct',
            'calc_key' => null,
            'higher' => false,
            'description' => 'Avalia a velocidade do aluno em uma corrida de 20 metros. O tempo é registrado com cronômetro.',
            'video_url' => 'https://www.youtube.com/embed/G3BoIAaTX-U'],
        ]);
    }
}
