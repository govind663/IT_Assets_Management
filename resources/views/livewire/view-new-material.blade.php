<div>


    @if($fileUploaded == false)
        <div class="row form-group  align-items-center table-responsive">
            <h6 class="page-title-box mb-sm-0 text-primary text-capitalize"><b>Stock Details :</b> </h6>
            <table id="example" class="table table-bordered dt-responsive table-nowrap table-striped align-middle" style="width:100%">
                <thead class="bg-primary text-light">
                    <tr>
                        <th>Sr. No.</th>
                        <th>Category Name</th>
                        <th>Product Name</th>
                        <th>Product Code</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Unit</th>
                        <th>Quantity in Stock</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i=1; $i <= $formCounts; $i++) <tr>
                        <td>{{ $i }}</td>
                        <td>
                            <select disabled class="form-control categories_id @if ($errors->has('categories_id.'.$i)) 'is-invalid' @endif" wire:model="categories_id.{{$i}}">
                                <option value="">Select Catagory Name</option>
                                @foreach ($categories as $value)
                                <option value="{{ $value->id }}"> {{ $value->catagories_name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('categories_id.'.$i))
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $errors->first('categories_id.'.$i) }}</strong>
                            </span>
                            @endif
                        </td>
                        <td>
                            <select disabled class="form-control product_id @if ($errors->has('product_id.'.$i)) 'is-invalid' @endif" wire:model="product_id.{{$i}}">
                                <option value="">Select Product Name</option>
                                @foreach ($loop_products[$i] as $product)
                                <option value="{{ $product['id'] }}">{{ $product['name'] }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('product_id.'.$i))
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $errors->first('product_id.'.$i) }}</strong>
                            </span>
                            @endif
                        </td>
                        <td class="text-wrap">
                            <input type="text" readonly wire:model="product_code.{{$i}}" class="form-control product_code" placeholder="Enter Product Code">
                        </td>
                        <td>
                            <input readonly type="text" wire:model="brand.{{$i}}" class="form-control brand @if ($errors->has('brand.'.$i)) 'is-invalid' @endif" placeholder="Enter Brand">
                            @if ($errors->has('brand.'.$i))
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $errors->first('brand.'.$i) }}</strong>
                            </span>
                            @endif
                        </td>
                        <td>
                            <input readonly type="text" wire:model.defer="model.{{$i}}" class="form-control model @if ($errors->has('model.'.$i)) 'is-invalid' @endif" placeholder="Enter Model">
                            @if ($errors->has('model.'.$i))
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $errors->first('model.'.$i) }}</strong>
                            </span>
                            @endif
                        </td>
                        <td>
                            <select disabled class="form-control unit_id @if ($errors->has('unit_id.'.$i)) 'is-invalid' @endif" wire:model.defer="unit_id.{{$i}}">
                                <option value="">Select Unit</option>
                                @foreach ($loop_units[$i] as $unit)
                                <option value="{{ $unit['id'] }}">{{ $unit['unit_name'] }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('unit_id.'.$i))
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $errors->first('unit_id.'.$i) }}</strong>
                            </span>
                            @endif
                        </td>
                        <td>
                            <input readonly type="text" wire:model="quantity.{{$i}}" class="form-control quantity @if ($errors->has('quantity.'.$i)) 'is-invalid' @endif" placeholder="Enter Quantity">
                            @if ($errors->has('quantity.'.$i))
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $errors->first('quantity.'.$i) }}</strong>
                            </span>
                            @endif
                        </td>
                        </tr>
                        @endfor
                </tbody>
            </table>
        </div>
    @endif

    <div class="col-lg-12 mt-2">
        <div class="text-end">
            <a href="{{ route('request-new-material.index') }}" class="btn btn-danger">Cancel</a>&nbsp;
        </div>
    </div>
</div>
