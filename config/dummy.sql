DELETE FROM tags_list;
DELETE FROM tag;
DELETE FROM ingredients_list;
DELETE FROM ingredient;
DELETE FROM likes;
DELETE FROM comments;
DELETE FROM recipes;
DELETE FROM category;
DELETE FROM users;

-- INSERTION `users`
INSERT INTO users (users_id, users_pseudo, users_email, users_password, users_lastname, users_name, users_inscription_date, users_type, users_status)
VALUES
(1,'ElMostafa', 'elmostafa@gmail.com', '3yadziri', 'Dazzi', 'Mostafa', '2020-01-10', 0, 0),
(2,'SergeBelb', 'sergebelb@gmail.com', '4444ziri', 'Belbour', 'Serge', '2020-01-23', 0, 0),
(3,'TecheneM', 'techene@gmail.com', '202020sten', 'Monteche', 'Nour', '2020-02-06', 0, 0),
(4,'MarcLecocqADMIN', 'marclecocq@gmail.com', '202020cocq', 'Lecocq', 'Marc', '2020-02-08', 1, 0),
(5,'KacemHamdaoui', 'kacemhamdaoui@gmail.com', '2020eaui', 'Hamdaoui', 'Kacem', '2020-02-25', 0, 0),
(6,'QuentinVanden', 'quentin@gmail.com', '2020vanden', 'Vanden', 'Quentin', '2020-03-07', 0, 0);

-- INSERTION `category`
INSERT INTO category(cat_id, cat_title, cat_desc)
VALUES
(4, 'Autre', ''),
(1,'Entrée', 'Une petite faim ?'),
(2, 'Plat', 'Plat principal'),
(3, 'Dessert', 'Une gourmandise ?');

-- INSERTION `recipes`
INSERT INTO recipes (rec_id, rec_title, rec_content, rec_summary, cat_id,  rec_creation_date, rec_image_src, users_id, rec_nb_person)
VALUES
(1, 'Boulettes au curry et carottes', '1 - Faites les boulettes \n 2 - Faites cuire les carottes \n3 - Mélangez les deux\n 4 - Servez', 'Voic une recette simple qui fera plaisir à toute la famille', 2, '2020-04-18', 'https://shorturl.at/kvLT3', 1, 6),
(2, 'Entremet au chocolat', '1 - Préchauffez le four \n2 - Mélangez tous les ingrédients \n 3-Versez lé mélange dans des moules\n 4 - Faites cuire', 'Voici un délicieux entremet au chocolat qui fera plaisir à tous les gourmand', 3, '2020-05-01', 'https://shorturl.at/kvLT3', 3, 8),
(3, 'Chips maison', '1 - Coupez les pommes de terre \n2 - Frire \n3 - Dégustez', 'Une recette simple et savoureuse pour des chips maison', 4, '2020-05-12', 'https://shorturl.at/kvLT3', 5, 4),
(4, 'Tarte aux fraise', '1- Préparez la pâtes \n2 -Mélangez tous les ingrédients \n3-Versez lé mélange dans la pâtes \n 4 - Faites cuire', 'Une recette originale et délicieuse pour une tarte aux fraises', 3, '2020-06-08', 'https://shorturl.at/kvLT3', 2, 8), 
(5, 'Velouté de potimarron', '1 - Coupé le potimarron \n2 - Faites le cuire \n3 - Mixez \n4 - Versez dans un récipient', 'Un velouté de potimarron onctueux et savoureux', 1, '2020-06-21', 'https://shorturl.at/kvLT3', 6, 4),
(6, 'Tiramisu RED', '1 - Mélangez les sucreries\n2 - Incorporez la crème\n3 - Discoltez dans un grand verre', 'Mettez de la couleur et de gourmandise dans votre dessert avec ce bambou classique italien', 3, '2020-07-17', 'https://shorturl.at/kvLT3', 4, 2),
(7, 'Sardines pimentées', '1 - Coupez les piments\n2 - Fourrez les sardines avec successivement les poivrons, les oignons\n3 - Gardez au frais \n4 - Attendre 1h', 'Les sardines fourrées et pimentées est une recette simple et idéale pour faire preuve d''originalité lors d''un repas entre amis ou en famille.', 2, '2020-08-01', 'https://shorturl.at/kvLT3', 2, 8), 
(8, 'Salade parsemée de palets de conté', '1 - Coupé en cubes les palets de comtés \n2 - Incorporez les petits lardons \n 3 - Ajouter le vinaigrette \n4 - Mélangez', 'Cet ingrédient classique s''invite dans la salade : la salade paremée de palts de conté est un pur délice pour les papilles.',1, '2020-08-17', 'https://shorturl.at/kvLT3', 1, 4), 
(9, 'Sablés au beurre', '1- Battre le beurre en morceaux \n2 - Mettre le tout dans un saladier et ajouter les œufs \n 3 - Ajouter le sucre et la farine \n 4 - laissez refroidir', 'Un sablé parfumé au beurre, un goût un rien suranné et une facilité de réalisation absolue. La recette à conserver précieusement dans vos favoris !', 4, '2020-09-02', 'https://shorturl.at/kvLT3', 3, 4), 
(10, 'Fajitas de poulets', '1 - Découpez le poulet en fine lamelles \n 2 - Ajoutez la sauce BBQ \n 3 - Versez dans le painitas \n 4 - Jaunez le tout', 'Gouteuse et fondante, déguster ces savoureuses fajitas de poulets pour faire plaisir à toute la famille.', 2, '2020-09-10', 'https://shorturl.at/kvLT3', 4, 8);

