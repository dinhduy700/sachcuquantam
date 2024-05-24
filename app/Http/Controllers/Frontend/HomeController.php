<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Services\BannerService;
use App\Http\Services\NewsService;
use App\Http\Services\TagService;
use App\Http\Services\VideoService;
use App\Http\Services\ProductService;
use App\Http\Services\ProductCategoryService;
use App\Http\Services\SettingService;
use App\Http\Services\BrandService;
use App\Http\Services\PartnerService;
use App\Http\Services\PageService;
use App\Http\Services\OrderService;
use App\Models\Subscribe;
use Storage;
use File;
use Session;
use Illuminate\Http\Request;
use DB;
use App\Models\ProductReview;
use Auth;
use Carbon\Carbon;

class HomeController extends Controller {

    public function __construct(
        BannerService $bannerService,
        NewsService $newsService,
        TagService $tagService,
        VideoService $videoService,
        ProductService $productService,
        ProductCategoryService $productCategoryService,
        SettingService $settingService,
        BrandService $brandService,
        PartnerService $partnerService,
        PageService $pageService,
        OrderService $orderService

    ) {
        $this->bannerService = $bannerService;
        $this->newsService = $newsService;
        $this->tagService = $tagService;
        $this->videoService = $videoService;
        $this->productService = $productService;
        $this->productCategoryService = $productCategoryService;
        $this->settingService = $settingService;
        $this->brandService = $brandService;
        $this->partnerService = $partnerService;
        $this->pageService = $pageService;
        $this->orderService = $orderService;
    }

    public function getIndex()
    {
        $banners = $this->bannerService->getBannerListIndex(0);
        $bannerAdvertisements = $this->bannerService->getBannerListIndex(1);
        $bannerEvents = $this->bannerService->getBannerListIndex(3);
        $news = $this->newsService->getNewsForIndex();
        $productLatest = $this->productService->getProductListPage(6, 1);
        $productSelling = $this->productService->getProductListPage(6, 4);
        $productPromotion = $this->productService->getProductListPage(6, 2);
        $setting = $this->settingService->getSettingService();
        $partners = $this->partnerService->list(1);
        $categoriesTop = $this->productCategoryService->getListCategoryTop();
        $bannerTopCategory = $this->bannerService->getBannerListIndex(2, 1);
        return view('frontend.index', [
            'banners' => $banners,
            'news' => $news,
            'productLatest' => $productLatest,
            'productSelling' => $productSelling,
            'productPromotion' => $productPromotion,
            'setting' => $setting,
            'bannerAdvertisements' => $bannerAdvertisements,
            'partners' => $partners,
            'categoriesTop' => $categoriesTop,
            'bannerEvents' => $bannerEvents,
            'bannerTopCategory' => $bannerTopCategory
        ]);
    }

    public function getImages($name)
    {
        $profilePictureURL = public_path().'/'.$name;

        if (!File::exists( $profilePictureURL ))
            return response()->file(public_path().'/frontend/assets/images/no-image.png');
        return response()->file($profilePictureURL);
    }

    public function getImageStorage($name)
    {
        $profilePictureURL = public_path().'/storage/'.$name;

        if (!File::exists( $profilePictureURL ))
            return response()->file(public_path().'/frontend/assets/images/no-image.png');
        return response()->file($profilePictureURL);
    }

    public function getConllections(Request $rq)
    {
        $banners = $this->bannerService->getBannerListIndex(0);
        $products = $this->productService->getProductListPage(12, 0, $rq);
        $productsFavorite = $this->productService->getProductListPage(6, 5);
        $brands = $this->brandService->getBrandList();
        return view('frontend.product', ['banners' => $banners, 'products' => $products, 'productsFavorite' => $productsFavorite, 'brands' => $brands]);
    }
    
    public function getConllectionsNew(Request $rq)
    {
        $banners = $this->bannerService->getBannerListIndex(0);
        $products = $this->productService->getProductListPage(12, 1, $rq);
        $productsFavorite = $this->productService->getProductListPage(6, 5);
        $brands = $this->brandService->getBrandList();
        return view('frontend.product', ['banners' => $banners, 'products' => $products, 'productsFavorite' => $productsFavorite ,'brands' => $brands]);
    }

    public function getConllectionsSelling(Request $rq)
    {
        $banners = $this->bannerService->getBannerListIndex(0);
        $products = $this->productService->getProductListPage(12, 2, $rq);
        $productsFavorite = $this->productService->getProductListPage(6, 5);
        $brands = $this->brandService->getBrandList();
        return view('frontend.product', ['banners' => $banners, 'products' => $products, 'productsFavorite' => $productsFavorite, 'brands' => $brands]);
    }

