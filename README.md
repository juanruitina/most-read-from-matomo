# Fetch stats from Matomo using PHP

This script fetches and processes data from Matomo installations and outputs it as a JSON file. It also caches the JSON output for fewer requests and improved performance.

* Duplicate `config-sample.php` and rename as `config.php`. You should add your Matomo URL and a Matomo auth token. You can generate this token in your Matomo installation, in Administration > Personal > Security.
* Verify the script has permissions to create the ``/cache`` folder and to write inside it. The script will return a uncached output otherwise.
* `top-10-articles.php` gets the top 10 pages over the last 30 days whose path starts by `/article`, returns a JSON file with the fetch date and time and an array of the second level of their path, and caches it for 6 hours.
