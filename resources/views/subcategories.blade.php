@forelse ($subcategories as  $subcategory)
<option value="{{ $subcategory->id }}"> {{ $child_name }} -> {{ $subcategory->name }}</option>
@if (count($subcategory->recursiveChildren))
    @php
        $parents = $child_name . ' -> '.$subcategory->name;
    @endphp
@include('subcategories',['subcategories'=>$subcategory->recursiveChildren,'child_name'=>$parents])
@endif
@empty
@endforelse