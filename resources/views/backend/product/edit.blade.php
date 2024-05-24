@extends('backend.index')

@section('backend-content-wrapper')
<div class="container-fluid product-add-wrapper">
  <div class="row">
    <div class="col-12">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">{{ __('app.layouts.all-products') }}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ __('app.products.edit-products') }}</li>
        </ol>
      </nav>
    </div>

    <div class="col-12 d-inline-flex justify-content-between align-items-center mb-4" id="fix-header-content">
      <div class="content-title">
        <h2>{{ __('product.edit_product') }}</h2>
      </div>

      <div class="content-btn d-flex align-items-center">
        <div class="btn-group">
          <a href="{{ route('admin.products.create') }}" class="btn btn-primary text-white" id="submit">
            {{ __('app.save') }}
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <form id="product-add-form" method="post">
      @csrf
        <!-- progressbar -->
        <!-- <ul id="progressbar">
          <li>Classify</li>
          <li class="active">Identify</li>
        </ul> -->

        <div class="row">
          <div class="col-lg-12">
          <!-- fieldsets -->
            <fieldset class="classify-wrapper">
              <div class="card">
                <div class="card-body">
                  <div class="form-group row">
                    <div class="col-sm-12 mb-3">
                      <label class="col-form-label form-label">
                        <h5 class="font-weight-bold">{{ __('app.products.browse-quote') }}</h5>
                      </label>

                      <div class="form-note">
                        {!! __('app.products.note-quote', ['link' => route('admin.categories.create')]) !!}
                      </div>

                      <div class="category-selected mt-3">
                        {{ __('app.products.current-selected') }}:
                        <span class="category-selected-info jsCaterogySelected"></span>
                      </div>
                    </div>

                    <div class="col-sm-12 category-wrapper">
                      <div class="category-list">
                        <ul class="list-group scrollbar">
                          @foreach($categories as $row)
                          <li class="list-group-item category-item" data-parent="{{$row->id}}" parent="0">
                            <p class="m-0">
                              {{$row->translation->product_category_name}}
                            </p>
                            <div class="category-item-right">
                              <i class="fas fa-angle-right"></i>
                            </div>
                          </li>
                          @endforeach
                        </ul>

                        <ul class="list-group scrollbar"></ul>
                        <ul class="list-group scrollbar"></ul>
                        <ul class="list-group scrollbar"></ul>
                        <ul class="list-group scrollbar"></ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <a href="javascript:void(0)" class="btn btn-primary next action-button">
                Next
              </a>
            </fieldset>
            <fieldset class="identify-wrapper">
                <div class="row">
                  <div class="col-12">
                    <!-- <div class="card store-view-wrapper">
                      <div class="card-body">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label field-required">
                            Store View:
                          </label>

                          <div class="col-sm-10 text-end">
                            <select id="selectLanguage" class="form-select">
                              <option value="en">English</option>
                              <option value="vi">Vietnamese</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div> -->

                    <div class="card">
                      <div class="card-header">
                        Thông tin cơ bản
                      </div>
                  
                      <div class="card-body">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label field-required">
                          Mã SP:<sup>*</sup>
                            <!-- <div class="form-note">(Max: 120 characters)</div> -->
                          </label>
                  
                          <div class="col-sm-10 text-end">
                            <input type="text" class="form-control" id="inputProductName" value="{{$product->product_code}}" name ="product_code" maxlength='30' onkeyup="countString(this)" required>
                            <!-- <span class="form-control-character-count">0 / 30</span> -->
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label field-required">Giá:<sup>*</sup></label>
                          <div class="col-sm-10 text-end">
                            <input type="number" class="form-control" id="inputProductName" name ="price" value="{{$product->price}}" required>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label field-required">Giá giảm:</label>
                          <div class="col-sm-10 text-end">
                            <input type="number" class="form-control" id="inputProductName" value="{{$product->promotion_price}}" name ="promotion_price">
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label field-required">Thời gian giảm:</label>
                          <div class="col-sm-5 text-end">
                            <input type="text" class="form-control jsDatepicker" id="inputProductName" name ="promotion_start" value="{{$product->promotion_start!=null?date('d-m-Y H:i',strtotime($product->promotion_start)):''}}">
                          </div>
                          <div class="col-sm-5 text-end">
                            <input type="text" class="form-control jsDatepicker" id="inputProductName"  name ="promotion_end" value="{{$product->promotion_end!=null?date('d-m-Y H:i',strtotime($product->promotion_end)):''}}">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Hiện</label>
                          <div class="col-sm-10">
                            <div class="form-check form-switch custom-switch">
                              <input class="form-check-input form-switch-custom" type="checkbox" id="customNew" value="1" name="is_active" @if($product->is_active==1) checked @endif>
                              <label class="form-check-label" for="customNew"></label>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Sản phẩm mới</label>
                          <div class="col-sm-10">
                            <div class="form-check form-switch custom-switch">
                              <input class="form-check-input form-switch-custom" type="checkbox" id="customNew" value="1" name="is_new"  @if($product->is_new==1) checked @endif>
                              <label class="form-check-label" for="customNew"></label>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Sản phẩm nổi bật</label>
                          <div class="col-sm-10">
                            <div class="form-check form-switch custom-switch">
                              <input class="form-check-input form-switch-custom" type="checkbox" id="customNew" value="1" name="is_highlight" @if($product->is_highlight==1) checked @endif>
                              <label class="form-check-label" for="customNew"></label>
                            </div>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Sản phẩm khuyến mãi</label>
                          <div class="col-sm-10">
                            <div class="form-check form-switch custom-switch">
                              <input class="form-check-input form-switch-custom" type="checkbox" id="customNew" value="1" name="is_promotion" @if($product->is_promotion==1) checked @endif>
                              <label class="form-check-label" for="customNew"></label>
                            </div>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Sản phẩm bán chạy</label>
                          <div class="col-sm-10">
                            <div class="form-check form-switch custom-switch">
                              <input class="form-check-input form-switch-custom" type="checkbox" id="customNew" value="1" name="is_selling" @if($product->is_selling==1) checked @endif>
                              <label class="form-check-label" for="customNew"></label>
                            </div>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Sản phẩm yêu thích</label>
                          <div class="col-sm-10">
                            <div class="form-check form-switch custom-switch">
                              <input class="form-check-input form-switch-custom" type="checkbox" id="customNew" value="1" name="is_favorite" @if($product->is_favorite==1) checked @endif>
                              <label class="form-check-label" for="customNew"></label>
                            </div>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Danh mục:</label>
                          <div class="col-sm-10">
                            <select class="form-control" id="inputBrand" name ="product_category_id">
                            @php
                            function category($data,$parent_id,$str='',$selected){
                                $data=$data;
                                foreach ($data as $items) {
                                    if($items->parent_id==$parent_id){
                                        $txtselected="";
                                        if($selected == $items->id){
                                            $txtselected='selected';
                                        }
                                        else{
                                            $txtselected="";
                                        }
                                        echo "<option ".$txtselected."  value=".$items->id.">".$str.$items->translation->product_category_name."</option>";
                                        category($data,$items->id,$str.' - - ',$selected);
                                    }
                                }
                            }
                            $selected=$product->product_category_id;
                            category($categories,0,$str='',$selected);
                            @endphp
                            </select>
                          </div>
                        </div>

                        <!-- <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Danh mục:<sup>*</sup></label>
                          <div class="col-sm-10 category-selected">
                            <span class="category-selected-info jsCaterogySelected"></span>
                            <input type="hidden" class="form-control" id="product_category_id" value="" name ="product_category_id">
                            <a href="javascript:void(0)" class="btn previous action-button action-button-previous text-primary">
                              Edit
                            </a>
                          </div>
                        </div> -->
                  
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Thương hiệu:</label>
                          <div class="col-sm-10">
                            <select class="form-control" id="inputBrand" name ="brand_id">
                                <!-- <option selected value ='' disabled>Tất cả</option> -->
                              @foreach($brands as $row)
                                <option value ="{{$row->id}}" @if($product->brand_id==$row->id) selected @endif >{{$row->brand_name}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>

                      </div>
                    </div>

                    <!--More Information-->
                  <div class="card">
                      <div class="card-header">
                          @lang('app.layouts.more-information')
                      </div>

                      <div class="card-body">
                          <!--Tab Language-->
                          <ul class="nav nav-tabs" id="tabLanguage" role="tablist">
                              @foreach (config('constants.full_locale') as $key => $lang)
                                  <li class="nav-item" role="presentation">
                                      <button type="button" class="nav-link {{ $loop->index == 0 ? 'active' : '' }}"
                                          data-bs-toggle="tab" data-bs-target="#{{ $key }}" role="tab"
                                          aria-controls="{{ $key }}" aria-selected="true">
                                          {{ __('app.languages.' . config('constants.full_locale')[$key]) }}
                                      </button>
                                  </li>
                              @endforeach
                          </ul>
                          <!--End Tab Language-->

                          <!--Tab Language Content-->
                          <div class="tab-content" id="tabLanguageContent">
                              @foreach (config('constants.multilang') as $key => $lang)
                                  <div class="tab-pane fade {{ $loop->index == 0 ? 'show active' : '' }}"
                                      id="{{ $lang }}" role="tabpanel"
                                      aria-labelledby="{{ $lang }}-tab">
                                      <div class="form-group row">
                                          <label class="col-sm-2 col-form-label">
                                              Tên sản phẩm <sup>*</sup>
                                              <div class="form-note">(@lang('app.max_characters', ['number' => 255]))
                                              </div>
                                          </label>
                                          <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                              <input type="text"
                                                  class="form-control @error($lang . '.product_name') border-danger @enderror"
                                                  maxlength='255' onkeyup="countString(this)"
                                                  name="{{ $lang }}[product_name]"
                                                  value="{{$product->translations[$key]->product_name}}" required>
                                          </div>
                                          <div class="offset-2 col-sm-10">
                                              @error($lang . '.product_name') <spanclass="text-danger">{{ $message }}</span> @enderror
                                          </div>
                                      </div>

                                      <div class="form-group row">
                                          <label class="col-sm-2 col-form-label">Slug</label>
                                          <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                              <input type="text"
                                                  class="form-control @error($lang . '.product_slug') border-danger @enderror"
                                                  name="{{ $lang }}[product_slug]"
                                                  value="{{$product->translations[$key]->product_slug}}">
                                          </div>
                                          <div class="offset-2 col-sm-10">
                                              @error($lang . '.product_slug') <span
                                                  class="text-danger">{{ $message }}</span> @enderror
                                          </div>
                                      </div>

                                      <div class="form-group row">
                                          <label class="col-sm-2 col-form-label">Mô tả</label>
                                          <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                              <textarea class="form-control"
                                                  name="{{ $lang }}[product_description]">{{$product->translations[$key]->product_description}}</textarea>
                                          </div>
                                      </div>

                                      <div class="form-group row">
                                          <label class="col-sm-2 col-form-label">Nội dung</label>
                                          <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                              <textarea class="form-control ckeditor"
                                                  name="{{ $lang }}[product_content]">{{$product->translations[$key]->product_content}}</textarea>
                                          </div>
                                      </div>

                                      <div class="form-group row">
                                          <label class="col-sm-2 col-form-label">@lang('app.layouts.seo_title')</label>
                                          <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                              <input type="text"
                                                  class="form-control @error($lang . '.seo_title') border-danger @enderror"
                                                  name="{{ $lang }}[seo_title]"
                                                  value="{{$product->translations[$key]->seo_title}}">
                                              @error($lang . '.seo_title') <span
                                                      class="text-danger">{{ $message }}</span>
                                              @enderror
                                          </div>
                                      </div>

                                      <div class="form-group row">
                                          <label
                                              class="col-sm-2 col-form-label">@lang('app.layouts.seo_description')</label>
                                          <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                              <textarea class="form-control"
                                                  name="{{ $lang }}[seo_description]">{{$product->translations[$key]->seo_description}}</textarea>
                                          </div>
                                      </div>

                                      <div class="form-group row">
                                          <label class="col-sm-2 col-form-label">@lang('app.layouts.seo_keywords')</label>
                                          <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                              <input type="text" class="form-control"
                                                  name="{{ $lang }}[seo_keywords]"
                                                  value="{{$product->translations[$key]->seo_keywords}}">
                                          </div>
                                      </div>
                                  </div>
                              @endforeach
                          </div>
                          <!--End Tab Language Content-->
                      </div>
                  </div>
                  <!--End More Information-->

                  
                    <!-- <div class="card">
                      <div class="card-header">
                        Thông tin chi tiết
                      </div>
                  
                      <div class="card-body">
                        <div class="form-not-option">
                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label field-required">
                              Price:<sup>*</sup>
                              <div class="form-note">(Use VND)</div>
                            </label>
                    
                            <div class="col-sm-10 d-flex justify-content-between align-items-center">
                              <input type="text" class="form-control" id="inputPrice" value="">
                            </div>
                          </div>
                    
                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label field-required">Stock:</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="inputStock" value="">
                            </div>
                          </div>

                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label field-required">SKU:</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="inputSKU" value="">
                            </div>
                          </div>

                          <div class="form-group row justify-content-end">
                            <div class="col-sm-10">
                              <button type="button" class="btn btn-variation" id="jsBtnVariation">
                                <i class="fas fa-plus"></i>
                                Enable Variations
                              </button>
                            </div>
                          </div>
                        </div>

                        <div class="form-option-list">
                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Variation:</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="jsInputVariation" value="">

                              <div class="col-sm-12 p-0 mt-3 d-flex justify-content-end">
                                <button type="button" class="btn btn-variation btn-cancel col-12 col-md-1" id="jsBtnCancelOption">
                                  <i class="fas fa-reply"></i>
                                  Cancel
                                </button>

                                <button type="button" class="btn btn-variation col-12 col-md-1 ml-2" id="jsBtnAddOption">
                                  <i class="fas fa-plus"></i>
                                  Add Options
                                </button>
                              </div>
                            </div>
                          </div>

                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Variation List:</label>
                            <div class="col-sm-10">
                              
                              <table class="table table-bordered" id="jsTblOptionList">
                                <thead>
                                  <tr>
                                    <th>Name</th>
                                    <th>Price <span class="form-note">(VND)</span></th>
                                    <th>Stock</th>
                                    <th>SKU</th>
                                    <th></th>
                                  </tr>
                                </thead>
            
                                <tbody>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div> -->

                    <div class="card">
                      <div class="card-header">
                        Hình ảnh
                      </div>
                      <div class="card-body">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Image:</label>
                          <div class="col-sm-10">
                            <div class="row">
                              <div class="col-2 text-center mb-3">
                                <span class="explain-text">Main</span>
                                <div class="drag-area">
                                  <img id="jsImgPreview" src="{{!empty($product->product_image)?$product->product_image:'/assets/images/no-image.jpg'}}" width="15%" style ="width:70%">
                                  <span class="header">
                                    <input type="hidden" class="form-control" id="imgP" name="product_image" value="{{$product->product_image}}" id="img-upload">
                                    <span class="button jsBtnUploadImg btn-lfm " id ="jsUploadImgBtn">browse</span>
                                  </span>
                                </div>
                                <div class="img-tool" data-id="0">
                                  <i class="fas fa-trash-alt"></i>
                                </div>
                              </div>

                              <div class="col-10 d-flex align-items-center justify-content-between">
                                <div class="remark-content">
                                  <ol>
                                    <li>Files Supported: PDF, JPEC, JPG.</li>
                                  </ol>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        @php
                            $slide = $product->product_slides != null? json_decode($product->product_slides): null;
                        @endphp
                        <div class="form-group row justify-content-end">
                          <div class="col-sm-10">
                            <div class="row">
                              <div class="col-2 text-center mb-3 slide-img">
                                <span class="explain-text">Image 1</span>
                                <div class="drag-area">
                                  <img id="jsImgPreview1" src="{{!empty($slide[0])?$slide[0]:'/assets/images/no-image.jpg'}}" width="15%" style ="width:70%">
                                  <span class="header">
                                    <input type="hidden" class="form-control" id="imgP1" name="slide[]" value="{{!empty($slide[0])?$slide[0]:null}}" id="img-upload1">
                                    <span class="button jsBtnUploadImg btn-lfm " id ="jsUploadImgBtn1">browse</span>
                                  </span>
                                </div>
                                <div class="img-tool" data-id="1">
                                  <i class="fas fa-trash-alt"></i>
                                </div>
                              </div>

                              <div class="col-2 text-center mb-3 slide-img">
                                <span class="explain-text">Image 2</span>
                                <div class="drag-area">
                                  <img id="jsImgPreview2" src="{{!empty($slide[1])?$slide[1]:'/assets/images/no-image.jpg'}}" width="15%" style ="width:70%">
                                  <span class="header">
                                    <input type="hidden" class="form-control" id="imgP2" name="slide[]" value="{{!empty($slide[1])?$slide[1]:null}}" id="img-upload2">
                                    <span class="button jsBtnUploadImg btn-lfm " id ="jsUploadImgBtn2">browse</span>
                                  </span>
                                </div>

                                <div class="img-tool" data-id="2">
                                  <i class="fas fa-trash-alt"></i>
                                </div>
                              </div>

                              <div class="col-2 text-center mb-3 slide-img">
                                <span class="explain-text">Image 3</span>
                                <div class="drag-area">
                                  <img id="jsImgPreview3" src="{{!empty($slide[2])?$slide[2]:'/assets/images/no-image.jpg'}}" width="15%" style ="width:70%">
                                  <span class="header">
                                    <input type="hidden" class="form-control" id="imgP3" name="slide[]" value="{{!empty($slide[2])?$slide[2]:null}}" id="img-upload3">
                                    <span class="button jsBtnUploadImg btn-lfm " id ="jsUploadImgBtn3">browse</span>
                                  </span>
                                </div>

                                <div class="img-tool" data-id="3">
                                  <i class="fas fa-trash-alt"></i>
                                </div>
                              </div>

                              <div class="col-2 text-center mb-3 slide-img">
                                <span class="explain-text">Image 4</span>
                                <div class="drag-area">
                                  <img id="jsImgPreview4" src="{{!empty($slide[3])?$slide[3]:'/assets/images/no-image.jpg'}}" width="15%" style ="width:70%">
                                  <span class="header">
                                    <input type="hidden" class="form-control" id="imgP4" name="slide[]" value="{{!empty($slide[3])?$slide[3]:null}}" id="img-upload4">
                                    <span class="button jsBtnUploadImg btn-lfm " id ="jsUploadImgBtn4">browse</span>
                                  </span>
                                </div>

                                <div class="img-tool" data-id="4">
                                  <i class="fas fa-trash-alt"></i>
                                </div>
                              </div>

                              <div class="col-2 text-center mb-3 slide-img">
                                <span class="explain-text">Image 5</span>
                                <div class="drag-area">
                                  <img id="jsImgPreview5" src="{{!empty($slide[4])?$slide[4]:'/assets/images/no-image.jpg'}}" width="15%" style ="width:70%">
                                  <span class="header">
                                    <input type="hidden" class="form-control" id="imgP5" name="slide[]" value="{{!empty($slide[4])?$slide[4]:null}}" id="img-upload5">
                                    <span class="button jsBtnUploadImg btn-lfm " id ="jsUploadImgBtn5">browse</span>
                                  </span>
                                </div>

                                <div class="img-tool" data-id="5">
                                  <i class="fas fa-trash-alt"></i>
                                </div>
                              </div>

                              <div class="col-2 text-center mb-3 slide-img">
                                <span class="explain-text">Image 6</span>
                                <div class="drag-area">
                                  <img id="jsImgPreview6" src="{{!empty($slide[5])?$slide[5]:'/assets/images/no-image.jpg'}}" width="15%" style ="width:70%">
                                  <span class="header">
                                    <input type="hidden" class="form-control" id="imgP6" name="slide[]" value="{{!empty($slide[5])?$slide[5]:null}}" id="img-upload6">
                                    <span class="button jsBtnUploadImg btn-lfm " id ="jsUploadImgBtn6">browse</span>
                                  </span>
                                </div>

                                <div class="img-tool" data-id="6">
                                  <i class="fas fa-trash-alt"></i>
                                </div>
                              </div>

                              <div class="col-2 text-center mb-3 slide-img">
                                <span class="explain-text">Image 7</span>
                                <div class="drag-area">
                                  <img id="jsImgPreview7" src="{{!empty($slide[6])?$slide[6]:'/assets/images/no-image.jpg'}}" width="15%" style ="width:70%">
                                  <span class="header">
                                    <input type="hidden" class="form-control" id="imgP7" name="slide[]" value="{{!empty($slide[6])?$slide[6]:null}}" id="img-upload7">
                                    <span class="button jsBtnUploadImg btn-lfm " id ="jsUploadImgBtn7">browse</span>
                                  </span>
                                </div>

                                <div class="img-tool" data-id="7">
                                  <i class="fas fa-trash-alt"></i>
                                </div>
                              </div>

                              <div class="col-2 text-center mb-3 slide-img">
                                <span class="explain-text">Image 8</span>
                                <div class="drag-area">
                                  <img id="jsImgPreview8" src="{{!empty($slide[7])?$slide[7]:'/assets/images/no-image.jpg'}}" width="15%" style ="width:70%">
                                  <span class="header">
                                    <input type="hidden" class="form-control" id="imgP8" name="slide[]" value="{{!empty($slide[7])?$slide[7]:null}}" id="img-upload8">
                                    <span class="button jsBtnUploadImg btn-lfm " id ="jsUploadImgBtn8">browse</span>
                                  </span>
                                </div>

                                <div class="img-tool" data-id="8">
                                  <i class="fas fa-trash-alt"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                </div>
              </fieldset>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('styles')
<style>
  .product-add-wrapper #product-add-form {
    position: relative;
  }

  .product-add-wrapper #product-add-form fieldset {
    position: relative;
  }

  #product-add-form fieldset:not(:first-of-type) {
    display: none;
  }

  .product-add-wrapper #progressbar {
    text-align: center;
    counter-reset: step;
    overflow: hidden;
  }

  .col-2.text-center.mb-3.slide-img {
      margin-top: 20px;
  }

  .product-add-wrapper #progressbar li {
    position: relative;
    width: 50%;
    float: left;
    list-style-type: none;
    letter-spacing: 1px;
    text-transform: uppercase;
    font-size: 10px;
  }

  .product-add-wrapper #progressbar li:before {
    content: counter(step);
    counter-increment: step;
    width: 24px;
    height: 24px;
    background: #6c757d;
    color: white;
    line-height: 26px;
    display: block;
    font-size: 12px;
    border-radius: 25px;
    margin: 0 auto 10px auto;
  }

  .product-add-wrapper #progressbar li:after {
    content: '';
    position: absolute;
    width: 100%;
    height: 2px;
    background: #6c757d;
    left: -50%;
    top: 9px;
    z-index: -1;
  }

  .product-add-wrapper #progressbar li:first-child:after {
    content: none;
  }

  .product-add-wrapper #progressbar li.active:before,
  .product-add-wrapper #progressbar li.active:after {
    background: #007bff;
    color: white;
  }

  .product-add-wrapper .category-wrapper {
    display: block;
    width: 100%;
    overflow-x: auto;
  }

  .product-add-wrapper .category-list {
    position: relative;
    left: 0%;
    width: 1500px;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    background-color: #fff;
    -webkit-transition: left .5s ease;
    transition: left .5s ease;
  }

  .product-add-wrapper .category-list ul {
    border-left: 1px solid #e8e8e8;
  }

  .product-add-wrapper .category-list ul:first-child {
    border-left: unset;
  }

  .product-add-wrapper .category-item {
    padding: 5px 16px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    line-height: 32px;
    border: unset;
    cursor: pointer;
  }

  .product-add-wrapper .category-item:hover {
    background: #f6f6f6;
    color: #007bff;
  }

  .product-add-wrapper .category-list .scrollbar {
    height: 320px;
    -webkit-box-flex: 1;
    -ms-flex: 1;
    flex: 1;
    overflow-y: scroll;
  }

  .category-selected .cat-selected-item:first-child .fa-angle-right {
    display: none;
  }

  .product-add-wrapper textarea {
    resize: none;
    min-height: 210px;
    height: 210px;
  }

  #product-add-form .classify-wrapper .action-button,
  #product-add-form .identify-wrapper .action-button {
    font-size: 14px;
    padding: .4rem 2rem;
  }

  #product-add-form .action-button-previous {
    text-decoration: underline;
  }

  #product-add-form .btn-variation {
    height: 40px;
    font-size: 1em;
    color: #007bff;
    background: unset;
    border: 1px solid #007bff;
  }

  #product-add-form .btn-variation.btn-cancel {
    color: #dc3545;
    border: 1px solid #dc3545;
  }

  #product-add-form .form-option-list {
    display: none;
  }

  #product-add-form .card {
    margin-bottom: 15px;
  }

  #product-add-form .form-option-list table thead th,
  #product-add-form .form-option-list table thead td {
    padding: 0.6rem;
    color: #000;
  }

  #product-add-form .form-option-list table thead th {
    text-align: center;
  }

  #product-add-form .drag-area {
    position: relative;
    height: 170px;
    width: 150px;
    border: 2px dashed #007bff;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
  }

  #product-add-form .drag-area .icon {
    font-size: 50px;
    color: #1683ff;
  }

  #product-add-form .drag-area .header {
    font-weight: 500;
    color: #34495e;
  }

  #product-add-form .drag-area .button {
    font-weight: 500;
    color: #007bff;
    cursor: pointer;
  }

  #product-add-form .drag-area.active {
    border: 2px solid #1683ff;
  }

  #product-add-form .drag-area img {
    width: 100%;
    height: 100%;
    object-fit: contain;
  }

  #product-add-form .img-tool {
    position: absolute;
    width: 150px;
    height: 25px;
    /* bottom: 0; */
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: space-evenly;
    -ms-flex-pack: space-evenly;
    justify-content: space-evenly;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    color: #fff;
    background-color: rgba(0,0,0,.5);
    border-radius: 0 0 2px 2px;
    cursor: pointer;
  }

  #product-add-form .explain-text {
    color: #999;
  }
