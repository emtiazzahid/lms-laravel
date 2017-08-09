@extends('admin.layouts.master')
@section('title', 'PeraSale-HMS')
@section('page_css')
<link href="{{ url('admin/vendors/switchery/dist/switchery.min.css') }}" rel="stylesheet">
@stop
@section('content')
        <!-- page content -->
<div class="right_col" role="main">

    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            @if(isset($errors))
            @if ( count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @endif
            <div class="x_panel">
                <div class="x_title">
                    <h2> App Settings</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form id="demo-form2" action="{{ route('app-settings-update') }}" data-parsley-validate class="form-horizontal form-label-left">

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">App Name</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="app_name" value="{{ $settings['app_name'] or '' }}" required="required" class="form-control col-md-7 col-xs-12 input-sm">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">App Title</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text"  name="app_title" value="{{ $settings['app_title'] or '' }}" required="required" class="form-control col-md-7 col-xs-12 input-sm">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">App Base Url</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input  name="app_base_url" value="{{ $settings['app_base_url'] or '' }}"  class="form-control col-md-7 col-xs-12 input-sm" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Address</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input  class="form-control col-md-7 col-xs-12 input-sm"  type="text" name="address" value="{{ $settings['address'] or '' }}" >
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input  class="form-control col-md-7 col-xs-12 input-sm" type="text"  name="email" value="{{ $settings['email'] or '' }}" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Currency</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input  class="form-control col-md-7 col-xs-12 input-sm" type="text"  name="currency" value="{{ $settings['currency'] or '' }}" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Phone</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input  class="form-control col-md-7 col-xs-12 input-sm" type="text"  name="phone" value="{{ $settings['phone'] or '' }}" >
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button type="submit" class="pull-right btn btn-success">Update</button>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="x_title">
                    <h2> Audit Trail Settings</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form  action="{{ route('audit-settings-update') }}"  data-parsley-validate class="form-horizontal form-label-left">

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Audit Record</label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <p>
                                    On:
                                    <input type="radio" class="flat" name="audit_trail" id="status0" value="1" <?php if($settings['audit_trail'] == '1'){ echo 'checked=""';} ?>  required /> Off:
                                    <input type="radio" class="flat" name="audit_trail" id="status1" value="0" <?php if($settings['audit_trail'] == '0'){ echo 'checked=""';} ?> />
                                </p>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <label>
                                    <button type="submit" class=" btn btn-danger"> Save </button>
                                </label>
                            </div>
                        </div>
                    </form>
                        <div class="ln_solid"></div>
                    <form  action="{{ route('remove-audit-logs') }}"  data-parsley-validate class="form-horizontal form-label-left">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Delete All Audit Record</label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <p>
                                    Not Confirm:
                                    <input type="radio" class="flat" name="status" id="status0" value="0" checked="" required /> Confirm:
                                    <input type="radio" class="flat" name="status" id="status1" value="1" />
                                </p>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <label>
                                    <button type="submit" class=" btn btn-danger"> Delete </button>
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="x_title">
                    <h2> App Default Images</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                        <div class="form-group">
                            <div class="row">
                                <form  action="{{ route('app_logo_change') }}" method="post"  enctype="multipart/form-data" class="form-horizontal form-label-left">
                                {{ csrf_field() }}
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">App Logo</label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <img src="{{ url('logo.png') }}" alt="Logo Image" class="img-thumbnail" height="70" width="100">
                                <input type="file" name="new_logo_file">
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <label>
                                    <button type="submit" class=" btn btn-danger"> Update </button>
                                </label>
                            </div>
                                </form>
                            </div>
                            <br>
                            <div class="row">
                                <form  action="{{ route('app_pro_image_change') }}" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
                                {{ csrf_field() }}
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Default Profile Picture</label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <img src="{{ url('admin/images/user.jpg') }}" alt="Default Profile Picture" class="img-thumbnail" height="70" width="100">
                                <input type="file" name="new_default_profile_picture">
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <label>
                                    <button type="submit" class=" btn btn-danger"> Update </button>
                                </label>
                            </div>
                                </form>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- /page content -->

@stop
@section('page_js')
        <!-- Switchery -->
<script src="{{ url('admin/vendors/switchery/dist/switchery.min.js') }}"></script>
<script>
    // Switchery
    $(document).ready(function() {
        if ($(".js-switch")[0]) {
            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
            elems.forEach(function (html) {
                var switchery = new Switchery(html, {
                    color: '#26B99A',
                    className:"switchery switchery-small"
                });
            });
        }
    });
</script>
@stop