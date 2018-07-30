<?php
namespace src\Integration;

/**
 * Interface Data
 * @package src\Integration
 */
interface Data
{
    /**
     * @param array $request
     * @return mixed
     */
    public function get(array $request);
}

/**
 * Class DataProvider
 * @package src\Integration
 */
class DataProvider implements Data
{
    /**
     * @var
     */
    private $host;
    /**
     * @var
     */
    private $user;
    /**
     * @var
     */
    private $password;

    /**
     * @param $host
     * @param $user
     * @param $password
     */
    public function __construct($host, $user, $password)
    {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * @param array $request
     *
     * @return array
     */
    public function get(array $request)
    {
        // returns a response from external service
    }
}

namespace src\Decorator;

use DateTime;
use Exception;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;
use src\Integration\Data;
use src\Integration\DataProvider;

/**
 * Базовый класс декоратора
 * @package src\Decorator
 */
class Decorator implements Data
{
    /**
     * @var Data
     */
    private $data;

    /**
     * Decorator constructor.
     * @param Data $data
     */
    public function __construct(Data $data)
    {
        $this->data = $data;
    }

    /**
     * @param array $request
     * @return mixed
     */
    public function get(array $request)
    {
        return $this->data->get($request);
    }
}

/**
 * Декоратор, который использует кэш для получения данных
 * @package src\Decorator
 */
class DecoratorManager extends Decorator
{
    /**
     * @var CacheItemPoolInterface
     */
    public $cache;
    /**
     * @var
     */
    public $logger;

    /**
     * @param string $host
     * @param string $user
     * @param string $password
     * @param CacheItemPoolInterface $cache
     */
    public function __construct(Data $data, CacheItemPoolInterface $cache)
    {
        parent::__construct($data);
        $this->cache = $cache;
    }

    /**
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function get(array $input)
    {
        try {
            $cacheKey = $this->getCacheKey($input);
            $cacheItem = $this->cache->getItem($cacheKey);
            if ($cacheItem->isHit()) {
                return $cacheItem->get();
            }

            $result = parent::get($input);

            $cacheItem
                ->set($result)
                ->expiresAt(
                    (new DateTime())->modify('+1 day')
                );

            return $result;
        } catch (Exception $e) {
            $this->logger->critical('Error');
        }

        return [];
    }

    /**
     * @param array $input
     * @return string
     */
    public function getCacheKey(array $input)
    {
        return json_encode($input);
    }
}