-- INSERTION `comments`

INSERT INTO comments (rec_id, users_id, com_title, com_content, com_date)
VALUES
(4, 5, 'Trop bonne cette recette !', 'Dès fois qu''on mette avè tout de coté un petit tabasco avec son avicenne chaude ur béton super bien .', '2020-06-27'),
(3, 6, 'Mes amis ont adoré !', 'La recette simple mais très gouteuse. J''ai juste rajouté un peu de sel et de curcuma.', '2020-09-01'),
(2, 2, 'Hummm... un vrai délice', 'Excellent, simple mais efficace, je recommande en plat ou en dessert.', '2020-05-02'),
(1, 1, 'Merci Mostafa !', 'Très bonne recette, j''ai adoré !', '2020-04-19'),
(2,3,'DE LA MERDE', 'Rien de bon avec cette recette, je la déconseille franchement.', '2020-07-04'),
(3,4,'Super facile', 'J''avais un peu peur croyant que c''était complexe mais non de loin pas du tout, merci beaucoup !', '2020-08-11'),
(3,3,'Gourmand', 'Une découverte culinaire comme je les aime... Ce plat est tout simplement exelente', '2020-08-26'),
(3,5,'Vraiment dégueulasse', 'J''ai suivi les instructions à la lettre et le résultats et mauvais, je déconseille.', '2020-07-19'),
(10,1,'BeUrK !!!', 'Vraiment pas aimé ... C''été infect !', '2020-09-20'),
(10,6,'Trop bon !!!', 'Un régale !', '2020-09-27'),
(5,1,'la pire chose au monde', 'Pire recette que j''ai fais de ma vie', '2020-07-01'),
(6,1,'Wouhouuu', 'Pour les fans de nutte', '2020-09-30'),
(5,2,'loved it', 'Absolument, absolument .... Peut être même un peu trop il sera difficile de revenir en arrière !', '2020-08-04'), 
(7,1,'Facilité et gourmandise', 'Un pur délice, très facile à réaliser, elle a fait l''unanimité.', '2020-08-04'), 
(8,1,'Délicieux', 'Goûté lors lors de plusieurs occasions la recette a séduit tout le monde sans exception, et moi la première.', '2020-08-04');

-- INSERTION `likes`

INSERT INTO likes (rec_id, users_id)
VALUES
(1, 1), (1, 2), (1, 3), (2, 1), (2, 4), (2, 5), (2, 6), (3, 4), (3, 5), (3, 6), (4, 1), (4, 2), (4, 3), (5, 1), (5, 2), (5, 3), (6, 4), (6, 5), (6, 6),
(7, 1), (7, 2), (7, 3), (8, 1), (8, 4), (8, 5), (10, 1), (10, 2), (10, 3), (10, 4), (10, 5), (10, 6);

