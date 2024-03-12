<div>
    <div class="row form-group align-items-center">

        <div class="col-lg-4 col-md-6">
            <div class="mb-3">
                <label for="Nameinput" class="form-label"><b>Name : <span class="text-danger">*</span></b></label>
                <input type="text" readonly class="form-control  @error('name') is-invalid @enderror" wire:model.defer="name" placeholder="Enter name">
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="mb-3">
                <label for="DepartmentName" class="form-label"><b>Department Name : <span class="text-danger">*</span></b></label>
                <select disabled class="js-example-basic-single form-control @error('department_id') is-invalid @enderror" wire:model.defer="department_id">
                    <option value="">Select Department Name</option>
                    @foreach ($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->dept_name }}</option>
                    @endforeach
                </select>
                @error('department_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="mb-3">
                <label for="MobileNoinput" class="form-label"><b>Mobile No : <span class="text-danger">*</span></b></label>
                <input type="text" class="form-control  @error('mobile_no') is-invalid @enderror" wire:model.defer="mobile_no" placeholder="Enter Mobile No">
                @error('mobile_no')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="mb-3">
                <label for="EmailIdinput" class="form-label"><b>Email Id : <span class="text-danger">*</span></b></label>
                <input type="email" readonly class="form-control  @error('email') is-invalid @enderror" wire:model.defer="email" placeholder="Enter Email Id">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="mb-3">
                <label for="Dateinput" class="form-label"><b>Material Request Date : <span class="text-danger">*</span></b></label>
                <input type="date" readonly class="form-control  @error('requested_at') is-invalid @enderror" wire:model.defer="requested_at" placeholder="Enter Voucher No">
                @error('requested_at')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>


        <div class="col-lg-4 col-md-6">
            <div class="mb-3">
                <label for="Documentinput" class="form-label"><b>Upload Document : <span class="text-danger">*</span></b></label>

                <div  class="form-group">
                    {{-- View material  document --}}
                    @if ($data->material_doc)
                    <a href="{{ asset('/storage/' .$data->material_doc ) }}" target="_blank" type="button"  class="btn btn-sm btn-primary">
                        View Document
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

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
