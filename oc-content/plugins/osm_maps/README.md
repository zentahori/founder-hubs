osm_maps, OpenStreetMap Maps plugin
========

osm_maps plugin for osclass.org Open Source Classified

This plugin shows OpenStreetMap map for each item.

It requires activated

allow_url_fopen = On

in the server php.ini file (requires server restart),

as it uses simplexml_load_file PHP function. It can be checked if it is activated via standard phpinfo(); call.

If it is not activated, and if you have no access to php.ini file on the server, try to put: 

php_value allow_url_fopen On 

into .htaccess file in the root folder of the server.

Google Maps plugin should be deactivated before installation.

If a house number is not mapped on the OpenStreetMap, one can add it on the map himself, as it is a wiki-style map (see www.osm.org for details).

The license of the OpenStreetMap allows to use it for free for commercial projects, even with high traffic volumes.
