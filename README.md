# php_custom_metrics

A prometheus exporter for php-modules. The exporter connects to database, create table with info about included php-modules and collect metrics.

## Minimum Requirements

You should set up services nginx, prometheus, create database

For example:

### Nginx

Create a new config file in the nginx config directory
```sh
server {
	listen        9102;
	server_name  phpmetrics;

	access_log   /var/log/nginx.access_log;
	error_log   /var/log/nginx.error_log;

	root  $HOME/php_custom_metrics/;
	index index.php;

	location /metrics {
		try_files   $uri  /metrics/index.php;
	}
	location ~* \.php$ {
		try_files $uri = 404;
		fastcgi_split_path_info ^(.+\.php)(/.+)$;
		fastcgi_pass unix:/var/run/php-fpm/php-fpm.sock;
		fastcgi_index index.php;
		fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
		include fastcgi_params;
	}
}
```

### Prometheus

You need to add job to scrape_configs
```sh
  - job_name: "php"
    static_configs:
    - targets: ["phpmetrics:9102"]
```

### Database

Create a database named custom_metrics
```sh
mysql -e "CREATE DATABASE custom_metrics"
```

## CLI Examples

Retrieve metrics from php_custom_metrics running on `phpmetrics:9102`. Endpoint /metrics
```sh
curl -v http://phpmetrics:9102/metrics
```