-- INSERTION `ingredient`

INSERT INTO ingredient (ing_id, ing_title, ing_desc)
VALUES(1, 'Pain rivé', 'pain de type rhédadi'),
(2, 'Jaune d''oeuf', ''),
(3, 'Cuisine rouge de porc', ''),
(4, 'blanc d''oeuf', ''),
(5, 'Coriandre', '' ),
(6, 'Piment fort', ''),
(7, 'Carotte', ''),
(8, 'Curry', ''),
(9, 'Chocolat noir', ''),
(10, 'Pomme de terre', ''),
(11, 'Échalotes', ''),
(12, 'Pâtes', 'type petites torsades'),
(13, 'Sucre', ''),
(14, 'Crème épaisse', ''),
(15, 'Cannelle', ''),
(16, 'Abricot sec', ''),
(17, 'Beurre', ''),
(18, 'Poivron rouge', ''),
(19, 'Oignon jaune', ''),
(20, 'Farine de blé', ''),
(21, 'Bûche de chèvre', ''),
(22, 'Viande de boeuf', ''),
(23, 'Beaufort', 'Fromage');

-- INSERTION `ingredients_list`

INSERT INTO ingredients_list (rec_id, ing_id, ing_quantity, ing_unit) 
VALUES
(1,1,1,'tranche'),
(1,3,500,'gr'),
(1,5,2,'branches'),
(1,6,1,'pincée'),
(1,7,500,'g'),
(1,8,2,'cd'),
(2,4,8,'baton'),
(2,9,400,'g'),
(2,10,200,'g'),
(2,11,6,'gousses'),
(2,12,200,'g'),
(2,13,2,'cuilère à soupe'),
(2,14,40,'cl'),
(2,15,1,'pincée'),
(2,16,5,'unités'),
(3,4,1,'unité'),
(3,17,100,'g'),
(3,18,1,'branches'),
(3,19,5,'unités'),
(3,5,1,'branches'),
(3,6,1,'piment'),
(4,2,6,'unités'),
(4,20,120,'g'),
(4,7,4,'unités'),
(4,5,1,'pincée'),
(4,8,2,'cuillère à soupe'),
(4,19,2,'unités'),
(5,5,1,'branches'),
(5,10,800,'g'),
(5,21,1,'branches'),
(5,22,2,'pouces'),
(6,23,200,'g'),
(6,17,100,'g');
 
-- INSERTION `tag`

INSERT INTO tag (tag_id, tag_title)
VALUES
(1, 'gâteau'),
(2, 'chocolat'),
(3, 'végétarien'),
(4, 'viande'),
(5, 'épicé'),
(6, 'soir'),
(7, 'été'),
(8, 'anniversaire'),
(9, 'entrée'),
(10, 'dessert'),
(11, 'rapide'),
(12, 'simple'),
(13, 'fromage'),
(14, 'couteux'),
(15, 'pour enfant'),
(16, 'indien'),
(17, 'nier'),
(18, 'chaud'),
(19, 'frit'),
(20, 'poisson'),
(21, 'copieux'),
(22, 'gourmand'),
(23, 'sucré salé'),
(24, 'fête'),
(25, 'original'),
(26, 'végétalien'),
(27, 'sans gluten'),
(28, 'bien-être');
 
-- INSERTION `tags_list`

INSERT INTO tags_list (rec_id, tag_id)
VALUES
(2,1), (2,2), (4,3), (4,4), (4,5), (4,6), (4,7), (4,8), (6,2), (6,11), (6,12), (7,17), (10,10), (10,12), (10,14), (10,21),(10,9), (10,11), (10,19), (10,20), (10,23), (10,24), (10,28);

COMMIT;

SELECT * FROM users;
SELECT * FROM category;
SELECT * FROM recipes;
SELECT * FROM comments;
SELECT * FROM ingredient;
SELECT * FROM tag;