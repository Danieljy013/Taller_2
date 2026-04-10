<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JuegoController extends Controller
{
    // Array central de todos los juegos
    // ✏️ Para agregar un juego nuevo: copia un bloque y cambia el id
    // ✏️ Para cambiar imágenes: edita 'img', 'img_2', 'img_3' del juego
    private function getJuegos(): array
    {
        return [
            1 => [
                'nombre'      => 'EA Sports FC 24',
                'precio'      => 180,
                'categoria'   => 'Deportes',
                'plataforma'  => 'PC / PS5 / Xbox',
                'descripcion' => 'El fútbol más real de la historia. Licencias oficiales, más de 700 equipos y modos online competitivos con millones de jugadores.',
                // ✏️ Portada (también se usa en el hero y catálogo)
                'img'         => 'https://image.api.playstation.com/vulcan/ap/rnd/202307/0710/02c58aabf3579a5b5d9ff4ae72775e46c5d0e23d2bb1c020.png',
                // ✏️ Screenshot 2 (gameplay, partido en curso...)
                'img_2'       => 'https://a.espncdn.com/photo/2023/0710/r1196179_900x507_16-9.jpg',
                // ✏️ Screenshot 3 (estadio, modo carrera...)
                'img_3'       => 'https://assets-prd.ignimgs.com/2023/09/11/2-fc24-ratings-1x1-top-12-men-1694451773090.jpg',
                'tags'        => ['Fútbol', 'Multijugador', 'Online', 'Deportes'],
                'similares'   => [2, 3, 8], // ids de juegos relacionados
            ],
            2 => [
                'nombre'      => 'Red Dead Redemption 2',
                'precio'      => 300,
                'categoria'   => 'RPG',
                'plataforma'  => 'PC / PS5 / Xbox',
                'descripcion' => 'Es un aclamado videojuego de acción-aventura western de mundo abierto desarrollado por Rockstar Games. Ambientado en 1899, narra la caída del Salvaje Oeste, siguiendo a Arthur Morgan y la banda Van der Linde en su huida tras un robo fallido, ofreciendo una narrativa profunda, realismo extremo y un mundo inmersivo.',
                'img'         => 'https://eljugonsolitario.com/wp-content/uploads/2026/02/red_dead_rdemption_2_portada.jpg?w=816',
                'img_2'       => 'https://tecnogaming.com/wp-content/uploads/2018/08/Red-Dead-Redemption-2-Official-Gameplay-Video.jpg',
                'img_3'       => 'https://i0.wp.com/www.gamerfocus.co/wp-content/uploads/2022/05/mundos_abiertos_01.jpeg?resize=960%2C540&ssl=1',
                'tags'        => ['RPG', 'Mundo abierto', 'Narrativa profunda', 'Realismo extremo'],
                'similares'   => [1, 3, 9],
            ],
            3 => [
                'nombre'      => 'God of War Ragnarök',
                'precio'      => 200,
                'categoria'   => 'Acción',
                'plataforma'  => 'PS5 / PS4',
                'descripcion' => 'Kratos y Atreus enfrentan el Ragnarök nórdico en una aventura épica llena de acción brutal, exploración profunda y momentos emotivos.',
                'img'         => 'https://image.api.playstation.com/vulcan/ap/rnd/202207/1210/4xJ8XB3bi888QTLZYdl7Oi0s.png',
                'img_2'       => 'https://www.videogameschronicle.com/files/2021/09/God-of-War-Ragnarok-a-768x432.jpg',
                'img_3'       => 'https://static1-es.millenium.gg/articles/9/50/95/9/@/281955-god-of-orig-2-amp_main_media_schema-1.jpg',
                'tags'        => ['Acción', 'Aventura', 'Historia épica', 'Mundo abierto'],
                'similares'   => [4, 5, 9],
            ],
            4 => [
                'nombre'      => 'Dark Souls Remastered',
                'precio'      => 200,
                'categoria'   => 'Acción',
                'plataforma'  => 'PS5',
                'descripcion' => ' La historia comienza en la Era de los Antiguos, dominada por dragones. Tras la aparición de la Primera Llama, varios seres obtuvieron "Almas de Señores" y derrotaron a los dragones, iniciando la Era del Fuego. Sin embargo, la llama se está apagando, lo que provoca la aparición de la "Maldición del No Muerto" en los humanos.',
                'img'         => 'https://i.blogs.es/591b5a/280518-darksouls-review/1366_2000.jpg',
                'img_2'       => 'https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/570940/ss_3a71463e4ccaf28c5c27f6cf8d32a3a125f45404.1920x1080.jpg?t=1764975651',
                'img_3'       => 'https://media.vandal.net/master/5-2018/20185415530_1.jpg',
                'tags'        => ['Acción', 'Mundo abierto', 'Superhéroes', 'Historia'],
                'similares'   => [3, 5, 6],
            ],
            5 => [
                'nombre'      => 'Dark Souls 2 Scholar The First Sin II',
                'precio'      => 0,
                'categoria'   => 'Aventura',
                'plataforma'  => 'Xbox / PC',
                'descripcion' => 'Dark Souls II (2014) es un RPG de acción ambientado en el reino en ruinas de Drangleic, asolado por la "Maldición de los No Muertos". El jugador controla a un personaje maldito que busca una cura, enfrentando enemigos desafiantes y jefes en un mundo hostil para obtener almas, desentrañando una historia minimalista centrada en el ciclo de la vida, la muerte y la pérdida de la memoria.',
                'img'         => 'https://xombitgames.com/files/2015/04/Dark-Souls-2-Scholar-of-the-first-sin.jpg',
                'img_2'       => 'https://news-cdn.softpedia.com/images/news2/Dark-Souls-2-Scholar-of-the-First-Sin-Gets-Fresh-Gameplay-Video-New-Screenshots-477426-8.jpg',
                'img_3'       => 'https://i0.wp.com/todasgamers.com/wp-content/uploads/2017/01/13.jpg?resize=1538%2C865&ssl=1',
                'tags'        => ['Aventura', 'Historia', 'Survival', 'Postapocalíptico'],
                'similares'   => [3, 4, 9],
            ],
            6 => [
                'nombre'      => "Dark Souls 3",
                'precio'      => 300,
                'categoria'   => 'Acción',
                'plataforma'  => 'Xbox / PC',
                'descripcion' => 'Dark Souls 3 es el final de la saga y presenta un mundo, el Reino de Lothric, al borde del Apocalipsis por culpa de "la maldición de los no muertos", y la razón por la que el mundo aún no se ha sumido en la oscuridad totalmente es el sacrificio que muchos héroes e incluso dioses hicieron al reavivar la llama original, la cual se encarga de mantener la "Era del fuego", dejando que esta consumiera sus respectivas almas y cuerpos.',
                'img'         => 'https://www.desconsolados.com/wp-content/uploads/2016/04/dark_souls_3_logo.jpg',
                'img_2'       => 'https://images.squarespace-cdn.com/content/v1/55ef0e29e4b099e22cdc9eea/1455813567184-M5QZFVXTI83A7AN10J0S/image-asset.jpeg',
                'img_3'       => 'https://wallpapers.com/images/hd/dark-souls-3-castles-and-steeples-nie0c0h6fzje3hid.jpg',
                'tags'        => ['Acción', 'Sigilo', 'Mundo abierto', 'Historia'],
                'similares'   => [3, 4, 5],
            ],
            7 => [
                'nombre'      => 'Minecraft',
                'precio'      => 30,
                'categoria'   => 'Sandbox',
                'plataforma'  => 'PC / PS5 / Xbox / Móvil',
                'descripcion' => 'El juego más vendido de la historia. Construye, explora y sobrevive en un mundo generado proceduralmente. Creatividad sin límites.',
                'img'         => 'https://i.redd.it/i-need-help-finding-a-minecraft-cover-art-or-key-art-v0-8m5h8v41rvbd1.png?width=1280&format=png&auto=webp&s=982bae1ec5ad353234d7d84ed31892b0d2888785',
                'img_2'       => 'https://www.minecraft.net/content/dam/games/minecraft/key-art/MC_The-Wild-Update_540x300.jpg',
                'img_3'       => 'https://i.blogs.es/c702ea/minecraft-tamano/375_375.webp',
                'tags'        => ['Sandbox', 'Construcción', 'Multijugador', 'Supervivencia'],
                'similares'   => [1, 8, 2],
            ],
            8 => [
                'nombre'      => 'Cyberpunk 2077',
                'precio'      => 45,
                'categoria'   => 'RPG',
                'plataforma'  => 'PS5 / Xbox / PC',
                'descripcion' => 'Night City te espera. Un RPG de mundo abierto ambientado en un futuro distópico donde el cuerpo es modificable y el poder lo es todo.',
                'img'         => 'https://upload.wikimedia.org/wikipedia/en/9/9f/Cyberpunk_2077_box_art.jpg',
                'img_2'       => 'https://i.3djuegos.com/juegos/20297/cyberpunk_2077_ultimate_edition/fotos/ficha/cyberpunk_2077_ultimate_edition-5953768.webp',
                'img_3'       => 'https://i.blogs.es/a5c950/cyberpunk-2077/450_1000.webp',
                'tags'        => ['RPG', 'Mundo abierto', 'Sci-Fi', 'Historia épica'],
                'similares'   => [5, 6, 9],
            ],
            9 => [
                'nombre'      => 'Silent Hill 2 Remake',
                'precio'      => 300,
                'categoria'   => 'Terror',
                'plataforma'  => 'PS5 / PC',
                'descripcion' => 'El remake del survival horror más influyente de la historia. James Sunderland regresa a Silent Hill en busca de su esposa muerta.',
                'img'         => 'https://image.api.playstation.com/vulcan/ap/rnd/202210/2000/IgwsFz9BiBrFvyV7pIWpoVgd.png',
                'img_2'       => 'https://www.dexerto.com/cdn-image/wp-content/uploads/2024/08/19/SH2-Pool-cp.jpg?width=1200&quality=75&format=auto',
                'img_3'       => 'https://preview.redd.it/do-you-prefer-the-withered-otherworld-from-the-original-v0-nvpgugczcwif1.jpg?width=640&crop=smart&auto=webp&s=d16bb69ffb98e4e2239b978a7aaaa801fe75677a',
                'tags'        => ['Terror', 'Survival Horror', 'Historia', 'Remake'],
                'similares'   => [3, 5, 8],
            ],
        ];
    }

    public function show($id)
    {
        $juegos = $this->getJuegos();

        $juego = $juegos[$id] ?? null;

        if (!$juego) {
            abort(404);
        }

        // Construye el array de juegos similares con todos sus datos
        $similares = collect($juego['similares'])
            ->map(fn($sid) => isset($juegos[$sid])
                ? array_merge(['id' => $sid], $juegos[$sid])
                : null)
            ->filter()
            ->values()
            ->toArray();

        return view('juego', compact('juego', 'similares'));
    }
}