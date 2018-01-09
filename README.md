__LIFPROJET__ - Semestre d'Automne 2017-2018
__Etudiants :__ Cordeboeuf Mathieu - Zafifomendraha Gabriello - Kaouachi Oussama
__Responsable Projet :__ Fabien Rico
======================================================================================================
-------------------------------------------------------------------------------------------------------
__Objectif :__

Site de partage de documents avec utilisation du framework Symfony.
Vous pouvez vous inscrire,uploder des fichiers,converser avec la messagerie instantanée ...

--------------------------------------------------------------------------------------------------------
__Etapes d'installation :__

__Prérequis :__ Xampp / PHP >=5.5
*(En cas de problème avec php voir : https://openclassrooms.com/courses/developpez-votre-site-web-avec-le-framework-symfony/symfony-un-framework-php )*

1)Lancer Apache et Mysql
2)Placer le dossier Symfony téléchargé dans votre repertoire xampp/htdocs/
3)Dans le terminal , placer vous dans le dossier Symfony et lancer la commande suivante : **php bin/console composer.phar update**
4)Pour générer la base de données, exécuter la commande : **php bin/console doctrine:schema:update --force**

(en cas d'échec de l'envoi du mail lors de l'inscription , vérifier que le contenu de parameters.yml(mailer_port,...) et de config.yml (swiftmailer) n'a pas changé, si c'est le 
cas remetter les paramètres de base)

---------------------------------------------------------------------------------------------------------
__Etapes d 'utilisation :__

1)__Messagerie instantanee :__ 
	Dans le terminal , placer vous dans le dossier Symfony et exécuter : **php bin/console sockets:start-chat**

2)__Lancement de l'application :__
	Lancer un navigateur et taper l'url suivante : __localhost:8080/Symfony/web/app_dev.php__

3) Pour accéder à toutes les fonctionnalités vous devez vous inscrire. Penser à mettre une adresse email valide, une confirmation vous sera demandé.

----------------------------------------------------------------------------------------------------------
__Organisation du code :__

Symfony/
		
		app/
			config/ -> Fichiers de configuration notamment parameters.yml et config.yml
			Resources/views/ -> layout.html.twig : Vue principale 
							/categories -> Fichier twig permettant l'utilisation de fonctions appartenant aux controleurs
		
		bin/ -> Fichiers permettant l 'utilisation de commande dans le terminal
		
		src/OC/
			  PlatformBundle/
							Command/SocketCommand.php -> mise en place du socket pour la messagerie instantanée
							Controller/* -> Differents controlleurs permettant notamment la création de formulaire et la recupération de données
							Entity/ -> Différentes base de données
							Form/ -> Code de création de formulaire
							Resources/ -> Contient les vues et les configurations relatifs aux controlleurs
							Sockets/ -> Code concernant l'envoi de message pour la messagerie instantanée
			  UserBundle/
							~même répertoires qu'au dessus mais pour le coté utilisateur(base user/inscription/connexion/deconnexion/changement de mot de passe...)
		
		vendor/* -> contient tous les dossiers des bundles téléchargés, créés par la communauté Symfony