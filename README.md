# NEWS article API
News article application. Read fresh news. Search by interest ore use tags for instance search.

### Features:
<ol>
    <li>News article collection</li>
    <li>News article search</li>
    <li>User log-in system</li>
</ol>

![](https://github.com/pentakostal/NewsAPI_v2/blob/main/public%20/images/Peek%202023-01-22%2023-29.gif)
![](https://github.com/pentakostal/NewsAPI_v2/blob/main/public%20/images/Peek%202023-01-22%2023-31.gif)
![](https://github.com/pentakostal/NewsAPI_v2/blob/main/public%20/images/Peek%202023-01-22%2023-32.gif)

### Components used:
<ol>
<li>PHP 7.4</li>
<li>MySql (8.0.31-0ubuntu0.22.04.1 (Ubuntu))</li>
<li>Other packages located in composer.lock file</li>
</ol>

### How to install
<ol>
<li>Clone repository to your local machine (more convenient way for you)</li>
<li>For these project you will need an API key from (register for free, and you will
get your API key): </li>

[NewsAPI](https://newsapi.org/)

<li>After in console navigate to root folder, where you cloned project.</li>
<li>Then run command:</li>

> composer install

<li>shema.sql contains database schema, to import it you can use command 
(ore other method which you prefer):</li>

> mysql -u username -p stocks_api < shema.sql

<li>Create a .env file
    <ol>
        <li>Take .env.example file and rename it in .env.</li>
        <li>Enter your data about database.</li>
        <li>Enter your api key.</li>
        <li>Where is "CUSTOM" parameter enter yours.</li>
    </ol>
</li>
<li>Im root directory run command:</li>

>php -S localhost:8000

<li>After you can open project in your favorite browser under localhost:8000</li>
</ol>

