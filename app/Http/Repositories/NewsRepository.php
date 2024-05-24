<?php

/**
 * Banner Repositories Application
 * PHP version ^7.3|^8.0
 *
 * @category Banner
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */

namespace App\Http\Repositories;

use App\Models\News;

use App\Models\NewsTranslation;

use Illuminate\Support\Str;

use Carbon\Carbon;

use DB;
/**
 * Banner Repositories handle query for module Product
 *
 * @category Banner
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */

class NewsRepository
{
    /**
     * Query get list banner
     * 
     * @param int $pagination - items quantity
     *
     * @return \Illuminate\Http\Response
     */
    public function list($pagination, $search, $status, $sortBy)
    {   
        $news = News::select('news.*');
        if (!empty($search)) {
            $news = $news->whereHas(
                'translation', function ($query) use ($search) {
                    $query->where('news_title', 'like', '%'.$search.'%');
                }
            );
        }
        if ($status != null) {
            $news = $news->where('is_active', $status);
        }
        if ($sortBy !== null) {
            $conditionSort = 'DESC';
            if ($sortBy % 2 != 1) {
                $conditionSort = 'ASC';
            }
            if ($sortBy == 0 || $sortBy == 1) {
                $news = $news->join('news_translation', 'news.id', '=', 'news_translation.news_id')->where('locale', config('app.locale'))->orderBy('news_title', $conditionSort);
            } else if ($sortBy == 2 || $sortBy == 3) {
                $news = $news->orderBy('created_at', $conditionSort);
            }
        } else {
            $news = $news->orderBy('news_position', 'ASC')->orderBy('id', 'ASC');
        }
        $news = $news->with('translation');
        if (!empty($pagination)) {
            $news = $news->paginate(is_numeric($pagination) ? $pagination : config('constants.pagination'));
        } else {
            $news = $news->get();
        }
        return $news;
    }

    /**
     * Save information product category
     *
     * @param Request $request - send information product category
     *
     * @return \Illuminate\Http\Response
     */
    public function store($request)
    {
        $data = [
            'tag_id' => json_encode($request->tag_id ?? []),
            'news_image' => $request->news_image ?? null,
            'news_publish' => Carbon::parse($request->news_publish)->format('Y-m-d H:i') ?? null,
            'news_position' => $request->news_position ?? 0,
            'is_active' => $request->is_active ?? 0,
            'is_hot_news' => $request->is_hot_news ?? 0,
            'is_promotion_news' => $request->is_promotion_news ?? 0,
        ];

        $news = News::create($data);
    
        if ($news) {
            $languages = config('constants.multilang');
            foreach ($languages as $lang) {
                $dataTranslation[] = [
                    'locale' => $lang,
                    'news_id' => $news->id,
                    'news_title' => $request->$lang['news_title'] ?? null,
                    'news_slug' => $request->$lang['news_slug'] ?? Str::slug($request->$lang['news_title']) . '-' . $news->id,
                    'news_description' => $request->$lang['news_description'] ?? null,
                    'news_content' => $request->$lang['news_content'] ?? null,
                    'seo_title' => $request->$lang['seo_title'] ?? null,
                    'seo_description' => $request->$lang['seo_description'] ?? null,
                    'seo_keywords' => $request->$lang['seo_keywords'] ?? null,
                ];
            }
            NewsTranslation::insert($dataTranslation);
        }
        return $news;
    }

    /**
     * Update information banner
     * 
     * @param Request            $request - send information banner
     * @param \App\Models\Banner $banner  - banner
     * 
     * @return \Illuminate\Http\Response 
     */
    public function update($request, $news)
    {
        $data = [
            'tag_id' => json_encode($request->tag_id ?? []),
            'news_image' => $request->news_image ?? null,
            'news_publish' => Carbon::parse($request->news_publish)->format('Y-m-d H:i') ?? null,
            'news_position' => $request->news_position ?? 0,
            'is_active' => $request->is_active ?? 0,
            'is_hot_news' => $request->is_hot_news ?? 0,
            'is_promotion_news' => $request->is_promotion_news ?? 0,
        ];
        News::where('id', $news)->update($data);
        if ($news) {
            $languages = config('constants.multilang');
            foreach ($languages as $lang) {
                $dataTranslation = [
                    'news_title' => $request->$lang['news_title'] ?? null,
                    'news_slug' => $request->$lang['news_slug'] ?? Str::slug($request->$lang['news_title']) . '-' . $news,
                    'news_description' => $request->$lang['news_description'] ?? null,
                    'news_content' => $request->$lang['news_content'] ?? null,
                    'seo_title' => $request->$lang['seo_title'] ?? null,
                    'seo_description' => $request->$lang['seo_description'] ?? null,
                    'seo_keywords' => $request->$lang['seo_keywords'] ?? null,
                ];
                NewsTranslation::where(['locale' => $lang, 'news_id' => $news])->update($dataTranslation);
            }
        }
    }

    public function getInformationNews($news)
    {
        return News::findOrFail($news);
    }

    /**
     * Delete information product category
     * 
     * @param $banner - banner delete
     * 
     * @return \Illuminate\Http\Response 
     */
    public function delete($news)
    {
        News::find($news)->delete();
    }

    public function listN($pagination, $search, $status, $sortBy)
    {
        $news = News::select('news.*');
        if (!empty($search)) {
            $news = $news->whereHas(
                'translation', function ($query) use ($search) {
                    $query->where('news_title', 'like', '%'.$search.'%');
                }
            );
        }
        if ($status != null) {
            $news = $news->where('is_active', $status);
        }
        if ($sortBy !== null) {
            $conditionSort = 'DESC';
            if ($sortBy % 2 != 1) {
                $conditionSort = 'ASC';
            }
            if ($sortBy == 0 || $sortBy == 1) {
                $news = $news->join('news_translation', 'news.id', '=', 'news_translation.news_id')->where('locale', config('app.locale'))->orderBy('news_title', $conditionSort);
            } else if ($sortBy == 2 || $sortBy == 3) {
                $news = $news->orderBy('created_at', $conditionSort);
            }
        } else {
            $news = $news->orderBy('news_position', 'ASC')->orderBy('id', 'ASC');
        }
        $news = $news->with('translation');
        $news = $news->limit($pagination);
        $news = $news->get();
        return $news;
    }

     /**
     * Delete information news 
     * 
     * @param $slug
     * 
     * @return object
     */
    public function getDetailNewsBySlug($slug)
    {
        return News::with('translation')->whereHas('translation', function ($query) use ($slug) {
                    $query->where('news_slug', $slug);
                })->first();
    }

    public function getNewsByTags($slug)
    {
        return News::where(function($query) use ($slug)
        {
            $tag = DB::table('tags')->join('tag_translation', 'tags.id', 'tag_translation.tag_id')->where('tag_translation.tag_slug', $slug)->where('tag_translation.locale', app()->getLocale())->select('tags.id')->first();
             $query->whereJsonContains('tag_id', (string)$tag->id);
             return $query;
        })->paginate(6);
    }

    public function getNewsForIndex()
    {
        return News::where('is_hot_news', 1)->orderBy('news_position', 'ASC')->orderBy('id', 'DESC')->paginate(3);
    }
}
