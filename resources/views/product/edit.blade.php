@extends('layouts.main')

@section('content')
 <!-- Content Header (Page header) -->
 <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Редактировать товар</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Главная</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <form action="{{ route('product.update', $product->id)}}" method="post">
          @csrf 
          @method('patch')

          <div class="form-group">
            <input type="text" value="{{$product->title ?? old('title')}}" name="title" class="form-control" placeholder="Наименование">
          </div>

          <div class="form-group">
            <input type="text" value="{{$product->description ?? old('description')}}" name="description" class="form-control" placeholder="Описание">
          </div>

          <div class="form-group">
            <textarea name="content" id="form-control" cols="30" rows="10" placeholder="Контент">{{$product->content ?? old('content') }}</textarea>
          </div>

          <div class="form-group">
            <input type="text" value="{{$product->price ?? old('price')}}" name="price" class="form-control" placeholder="Цена">
          </div>

          <div class="form-group">
            <input type="text" value="{{$product->count ?? old('count')}}" name="count" class="form-control" placeholder="Количество на складе">
          </div>

          <div class="form-group">
            <div class="input-group">
              <div class="custom-file">
                <input name="preview_image" type="file" class="custom-file-input" id="exampleInputFile">
                <label class="custom-file-label" for="exampleInputFile">Выберите файл</label>
              </div>
              <div class="input-group-append">
                <span class="input-group-text">Загрузка</span>
              </div>
            </div>
          </div>

          <div class="form-group">
            <select name="category_id" class="form-control select2" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
              <option selected="selected" disabled data-select2-id="3">Выберите категирию</option>
              @foreach($categories as $category)
                <option value="{{$category->id}}" {{$product->category_id == $category->id ? 'selected' : ''}}>{{$category->title}}</option>          
              @endforeach
            </select>
          </div>
          
          <div class="form-group">
            <label>Теги</label>
            <select class="tags" name="tags[]" multiple="multiple" data-placeholder="Выберите теги" style="width: 100%;">
              @foreach($tags as $tag)
                <option value="{{$tag->id}}" {{$product->tags->contains('id', $tag->id) ? 'selected' : '' }}>
                  {{$tag->title}}
                </option>  
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label>Цвета</label>
            <select class="colors" name="colors[]" multiple="multiple" data-placeholder="Выберите цвета" style="width: 100%;">
              @foreach($colors as $color)
              <option value="{{ $color->id }}" {{ $product->colors->contains('id', $color->id) ? 'selected' : '' }}>
                {{ $color->title }}
            </option>               
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Редактировать">
          </div>
        </form>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
@endsection