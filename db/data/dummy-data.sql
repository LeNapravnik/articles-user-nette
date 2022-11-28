USE articles_db;
-- ----------------------------
-- article records
-- ----------------------------
INSERT INTO `article` SET 
    `id` = 1,
    `link` = 'uvod_vsichni',
    `title` = 'Úvod',
    `description` = 'Úvodní článek pro všechny uživatele',  
    `content` = '<p>Kombucha fam disrupt hammock yr <strong>affogato yes plz</strong>. Air plant vibecession seitan, affogato 
    retro asymmetrical artisan ennui vape. Deep v chicharrones fam, mumblecore dreamcatcher poutine 
    cloud bread kale chips DSA coloring book keytar tumblr PBR&B fingerstache. Letterpress locavore 
    lo-fi fanny pack. Fixie cronut drinking vinegar craft beer man bun lomo disrupt skateboard fashion 
    axe knausgaard intelligentsia pop-up actually.</p><p>Twee forage man braid disrupt hella plaid jean shorts la 
    croix shaman fingerstache hashtag umami tofu. Sustainable VHS drinking vinegar street art hot chicken keffiyeh. 
    Organic chartreuse coloring book meditation put a bird on it church-key polaroid cred viral distillery. Edison 
    bulb stumptown gentrify four dollar toast retro coloring book, live-edge yr. Quinoa microdosing hexagon 3 wolf 
    moon, asymmetrical chambray pour-over. Iceland authentic shabby chic flexitarian, venmo fingerstache forage 
    gentrify.</p>',
    `insertion_date` = '2022-11-04 08:10:00',
    `rating` = 3,
    `visibility` = 'all_users';
    
INSERT INTO `article` SET
    `id` = 2,
    `link` = 'clanek_prihlaseni',
    `title` = 'Článek pro přihláené uživatele',
    `description` = 'Prostě článek pro zobrazení jen přihlášeným uživatelům',  
    `content` = '<p>Lyft woke gluten-free enamel pin drinking vinegar. Etsy yuccie poutine waistcoat drinking vinegar neutra 
    bushwick cliche master cleanse prism DIY stumptown. Messenger bag glossier fanny pack direct trade put a bird 
    on it chicharrones lo-fi. Photo booth tumblr af cray taxidermy, mustache vinyl beard gatekeep waistcoat 
    cornhole fit pitchfork health goth stumptown. </p><p>Ugh fanny pack vice glossier distillery 8-bit butcher 
    gochujang flexitarian. Put a bird on it waistcoat crucifix palo santo fit ugh. Beard intelligentsia yes 
    plz polaroid gentrify mlkshk gastropub wolf vape PBR&B plaid tonx prism. Fashion axe pinterest taxidermy 
    intelligentsia meditation adaptogen. </p><p>Godard gentrify DIY cardigan thundercats live-edge yes plz 
    selvage woke shaman. Bespoke hoodie fit, gochujang 3 wolf moon cray health goth edison bulb brunch blue 
    bottle man braid kale chips enamel pin selfies. Hell of pok pok pabst, meggings meditation pork belly 
    keffiyeh. Gluten-free cred quinoa typewriter succulents keytar.</p><p>La croix bespoke green juice austin 
    vice pitchfork. Chartreuse everyday carry freegan, viral artisan raw denim keffiyeh tacos post-ironic 
    organic direct trade wayfarers edison bulb. Unicorn man bun fit chartreuse tacos, prism venmo aesthetic. 
    Yuccie raw denim keffiyeh whatever, ethical kale chips leggings irony organic tumblr bicycle rights taiyaki 
    waistcoat. Before they sold out activated charcoal PBR&B kale chips banh mi bicycle rights, authentic kogi 
    wayfarers fashion axe kickstarter celiac. Vaporware iceland live-edge, narwhal cardigan heirloom raclette. 
    Bitters disrupt succulents mukbang, knausgaard pinterest JOMO heirloom DSA.</p><p>Vegan vice helvetica prism 
    echo park flexitarian kombucha meh cred gastropub. Cray health goth iceland neutra kogi woke master cleanse 
    direct trade bespoke. Swag hell of gochujang palo santo vinyl. Bushwick subway tile messenger bag enamel 
    pin normcore.</p>',
    `insertion_date` = '2022-11-05 08:21:03',
    `rating` = 1,
    `visibility` = 'logged_users';
    
