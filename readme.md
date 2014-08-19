## DevPanel

DevPanel is open source for use on Developer Server Machines. It is used for project discovery -- showing versions, git status, Database + Webserver + Network setups, etc relating to all projects on a machine.*

*Or will. It's only a few hours old at the moment. Give it time.

### Installation

php composer.phar self-update

php composer.phar update

php composer.phar diagnose

php artisan migrate

### Releases

#### 0.0.5 alpha
Added CodeIgniter and WordPress awareness. Began work to mold into a single page Web Application that pulls the data from Ajax/Json Web Services. May upgrade to AngularJS next go around. Added Network pane. Reworked other panes.

It's starting to become usable.

TODO: Try to add guided auto install for first run.

TODO: Add AngularJS and rework into nice single page web app.

TODO: Add Nginx, PostgreSql and Mongo support.

TODO: Added Fedora/Redhat support (they don't use /etc/network/interfaces if I recall correctly).

TODO: Add JOOMLA detection.

TODO: Add node.js discovery (may be tricky).

TODO: Add standard library awareness (ie display bootstrap, angularjs, jquery versioning for projects, etc)

TODO: Redo UI for databases.

#### 0.0.4 alpha
Upgrade to Laravel 4.2.8. Added /etc/network/interfaces awareness. Added basic CakePHP awareness.

#### 0.0.3 alpha
Added Drupal, Laravel awareness.

#### 0.0.2 alpha

#### 0.0.1 alpha
First commit.

### License

DevPanel is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
