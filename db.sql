INSERT INTO `category_weapon` (`id`, `name_category`, `advantage`, `disadvantage`, `advantage_multiplicator`, `disadvantage_multiplicator`) VALUES
	(1, 'Classique', 3, 2, 1.33, 0.66),
	(2, 'Magie', 1, 3, 1.33, 0.66),
	(3, 'Alternatif', 2, 1, 1.33, 0.66);

INSERT INTO `element` (`id`, `name_element`, `advantage`, `disadvantage`, `advantage_multiplicator`, `disadvantage_multiplicator`) VALUES
	(1, 'Feu', 3, 2, 2, 0.5),
	(2, 'Terre', 4, 3, 2, 0.5),
	(3, 'Métal', 5, 4, 2, 0.5),
	(4, 'Eau', 1, 5, 2, 0.5),
	(5, 'Bois', 2, 1, 2, 0.5),
	(6, 'Neutre', 6, 6, 1, 1);

INSERT INTO `type_stat_action` (`id`, `nom_stat`, `nom_type`, `rank_stat1`, `rank_stat2`, `rank_stat3`, `rank_stat4`) VALUES
	(1, 'Life', 'Réduction de dégâts', 20, 40, 60, 80),
	(2, 'Magic', 'Protection Magique', 25, 50, 75, 100),
	(3, 'Attack', 'Protection Physique', 25, 50, 75, 100);

INSERT INTO `type_weapon` (`id`, `name_type`, `advantage`, `disadvantage`, `advantage_multiplicator`, `disadvantage_multiplicator`) VALUES
	(1, 'Type 1', 3, 2, 1.25, 0.75),
	(2, 'Type 2', 1, 3, 1.25, 0.75),
	(3, 'Type 3', 2, 1, 1.25, 0.75);

INSERT INTO `accessory` (`id`, `type_stat_action_id`, `name`, `min_life`, `defense`, `resistance`, `bonus_attack`, `bonus_magic`, `energy_recovery`, `cost`, `name_action`, `energy_action`, `wait_action`, `stat_action`, `user_creator_id`, `image_path`) VALUES
	(1, 1, 'Petit Bouclier Rond', 200, 2, 2, 1, 1, 18, 0, 'Parade', 15, 1, 1, NULL, '/img/accessory/shield.webp'),
	(2, 3, 'Armure en Cuir Dur', 200, 3, 1, 3, 0, 36, 2650, 'Encaisser', 30, 3, 1, NULL, '/img/accessory/armor.webp'),
	(3, 2, 'Armure Lourde de Mage', 200, 1, 3, 0, 3, 36, 2650, 'Bulle Magique', 30, 3, 1, NULL, '/img/accessory/cloak.webp');

INSERT INTO `weapon` (`id`, `weapon_type_id`, `weapon_category_id`, `weapon_element_id`, `skill_element_id`, `name`, `attack_stat`, `magic_stat`, `attack_skill`, `magic_skill`, `energy_skill`, `wait_skill`, `cost`, `name_skill`, `user_creator_id`, `image_path`) VALUES
	(1, 1, 1, 6, 6, 'Hache Neutre', 20, 20, 50, 50, 30, 1, 0, 'Coup Sauté', NULL, '/img/weapon/axe.webp'),
	(2, 2, 1, 6, 6, 'Épée Neutre', 20, 20, 50, 50, 30, 1, 0, 'Coup Sauté', NULL, '/img/weapon/sword.webp'),
	(3, 3, 1, 6, 6, 'Lance Neutre', 20, 20, 50, 50, 30, 1, 0, 'Coup Sauté', NULL, '/img/weapon/lance.webp'),
	(4, 1, 2, 6, 6, 'Tatouage Neutre', 20, 20, 50, 50, 30, 1, 0, 'Jet Arcanique', NULL, '/img/weapon/tattoo.webp'),
	(5, 2, 2, 6, 6, 'Tome Neutre', 20, 20, 50, 50, 30, 1, 0, 'Jet Arcanique', NULL, '/img/weapon/book.webp'),
	(6, 3, 2, 6, 6, 'Sceptre Neutre', 20, 20, 50, 50, 30, 1, 0, 'Jet Arcanique', NULL, '/img/weapon/wand.webp'),
	(7, 1, 3, 6, 6, 'Gantelet Neutre', 20, 20, 50, 50, 30, 1, 0, 'Attaque Sournoise', NULL, '/img/weapon/gauntlet.webp'),
	(8, 2, 3, 6, 6, 'Dague Neutre', 20, 20, 50, 50, 30, 1, 0, 'Attaque Sournoise', NULL, '/img/weapon/dagger.webp'),
	(9, 3, 3, 6, 6, 'Arc Neutre', 20, 20, 50, 50, 30, 1, 0, 'Attaque Sournoise', NULL, '/img/weapon/bow.webp');

