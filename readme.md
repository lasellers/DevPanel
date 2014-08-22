## DevPanel

DevPanel is open source for use on Developer Server Machines. It is used for project discovery -- showing versions, git status, Database + Webserver + Network setups, etc relating to all projects on a machine.*

*Or will. It's only a few hours old at the moment. Give it time.

### Installation

php composer.phar self-update

php composer.phar update

php composer.phar diagnose

php artisan migrate

### Releases

#### 0.0.6 alpha 8/22/2014
Now completely refactored into AngularJS with a RESTful API. :)

I'd never used AngularJS at all until two days ago so ... it's probably not "best practices". Yet. But it'll get there.

TODO: Clean up all UI/UX issues. It needs to be much smoother and fluid. Need to read-up on Bootstrap + AngularJS to sort some issues. Harder than it needs to be. Need to either find a good libary or just makes some open sources directives to handle this stuff.

TODO: Consider localStorage option to enhance speed? hmm.

TODO: Add github-awareness.

TODO: Add .NET awareness. Add ColdFusion awareness.

TODO: __Suggest__ to all frameworks that they add in a json file marker (outside of composer.json as not all use composer.json -- .NET for example. A project.json with summary and high-level (locations) manifest.)

TODO: !!! Add mongolab support so it can save the local RESTful cache out to mongo, then once all your dev machines are setup with this you can ultimately browse through a list of project states on all machines in your dev group or business. :) !!! Also store activity data. DevPanel == github-ish project activity+states.

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
