<?php
	require '../vendor/autoload.php';

	use \PalePurple\RateLimit\RateLimit;
	use \PalePurple\RateLimit\Adapter\APCu as APCAdapter;
	use \PalePurple\RateLimit\Adapter\Redis as RedisAdapter;
	use \PalePurple\RateLimit\Adapter\Predis as PredisAdapter;
	use \PalePurple\RateLimit\Adapter\Memcached as MemcachedAdapter;
	use \PalePurple\RateLimit\Adapter\Stash as StashAdapter;	

	$adapter = new APCAdapter(); // Use APC as Storage
	// Alternatives:
	//
	// $adapter = new RedisAdapter((new \Redis()->connect('localhost'))); // Use Redis as Storage
	//
	// $adapter = new PredisAdapter((new \Predis\Predis())->connect('localhost')); // Use Predis as Storage
	//
	// $memcache = new \Memcached();
	// $memcache->addServer('localhost', 11211);
	// $adapter = new MemcacheAdapter($memcache); 
	//
	// $stash = new \Stash\Pool(new \Stash\Driver\FileSystem());
	// $adapter = new StashAdapter($stash);

	$rateLimit = new RateLimit("myratelimit", 3, 3600, $adapter); // 100 Requests / Hour

	$id = $_SERVER['REMOTE_ADDR']; // Use client IP as identity
	if ($rateLimit->check($id)) 
	{
		echo "passed";
	} 
	else 
	{
		echo "rate limit exceeded";
	}
?>