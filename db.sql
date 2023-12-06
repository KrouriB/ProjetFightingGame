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
	(1, 1, 'Petit Bouclier Rond', 200, 2, 2, 1, 1, 18, 0, 'Parade', 15, 1, 1, NULL, '/img/accessory/shield.png'),
	(2, 3, 'Armure en Cuir Dur', 200, 3, 1, 3, 0, 36, 2650, 'Encaisser', 30, 3, 1, NULL, '/img/accessory/armor.png'),
	(3, 2, 'Armure Lourde de Mage', 200, 1, 3, 0, 3, 36, 2650, 'Bulle Magique', 30, 3, 1, NULL, '/img/accessory/cloak.png');

INSERT INTO `weapon` (`id`, `weapon_type_id`, `weapon_category_id`, `weapon_element_id`, `skill_element_id`, `name`, `attack_stat`, `magic_stat`, `attack_skill`, `magic_skill`, `energy_skill`, `wait_skill`, `cost`, `name_skill`, `user_creator_id`, `image_path`) VALUES
	(1, 1, 1, 6, 6, 'Hache Neutre', 20, 20, 50, 50, 30, 1, 0, 'Coup Sauté', NULL, '/img/weapon/axe.png'),
	(2, 2, 1, 6, 6, 'Épée Neutre', 20, 20, 50, 50, 30, 1, 0, 'Coup Sauté', NULL, '/img/weapon/sword.png'),
	(3, 3, 1, 6, 6, 'Lance Neutre', 20, 20, 50, 50, 30, 1, 0, 'Coup Sauté', NULL, '/img/weapon/lance.png'),
	(4, 1, 2, 6, 6, 'Tatouage Neutre', 20, 20, 50, 50, 30, 1, 0, 'Jet Arcanique', NULL, '/img/weapon/tattoo.png'),
	(5, 2, 2, 6, 6, 'Tome Neutre', 20, 20, 50, 50, 30, 1, 0, 'Jet Arcanique', NULL, '/img/weapon/book.png'),
	(6, 3, 2, 6, 6, 'Sceptre Neutre', 20, 20, 50, 50, 30, 1, 0, 'Jet Arcanique', NULL, '/img/weapon/wand.png'),
	(7, 1, 3, 6, 6, 'Gantelet Neutre', 20, 20, 50, 50, 30, 1, 0, 'Attaque Sournoise', NULL, '/img/weapon/gauntlet.png'),
	(8, 2, 3, 6, 6, 'Dague Neutre', 20, 20, 50, 50, 30, 1, 0, 'Attaque Sournoise', NULL, '/img/weapon/dagger.png'),
	(9, 3, 3, 6, 6, 'Arc Neutre', 20, 20, 50, 50, 30, 1, 0, 'Attaque Sournoise', NULL, '/img/weapon/bow.png');

