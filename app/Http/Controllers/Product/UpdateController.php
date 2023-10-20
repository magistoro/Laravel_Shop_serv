<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\ColorProduct;
use App\Models\Product;
use App\Models\ProductTag;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Product $product)
    {
        // Получаем валидированные данные из формы
        $data = $request->validated();

        // Массив, в котором будут храниться отдельные переменные
    $separateArrays = [];

    // Перебираем массив $data
        foreach ($data as $key => $value) {
            if (is_array($value)) {
            // Создаем отдельную переменную с именем, соответствующим ключу
            $$key = $value;
        
            // Добавляем отдельную переменную в массив $separateArrays
            $separateArrays[$key] = $$key;
        
            // Удаляем массив из массива $data
            unset($data[$key]);
        }
    }


        // Удаление прошлой картинки
        if ($request->hasFile('image') && $request->file('image')->isValid()) {}
        if (isset($data['preview_image'])) {
            Storage::disk('public')->delete($product->preview_image);
        }


        //  dd($data);
        

        // Обновление данных продукта
        $product->update($data);

       // Обработка новых тегов и цветов
        $tagsIds = $separateArrays['tags'] ?? [];
        $colorsIds = $separateArrays['colors'] ?? [];

        $product->tags()->sync($tagsIds);
        $product->colors()->sync($colorsIds);
     

        return view('product.show', compact('product'));
    }
}