<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\User;
use PostSeeder;
use UserSeeder;
use CategorySeeder;
use Illuminate\Support\Str;
// use Illuminate\Support\Hash;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // $this->call(UserSeeder::class);
        // $this->call(CategorySeeder::class);
        // $this->call(PostSeeder::class);

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();



        //  Seed Users (Authors)
        DB::table('users')->insert([
            [
                'name' => 'Subscriber',
                'email' => 'subscriber@example.com',
                'password' => Hash::make('12341234'),
            ],
            [
                'name' => 'Writer',
                'email' => 'writer@example.com',
                'password' => Hash::make('12341234'),
            ],
            [
                'name' => 'Editor',
                'email' => 'editor@example.com',
                'password' => Hash::make('12341234'),
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('12341234'),
            ],
        ]);

        DB::table('categories')->insert([
            [
                'name' => 'Corvidae',
                'slug' => Str::slug('Corvidae'),
            ],
            [
                'name' => 'Psittacidae',
                'slug' => Str::slug('Psittacidae'),
            ],
            [
                'name' => 'Falconidae',
                'slug' => Str::slug('Falconidae'),
            ],
        ]);

        // Categoría Corvidae
        $corvidaeCategoryId = DB::table('categories')->where('name', 'Corvidae')->value('id');

        DB::table('posts')->insert([
            'user_id' => rand(1, 3),
            'category_id' => $corvidaeCategoryId,
            'slug' => Str::slug('Corvus corax'),
            'title' => 'Corvus corax',
            'content' => 'El cuervo grande (Corvus corax),anteriormente denominado cuervo común por la SEO es una especie de ave paseriforme de la familia Corvidae. Presente en casi todo el hemisferio septentrional, es la especie de córvido con la mayor superficie de distribución. A pesar de ello, la corneja negra (Corvus corone), de menor tamaño aunque muy similar en su aspecto morfológico externo, es muy abundante en sus propias áreas de distribución, por lo que a menudo se confunde a las cornejas negras con cuervos grandes. Con el cuervo de pico grueso, el cuervo grande es el mayor de los córvidos y probablemente la paseriforme más pesada; en su madurez, el cuervo grande mide entre 52 y 69 cm de longitud y su peso varía de 0,69 a 1,7 kg. Los cuervos grandes viven generalmente de diez a quince años, pero algunos individuos han vivido cuarenta años. Los jóvenes pueden desplazarse en grupos pero las parejas ya formadas permanecen juntas toda su vida, cada pareja defendiendo un territorio. Existen ocho subespecies conocidas que se diferencian muy poco aparentemente, aunque estudios recientes hayan demostrado diferencias genéticas significativas entre las poblaciones de distintas regiones.

    El cuervo grande coexiste con los humanos desde hace millares de años y en algunas regiones es tan abundante que se considera una especie nociva. Una parte de su éxito se debe a su régimen omnívoro; el cuervo grande es extremadamente oportunista, alimentándose de carroñas, de insectos, de residuos alimentarios, de cereales, de frutas y de pequeños animales. Se han observado varias demostraciones notables de resolución de problemas en esta especie, lo que hace pensar que el cuervo grande es muy inteligente.3​

    A través de los siglos, el cuervo grande ha sido objeto de mitos, de folclore y de representaciones en las artes y la literatura. En varias culturas antiguas —incluyendo las de Escandinavia, Irlanda, Gales, Bután, la costa noroeste de América del Norte, Siberia y noroeste de Asia— ha sido venerado como un dios o un símbolo espiritual.4​',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('posts')->insert([
            'user_id' => rand(1, 3),
            'category_id' => $corvidaeCategoryId,
            'slug' => Str::slug('Pica pica'),
            'title' => 'Pica pica',
            'content' => 'La urraca común (Pica pica),2​ también conocida como picaza, picaraza, marica y pega,3​4​5​ es una especie de ave paseriforme de la familia Corvidae que habita en Eurasia. Es una de las aves más comunes en Europa, vuela hasta una altitud no superior a los 1500 m s. n. m.

            La urraca común es una de las aves más inteligentes, y se cree que es más inteligente que la gran mayoría de los animales.6​ La extensión del cuerpo estriado de su encéfalo tiene el mismo tamaño relativo que el de los chimpancés, orangutanes y humanos.7​. Destaca por su cuerpo blanco y negro iridiscente, acabado en una larga cola de color azul o verde metálico dependiendo de cómo incida el sol, mide en torno a 45 cm de longitud con una envergadura de 60 cm. Es prácticamente inconfundible con otra ave.
            Los colores están distribuidos por su cuerpo de la siguiente forma: la cabeza, el pico, la cola y las patas son de color negro; el pecho y buena parte de las alas son blancas; la cola y las alas cobran un matiz azul o verde metalizado.
            Su cabeza y pico presentan la forma característica de la familia a la que pertenece, ojos pequeños y con un pico recto y fuerte.
            Se caracteriza también por su larga cola escalonada y por sus alas cortas y redondeadas, cosa que hace su silueta parecida a la del rabilargo.

            No presenta dimorfismo sexual, a excepción de una mayor corpulencia de los ejemplares machos.
            Su voz es un matraqueo áspero: tcha-tcha-tcha-tcha-tcha.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Categoría Psittacidae
        $psittacidaeCategoryId = DB::table('categories')->where('name', 'Psittacidae')->value('id');

        DB::table('posts')->insert([
            'user_id' => rand(1, 3),
            'category_id' => $psittacidaeCategoryId,
            'slug' => Str::slug('Amazona amazonica'),
            'title' => 'Amazona amazonica',
            'content' => 'El loro guaro o amazona alinaranja (Amazona amazonica)2​3​ es una especie de ave psitaciforme de la familia Psittacidae que vive en Sudamérica. Es un loro actualmente muy apreciado como mascota, al que se le puede enseñar a repetir palabras. Se trata de un loro mediano, que mide 33 cm de largo y pesa 340 g de promedio. Ambos sexos son similares. Su plumaje es principalmente verde con la frente blanca o amarilla, las mejillas amarillas y anillos oculares azules y también tiene azul el lorum. Además tiene las coberteras de la parte inferior de las alas anaranjadas.
            A. a. tobagensis, hallado solo en Trinidad y Tobago, es una subespecie que es mayor a la sp., y más anaranjado en las alas.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('posts')->insert([
            'user_id' => rand(1, 3),
            'category_id' => $psittacidaeCategoryId,
            'slug' => Str::slug('Nymphicus hollandicus'),
            'title' => 'Nymphicus hollandicus',
            'content' => 'La cacatúa ninfa, cocotilla o carolina (Nymphicus hollandicus)2​ es una especie de ave psitaciforme de la familia de las cacatúas y única especie del género Nymphicus. Es una especie endémica de Australia y una de las aves usadas como mascota más comunes, ocupando el segundo lugar en popularidad después del periquito australiano, además de ser la especie de cacatúa más pequeña del mundo.3​

            La cacatúa ninfa es la única especie del género Nymphicus. Anteriormente se la había emparentado con los loros encrestados o considerado como una cacatúa de pequeño tamaño. Sin embargo, estudios recientes de biología molecular la han asignado como subfamilia específica: Nymphicinae. Mide entre 30 y 33 cm.3​ Se caracteriza por tener una cresta eréctil y además, en contraste con la mayoría de las cacatúas, poseen unas plumas largas en la cola que pueden llegar a representar la mitad del tamaño total del ave. Su plumaje es, generalmente gris (a excepción de la variedad blanca, no confundir con la albina), con una mancha naranja en cada mejilla. Estos rasgos de plumaje difieren en sus distintas variedades (ninfa blanca, perlada, gris, etc.). ',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Categoría Falconidae
        $falconidaeCategoryId = DB::table('categories')->where('name', 'Falconidae')->value('id');

        DB::table('posts')->insert([
            'user_id' => rand(1, 3),
            'category_id' => $falconidaeCategoryId,
            'slug' => Str::slug('Falco peregrinus'),
            'title' => 'Falco peregrinus',
            'content' => 'El halcón peregrino2​ (Falco peregrinus) es una especie de ave falconiforme de la familia Falconidae de distribución cosmopolita. Es un halcón grande, del tamaño de un cuervo, con la espalda de color gris azulado y la parte inferior blanquecina con manchas oscuras; la cabeza es negra y cuenta con una amplia y característica bigotera también de color negro. Normalmente no vuela a velocidades superiores a los 100 km/h,3​ pero en picada o cuando caza y efectúa un ataque en picado puede alcanzar más de 300 km/h, lo que lo convierte en el animal más rápido del mundo.4​5​

            Como en otras aves de presa, la hembra es de mucho mayor tamaño que el macho.6​7​ Diversas autoridades reconocen diecisiete o diecinueve subespecies, que varían de aspecto y hábitat; hay desacuerdo sobre si el halcón tagarote (Falco pelegrinoides) es una subespecie o una especie distinta.

            La distribución geográfica de sus áreas de cría abarca desde la tundra ártica hasta el sur de América. Se le puede encontrar casi en todas partes de la Tierra, excepto en regiones polares extremas, montañas muy elevadas y selvas tropicales; la única área terrestre extensa sin hielo en la cual está completamente ausente es Nueva Zelanda, lo que la convierte en el ave de presa más extendida del mundo.8​ Tanto el nombre científico como el nombre en español de esta especie significan «halcón viajero», a causa de los hábitos migratorios de muchas poblaciones del norte.

            Aunque su dieta consiste casi exclusivamente en aves de tamaño medio, caza de vez en cuando pequeños mamíferos, pequeños reptiles e incluso insectos. Alcanza la madurez sexual en un año y se empareja de por vida. Anida en pequeñas oquedades en el suelo sin aportar ningún material, normalmente en bordes de acantilados o, en los últimos tiempos, en estructuras elevadas construidas por humanos.9​ El halcón peregrino se convirtió en una especie en peligro en muchas áreas debido al uso de pesticidas, sobre todo DDT. Desde la prohibición del DDT a principios de los años 1970, las poblaciones se recuperaron, apoyadas por la protección a gran escala de sus lugares de anidamiento y liberación de ejemplares en la naturaleza.10​',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('posts')->insert([
            'user_id' => rand(1, 3),
            'category_id' => $falconidaeCategoryId,
            'slug' => Str::slug('Falco tinnunculus'),
            'title' => 'Falco tinnunculus',
            'content' => 'El cernícalo vulgar es relativamente pequeño comparado con otras rapaces, pero más grande que la mayoría de las aves. Tiene alas largas de color bermejo con manchas negras, así como una larga cola muy distintiva, gris por la parte superior y de borde redondeado y negro. El plumaje de los machos en la cabeza es azul-grisáceo. Miden de 34 a 38 cm de cabeza a cola, y de 70 a 80 centímetros de envergadura de alas. El macho adulto medio pesa cerca de 155 g, y la hembra cerca de 190 g.
            Se distingue del cernícalo primilla por ser este último de dorso pardo rojizo y sin manchas negras, con un color gris en la cabeza más uniforme y por tener en la punta de la cola unas plumas centrales que sobresalen. Además, el común tiene las uñas negras y el primilla, blancas. El cernícalo es un ave de presa diurna y fácil de ver. Prefiere un hábitat de campo abierto y matorral. Los cernícalos nidifican en grietas de rocas o edificios, en huecos de árbol, ocupan nidos de córvidos y otras aves, pero también directamente sobre el suelo.
            Cuando caza, el cernícalo permanece en vuelo estacionario, casi inmóvil, entre 10 y 20 m de altura sobre el terreno, esperando avistar alguna presa (a esto se le llama cerner) y cuando aparece, se precipita en picado hacia ella aunque también es común que descienda suspendido y silenciosamente en vertical sobre la misma sin dar tiempo a que reaccione. Sus presas suelen ser pequeños mamíferos, fundamentalmente roedores, pequeños pájaros, reptiles, grandes insectos, gusanos y ranas.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);





        // Define permissions
        $createCommentsPermission = Permission::create(['name' => 'create comments']);
        $editOwnCommentsPermission = Permission::create(['name' => 'edit own comments']);
        $createPostsPermission = Permission::create(['name' => 'create posts']);
        $editOwnPostsPermission = Permission::create(['name' => 'edit own posts']);
        $editAnyPostPermission = Permission::create(['name' => 'edit any post']);
        $deleteAnyCommentPermission = Permission::create(['name' => 'delete any comment']);
        $manageCategories = Permission::create(['name' => 'manage categories']);
        $manageUsers = Permission::create(['name' => 'manage users']);

        // Define roles
        $subscriberRole = Role::create(['name' => 'subscriber']);
        $subscriberRole->givePermissionTo($createCommentsPermission, $editOwnCommentsPermission);

        $writerRole = Role::create(['name' => 'writer']);
        $writerRole->givePermissionTo($createPostsPermission, $editOwnPostsPermission);
        $writerRole->givePermissionTo($subscriberRole->permissions);

        $editorRole = Role::create(['name' => 'editor']);
        $editorRole->givePermissionTo($editAnyPostPermission, $deleteAnyCommentPermission, $manageCategories);
        $editorRole->givePermissionTo($writerRole->permissions);

        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo($manageUsers);
        $adminRole->givePermissionTo($editorRole->permissions);
        // $adminRole->syncPermissions(Permission::all());

        // Assign roles to users
        $subscriberUser = DB::table('users')->where('email', 'subscriber@example.com')->first();
        $writerUser = DB::table('users')->where('email', 'writer@example.com')->first();
        $editorUser = DB::table('users')->where('email', 'editor@example.com')->first();
        $adminUser = DB::table('users')->where('email', 'admin@example.com')->first();

        if ($subscriberUser) {
            $userModel = \App\Models\User::find($subscriberUser->id);
            $userModel->assignRole('subscriber');
        }

        if ($writerUser) {
            $userModel = \App\Models\User::find($writerUser->id);
            $userModel->assignRole('writer');
        }

        if ($editorUser) {
            $userModel = \App\Models\User::find($editorUser->id);
            $userModel->assignRole('editor');
        }

        if ($adminUser) {
            $userModel = \App\Models\User::find($adminUser->id);
            $userModel->assignRole('admin');
        }
    }
}