INSERT INTO `personnage` (`id`, `element_id`, `type_id`, `category_id`, `name`, `attack`, `magic`, `energy`, `life`, `user_creator_id`, `image_path`) VALUES
	(1, 1, 1, 1, 'Hache Feu', 10, 10, 60, 200, NULL, '/img/character/axesman.png'),
	(2, 1, 2, 1, 'Épée Feu', 10, 10, 60, 200, NULL, '/img/character/swordsman.png'),
	(3, 1, 3, 1, 'Lance Feu', 10, 10, 60, 200, NULL, '/img/character/spearsman.png'),
	(4, 1, 1, 2, 'Tatouage Feu', 10, 10, 60, 200, NULL, '/img/character/mage_tattou_midJourney_modified.png'),
	(5, 1, 2, 2, 'Livre Feu', 10, 10, 60, 200, NULL, '/img/character/mage_book_midjourney_modified.png'),
	(6, 1, 3, 2, 'Baton Feu', 10, 10, 60, 200, NULL, '/img/character/mageWand.png'),
	(7, 1, 1, 3, 'Gants Feu', 10, 10, 60, 200, NULL, '/img/character/fighter.png'),
	(8, 1, 2, 3, 'Dague Feu', 10, 10, 60, 200, NULL, '/img/character/thief.png'),
	(9, 1, 3, 3, 'Arc Feu', 10, 10, 60, 200, NULL, '/img/character/ranger.png'),
	(10, 2, 1, 1, 'Hache Terre', 10, 10, 60, 200, NULL, '/img/character/axesman.png'),
	(11, 2, 2, 1, 'Épée Terre', 10, 10, 60, 200, NULL, '/img/character/swordsman.png'),
	(12, 2, 3, 1, 'Lance Terre', 10, 10, 60, 200, NULL, '/img/character/spearsman.png'),
	(13, 2, 1, 2, 'Tatouage Terre', 10, 10, 60, 200, NULL, '/img/character/mage_tattou_midJourney_modified.png'),
	(14, 2, 2, 2, 'Livre Terre', 10, 10, 60, 200, NULL, '/img/character/mage_book_midjourney_modified.png'),
	(15, 2, 3, 2, 'Baton Terre', 10, 10, 60, 200, NULL, '/img/character/mageWand.png'),
	(16, 2, 1, 3, 'Gants Terre', 10, 10, 60, 200, NULL, '/img/character/fighter.png'),
	(17, 2, 2, 3, 'Dague Terre', 10, 10, 60, 200, NULL, '/img/character/thief.png'),
	(18, 2, 3, 3, 'Arc Terre', 10, 10, 60, 200, NULL, '/img/character/ranger.png'),
	(19, 3, 1, 1, 'Hache Métal', 10, 10, 60, 200, NULL, '/img/character/axesman.png'),
	(20, 3, 2, 1, 'Épée Métal', 10, 10, 60, 200, NULL, '/img/character/swordsman.png'),
	(21, 3, 3, 1, 'Lance Métal', 10, 10, 60, 200, NULL, '/img/character/spearsman.png'),
	(22, 3, 1, 2, 'Tatouage Métal', 10, 10, 60, 200, NULL, '/img/character/mage_tattou_midJourney_modified.png'),
	(23, 3, 2, 2, 'Livre Métal', 10, 10, 60, 200, NULL, '/img/character/mage_book_midjourney_modified.png'),
	(24, 3, 3, 2, 'Baton Métal', 10, 10, 60, 200, NULL, '/img/character/mageWand.png'),
	(25, 3, 1, 3, 'Gants Métal', 10, 10, 60, 200, NULL, '/img/character/fighter.png'),
	(26, 3, 2, 3, 'Dague Métal', 10, 10, 60, 200, NULL, '/img/character/thief.png'),
	(27, 3, 3, 3, 'Arc Métal', 10, 10, 60, 200, NULL, '/img/character/ranger.png'),
	(28, 4, 1, 1, 'Hache Eau', 10, 10, 60, 200, NULL, '/img/character/axesman.png'),
	(29, 4, 2, 1, 'Épée Eau', 10, 10, 60, 200, NULL, '/img/character/swordsman.png'),
	(30, 4, 3, 1, 'Lance Eau', 10, 10, 60, 200, NULL, '/img/character/spearsman.png'),
	(31, 4, 1, 2, 'Tatouage Eau', 10, 10, 60, 200, NULL, '/img/character/mage_tattou_midJourney_modified.png'),
	(32, 4, 2, 2, 'Livre Eau', 10, 10, 60, 200, NULL, '/img/character/mage_book_midjourney_modified.png'),
	(33, 4, 3, 2, 'Baton Eau', 10, 10, 60, 200, NULL, '/img/character/mageWand.png'),
	(34, 4, 1, 3, 'Gants Eau', 10, 10, 60, 200, NULL, '/img/character/fighter.png'),
	(35, 4, 2, 3, 'Dague Eau', 10, 10, 60, 200, NULL, '/img/character/thief.png'),
	(36, 4, 3, 3, 'Arc Eau', 10, 10, 60, 200, NULL, '/img/character/ranger.png'),
	(37, 5, 1, 1, 'Hache Bois', 10, 10, 60, 200, NULL, '/img/character/axesman.png'),
	(38, 5, 2, 1, 'Épée Bois', 10, 10, 60, 200, NULL, '/img/character/swordsman.png'),
	(39, 5, 3, 1, 'Lance Bois', 10, 10, 60, 200, NULL, '/img/character/spearsman.png'),
	(40, 5, 1, 2, 'Tatouage Bois', 10, 10, 60, 200, NULL, '/img/character/mage_tattou_midJourney_modified.png'),
	(41, 5, 2, 2, 'Livre Bois', 10, 10, 60, 200, NULL, '/img/character/mage_book_midjourney_modified.png'),
	(42, 5, 3, 2, 'Baton Bois', 10, 10, 60, 200, NULL, '/img/character/mageWand.png'),
	(43, 5, 1, 3, 'Gants Bois', 10, 10, 60, 200, NULL, '/img/character/fighter.png'),
	(44, 5, 2, 3, 'Dague Bois', 10, 10, 60, 200, NULL, '/img/character/thief.png'),
	(45, 5, 3, 3, 'Arc Bois', 10, 10, 60, 200, NULL, '/img/character/ranger.png');

/* UPDATE weapon
SET attack_stat = 20, magic_stat = 20
WHERE attack_stat = 200, magic_stat = 200 */