    public function getConllectionsSale(Request $rq)
    {
        $banners = $this->bannerService->getBannerListIndex(0);
        $products = $this->productService->getProductListPage(12, 4, $rq);
        $productsFavorite = $this->productService->getProductListPage(6, 5);
        $brands = $this->brandService->getBrandList();
        return view('frontend.product', ['banners' => $banners, 'products' => $products, 'productsFavorite' => $productsFavorite, 'brands' => $brands]);
    }

    public function getConllectionSlug(Request $rq, $slug)
    {
        $banners = $this->bannerService->getBannerList();
        $category = $this->productCategoryService->getProductCategoryBySlug($slug);
        if(!isset($category->id))
        {
            abort(404);
        }
        $products = $this->productService->getProductListPage(12, 0, $rq, $category->id);
        $productsFavorite = $this->productService->getProductListPage(6, 5);
        $brands = $this->brandService->getBrandList();
        return view('frontend.product', ['banners' => $banners, 'products' => $products, 'productsFavorite' => $productsFavorite, 'brands' => $brands]);
    }

    public function getDetailProduct($slug)
    {
        $banners = $this->bannerService->getBannerListIndex(0);

        $page = $this->pageService->getPageBySlug($slug);
        if(!empty($page))
        {
            return view('frontend.page-content', ['banners' => $banners, 'page' => $page]);
        }
        $product = $this->productService->getProductBySLug($slug);
        if(empty($product))
            abort(404);
        $productNear = $this->productService->getProductListPage(6, 0, null, $product->category_id);
        $productsFavorite = $this->productService->getProductListPage(6, 5);

        $productReview = ProductReview::where(['is_active' => 1, 'product_id' => $product->id, 'reply_id' => 0])->get();
        
        return view('frontend.detail-product', ['banners' => $banners, 'productDetail' => $product, 'productNear' => $productNear, 'productsFavorite' => $productsFavorite, 'productReview' => $productReview]);
    }

    public function getListNews()
    {
        $banners = $this->bannerService->getBannerListIndex(0);
        $tags = $this->tagService->getTagsList();
        $newsN = $this->newsService->getNewsListN(4, null, 1, 3);
        $news = $this->newsService->getNewsList(6, null, 1);
        return view('frontend.news', ['banners' => $banners, 'tags' => $tags, 'news' => $news, 'newsN' => $newsN]);
    }

    public function getDetailNews($slug)
    {
        $banners = $this->bannerService->getBannerListIndex(0);
        $tags = $this->tagService->getTagsList();
        $newsN = $this->newsService->getNewsListN(4, null, 1, 3);
        $detailNews = $this->newsService->getDetailNewsBySlug($slug);
        return view('frontend.detail-news', ['banners' => $banners, 'tags' => $tags, 'newsN' => $newsN, 'detailNews' => $detailNews]);
    }

    public function getListVideo()
    {
        $banners = $this->bannerService->getBannerListIndex(0);
        $videos = $this->videoService->getVideoList(null, null, 1);
        return view('frontend.video', ['banners' => $banners, 'videos' => $videos]);
    }

    public function getCart()
    {
        $banners = $this->bannerService->getBannerListIndex(0);
        $dataCart = Session::get('cart');
        if(!empty($dataCart['data']))
        foreach ($dataCart['data'] as $key => $value) {
            $product = $this->productService->getProductById($value['info']->id);
            $dataCart['data'][$key]['info'] = $product;
        }
        Session::put('cart', $dataCart);
        return view('frontend.cart', ['banners' => $banners]);
    }

    public function getCheckOut()
    {
        $dataCart = Session::get('cart');
        if(empty($dataCart))
            return redirect()->route('home');
        if(!empty($dataCart['data']))
        foreach ($dataCart['data'] as $key => $value) {
            $product = $this->productService->getProductById($value['info']->id);
            $dataCart['data'][$key]['info'] = $product;
        }

        Session::put('cart', $dataCart);
        return view('frontend.checkout');
    }

    public function getNewsByTags($slug)
    {
        $news = $this->newsService->getNewsByTags($slug);
        $banners = $this->bannerService->getBannerListIndex(0);
        $tags = $this->tagService->getTagsList();
        $newsN = $this->newsService->getNewsListN(4, null, 1, 3);
        return view('frontend.news', ['banners' => $banners, 'tags' => $tags, 'news' => $news, 'newsN' => $newsN]);
    }

    public function postSendEmail(Request $rq)
    {
        $rq->validate([
            'email' => 'required|email:rfc,dns'
        ]);

        DB::beginTransaction();
        try{
            $email = Subscribe::create(['email' => $rq->email]);
            if(!$email)
            {
                return redirect()->route('home')->with('error', __('frontend.error_send_mail'));
            }
            DB::commit();
            return redirect()->route('home')->with('success', __('frontend.success_send_mail'));
        }
        catch(Exception $e)
        {
            DB::callback();
            return $e;
        }
    }

