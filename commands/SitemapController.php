<?php
namespace app\commands;

use app\models\AdminArticles;
use app\models\Category;
use app\models\Item;
use grozzzny\sitemap\components\Sitemap;
use grozzzny\sitemap\controllers\ConsoleController;

/**
 * Console
 * php yii sitemap/console/update
 *
 * or
 *
 * crontab -e
 * 0 5 * * * /opt/php7.0/bin/php /home/c/cd51932/public_html/yii sitemap/console/update
 */
class SitemapController extends ConsoleController
{
    public $lastmodStaticPage = '2020-08-19';

    public $staticPages = [
        [
            'loc' => '/',
            'lastmod' => '2020-08-19',
            'changefreq' => Sitemap::CHANGEFREQ_MONTHLY,
            'priority' => Sitemap::PRIORITY_100,
        ],
        [
            'loc' => '/catalog',
            'lastmod' => '2020-08-19',
            'changefreq' => Sitemap::CHANGEFREQ_MONTHLY,
            'priority' => Sitemap::PRIORITY_60,
        ],
        [
            'loc' => '/service',
            'lastmod' => '2020-08-19',
            'changefreq' => Sitemap::CHANGEFREQ_MONTHLY,
            'priority' => Sitemap::PRIORITY_60,
        ],
        [
            'loc' => '/about',
            'lastmod' => '2020-08-19',
            'changefreq' => Sitemap::CHANGEFREQ_MONTHLY,
            'priority' => Sitemap::PRIORITY_60,
        ],
        [
            'loc' => '/delivery',
            'lastmod' => '2020-08-19',
            'changefreq' => Sitemap::CHANGEFREQ_MONTHLY,
            'priority' => Sitemap::PRIORITY_60,
        ],
        [
            'loc' => '/contacts',
            'lastmod' => '2020-08-19',
            'changefreq' => Sitemap::CHANGEFREQ_MONTHLY,
            'priority' => Sitemap::PRIORITY_60,
        ],
    ];

    protected function dataSitemap()
    {
        $this->generateArticles();
        $this->generateCategories();
        $this->generateItems();
    }

    protected function generateArticles()
    {
        $models = AdminArticles::find()
            ->andWhere(['active' => true])
            ->all();

        foreach($models as $model){
            $this->data_sitemap['articles'][] = array(
                'loc'           => $model->link,
                'lastmod'       => Sitemap::lastmodFormat($model->updated_at),
                'changefreq'    => Sitemap::CHANGEFREQ_MONTHLY,
                'priority'      => Sitemap::PRIORITY_60,
            );
        }
    }

    protected function generateCategories()
    {
        $models = Category::find()
            ->andWhere(['status' => true])
            ->all();

        foreach($models as $model){
            $this->data_sitemap['categories'][] = array(
                'loc'           => $model->link,
                'lastmod'       => Sitemap::lastmodFormat($model->updated_at),
                'changefreq'    => Sitemap::CHANGEFREQ_MONTHLY,
                'priority'      => Sitemap::PRIORITY_60,
            );
        }
    }

    protected function generateItems()
    {
        $models = Item::find()
            ->andWhere(['status' => true])
            ->all();

        foreach($models as $model){
            $this->data_sitemap['items'][] = array(
                'loc'           => $model->link,
                'lastmod'       => Sitemap::lastmodFormat($model->updated_at),
                'changefreq'    => Sitemap::CHANGEFREQ_MONTHLY,
                'priority'      => Sitemap::PRIORITY_60,
            );
        }
    }
}