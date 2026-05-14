-- Table pour le contenu des pages modifiables
CREATE TABLE IF NOT EXISTS pages_contenu (
    id INT PRIMARY KEY AUTO_INCREMENT,
    page_slug VARCHAR(50) NOT NULL UNIQUE,
    page_titre VARCHAR(255) NOT NULL,
    bloc VARCHAR(50) NOT NULL,
    contenu TEXT NOT NULL,
    date_modification TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Contenu initial : Qui sommes-nous
INSERT INTO pages_contenu (page_slug, page_titre, bloc, contenu) VALUES
('qui-sommes-nous-intro', 'Qui sommes-nous', 'intro', 'La Perche Tendue est une association solidaire engagée auprès des personnes en difficulté. À travers nos actions de terrain, nous accompagnons les publics fragilisés dans différents domaines : aide alimentaire, inclusion sociale, accès aux droits et création de lien social.\n\nNotre objectif est simple : apporter un soutien concret, humain et accessible à celles et ceux qui en ont besoin, tout en favorisant l autonomie, la dignité et l entraide au quotidien.'),
('qui-sommes-nous-valeurs', 'Qui sommes-nous', 'valeurs', 'Solidarité, respect, dignité et engagement sont au cœur de notre action. Elles guident chacune de nos initiatives et donnent du sens à notre présence sur le terrain.'),
('qui-sommes-nous-equipe', 'Qui sommes-nous', 'equipe', 'Bénévoles, partenaires et personnes engagées œuvrent ensemble pour accompagner au mieux les bénéficiaires et faire vivre les actions de l association au quotidien.'),
('qui-sommes-nous-engagement', 'Qui sommes-nous', 'engagement', 'Nous menons des actions concrètes pour répondre aux besoins essentiels, renforcer le lien social et soutenir les parcours de vie avec bienveillance et proximité.'),

-- Contenu initial : Épicerie
('epicerie-intro', 'Épicerie', 'intro', 'L épicerie solidaire de La Perche Tendue propose des produits alimentaires et d hygiène à prix réduits aux personnes en situation de précarité. Un espace chaleureux où chacun est accueilli avec respect et dignité.'),
('epicerie-produits', 'Épicerie', 'produits', 'Fruits et légumes, produits secs, conserves, produits laitiers, hygiène et entretien — une large gamme accessible à tous.'),
('epicerie-acces', 'Épicerie', 'acces', 'L épicerie est ouverte à toute personne orientée par un travailleur social ou sur présentation d un justificatif de ressources. Renseignez-vous auprès de nous.'),

-- Contenu initial : Parrainage
('parrainage-pourquoi', 'Parrainage', 'pourquoi', 'Le parrainage permet d aider les bénéficiaires en leur offrant un soutien moral et matériel.'),
('parrainage-comment', 'Parrainage', 'comment', '1. Vous choisissez une personne ou une famille à parrainer.\n2. Vous êtes mis en relation avec elle par notre association.\n3. Vous pouvez l aider en lui offrant du temps, des conseils ou du soutien financier.'),
('parrainage-contact', 'Parrainage', 'contact', 'contact@laperche-tendue.fr');
