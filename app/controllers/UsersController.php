<?php

namespace App\Controllers;

use App\Model\User;
use Yframe\Core\ServiceLocator;

class UsersController extends BaseController
{

    public function __construct(ServiceLocator $serviceLocator)
    {
        parent::__construct($serviceLocator);
        $this->cache = $this->serviceLocator->getService('cache');
        $this->logger = $this->serviceLocator->getService('logger');
    }


    public function show($id)
    {
        // 尝试从缓存中获取数据
        $cahce = $this->cache->get('users_page_data');

        // 如果缓存中没有数据，则从数据库或其他数据源中获取数据，并将其缓存
        if ($cahce === null) {
            $cahce = $this->fetchDataFromDatabaseOrOtherSources();
            $this->cache->set('users_page_data', $cahce);
            $this->logger->info('Fetched data from the database and cached it.');
        } else {
            $this->logger->info('Fetched data from cache.');
        }

        // 这里我们创建一个假的用户数据，实际应用中，您可能需要从数据库中获取
        $data = User::getUserById(1);
        print_r($data);exit;
        $this->render('users/index', $data);
    }


    private function fetchDataFromDatabaseOrOtherSources()
    {
        // 从数据库或其他数据源获取数据的逻辑
        // 这里只是一个示例，实际情况下您需要根据您的需求来实现
        return [
            'title' => 'Welcome to YFrame',
            'content' => 'This is a sample page using YFrame.',
        ];
    }
}