</style>
@endpush

@push('scripts')
<script>
  var categoryUrl  = "{{url('admin/products/get-category')}}";
  var tokenHeader = $('meta[name="csrf-token"]').attr('content');
</script>
<script>
// Progressbar
$('.classify-wrapper').hide();
$('.img-tool').click(function(){
  let id = $(this).data('id');
  if(id == '0'){
      $('#jsImgPreview').attr('src','/assets/images/no-image.jpg');
      $('#imgP').val('');
  }
  else{
    $('#jsImgPreview'+id).attr('src','/assets/images/no-image.jpg');
    $('#imgP'+id).val('');
  }
});
$('.identify-wrapper').show();
$("#submit").click(function(){
  event.preventDefault()
  $('#product-add-form').submit();

  const nextCard = $(this).parent().next();
  $("#progressbar li").eq($("fieldset").index(nextCard)).addClass("active");
});
$(".next").click(function(){
  $('.classify-wrapper').hide();
  $('.identify-wrapper').show();

  const nextCard = $(this).parent().next();
  $("#progressbar li").eq($("fieldset").index(nextCard)).addClass("active");
});

$(".previous").click(function() {
  $('.classify-wrapper').show();
  $('.identify-wrapper').hide();

  const currentCard = $(this).parent();
  $("#progressbar li").eq($("fieldset").index(currentCard)).removeClass("active");
});

