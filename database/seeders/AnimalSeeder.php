<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Animal;

class AnimalSeeder extends Seeder
{
    public function run()
    {
        Animal::create([
            'nom' => 'Le lion',
            'image' => 'lion.jpg',
            'son_animal' => 'lion.mp3',
            'description_son' => 'le lion rugit',
            'son_nom' => 'nlion.mp3',
            'description' => 'Le lion, souvent surnommé le roi de la savane, est un prédateur majestueux connu pour sa crinière imposante et son rugissement puissant. Il vit en groupe, appelé troupe, et incarne la force et la dominance.'
        ]);
        
        Animal::create([
            'nom' => 'L\'éléphant',
            'image' => 'elephant.jpg',
            'son_animal' => 'elephant.mp3',
            'description_son' => 'l\'éléphant barrit',
            'son_nom' => 'nelephant.mp3',
            'description' => 'L\'éléphant est le plus grand mammifère terrestre. Doté d’une intelligence remarquable, il utilise sa trompe polyvalente pour boire, attraper des objets et se rafraîchir. Il vit en groupes familiaux dirigés par une femelle matriarche.'
        ]);
        
        Animal::create([
            'nom' => 'Le tigre',
            'image' => 'tiger.jpg',
            'son_animal' => 'tigre.mp3',
            'description_son' => 'le tigre rugit',
            'son_nom' => 'ntigre.mp3',
            'description' => 'Le tigre est un grand félin solitaire et puissant. Sa fourrure rayée lui permet de se camoufler dans les hautes herbes pour chasser ses proies avec une précision redoutable. Il est l’un des prédateurs les plus agiles et rapides.'
        ]);
        
        Animal::create([
            'nom' => 'Le chat',
            'image' => 'cat.jpg',
            'son_animal' => 'chat.mp3',
            'description_son' => 'le chat miaule',
            'son_nom' => 'nchat.mp3',
            'description' => 'Le chat est un animal domestique apprécié pour son indépendance et sa capacité à chasser les petits rongeurs. Il communique avec son environnement par des miaulements et des ronronnements, souvent signe de bien-être.'
        ]);
        
        Animal::create([
            'nom' => 'Le chien',
            'image' => 'dog.jpg',
            'son_animal' => 'chien.mp3',
            'description_son' => 'le chien aboie',
            'son_nom' => 'nchien.mp3',
            'description' => 'Le chien est réputé pour sa fidélité et son intelligence. Compagnon de l’homme depuis des millénaires, il est utilisé pour la garde, la chasse et comme animal de compagnie affectueux et protecteur.'
        ]);
        
        
        
        
        Animal::create([
            'nom' => 'Le crocodile',
            'image' => 'crocodile.jpg',
            'son_animal' => 'crocodile.mp3',
            'description_son' => 'le crocodile grogne',
            'son_nom' => 'ncrocodile.mp3',
            'description' => 'Le crocodile est un reptile carnivore semi-aquatique doté de puissantes mâchoires et d’une peau écailleuse robuste. Il chasse en embuscade et peut rester immobile sous l’eau pendant de longues périodes.'
        ]);
        
        
        
        Animal::create([
            'nom' => 'La vache',
            'image' => 'vache.jpg',
            'son_animal' => 'vache.mp3',
            'description_son' => 'la vache meugle',
            'son_nom' => 'nvache.mp3',
            'description' => 'La vache est un mammifère herbivore domestiqué, connu pour sa production de lait et de viande. Elle vit en troupeaux et joue un rôle essentiel dans l’agriculture, contribuant à la fertilité des sols par son fumier.'
        ]);

        Animal::create([
            'nom' => 'Le singe',
            'image' => 'singe.jpg',
            'son_animal' => 'singe.mp3',
            'description_son' => 'le singe crie',
            'son_nom' => 'nsinge.mp3',
            'description' =>'Le singe est un primate intelligent et agile, souvent social, vivant en groupes. Il utilise des vocalisations variées pour communiquer et est connu pour sa curiosité et son habileté à manipuler des objets.'
        ]);

        Animal::create([
            'nom' => 'Le poulet',
            'image' => 'poulet.jpg',
            'son_animal' => 'poulet.mp3',
            'description_son' => 'le poulet chante',
            'son_nom' => 'npoulet.mp3',
            'description' => 'Le poulet est un oiseau domestique élevé principalement pour sa viande et ses œufs. Il est connu pour son cri distinctif, le « coq », et joue un rôle important dans l’agriculture et la cuisine dans de nombreuses cultures.'
        ]);

        Animal::create([
            'nom' => 'Le cheval',
            'image' => 'cheval.jpg',
            'son_animal' => 'cheval.mp3',
            'description_son' => 'le cheval hennit',
            'son_nom' => 'ncheval.mp3',
            'description' => 'Le cheval est un mammifère herbivore connu pour sa vitesse et son agilité. Utilisé depuis des siècles pour le transport, le travail agricole et les loisirs, il est également apprécié pour sa beauté et son intelligence.'
        ]);
        Animal::create([
            'nom' => 'La grenouille',
            'image' => 'grenouille.jpg',
            'son_animal' => 'grenouille.mp3',
            'description_son' => 'la grenouille coasse',
            'son_nom' => 'ngrenouille.mp3',
            'description' => 'La grenouille est un amphibien aquatique connu pour sa capacité à sauter et à nager. Elle se distingue par sa peau lisse et humide, et elle joue un rôle crucial dans les écosystèmes en tant que prédateur d’insectes et proie pour d’autres'
        ]);
        
        Animal::create([
            'nom' => 'Le coq',
            'image' => 'coq.jpg',
            'son_animal' => 'coq.mp3',
            'description_son' => 'le coq chante',
            'son_nom' => 'ncoq.mp3',
            'description' => 'le coq est un oiseau domestique, souvent considéré comme le roi de la basse-cour. Il est connu pour son chant matinal distinctif, le « cocorico », et joue un rôle important dans l’élevage de volailles.'
        ]);
        Animal::create([
            'nom' => 'La chèvre ',
            'image' => 'chevre.jpg',
            'son_animal' => 'chevre.mp3',
            'description_son' => 'la chèvre bêle',
            'son_nom' => 'nchevre.mp3',
            'description' => 'La chèvre est un mammifère herbivore connu pour sa curiosité et son agilité. Elle est souvent élevée pour'
        ]);
        Animal::create([
            'nom' => 'Le canard',
            'image' => 'canard.jpg',
            'son_animal' => 'canard.mp3',
            'description_son' => 'Le canard cancane',
            'son_nom' => 'ncanard.mp3',
            'description' => 'Le canard est un oiseau aquatique connu pour son plumage coloré et son cri distinctif. Il vit souvent près des étangs et des rivières, se nourrissant de plantes aquatiques et d’insectes. Le canard est également apprécié pour sa viande et ses œufs.'
        ]);
        Animal::create([
            'nom' => 'L\'âne',
            'image' => 'ane.jpg',
            'son_animal' => 'ane.mp3',
            'description_son' => 'L\'âne brait',
            'son_nom' => 'nane.mp3',
            'description' => 'L\'âne est un mammifère domestique, souvent utilisé comme animal de bât. Connu pour sa force et sa résistance, il est également apprécié pour son caractère docile et affectueux. L’âne a une grande capacité d’adaptation et joue un rôle important dans l’agriculture.'
        ]);
        Animal::create([
            'nom' => 'Le loup',
            'image' => 'loup.jpg',
            'son_animal' => 'loup.mp3',
            'description_son' => 'Le loup hurle',
            'son_nom' => 'nloup.mp3',
            'description' => 'Le loup est un prédateur social vivant en meute. Connu pour son intelligence et sa capacité à chasser en groupe, il joue un rôle crucial dans l\’équilibre des écosystèmes. Le loup est souvent associé à des légendes et des mythes dans de nombreuses cultures.'
            
        ]);
        Animal::create([
            'nom' => 'Le mouton',
            'image' => 'mouton.jpg',
            'son_animal' => 'mouton.mp3',
            'description_son' => 'Le mouton bêle',
            'son_nom' => 'nmouton.mp3',
            'description' => 'Le mouton est un mammifère herbivore domestiqué, élevé principalement pour sa laine, sa viande et son lait. Il vit en troupeaux et est connu pour son comportement grégaire, se déplaçant souvent en groupe pour se protéger des prédateurs.'
            
        ]);
        Animal::create([
            'nom' => 'L\'ours',
            'image' => 'ours.jpg',
            'son_animal' => 'ourspolaire.mp3',
            'description_son' => 'L\'ours grogne',
            'son_nom' => 'nours.mp3',
            'description' => 'L\'ours est un grand mammifère omnivore, connu pour sa force et sa taille imposante. Il vit dans divers habitats, des forêts aux montagnes, et est souvent associé à la nature sauvage. L’ours hiberne pendant l’hiver et joue un rôle important dans l’écosystème.'
            
        ]);


        
    }
}