    public function loadViewProductTab(Request $rq)
    {
        $products = $this->productService->getProductListPage(4, $rq->dataType);
        return view('frontend.layouts.product-tab', ['products' => $products]);
    }

    public function postRate(Request $rq)
    {
        DB::beginTransaction();
        try{
            $productId = $rq->product_id;
            if(!$productId)
                return redirect()->back()->with('errorSubmit', 'Thao tác thất bại, thử lại sau');
            $name = $rq->fullname;
            $star = $rq->valuestart;
            $content = $rq->content;
            $file = $rq->image;
            $arrayImage = array();
            if(!empty($file))
                foreach ($file as $key => $value) {
                    $namefile = "rate/".$productId.'/'.$productId.time().$key.'.jpg';
                    if (preg_match('/^data:image\/(\w+);base64,/', $value)) {
                        $data = substr($value, strpos($value, ',') + 1);
                        $data = base64_decode($data);
                        Storage::disk('public')->put($namefile, $data);
                        $arrayImage[] = $namefile; 
                    }
                }
            DB::table('product_review')->insertGetId([
                'product_id' => $productId,
                'name' => $name,
                'email' => null,
                'review_content' => $content,
                'file' => json_encode($arrayImage),
                'score' => $star,
                'is_active' => 0,
                'created_at' => Carbon::now()
            ]);
            DB::commit();
            return redirect()->back()->with('success', __('frontend.rate_success'));
        }
        catch(Exception $e)
        {
            DB::callback();
            return redirect()->back()->with('error', __('frontend.rate_error'));
        }
    }

    public function viewPopupDetailProduct(Request $rq)
    {
        if($rq->ajax())
        {
            //$productId = $rq->product_id ? $rq->product_id : 1;
            if(!$rq->product_id)
                return json_encode(['message' => 'Thất bại', 'status' => Response::HTTP_INTERNAL_SERVER_ERROR]);
            else
                $productId = $rq->product_id;
            $product = $this->productService->getProductById($productId);
            if(empty($product))
                return json_encode(['message' => 'Thất bại', 'status' => Response::HTTP_INTERNAL_SERVER_ERROR]);
            return view('frontend.layouts.popup-detail-product', ['product' => $product]);
        }
        else
        {
            return json_encode(['message'=>'Thất bại', 'status' => Response::HTTP_INTERNAL_SERVER_ERROR ]);
        }
    }

    public function postSubmitComment(Request $rq)
    {
        DB::beginTransaction();
        try{
            $data = array();
            $data['news_id'] = $rq->news_id;
            $data['name'] = $rq->name;
            $data['email'] = $rq->email;
            $data['comment'] = $rq->comment;
            $data['is_active'] = 0;
            $data['created_at'] = Carbon::now();
            DB::table('news_comment')->insert($data);
            DB::commit();
            return redirect()->back()->with('success', __('frontend.comment_success'));
        }
        catch(Exception $e)
        {
            DB::callback();
            return redirect()->back()->with('error', __('frontend.comment_error'));
        }

    }

    public function getInfoCustomer()
    {   
        if(!Auth::guard('customer')->check())
        {
            return redirect()->route('home');
        }
        $banners = $this->bannerService->getBannerListIndex(0);
        $orderService = $this->orderService->getList(null, null, null, null, auth()->guard('customer')->user()->id, null);
        return view('frontend.info-customer', ['banners' => $banners, 'orderService' => $orderService]);
    }

    public function postInfoCustomer(Request $rq)
    {
        DB::beginTransaction();
        try{
            $data = array();
            if($rq->avatar)
            {
                $file = $rq->file('avatar');
                $namefile = "avatar/".time().'.jpg';
                Storage::disk('public')->putFileAs('', $file, $namefile);
                $data['image'] = $namefile; 
            }
            $data['name'] = $rq->full_name;
            $data['phone'] = $rq->phone;
            $data['address'] = $rq->address;
            $data['city'] = $rq->city;
            $data['district'] = $rq->district;
            $data['ward'] = $rq->ward;
            DB::table('users')->where('id', Auth::guard('customer')->user()->id)->update($data);
            DB::commit();
            return redirect()->back();
        }
        catch(Exception $e)
        {
            DB::callback();
            return redirect()->back();
        }

    }

    public function getConfirm(Request $rq)
    {
        $banners = $this->bannerService->getBannerListIndex(0);
        $data = Session::get('data');
        $dataCart = Session::get('dataCart');
        $setting = $this->settingService->getSettingService();
        if(!Session::has('data'))
            return redirect()->route('home');
        return view('frontend.confirm', ['data' => $data, 'dataCart' => $dataCart, 'banners' => $banners, 'setting' => $setting]);
    }


}