// Add Variations
$("#jsBtnVariation").click(function() {
  $(".form-option-list").show();
  $(".form-not-option").hide();
});

$('#jsBtnCancelOption').click(function() {
  $(".form-option-list").hide().find("tbody tr").remove();
  $(".form-not-option").show();
});

$('#jsBtnAddOption').click(function() {
  const opntion = $('#jsInputVariation').val().trim();
  $('#jsInputVariation').val('');

  $('#jsTblOptionList tbody').append(`
  <tr>
    <td>
      <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="${opntion}">
    </td>
    <td>
      <input type="text" class="form-control-plaintext" id="staticEmail" value="">
    </td>
    <td>
      <input type="text" class="form-control-plaintext" id="staticEmail" value="0">
    </td>
    <td>
      <input type="text" class="form-control-plaintext" id="staticEmail" value="">
    </td>
    <td class="text-center">
      <i class="fas fa-trash-alt"></i>
    </td>
  </tr>`);
});

$("#jsTblOptionList").on('click', '.fa-trash-alt', function () {
  $(this).closest('tr').remove();
});
</script>
<script> 
  const imgUploadInput = $('#img-upload');
  const previewDiv = $('#jsImgPreview');
  const uploadImgBtn = $('#jsUploadImgBtn');
  imgUploadInput.on('change', function(e) {
    const file = e.target.value ?? '';
    if (file) {
      previewDiv.src = file;
    }
  });
</script>
@endpush
