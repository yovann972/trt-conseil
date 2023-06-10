<h1>TRT Conseil (Assessment 2022)</h1>

<p>visit the site on <a href="http://trt-conseil.atspace.cc/"><bold>here</bold></a></p> 

<p dir="auto"><strong>Objective of the assessment:</strong></p>

<p dir="auto">Website for Recruitement agency in Hotel and restaurant industry.</p>

<p dir="auto">
TRT Conseil est une agence de recrutement spécialisée dans l’hôtellerie et la restauration. Fondée en
2014, la société s’est agrandie au fil des ans et possède dorénavant plus de 12 centres dispersés aux
quatre coins de la France.
La crise du coronavirus ayant frappée de plein fouet ce secteur, la société souhaite progressivement
mettre en place un outil permettant à un plus grand nombre de recruteurs et de candidats de trouver leur
bonheur.
TRT Conseil désire avoir un produit minimum viable afin de tester si la demande est réellement présente.
L’agence souhaite proposer pour l’instant une simple interface avec une authentification.
4 types d’utilisateur devront pouvoir se connecter :
Les recruteurs : Une entreprise qui recherche un employé.
Les candidats : Un serveur, responsable de la restauration, chef cuisinier etc.
Les consultants : Missionnés par TRT Conseil pour gérer les liaisons sur le back-office entre
recruteurs et candidats.
L’administrateur : La personne en charge de la maintenance de l’application.
</p>

<p dir="auto"><strong>Expected skills:</strong></p>

<ol>
    <li>Créer une base de données dans un SGBD grâce à l’appui d’un schéma physique</li>
    <li>Opérer des sélections et mises à jour de données via des composants d’accès</li>
    <li>Développer la logique concernant les requêtes au serveur</li>
    <li>Mettre en œuvre un système de gestion du contenu</li>
    <li>Publier l’application sur un serveur Web</li>
</ol>
_________________________________________________________________

<p dir="auto">This website is deployed on Atspace -> 
    <a href="https://trt-conseil-ay.herokuapp.com/">http://trt-conseil.atspace.cc/</a>
</p>

<p dir="auto">if you want see the code architecture... please check Docs folder.</p>
__________________________________________________________________

<h2 dir="auto">Diagrams</h2>

<p dir="auto"><strong>UML class diagram:</strong></p>
<img src="https://github.com/yovann972/trt-conseil/blob/main/diagrams/db%20UML%20diagram.png?raw=true">

<p dir="auto"><strong>Functional diagram:</strong></p>
<img src="https://github.com/yovann972/trt-conseil/blob/main/diagrams/Diagramme%20fonctionnel%20TRT%20Conseil.png?raw=true">

<p dir="auto"><strong>Sequence diagram:</strong></p>
<img src="https://github.com/yovann972/trt-conseil/blob/main/diagrams/diagramme%20de%20sequence.png?raw=true">

__________________________________________________________________


<h3 dir="auto"><strong>How to deploy in a local environnement ?</strong></h3>

<p dir="auto"><strong>Requirements:</strong></p>

<ul dir="auto">
    <li>Composer ^2.3.10</li>
    <li>Symfony ^6.1.3</li>
    <li>(MAMP or WAMP or XAMP)</li>
    <li>PHP: ^8.1.0</li>
    <li> MySQL: ^5.7</li>
</ul>

<p dir="auto">you'll need test email use <strong>MAILHOG</strong> or <strong>MAILTRAP</strong></p>

------------------------------------------------------------------

Download zip -> https://github.com/yovann972/trt-conseil.git

<p dir="auto">1. Open a terminal</p>

<pre>
$cd trt-conseil
$composer install
</pre>

<p dir="auto">2. Create a .env.local file</p>

<p dir="auto">3. Configure env.local set vars DATABASE_URL, MAILER_DSN, APP_SECRET</p>

<pre>
$php bin/console doctrine:database:create
$php bin/console doctrine:migrations:migrate
</pre>

<p dir="auto">7. Run APP</p>

<pre>
$symfony server:start -d
</pre>

__________________________________________________________________

<p dir="auto"><strong>Admin section</strong></p> 

<p dir="auto">Create a Admin</p>

<ol>
    <li>Sign-in as a candidat and log-out</li>
    <li>Go to the database and set your roles ["ROLE_ADMIN"]</li>
    <li>Login</li>
</ol>





