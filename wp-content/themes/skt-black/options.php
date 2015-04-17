<?php 

/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */ 

function optionsframework_option_name() {
	// Change this to use your theme slug
	return 'optionsframework_skt_black';
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'skt-black'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {
	//array of all custom font types.
	$font_types = array( '' => '', 'Arial' => 'Arial',
		'Comic Sans MS' => 'Comic Sans MS',
		'FreeSans' => 'FreeSans',
		'Georgia' => 'Georgia',
		'Lucida Sans Unicode' => 'Lucida Sans Unicode',
		'Palatino Linotype' => 'Palatino Linotype',
		'Symbol' => 'Symbol',
		'Tahoma' => 'Tahoma',
		'Trebuchet MS' => 'Trebuchet MS',
		'Verdana' => 'Verdana',
		'ABeeZee' => 'ABeeZee',
		'Abel' => 'Abel',
		'Abril Fatface' => 'Abril Fatface',
		'Aclonica' => 'Aclonica',
		'Acme' => 'Acme',
		'Actor' => 'Actor',
		'Adamina' => 'Adamina',
		'Advent Pro' => 'Advent Pro',
		'Aguafina Script' => 'Aguafina Script',
		'Akronim' => 'Akronim',
		'Aladin' => 'Aladin',
		'Aldrich' => 'Aldrich',
		'Alegreya' => 'Alegreya',
		'Alegreya SC' => 'Alegreya SC',
		'Alex Brush' => 'Alex Brush',
		'Alfa Slab One' => 'Alfa Slab One',
		'Alice' => 'Alice',
		'Alike' => 'Alike',
		'Alike Angular' => 'Alike Angular',
		'Allan' => 'Allan',
		'Allerta' => 'Allerta',
		'Allerta Stencil' => 'Allerta Stencil',
		'Allura' => 'Allura',
		'Almendra' => 'Almendra',
		'Almendra Display' => 'Almendra Display',
		'Almendra SC' => 'Almendra SC',
		'Amarante' => 'Amarante',
		'Amaranth' => 'Amaranth',
		'Amatic SC' => 'Amatic SC',
		'Amethysta' => 'Amethysta',
		'Anaheim' => 'Anaheim',
		'Andada' => 'Andada',
		'Andika' => 'Andika',
		'Annie Use Your Telescope' => 'Annie Use Your Telescope',
		'Anonymous Pro' => 'Anonymous Pro',
		'Antic' => 'Antic',
		'Antic Didone' => 'Antic Didone',
		'Antic Slab' => 'Antic Slab',
		'Anton' => 'Anton',
		'Arapey' => 'Arapey',
		'Arbutus' => 'Arbutus',
		'Arbutus Slab' => 'Arbutus Slab',
		'Architects Daughter' => 'Architects Daughter',
		'Archivo Black' => 'Archivo Black',
		'Archivo Narrow' => 'Archivo Narrow',
		'Arimo' => 'Arimo',
		'Arizonia' => 'Arizonia',
		'Armata' => 'Armata',
		'Artifika' => 'Artifika',
		'Arvo' => 'Arvo',
		'Asap' => 'Asap',
		'Asset' => 'Asset',
		'Astloch' => 'Astloch',
		'Asul' => 'Asul',
		'Atomic Age' => 'Atomic Age',
		'Aubrey' => 'Aubrey',
		'Audiowide' => 'Audiowide',
		'Autour One' => 'Autour One',
		'Average' => 'Average',
		'Average Sans' => 'Average Sans',
		'Averia Gruesa Libre' => 'Averia Gruesa Libre',
		'Averia Libre' => 'Averia Libre',
		'Averia Sans Libre' => 'Averia Sans Libre',
		'Averia Serif Libre' => 'Averia Serif Libre',
		'Bad Script' => 'Bad Script',
		'Balthazar' => 'Balthazar',
		'Bangers' => 'Bangers',
		'Basic' => 'Basic',
		'Baumans' => 'Baumans',
		'Belgrano' => 'Belgrano',
		'Belleza' => 'Belleza',
		'BenchNine' => 'BenchNine',
		'Bentham' => 'Bentham',
		'Berkshire Swash' => 'Berkshire Swash',
		'Bevan' => 'Bevan',
		'Bigelow Rules' => 'Bigelow Rules',
		'Bigshot One' => 'Bigshot One',
		'Bilbo' => 'Bilbo',
		'Bilbo Swash Caps' => 'Bilbo Swash Caps',
		'Bitter' => 'Bitter',
		'Black Ops One' => 'Black Ops One',
		'Bonbon' => 'Bonbon',
		'Boogaloo' => 'Boogaloo',
		'Bowlby One' => 'Bowlby One',
		'Bowlby One SC' => 'Bowlby One SC',
		'Brawler' => 'Brawler',
		'Bree Serif' => 'Bree Serif',
		'Bubblegum Sans' => 'Bubblegum Sans',
		'Bubbler One' => 'Bubbler One',
		'Buda' => 'Buda',
		'Buenard' => 'Buenard',
		'Butcherman' => 'Butcherman',
		'Butcherman Caps' => 'Butcherman Caps',
		'Butterfly Kids' => 'Butterfly Kids',
		'Cabin' => 'Cabin',
		'Cabin Condensed' => 'Cabin Condensed',
		'Cabin Sketch' => 'Cabin Sketch',
		'Cabin' => 'Cabin',
		'Caesar Dressing' => 'Caesar Dressing',
		'Cagliostro' => 'Cagliostro',
		'Calligraffitti' => 'Calligraffitti',
		'Cambo' => 'Cambo',
		'Candal' => 'Candal',
		'Cantarell' => 'Cantarell',
		'Cantata One' => 'Cantata One',
		'Cantora One' => 'Cantora One',
		'Capriola' => 'Capriola',
		'Cardo' => 'Cardo',
		'Carme' => 'Carme',
		'Carrois Gothic' => 'Carrois Gothic',
		'Carrois Gothic SC' => 'Carrois Gothic SC',
		'Carter One' => 'Carter One',
		'Caudex' => 'Caudex',
		'Cedarville Cursive' => 'Cedarville Cursive',
		'Ceviche One' => 'Ceviche One',
		'Changa One' => 'Changa One',
		'Chango' => 'Chango',
		'Chau Philomene One' => 'Chau Philomene One',
		'Chela One' => 'Chela One',
		'Chelsea Market' => 'Chelsea Market',
		'Cherry Cream Soda' => 'Cherry Cream Soda',
		'Cherry Swash' => 'Cherry Swash',
		'Chewy' => 'Chewy',
		'Chicle' => 'Chicle',
		'Chivo' => 'Chivo',
		'Cinzel' => 'Cinzel',
		'Cinzel Decorative' => 'Cinzel Decorative',
		'Clicker Script' => 'Clicker Script',
		'Coda' => 'Coda',
		'Codystar' => 'Codystar',
		'Combo' => 'Combo',
		'Comfortaa' => 'Comfortaa',
		'Coming Soon' => 'Coming Soon',
		'Condiment' => 'Condiment',
		'Contrail One' => 'Contrail One',
		'Convergence' => 'Convergence',
		'Cookie' => 'Cookie',
		'Copse' => 'Copse',
		'Corben' => 'Corben',
		'Courgette' => 'Courgette',
		'Cousine' => 'Cousine',
		'Coustard' => 'Coustard',
		'Covered By Your Grace' => 'Covered By Your Grace',
		'Crafty Girls' => 'Crafty Girls',
		'Creepster' => 'Creepster',
		'Creepster Caps' => 'Creepster Caps',
		'Crete Round' => 'Crete Round',
		'Crimson' => 'Crimson',
		'Croissant One' => 'Croissant One',
		'Crushed' => 'Crushed',
		'Cuprum' => 'Cuprum',
		'Cutive' => 'Cutive',
		'Cutive Mono' => 'Cutive Mono',
		'Damion' => 'Damion',
		'Dancing Script' => 'Dancing Script',
		'Dawning of a New Day' => 'Dawning of a New Day',
		'Days One' => 'Days One',
		'Delius' => 'Delius',
		'Delius Swash Caps' => 'Delius Swash Caps',
		'Delius Unicase' => 'Delius Unicase',
		'Della Respira' => 'Della Respira',
		'Denk One' => 'Denk One',
		'Devonshire' => 'Devonshire',
		'Didact Gothic' => 'Didact Gothic',
		'Diplomata' => 'Diplomata',
		'Diplomata SC' => 'Diplomata SC',
		'Domine' => 'Domine',
		'Donegal One' => 'Donegal One',
		'Doppio One' => 'Doppio One',
		'Dorsa' => 'Dorsa',
		'Dosis' => 'Dosis',
		'Dr Sugiyama' => 'Dr Sugiyama',
		'Droid Sans' => 'Droid Sans',
		'Droid Sans Mono' => 'Droid Sans Mono',
		'Droid Serif' => 'Droid Serif',
		'Duru Sans' => 'Duru Sans',
		'Dynalight' => 'Dynalight',
		'EB Garamond' => 'EB Garamond',
		'Eagle Lake' => 'Eagle Lake',
		'Eater' => 'Eater',
		'Eater Caps' => 'Eater Caps',
		'Economica' => 'Economica',
		'Electrolize' => 'Electrolize',
		'Elsie' => 'Elsie',
		'Elsie Swash Caps' => 'Elsie Swash Caps',
		'Emblema One' => 'Emblema One',
		'Emilys Candy' => 'Emilys Candy',
		'Engagement' => 'Engagement',
		'Englebert' => 'Englebert',
		'Enriqueta' => 'Enriqueta',
		'Erica One' => 'Erica One',
		'Esteban' => 'Esteban',
		'Euphoria Script' => 'Euphoria Script',
		'Ewert' => 'Ewert',
		'Exo' => 'Exo',
		'Expletus Sans' => 'Expletus Sans',
		'Fanwood Text' => 'Fanwood Text',
		'Fascinate' => 'Fascinate',
		'Fascinate Inline' => 'Fascinate Inline',
		'Faster One' => 'Faster One',
		'Federant' => 'Federant',
		'Federo' => 'Federo',
		'Felipa' => 'Felipa',
		'Fenix' => 'Fenix',
		'Finger Paint' => 'Finger Paint',
		'Fjalla One' => 'Fjalla One',
		'Fjord One' => 'Fjord One',
		'Flamenco' => 'Flamenco',
		'Flavors' => 'Flavors',
		'Fondamento' => 'Fondamento',
		'Fontdiner Swanky' => 'Fontdiner Swanky',
		'Forum' => 'Forum',
		'Francois One' => 'Francois One',
		'Freckle Face' => 'Freckle Face',
		'Fredericka the Great' => 'Fredericka the Great',
		'Fredoka One' => 'Fredoka One',
		'Fresca' => 'Fresca',
		'Frijole' => 'Frijole',
		'Fruktur' => 'Fruktur',
		'Fugaz One' => 'Fugaz One',
		'Gafata' => 'Gafata',
		'Galdeano' => 'Galdeano',
		'Galindo' => 'Galindo',
		'Gentium Basic' => 'Gentium Basic',
		'Gentium Book Basic' => 'Gentium Book Basic',
		'Geo' => 'Geo',
		'Geostar' => 'Geostar',
		'Geostar Fill' => 'Geostar Fill',
		'Germania One' => 'Germania One',
		'Gilda Display' => 'Gilda Display',
		'Give You Glory' => 'Give You Glory',
		'Glass Antiqua' => 'Glass Antiqua',
		'Glegoo' => 'Glegoo',
		'Gloria Hallelujah' => 'Gloria Hallelujah',
		'Goblin One' => 'Goblin One',
		'Gochi Hand' => 'Gochi Hand',
		'Gorditas' => 'Gorditas',
		'Goudy Bookletter 1911' => 'Goudy Bookletter 1911',
		'Graduate' => 'Graduate',
		'Grand Hotel' => 'Grand Hotel',
		'Gravitas One' => 'Gravitas One',
		'Great Vibes' => 'Great Vibes',
		'Griffy' => 'Griffy',
		'Gruppo' => 'Gruppo',
		'Gudea' => 'Gudea',
		'Habibi' => 'Habibi',
		'Hammersmith One' => 'Hammersmith One',
		'Hanalei' => 'Hanalei',
		'Hanalei Fill' => 'Hanalei Fill',
		'Handlee' => 'Handlee',
		'Happy Monkey' => 'Happy Monkey',
		'Headland One' => 'Headland One',
		'Henny Penny' => 'Henny Penny',
		'Herr Von Muellerhoff' => 'Herr Von Muellerhoff',
		'Holtwood One SC' => 'Holtwood One SC',
		'Homemade Apple' => 'Homemade Apple',
		'Homenaje' => 'Homenaje',
		'IM Fell' => 'IM Fell',
		'Iceberg' => 'Iceberg',
		'Iceland' => 'Iceland',
		'Imprima' => 'Imprima',
		'Inconsolata' => 'Inconsolata',
		'Inder' => 'Inder',
		'Indie Flower' => 'Indie Flower',
		'Inika' => 'Inika',
		'Irish Growler' => 'Irish Growler',
		'Istok Web' => 'Istok Web',
		'Italiana' => 'Italiana',
		'Italianno' => 'Italianno',
		'Jacques Francois' => 'Jacques Francois',
		'Jacques Francois Shadow' => 'Jacques Francois Shadow',
		'Jim Nightshade' => 'Jim Nightshade',
		'Jockey One' => 'Jockey One',
		'Jolly Lodger' => 'Jolly Lodger',
		'Josefin Sans' => 'Josefin Sans',
		'Josefin Sans' => 'Josefin Sans',
		'Josefin Slab' => 'Josefin Slab',
		'Joti One' => 'Joti One',
		'Judson' => 'Judson',
		'Julee' => 'Julee',
		'Julius Sans One' => 'Julius Sans One',
		'Junge' => 'Junge',
		'Jura' => 'Jura',
		'Just Another Hand' => 'Just Another Hand',
		'Just Me Again Down Here' => 'Just Me Again Down Here',
		'Kameron' => 'Kameron',
		'Karla' => 'Karla',
		'Kaushan Script' => 'Kaushan Script',
		'Kavoon' => 'Kavoon',
		'Keania One' => 'Keania One',
		'Kelly Slab' => 'Kelly Slab',
		'Kenia' => 'Kenia',
		'Kite One' => 'Kite One',
		'Knewave' => 'Knewave',
		'Kotta One' => 'Kotta One',
		'Kranky' => 'Kranky',
		'Kreon' => 'Kreon',
		'Kristi' => 'Kristi',
		'Krona One' => 'Krona One',
		'La Belle Aurore' => 'La Belle Aurore',
		'Lancelot' => 'Lancelot',
		'Lato' => 'Lato',
		'League Script' => 'League Script',
		'Leckerli One' => 'Leckerli One',
		'Ledger' => 'Ledger',
		'Lekton' => 'Lekton',
		'Lemon' => 'Lemon',
		'Libre Baskerville' => 'Libre Baskerville',
		'Life Savers' => 'Life Savers',
		'Lilita One' => 'Lilita One',
		'Limelight' => 'Limelight',
		'Linden Hill' => 'Linden Hill',
		'Lobster' => 'Lobster',
		'Lobster Two' => 'Lobster Two',
		'Londrina Outline' => 'Londrina Outline',
		'Londrina Shadow' => 'Londrina Shadow',
		'Londrina Sketch' => 'Londrina Sketch',
		'Londrina Solid' => 'Londrina Solid',
		'Lora' => 'Lora',
		'Love Ya Like A Sister' => 'Love Ya Like A Sister',
		'Loved by the King' => 'Loved by the King',
		'Lovers Quarrel' => 'Lovers Quarrel',
		'Luckiest Guy' => 'Luckiest Guy',
		'Lusitana' => 'Lusitana',
		'Lustria' => 'Lustria',
		'Macondo' => 'Macondo',
		'Macondo Swash Caps' => 'Macondo Swash Caps',
		'Magra' => 'Magra',
		'Maiden Orange' => 'Maiden Orange',
		'Mako' => 'Mako',
		'Marcellus' => 'Marcellus',
		'Marcellus SC' => 'Marcellus SC',
		'Marck Script' => 'Marck Script',
		'Margarine' => 'Margarine',
		'Marko One' => 'Marko One',
		'Marmelad' => 'Marmelad',
		'Marvel' => 'Marvel',
		'Mate' => 'Mate',
		'Mate SC' => 'Mate SC',
		'Maven Pro' => 'Maven Pro',
		'McLaren' => 'McLaren',
		'Meddon' => 'Meddon',
		'MedievalSharp' => 'MedievalSharp',
		'Medula One' => 'Medula One',
		'Megrim' => 'Megrim',
		'Meie Script' => 'Meie Script',
		'Merienda' => 'Merienda',
		'Merienda One' => 'Merienda One',
		'Merriweather' => 'Merriweather',
		'Metal Mania' => 'Metal Mania',
		'Metamorphous' => 'Metamorphous',
		'Metrophobic' => 'Metrophobic',
		'Michroma' => 'Michroma',
		'Milonga' => 'Milonga',
		'Miltonian' => 'Miltonian',
		'Miltonian Tattoo' => 'Miltonian Tattoo',
		'Miniver' => 'Miniver',
		'Miss Fajardose' => 'Miss Fajardose',
		'Miss Saint Delafield' => 'Miss Saint Delafield',
		'Modern Antiqua' => 'Modern Antiqua',
		'Molengo' => 'Molengo',
		'Molle' => 'Molle',
		'Monda' => 'Monda',
		'Monofett' => 'Monofett',
		'Monoton' => 'Monoton',
		'Monsieur La Doulaise' => 'Monsieur La Doulaise',
		'Montaga' => 'Montaga',
		'Montez' => 'Montez',
		'Montserrat' => 'Montserrat',
		'Montserrat Alternates' => 'Montserrat Alternates',
		'Montserrat Subrayada' => 'Montserrat Subrayada',
		'Mountains of Christmas' => 'Mountains of Christmas',
		'Mouse Memoirs' => 'Mouse Memoirs',
		'Mr Bedford' => 'Mr Bedford',
		'Mr Bedfort' => 'Mr Bedfort',
		'Mr Dafoe' => 'Mr Dafoe',
		'Mr De Haviland' => 'Mr De Haviland',
		'Mrs Saint Delafield' => 'Mrs Saint Delafield',
		'Mrs Sheppards' => 'Mrs Sheppards',
		'Muli' => 'Muli',
		'Mystery Quest' => 'Mystery Quest',
		'Neucha' => 'Neucha',
		'Neuton' => 'Neuton',
		'New Rocker' => 'New Rocker',
		'News Cycle' => 'News Cycle',
		'Niconne' => 'Niconne',
		'Nixie One' => 'Nixie One',
		'Nobile' => 'Nobile',
		'Norican' => 'Norican',
		'Nosifer' => 'Nosifer',
		'Nosifer Caps' => 'Nosifer Caps',
		'Noticia Text' => 'Noticia Text',
		'Nova Round' => 'Nova Round',
		'Numans' => 'Numans',
		'Nunito' => 'Nunito',
		'Offside' => 'Offside',
		'Oldenburg' => 'Oldenburg',
		'Oleo Script' => 'Oleo Script',
		'Oleo Script Swash Caps' => 'Oleo Script Swash Caps',
		'Open Sans' => 'Open Sans',
		'Open Sans Condensed' => 'Open Sans Condensed',
		'Oranienbaum' => 'Oranienbaum',
		'Orbitron' => 'Orbitron',
		'Oregano' => 'Oregano',
		'Orienta' => 'Orienta',
		'Original Surfer' => 'Original Surfer',
		'Oswald' => 'Oswald',
		'Over the Rainbow' => 'Over the Rainbow',
		'Overlock' => 'Overlock',
		'Overlock SC' => 'Overlock SC',
		'Ovo' => 'Ovo',
		'Oxygen' => 'Oxygen',
		'Oxygen Mono' => 'Oxygen Mono',
		'PT Mono' => 'PT Mono',
		'PT Sans' => 'PT Sans',
		'PT Sans Narrow' => 'PT Sans Narrow',
		'PT Serif' => 'PT Serif',
		'PT Serif Caption' => 'PT Serif Caption',
		'Pacifico' => 'Pacifico',
		'Paprika' => 'Paprika',
		'Parisienne' => 'Parisienne',
		'Passero One' => 'Passero One',
		'Passion One' => 'Passion One',
		'Patrick Hand' => 'Patrick Hand',
		'Patua One' => 'Patua One',
		'Paytone One' => 'Paytone One',
		'Peralta' => 'Peralta',
		'Permanent Marker' => 'Permanent Marker',
		'Petit Formal Script' => 'Petit Formal Script',
		'Petrona' => 'Petrona',
		'Philosopher' => 'Philosopher',
		'Piedra' => 'Piedra',
		'Pinyon Script' => 'Pinyon Script',
		'Pirata One' => 'Pirata One',
		'Plaster' => 'Plaster',
		'Play' => 'Play',
		'Playball' => 'Playball',
		'Playfair Display' => 'Playfair Display',
		'Playfair Display SC' => 'Playfair Display SC',
		'Podkova' => 'Podkova',
		'Poiret One' => 'Poiret One',
		'Poller One' => 'Poller One',
		'Poly' => 'Poly',
		'Pompiere' => 'Pompiere',
		'Pontano Sans' => 'Pontano Sans',
		'Port Lligat Sans' => 'Port Lligat Sans',
		'Port Lligat Slab' => 'Port Lligat Slab',
		'Prata' => 'Prata',
		'Press Start 2P' => 'Press Start 2P',
		'Princess Sofia' => 'Princess Sofia',
		'Prociono' => 'Prociono',
		'Prosto One' => 'Prosto One',
		'Puritan' => 'Puritan',
		'Purple Purse' => 'Purple Purse',
		'Quando' => 'Quando',
		'Quantico' => 'Quantico',
		'Quattrocento' => 'Quattrocento',
		'Quattrocento Sans' => 'Quattrocento Sans',
		'Questrial' => 'Questrial',
		'Quicksand' => 'Quicksand',
		'Quintessential' => 'Quintessential',
		'Qwigley' => 'Qwigley',
		'Racing Sans One' => 'Racing Sans One',
		'Radley' => 'Radley',
		'Raleway Dots' => 'Raleway Dots',
		'Raleway' => 'Raleway',
		'Rambla' => 'Rambla',
		'Rammetto One' => 'Rammetto One',
		'Ranchers' => 'Ranchers',
		'Rancho' => 'Rancho',
		'Rationale' => 'Rationale',
		'Redressed' => 'Redressed',
		'Reenie Beanie' => 'Reenie Beanie',
		'Revalia' => 'Revalia',
		'Ribeye' => 'Ribeye',
		'Ribeye Marrow' => 'Ribeye Marrow',
		'Righteous' => 'Righteous',
		'Risque' => 'Risque',
		'Roboto' => 'Roboto',
		'Roboto Condensed' => 'Roboto Condensed',
		'Rochester' => 'Rochester',
		'Rock Salt' => 'Rock Salt',
		'Rokkitt' => 'Rokkitt',
		'Romanesco' => 'Romanesco',
		'Ropa Sans' => 'Ropa Sans',
		'Rosario' => 'Rosario',
		'Rosarivo' => 'Rosarivo',
		'Rouge Script' => 'Rouge Script',
		'Ruda' => 'Ruda',
		'Rufina' => 'Rufina',
		'Ruge Boogie' => 'Ruge Boogie',
		'Ruluko' => 'Ruluko',
		'Rum Raisin' => 'Rum Raisin',
		'Ruslan Display' => 'Ruslan Display',
		'Russo One' => 'Russo One',
		'Ruthie' => 'Ruthie',
		'Rye' => 'Rye',
		'Sacramento' => 'Sacramento',
		'Sail' => 'Sail',
		'Salsa' => 'Salsa',
		'Sanchez' => 'Sanchez',
		'Sancreek' => 'Sancreek',
		'Sansita One' => 'Sansita One',
		'Sarina' => 'Sarina',
		'Satisfy' => 'Satisfy',
		'Scada' => 'Scada',
		'Schoolbell' => 'Schoolbell',
		'Seaweed Script' => 'Seaweed Script',
		'Sevillana' => 'Sevillana',
		'Seymour One' => 'Seymour One',
		'Shadows Into Light' => 'Shadows Into Light',
		'Shadows Into Light Two' => 'Shadows Into Light Two',
		'Shanti' => 'Shanti',
		'Share' => 'Share',
		'Share Tech' => 'Share Tech',
		'Share Tech Mono' => 'Share Tech Mono',
		'Shojumaru' => 'Shojumaru',
		'Short Stack' => 'Short Stack',
		'Sigmar One' => 'Sigmar One',
		'Signika' => 'Signika',
		'Signika Negative' => 'Signika Negative',
		'Simonetta' => 'Simonetta',
		'Sirin Stencil' => 'Sirin Stencil',
		'Six Caps' => 'Six Caps',
		'Skranji' => 'Skranji',
		'Slackey' => 'Slackey',
		'Smokum' => 'Smokum',
		'Smythe' => 'Smythe',
		'Sniglet' => 'Sniglet',
		'Snippet' => 'Snippet',
		'Snowburst One' => 'Snowburst One',
		'Sofadi One' => 'Sofadi One',
		'Sofia' => 'Sofia',
		'Sonsie One' => 'Sonsie One',
		'Sorts Mill Goudy' => 'Sorts Mill Goudy',
		'Sorts Mill Goudy' => 'Sorts Mill Goudy',
		'Source Code Pro' => 'Source Code Pro',
		'Source Sans Pro' => 'Source Sans Pro',
		'Special I am one' => 'Special I am one',
		'Spicy Rice' => 'Spicy Rice',
		'Spinnaker' => 'Spinnaker',
		'Spirax' => 'Spirax',
		'Squada One' => 'Squada One',
		'Stalemate' => 'Stalemate',
		'Stalinist One' => 'Stalinist One',
		'Stardos Stencil' => 'Stardos Stencil',
		'Stint Ultra Condensed' => 'Stint Ultra Condensed',
		'Stint Ultra Expanded' => 'Stint Ultra Expanded',
		'Stoke' => 'Stoke',
		'Stoke' => 'Stoke',
		'Strait' => 'Strait',
		'Sue Ellen Francisco' => 'Sue Ellen Francisco',
		'Sunshiney' => 'Sunshiney',
		'Supermercado One' => 'Supermercado One',
		'Swanky and Moo Moo' => 'Swanky and Moo Moo',
		'Syncopate' => 'Syncopate',
		'Tangerine' => 'Tangerine',
		'Telex' => 'Telex',
		'Tenor Sans' => 'Tenor Sans',
		'Terminal Dosis' => 'Terminal Dosis',
		'Terminal Dosis Light' => 'Terminal Dosis Light',
		'Text Me One' => 'Text Me One',
		'The Girl Next Door' => 'The Girl Next Door',
		'Tienne' => 'Tienne',
		'Tinos' => 'Tinos',
		'Titan One' => 'Titan One',
		'Titillium Web' => 'Titillium Web',
		'Trade Winds' => 'Trade Winds',
		'Trocchi' => 'Trocchi',
		'Trochut' => 'Trochut',
		'Trykker' => 'Trykker',
		'Tulpen One' => 'Tulpen One',
		'Ubuntu' => 'Ubuntu',
		'Ubuntu Condensed' => 'Ubuntu Condensed',
		'Ubuntu Mono' => 'Ubuntu Mono',
		'Ultra' => 'Ultra',
		'Uncial Antiqua' => 'Uncial Antiqua',
		'Underdog' => 'Underdog',
		'Unica One' => 'Unica One',
		'UnifrakturCook' => 'UnifrakturCook',
		'UnifrakturMaguntia' => 'UnifrakturMaguntia',
		'Unkempt' => 'Unkempt',
		'Unlock' => 'Unlock',
		'Unna' => 'Unna',
		'VT323' => 'VT323',
		'Vampiro One' => 'Vampiro One',
		'Varela' => 'Varela',
		'Varela Round' => 'Varela Round',
		'Vast Shadow' => 'Vast Shadow',
		'Vibur' => 'Vibur',
		'Vidaloka' => 'Vidaloka',
		'Viga' => 'Viga',
		'Voces' => 'Voces',
		'Volkhov' => 'Volkhov',
		'Vollkorn' => 'Vollkorn',
		'Voltaire' => 'Voltaire',
		'Waiting for the Sunrise' => 'Waiting for the Sunrise',
		'Wallpoet' => 'Wallpoet',
		'Walter Turncoat' => 'Walter Turncoat',
		'Warnes' => 'Warnes',
		'Wellfleet' => 'Wellfleet',
		'Wendy One' => 'Wendy One',
		'Wire One' => 'Wire One',
		'Yanone Kaffeesatz' => 'Yanone Kaffeesatz',
		'Yellowtail' => 'Yellowtail',
		'Yeseva One' => 'Yeseva One',
		'Yesteryear' => 'Yesteryear',
		'Zeyada' => 'Zeyada'
	);
	
		$wp_editor_settings = array(
		'wpautop' => true, // Default
		'textarea_rows' => 15,
		'tinymce' => array( 'plugins' => 'wordpress' )
	);
	
	// array of section content.
	$section_text = array(
		1 => array(
			'section_title'		=> __('Our Services','skt-black'),
			'menutitle'			=> __('services','skt-black'),
			'bgcolor' 			=> '#000000',
			'bgimage'			=> '',
			'class'				=> 'services',
			'content'			=> '<div id="services-box">
				<img src="'.get_template_directory_uri().'/images/icon-web-design.png">
				<h2>Web <span>Design</span></h2>
				<p>Lorem Ipsum is simply dummy text of they printing and typesetting industry. Lore Ipsum has been the industry standard in dummy text ever since the 1500s, when an unknown printer took a galley of type andin scrambled it to make a type book.</p>
				<a href="#" class="read-more">Read More</a>
				</div><div id="services-box">
				<img src="'.get_template_directory_uri().'/images/icon-web-design.png">
				<h2>Web <span>Development</span></h2>
				<p>Lorem Ipsum is simply dummy text of they printing and typesetting industry. Lore Ipsum has been the industrys standard in dummy text ever since the 1500s, when an unknown printer took a galley of type andin scrambled it to make a type book.</p>
				<a href="#" class="read-more">Read More</a>
				</div><div id="services-box">
				<img src="'.get_template_directory_uri().'/images/icon-web-design.png">
				<h2>Mobile <span>Website</span></h2>
				<p>Lorem Ipsum is simply dummy text of they printing and typesetting industry. Lore Ipsum has been the industrys standard in dummy text ever since the 1500s, when an unknown printer took a galley of type andin scrambled it to make a type book.</p>
				<a href="#" class="read-more">Read More</a>
				</div><div id="services-box">
				<img src="'.get_template_directory_uri().'/images/icon-web-design.png">
				<h2>WordPress <span>Themes</span></h2>
				<p>Lorem Ipsum is simply dummy text of they printing and typesetting industry. Lore Ipsum has been the industrys standard in dummy text ever since the 1500s, when an unknown printer took a galley of type andin scrambled it to make a type book.</p>
				<a href="#" class="read-more">Read More</a>
				</div>',
			
		),
		
		2 => array(
			'section_title'	=> '',
			'menutitle'		=> '',
			'bgcolor' 		=> '',
			'bgimage'		=> get_template_directory_uri()."/images/contact-banner.jpg",
			'class'			=> 'contact-banner',
			'content'		=> '<h3>Do you like SKT Black? Is it everything you wanted from a theme?</h3>
            <a class="contact-button" href="#">Contact Us</a>',
		),

		3 => array(
			'section_title'	=> __('A message from our manager','skt-black'),
			'menutitle'		=> '',
			'bgcolor' 		=> '#141414',
			'menutitle'		=> '',
			'bgimage'		=> '',
			'class'			=> 'gry-row',
			'content'		=> '<div class="one_half"><div class="message-thumb"><img src="'.get_template_directory_uri().'/images/manager-img.jpg" /></div></div><div class="one_half last"><div class="message-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas imperdiet ex at mauris varius interdum. Fusce mattis gravida libero, nec sollicitudin eros finibus at. Praesent ex diam, mattis vitae efficitur vel, egestas sed neque. Sed congue interdum cursus. Nullam in tincidunt neque. Cras enim tortor, porta id tempor vel, placerat et tellus. Vestibulum eget ullamcorper orci. Suspendisse potenti. Proin rutrum magna ac gravida scelerisque. Nunc eu sodales nisi. Curabitur ligula quam, maximus commodo sodales ut, pretium eget ipsum. Proin lobortis, nibh vel fringilla dictum, ipsum tortor cursus ex, facilisis cursus sapien sem at sem. Mauris in risus ac massa congue volutpat sit amet at metus. Ut in metus posuere, rutrum risus eget, aliquam arcu. Curabitur tincidunt, nulla ut pellentesque aliquet, mi risus pharetra sem, at euismod tortor eros imperdiet turpis.
			<br/>Donec ut ex ac nulla pellentesque mollis in a enim. Praesent placerat sapien mauris, vitae sodales tellus venenatis ac. Suspendisse suscipit velit id ultricies auctor. Duis turpis arcu, aliquet sed sollicitudin sed, porta quis urna. Quisque velit nibh, egestas et erat a, vehicula interdum augue. Morbi ut elementum justo. Fusce mattis gravida libero, nec sollicitudin eros finibus at. Praesent ex diam, mattis vitae efficitur vel, egestas sed neque. Sed congue interdum cursus. Nullam in tincidunt neque. Cras enim tortor, porta id tempor vel, placerat et tellus. Vestibulum eget ullamcorper orci. Suspendisse potenti. Proin rutrum magna ac gravida scelerisque. Nunc eu sodales nisi.</div></div>',
		),
		
		4 => array(
			'section_title'	=> __('Our Statistics','skt-black'),
			'menutitle'		=> __('stat','skt-black'),
			'bgcolor' 		=> '#000000',
			'bgimage'		=> '',
			'class'			=> 'stat',
			'content'		=> '<ul id="some-facts">
			<li><h2>2000</h2><h5>Download</h5></li><li><h2>300</h2><h5>Projects Done</h5></li><li><h2>400</h2><h5>Happy Clients</h5></li><li><h2>100</h2><h5>Awards Won</h5></li><br>
			</ul>',
			
		),
		
		5 => array(
			'section_title'	=> __('Our Support','skt-black'),
			'menutitle'		=> __('support','skt-black'),
			'bgcolor' 		=> '#141414',
			'bgimage'		=> '',
			'class'			=> 'our-team',
			'content'		=> '<div class="team-desc">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id, condimentum at, laoreet mattis, massa. Sed eleifend nonummy diam. Praesent mauris ante, elementum et, bibendum at, posuere sit amet, nibh. Duis tincidunt lectus quis dui viverra vestibulum. Suspendisse vulputate aliquam dui.Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin mattis turpis a sem fermentum, finibus varius quam pharetra. Nulla augue risus, ultrices eget libero non, ornare lacinia quam. Donec pharetra nibh mi, vel rutrum justo pulvinar sed. Suspendisse potenti. Integer vitae mattis tortor. Integer elementum dapibus elementum. Nulla eget nunc odio. Duis ullamcorper nibh vitae porttitor ornare. Cras posuere, erat vitae sodales molestie, mauris nibh venenatis nisl, sed luctus nisl neque et nunc. Vestibulum convallis, ligula sed pulvinar vulputate, sem orci aliquet massa, ultricies ornare velit turpis viverra dui. Proin congue orci eget lobortis dapibus. Nunc at pretium quam, sed dignissim est. Integer fermentum est et turpis tincidunt, vel maximus ligula accumsan. Mauris lobortis diam vitae fermentum convallis. Suspendisse ut suscipit purus, ut tempus ex. <br/><br/>
			
			Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id, condimentum at, laoreet mattis, massa. Sed eleifend nonummy diam. Praesent mauris ante, elementum et, bibendum at, posuere sit amet, nibh. Duis tincidunt lectus quis dui viverra vestibulum. Suspendisse vulputate aliquam dui.Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum  Vestibulum dolor sem, ultricies ut efficitur mattis, venenatis nec libero. Sed bibendum placerat arcu, ac ultrices leo consectetur et. Duis maximus posuere nibh, non scelerisque libero imperdiet eget. Nulla et elementum orci, nec molestie ante. Morbi sit amet tristique nibh, vel vestibulum ipsum. Aliquam ultrices, diam eu venenatis fringilla, nisl neque consectetur purus, vitae sagittis turpis nisi congue arcu. Integer non varius tellus. Proin non dolor elit. Ut id dapibus neque. Maecenas convallis, libero a interdum eleifend, arcu lectus commodo purus, luctus commodo magna dui sit amet eros. Phasellus malesuada sem sit amet sapien rhoncus, vel fermentum augue dignissim.</div>'
		),
		
		6 => array(
			'section_title'	=> __('Our Projects','skt-black'),
			'menutitle'		=> __('portfolio','skt-black'),
			'bgcolor' 		=> '#000000',
			'bgimage'		=> '',
			'class'			=> 'our-projects',
			'content'		=> '<div id="gallery"><a class="example-image-link" href="'.get_template_directory_uri().'/images/banner-seventh.jpg" rel="lightbox-cats" title="Title 1"><img src="'.get_template_directory_uri().'/images/banner-seventh.jpg"></a><a class="example-image-link" href="'.get_template_directory_uri().'/images/banner-sixth.jpg" rel="lightbox-cats" title="Title 2"><img src="'.get_template_directory_uri().'/images/banner-sixth.jpg"></a><a class="example-image-link" href="'.get_template_directory_uri().'/images/banner-fifth.jpg" rel="lightbox-cats" title="Title 3"><img src="'.get_template_directory_uri().'/images/banner-fifth.jpg"></a><a class="example-image-link" href="'.get_template_directory_uri().'/images/banner-fourth.jpg" rel="lightbox-cats" title="Title 4"><img style="margin-right:0;" src="'.get_template_directory_uri().'/images/banner-fourth.jpg"></a><a class="example-image-link" href="'.get_template_directory_uri().'/images/banner-nine.jpg" rel="lightbox-cats" title="Title 5"><img src="'.get_template_directory_uri().'/images/banner-nine.jpg"></a><a class="example-image-link" href="'.get_template_directory_uri().'/images/banner-ten.jpg" rel="lightbox-cats" title="Title 6"><img src="'.get_template_directory_uri().'/images/banner-ten.jpg"></a><a class="example-image-link" href="'.get_template_directory_uri().'/images/banner-sixth.jpg" rel="lightbox-cats" title="Title 7"><img src="'.get_template_directory_uri().'/images/banner-sixth.jpg"></a><a class="example-image-link" href="'.get_template_directory_uri().'/images/banner-fifth.jpg" rel="lightbox-cats" title="Title 8"><img style="margin-right:0;" src="'.get_template_directory_uri().'/images/banner-fifth.jpg"></a></div>'
		),
		
		7 => array(
			'section_title'	=> '',
			'menutitle'		=> __('contact','skt-black'),
			'bgcolor' 		=> '#141414',
			'bgimage'		=> '',
			'class'			=> '',
			'content'		=> '<div class="signup-newsletter">
			<div class="newsletter">
				<h2>Sign Up Our <span>Newsletter</span></h2>
				<p>Stay updated with latest news from SKT Black</p>
			</div>
			<div class="newsletter-form">
				<form method="post" action="">
                	<input type="text" title="Name" size="40" autocomplete="off" placeholder="Name" value="" id="name" name="name" required="required"><input type="email" title="Email" size="40" autocomplete="off" placeholder="Email" value="" id="email" name="email" required="required"><input type="submit" value="SIGN UP" />
				</form>
                </div>
                <div class="clear"></div>
				</div></div>'
		),
	);

	$options = array();

	//Basic Settings
	$options[] = array(
		'name' => __('Basic Settings', 'skt-black'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Logo', 'skt-black'),
		'desc' => __('Upload your main logo here', 'skt-black'),
		'id' => 'logo',
		'class' => '',
		'std'	=> '',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Favicon', 'skt-black'),
		'desc' => __('Upload favicon for website', 'skt-black'),
		'id' => 'favicon',
		'class' => '',
		'std'	=> '',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Custom CSS', 'skt-black'),
		'desc' => __('Some Custom Styling for your site. Place any css codes here instead of the style.css file.', 'skt-black'),
		'id' => 'style2',
		'std' => '',
		'type' => 'textarea');
		
	// Background start
		
	$options[] = array(
		'name' => __('Color Scheme', 'skt-black'),
		'desc' => __('Select color scheme.', 'skt-black'),
		'id' => 'colorscheme',
		'std' => '#ff8a00',
		'type' => 'color');
		


	//Layout Settings
	$options[] = array(
		'name' => __('Sections', 'skt-black'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Number of Sections', 'skt-black'),
		'desc' => __('Select number of sections', 'skt-black'),
		'id' => 'numsection',
		'type' => 'select',
		'std' => '7',
		'options' => array_combine(range(1,30), range(1,30)) );

	$numsecs = of_get_option( 'numsection', 7 );

	for( $n=1; $n<=$numsecs; $n++){
		$options[] = array(
			'desc' => sprintf("<h3>Section ".$n."</h3>", 'skt-black'),
			'class' => 'toggle_title',
			'type' => 'info');	
	
		$options[] = array(
			'name' => __('Section Title', 'skt-black'),
			'id' => 'sectiontitle'.$n,
			'std' => ( ( isset($section_text[$n]['section_title']) ) ? $section_text[$n]['section_title'] : '' ),
			'type' => 'text');

		$options[] = array(
			'name' => __('Section ID', 'skt-black'),
			'desc'	=> __('Enter your section ID here. SECTION ID MUST BE IN SMALL LETTERS ONLY AND DO NOT ADD SPACE OR SYMBOL.','skt-black'),
			'id' => 'menutitle'.$n,
			'std' => ( ( isset($section_text[$n]['menutitle']) ) ? $section_text[$n]['menutitle'] : '' ),
			'type' => 'text');

		$options[] = array(
			'name' => __('Section Background Color', 'skt-black'),
			'desc' => __('Select background color for section', 'skt-black'),
			'id' => 'sectionbgcolor'.$n,
			'std' => ( ( isset($section_text[$n]['bgcolor']) ) ? $section_text[$n]['bgcolor'] : '' ),
			'type' => 'color');
			
		$options[] = array(
			'name' => __('Background Image', 'skt-black'),
			'id' => 'sectionbgimage'.$n,
			'class' => '',
			'std' => ( ( isset($section_text[$n]['bgimage']) ) ? $section_text[$n]['bgimage'] : '' ),
			'type' => 'upload');

		$options[] = array(
			'name' => __('Section CSS Class', 'skt-black'),
			'desc' => __('Set class for this section.', 'skt-black'),
			'id' => 'sectionclass'.$n,
			'std' => ( ( isset($section_text[$n]['class']) ) ? $section_text[$n]['class'] : '' ),
			'type' => 'text');
			
		$options[] = array(
			'name'	=> __('Hide Section', 'skt-black'),
			'desc'	=> __('Check to hide this section', 'skt-black'),
			'id'	=> 'hidesec'.$n,
			'type'	=> 'checkbox',
			'std'	=> '');

		$options[] = array(
			'name' => __('Section Content', 'skt-black'),
			'id' => 'sectioncontent'.$n,
			'std' => ( ( isset($section_text[$n]['content']) ) ? $section_text[$n]['content'] : '' ),
			'type' => 'editor',
			'settings' => $wp_editor_settings);
	}


	//SLIDER SETTINGS
	$options[] = array(
		'name' => __('Homepage Slider', 'skt-black'),
		'type' => 'heading');
		
	$options[] = array(
		'name' => __('Inner Page Slider', 'skt-black'),
		'desc' => __('Show / Hide inner page slider', 'skt-black'),
		'id' => 'innerpageslider',
		'type' => 'select',
		'std' => 'hide',
		'options' => array('show'=>'Show', 'hide'=>'Hide') );
		
	$options[] = array(
		'name' => __('Slider Title', 'skt-black'),
		'id' => 'header_title',
		'std' => '<h1>SKT Black</h1>
				 <p>Aliquam vitae nunc nibh. Nam sollicitudin orci vel eros vulputate vestibulum.</p>
				 <a href="#">Contact Us</a>',
		'type' => 'editor');

	$options[] = array(
		'name' => __('Slider Image 1', 'skt-black'),
		'desc' => __('Upload / select image for slide 1', 'skt-black'),
		'id' => 'slide1',
		'class' => '',
		'std' => get_template_directory_uri()."/images/slides/slider1.jpg",
		'type' => 'upload');

	$options[] = array(
		'name' => __('Slider Image 2', 'skt-black'),
		'desc' => __('Upload / select image for slide 2', 'skt-black'),
		'id' => 'slide2',
		'class' => '',
		'std' => get_template_directory_uri()."/images/slides/slider2.jpg",
		'type' => 'upload');

	$options[] = array(
		'name' => __('Slider Image 3', 'skt-black'),
		'desc' => __('Upload / select image for slide 3', 'skt-black'),
		'id' => 'slide3',
		'class' => '',
		'std' => get_template_directory_uri()."/images/slides/slider3.jpg",
		'type' => 'upload');
		
	$options[] = array(
		'name' => __('Slider Image 4', 'skt-black'),
		'desc' => __('Upload / select image for slide 4', 'skt-black'),
		'id' => 'slide4',
		'class' => '',
		'std' => '',
		'type' => 'upload');
		
	$options[] = array(
		'name' => __('Slider Image 5', 'skt-black'),
		'desc' => __('Upload / select image for slide 5', 'skt-black'),
		'id' => 'slide5',
		'class' => '',
		'std' => '',
		'type' => 'upload');
		

	//Social SETTINGS
	$options[] = array(
		'name' => __('Social Settings', 'skt-black'),
		'type' => 'heading');
		
	$options[] = array(
		'name' => __('Social Title', 'skt-black'),
		'desc' => __('Add social section title here', 'skt-black'),
		'id' => 'socialtitle',
		'std' => 'We Are Everywhere!',
		'type' => 'text',);

	$options[] = array(
		'desc' => __('Facebook Url with "http://"', 'skt-black'),
		'id' => 'facebook',
		'std' => '#facebook',
		'type' => 'text',
		'subtype' => 'url');

	$options[] = array(
		'desc' => __('Twitter Url with "http://"', 'skt-black'),
		'id' => 'twitter',
		'std' => '#twitter',
		'type' => 'text',
		'subtype' => 'url');
		
	$options[] = array(
		'desc' => __('Google Plus Url with "http://"', 'skt-black'),
		'id' => 'gplus',
		'std' => '#gplus',
		'type' => 'text',
		'subtype' => 'url');
		
	$options[] = array(
		'desc' => __('LinkedIn Url with "http://"', 'skt-black'),
		'id' => 'linkedin',
		'std' => '#linkedin',
		'type' => 'text',
		'subtype' => 'url');
		
	$options[] = array(
		'desc' => __('Pinterest Url with "http://"', 'skt-black'),
		'id' => 'pint',
		'std' => '#pinterest',
		'type' => 'text',
		'subtype' => 'url');

	$options[] = array(
		'desc' => __('YouTube Url with "http://"', 'skt-black'),
		'id' => 'youtube',
		'std' => '#youtube',
		'type' => 'text',
		'subtype' => 'url');
		
	$options[] = array(
		'desc' => __('Vimeo Url with "http://"', 'skt-black'),
		'id' => 'vimeo',
		'std' => '#vimeo',
		'type' => 'text',
		'subtype' => 'url');

	$options[] = array(
		'desc' => __('RSS Url with "http://"', 'skt-black'),
		'id' => 'rss',
		'std' => '#rss',
		'type' => 'text',
		'subtype' => 'url');
		
	$options[] = array(
		'desc' => __('Instagram Url with "http://"', 'skt-black'),
		'id' => 'insta',
		'std' => '#instagram',
		'type' => 'text',
		'subtype' => 'url');


	//Footer SETTINGS
	$options[] = array(
		'name' => __('Footer', 'skt-black'),
		'type' => 'heading');
		
	$options[] = array(
		'name' => __('Footer About Section', 'skt-black'),
		'desc' => __('About text title.', 'skt-black'),
		'id' => 'footerabttitle',
		'std' => 'About SKT Black',
		'type' => 'text');

	$options[] = array(
		'desc' => __('Some text for footer of your site, you would like to display in the footer.', 'skt-black'),
		'id' => 'footerabttext',
		'std' => 'Donec ut ex ac nulla pellentesque mollis in a enim. Praesent placerat sapien mauris, vitae sodales tellus venenatis ac. Suspendisse suscipit velit id ultricies auctor. Duis turpis arcu, aliquet sed sollicitudin sed, porta quis urna. Quisque velit nibh, egestas et erat a, vehicula interdum augue. Morbi ut elementum justo. Sed eu nibh orci. Vivamus elementum erat orci. Curabitur consequat convallis dapibus.',
		'type' => 'textarea');
		
	$options[] = array(
		'name' => __('Footer Recent Posts', 'skt-black'),
		'desc' => __('Footer recent post title.', 'skt-black'),
		'id' => 'recenttitle',
		'std' => 'Recent Posts',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Footer Address Title', 'skt-black'),
		'desc' => __('Footer Address title.', 'skt-black'),
		'id' => 'addresstitle',
		'std' => 'SKT Black',
		'type' => 'text');
		
	$options[] = array(
		'desc' => __('Add company address here.', 'skt-black'),
		'id' => 'address',
		'std' => 'Street 238,52 tempor Donec ultricies mattis nulla, suscipit risus tristique ut.',
		'type' => 'text');
		
	$options[] = array(
		'desc' => __('Add phone number here.', 'skt-black'),
		'id' => 'phone',
		'std' => '+1 500 000 0000',
		'type' => 'text');
		
	$options[] = array(
		'desc' => __('Add email address here.', 'skt-black'),
		'id' => 'email',
		'std' => 'demo@lorem.com',
		'type' => 'text');
		
	$options[] = array(
		'desc' => __('Add company url here with http://.', 'skt-black'),
		'id' => 'weblink',
		'std' => 'http://demo.com',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Footer Copyright', 'skt-black'),
		'desc' => __('Copyright Text for your site.', 'skt-black'),
		'id' => 'copytext',
		'std' => '&copy; 2014 SKT Black. All Rights Reserved',
		'type' => 'text');
		
	$options[] = array(
		'desc' => __('Footre Text Link', 'skt-black'),
		'id' => 'ftlink',
		'std' => 'Design by SKT  Themes',
		'type' => 'text',);

	// Support					
	$options[] = array(
		'name' => __('Our Themes', 'skt-black'),
		'type' => 'heading');

	$options[] = array(
		'desc' => __('SKT Black WordPress theme has been Designed and Created by SKT Themes.', 'skt-black'),
		'type' => 'info');	

	 $options[] = array(
		'desc' => '<a href="'.esc_url(SKT_SITE_URL).'" target="_blank"><img src="'.get_template_directory_uri().'/images/sktskill.jpg"></a><p><em><a target="_blank" href="'.esc_url(SKT_PRO_THEME_URL).'">'.__('Buy PRO version for only $30 with more features.','skt-black').'</a></em></p>',
		'type' => 'info');	
	
	return $options;
}