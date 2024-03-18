<div>

    <div class="row form-group align-items-center">
        <div class="col-lg-4 col-md-6">
            <div class="mb-3">
                <label for="VendorsName" class="form-label"><b>Vendors Name : <span class="text-danger">*</span></b></label>
                <select class="form-control @error('vendor_id') is-invalid @enderror" wire:model.defer="vendor_id">
                    <option value="">Select Vendors Name</option>
                    @foreach ($vendors as $vendor)
                    <option value="{{ $vendor->id }}">{{ $vendor->company_name }}</option>
                    @endforeach
                </select>
                @error('vendor_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="mb-3">
                <label for="InworDateinput" class="form-label"><b>Inword Stock Date : <span class="text-danger">*</span></b></label>
                <input type="date" class="form-control  @error('inward_dt') is-invalid @enderror" value="{{ old('inward_dt') }}" wire:model.defer="inward_dt">
                @error('inward_dt')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="mb-3">
                <label for="VoucherNoinput" class="form-label"><b>Voucher No : <span class="text-danger">*</span></b></label>
                <input type="text" class="form-control  @error('voucher_no') is-invalid @enderror" value="{{ old('voucher_no') }}" wire:model.defer="voucher_no" placeholder="Enter Voucher No">
                @error('voucher_no')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="mb-3">
                <label for="WorkOrderNoinput" class="form-label"><b>Work Order No : <span class="text-danger">*</span></b></label>
                <input type="text" class="form-control @error('work_order_no') is-invalid @enderror" wire:model="work_order_no" wire:keydown="work_order_no($event)" value="{{ old('work_order_no') }}" placeholder="Enter Work Order No">
                @error('work_order_no')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
    </div>

    @if($work_order_no == true)
        <div class="row form-group  align-items-center" >
            <h6 class="page-title-box mb-sm-0 text-primary text-capitalize"><b>Stock Details :</b> </h6>
            <table id="dynamicTable" class="table table-bordered  table-nowrap table-striped align-middle" style="width:100%">
                <thead  class="bg-primary text-light">
                    <tr>
                        <th>Category Name</th>
                        <th>Product Name</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Unit</th>
                        <th>Warrenty Date</th>
                        <th>Quantity in Stock</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i=1; $i <= $formCounts; $i++)
                        <tr>
                            <td>
                                <select class="form-control categories_id @if ($errors->has('categories_id.'.$i)) 'is-invalid' @endif" wire:model="categories_id.{{$i}}">
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
                                <select class="form-control product_id @if ($errors->has('product_id.'.$i)) 'is-invalid' @endif" wire:model="product_id.{{$i}}">
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
                                <input readonly type="hidden" wire:model.defer="unit_id.{{$i}}" class="form-control unit_id @if ($errors->has('unit_id.'.$i)) 'is-invalid' @endif" placeholder="Enter Unit">
                                @if ($errors->has('unit_id.'.$i))
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $errors->first('unit_id.'.$i) }}</strong>
                                    </span>
                                @endif
                            </td>
                            <td>
                                <input type="date" wire:model="warranty_dt.{{$i}}" class="form-control warranty_dt @if ($errors->has('warranty_dt.'.$i)) 'is-invalid' @endif">
                                @if ($errors->has('warranty_dt.'.$i))
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $errors->first('warranty_dt.'.$i) }}</strong>
                                    </span>
                                @endif
                            </td>
                            <td>
                                <input type="text" wire:model="quantity.{{$i}}" class="form-control quantity @if ($errors->has('quantity.'.$i)) 'is-invalid' @endif" placeholder="Enter Quantity">
                                @if ($errors->has('quantity.'.$i))
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $errors->first('quantity.'.$i) }}</strong>
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if($i == 1)
                                    <button type="button" class="btn btn-success" wire:click="addMore">Add More</button>
                                @else
                                    <button type="button" class="btn btn-danger" wire:click="remove">Remove</button>
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
            <a href="{{ route('stocks.index') }}" class="btn btn-danger">Cancel</a>&nbsp;
            <button type="submit" wire:click="submitApplication" class="btn btn-primary">Submit</button>
        </div>
    </div>

</div>