INSERT INTO `article` SET
    `id` = 3,
    `link` = 'clanek_dalsi_prihlaseni',
    `title` = 'Další pro přihlášené článek',
    `description` = 'Článek, který je skrytý pro všechny',  
    `content` = '<p>Ascot mustache letterpress, pickled literally photo booth chillwave aesthetic direct trade neutra jean 
    shorts. Meh XOXO sus, cronut keffiyeh chia live-edge food truck iPhone stumptown cloud bread shaman. DSA 
    typewriter ugh kogi, microdosing iceland vaporware pop-up. Unicorn food truck squid, green juice 
    succulents you probably have heard of them bushwick viral authentic master cleanse jianbing craft beer 
    kinfolk man braid freegan. Fit tote bag quinoa woke. Marfa polaroid viral, pitchfork VHS edison bulb 
    ugh.</p>',
    `insertion_date` = '2022-11-05 08:31:20',
    `rating` = 4,
    `visibility` = 'logged_users';

INSERT INTO `article` SET
    `id` = 4,
    `link` = 'clanek4',
    `title` = 'Čtvrtý článek',
    `description` = 'Další článek',  
    `content` = 'Ascot mustache letterpress, pickled literally photo booth chillwave aesthetic direct trade neutra jean 
    shorts. Meh XOXO sus, cronut keffiyeh chia live-edge food truck iPhone stumptown cloud bread shaman. DSA 
    typewriter ugh kogi, microdosing iceland vaporware pop-up. Unicorn food truck squid, green juice 
    succulents you probably have heard of them bushwick viral authentic master cleanse jianbing craft beer 
    kinfolk man braid freegan. Fit tote bag quinoa woke. Marfa polaroid viral, pitchfork VHS edison bulb 
    ugh.',
    `insertion_date` = '2022-11-06 08:31:20',
    `rating` = 0,
    `visibility` = 'all_users';

INSERT INTO `article` SET
    `id` = 5,
    `link` = 'clanek5',
    `title` = 'Pátý článek',
    `description` = 'Další článek',  
    `content` = 'Ascot mustache letterpress, pickled literally photo booth chillwave aesthetic direct trade neutra jean 
    shorts. Fit tote bag quinoa woke. Marfa polaroid viral, pitchfork VHS edison bulb 
    ugh.',
    `insertion_date` = '2022-11-07 08:31:20',
    `rating` = -2,
    `visibility` = 'all_users';

INSERT INTO `article` SET
    `id` = 6,
    `link` = 'clanek6',
    `title` = 'Šestý článek',
    `description` = 'Další článek',  
    `content` = 'Ascot mustache letterpress, pickled literally photo booth chillwave aesthetic direct trade neutra jean 
    shorts. Fit tote bag quinoa woke. Marfa polaroid viral, pitchfork VHS edison bulb 
    ugh.',
    `insertion_date` = '2022-11-07 08:41:20',
    `rating` = -1,
    `visibility` = 'all_users';  

INSERT INTO `article` SET
    `id` = 7,
    `link` = 'clanek7',
    `title` = 'Sedmý článek',
    `description` = 'Další článek',  
    `content` = 'Ascot mustache letterpress, pickled literally photo booth chillwave aesthetic direct trade neutra jean 
    shorts. Fit tote bag quinoa woke. Marfa polaroid viral, pitchfork VHS edison bulb 
    ugh.',
    `insertion_date` = '2022-11-07 08:51:20',
    `rating` = -3,
    `visibility` = 'all_users';

