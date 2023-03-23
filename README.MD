````
yFrame/
├── app/                   (应用代码)
│   ├── controllers/       (控制器)
│   ├── models/            (模型)
│   └── views/             (视图)
├── config/                (配置文件)
│   ├── app.php
│   └── database.php
├── public/                (公共资源和入口文件)
│   ├── assets/            (资源文件，如 CSS、JavaScript、图片等)
│   ├── css/
│   ├── js/
│   ├── .htaccess
│   └── index.php          (入口文件)
├── src/                   (框架核心代码)
│   ├── core/              (核心类库)
│   ├── helpers/           (助手函数)
│   ├── libraries/         (第三方库)
│   └── middleware/        (中间件)
├── storage/               (存放日志、缓存等)
│   ├── cache/
│   └── logs/
├── tests/                 (测试代码)
├── vendor/                (Composer 依赖)
├── .env                   (环境变量)
├── .gitignore
├── composer.json
└── composer.lock