INSERT INTO `personnage` (`id`, `element_id`, `type_id`, `category_id`, `name`, `attack`, `magic`, `energy`, `life`, `user_creator_id`, `image_path`) VALUES
	(1, 1, 1, 1, 'Hache Feu', 10, 10, 60, 200, NULL, '/img/character/axesman.webp'),
	(2, 1, 2, 1, 'Épée Feu', 10, 10, 60, 200, NULL, '/img/character/swordsman.webp'),
	(3, 1, 3, 1, 'Lance Feu', 10, 10, 60, 200, NULL, '/img/character/spearsman.webp'),
	(4, 1, 1, 2, 'Tatouage Feu', 10, 10, 60, 200, NULL, '/img/character/mage_tattou_midJourney_modified.webp'),
	(5, 1, 2, 2, 'Livre Feu', 10, 10, 60, 200, NULL, '/img/character/mage_book_midjourney_modified.webp'),
	(6, 1, 3, 2, 'Baton Feu', 10, 10, 60, 200, NULL, '/img/character/mageWand.webp'),
	(7, 1, 1, 3, 'Gants Feu', 10, 10, 60, 200, NULL, '/img/character/fighter.webp'),
	(8, 1, 2, 3, 'Dague Feu', 10, 10, 60, 200, NULL, '/img/character/thief.webp'),
	(9, 1, 3, 3, 'Arc Feu', 10, 10, 60, 200, NULL, '/img/character/ranger.webp'),
	(10, 2, 1, 1, 'Hache Terre', 10, 10, 60, 200, NULL, '/img/character/axesman.webp'),
	(11, 2, 2, 1, 'Épée Terre', 10, 10, 60, 200, NULL, '/img/character/swordsman.webp'),
	(12, 2, 3, 1, 'Lance Terre', 10, 10, 60, 200, NULL, '/img/character/spearsman.webp'),
	(13, 2, 1, 2, 'Tatouage Terre', 10, 10, 60, 200, NULL, '/img/character/mage_tattou_midJourney_modified.webp'),
	(14, 2, 2, 2, 'Livre Terre', 10, 10, 60, 200, NULL, '/img/character/mage_book_midjourney_modified.webp'),
	(15, 2, 3, 2, 'Baton Terre', 10, 10, 60, 200, NULL, '/img/character/mageWand.webp'),
	(16, 2, 1, 3, 'Gants Terre', 10, 10, 60, 200, NULL, '/img/character/fighter.webp'),
	(17, 2, 2, 3, 'Dague Terre', 10, 10, 60, 200, NULL, '/img/character/thief.webp'),
	(18, 2, 3, 3, 'Arc Terre', 10, 10, 60, 200, NULL, '/img/character/ranger.webp'),
	(19, 3, 1, 1, 'Hache Métal', 10, 10, 60, 200, NULL, '/img/character/axesman.webp'),
	(20, 3, 2, 1, 'Épée Métal', 10, 10, 60, 200, NULL, '/img/character/swordsman.webp'),
	(21, 3, 3, 1, 'Lance Métal', 10, 10, 60, 200, NULL, '/img/character/spearsman.webp'),
	(22, 3, 1, 2, 'Tatouage Métal', 10, 10, 60, 200, NULL, '/img/character/mage_tattou_midJourney_modified.webp'),
	(23, 3, 2, 2, 'Livre Métal', 10, 10, 60, 200, NULL, '/img/character/mage_book_midjourney_modified.webp'),
	(24, 3, 3, 2, 'Baton Métal', 10, 10, 60, 200, NULL, '/img/character/mageWand.webp'),
	(25, 3, 1, 3, 'Gants Métal', 10, 10, 60, 200, NULL, '/img/character/fighter.webp'),
	(26, 3, 2, 3, 'Dague Métal', 10, 10, 60, 200, NULL, '/img/character/thief.webp'),
	(27, 3, 3, 3, 'Arc Métal', 10, 10, 60, 200, NULL, '/img/character/ranger.webp'),
	(28, 4, 1, 1, 'Hache Eau', 10, 10, 60, 200, NULL, '/img/character/axesman.webp'),
	(29, 4, 2, 1, 'Épée Eau', 10, 10, 60, 200, NULL, '/img/character/swordsman.webp'),
	(30, 4, 3, 1, 'Lance Eau', 10, 10, 60, 200, NULL, '/img/character/spearsman.webp'),
	(31, 4, 1, 2, 'Tatouage Eau', 10, 10, 60, 200, NULL, '/img/character/mage_tattou_midJourney_modified.webp'),
	(32, 4, 2, 2, 'Livre Eau', 10, 10, 60, 200, NULL, '/img/character/mage_book_midjourney_modified.webp'),
	(33, 4, 3, 2, 'Baton Eau', 10, 10, 60, 200, NULL, '/img/character/mageWand.webp'),
	(34, 4, 1, 3, 'Gants Eau', 10, 10, 60, 200, NULL, '/img/character/fighter.webp'),
	(35, 4, 2, 3, 'Dague Eau', 10, 10, 60, 200, NULL, '/img/character/thief.webp'),
	(36, 4, 3, 3, 'Arc Eau', 10, 10, 60, 200, NULL, '/img/character/ranger.webp'),
	(37, 5, 1, 1, 'Hache Bois', 10, 10, 60, 200, NULL, '/img/character/axesman.webp'),
	(38, 5, 2, 1, 'Épée Bois', 10, 10, 60, 200, NULL, '/img/character/swordsman.webp'),
	(39, 5, 3, 1, 'Lance Bois', 10, 10, 60, 200, NULL, '/img/character/spearsman.webp'),
	(40, 5, 1, 2, 'Tatouage Bois', 10, 10, 60, 200, NULL, '/img/character/mage_tattou_midJourney_modified.webp'),
	(41, 5, 2, 2, 'Livre Bois', 10, 10, 60, 200, NULL, '/img/character/mage_book_midjourney_modified.webp'),
	(42, 5, 3, 2, 'Baton Bois', 10, 10, 60, 200, NULL, '/img/character/mageWand.webp'),
	(43, 5, 1, 3, 'Gants Bois', 10, 10, 60, 200, NULL, '/img/character/fighter.webp'),
	(44, 5, 2, 3, 'Dague Bois', 10, 10, 60, 200, NULL, '/img/character/thief.webp'),
	(45, 5, 3, 3, 'Arc Bois', 10, 10, 60, 200, NULL, '/img/character/ranger.webp');

/* UPDATE weapon
SET attack_stat = 20, magic_stat = 20
WHERE attack_stat = 200, magic_stat = 200 */