INSERT INTO `article` SET
    `id` = 8,
    `link` = 'clanek8',
    `title` = 'Osmý článek',
    `description` = 'Další článek',  
    `content` = 'Ascot mustache letterpress, pickled literally photo booth chillwave aesthetic direct trade neutra jean 
    shorts. Fit tote bag quinoa woke. Marfa polaroid viral, pitchfork VHS edison bulb 
    ugh.',
    `insertion_date` = '2022-11-07 09:31:20',
    `rating` = -4,
    `visibility` = 'all_users';

    INSERT INTO `article` SET
    `id` = 9,
    `link` = 'clanek9',
    `title` = 'Devátý článek',
    `description` = 'Další článek',  
    `content` = 'Ascot mustache letterpress, pickled literally photo booth chillwave aesthetic direct trade neutra jean 
    shorts. Fit tote bag quinoa woke. Marfa polaroid viral, pitchfork VHS edison bulb 
    ugh.',
    `insertion_date` = '2022-11-07 09:41:20',
    `rating` = 2,
    `visibility` = 'all_users';

    INSERT INTO `article` SET
    `id` = 10,
    `link` = 'clanek10',
    `title` = 'Desátý článek',
    `description` = 'Další článek',  
    `content` = 'Ascot mustache letterpress, pickled literally photo booth chillwave aesthetic direct trade neutra jean 
    shorts. Fit tote bag quinoa woke. Marfa polaroid viral, pitchfork VHS edison bulb 
    ugh.',
    `insertion_date` = '2022-11-07 09:51:20',
    `rating` = 0,
    `visibility` = 'all_users';

    INSERT INTO `article` SET
    `id` = 11,
    `link` = 'clanek11',
    `title` = 'Jedenáctý článek',
    `description` = 'Další článek',
    `content` = 'Ascot mustache letterpress, pickled literally photo booth chillwave aesthetic direct trade neutra jean 
    shorts. Fit tote bag quinoa woke. Marfa polaroid viral, pitchfork VHS edison bulb 
    ugh.',
    `insertion_date` = '2022-11-07 10:01:20',
    `rating` = 1,
    `visibility` = 'all_users';

    INSERT INTO `article` SET
    `id` = 12,
    `link` = 'clanek12',
    `title` = 'Dvanáctý článek',
    `description` = 'Další článek',
    `content` = 'Ascot mustache letterpress, pickled literally photo booth chillwave aesthetic direct trade neutra jean 
    shorts. Fit tote bag quinoa woke. Marfa polaroid viral, pitchfork VHS edison bulb 
    ugh.',
    `insertion_date` = '2022-11-07 10:11:20',
    `rating` = 0,
    `visibility` = 'all_users';

    INSERT INTO `article` SET
    `id` = 13,
    `link` = 'clanek13',
    `title` = 'Třináctý článek', 
    `description` = 'Další článek', 
    `content` = 'Ascot mustache letterpress, pickled literally photo booth chillwave aesthetic direct trade neutra jean 
    shorts. Fit tote bag quinoa woke. Marfa polaroid viral, pitchfork VHS edison bulb 
    ugh.',
    `insertion_date` = '2022-11-07 10:21:20',
    `rating` = 0,
    `visibility` = 'all_users';


-- ----------------------------
-- user records /heslo: 1234567
-- ----------------------------
INSERT INTO `user` SET
    `id` = 1,
    `username` = 'admin_prvni', 
    `mail` = 'admin@localhost.cz',
    `passwd` = '$2y$10$SYz0aVoZ5KMZe4lkWUslSu7YvWI5korK0nzjkuriJz0Q8LO1FAEUW', 
    `role` = 'admin',
    `registration_date` = '2022-11-04 08:31:20',
    `active` = 1;
  
INSERT INTO `user` SET 
    `id` = 2,
    `username` = 'user1', 
    `mail` = 'user1@localhost.cz',
    `passwd` = '$2y$10$SYz0aVoZ5KMZe4lkWUslSu7YvWI5korK0nzjkuriJz0Q8LO1FAEUW', 
    `role` = 'member',
    `registration_date` = '2022-11-04 08:40:20',
    `active` = 1;

INSERT INTO `user` SET 
    `id` = 3,
    `username` = 'user2', 
    `mail` = 'user2@localhost.cz',
    `passwd` = '$2y$10$SYz0aVoZ5KMZe4lkWUslSu7YvWI5korK0nzjkuriJz0Q8LO1FAEUW', 
    `role` = 'member',
    `registration_date` = '2022-11-04 08:45:20',
    `active` = 1;
