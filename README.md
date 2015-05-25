# Jugendstadtplan

Das Projekt ist eine Single-Page-App auf Basis von Angular im Frontend und Symfony2 im Backend.

## Installation

Für die Installation des Projektes sind eine Reihe von Befehlen notwendig. 

1. Das Projekt nutzt eine Virtuelle Umgebung, um so isoliert wie möglich zu sein. Um die virtuelle Maschine hochzufahren reicht ein `vagrant up`. Der erste Start wird recht lange dauern, da dann erst noch das Image gezogen werden muss. 
Mit einem `vagrant ssh` kann man sich dann in die virtuelle Maschine per SSH einloggen. Die Arbeitskopie wird in das Standard-Webserver-Verzeichnis von Ubuntu gemountet `/var/www`.

2. Das Backend lässt sich einfach per `composer install` betriebsfertig machen. Der Befehl muss natürlich im Webserver-Verzeichnis ausgeführt werden.

3. Datenbank installieren: Beim ersten Start muss noch die Datenbank installiert werden. Dazu muss man zunächst seine Zugangsdaten für Symfony2 erreichbar ablegen. Die lokalen Parameter für Symfony2 werden üblicherweise unter `app/config/parameters.yml` abgelegt. Beispiel:

        parameters:
            database_driver: pdo_mysql
            database_host: 127.0.0.1
            database_port: null
            database_name: jugendstadtplan
            database_user: root
            database_password: root
            mailer_transport: smtp
            mailer_host: 127.0.0.1
            mailer_user: null
            mailer_password: null
            locale: de
            secret: 'lnksnkln343%nls3"§nli=(lli__hIDFJNKssk44'
 
    Die Installation kann dann mit den folgenden Befehlen geschehen:
    
        php app/console doctrine:database:create -qn
        php app/console doctrine:schema:update --force

4. Die für das Frontend benötigten Bibliotheken kann man mit `bower install` installieren.

## Entwicklung

Für die Entwicklung sind folgende Werkzeuge notwendig:

    gulp
    
Ein einfacher Aufruf von `gulp` kompiliert SCSS- und JavaScript-Dateien. Die Kompilate werden im DocumentRoot (`web`) abgelegt. Zudem werden die Kompilate mit unter Versionskontrolle gestellt, da das den Installationsprozess auf dem Server vereinfacht.

Um dauerhaft alle SCSS und JavaScript-Dateien zu überwachen und ggf. neu zu kompilieren reicht ein Aufruf von `gulp watch`. Unter Umständen funktioniert dieser Befehl nur auf der Host-Maschine, da in der Vagrant aufgrund der NFS-Einbindung keine Änderungen erkannt werden.

Die Webseite sollte unter der IP `192.168.33.10` im Browser erreichbar sein.

### Troubleshooting

#### Die Seite ist nicht erreichbar

Es kann sein, dass der Webserver nicht automatisch gestartet wird. Dann reich ein einfaches `sudo apache2ctl restart` um ihn zu (neuzu-) starten.

#### Die Datenbank ist nicht erreichbar

Vielleicht ist sie gar nicht an. Ein `sudo /etc/init.d/mysql restart` sollte helfen.

## Betrieb

Das DocumentRoot muss das `web`-Verzeichnis sein. Dort darf keine `.htaccess`-Datei liegen, die - wie das normalerweise in Symfony2 üblich ist - alle Requests auf die `app.php` umbiegt. Die `index.php` ist unser Einstiegspunkt in die Applikation.
