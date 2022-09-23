<h1>TRT Conseil</h1>

<p>Website for Recruitement agency in Hotel and restaurant industry.</p>

<p>This website is deployed on heroku follow -> 
    <a href="https://trt-conseil-ay.herokuapp.com/">https://trt-conseil-ay.herokuapp.com/</a>
</p>

<p>if you want see the code architecture... please check Docs folder.</p>

<h3><strong>How to deploy in a local environnement ?</strong></h3>

<p><strong>Requirements:</strong></p>

<ul>
    <li>Composer ^2.3.10</li>
    <li>Symfony ^6.1.3</li>
    <li>(MAMP or WAMP or XAMP)</li>
    <li>PHP: ^8.1.0</li>
    <li> MySQL: ^5.7</li>
</ul>

<p>you'll need test email use MAILHOG or MAILTRAP</p>

------------------------------------------------------------------

Download zip -> https://github.com/yovann972/trt-conseil.git

<p>1. Ouvrir un terminal et se rendre dans le dossier</p>

<pre>
$cd trt-conseil
$composer install
</pre>

<p>2. Create a file env.local</p>

<p>3. Configure env.local set vars DATABASE_URL, MAILER_DSN, APP_SECRET</p>

<pre>
$php bin/console doctrine:database:create
$php bin/console doctrine:migrations:migrate
</pre>

<p>7. Run APP</p>

<pre>
$symfony server:start -d
</pre>

__________________________________________________________________

<p><strong>Admin section</strong></p> 

<p>Create a Admin</p>

<ol>
    <li>Sign-in as a candidat and log-out</li>
    <li>Go to the database and set your roles ["ROLE_ADMIN"]</li>
    <li>Login</li>
</ol>





